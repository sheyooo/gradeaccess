<?php 
    $page['title'] = "All students' scores English and Maths";
    $page['css'] = "<link rel=\"stylesheet\" href=\"plugins/chosen/chosen.min.css\">
    <link rel=\"stylesheet\" href=\"plugins/datatables/jquery.dataTables.css\">
    <link rel=\"stylesheet\" href=\"plugins/datepicker/datepicker.css\">";
    $page['main'] = "app/modules/admin/a_assessment";
    $page['js'] = "<script src=\"plugins/chosen/chosen.jquery.min.js\"></script>
<script src=\"plugins/datatables/jquery.dataTables.js\"></script>";
    $page['js_scripts'] = "<script src=\"js/bootstrap-datatables.js\"></script>
<script src=\"js/datatables.js\"></script>
<script src=\"js/print-content.js\"></script>";

    include("app/admin/admin_page.php");


?>
