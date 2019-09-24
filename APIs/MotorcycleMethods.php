<?php 
	require_once '../Models/Motorcycle.php';
	require_once '../include/utils.php';
	require_once '../include/dbconnect.php';
	$response = array();
	$utls = new utils();

	$action = $_POST["action"];
	$mtr = new Motorcycle();
	if ($action == 'INSERT')
	{
		if( isset($_POST['mtrBrand']) && isset($_POST['mtrModel']) && isset($_POST['mtrQty'])&& isset($_POST['mtrPrice'])&& isset($_POST['mtrDateTime'])&& isset($_POST['mtrImg']))
		{
			
			$mtr->_mtrBrand = $_POST["mtrBrand"];
			$mtr->_mtrModel = $_POST["mtrModel"];
			$mtr->_mtrQty = $_POST["mtrQty"];
			$mtr->_mtrPrice = $_POST["mtrPrice"];
			$mtr->_mtrDateTime = $_POST["mtrDateTime"];
			$mtr->_mtrImg =$utls->saveImage($_POST["mtrImg"]);
			
			//$filename = 
			if (!($mtr->isExistMotorcycle()))
			{
				if ($mtr->createMotorcycle())
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
				$response['message'] = "Motorcycle details already exist!!";
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