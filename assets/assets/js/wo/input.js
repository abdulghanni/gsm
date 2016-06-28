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

    $('.harga')
    // event handler
    .change(resizeInput)
    // resize on page load
    .each(resizeInput);

    function resizeInput() {
        $(this).attr('size', $(this).val().length);
    }

    $('#btnAdd').on('click', function () {
        $(document).find("select.select2").select2({
            dropdownAutoWidth : true
        });
        $('#btnRemove').show();
        $('#btnSubmit').show("slow");
        $('#panel-total').show("slow");
    });

    $('#dibayar, #biaya_pengiriman').maskMoney({allowZero:true});

    $("#btnDraft").on('click', function(){
        $.ajax({
            url : '/gsm/purchase/request/add_draft',
            type: "POST",
            data: $('#form-pr').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                if(data.status) //if success close modal and reload ajax table
                {
                    window.location.href = '/gsm/purchase/request/';
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