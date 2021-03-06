$(document).ready(function() {

    $('.input-append.date')
        .datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd-mm-yyyy",
        });
        
    $(".select2").select2();

    $("#tanggal_faktur").datepicker("setDate", new Date());
    $("#tanggal_pengiriman").datepicker("setDate", new Date());

    $("#list_po").change(function(){
        var id = $(this).val();
        if(id != 0){
            $('#dari-po').load('get_dari_po/'+id);
        }
    })
    .change();

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
        $(document).find("select.select2").select2();
        $('#btnRemove').show("slow");
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