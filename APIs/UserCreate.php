<?php

require_once '../Models/User.php';

$response = array();
$user = new User();

if( isset($_POST['lastname']) && isset($_POST['firstname']) && isset($_POST['username'])&& isset($_POST['password'])&& isset($_POST['role']) && isset($_POST['code']) )
{
    $user->_lastname = $_POST['lastname'];
    $user->_firstname = $_POST['firstname'];
    $user->_mi = $_POST['mi'];
    $user->_username = $_POST['username'];
    $user->_password = $_POST['password'];
    $user->_role = $_POST['role'];
	$user->_code = $_POST['code'];
    
	if (!($user->isExistUsername()))
	{
		if( $user->createUser() )
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
		$response['message'] = "Username already taken!!";
		$response['success'] = 0; 
	}
}
else
{
    $response['message'] = "Please fill out required fields";
    $response['success'] = 0;
}

echo json_encode($response);

?>