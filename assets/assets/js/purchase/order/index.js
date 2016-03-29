var save_method; //for save method string
var table;
$(document).ready(function() {

    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "/gsm/purchase/order/ajax_list",
            "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [0, -1, -2, -3, -4, -5], //last column
            "orderable": false, //set not orderable
        },
        { "sClass": "text-center", "aTargets": [-1, -2, -3, -4, -5] }
        ],
    });
});


function cantPrint(){
    alert("PO Belum Di Approve");
}

    function delete_user(id)
    {
        if(confirm('Are you sure delete this data?'))
        {
            // ajax delete data to database
            $.ajax({
                url : "/gsm/purchase/order/ajax_delete/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    //if success reload ajax table
                    reload_table();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });

        }
    }
    function reload_table()
    {
        table.ajax.reload(null,false); //reload datatable ajax 
    }