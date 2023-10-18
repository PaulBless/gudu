<?php
if(isset($_POST["cropImage"]))
{
 $data = $_POST["cropImage"];
 $image_array_1 = explode(";", $data);
 $image_array_2 = explode(",", $image_array_1[1]);
 $data = base64_decode($image_array_2[1]);
 $imageName = time().'_'.'.png';
//  file_put_contents($imageName, $data);
 echo json_encode(array($data));
// return $data;

}

