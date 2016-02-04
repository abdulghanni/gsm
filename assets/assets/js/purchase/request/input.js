$(document).ready(function() {

    $('.input-append.date')
        .datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd-mm-yyyy"
        });

    $(".select2").select2();

    $('#btnAdd').on('click', function () {
        $(document).find("select.select2").select2();
        $('#btnRemove').show();
        $('#btnSubmit').show("slow");
        $('#panel-total').show("slow");
    });

    $('#dibayar, #biaya_pengiriman').maskMoney({allowZero:true});
});