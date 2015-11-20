var editableTable = function () {

    var nEditing = null;

    var oTable;
    var create;

    function events() {

        $(document).on("click", "#new", function (e) {
            e.preventDefault();

            var aiNew = oTable.fnAddData(['', '', '', '', '',
                '<a class="edit" href="">Edit</a>', '<a class="delete" href="">Delete</a>']);
            var nRow = oTable.fnGetNodes(aiNew[0]);
            editRow(oTable, nRow);
            nEditing = nRow;
        });

        $('.datatable').on("click", "a.delete", function (e) {
            e.preventDefault();

            var confirmDel = confirm("Are you sure you want to delete this row?");
            if (confirmDel == true) {

                var nRow = $(this).parents('tr')[0];
                oTable.fnDeleteRow(nRow);
                $.ajax({
                    type: "POST",
                    url: "process/workers/ajax_add_student.php",
                    dataType: "text",
                    data: {
                        action: "delete",
                        id: $(this).attr("id")
                    },
                    success: function (response) {

                    }
                })

            } else {

            }

        });

        $('.datatable').on("click", "a.edit", function (e) {
            e.preventDefault();
            var guid = $(this).attr("id");


            /* Get the row as a parent of the link that was clicked on */
            var nRow = $(this).parents('tr')[0];
            if (nEditing !== null && nEditing !== nRow) {
                /* Currently editing - but not this row - restore the old before continuing to edit mode */
                restoreRow(oTable, nEditing);
                editRow(oTable, nRow);
                nEditing = nRow;
            } else if (nEditing === nRow && this.innerHTML === "Save") {
                /* Editing this row and want to save it */
                saveRow(oTable, nEditing);
                nEditing = null;
            } else {
                /* No edit in progress - let's start one */
                editRow(oTable, nRow);
                nEditing = nRow;
            }
            return false;

        });


    }

    function restoreRow(oTable, nRow) {
        var aData = oTable.fnGetData(nRow);
        var jqTds = $('>td', nRow);

        for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
            oTable.fnUpdate(aData[i], nRow, i, false);
        }

        oTable.fnDraw();
    }

    function editRow(oTable, nRow) {
        var aData = oTable.fnGetData(nRow);
        var jqTds = $('>td', nRow);
        jqTds[0].innerHTML = '<input type="text" class="form-control" value="' + aData[0] + '">';
        jqTds[1].innerHTML = '<input type="text" class="form-control" value="' + aData[1] + '">';
        jqTds[2].innerHTML = '<input type="text" class="form-control" value="' + aData[2] + '">';
        jqTds[3].innerHTML = '<input type="text" class="form-control" value="' + aData[3] + '">';
        jqTds[4].innerHTML = '<input type="text" class="form-control datepicker" value="' + aData[4] + '">';
        jqTds[5].innerHTML = '<a class="edit" href="">Save</a>';

        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '-20y'
        });

    }

    function saveRow(oTable, nRow) {
        var jqInputs = $('input', nRow);
        oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
        oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
        oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
        oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
        oTable.fnUpdate(jqInputs[4].value, nRow, 4, false);

        $.ajax({
            type: "POST",
            url: "process/workers/ajax_add_student.php",
            dataType: "text",
            data: {
                action: "insert",
                studId: (nRow.getAttribute("id")),
                regId: jqInputs[0].value,
                firstName: jqInputs[1].value,
                lastName: jqInputs[2].value,
                sex: jqInputs[3].value,
                dob: jqInputs[4].value
            },
            success: function (response) {
                $(this).attr("id", response);
                //alert(response);
            }
        })


        oTable.fnUpdate('<a class="edit" id=" ' + response + ' " href="">Edit</a>', nRow, 5, false);
        oTable.fnDraw();

    }

    function plugins() {
        oTable = $('.datatable').dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-6'l <'toolbar'>><'col-xs-6'f>r>t<'datatable-bottom'<'pull-left'i><'pull-right'p>>",
            "lengthMenu": [[ 50, 100, -1 ], [50, 100, "All"]]
        });


        $(".toolbar").append('<a id="new" href="javascript:;" class="btn btn-primary mb15 ml15">Add new Student</a>');

        $('.chosen').chosen({
            width: "80px"
        });
    }

    return {
        init: function () {
            events();
            plugins();
        }
    };
}();

$(function () {
    "use strict";
    var guid;
    editableTable.init();
});