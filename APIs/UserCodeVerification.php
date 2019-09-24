<?php

require_once '../Models/User.php';

$response = array();
$user = new User();

if( isset($_POST['username'])&& isset($_POST['code']))
{
    $user->_username = $_POST['username'];
    $user->_code = $_POST['code'];
	

	if ($user->verifyCode())
	{
		$response['message'] = "Correct Verification Code!";
		$response['success'] = 1;	
	}
	else
	{
		$response['message'] = "Incorrect Verification Code!";
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