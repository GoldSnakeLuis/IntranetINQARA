<!doctype html>
<html class="fixed">    
    <head>

        <!-- Basic -->
        <meta charset="UTF-8">

        <meta name="keywords" content="Login" />
        <meta name="description" content="Login - Intranet INQARA">
        <meta name="author" content="www.pycsolutions.com">

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <!-- Web Fonts  -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

        <!-- Vendor CSS -->
        <link rel="stylesheet" href="<?php echo URL_ASSETS ?>vendor/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="<?php echo URL_ASSETS ?>vendor/animate/animate.css">

        <link rel="stylesheet" href="<?php echo URL_ASSETS ?>vendor/font-awesome/css/font-awesome.css" />
        <link rel="stylesheet" href="<?php echo URL_ASSETS ?>vendor/magnific-popup/magnific-popup.css" />
        <link rel="stylesheet" href="<?php echo URL_ASSETS ?>vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

        <!-- Theme CSS -->
        <link rel="stylesheet" href="<?php echo URL_ASSETS ?>css/theme.css" />

        <!-- Theme Custom CSS -->
        <link rel="stylesheet" href="<?php echo URL_ASSETS ?>css/custom.css">

        <!-- Head Libs -->
        <script src="<?php echo URL_ASSETS ?>vendor/modernizr/modernizr.js"></script>		        

    </head>
    <body>
        <!-- start: page -->
        <section class="body-sign">
            <div class="center-sign">
                <a href="http://www.pycsolutions.com/" class="logo float-left">
                    <img src="<?php echo URL_ASSETS ?>img/logo.png" height="54" alt="Porto Admin" />
                </a>

                <div class="panel card-sign">
                    <div class="card-title-sign mt-3 text-right">
                        <h2 class="title text-uppercase font-weight-bold m-0"><i class="fa fa-user mr-1"></i> Login</h2>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo MAIN_URL ?>/login/iniciarSesion" method="POST">
                            <div class="form-group mb-3">
                                <label>Usuario</label>
                                <div class="input-group input-group-icon">
                                    <input name="nick" type="text" class="form-control form-control-lg" tabindex="1"/>
                                    <span class="input-group-addon">
                                        <span class="icon icon-lg">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="clearfix">
                                    <label class="float-left">Password</label>
                                </div>
                                <div class="input-group input-group-icon">
                                    <input name="clave" type="password" class="form-control form-control-lg" tabindex="2"/>
                                    <span class="input-group-addon">
                                        <span class="icon icon-lg">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <div class="mb-1 text-center">
                                <button class="btn btn-facebook mb-3 ml-1 mr-1" href="#">Ingresar</button>
                            </div>

                            <!--<p class="text-center">Don't have an account yet? <a href="pages-signup.html">Sign Up!</a></p>-->

                        </form>
                    </div>
                </div>

                <p class="text-center text-muted mt-3 mb-3">P&C - &copy; Copyright 2017. Todos los derechos reservados.</p>
            </div>
        </section>
        <!-- end: page -->

        <!-- Vendor -->
        <script src="<?php echo URL_ASSETS ?>vendor/jquery/jquery.js"></script>		
        <script src="<?php echo URL_ASSETS ?>vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>		
        <script src="<?php echo URL_ASSETS ?>vendor/jquery-cookie/jquery-cookie.js"></script>
        <script src="<?php echo URL_ASSETS ?>vendor/popper/umd/popper.min.js"></script>		
        <script src="<?php echo URL_ASSETS ?>vendor/bootstrap/js/bootstrap.js"></script>		
        <script src="<?php echo URL_ASSETS ?>vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>		
        <script src="<?php echo URL_ASSETS ?>vendor/common/common.js"></script>		
        <script src="<?php echo URL_ASSETS ?>vendor/nanoscroller/nanoscroller.js"></script>		
        <script src="<?php echo URL_ASSETS ?>vendor/magnific-popup/jquery.magnific-popup.js"></script>		
        <script src="<?php echo URL_ASSETS ?>vendor/jquery-placeholder/jquery-placeholder.js"></script>

        <!-- Theme Base, Components and Settings -->
        <script src="<?php echo URL_ASSETS ?>js/theme.js"></script>

        <!-- Theme Custom -->
        <script src="<?php echo URL_ASSETS ?>js/custom.js"></script>

        <!-- Theme Initialization Files -->
        <script src="<?php echo URL_ASSETS ?>js/theme.init.js"></script>

    </body>

</html>