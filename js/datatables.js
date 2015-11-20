var demoDataTables = function () {
    return {
        init: function () {
            $('.datatable').dataTable({
                "sPaginationType": "bootstrap",
                "lengthMenu": [[ 50, 100, -1 ], [50, 100, "All"]]
            });

            $('.chosen').chosen({
                width: "80px"
            });
        }
    };
}();

$(function () {
    "use strict";
    demoDataTables.init();
});