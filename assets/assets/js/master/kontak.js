var save_method; //for save method string
var table;
$(document).ready(function() {
    $(".select2").select2();
    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "/gsm/master/kontak/ajax_list",
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

    //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

    $("#kode").change(function() {
        var kode = $(this).val();
    })
    .change();
});

//Ajax Crud
function add_user()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add kontak'); // Set Title to Bootstrap modal title
}

function edit_user(id)
{
    window.location.href="/gsm/master/kontak/edit/"+id;
}

function detail_user(id)
{
    
    $("#alamat-lain").empty();
    $("#telepon-lain").empty();
    $("#up-lain").empty();
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "/gsm/master/kontak/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            var telepon = data.telepon.split(","),
                alamat = data.alamat.split(","),
                up = data.up.split(",");
            $('[name="id"]').val(data.id);
            $('[name="kode"]').val(data.kode);
            $('[name="title"]').val(data.title);
            $('[name="tipe"]').val(data.tipe);
            $('[name="jenis"]').val(data.jenis);
            $('[name="email"]').val(data.email);
            $('[name="fax"]').val(data.fax);
            $('[name="npwp"]').val(data.npwp);
            $('[name="alamat_pajak"]').val(data.alamat_pajak);
            $('[name="bank"]').val(data.bank);
            $('[name="no_rekening"]').val(data.no_rekening);
            $('[name="a_n"]').val(data.a_n);
            $('[name="acc"]').val(data.acc);
            $('[name="catatan"]').text(data.catatan);
            drawTelepon(telepon);
            drawAlamat(alamat);
            drawUp(up);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Detail Kontak'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function drawTelepon(data) {
    for (var i = 0; i < data.length; i++) {
        $("#telepon-lain").append("<input type='text' class='form-control' value='"+data[i]+"' disabled><br/>");
    }
}

function drawAlamat(data) {
    for (var i = 0; i < data.length; i++) {
        $("#alamat-lain").append("<textarea class='form-control' disabled>"+data[i]+"</textarea><br/>");
    }
}

function drawUp(data) {
    for (var i = 0; i < data.length; i++) {
        $("#up-lain").append("<input type='text' class='form-control' value='"+data[i]+"' disabled><br/>");
    }
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
        url = "/gsm/master/kontak/ajax_add";
    } else {
        url = "/gsm/master/kontak/ajax_update";
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

function delete_user(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "/gsm/master/kontak/ajax_delete/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}