$(document).ready(function() {
	$(".select2").select2();
	$('#btnTambahAlamat').on('click', function(){
         $("#alamat-lain").append('<textarea class="form-control" name="alamat[]"></textarea><br/>');
  	});
  	$('#btnTambahTelepon').on('click', function(){
         $("#telepon-lain").append('<input name="telepon[]" placeholder="" class="form-control" type="text"><br/>');
  	});
  	$('#btnTambahUp').on('click', function(){
         $("#up-lain").append('<input name="up[]" placeholder="" class="form-control" type="text"><br/>');
  	});
});
                                        