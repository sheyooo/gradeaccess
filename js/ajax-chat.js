$(document).ready(function() {
    var msgCount = 0;
    var chat_id = $("div#chat_id").data("ch-id");


    var highest = $(".chatbox-user:last-child").attr('id');
    $.cookie(chat_id, highest);
    //alert($("div#chat_id").data("last-mes"));

    $("div.wrapper").animate({
        scrollTop: $("div.wrapper")[0].scrollHeight
    }, 1);

    function getLastChatID() {
        //filtered by class, but you could loop all elements
        var this_id;
        $(".chatbox-user").each(function(i, v) {
            this_id = parseInt($(this).attr('id'));
            if (this_id > highest) {
                highest = this_id;
            }
        });
        return highest;
    }

    function ajax_getLastChat() {

        var chat_id = $("div#chat_id").data("ch-id");

        $.ajax({
            type: "POST",
            url: "process/workers/ajax_chat.php",
            dataType: "text",
            data: {
                action: 'check_chat',
                chat_id: chat_id,
                lastChat: getLastChatID,
            },
            success: function(response) {
                //alert(response);
                if (response.length !== 0) {
                    $('.chat-box').append(response);
                    $("div.wrapper").animate({
                        scrollTop: $("div.wrapper")[0].scrollHeight
                    }, 500);
                    //alert(response);
                }


            },
            error: function(response) {
                alert("Your internet connections seems unstable");
            },
            complete: function() {
                setTimeout(ajax_getLastChat, 5000);
            }

        });
    }

    function sendToDb() {
        var btn = $(this);
        var chat = $.trim($("#chat-box").val());
        $("#chat-box").val("");

        var chat_id = $("div#chat_id").data("ch-id");

        if (chat.length !== 0) {

            msgCount++;
            var ts = Math.round((new Date()).getTime() / 1000);

            var latestChat = "<div id='temp" + msgCount + "' class='animated fadeIn chatbox-user'>" +
                "<a href='javascript:;' class='chat-avatar pull-left'>" +
                "    <img src='img/faceless.jpg' class='img-circle' title='user name' alt=''>" +
                "</a>" +
                "<div class='message'>" +
                "    <div class='panel'>" +
                "        <div class='panel-body'>" +
                "           <p>" +
                chat +
                "           </p>" +
                "        </div>" +
                "</div>" +
                "<small class='chat-time'>" +
                "   <i class='ti-time mr5'></i>" +
                "   <span data-livestamp=" + ts + "></span>" +
                "   <i class='ti-check text-success'></i>" +
                "</small>" +
                "<div>";

            $('.chat-box').append(latestChat);
            $("div.wrapper").animate({
                scrollTop: $("div.wrapper")[0].scrollHeight
            }, 500);

            $.ajax({
                type: "POST",
                url: "process/workers/ajax_chat.php",
                dataType: "text",
                data: {
                    action: 'send_chat',
                    chat_id: chat_id,
                    message: chat,
                },
                success: function(response) {
                    $(".chatbox-user#temp" + msgCount).attr("id", response);
                    $.cookie(chat_id, response);
                    //alert(response);
                },
                error: function(response) {
                    $("#chat-box").val(chat);
                }

            });
        }

    }

    ajax_getLastChat();

    /*Function if enter key is pressed*/
    $('#chat-box').keyup(function(e) {
        var key = e.which;
        if (key == 13) // the enter key code
        {
            sendToDb();
            return false;
        }
    });

    $("#chat-send").click(function() {
        sendToDb();
    });

});
