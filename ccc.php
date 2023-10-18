<html>  
  <head>  
    <title>Crop And Upload Image In JQuery With PHP</title>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css" />
  </head>  
    <body>  
      <div class="container">          
          <h3 align="center">Crop And Upload Image In JQuery With PHP</h3>      
          <div class="panel panel-primary">
            <div class="panel-heading">Select Image</div>
              <div class="panel-body" align="center">
                <input type="file" name="upload_image" id="upload_image" />           
              </div>
          </div>
      </div>

    <div  id="uploadimage" style='display:none;' class="container">          
        <div class="panel panel-primary">
          <div class="panel-heading">Upload & Crop Image</div>
            <div class="panel-body" align="center">
              <div id="image_demo" style="width:350px; margin-top:30px"></div>
              <div id="uploaded_image" style="width:350px; margin-top:30px;"></div>            
            </div>
            <div class="panel-footer"> 
                <input type="text" id="cropImage">
                <button class="btn btn-success crop_image">Crop & Upload Image</button>
            </div>           
        </div>
    </div>
    </body>  
</html>

 
<script>  
$(document).ready(function(){

 $image_crop = $('#image_demo').croppie({
    enableExif: true,
    viewport: {
      width:500,
      height:500,
      type:'rectangle' 
    },
    boundary:{
      width:500,
      height:500
    }
  });

  $('#upload_image').on('change', function(){
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind', {
        url: event.target.result
      }) 
    }
    reader.readAsDataURL(this.files[0]);
    $('#uploadimage').show();
    icrop();
  });

  function icrop(){
    $image_crop.croppie('result', {type: 'canvas', size: 'viewport'})
    .then(function(result) {
        console.log(result);
        // post data
        $.ajax({
           url: "up.php",
           type: "POST",
           dataType: "json",
           data: {"cropImage": result},
           success: function(data) {
            $('#cropImage').val(data);
            console.log(data);
           },
           error: function(jqXHR, textStatus, errorThrown) {

           }
        });
    });
  }

  $('.crop_image').click(function(event){
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
      $.ajax({
        url:"upload.php",
        type: "POST",
        data:{"image": response},
        success:function(data)
        {
           $('#uploaded_image').html(data)
        }
      });
    })
  });

});  
</script>