$(document).ready(function () {

        $(".bSwitch").bootstrapSwitch({
            onColor: 'success',
            offColor: 'danger'
        });

    $('input.bSwitch').on('switchChange.bootstrapSwitch', function(event, state) {

        $.ajax({
            type: "POST",
            url: "process/workers/ajax_attendance.php",
            dataType: "text",
            data: {
                studId: this.id,
                attendance: state
            },
            success: function (response) {
                //alert(response);
                //alert(state);
            },
            error: function (response) {

            }

        })




        console.log(this); // DOM element
        console.log(event); // jQuery event
        console.log(state); // true | false
    });

});