<?php

    header('Content-type: application/json; charset=UTF-8');

    require 'includes/config/config.php';

	$response = array();
	
	if ($_POST['pid']) {
		
		$pid = htmlspecialchars(intval($_POST['expenseId']));
        $query_expense = mysqli_query($connect_db,"SELECT * FROM `bop_business` WHERE `bid`='{$pid}' LIMIT 1")or die(mysqli_error($connect_db));
        $expenseInfo = mysqli_fetch_array($query_expense);  

        $response['bid'] = $expenseInfo['bid'];
        $response['pid'] = $expenseInfo['has_permit'];
        $response['business'] = $expenseInfo['business_name'];
        $response['owner'] = $expenseInfo['owners_name'];
        $response['contact'] = $expenseInfo['contact_number'];
        $response['certificate'] = $expenseInfo['certificate_no'];
        $response['location'] = $expenseInfo['business_location'];
        $response['type'] = $expenseInfo['business_type'];
        $response['structure'] = $expenseInfo['business_description'];
        $response['category'] = $expenseInfo['business_category'];
        
		echo json_encode($response);
	}
?>