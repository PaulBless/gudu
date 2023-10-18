<?php

  require 'includes/config/config.php';

  ## GET POST PARAMETERS
  $user_id = $_POST['user_id'];
  $user_name = $_POST['user_name'];
  $user_balance = $_POST['user_balance'];
  
  // USER DETAILS
  $stmt = "SELECT * FROM `gusers` WHERE user_id= :id";
  $qry = $conn->prepare($stmt); 
  $qry->bindParam(':id', $user_id);
  $qry->execute();
  $user_info = $qry->fetchAll();


  ## Get the list of products
  $guduProducts = $conn->query("SELECT * FROM `gudu_products_details` LIMIT 20");
  if($guduProducts) :

  endif;
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Gudu Market Place, a store for searching and buying products using Gudu Game Tokens">
    <meta name="author" content="Paul Eshun">
    <link rel="icon" type="image/x-icon" href="assets/images/glogo.png" />

    <title>Gudu Marketplace</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,700;1,300;1,400;1,700&family=Open+Sans:ital,opsz,wght@0,6..12,400;0,6..12,500;0,6..12,600;0,6..12,700;0,6..12,800;0,6..12,900;0,6..12,1000;1,6..12,300;1,6..12,400;1,6..12,500;1,6..12,600;1,6..12,800;1,6..12,1000&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,500;1,700&family=Roboto:ital,wght@0,400;0,500;1,400;1,900&display=swap" rel="stylesheet">
    
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/animated.css">
    <link rel="stylesheet" href="assets/css/owl.css">
  
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/main.css">

    <!-- third party libs -->
    <!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"> -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"> -->


    <style>
     
      #top{
        background-color: #ed017f !important;
        color: #4a4a4a;
        height: 3.75rem;
        margin: 0 auto;
        max-width: 90rem;
      }
      #top li a {
        font-size: 0.8125rem;
      }
      section .card{
        height: auto !important;
      }
    </style>
  </head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  
  <!-- navigation -->
  <nav class="navbar navbar-expand-lg bg-white sticky-top navbar-light shadow-sm">
    <div class="container">
      <a class="navbar-brand mx-3" href="#"><img src="assets/images/glogo.png" alt="Gudu" width="100px" height="60px"> </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  
      <div class="mx-auto my-3 d-none d-lg-none d-md-none d-sm-block d-xs-block">
        <div class="input-group">
          <input type="text" name="search_name" class="form-control border-warning" style="color:#7a7a7a; " placeholder="search item">
          <button type="submit" class="btn btn-warning text-white"><i class="fa fa-search"></i></button>
        </div>
      </div>

      <!-- links categories -->
      <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto py-3 text-center">
        <li class="nav-item">
            <a class="nav-link mx-2" aria-current="page" href="dailymedal.php?mpid=1&type=dm">Daily Medal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2" href="millionin1.php?mpid=2&type=mi1">Million-in-1 </a>
          </li>
        </ul>

        <!-- Search -->
        <div class="ms-auto my-3 d-sm-block d-xs-block">
          <div class="input-group">
            <input type="text" name="search_name" class="form-control border-warning" style="color:#7a7a7a; " placeholder="search item"/>
            <button type="submit" class="btn btn-warning btn-sm text-white search-btn"><i class="fa fa-search" aria-hidden="true"></i></button>
          </div>
        </div>

        <!-- show if user is logged in -->
      

        

      </div>
    </div>
  </nav>
  

  <!-- banner slides , will pull img from db: Ads-->
  <div class="row">
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner" role="listbox">
        <div class="carousel-item active" >
          <img src="https://snapzo.in/libs/images/sliders/banner-img_100983100.jpg" class="d-block img-fluid w-100" alt="" >
        </div>
        <div class="carousel-item" >
          <img src="https://snapzo.in/libs/images/sliders/banner-img_322697292.jpg" class="d-block img-fluid w-100" alt="" >
        </div>
        <div class="carousel-item" >
          <img src="https://snapzo.in/libs/images/sliders/banner-img_53880187.jpg" class="d-block img-fluid w-100" alt="" >
        </div>
        
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  <!-- end -->

  <!-- Images will be added here dynamically from API -->
  <div id="imageCarousel" class="carousel slide d-none" data-ride="carousel">
    <div class="carousel-inner">
    </div>
    <a class="carousel-control-prev" href="#imageCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#imageCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>


  
  <!-- products grid : implement content using data from API -->
  <div class="container py-5">
    <header class="text-center py-5">
      <h2 class="mb-0">Find a product you like and redeem with your Gudu<span style="color: var(--color-1); font-weight: 700; "> Gems or Tokens.</span></h2>
    </header>
    <div class="row">

      <?php
          foreach( $guduProducts as $product) :
              $productId = $product['gp_id'];
              $productName = $product['product_name'];
              $productDetails = $product['product_description'];
              $sponsor_id = $product['sponsor_id'];
              $mp_id = $product['marketplace_id'];
              $category_id = $product['product_category_id'];
              $productPrice = $product['product_price'];
              $productQty= $product['product_quantity'];
              $productImg = $product['product_image_name'];
              $productImageUrl = $product['product_image_url'];
              
              // fetch sponsor name
              $sponsor_name = getOne('gudu_sponsors', "sponsor_id = '$sponsor_id' ", 'sponsor_name');
              // fetch product category name
              $product_category = getOne('product_category', "category_id = '$category_id' ", 'category_name');
              
              $priceVal = getOne('gudu_marketplaces', "mpid = '$mp_id' ", 'priced_value');
              
          ?>

      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb-4">
        <div class="product-grid">
          <div class="product-image">
            <a href="#" class="image">
              <img class="pic-1" src="<?=$productImageUrl?>">
            </a>
            <ul class="product-links">
              <li><a id="quick_view" href="javascript:void(0)" data-id="<?=$productId?>" data-tip="Quick View"><i class="fa fa-search"></i></a></li>
            </ul>
          </div>
          <div class="product-content">
            <div class="title"><a class="p-name" href="javascript:void(0)"><?= $productName ?></a></div>
            <div class="price"> <?= $priceVal.$productPrice ?></div>
            <a class="add-to-cart" data-id="<?=$productId?>" href="javascript:void(0)"> redeem </a>
          </div>
        </div>
      </div>
      
      <?php endforeach; ?>
   
    </div>
  </div>



  <!-- modals -->
  <!-- 1 - Login : Make login compulsory -->
  <div id="loginModal" data-bs-backdrop="static" role="dialog" aria-modal="true" class="fade modal show" tabindex="-1" aria-labelledby="contained-modal-title-vcenter" style="display: blockk;">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
        <!-- <h5 class="modal-title txt-custom text-center m-auto">Confirm Identity</h5> -->
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
        </div>
        <div class="modal-body">
        <div>
          <form method="post" id="loginForm">
            <p class="mb-3 text-custom">please enter your username to confirm.</p>
            <div class="form-group mb-4">
              <input class="form-control mb-3" type="text" name="username" placeholder="Username" id="username" autocomplete="off" autofocus >
              <small id="errorHelp" class="text-danger fst-italic"></small>
            </div>

            <button class="btn btn-outline-primary login-btn br-20">Confirm</button>
          </form>
        </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end login -->

  <!-- 2 - Redeem Product -->
  <div id="cartModal" data-bs-backdrop="static" role="dialog" aria-modal="true" class="fade modal show" tabindex="-1" aria-labelledby="contained-modal-title-vcenter" style="display: blockk;">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">          
          <h5 class="modal-title txt-custom text-center m-auto">Redeem Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
        <div>
          <form method="post" id="cartForm">
            <p class="mb-4 text-light">Product details.</p>

            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <button type="button" class="btn btn-outline-primary br-20">Confirm</button>
              </div>
              <div>
                <button type="button" class="btn btn-danger br-20 text-end">Cancel</button>
              </div>
            </div>

          </form>
        </div>
        </div>
      </div>
    </div>
  </div>

  <!-- 2 - Marketplace Option -->
  <div id="mpModal" data-bs-backdrop="static" role="dialog" aria-modal="true" class="fade modal show " tabindex="-1" aria-labelledby="contained-modal-title-vcenter" >
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title txt-custom text-center m-auto">Choose Market Place</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="d-flex align-items-center justify-content-center pt-3">
              <a href="dailymedal.php?mpid=1&type=dm" class="btn btn-outline-primary br-20">Daily Medal</a>
              <a href="millionin1.php?mpid=2&type=mi1" class="btn btn-warning m-4 br-20">Million-in-1</a>
          </div>
          
        <div>

        </div>
        </div>
      </div>
    </div>
  </div>

  <!-- product quick view modal -->
  <div id="product_view" data-bs-backdrop="static" role="dialog" aria-modal="true" class="fade modal show " tabindex="-1" aria-labelledby="contained-modal-title-vcenter" >
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title txt-custom text-center m-auto">Product View</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body py-4">
          <form action="" method="post" id="redeemItem">
          <div class="row">
            <div class="col-md-4 product_img">
                <img id="pimg" class="img-responsive ">
            </div>
            <div class="col-md-8 product_content">
                <h4 class="pname">  </h4>
                <p id="pdesc"></p>
                <h3 id="pcost" class="cost"></h3>
            </div>
          </div>
          <input type="hidden" name="sponsor" id="sponsor">
          <input type="hidden" name="user" id="user">
          <input type="hidden" name="product" id="product">
          
        </div>  
        <div class="d-flex align-items-center justify-content-center modal-footer">
            <button type="submit" id="confirm" class="btn btn-outline-primary br-20">Redeem Item</button>
            <button id="close" data-bs-dismiss="modal" class="btn btn-danger m-4 br-20">Cancel</button>
        </div>
      </form>
      </div>
    </div>
  </div>

  <!-- modals -->



  <!-- footer -->
  <footer class="bg-warning p-2">
    <div class="container d-flex align-items-center justify-content-center">
      <div class="row text-center">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="about footer-item">
            <div class="logo">
              <a href="index.html"><img src="assets/images/glogo.png" alt="Gudu Studios"></a>
            </div>
            
          </div>
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="about footer-item">
            <!-- <h4>Follow Us</h4> -->
            <ul class="p-3">
              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa fa-instagram"></i></a></li>
            </ul>
          </div>
        </div>
        
        <div class="col-lg-12">
          <div class="copyright">
            <p>© 2023, Gudu Studios Ltd. All Rights Reserved. 
          </p>
          </div>
        </div>

      </div>
    </div>
    <!-- not using -->
    <div class="footer-copyright text-center text-white">
      <p class="text-white-50">© 2023, Gudu Studios Ltd. All Rights Reserved. </p>
   </div>
  </footer>


  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script> -->


  <!-- Scripts -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/animation.js"></script>
  <script src="assets/js/imagesloaded.js"></script>
  <script src="assets/js/custom.js"></script>

  <script>
    // Fetch images from the API
    const apiUrl = 'http://localhost:8080/gudu-admin/api/v1/';

    fetch('YOUR_API_ENDPOINT')
    .then(response => response.json())
    .then(data => {
        // Call a function to populate the carousel with images
        populateCarousel(data);
    })
    .catch(error => console.error('Error fetching images:', error));

    function populateCarousel(data) {
      const carousel = document.querySelector('#imageCarousel .carousel-inner');
      let isFirstImage = true;

      data.forEach((image, index) => {
          const item = document.createElement('div');
          item.classList.add('carousel-item');
          if (isFirstImage) {
              item.classList.add('active');
              isFirstImage = false;
          }

          const img = document.createElement('img');
          img.src = image.imageUrl; // Replace with the correct property from your API response

          item.appendChild(img);
          carousel.appendChild(item);
      });
    }


    $(document).ready(function() {
      // initialize carousel on page load
      $('myCarousel').carousel();

      // show login form
      $('#loginModal').modal('show');

      //submit login form
      $('#loginForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $('.login-btn').text('please wait...').attr('disabled', 'disabled');

        $.ajax({
          type: 'POST',
          url: apiUrl +'marketplace/user_login.php',
          data: formData,
          dataType: 'json',
          contentType: false,
          processData: false,
          success: function(res) {
            console.log(res); let info = JSON.stringify(res.data);
            localStorage.setItem("guser", info);
            if (res.status == 200) {
              $('#loginModal').modal('hide');
              $('#loginForm').trigger("reset");

              setTimeout(() => { 
                url = "dailymedal.php?mpid=1&type=dm";
                window.location.href = url;
              }, 200);

            } else if (res.status == 404) {
              $('#username').css("borderColor", "#f0643b");
              $('#errorHelp').html(res.message);
              $('.login-btn').text('Login').attr('disabled', false);
              
            } else {
              $('#errorHelp').html(res.message);
              $('.login-btn').text('Login').attr('disabled', false);
            }
          },
          error: function(res) {
            console.log(res);
          }
        });
      });

    });

    // Acc
    $(document).on("click", ".naccs .menu div", function() {
      var numberIndex = $(this).index();

      if (!$(this).is("active")) {
          $(".naccs .menu div").removeClass("active");
          $(".naccs ul li").removeClass("active");

          $(this).addClass("active");
          $(".naccs ul").find("li:eq(" + numberIndex + ")").addClass("active");

          var listItemHeight = $(".naccs ul")
            .find("li:eq(" + numberIndex + ")")
            .innerHeight();
          $(".naccs ul").height(listItemHeight + "px");
        }
    });

   
  </script>
</body>
</html>