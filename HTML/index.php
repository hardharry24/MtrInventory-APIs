<?php 
	require_once '../include/dbconnect.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Motor Trade</title>
</head>
<body>
    
    <!-- Header-->
    <header class="text-white small">

        <!-- top header -->
        <div class="_dark-primary">
            <div class="container">
                <div class="row py-2">
                    <div class="col">
                        <p class=" mb-0">Welcome to Motor Trade!</p>
                    </div>
                    <div class="col">
                         <?php if(isset($_SESSION["uid"])){ ?>
                            <p class="float-right mb-0"><a href="logout.php" class="text-white">Logout</a></p>
                             <p class="float-right mb-0"><a href="login_form.php" class="text-white"><i>
                            <?php echo 'Welcome ' .($_SESSION["name"] ? $_SESSION["name"] : $_SESSION["l_name"] );?> &nbsp</i></a></p>
                         <?php }else{ ?>
                            <p class="float-right mb-0"><a href="login_form.php" class="text-white">Login</a></p>
                         <?php } ?>

                         
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
                                <i class="fas fa-shopping-basket pr-2"></i>Motor Trade
                            </a>
                        </h2>
                    </div>
                    <div class="col-8">
                        <form class="form-inline">
                            <input class="form-control w-75" type="search" id="search_box" placeholder="Search" aria-label="Search">
                            <button class="btn btn-dark mx-1" type="submit" id="search_btn">Search</button>
                        </form>
                    </div>
                    <div class="col-2">

                        <h3 class="float-right mb-0 data-toggle="dropdown">
                            <a href="cart.php" class="text-white">
                                <i class="fas fa-shopping-cart"></i> Cart
                                <span class="badge badge-light"></span>    
                            </a>
                        </h3>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- navs -->
        <div class="navs _light-primary pt-2">
            <div class="container">
                <div class="row">
                    <div class="col-2">
                        <h6 class="mb-0 _bg-light-primary text-uppercase rounded-top p-3">
                           <i class="fas fa-bars pr-2"></i>Categories
                        </h6>
                    </div>
                    <div class="col-10">
                        <nav class="navbar navbar-expand-lg p-0">
                            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div id="navbarCollapse" class="collapse navbar-collapse">
                                <ul class="navbar-nav ">
                                    <li class="nav-item active h6 pt-2 pr-4 mb-0 text-uppercase  text-white">
                                       <a href="#" class="nav-link a-nav">Brands</a>
                                    </li>
                                    <li class="nav-item active h6 pt-2 pr-4 mb-0  text-uppercase">
                                        <a href="#" class="nav-link a-nav">Services</a>
                                    </li>
                                    <li class="nav-item active h6 pt-2 pr-4 mb-0 text-uppercase">
                                        <a href="#" class="nav-link a-nav" data-toggle="modal" data-target="#exampleModal">Contact Us</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

    </header>

    <!-- Sections -->
    <section class="showcase">
        <div class="container">
            <div class="row">

                <!-- Categories -->
                <div class="col-2">
                    
                    <!-- Display all categories -->
                    <div id="get_category"></div>

                    <!-- Brands -->
                    <h6 class="mb-0 _bg-light-primary text-uppercase rounded-top mt-4 p-3 text-white">
                        <i class="fas fa-tags pr-2"></i>Brands
                    </h6>
                    <!-- display all brands -->
                    <div id="get_brand"></div>

                    <!-- Services -->
                    <h6 class="mb-0 _bg-light-primary text-uppercase rounded-top mt-4 p-3 text-white">
                        <i class="fas fa-wrench pr-2"></i>Services
                    </h6>

                    <?php if(isset($_SESSION["uid"])){ ?>
                    <!-- display all brands -->
                    <div id="get_services"></div>

                    <?php }else{ ?>
                    <ul class="list-group">
                        <li class="list-group-item border-top-0 rounded-0 small"><a href="<?php echo $uri1.'/'.$uri2.'//login_form.php' ?>" class="text-dark">Electronics</a></li>
                        <li class="list-group-item small"><a href="<?php echo $uri1.'/'.$uri2.'//login_form.php' ?>" class="text-dark">Home Appliances Repair</a></li>
                        <li class="list-group-item small"><a href="<?php echo $uri1.'/'.$uri2.'//login_form.php' ?>" class="text-dark">Computer Repair</a></li>
                        <li class="list-group-item small"><a href="<?php echo $uri1.'/'.$uri2.'//login_form.php' ?>" class="text-dark">Software installation</a></li>
                        <li class="list-group-item small"><a href="<?php echo $uri1.'/'.$uri2.'//login_form.php' ?>" class="text-dark">Hardware installation</a></li>
                        <li class="list-group-item small"><a href="<?php echo $uri1.'/'.$uri2.'//login_form.php' ?>" class="text-dark">Electronics Gadgets Repair</a></li>
                    </ul>
                    <?php }?>



                    <!-- Contact Us -->
                    <h6 class="mb-0 _bg-light-primary text-uppercase rounded-top mt-4 p-3 text-white">
                        <i class="fas fa-phone pr-2"></i></i>Contact Us
                    </h6>
                    <ul class="list-group mb-5">
                        <li class="list-group-item border-top-0 rounded-0 small"><a href="#" class="text-dark">CONTACTS</a></li>
                        <li class="list-group-item small"><a href="#" class="text-dark">ADDITIONAL INFO</a></li>
                    </ul>

                </div>

                <!-- Carousel -->
                <div class="col-7">
                    <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="images/1.jpg" alt="First slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>
                                        <strong class="text-uppercase">innovate,</strong>
                                        <strong class="text-uppercase">smarter,</strong>
                                        <strong class="text-uppercase">brighter</strong>
                                    </h5>
                                    <p>Top Selling!</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="images/2.jpg" alt="Second slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>
                                        <strong class="text-uppercase">Drone diy,</strong>
                                        <strong class="text-uppercase">Workskop,</strong>
                                        <strong class="text-uppercase">Build & Fly,</strong>
                                    </h5>
                                    <p>Your Own drone!</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="images/1.jpg" alt="Third slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>
                                        <strong class="text-uppercase">innovate,</strong>
                                        <strong class="text-uppercase">smarter,</strong>
                                        <strong class="text-uppercase">brighter</strong>
                                    </h5>
                                    <p>Top Selling!</p>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                    
                    <!-- Shop -->
                    <div id="shop">

                        <h2 class="_bg-light-primary text-white p-2">
                            <i class="fas fa-shopping-basket"></i> SHOP
                        </h2>

                        <div id="product_msg" class="mt-3"></div>

                        <!-- display products -->
                        <div id="get_product"></div>

                    </div>
                    

                </div>

                <!-- right images -->
                <div class="col-3">
                    <div class="container d-inline-block align-center">
                        <div class="row">
                            <img src="images/shop-sidebar_grande.jpg" alt="" class="my-4 mb-1">
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <img src="images/banner1.jpg" alt="" class="my-4 mb-1">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section id="newsletter" class="_bg-light-primary p-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="text-white text-uppercase mb-0">
                        <i class="fas fa-envelope fa-2x pr-3"></i>
                        <strong>signup to newsletter</strong> <br>
                        ...and receive $29 coupon for first shopping
                    </p>
                </div>
                <div class="col-5">
                    <form class="form-inline pt-3">
                        <input class="form-control w-75" type="email" placeholder="Email Address" aria-label="Email Address">
                        <button class="btn btn-dark mx-1 " type="submit">Subscribe Now</button>
                    </form>
                </div>
                <div class="col">
                    <p class="float-right">
                        <a href="#" class="mr-3">
                            <i class="fab fa-twitter fa-2x pt-3 text-white"></i>
                        </a>
                        <a href="#" class="mr-3">
                            <i class="fab fa-instagram fa-2x pt-3 text-white"></i>
                        </a>
                        <a href="#" class="mr-3">
                            <i class="fab fa-facebook fa-2x pt-3 text-white"></i>
                        </a>
                        <a href="#" class="mr-3">
                            <i class="fab fa-google-plus-g fa-2x pt-3 text-white"></i>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- pre-footer -->
    <div class="footer-policy-area ">
    <div class="container">
      <div class="row py-5 border">
        
        <div class="col-lg-3 col-sm-6 col-md-3 col-xs-12 foo-pol border-right">
          <div class="footer-policy-box d-block text-center">
            
            <p><i class="fas fa-undo fa-3x _light-primary-color"></i></p>
            
            <h4 class="mt-4">FREE RETURNS</h4>
            
            <p class="mt-4">Currently over 50 countries qualify for express international shipping.</p>
            
          </div>
        </div>
        
        
        <div class="col-lg-3 col-sm-6 col-md-3 col-xs-12 foo-pol border-right">
          <div class="footer-policy-box d-block text-center">
            
            <p><i class="fas fa-award fa-3x _light-primary-color"></i></p>
            
            <h4 class="mt-4">CUSTOMER SUPPORT</h4>
            
            <p class="mt-4">We really care about you and your website as much as you do.</p>
            
          </div>
        </div>
        
        <div class="col-lg-3 col-sm-6 col-md-3 col-xs-12 foo-pol border-right">
          <div class="footer-policy-box d-block text-center">
            
            <p><i class="fas fa-plane fa-3x _light-primary-color"></i></i></p>

            <h4 class="mt-4">INTERNATIONAL SHIPPING</h4>
            
            <p class="mt-4">Currently over 50 countries qualify for express international shipping.</p>
            
          </div>
        </div>
        
        <div class="col-lg-3 col-sm-6 col-md-3 col-xs-12 foo-pol">
          <div class="footer-policy-box d-block text-center">
            
            <p><i class="fas fa-star fa-3x _light-primary-color"></i></p>
            
            <h4 class="mt-4">DEDICATED SERVICE</h4>
            
            <p class="mt-4">Consult our specialists for help with an order, customization, or design advice.</p>
            
          </div>
        </div>        
      </div>
    </div>
  </div>

    <!-- footer -->
    <footer class="bg-dark text-white py-3">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="float-left mb-0 pt-3">Copyright &copy; 2019 TechnoCare. All Rights Reserved.</p>
                </div>
                <div class="col"><p class="float-right mb-0"><i class="fab fa-cc-paypal fa-3x"></i></p></div>
            </div>
        </div>
    </footer>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Contact Us</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- modal body goes here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send</button>
            </div>
            </div>
        </div>
    </div>


    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>