<?php 
    $page['title'] = "Choose subjects offered in your class";

    $page['css'] = "<link rel=\"stylesheet\" href=\"plugins/icheck/skins/square/blue.css\" >";

    $page['main'] = "app/modules/teacher/set_subjects";

    $page['js'] = "<script src=\"plugins/icheck/icheck.min.js\"></script>";

    $page['js_scripts'] = "
    <script>
        $(document).ready(function(){
            $('icheck').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square',
                increaseArea: '20%' // optional
            });
        });
    </script>";

    include("app/teacher/teacher_page.php");


?>