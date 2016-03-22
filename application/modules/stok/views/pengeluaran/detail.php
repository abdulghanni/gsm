<!-- start: PAGE TITLE -->
<section id="page-title">
	<div class="row">
		<div class="col-sm-8">
			<h1 class="mainTitle">Pengeluaran</h1>
			<span class="mainDescription"></span>
		</div>
		<ol class="breadcrumb">
			<li>
				<span>Pages</span>
			</li>
			<li>
				<span><a href="<?=base_url('stok/pengeluaran')?>">pengeluaran</a></span>
			</li>
			<li  class="active">
				<span><a href="<?=base_url('stok/pengeluaran/detail/'.$id)?>">detail</a></span>
			</li>
		</ol>
	</div>
</section>
<!-- end: PAGE TITLE -->
<!-- start: INVOICE -->
<div class="container-fluid container-fullw bg-white">

<div class="row pull-right">
	<a href="<?=base_url().'stok/pengeluaran/print_pdf/'.$id;?>" target='_blank' class="btn btn-lg btn-primary hidden-print">
		 <i class="fa fa-print"></i> <?= lang('print')?>
	</a>
</div>
<form role="form" action="<?= base_url('stok/pengeluaran/add')?>" method="post" class="form-horizontal">
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
					<legend><?php echo ucfirst(str_replace('_',' ',$pengeluaran->ref_type)) ?> No. <?php echo $refid['so'] ;?> </legend>
					<div class="row">
						<div class="col-md-5">
							<div class="form-group">
								<label class="col-sm-3 control-label" for="inputEmail3">
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
						
						<div class="col-md-5">
							<div class="form-group">
								<label class="col-sm-3 control-label" for="inputEmail3">
									Tgl.
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
									No. so
								</label>
								<div class="col-sm-9">	
									<?php 
										$nm_f='so';
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
						<div class="col-md-5">
							
							<div class="form-group">
								<label class="col-sm-3 control-label" for="inputEmail3">
									Tgl. Pengiriman
								</label>
								<div class="col-sm-9">
									<?php 
										$nm_f='tgl';
										$js = 'style="width:100%" class="form-control"  id="'.$nm_f.'"';
										//echo form_input($nm_f, $refid['tanggal_transaksi'],$js); 
										echo $pengeluaran->$nm_f; 
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
										//echo form_dropdown($nm_f, GetOptAll('gudang','-GUDANG-'),$refid[$nm_f],$js); 
										echo GetValue('title','gudang',array('id'=>'where/'.$refid[$nm_f])); 
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
										//echo form_textarea($nm_f,$refid[$nm_f],$js); 
										echo $refid[$nm_f]; 
									?>
								</div>
							</div>
						</div>
					</div>
				</fieldset>
				<div class="row">
					<fieldset>
						<legend>List</legend><div class="col-sm-12">
							<div class="table-responsive">
								<table id="table" class="table table-striped">
									<thead>
										<tr>
											<th width="5%"> No. </th>
											<th width="10%"> Kode Barang </th>
											<th width="20%"> Deskripsi </th>
											<!--th width="5%">Quantity</th>
											<th width="10%"> Satuan </th>
											<!--th width="20%"> Harga </th>
												<th width="5%">Disc(%)</th>
												<th width="15%"> Sub Total </th>
											<th width="5%">Pajak(%)</th-->
											<th width="5%">Dikirim</th>
											<th width="5%">Satuan</th>
											</tr><?php $c=1; foreach($list->result_array() as $daftar){
												
												
											?>
                                                                          
											<?php echo form_hidden("idtrx[$c]",$daftar['order_id']) ?>
											<?php echo form_hidden("list[$c]",$daftar['id']) ?>
											<?php echo form_hidden("brg[$c]",$daftar['barang_id']) ?>
											<?php echo form_hidden("jumlah_po[$c]",isset($part)?$carisisa['sisa'] : $daftar['jumlah']) ?>
											<tr>
												<th width="5%"><?php echo $c ?> </th>
												<th width="10%"> <?php echo GetValue('kode','barang',array('id'=>'where/'.$daftar['barang_id'])) ?> </th>
												<th width="20%"> <?php echo GetValue('title','barang',array('id'=>'where/'.$daftar['barang_id'])) ?> </th>
												<!--th width="5%"><?php echo $daftar['jumlah'] ?> <?php if(isset($part)){echo "(SISA ".$carisisa['sisa'].")";} ?></th>
												<th width="10%"><?php echo GetValue('title','satuan',array('id'=>'where/'. $daftar['satuan_id']))?> </th>
												<!--th width="20%"> <?php echo $daftar['harga'] ?> </th>
													<th width="5%"><?php echo $daftar['disc'] ?></th>
													<th width="15%"> Sub Total </th>
												<th width="5%"><?php echo $daftar['pajak'] ?></th-->
												<th width="5%"><?php echo form_input("jumlah[$c]",isset($part)?$carisisa['sisa'] : $daftar['jumlah'],'') ?></th>
												<th width="5%"><?php echo form_dropdown("satuan[$c]",GetOptAll('satuan'),$daftar['satuan_id'],'disabled') ?></th>
											</tr><?php $c++;}  ?>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</fieldset>
				</div>
			</div>
		</div>
	</div>
</div>
</form>
<?php ?>
<!-- end: INVOICE -->