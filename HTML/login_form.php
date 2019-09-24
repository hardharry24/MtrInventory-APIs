<?php
session_start();
#this is Login form page , if user is already logged in then we will not allow user to access this page by executing isset($_SESSION["uid"])
#if below statment return true then we will send user to their profile.php page
if (isset($_SESSION["uid"])) {

    header("location:profile.php");

}

//in action.php page if user click on "ready to checkout" button that time we will pass data in a form from action.php page
if (isset($_POST["login_user_with_product"])) {
	//this is product list array
	$product_list = $_POST["product_id"];
	//here we are converting array into json format because array cannot be store in cookie
	$json_e = json_encode($product_list);
	//here we are creating cookie and name of cookie is product_list
	setcookie("product_list",$json_e,strtotime("+1 day"),"/","","",TRUE);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="style.css">
    <title>Technocare</title>
</head>
<body>
    
    <!-- Header-->
    <header class="text-white small">

        <!-- top header -->
        <div class="_dark-primary">
            <div class="container">
                <div class="row py-2">
                    <div class="col">
                        <p class=" mb-0">Welcome to TechnoCare!</p>
                    </div>
                    <div class="col">
                        <p class="float-right mb-0"><a href="login_form.php" class="text-white">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- inner header -->
        <div class="header-inner _light-primary py-4">
            <div class="container">
                <div class="row">
                    <div class="col-2">
                        <h2 class="mb-0">
                            <a href="index.php" class="text-white">
                                <i class="fas fa-shopping-basket pr-2"></i>TechnoCare
                            </a>
                        </h2>
                    </div>

                </div>
            </div>
        </div>

    </header>

    <!-- login form -->
    <section id="login_form">
        <div class="container-fluid my-5">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8" id="signup_msg">
                    <!--Alert from signup form-->
                </div>
                <div class="col-md-2"></div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header _light-primary text-white">Customer Login Form</div>
                        <div class="card-body">
                            <!--User Login Form-->
                            <form onsubmit="return false" id="login">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" required/>
                                <label for="email">Password</label>
                                <input type="password" class="form-control" name="password" id="password" required/>
                                <p><br/>
                                </p>
                                <div><a href="Forgotten_Password.php?register=1" style="color:black; list-style:none;">Forgotten Password?</a></div><input type="submit" class="btn btn-success" style="float:right;" Value="Login">
                                <!--If user dont have an account then he/she will click on create account button-->
                                <div><a href="customer_registration.php?register=1">Create a new User account?</a></div>		
                                <div><a href="Tech_registration.php?register=1">Create a new Technician account?</a></div>	
                                <div><a href="StoreRegister.php?register=1">Create a new Supplier account?</a></div>	
                            </form>
                    </div>
                    <div class="card-footer _dark-primary"><div id="e_msg text-white"></div></div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </section>


    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="main.js"></script>
</body>
</html>