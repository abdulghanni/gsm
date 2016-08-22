$(document).ready(function() {
    $('.select2').select2({
        dropdownAutoWidth : true
    });
    
	$('.input-append.date').datepicker({
        todayHighlight: true,
        autoclose: true,
        format: "dd-mm-yyyy"
    });
});


function addRow(tableID){
    $(document).find("select.select2").select2({
        dropdownAutoWidth : true
    });
    $('#remove').show();
    $('#btnSubmit').show("slow");
	var table=document.getElementById(tableID);
	var rowCount=table.rows.length;
	$("#btnAdd").attr('disabled',true);
	$("#btnAdd").text('loading...');
	$.ajax({
        url: '/gsm/stok/pemindahan/add_row/'+rowCount,
        success: function(response){
         	$("#"+tableID).find('tbody').append(response);
         	$("#btnAdd").attr('disabled',false);
         	$("#btnAdd").text('Tambah Barang');
         },
         dataType:"html"
    });
}