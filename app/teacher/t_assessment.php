<?php include("includes/functions.inc"); ?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>

    <title>View the Report Card of your Child - Grade Access</title>
    <!-- page level plugin styles -->
    <!-- <link rel="stylesheet" type="text/css" href="plugins/easy-pie-chart/jquery.easypiechart.css"> -->
    <!-- /page level plugin styles -->

    <!-- core styles -->
    <?php
    include("includes/head.inc");
    include("includes/teacher/check_login.inc");
    include("includes/connect.inc");
    ?>
    <!-- template styles -->
</head>

<!-- body -->

<body style="oveflow: hidden;">
<div class="app">
    <!-- top header -->
    <header class="header header-fixed navbar">
        <?php include("includes/teacher/header.inc"); ?>
    </header>
    <!-- /top header -->

    <section class="layout">
        <!-- sidebar menu -->
        <aside class="sidebar offscreen-left">
            <!-- main navigation -->
            <?php include("includes/teacher/main_nav.inc"); ?>
        </aside>
        <!-- /sidebar menu -->

        <!-- main content -->
        <?php include("modules/teacher/assessment"); ?>
        <!-- /main content -->


    </section>

</div>

<!-- core scripts -->
<?php include("includes/core_scripts.inc") ?>
<!-- /core scripts -->

<!-- page level scripts -->
<script src="plugins/jquery.easing.min.js"></script>
<script src="plugins/easy-pie-chart/jquery.easypiechart.min.js"></script>
<!-- /page level scripts -->

<!-- template scripts -->
<?php include("includes/template_scripts.inc") ?>
<!-- /template scripts -->

<!-- page script -->
<script src="js/chart.js"></script>
<!-- /page script -->

</body>
<!-- /body -->

</html>
