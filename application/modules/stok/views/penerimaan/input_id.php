	<fieldset>
	<legend><?php echo ucfirst(str_replace('_',' ',$reftype)) ?> No. <?php echo $refid['po'] ;?> <?php if(isset($part)){echo "(Penerimaan Ke ".$partno.")"; }?></legend>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="inputEmail3">
				<?php echo form_hidden('ref_type',$reftype); ?>
				<?php echo form_hidden('ref_id',$refid['id']); ?>
					Kepada
				</label>
				<div class="col-sm-9">
					<?php 
					$nm_f='kontak_id';
	                	$js = 'style="width:100%" class="form-control"  id="'.$nm_f.'"';
	                	//echo form_input($nm_f, GetValue('title','kontak',array('id'=>'where/'.$refid[$nm_f])),$js);
							echo GetValue('title','kontak',array('id'=>'where/'.$refid[$nm_f]));
	              	?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="inputPassword3">
					Up.
				</label>
				<div class="col-sm-9">
					<?php 
						$nm_f='up';
	                	$js = 'style="width:100%" class="form-control" id="'.$nm_f.'"';
	                	//echo form_input($nm_f, $refid[$nm_f],$js); 
	                	echo $refid[$nm_f]; 
	              	?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="inputPassword3">
					Alamat
				</label>
				<div class="col-sm-9">
					<?php 
						$nm_f='alamat';
	                	$js = 'style="width:100%" class="form-control"  id="'.$nm_f.'"';
	                	//echo form_input($nm_f, $refid[$nm_f],$js); 
	                	echo $refid[$nm_f]; 
	              	?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label" for="inputPassword3">
					Mata Uang
				</label>
				<div class="col-sm-9">
					<div class="clip-radio radio-primary">
						<?php 
						$nm_f='kurensi_id';
	                	$js = 'style="width:100%" class="form-control"  id="'.$nm_f.'"';
	                	//echo form_input($nm_f, GetValue('title','kurensi',array('id'=>'where/'.$refid[$nm_f])),$js); 
	                	echo GetValue('title','kurensi',array('id'=>'where/'.$refid[$nm_f])); 
						?>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label" for="inputPassword3">
					Keterangan
				</label>
				<div class="col-sm-9"><?php 
					$nm_f='catatan';
					$js = 'style="width:100%" class="form-control"  id="'.$nm_f.'"';
					//echo form_input($nm_f, $refid[$nm_f],$js); 
					echo $refid[$nm_f]; 
					?>
				</div>
			</div>

	    </div>

	    <div class="col-md-6">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="inputEmail3">
					Tgl. Pengiriman
				</label>
				<div class="col-sm-9">
					<?php 
						$nm_f='tanggal_transaksi';
	                	$js = 'style="width:100%" class="form-control"  id="'.$nm_f.'"';
	                	//echo form_input($nm_f, $refid[$nm_f],$js); 
	                	echo $refid[$nm_f]; 
					?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="inputPassword3">
					No. PO
				</label>
				<div class="col-sm-9">	
					<?php 
					$nm_f='po';
					$js = 'style="width:100%" class="form-control"  id="'.$nm_f.'"';
					//echo form_input($nm_f, $refid[$nm_f],$js); 
					echo $refid[$nm_f]; 
					?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="inputPassword3">
					Dikirim Ke
				</label>
				<div class="col-sm-9">
					<?php 
						$nm_f='gudang_id';
	                	$js = 'style="width:100%" class="form-control"  id="'.$nm_f.'"';
	                	//echo form_input($nm_f, GetValue('title','gudang',array('id'=>'where/'.$refid[$nm_f])),$js); 
	                	echo GetValue('title','gudang',array('id'=>'where/'.$refid[$nm_f])); 
					?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label" for="inputPassword3">
					Term
				</label>
				<div class="col-sm-9">
					<?php 
						$nm_f='metode_pembayaran_id';
	                	$js = 'style="width:100%" class="form-control"  id="'.$nm_f.'"';
	                	//echo form_input($nm_f, GetValue('title','metode_pembayaran',array('id'=>'where/'.$refid[$nm_f])),$js); 
	                	echo GetValue('title','metode_pembayaran',array('id'=>'where/'.$refid[$nm_f])); 
					?>
				</div>
			</div>
	    </div>
	</div>
</fieldset>
<fieldset>
	<legend>Detail</legend>
	<div class="row">
		<div class="col-md-6">
		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="inputEmail3">
				Tgl. Penerimaan
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
				Penempatan
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
	</div>
	</div>
</fieldset>
					