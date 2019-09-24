<?php 
	require_once '../Models/Order.php';
	require_once '../include/utils.php';
	require_once '../include/dbconnect.php';
	$response = array();
	$utls = new utils();

	$action =  $_POST["action"];
	$ordr = new Order();
	if ($action == 'ORDER')
	{
		if(isset($_POST['orderMotorId']) && isset($_POST['orderQty']) && isset($_POST['orderUsername']))
		{
			$ordr->_orderMotorId = $_POST["orderMotorId"];
			$ordr->_orderQty = $_POST['orderQty'];
			$ordr->_orderUsername = $_POST["orderUsername"];
			
			if ($ordr->createOrderTb())
			{
				$response['message'] = "One record saved!";
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
	if ($action == 'DELETE')
	{
		if(isset($_POST['orderId']))
		{
			$ordr->_orderId = $_POST['orderId'];
			$ordr->removeOrder();
			$response['message'] = "Successfully Deleted!";
			$response['success'] = 1; 
		}
		else
		{
			
			$response['message'] = "Please fill out required fields";
			$response['success'] = 0;
		}	
		
	}
	
	if ($action == 'CHECKOUT')
	{
		if(isset($_POST['ordertbMasterId']) && isset($_POST['orderMstrUsername']) && isset($_POST['orderMstrDateTime']))
		{
			$id = $_POST['ordertbMasterId'];
			$username = $_POST['orderMstrUsername'];
			$dateTime = $_POST['orderMstrDateTime'];
			if ($ordr->saveMasterOrder($id,$username,$dateTime))
			{
				$response['message'] = "Success!";
				$response['success'] = 1; 
			}
			else
			{
				$response['message'] = "Error Occured!";
				$response['success'] = 0; 
			}
			
		}
		else
		{
			
			$response['message'] = "Please fill out required fields";
			$response['success'] = 0;
		}	
	}
	if ($action == 'UPDATE_MOTOR')
	{
		if(isset($_POST['mtrId']) && isset($_POST['orderQty']))
		{
			$mtrId = $_POST['mtrId'];
			$ordr->_orderQty = $_POST['orderQty'];
			$ordr->updateMotorQty($mtrId);

			$response['message'] = "Successfully !";
			$response['success'] = 1; 
		}
		else
		{
			$response['message'] = "Please fill out required fields";
			$response['success'] = 0;
		}
	}
	if ($action == 'TEST')
	{
		$ordr->_orderQty = 1;
		$ex = $ordr->updateMotorQty(2);
		echo $ex;
	}
	echo json_encode($response);

?>