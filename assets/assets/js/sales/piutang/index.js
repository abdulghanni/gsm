var save_method; //for save method string
var table;
$(document).ready(function() {
    $(".select2").select2();
    $("#no").change(function(){
        var id = $(this).val();
        if(id!=0)getDetail(id);
    })
    .change();

    function getDetail(id)
    {
        $.ajax({
            type: 'POST',
            url: '/gsm/sales/piutang/get_no_detail/',
            data: {id : id},
            dataType: "JSON",
            success: function(data) {
                $('#kontak').val(data.kontak);
                $('#kontak_label').show();
                $('#kurensi').val(data.kurensi);
                $('#kurensi_label').show();
                $('#jatuh_tempo').val(data.jatuh_tempo);
                $('#jatuh_tempo_label').show();
            }
        });
    }

    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "piutang/ajax_list",
            "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [-1], //last column
            "orderable": false, //set not orderable
        },
        { "sClass": "text-center", "aTargets": [-1] }
        ],
    });
});

//Ajax Crud
function add_user()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Pembayaran Hutang'); // Set Title to Bootstrap modal title
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "piutang/ajax_add";
    } else {
        url = "piutang/ajax_update";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
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