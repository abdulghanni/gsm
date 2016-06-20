<div class="row">
	<div class="col-md-4">
	Tipe
	</div>
	<div class="col-md-1">
	:
	</div>
	<div class="col-md-7">
       <select class="barang" style="width:100%" name="barang">
	       <option value="">All</option>	
	       <option value="in">Barang Masuk</option>	
	       <option value="out">Barang Keluar</option>	
	   </select>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(e){
    	$(".barang").select2();
    });
</script>