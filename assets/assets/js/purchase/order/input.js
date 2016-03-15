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
            $('#dari-pr').html('<img src="/gsm/assets/images/ajax-loader.gif"> loading...');
            $('#dari-pr').load('get_dari_pr/'+id);
            $("#add_pr").show();
        }
            getTablePr();
    })
    .change();

    function getTablePr()
    {
        var prId = '';
        $('.select_pr').each(function (index, element) {
                if($(element).val() != ''){
                    prId += $(element).val()+',';
                }
            });
        $.ajax({
            type: 'POST',
            url: '/gsm/purchase/order/get_table_pr/',
            data: {pr_id : prId},
            success: function(data) {
                //alert(data)
                $('#table-pr').html(data);
            }
        });
    }

    $('#btnAdd').on('click', function () {
        $(document).find("select.select2").select2();
        $('#btnRemove').show();
        $('#btnSubmit').show("slow");
        $('#panel-total').show("slow");
    });

    $('#add_pr').on('click', function () {
        $(document).find("select.select2").select2();
       addPr();
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

    function addPr()
    {
        $.ajax({
            type: 'POST',
            url: '/gsm/purchase/order/add_pr/',
            success: function(data) {
                $('#select_pr').append(data);
                getTablePr();
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

});