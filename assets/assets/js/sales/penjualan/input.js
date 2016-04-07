$(document).ready(function() {

    $('.input-append.date')
        .datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd-mm-yyyy"
        });

    $(".select2").select2();

    $("#tanggal_faktur").datepicker("setDate", new Date());
    $("#tanggal_pengiriman").datepicker("setDate", new Date());

    $("#list_so").change(function(){
        var id = $(this).val();
        if(id != 0){
            $('#dari-so').html('<img src="/gsm/assets/images/ajax-loader.gif"> loading...');
            $('#dari-so').load('get_dari_so/'+id);
            //$("#add_so").show();
        }
        getTable();
        getTable();
    })
    .change();

    function getTable()
    {
        var id = '';
        $('.select_so').each(function (index, element) {
                if($(element).val() != ''){
                    id += $(element).val()+',';
                }
            });
        $.ajax({
            type: 'POST',
            url: '/gsm/sales/penjualan/get_table/',
            data: {id : id},
            success: function(data) {
                $('#table').html(data);
            }
        });
    }
    
    $("#customer_id").change(function(){
        var id = $(this).val();
        if(id!=0)getCusDetail(id);
    })
    .change();

    function getCusDetail(id)
    {
        $.ajax({
            type: "GET",
            dataType: "JSON",
            url: '../order/get_customer_detail/'+id,
            success: function(data) {
                $('#up').val(data.up);
                $('#alamat').val(data.alamat);
            }
        });
    }

    $('#add_so').on('click', function () {
        $(document).find("select.select2").select2();
       addSo();
    });

    function addSo()
    {
        $.ajax({
            type: 'POST',
            url: '/gsm/sales/penjualan/add_so/',
            success: function(data) {
                $('#select_so').append(data);
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