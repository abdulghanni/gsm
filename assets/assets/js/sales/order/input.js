$(document).ready(function() {

    $('.input-append.date')
        .datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd-mm-yyyy"
        });

    $('.select2').select2({
        dropdownAutoWidth : true
    });

function resizeInput() {
    $(this).attr('size', $(this).val().length);
}

$('input[type="checkbox"]').on('change', function(e){
        if($(this).prop('checked'))
        {
            $(this).next().val(1);
            //$(this).next().disabled = true;
        } else {
            $(this).next().val(0);
            //$(this).next().disabled = true;
        }
    });

$('input[type="text"]')
    // event handler
    .change(resizeInput)
    // resize on page load
    .each(resizeInput);

    $("#kontak_id").change(function(){
        var id = $(this).val();
        if(id != 0)getAlamat(id);
        if(id != 0)getUp(id);
    })
    .change();

    function getAlamat(id)
    {
        $.ajax({
            type: 'POST',
            url: '/gsm/purchase/order/get_alamat/'+id,
            data: {id : id},
            success: function(data) {
                $('#alamat').html(data);
            }
        });
    }

    function getUp(id)
    {
        $.ajax({
            type: 'POST',
            url: '/gsm/purchase/order/get_up/'+id,
            data: {id : id},
            success: function(data) {
                $('#up').html(data);
            }
        });
    }

    $('#btnAdd').on('click', function () {
        $(document).find("select.select2").select2({
    dropdownAutoWidth : true
});
        //$('#remove').show("slow");
        $('#btnSubmit').show("slow");
        $('#panel-total').show("slow");
    });

    $('input:radio[name=metode_pembayaran_id]').click(function() {
      var val = $('input:radio[name=metode_pembayaran_id]:checked').val();
      if(val==1){
        $('#kredit').hide("slow");
        $('#total_angsuran').hide("slow");
      }else{
        $('#kredit').show("slow");
        $('#total_angsuran').show("slow");
      }
    });

    $('#lama_angsuran_2').change(function(){
        var text = $(this).val();
        $('#angsuran').text('/'+text.toUpperCase());
    })
    .change();

    $('#dibayar, #biaya_pengiriman, .harga').maskMoney({allowZero:true});

    $("#btnDraft").on('click', function(){
        $.ajax({
            url : '/gsm/sales/order/add_draft',
            type: "POST",
            data: $('#form-so').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                if(data.status) //if success close modal and reload ajax table
                {
                    window.location.href = '/gsm/sales/order/';
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 

            }
        });
    })
});


    function saveKontak()
{
    $('#btnSaveKontak').text('saving...'); //change button text
    $('#btnSaveKontak').attr('disabled',true); //set button disable 

    // ajax adding data to database
    $.ajax({
        url : "/gsm/master/kontak/add_json",
        type: "POST",
        data: $('#form_kontak').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modalKontak').modal('hide');
                $("#kontak_id").load("/gsm/sales/order/load_kontak");
                //reload_table();
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
            $('#btnSaveKontak').text('save'); //change button text
            $('#btnSaveKontak').attr('disabled',false); //set button enable 

        }
    });
}
