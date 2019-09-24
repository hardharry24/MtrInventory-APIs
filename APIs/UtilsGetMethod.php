<?php

	require_once '../Models/Motorcycle.php';
	require_once '../Models/Order.php';
	require_once '../Models/Payment.php';
	require_once '../Models/Report.php';

	$response = array();
	$action = $_POST["action"];
	//$action = "REMAINING";
	$mtr = new Motorcycle();
	$ordr = new Order();
	$payment = new Payment();
	$rpt = new Report();
	if ($action == "BRAND")
	{
		$output = array();
		$result = $mtr->selectBrand();

		while($row = $result->fetch_assoc())
		{
			$output[] = $row;
		}

		$response['message'] = $output;
		$response['success'] = 1; 

	}
	if ($action == "MODEL")
	{
		$output = array();
		$mtr->_mtrBrand = $_POST["mtrBrand"];
		$result = $mtr->selectModel();

		while($row = $result->fetch_assoc())
		{
			$output[] = $row;
		}

		$response['message'] = $output;
		$response['success'] = 1; 
	}
	if ($action == "MOTOR")
	{
		$output = array();
		$result = $mtr->selectMotor();

		while($row = $result->fetch_assoc())
		{
			$output[] = $row;
		}

		$response['message'] = $output;
		$response['success'] = 1; 
	}
	if ($action == "ORDER")
	{
		$username = $_POST["username"];
		$output = array();
		$result = $ordr->getOrder($username);

		while($row = $result->fetch_assoc())
		{
			$output[] = $row;
		}

		$response['message'] = $output;
		$response['success'] = 1; 
	}
	if ($action == "MY_ORDER")
	{
		$username = $_POST["username"];
		$output = array();
		$result = $ordr->myOrder($username);

		while($row = $result->fetch_assoc())
		{
			$output[] = $row;
		}

		$response['message'] = $output;
		$response['success'] = 1; 
	}
	
	if ($action == "ORDER_DETAILS")
	{
		$id = $_POST["orderId"];
		$output = array();
		$result = $ordr->orderDetails($id);

		while($row = $result->fetch_assoc())
		{
			$output[] = $row;
		}

		$response['message'] = $output;
		$response['success'] = 1; 
	}
	
	if ($action == "MY_PAYMENT")
	{
		$username = $_POST["username"];
		$output = array();
		
		$result = $payment->getPayment($username);

		while($row = $result->fetch_assoc())
		{
			$output[] = $row;
		}

		$response['message'] = $output;
		$response['success'] = 1; 
	}

	if ($action == "REMAINING")
	{
		$output = array();
		
		$result = $rpt->getRemainingMtr();

		while($row = $result->fetch_assoc())
		{
			$output[] = $row;
		}

		$response['message'] = $output;
		$response['success'] = 1; 
	}
	
	if ($action == "TOTAL_BY")
	{
		$output = array();
		$type = $_POST["type"];
		$dt = $_POST["date"];
		$result = $rpt->getSoldMtr($type,$dt);

		while($row = $result->fetch_assoc())
		{
			$output[] = $row;
		}

		$response['message'] = $output;
		$response['success'] = 1; 
	}

	echo json_encode($response);

?>