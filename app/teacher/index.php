<?php 
    $page['title'] = "Overview of your Students' behaviour in your Class - Grade Access";
    $page['css'] = "<link rel=\"stylesheet\" type=\"text/css\" href=\"plugins/bootstrap-switch/bootstrap-switch.min.css\">";
    $page['main'] = "app/modules/teacher/t_index";
    $page['js'] = "<script src=\"plugins/bootstrap-switch/bootstrap-switch.min.js\"></script>";
    $page['js_scripts'] = "<script src=\"js/buttons.js\"></script>
                            <script src=\"js/bootstrap-switch-init.js\"></script>";

    include("app/teacher/teacher_page.php");


?>