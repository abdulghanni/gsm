	
<fieldset>
<legend>Detail</legend>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label class="col-sm-3 control-label" for="inputEmail3">
				Tgl. Pengiriman
			</label>
			<div class="col-sm-9">
				<?php 
					$nm_f='tgl';
					$js = 'style="width:100%" class="form-control"  id="'.$nm_f.'"';
					echo form_input($nm_f, $refid['tanggal_transaksi'],$js); 
					//echo $refid[$nm_f]; 
				?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="inputPassword3">
				Asal Gudang
			</label>
			<div class="col-sm-9">
				<?php 
					$nm_f='gudang_id';
					$js = 'style="width:100%" class="form-control"  id="'.$nm_f.'"';
					echo form_dropdown($nm_f, GetOptAll('gudang','-GUDANG-'),$refid[$nm_f],$js); 
					//echo GetValue('title','gudang',array('id'=>'where/'.$refid[$nm_f])); 
				?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="inputPassword3">
				Notes
			</label>
			<div class="col-sm-9">
				<?php 
					$nm_f='catatan';
					$js = 'style="width:100%; height:60px;" class="form-control"  id="'.$nm_f.'"';
					echo form_textarea($nm_f,$refid[$nm_f],$js); 
					//echo GetValue('title','gudang',array('id'=>'where/'.$refid[$nm_f])); 
				?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="inputPassword3">
				Alamat Pengiriman
			</label>
			<div class="col-sm-9">
				<?php 
					$nm_f='alamat';
					$js = 'style="width:100%; height:60px;" class="form-control"  id="'.$nm_f.'"';
					echo form_textarea($nm_f,isset($refid[$nm_f]) ? $refid[$nm_f] :'',$js); 
					//echo GetValue('title','gudang',array('id'=>'where/'.$refid[$nm_f])); 
				?>
			</div>
		</div>
	</div>
	<div class="col-md-6">
	<div class="form-group">
			<label class="col-sm-3 control-label" for="inputPassword3">
				No Surat Jalan
			</label>
			<div class="col-sm-9">
				<?php 
					$nm_f='no';
					$js = 'style="width:100%; height:60px;" class="form-control"  id="'.$nm_f.'"';
					echo form_input($nm_f,isset($last_id) ? date('Ymd',strtotime('now')).$last_id :'',$js); 
					//echo GetValue('title','gudang',array('id'=>'where/'.$refid[$nm_f])); 
				?>
			</div>
		</div>
        <div class="form-group">
			<label class="col-sm-3 control-label" for="inputPassword3">
				No Plat Kendaraan
			</label>
			<div class="col-sm-9">
				<?php 
					$nm_f='plat';
					$js = 'style="width:100%; height:60px;" class="form-control"  id="'.$nm_f.'"';
					echo form_textarea($nm_f,isset($refid[$nm_f]) ? $refid[$nm_f] :'',$js); 
					//echo GetValue('title','gudang',array('id'=>'where/'.$refid[$nm_f])); 
				?>
			</div>
		</div>
        <div class="form-group">
			<label class="col-sm-3 control-label" for="inputPassword3">
				Kendaraan
			</label>
			<div class="col-sm-9">
				<?php 
					$nm_f='driver';
					$js = 'style="width:100%; height:60px;" class="form-control"  id="'.$nm_f.'"';
					echo form_textarea($nm_f,isset($refid[$nm_f]) ? $refid[$nm_f] :'',$js); 
					//echo GetValue('title','gudang',array('id'=>'where/'.$refid[$nm_f])); 
				?>
			</div>
		</div>
	</div>
</div>
</fieldset>
					