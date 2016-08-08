$(document).ready(function() {
    
    $(".barang").select2({
        dropdownAutoWidth : true,
        minimumInputLength: 3,
        placeholder: "Cari Barang",
    }).on('select2:open',function(){

            $('.select2-dropdown--above').attr('id','fix');
            $('#fix').removeClass('select2-dropdown--above');
            $('#fix').addClass('select2-dropdown--below');

        });
});