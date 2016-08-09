<div class="row">
	<div class="col-md-4">
	Tipe Barang
	</div>
	<div class="col-md-1">
	:
	</div>
	<div class="col-md-7">
       <select class="select2" style="width:100%" name="jenis_barang">
	       	<?php $c=getAll('jenis_barang')->result();
	       		echo '<option value="">All</option>';
	       		foreach($c as $k){
	       			echo '<option value="'.$k->id.'">'.$k->title.'</option>';
	       		}?> 
	       </select>
	</div>
</div>