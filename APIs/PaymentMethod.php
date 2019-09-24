<?php 
	require_once '../Models/Payment.php';
	require_once '../include/utils.php';
	require_once '../include/dbconnect.php';
	$response = array();
	$utls = new utils();

	$action =  $_POST["action"];
	$payment = new Payment();
	if ($action == 'PAY')
	{
		if(isset($_POST['pOrderMsterId']) && isset($_POST['pAmount']) && isset($_POST['pTotal'])&& isset($_POST['pChange'])&& isset($_POST['pUsername'])&& isset($_POST['pDateTime']))
		{
			$payment->_pOrderMsterId = $_POST["pOrderMsterId"];
			$payment->_pAmount = $_POST['pAmount'];
			$payment->_pTotal = $_POST["pTotal"];
			$payment->_pChange = $_POST["pChange"];
			$payment->_pUsername = $_POST["pUsername"];
			$payment->_pDateTime = $_POST["pDateTime"];
			
			if ($payment->createPayment())
			{
				$response['message'] = "Successfully Paid!";
				$response['success'] = 1;
			}
			else
			{
				$response['message'] = "Record not saved!";
				$response['success'] = 0; 
			}
		}
		else
		{
			
			$response['message'] = "Please fill out required fields";
			$response['success'] = 0;
		}	
		
		
		
	}
	
	echo json_encode($response);

?>