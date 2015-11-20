<?php 
    $page['title'] = "Set Exam scores of students in your class";

    $page['css'] = "<link rel=\"stylesheet\" href=\"plugins/chosen/chosen.min.css\">
                    <link rel=\"stylesheet\" href=\"plugins/datatables/jquery.dataTables.css\">";

    $page['main'] = "app/modules/teacher/set_scores";

    $page['js'] = "<script src=\"plugins/chosen/chosen.jquery.min.js\"></script>
                    <script src=\"plugins/datatables/jquery.dataTables.js\"></script>";

    $page['js_scripts'] = "<script src=\"js/bootstrap-datatables.js\"></script>
                            <script src=\"js/table-edit-set-scores.js\"></script>
                            <script src=\"js/print-content.js\"></script>";

    include("app/teacher/teacher_page.php");


?>