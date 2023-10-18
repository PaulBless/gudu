<?php 
    
    header('Content-type: application/json; charset=UTF-8');

    require '../includes/config/config.php';

    $response = array();

    if($_POST['pid']) {
        $pid = htmlspecialchars(intval($_POST['pid']));
        
        ## Get the list of products
        $sql = "SELECT * FROM `gudu_products_details` WHERE `gp_id` = '$pid' LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $response['pname'] = $result['product_name'];
        $response['pprice'] = $result['product_price'];
        $response['pid'] = $result['product_id'];
        $response['pimg'] = $result['product_image_url'];
        $response['pdesc'] = $result['product_description'];
        $response['pcat'] = $result['product_category_id'];

        echo json_encode(array($result));
        // echo json_encode($response);

    }