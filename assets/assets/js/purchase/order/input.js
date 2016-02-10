$(document).ready(function() {

    $('.input-append.date')
        .datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd-mm-yyyy"
        });

    $(".select2").select2();

    $("#list_pr").change(function(){
        $(document).find("select.select2").select2();
        var id = $(this).val();
        if(id != 0){
            $('#dari-pr').load('get_dari_pr/'+id);
        }
    })
    .change();
/*
    $("#kontak_id").change(function(){
        var id = $(this).val();
        $(document).find("select.select2").select2();
        if(id != 0)getAlamat(id);
    })
    .change();

    function getAlamat(id)
    {
        $.ajax({
            type: 'POST',
            url: '/gsm/purchase/order/alamat/'+id,
            data: {id : empId},
            success: function(data) {
                $('#alamat').html(data);
            }
        });
    }
*/
    $('#btnAdd').on('click', function () {
        $(document).find("select.select2").select2();
        $('#btnRemove').show();
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

    $('#dibayar, #biaya_pengiriman').maskMoney({allowZero:true});
});