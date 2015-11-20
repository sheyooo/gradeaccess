<?php include("includes/functions.inc"); ?>
<?php include("includes/connect.inc"); ?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>

    <title>Overview of all Teachers in the School - Grade Access</title>
    <!-- page level plugin styles -->
    <link rel="stylesheet" href="plugins/chosen/chosen.min.css">
    <link rel="stylesheet" href="plugins/datatables/jquery.dataTables.css">
    <link rel="stylesheet" href="plugins/datepicker/datepicker.css">
    <!-- /page level plugin styles -->
    <?php
    include("includes/head.inc");
    include("includes/admin/check_login.inc");
    ?>
</head>

<!-- body -->

<body>
<div class="app">
    <!-- top header -->
    <header class="header header-fixed navbar">
        <?php include("includes/admin/header.inc"); ?>
    </header>
    <!-- /top header -->

    <section class="layout">
        <!-- sidebar menu -->
        <aside class="sidebar offscreen-left">
            <!-- main navigation -->
            <?php include("includes/admin/main_nav.inc"); ?>
        </aside>
        <!-- /sidebar menu -->

        <!-- main content -->
        <?php include("modules/admin/a_teachers"); ?>
        <!-- /main content -->
    </section>

</div>

<!-- core scripts -->
<?php include("includes/core_scripts.inc") ?>
<!-- /core scripts -->

<!-- page level scripts -->
<script src="plugins/chosen/chosen.jquery.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.js"></script>
<!-- /page level scripts -->

<!-- template scripts -->
<?php include("includes/template_scripts.inc") ?>
<!-- /template scripts -->

<!-- page script -->
<script src="js/bootstrap-datatables.js"></script>
<script src="js/datatables.js"></script>
<!-- /page script -->

</body>
<!-- /body -->

</html>
