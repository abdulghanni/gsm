<div class="row">
	<div class="col-md-4">
	PPN
	</div>
	<div class="col-md-1">
	:
	</div>
	<div class="col-md-7">
       <select class="select2" style="width:100%" name="ppn">
       		<?php $c=getAll('barang')->result();
	       		echo '<option value="">All</option>';
	       		echo '<option value="0">Transaksi dengan PPN</option>';
	       		echo '<option value="1">Transaksi tanpa PPN</option>';
       		?> 
       </select>
	</div>
</div>