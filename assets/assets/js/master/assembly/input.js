$(document).ready(function() {
    
    $(".barang").select2({
        dropdownAutoWidth : true,
        minimumInputLength: 3,
        placeholder: "Cari Barang",
    });
});