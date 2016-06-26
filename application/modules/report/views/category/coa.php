
<table>

<div id="department">
    <div class="row">
		<div class="col-md-4">
		COA
		</div>
		<div class="col-md-1">
		:
		</div>
		<div class="col-md-7">
	       <select class="select2" style="width:100%" name="coa">
	       	<?php $c=getAll('sv_setup_coa')->result();
	       		echo '<option value="">All</option>';
	       		foreach($c as $k){
	       			echo '<option value="'.$k->name.'">'.$k->name.'</option>';
	       		}?> 
	       </select>
		</div>
	</div>
</div>
</table>