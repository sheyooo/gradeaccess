<?php 
    $page['title'] = "Add or Edit Students in your Class";
    $page['css'] = "<link rel=\"stylesheet\" href=\"plugins/chosen/chosen.min.css\">
                    <link rel=\"stylesheet\" href=\"plugins/datatables/jquery.dataTables.css\">
                    <link rel=\"stylesheet\" href=\"plugins/datepicker/datepicker.css\">";
    $page['main'] = "app/modules/teacher/t_add_s";
    $page['js'] = "<script src=\"plugins/chosen/chosen.jquery.min.js\"></script>
                    <script src=\"plugins/datatables/jquery.dataTables.js\"></script>
                    <script src=\"plugins/datepicker/bootstrap-datepicker.js\"></script>
                    <script src=\"plugins/parsley.min.js\"></script>";
    $page['js_scripts'] = "<script src=\"js/bootstrap-datatables.js\"></script>
                            <script src=\"js/table-edit-teacher-students.js\"></script>
                            <script src=\"js/pickers.js\"></script>";

    include("app/teacher/teacher_page.php");


?>