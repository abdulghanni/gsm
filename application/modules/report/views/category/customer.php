
<table>

<div id="department">
    <div class="row">
		<div class="col-md-4">
		Costumer
		</div>
		<div class="col-md-1">
		:
		</div>
		<div class="col-md-7">
	       <select class="select2" style="width:100%" name="kontak">
	       	<?php $c=getAll('kontak', array('jenis_id'=>'where/2'))->result();
	       		echo '<option value="">All</option>';
	       		foreach($c as $k){
	       			echo '<option value="'.$k->title.'">'.$k->title.'</option>';
	       		}?> 
	       </select>
		</div>
	</div>
</div>
</table>