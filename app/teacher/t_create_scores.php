<?php include("includes/functions.inc"); ?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <!-- meta -->
    <meta charset="utf-8">
    <meta name="description" content="Flat, Clean, Responsive, application admin template built with bootstrap 3">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
    <!-- /meta -->


    <!-- page level plugin styles -->
    <link rel="stylesheet" href="plugins/chosen/chosen.min.css">
    <link rel="stylesheet" href="plugins/datatables/jquery.dataTables.css">
    <link rel="stylesheet" href="plugins/datepicker/datepicker.css">
    <!-- /page level plugin styles -->
    <?php
    include("includes/head.inc");
    include("includes/teacher/check_login.inc");
    include("includes/connect.inc");
    // redirect_to("link_student.php");
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
        <?php include("modules/teacher/create_scores"); ?>
        <!-- /main content -->
    </section>

</div>

<!-- core scripts -->
<?php include("includes/core_scripts.inc") ?>
<!-- /core scripts -->

<!-- page level scripts -->
<script src="plugins/chosen/chosen.jquery.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="plugins/parsley.min.js"></script>
<!-- /page level scripts -->

<!-- template scripts -->
<?php include("includes/template_scripts.inc") ?>
<!-- /template scripts -->

<!-- page script -->
<script src="js/bootstrap-datatables.js"></script>
<script src="js/table-edit-set-scores.js"></script>
<script src="js/pickers.js"></script>
<!-- /page script -->

</body>
<!-- /body -->

</html>