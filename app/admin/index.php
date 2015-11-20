<?php 
    $page['title'] = "Overview of the School ";
    $page['css'] = "";
    $page['main'] = "app/modules/admin/index";
    $page['js'] = "
        <script src=\"plugins/count-to/jquery.countTo.js\"></script>
        <script src=\"plugins/flot/jquery.flot.js\"></script>
        <script src=\"plugins/flot/jquery.flot.categories.js\"></script>";
    $page['js_scripts'] = "<script src=\"js/general.js\"></script>
        <script src=\"js/chart-admin.js\"></script>";

    include("app/admin/admin_page.php");


?>
