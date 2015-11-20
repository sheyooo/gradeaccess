$(document).ready(function() {
    var check_notif_msgCount = 0;
    var current_count = 0;
    //alert($("div#chat_id").data("last-mes"));

    toastr.options = {
        "closeButton": false,
        "debug": false,
        "progressBar": true,
        "positionClass": "toast-bottom-left",
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "15000",
        "extendedTimeOut": "5000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    function ajaxCheckNotif() {

        $.ajax({
            type: "POST",
            url: "process/workers/ajax_chat.php",
            dataType: "text",
            data: {
                action: 'notification',
            },
            success: function(response) {
                //alert(response);
                var data;

                if (response) {
                    data = $.parseJSON(response);
                    if (data[0].count > 0 & data[0].count != current_count) {
                        var notifications = "";


                        data.forEach(function(i) {
                            current_count = i.count;
                            message = i.message;
                            //alert();
                            //console.log(data[0]);
                            //console.log(i);
                            var link = "<a href=" + i.url + "></a>";
                            toastr.info("<a href=" + i.url + ">from: " + i.name, i.message + "</a>");
                            $('div#toast-container').wrap(link);

                            notifications += "<li class=\"list-group-item\"> " +
                                "    <a href=\"message.php?chat_id=" + i.id + "\">" +
                                "        <span class=\"pull-left mt5 mr15\">" +
                                "            <img src=\"" + i.img + "\" class=\"avatar avatar-sm img-circle\" alt=\"\">" +
                                "        </span>" +
                                "        <div class=\"m-body\">" +
                                "            <div class=\"\">" +
                                "                <small class=\"text-uppercase\" ><b>" + i.name + "</b></small>" +
                                "            </div>" +
                                "            <span>" + i.message + "</span>" +
                                "            <span data-livestamp=\"" + i.timestamp + "\" class=\"time small\"></span>" +
                                "        </div>" +
                                "    </a>" +
                                "</li>";


                            $('li.notifications a#notif-drop').append("<div class='badge badge-top bg-danger animated rubberBand'> " +
                                "       <span>" + i.count + "</span>" +
                                "  </div>");
                        });

                        $('div.dropdown-menu ul.list-group').empty();
                        $('div.dropdown-menu ul.list-group').removeClass("text-center p10");
                        $('div.dropdown-menu ul.list-group').append(notifications);
                        $('ul.dropdown-menu li a div.badge').html(data[0].count);
                        $('audio#sound-notification')[0].play();
                    }
                }

            },
            error: function(response) {
                //setTimeout(ajaxCheckNotif(), 1000);

            },
            complete: function() {
                //alert("complete");
                //toastr.info("<a href='test.html'>test</a>");
                setTimeout(function() {
                    ajaxCheckNotif();
                }, 2000);
                //$.wait(6000).console.log("b");

            }

        });
    }

    ajaxCheckNotif();


});
