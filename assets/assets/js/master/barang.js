var save_method; //for save method string
var table;
$(document).ready(function() {
    $(".select2").select2();

     $("#jenis_barang").change(function(){
        var id = $(this).val();
        if(id == 3){
            $("#inv").show();
            }else{
                $("#inv").hide();
            }
    })
    .change();
    //datatables
    $('.input-append.date')
        .datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd-mm-yyyy"
        });
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "/gsm/master/barang/ajax_list",
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

    table_inv = $('#table_inv').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "/gsm/master/barang/ajax_list/1",
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

    $('#btnTambahSatuan').on('click', function(){
    $(document).find("select.select2").select2();
    $.ajax({
         url:"/gsm/master/barang/get_satuan/",
         success: function(response){
         $("#satuan-lain").append(response);
         },
         dataType:"html"
     });
    });

    //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
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
    $('#form')[0].reset(); // reset form on modals
    //$("#attachment").hide();
    //$("#file").show();
    $('#is_update').val('0');
    $("#satuan-exist").empty();
    $("#satuan-lain").empty();
    $('.form-group').removeClass('has-error'); // clear error class
    $("#btnTambahSatuan").trigger({ type: "click" });
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Data Barang'); // Set Title to Bootstrap modal title
}

function add_user_inv()
{
    $('#form_inv')[0].reset(); // reset form on modals
    //$("#attachment").hide();
    //$("#file").show();
    $('#is_update').val('0');
    $("#satuan-exist").empty();
    $("#satuan-lain").empty();
    $('.form-group').removeClass('has-error'); // clear error class
    $("#btnTambahSatuan").trigger({ type: "click" });
    $('.help-block').empty(); // clear error string
    $('#modal_form_inv').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Data Barang'); // Set Title to Bootstrap modal title
}

function edit_user(id)
{
    save_method = 'update';
    $("#satuan-exist").empty();
    $("#satuan-lain").empty();
    $('#form')[0].reset(); // reset form on modals
    $('#is_update').val('1');
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    //Ajax Load data from ajax
    $.ajax({
        url : "barang/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            //var satuan = data.satuan.split(",");
            $('[name="id"]').val(data.data.id);
            $('[name="kode"]').val(data.data.kode);
            $('[name="title"]').val(data.data.title);
            $('[name="alias"]').val(data.data.alias);
            $('[name="merk"]').val(data.data.merk);
            $('[name="catatan"]').text(data.data.catatan);
           
            $('[name="jenis_barang_id"]').select2().select2('val',data.data.jenis_barang_id);
            
            //$('[name="satuan_id"]').select2().select2('val',data.data.satuan_id);
            $('[name="satuan"]').select2().select2('val',data.data.satuan);
            $('[name="satuan_laporan"]').select2().select2('val',data.data.satuan_laporan);
            /*
            if(data.data.attachment != ''){
                $("#attachment").html(data.data.attachment+"<button onclick='removeFile()' type='button' class='btn btn-danger btn-small' title='Remove File'><i class='fa fa-remove'></i></button>");
                $("#attachment").show();
            }else{
                $("#file").show();
            }
            */
            if(data.data.jenis_barang_id == 3){
                $("#inv").show();
                 $('[name="tgl"]').val(data.inv.tgl);
            $('[name="harga"]').val(data.inv.harga);
            $('[name="penyusutan"]').val(data.inv.penyusutan);
            $('[name="jenis_barang_inventaris_id"]').select2().select2('val',data.inv.jenis_barang_inventaris_id);
            }else{
                $("#inv").hide();
            }
            if(data.data.photo != ''){
            $("#photo").attr("src", "http://"+window.location.host+"/gsm/uploads/barang/"+data.data.id+"/"+data.data.photo);
            }else{
            $("#photo").attr("src", "http://"+window.location.host+"/gsm/assets/assets/images/no-image-mid.png");    
            }
            drawSatuan(data.data.id);
            //drawSatuan(satuan);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Ubah Data Barang'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function edit_user_inv(id)
{
    save_method = 'update';
    $("#satuan-exist").empty();
    $("#satuan-lain").empty();
    $('#form_inv')[0].reset(); // reset form on modals
    $('#is_update').val('1');
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    //Ajax Load data from ajax
    $.ajax({
        url : "barang/ajax_edit_inv/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            //var satuan = data.satuan.split(",");
            $('[name="id"]').val(data.id);
            $('[name="kode"]').val(data.kode);
            $('[name="title"]').val(data.title);
            $('[name="alias"]').val(data.alias);
            $('[name="merk"]').val(data.merk);
            $('[name="catatan"]').text(data.catatan);
            $('[name="jenis_barang_inventaris_id"]').select2().select2('val',data.jenis_barang_id);
            //$('[name="satuan_id"]').select2().select2('val',data.satuan_id);
            $('[name="satuan"]').select2().select2('val',data.satuan);
            $('[name="satuan_laporan"]').select2().select2('val',data.satuan_laporan);
            /*
            if(data.attachment != ''){
                $("#attachment").html(data.attachment+"<button onclick='removeFile()' type='button' class='btn btn-danger btn-small' title='Remove File'><i class='fa fa-remove'></i></button>");
                $("#attachment").show();
            }else{
                $("#file").show();
            }
            */
            if(data.photo != ''){
            $("#photo").attr("src", "http://"+window.location.host+"/gsm/uploads/barang/"+data.id+"/"+data.photo);
            }else{
            $("#photo").attr("src", "http://"+window.location.host+"/gsm/assets/assets/images/no-image-mid.png");    
            }
            drawSatuan(data.id);
            //drawSatuan(satuan);
            $('#modal_form_inv').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Ubah Data Barang'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
 
function drawSatuan(data) {
        $("#satuan-exist").load('barang/loadsatuanexist/'+data);
} 
/* 
function drawSatuan(data) {
    for (var i = 0; i < data.length; i++) {
        $("#satuan-exist").append("<input type='hidden' class='form-control' value='"+data[i]+"' name='satuan[]' readonly><input type='text' class='form-control' value='"+getSatuanTitle(data[i])+"' readonly><br/>");
    }
} */

function getSatuanTitle(id)
{
    var r ="";
    $.ajax({
        url : "barang/get_satuan_title/" + id,
        type: "GET",
        async: false,
        dataType: "JSON",
        success: function(data)
        {
            r = data.value;
        }
    });

    return r;
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
        url = "barang/ajax_add";
    } else {
        url = "barang/ajax_update";
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
            url : "barang/ajax_delete/"+id,
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