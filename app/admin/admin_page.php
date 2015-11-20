<!DOCTYPE html>
<html class="no-js" lang="en">

<head>

    <title><?php echo $page['title']; ?> | GRADEACCESS</title>
    <!-- page level plugin styles -->
    <?php echo $page['css']; ?>
    <!-- /page level plugin styles -->
    <?php
    include("includes/head.inc");
    ?>
</head>

<!-- body -->

<body>

<div class="app">
    <!-- top header -->
    <?php include("includes/user/header.inc"); ?>
    <!-- /top header -->

    <section class="layout">
        <!-- sidebar menu -->
        <aside class="sidebar offscreen-left">
            <!-- main navigation -->
            <?php include("includes/admin/main_nav.inc"); ?>
        </aside>
        <!-- /sidebar menu -->

        <!-- main content -->
        <?php include($page['main']); ?>
        <!-- /main content -->

        <!-- chat panel -->
        <?php include("app/modules/user/chat_panel"); ?>
        <!-- /chat panel -->

    </section>

</div>

<!-- core scripts -->
<?php include("includes/core_scripts.inc") ?>
<!-- /core scripts -->

<!-- page level scripts -->
<?php echo $page['js']; ?>
<!-- /page level scripts -->

<!-- template scripts -->
<?php include("includes/template_scripts.inc") ?>
<!-- /template scripts -->

<!-- page script -->
<!-- <script src="js/dashboard.js"></script> -->
<?php echo $page['js_scripts']; ?>
<!-- /page script -->

</body>
<!-- /body -->

</html>
