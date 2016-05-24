<div class="row">
	<div class="col-md-4">
	Barang
	</div>
	<div class="col-md-1">
	:
	</div>
	<div class="col-md-7">
       <select class="barang" style="width:100%" name="barang">
	       	<?php $c=getAll('barang')->result();
	       		echo '<option value="">All</option>';
	       		foreach($c as $k){
	       			echo '<option value="'.$k->title.'">'.$k->title.'</option>';
	       		}?> 
	       </select>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(e){
    	$(".barang").select2();
    });
</script>