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

function showModal(id)
{
    $('#form-delete')[0].reset();
    $('[name="id"]').val(id);
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Batalkan order'); // Set Title to Bootstrap modal title

}

function del()
{
    $('#btnSave').text('Deleting'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url = "/gsm/purchase/order/ajax_delete/";;

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form-delete').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

    function reload_table()
    {
        table.ajax.reload(null,false); //reload datatable ajax 
    }