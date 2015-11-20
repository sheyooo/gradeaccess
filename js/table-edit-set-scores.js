var editableTable = function() {

    var nEditing = null;

    var oTable;
    var create;

    function events() {

        $(document).on("click", "#new", function(e) {
            e.preventDefault();

            var aiNew = oTable.fnAddData(['', '', '', '', '',
                '<a class="edit" href="">Edit</a>', '<a class="delete" href="">Delete</a>'
            ]);
            var nRow = oTable.fnGetNodes(aiNew[0]);
            editRow(oTable, nRow);
            nEditing = nRow;
        });

        $('.datatable').on("click", "a.delete", function(e) {
            e.preventDefault();

            var confirmDel = confirm("Are you sure you want to delete this row?");
            if (confirmDel === true) {

                var nRow = $(this).parents('tr')[0];
                oTable.fnDeleteRow(nRow);
                $.ajax({
                    type: "POST",
                    url: "process/workers/ajax_set_scores.php",
                    dataType: "text",
                    data: {
                        action: "delete",
                        id: nRow.getAttribute("id")
                    },
                    success: function(response) {
                        alert("Deleted");
                    }
                });

            } else {

            }

        });

        $('.datatable').on("click", "a.edit", function(e) {
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
                var save = saveRow(oTable, nEditing);
                if (save) {
                    nEditing = null;
                }
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

        for (i = 0; i < jqTds.length; i++) {
            if (i !== 0 & i != 1 & i != jqTds.length - 1 & i != jqTds.length - 2) {
                jqTds[i].innerHTML = '<input type="text" class="form-control no-p" value="' + aData[i] + '">';
            }
        }

        jqTds[jqTds.length - 2].innerHTML = '<a class="edit" href="">Save</a>';
    }

    function saveRow(oTable, nRow) {
        var jqInputs = $('input', nRow);
        var scores = "";
        var response;


        year = decodeURI(nRow.getAttribute("data-year"));
        term = decodeURI(nRow.getAttribute("data-term"));

        function checkInvalidFields() {
            //TO CHECK FOR INVALID FIELDS
            var noNullSendToDb = true;

            for (i = 1; i < jqInputs.length; i++) {

                var s = jqInputs[i].value;
                //console.log(s + " ");

                if (s === "" || s > 100 || s < -3 || isNaN(s)) {
                    noNullSendToDb = false;
                    //console.log("reach");
                }
            }
            return noNullSendToDb;
        }

        if (checkInvalidFields()) {

            //IF NO INVALID FIELDS SAVE THE DATA
            for (i = 1; i < jqInputs.length; i++) {
                oTable.fnUpdate(jqInputs[i].value, nRow, i + 2, false);
                scores = scores + jqInputs[i].value + ",";
            }


            $.ajax({
                type: "POST",
                url: "process/workers/ajax_set_scores.php",
                dataType: "text",
                data: {
                    action: "set",
                    assID: nRow.getAttribute("id"),
                    student: nRow.getAttribute("data-stud-id"),
                    year: year,
                    term: term,
                    scores: scores,
                },
                success: function(response) {
                    alert(response);
                    nRow.attr('id', response);
                    //alert(year);
                    alert("Saved");
                    console.log(response);
                    oTable.fnUpdate('<a class="edit" id=" ' + response + ' " href="">Edit</a>', nRow, jqInputs.length + 2, false);
                    oTable.fnDraw();
                }
            });


            return true;
        } else {
            alert("No subjects may contain letters or be greater than 100 or less than -3");
            return false;
        }
    }

    function plugins() {
        oTable = $('.datatable').dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-6'l <'toolbar'>><'col-xs-6'f>r>t<'datatable-bottom'<'pull-left'i><'pull-right'p>>",
            "lengthMenu": [
                [50, 100, -1],
                [50, 100, "All"]
            ]
        });

        //$(".toolbar").append('<a id="new" href="javascript:;" class="btn btn-primary mb15 ml15">Add new row</a>');

        $('.chosen').chosen({
            width: "80px"
        });
    }

    return {
        init: function() {
            events();
            plugins();
        }
    };
}();

$(function() {
    "use strict";
    var guid;
    editableTable.init();
});
