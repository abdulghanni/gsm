
<div id="department">
    <div class="row">
		<div class="col-md-4">
		Gudang
		</div>
		<div class="col-md-1">
		:
		</div>
		<div class="col-md-7">
	      <select class="select2" style="width:100%" name="gudang">
	       	<?php $c=getAll('gudang')->result();
	       		echo '<option value="">All</option>';
	       		foreach($c as $k){
	       			echo '<option value="'.$k->title.'">'.$k->title.'</option>';
	       		}?> 
	       </select>
		</div>
	</div>
</div>
</table>