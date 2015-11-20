<header class="header header-fixed navbar material-shadow">
<noscript>
    This application will not function without JavaScript. Please enable javascript.
    For full functionality of this site it is necessary to enable JavaScript.
    Here are the <a href="http://www.enable-javascript.com/" target="_blank">
        instructions how to enable JavaScript in your web browser</a>.
</noscript>

<div class="brand">
    <!-- toggle offscreen menu -->
    <a href="javascript:;" class="ti-menu off-left visible-xs" data-toggle="offscreen" data-move="ltr"></a>
    <!-- /toggle offscreen menu -->

    <!-- logo -->
    <a href="index.php" class="navbar-brand">
        <img src="img/logo.png" alt="">
        <span class="heading-font">
            Grade Access
        </span>
    </a>
    <!-- /logo -->
</div>

<ul class="nav navbar-nav">
    <li class="hidden-xs">
        <!-- toggle small menu -->
        <a href="javascript:;" class="toggle-sidebar">
            <i style="color: white;" class="fa fa-lg fa-bars"></i>
        </a>
        <!-- /toggle small menu -->
    </li>
    <!--<li class="header-search"> -->
        <!-- toggle search -->
        <!--<a href="javascript:;" class="toggle-search">
            <i class="ti-search"></i>
        </a>-->
        <!-- /toggle search -->
        <!--<div class="search-container">
            <form role="search">
                <input type="text" class="form-control search" placeholder="type and press enter">
            </form>
        </div>-->
    <!--</li>-->
</ul>

<ul class="nav navbar-nav navbar-left">

    <?php 
        $left = __DIR__ . "/../user/header_navbar-left.inc";
        include $left;
     ?>

</ul>

<ul class="nav navbar-nav navbar-right">

    <?php
        $right = __DIR__ . "/../" . $user->getType() . "/header_navbar-right.inc";
        include $right;
     ?>
    

</ul>
</header>