<?php

require_once '../Models/User.php';

$response = array();
$user = new User();

if( isset($_POST['username'])&& isset($_POST['password']))
{
    $user->_username = $_POST['username'];
    $user->_password = $_POST['password'];
	if ($user->login())
	{
		if ($user->isActiveUser())
		{
			$response['message'] = "Successfully Login!";
			$response['success'] = 1;
		}
		else
		{
			$response['message'] = "Account not yet verified!";
			$response['success'] = 0;
		}
	}
	else
	{
		$response['message'] = "Incorrect Credentials!";
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