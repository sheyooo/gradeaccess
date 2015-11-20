<?php
require_once("includes/functions_no_session.inc");
$stat_message = "";


if($id = Tools::isUserLogged()){
    Tools::redirect("index.php");
};


if ($u = Tools::valuePost("user") AND $p = Tools::valuePost("pass") AND Tools::valueGet("login") == 1) {

    if(Tools::signin($u, $p)){
        Tools::redirect("index.php");
    }else{
        Tools::redirect("signin.php?status=1");
    }
};

if($value = Tools::valueGet('status')){
    if($value == 1){
        $stat_message = "<div class=\"alert animated fadeIn alert-danger text-center\">Wrong Username or Password!</div>";
    } elseif($value == 2){
        $stat_message = "<div class=\"alert animated fadeIn alert-danger text-center\">Missing Credentials!</div>";
    } elseif($value == 3){
        $stat_message = "<div class=\"alert animated fadeIn alert-success text-center\">Signup successful, login with your email or chosen username!</div>";
    } elseif($value == 4){
        $stat_message = "<div class=\"alert animated fadeIn alert-success text-center\">Password successfully reset login with new password.</div>";
    }
}

?>
<!DOCTYPE html>
<html class="signin no-js" lang="en">

<head>
    <title>Grade Access - SIGN IN</title>
    <?php include("includes/head.inc"); ?>
</head>


<body class="" style="background-image: url(img/raisedhands.jpg)">

<div class="<!-- cover -->" style=""></div>

<div class="center-wrapper">
    <div class="center-content">
        <div class="row no-m">

            <div class="col-xs-12 col-lg-2 col-lg-offset-5 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 ">
                    <img class="col-xs-12" src="img/logo.png" alt="Grade Access logo" />
            </div>

            <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                <section class="panel bg-white no-b mt25">
                    <ul class="switcher-dash-action">
                        <li class="active"><a href="#" class="selected">Sign in</a></li>
                        <li><a href="signup.php" class="">Signup</a></li>
                    </ul>
                    <noscript>
                        <p style="">This application will not function without JavaScript. Please enable javascript.<br>
                            For full functionality of this site it is necessary to enable JavaScript.<br>
                            Here are the <a href="http://www.enable-javascript.com/" target="_blank">
                            instructions how to enable JavaScript in your web browser</a>.
                            </p>
                    </noscript>
                    <div class="p15">
                        <?php echo $stat_message; ?>
                        <form role="form" action="signin.php?login=1" method="post">

                            <input type="text" required name="user" class="form-control input-lg mb25" placeholder="Email or Phone number"
                                   autofocus>
                            <input type="password" required name="pass" class="form-control input-lg mb25"
                                   placeholder="Password">

                            <div class="show">
                                <div class="pull-right">
                                    <a href="forgot.php">Forgot password?</a>
                                </div>
                                <label class="checkbox">
                                    <input type="checkbox" value="remember-me">Remember me
                                </label>
                            </div>

                            <button class="btn btn-primary btn-outline btn-lg btn-block" type="submit">Sign in</button>
                        </form>
                    </div>
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
</body>

</html>
