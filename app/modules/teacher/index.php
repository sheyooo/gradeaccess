<!DOCTYPE html>
<html class="no-js" lang="en">

<head>

    <title>Overview of your Students' behaviour in your Class - Grade Access</title>
    <!-- page level plugin styles -->
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap-switch/bootstrap-switch.min.css">
    <!-- /page level plugin styles -->
    <?php
    include("includes/head.inc");
    ?>
</head>

<!-- body -->

<body>

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
        <?php include("modules/teacher/t_index"); ?>
        <!-- /main content -->

    </section>

</div>

<!-- core scripts -->
<?php include("includes/core_scripts.inc") ?>
<!-- /core scripts -->

<!-- page level scripts -->
<script src="plugins/bootstrap-switch/bootstrap-switch.min.js"></script>
<!-- /page level scripts -->

<!-- page script -->
<!-- <script src="js/dashboard.js"></script> -->
<script src="js/buttons.js"></script>
<script src="js/bootstrap-switch-init.js"></script>
<!-- /page script -->

<!-- template scripts -->
<?php include("includes/template_scripts.inc") ?>
<!-- /template scripts -->

</body>
<!-- /body -->

</html>
