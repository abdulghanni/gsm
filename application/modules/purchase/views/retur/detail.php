<!-- start: PAGE TITLE -->
<section id="page-title">
	<div class="row">
		<div class="col-sm-8">
			<h1 class="mainTitle">Retur Penerimaan</h1>
			<span class="mainDescription"></span>
		</div>
		<ol class="breadcrumb">
			<li>
				<span>Pages</span>
			</li>
			<li>
				<span><a href="<?=base_url('purchase/retur')?>">retur</a></span>
			</li>
			<li  class="active">
				<span><a href="<?=base_url('purchase/retur/detail/'.$id)?>">detail</a></span>
			</li>
		</ol>
	</div>
</section>
<!-- end: PAGE TITLE -->
<!-- start: INVOICE -->
<div class="container-fluid container-fullw bg-white">

<div class="row pull-right" style="display: none">
	<a href="<?=base_url().'transaksi/order/print_pdf/'.$id;?>" target='_blank' class="btn btn-lg btn-primary hidden-print">
		 <i class="fa fa-print"></i> <?= lang('print')?>
	</a>
</div>
<?php foreach ($retur->result() as $o) :?>
<form role="form" action="<?= base_url('transaksi/retur/add')?>" method="post" class="form-horizontal">
	<div class="row">
		<div class="col-md-12">
			<div class="invoice">
				<div class="row invoice-logo">
					<div class="col-sm-6">
						<img alt="" src="<?= assets_url('images/your-logo-here.png')?>">
					</div>
					<div class="col-sm-6">
						<p class="text-dark">
							#<?=$o->no?> / <?=$o->tanggal_transaksi?> <small class="text-light"></small>
						</p>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6">

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								No. Retur
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="No. Retur" name="no" class="form-control" value="<?=$o->no?>" disabled>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Tgl. Retur
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="Tgl. Faktur" name="no" class="form-control" value="<?=$o->tanggal_transaksi?>" disabled>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Supplier
							</label>
							<div class="col-sm-8">
								<input type="text" name="up" value="<?=$o->kontak?>" class="form-control" disabled="disabled">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Catatan
							</label>
							<div class="col-sm-8">
								<textarea name="up" class="form-control" disabled="disabled"><?=$o->catatan?></textarea>
							</div>
						</div>

                    </div>

                    <div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								No. PO
							</label>
							<div class="col-sm-8">
								<input type="text" name="po" value="<?=$o->po?>" class="form-control" readonly>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								No. Penerimaan
							</label>
							<div class="col-sm-8">
								<input type="text" name="po" value="<?=date('Ymd', strtotime($o->created_on)).sprintf('%04d',$o->penerimaan_id)?>" class="form-control" readonly>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Tanggal Penerimaan
							</label>
							<div class="col-sm-8">
                                  <input type="text" class="form-control" name="tanggal_pengiriman" value="<?=dateIndo($o->tanggal_penerimaan)?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Dikirim Ke
							</label>
							<div class="col-sm-8">
								<input type="text" name="up" value="<?=$o->gudang?>" class="form-control" readonly>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<table id="table" class="table table-striped">
							<thead>
								<tr>
									<th width="5%"> No. </th>
									<th width="5%"> Kode Barang </th>
									<th width="8%"> SS Barang </th>
									<th width="25%"> Nama Barang </th>
									<th width="25%"> Deskripsi & Catatan </th>
									<th width="5%">Diorder</th>
									<th width="5%">Diretur</th>
									<th width="10%"> Satuan </th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i=1;foreach($retur_list->result() as $ol): 
									$ss_link = base_url("uploads/barang/$ol->barang_id/$ol->photo");
                 					$ss_headers = @get_headers($ss_link);
									$src = ($ss_headers[0] != 'HTTP/1.1 404 Not Found')?base_url("uploads/barang/$ol->barang_id/$ol->photo") : assets_url('assets/images/no-image-mid.png');
									?>
								<tr>
									<td><?=$i++?></td>
									<td><?=$ol->kode_barang?></td>
									<td><img height="75px" width="75px" src="<?=$src?>"></td>
									<td><?=$ol->nama_barang?></td>
									<td><textarea readonly="readonly"><?=$ol->deskripsi?></textarea></td>
									<td class="text-right"><?=$ol->diterima?></td>
									<td class="text-right"><?=$ol->diretur?></td>
									<td><?=$ol->satuan?></td>
								</tr>
								<?php endforeach;
								?>
							</tbody>
						</table>
					</div>
				</div>
				<hr/>
				</div>
				<div class="row">
				<div class="col-md-4">
					  <div class="approve text-center" style="align:center">
					  <p class="text-center">Dibuat Oleh,</p>
					  
	                      <span class="small"></span>
	                      <span class="semi-bold"></span>
	                      <span class="small"></span><br/><br/>
	                      <span class="semi-bold"></span><br/>
	                   
	                      <span class="semi-bold"><?= getFullName($o->created_by)?></span><br/>
	                      <span class="small"><?=dateIndo($o->created_on)?></span><br/>
	                  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</form>
<?php endforeach;?>
<!-- end: INVOICE -->