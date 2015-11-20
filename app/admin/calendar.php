<?php 
    $page['title'] = ">Add and create events that are coming up in the school";
    $page['css'] = "<link rel=\"stylesheet\" href=\"plugins/fullcalendar/fullcalendar.css\">";
    $page['main'] = "app/modules/admin/calendar";
    $page['js'] = "<script src=\"plugins/moment.js\"></script>
    <script src=\"plugins/jquery-ui.custom.min.js\"></script>
    <script src=\"plugins/fullcalendar/fullcalendar.min.js\"></script>";
    $page['js_scripts'] = "<script src=\"js/calendar.js\"></script>";

    include("app/admin/admin_page.php");


?>
