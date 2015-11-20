<?php include("includes/functions_no_session.inc");?>
<!doctype html>
<html class="signup no-js" lang="en">

<head>
    <title>Parents' Signup - Grade Access</title>

    <?php include("includes/head.inc"); ?>
</head>

<body class="" style="background-image: url(img/finegirl.jpg)">

    <!-- <div class="cover" style="background-image: url(img/test1.jpg)"></div> -->

    <div class="center-wrapper">
        <div class="center-content">
            <div class="row no-m">
                <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-2 col-lg-offset-5 text-center mb0">
                <a href="index.php">
                    <img class="" src="img/logo.png" alt="Grade Access logo" />
                </a>
                </div>
                <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-8 col-lg-offset-2 text-center mt25">
                    <section class="panel bg-white no-b">
                        <ul class="switcher-dash-action">
                            <li><a href="signin.php" class="selected">Sign in</a></li>
                            <li class="active"><a href="javascript:;" class="">Signup</a></li>
                        </ul>
                        <div class="p15">
                            <?php
                            if($err = Tools::valueGet("status")){
                                if($err == 1){
                                    echo "<div class=\"alert alert-info animated fadeIn\">The token does not exist, contact the school you are trying to signup to.</div>";
                                }elseif($err == 2){
                                    echo "<div class=\"alert alert-danger animated fadeIn\">The email is already being used<br>
                                            <a href=\"forgot.php\" class=\"btn btn-danger btn-outline\">Click here</a>  to reset your password, if you forgot it
                                    </div>
                                    ";
                                }elseif($err == 3){
                                    echo "<div class=\"alert alert-danger animated fadeIn\">The phone number is already being used<br>
                                            <a href=\"forgot.php\" class=\"btn btn-danger btn-outline\">Click here</a>  to reset your password, if you forgot it
                                    </div>";
                                }elseif($err == 4){
                                    echo "<div class=\"alert alert-danger animated fadeIn\">Something went wrong<br>
                                            <a href=\"bug.php\" class=\"btn btn-primary btn-outline\">Please go to this page</a> to get it fixed
                                    </div>
                                    ";
                                }
                            };
                            ?>
                            <form class="form" class="parsley-form" method="post" action="process/forms/signup.php" data-parsley-validate>

                                <div class="row">
                                    <div class="col-xs-12 col-lg-3">
                                        <input type="text" name="subdomain" data-parsley-required="true" data-parsley-trigger="change"
                                        data-parsley-length="[2, 20]"
                                        class="form-control input-lg" placeholder="School token e.g. bellina">
                                    </div>

                                    <div class="col-xs-9">
                                        
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-xs-3">
                                        <select name="title" type="text" class="form-control input-lg col-xs-4 col-lg-3">
                                            <option value="Mr">Mr. </option>
                                            <option value="Mrs">Mrs. </option>
                                            <option value="Miss">Miss. </option>
                                        </select>
                                    </div>

                                    <div class="col-xs-9">
                                        <input type="text" name="name" data-parsley-required="true" data-parsley-trigger="change"
                                        data-parsley-length="[3, 50]"
                                        class="form-control input-lg" placeholder="Full Name (Last Name  First Name)">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-6">
                                        <input type="email" name="email" data-parsley-required="true" data-parsley-trigger="change"
                                        data-parsley-type="email"
                                        class="form-control input-lg" placeholder="Email (gradeaccess@yahoo.com)">
                                    </div>


                                    <div class="col-xs-6">
                                        <input name="phone" data-parsley-required="true" data-parsley-trigger="change"
                                        data-parsley-type="digits" data-parsley-length="[10, 17]"
                                        class="form-control input-lg" placeholder="Phone number (2348030303030)">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-6">
                                        <input type="password" id="pass" name="pass" data-parsley-required="true" data-parsley-trigger="change"
                                        data-parsley-length="[6, 30]"
                                        class="form-control input-lg mb25" placeholder="Choose a password">
                                    </div>
                                    <div class="col-xs-6">
                                        <input type="password" data-parsley-required="true" data-parsley-trigger="change"
                                        data-parsley-equalto="#pass" data-parsley-length="[6, 30]"
                                        class="form-control input-lg mb25" placeholder="Repeat the password">
                                    </div>
                                </div>

                                <div class="show">
                                    <label class="checkbox">
                                        <input type="checkbox" data-parsley-required="true" data-parsley-required-message="Click to agree with terms before signup" name="terms" value="remember-me">I accept
                                        <a href="javascript:;">Grade Access's terms and conditions</a>
                                    </label>
                                </div>
                                
                                <div class="row">
                                    <div class="col-xs-12 mb25">
                                        <a href="forgot.php" class="text-info pull-right">Are you a teacher looking to signup to your school? Click here to get your password</a>
                                    </div>

                                    <div class="col-xs-6 col-xs-offset-3">
                                        <button class="btn btn-primary btn-lg btn-block btn-outline btn-parsley">Submit </button>
                                    </div>

                                    
                                </div>
                            </form>


                        </section>
                        <p class="footer-text-white text-center">
                            Copyright &copy;
                            <span id="year" class="mr0"></span>
                            <span>Grade Access</span>
                        </p>
                        <p class="footer-text-white text-center">
                            Made with <i class="fa fa-heart" style="color: #f22;"></i> in Lagos, Nigeria.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var el = document.getElementById("year"),
            year = (new Date().getFullYear());
            el.innerHTML = year;
        </script>

        <script src="plugins/jquery-2.1.3.min.js"></script>
        <script src="plugins/parsley.min.js"></script>

    </body>
    </html>