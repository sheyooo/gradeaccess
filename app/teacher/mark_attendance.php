<?php 
    $page['title'] = "Mark the Daily attendance of your Class";
    $page['css'] = "<link rel=\"stylesheet\" type=\"text/css\" href=\"plugins/bootstrap-switch/bootstrap-switch.min.css\">";
    $page['main'] = "app/modules/teacher/mark_att";
    $page['js'] = "<script src=\"plugins/bootstrap-switch/bootstrap-switch.min.js\"></script>";
    $page['js_scripts'] = "<script src=\"js/bootstrap-switch-init-attendance.js\"></script>";

    include("app/teacher/teacher_page.php");


?>