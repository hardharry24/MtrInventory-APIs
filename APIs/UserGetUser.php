<?php

require_once '../Models/User.php';

$response = array();
$user = new User();

if( isset($_POST['username']))
{
    $user->_username = $_POST['username'];
    
	$response = $user->getUser();
}
else
{
    $response['message'] = "Please fill out required fields";
    $response['success'] = 0;
}

echo json_encode($response);

?>