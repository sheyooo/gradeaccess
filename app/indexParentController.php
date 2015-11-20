<?php include("includes/functions.inc"); ?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>

    <title>Overview of your Child's Progress in School - Grade Access</title>
    <!-- page level plugin styles -->
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap-switch/bootstrap-switch.min.css">
    <!-- /page level plugin styles -->
    <?php
    include("includes/head.inc");
    include("includes/parent/check_login.inc");
    include("includes/connect.inc");
    ?>
</head>

<!-- body -->

<body>

<div class="app">
    <!-- top header -->
    <header class="header header-fixed navbar">
        <?php include("includes/parent/header.inc"); ?>
    </header>
    <!-- /top header -->

    <section class="layout">
        <!-- sidebar menu -->
        <aside class="sidebar offscreen-left">
            <!-- main navigation -->
            <?php include("includes/parent/main_nav.inc"); ?>
        </aside>
        <!-- /sidebar menu -->

        <!-- main content -->
        <?php include("modules/parent/index"); ?>
        <!-- /main content -->

    </section>

</div>

<!-- core scripts -->
<?php include("includes/core_scripts.inc") ?>
<!-- /core scripts -->

<!-- page level scripts -->
<!-- /page level scripts -->

<!-- page script -->
<!-- <script src="js/dashboard.js"></script> -->
<!-- /page script -->

<!-- template scripts -->
<?php include("includes/template_scripts.inc") ?>
<!-- /template scripts -->

</body>
<!-- /body -->

</html>
