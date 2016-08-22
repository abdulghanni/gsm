<!-- start: PAGE TITLE -->
<section id="page-title">
    <div class="row">
	<div class="col-sm-8">
            <h1 class="mainTitle">Pengeluaran Stok</h1>
            <span class="mainDescription"></span>
	</div>
	<ol class="breadcrumb">
            <li>
				<span>Pages</span>
			</li>
			<li class="active">
				<span><a href="<?=base_url('stok/pengeluaran')?>">Pengeluaran</a></span>
			</li>
			<li>
				<span><a href="<?=base_url('stok/pengeluaran/input')?>">Input</a></span>
			</li>
		</ol>
	</div>
</section>
<!-- end: PAGE TITLE -->
<!-- start: INVOICE -->
<div class="container-fluid container-fullw bg-white">
<form role="form" action="<?= base_url('stok/pengeluaran/add')?>" method="post" class="form-horizontal">
<?php if($id == null){
echo form_hidden('is_update', 0,''); 
echo form_hidden('id', $id,''); 
	?>
	<div class="row">
		<div class="col-md-12">
			<div class="invoice">
				<div class="row invoice-logo">
					<div class="col-sm-6">
						<img alt="" src="<?= assets_url('images/your-logo-here.png')?>">
					</div>
					<div class="col-sm-6">
						<p class="text-dark">
							#<?=date('Ymd',strtotime('now')).$last_id?> / <?=dateIndo(date('Y-m-d',strtotime('now')))?> <small class="text-light"></small>
							<input type="hidden" name="no" value="<?=date('Ymd',strtotime('now')).$last_id?>">
						</p>
					</div>
				</div>
				<hr>
				<div class="row so" id="so">
                                    <div class="col-md-7">
					<div class="form-group">
                                            <label class="col-sm-3 control-label" for="inputEmail3">
								No. S.O
                                            </label>
                                                <div class="col-sm-6">
								<?php $nm_f="ref_id[]";
								?>
								<!--Bagian Kanan-->
								<?php echo form_dropdown($nm_f,$opt_po,(isset($val[$nm_f]) ? $val[$nm_f] : ''),'class="select2" id="'.$nm_f.'" onchange="cariref(this.value)" style="width:100%;" ')?>
								
								<!--//Bagian Kanan-->
							</div>
                                                    <div class="col-md-3" id="addso">
                                                        
                                                    </div>
					</div>
                                    </div>
				</div>
				<div id="addedso">
                                   
				</div>
				<!--div class="row">
                                    <div class="col-md-7">
					<div class="form-group">
                                            <label class="col-sm-3 control-label" for="inputEmail3">
								&nbsp;
                                            </label>
                                                <div class="col-sm-6">
								<?php $nm_f="ref";
								?>
								<!--Bagian Kanan->
								<?php echo form_dropdown($nm_f,$opt_po,(isset($val[$nm_f]) ? $val[$nm_f] : ''),'class="select2" id="'.$nm_f.'" onchange="cariref(this.value)" style="width:100%;" ')?>
								
								<!--//Bagian Kanan->
							</div>
                                                    <div class="col-md-3" id="addso">
                                                        
                                                    </div>
					</div>
                                    </div>
				</div-->
				<div class="row" id="detailtrans">
							<img src="<?php echo base_url().'assets/images/loading.gif' ?>" class="loadingimg" style="display:none">
				</div>
				<button id="btnAdd" type="button" class="btn btn-green" onclick="addRow('table')" style="display:none">
                    <?= lang('add').' '.lang('item') ?> <i class="fa fa-plus"></i>
                </button>
                <button id="btnRemove" type="button" class="btn btn-red" onclick="deleteRow('table')" style="display:none">
                    <?= 'Remove' ?> <i class="fa fa-remove"></i>
                </button>
				<div class="row" id="list">
					<img src="<?php echo base_url().'assets/images/loading.gif' ?>" class="loadingimg" style="display:none">
				</div>
					<div class="row" id="submitdiv" style="display:none">
						<button type="submit" id="btnSubmit" class="btn btn-lg btn-primary hidden-print pull-right" style="margin-right:15px;">
							Submit<i class="fa fa-check"></i>
						</button>
					</div>
				
			</div>
		</div>
	</div>
</div>
<?php }else{
echo form_hidden('is_update', 1,''); 
echo form_hidden('id', $id,'');
$ref_id = (!empty($pengeluaran->ref_id)) ? $pengeluaran->ref_id : getValue('id', 'sales_order', array('so'=>'where/'.$pengeluaran->ref));
echo form_hidden('ref_id', $ref_id,'');  
	?>
<div class="row">
		<div class="col-md-12">
			<div class="invoice">
				<div class="row invoice-logo">
					<div class="col-sm-6">
						<img alt="" src="<?= assets_url('images/your-logo-here.png')?>">
					</div>
					<div class="col-sm-6">
						<p class="text-dark">
							#<?=$pengeluaran->ref?> <small class="text-light"></small>
						</p>
					</div>
				</div>
				<hr>
				
				<fieldset>
					<legend>Detail</legend>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputPassword3">
									Kepada
								</label>
								<div class="col-sm-8">
									<?php 
										$nm_f='kontak_id';
										$js = 'style="width:100%" class="form-control"  id="'.$nm_f.'" readonly';
										//echo form_dropdown($nm_f, GetOptAll('gudang','-GUDANG-'),$refid[$nm_f],$js); 
										echo form_input($nm_f, getValue('title', 'kontak', array('id'=>'where/'.$pengeluaran->$nm_f)),$js); 
										echo form_hidden($nm_f, $pengeluaran->$nm_f,$js); 
									?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputEmail3">
									Tgl. Pengiriman
								</label>
								<div class="col-sm-8">
									<?php 
										$nm_f='tgl';
										$js = 'style="width:100%" class="form-control"  id="'.$nm_f.'"';
										echo form_input($nm_f, $pengeluaran->$nm_f,$js);  
									?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputPassword3">
									Asal Gudang
								</label>
								<div class="col-sm-8">
									<?php 
										$nm_f='gudang_to';
										$js = 'style="width:100%" class="form-control"  id="'.$nm_f.'"';
										echo form_dropdown('gudang_id', GetOptAll('gudang','-GUDANG-'),$pengeluaran->$nm_f,$js); 
										// echo form_input($nm_f, $pengeluaran->$nm_f,$js);  
										// echo GetValue('title','gudang',array('id'=>'where/'.$pengeluaran->$nm_f)); 
									?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputPassword3">
									Alamat Pengiriman
								</label>
								<div class="col-sm-8">
									<?php 
										$nm_f='alamat';
										$js = 'style="width:100%" class=""  id="'.$nm_f.'"';
										echo form_textarea($nm_f,$pengeluaran->$nm_f,$js);
									?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-sm-4 control-label" for="inputPassword3">
										No. Surat Jalan
									</label>
									<div class="col-sm-8">
										<?php 
											$nm_f='no';
											$js = 'style="width:100%; height:60px;" class="form-control"  id="'.$nm_f.'" readonly';
											$no = (!empty($pengeluaran->no)) ? $pengeluaran->no : date('Ymd', strtotime($pengeluaran->created_on)).sprintf('%04d',$pengeluaran->id);
											echo form_input($nm_f, $no,$js);  
										?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label" for="inputPassword3">
										No Plat Kendaraan
									</label>
									<div class="col-sm-8">
										<?php 
											$nm_f='plat';
											$js = 'style="width:100%; height:60px;" class="form-control"  id="'.$nm_f.'"';
											echo form_input($nm_f, $pengeluaran->$nm_f,$js);  
										?>
									</div>
								</div>
	                            <div class="form-group">
									<label class="col-sm-4 control-label" for="inputPassword3">
										Kendaraan
									</label>
									<div class="col-sm-8">
										<?php 
											$nm_f='driver';
											$js = 'style="width:100%; height:60px;" class="form-control"  id="'.$nm_f.'"';
											echo form_input($nm_f, $pengeluaran->$nm_f,$js);  
										?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label" for="inputPassword3">
										Notes
									</label>
									<div class="col-sm-8">
										<?php 
											$nm_f='keterangan';
											$js = 'style="width:100%; height:60px;" class="form-control"  id="'.$nm_f.'"';
											echo form_input('catatan', $pengeluaran->$nm_f,$js);  
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</fieldset>
				<div class="row">
					<div class="col-sm-12">
						<div class="table-responsive">
							<table id="table" class="table table-striped">
								<thead>
									<tr>
										<th width="5%"> No. Ref </th>
										<th width="10%"> Kode Barang </th>
										<th width="20%"> SS Barang </th>
										<th width="20%"> Nama Barang </th>
										<th width="20%"> Deskripsi </th>
										<th width="20%"> Catatan </th>
										<th width="5%">Dikirim</th>
										<th width="5%">Satuan</th>
										<th width="5%">Attachment</th>
										</tr><?php $c=1; foreach($list->result_array() as $daftar){
										?>
										<?php echo form_hidden("idtrx[]",$daftar['order_id']) ?>
										<?php echo form_hidden("list[]",$daftar['id']) ?>
										<?php echo form_hidden("brg[]",$daftar['barang_id']) ?>
										<?php echo form_hidden("jumlah_po[]",isset($part)?$carisisa['sisa'] : $daftar['jumlah']) ?>
										<tr>
											<th width="5%"><?php echo $daftar['ref'] ?> </th>
											<th width="10%"> <?php echo GetValue('kode','barang',array('id'=>'where/'.$daftar['barang_id'])) ?> </th>
											<th>
												<?php
					                        		$img = getValue('photo', 'barang', array('id'=>'where/'.$daftar['barang_id'])); 
					                        		$src = (!empty($img)) ? base_url("uploads/barang/".$daftar['barang_id']."/".$img) : assets_url('assets/images/no-image-mid.png') 
					                        	?>
					                        	<img height="75px" width="75px" src="<?=$src?>">
											</th>
											<th width="20%"> <textarea><?php echo GetValue('title','barang',array('id'=>'where/'.$daftar['barang_id'])) ?></textarea></th>
											<th width="20%">
												<textarea name="deskripsi[]" class="" placeholder="Isi deskripsi barang disini"><?=$daftar['deskripsi']?></textarea>
											</th>
											<th width="20%"> <textarea name="catatan_barang[]" class="" placeholder="Isi catatan barang disini"><?=$daftar['catatan']?></textarea></th>
											<!--th width="5%"><?php echo $daftar['jumlah'] ?> <?php if(isset($part)){echo "(SISA ".$carisisa['sisa'].")";} ?></th>
											<th width="10%"><?php echo GetValue('title','satuan',array('id'=>'where/'. $daftar['satuan_id']))?> </th>
											<!--th width="20%"> <?php echo $daftar['harga'] ?> </th>
												<th width="5%"><?php echo $daftar['disc'] ?></th>
												<th width="15%"> Sub Total </th>
											<th width="5%"><?php echo $daftar['pajak'] ?></th-->
											<th width="5%"><?php echo form_input("jumlah[]",isset($part)?$carisisa['sisa'] : $daftar['jumlah'],'') ?></th>
											<th width="5%">
												<?php echo form_dropdown("satuan[]",GetOptAll('satuan'),$daftar['satuan_id'],'readonly') ?>
												<?php //echo form_hidden("satuan_id[]",$daftar['satuan_id'],'') ?></th>
										</tr><?php $c++;}  ?>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row" id="submitdiv">
		<button type="submit" id="btnSubmit" class="btn btn-lg btn-primary hidden-print pull-right" style="margin-right:15px;">
			Update<i class="fa fa-check"></i>
		</button>
	</div>
<?php }?>
</form>
<!-- end: INVOICE -->
<script type="text/javascript" src="<?=assets_url('vendor/jquery/jquery.min.js')?>"></script>
<script type="text/javascript">
	$(document).ready(function(e){
        $('.select2').select2({});
    });

	function cariref(val){
		$('#addso').empty();	
		$('#addedso').empty();	
        $('.loadingimg').show();
                
		$('#detailtrans').load('<?php echo base_url() ?>stok/pengeluaran/cariref',{v:val});
		$('#list').load('<?php echo base_url() ?>stok/pengeluaran/carilist',{v:val});
        $('#submitdiv').toggle();
    	$('#addso').append('<a class="btn btn-green add-row" href="#" onclick="addrow()">Tambah <i class="fa fa-plus"></i></a>');
	}

    function addrow(){
        var idlist=getRandomInt(11111,9999999);
        var so=$('.so').length;
        var soawal=$('#ref').val();
        $('#addedso').append("<div class='row so' id='so"+so+"' ><div class='col-md-7'><div class='form-group'><label class='col-sm-3 control-label' for='inputEmail3'>No. S.O </label><div class='col-sm-6' id='so-"+so+"'></div><div class='col-md-3' ></div></div></div></div> ");
        setTimeout(function(e){
            $('#so-'+so).load('<?php echo base_url()?>stok/pengeluaran/addso/',{so:soawal,idp:idlist});
        },100);
    }
    function getRandomInt(min, max) {
	  return Math.floor(Math.random() * (max - min)) + min;
	}
	
	function deleteRow(tableID){try{var table=document.getElementById(tableID);var rowCount=table.rows.length;for(var i=0;i<rowCount;i++){var row=table.rows[i];var chkbox=row.cells[0].childNodes[0];if(null!=chkbox&&true==chkbox.checked){table.deleteRow(i);rowCount--;i--;}}}catch(e){alert(e);}}
</script>