<?php
$main = null;

if(Tools::valueGet("action") == ""){
    $main = "app/modules/admin/news";
}elseif(Tools::valueGet("action") == "create"){
    $main = "app/modules/admin/create_news";
}

    $page['title'] = "Manage Newsletter";
    $page['css'] = "<link rel=\"stylesheet\" href=\"plugins/summernote/dist/summernote.css\">";
    $page['main'] = $main;
    $page['js'] = "<script src=\"plugins/summernote/dist/summernote.min.js\"></script>";
    $page['js_scripts'] = "<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 500
        });
        $('.note-toolbar').addClass('ml0');
        $('.note-toolbar').append('<div class=\'note-style btn-group\'>' +
        '<a href=\'javascript:;\' class=\'btn btn-primary\' data-loading-text=\'Saving...\' id=\'summersavebtn\'>Save!</a>'+
        '</div>');
        //alert($('#summernote').code());

        //WHEN SAVE BUTTON IS CLICKED
        var action;

        if($('div#summernote').data('news-id') == 'new'){
            action = 'create_news';
        } else{
            action = 'save_news';
        }

        $('#summersavebtn').click(function() {
            //alert( $('#summernote').code());
            $('#summersavebtn').button('loading');
            $.ajax({
                type: 'POST',
                url: 'process/workers/ajax_summernote_save.php',
                dataType: 'text',
                data: {
                    action: action,
                    id: $('div#summernote').data('news-id'),
                    title: $('input#title').val(),
                    content: $('#summernote').code()
                },
                success: function (response) {
                    alert(response);
                    $('#summersavebtn').button('reset');
                    //var data = $.parseJSON(response);
                },
                error: function (response) {
                    $('#summersavebtn').button('reset');
                    alert('An error occurred, please save again or check your internet connection!');
                }
            });
        });
    });
</script>";

    include("app/admin/admin_page.php");


?>
