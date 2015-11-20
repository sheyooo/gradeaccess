var demoButtons = function () {
    return {
        init: function () {
            $(".ajax_behaviour").on("click", function () {
                var btn = $(this);
                btn.button("loading");

                $.ajax({
                    type: "POST",
                    url: "process/workers/ajax_update_behaviour.php",
                    dataType: "text",
                    data: {
                        studId: btn.attr("id"),
                        behaviour: $("input#input" + btn.attr("id")).val(),
                        type: $("input#check" + btn.attr("id")).bootstrapSwitch('state'),
                    },
                    success: function (response) {
                        //alert(response);
                        if($("input#check" + btn.attr("id")).bootstrapSwitch('state') === false){
                            btn.addClass("btn-danger");                            
                            $("#behaviour_panel" + btn.attr("id")).addClass("panel-danger");
                            btn.removeClass("btn-success");
                            $("#behaviour_panel" + btn.attr("id")).removeClass("panel-success");
                            
                        } else{
                            btn.addClass("btn-success");
                            $("#behaviour_panel" + btn.attr("id")).addClass("panel-success");
                            btn.removeClass("btn-danger");
                            $("#behaviour_panel" + btn.attr("id")).removeClass("panel-danger");
                            
                        }
                        /*console.log(btn);
                        console.log(btn.attr("id"));
                        console.log($("input#check" + btn.attr("id")).bootstrapSwitch('state'));*/
                    },
                    error: function (response) {
                        alert("Please check your internet connection");
                    },
                    complete: function () {
                        btn.button("reset");
                    }

                });
            });
        }
    };
}();

$(function () {
    "use strict";
    demoButtons.init();
});