<?php 
    $page['title'] = "School rules and regulations";
    $page['css'] = "<link rel=\"stylesheet\" href=\"plugins/summernote/dist/summernote.css\">";
    $page['main'] = "app/modules/admin/a_rules";
    $page['js'] = "<script src=\"plugins/summernote/dist/summernote.min.js\"></script>";
    $page['js_scripts'] = "<script src=\"js/general.js\"></script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 500
        });
        $('.note-toolbar').addClass('ml0');
        $('.note-toolbar').append('<div class=\"note-style btn-group\">' +
                                        '<a href=\"javascript:;\" class=\"btn btn-primary\" id=\"summersavebtn\">Save!</a>'+
                                    '</div>');
        //alert($('#summernote').code());

        //WHEN SAVE BUTTON IS CLICKED

        $('#summersavebtn').click(function() {
            //alert( $('#summernote').code());

            $.ajax({
                type: 'POST',
                url: 'process/workers/ajax_summernote_save.php',
                dataType: 'text',
                data: {
                    action: 'save_rules',
                    data: $('#summernote').code()
                },
                success: function (response) {
                    alert(response);

                    //var data = $.parseJSON(response);
                },
                error: function (response) {

                }
            });
        });
    });
</script>";

    include("app/admin/admin_page.php");


?>
