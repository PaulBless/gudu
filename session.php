<?php

/**
* Author : PaulBless 
* Email : eshunbless1@gmail.com
*/

## User Session 
session_start();
if( isset($_SESSION['user_name']) ){
    $sessionAdminId = $_SESSION['admin_id'];

} else {

    // die( json_encode(array("status" => 401, "message" => "Unauthorized!! Kindly login to continue...")));
    echo json_encode(array("status" => 401, "message" => "Unauthorized!! Kindly login to continue..."));
    header( "refresh:2;URL=index.php" );

}