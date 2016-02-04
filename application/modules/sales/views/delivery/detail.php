<!-- start: PAGE TITLE -->
<section id="page-title">
	<div class="row">
		<div class="col-sm-8">
			<h1 class="mainTitle"><?= $main_title ?></h1>
			<span class="mainDescription"></span>
		</div>
		<ol class="breadcrumb">
			<li>
				<span>Pages</span>
			</li>
			<li>
				<span><a href="<?=base_url($module.'/'.$file_name)?>"><?= $main_title ?></a></span>
			</li>
			<li  class="active">
				<span><a href="<?=base_url($module.'/'.$file_name.'/detail/'.$id)?>">detail</a></span>
			</li>
		</ol>
	</div>
</section>
<!-- end: PAGE TITLE -->
<!-- start: INVOICE -->
<div class="container-fluid container-fullw bg-white">

<div class="row pull-right">
	<a href="<?=base_url().'sales/delivery/print_pdf/'.$id;?>" target='_blank' class="btn btn-lg btn-primary hidden-print">
		 <i class="fa fa-print"></i> <?= lang('print')?>
	</a>
</div>
<?php foreach ($delivery->result() as $o) :?>
<form role="form" action="<?= base_url('transaksi/delivery/add')?>" method="post" class="form-horizontal">
	<div class="row">
		<div class="col-md-12">
			<div class="invoice">
				<div class="row invoice-logo">
					<div class="col-sm-6">
						<img alt="" src="<?= assets_url('images/your-logo-here.png')?>">
					</div>
					<div class="col-sm-6">
						<p class="text-dark">
							#<?=$o->no?><small class="text-light"></small>
						</p>
					</div>
				</div>
				<hr>
				<fieldset>
				<legend>Info Form Kirim Barang</legend>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								No. Surat Jalan
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="No. Form" name="no" class="form-control" required="required" value="<?=$o->no?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Tgl. Kirim Barang
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="No. Form" name="no" class="form-control" required="required" value="<?=$o->tanggal_pengantaran?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Customer
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="No. Form" name="no" class="form-control" required="required" value="<?=$o->customer?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Catatan
							</label>
							<div class="col-sm-8">
								<textarea class="form-control" name="catatan"><?=$o->catatan?></textarea>
							</div>
						</div>
                    </div>
                    <div class="col-md-6">
                    	<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								No. S.O
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="No. S.O" name="so" class="form-control" required="required" value="<?=$o->so?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Tipe Kendaraan
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="Tipe Kendaraan" name="kendaraan" class="form-control" value="<?=$o->kendaraan?>">
							</div>
						</div>
						<div class="form-group">
						<label class="col-sm-4 control-label" for="inputPassword3">
							Dikirim Dari
						</label>
						<div class="col-sm-8">
							<input type="text" placeholder="No. Form" name="no" class="form-control" required="required" value="<?=$o->gudang?>">
						</div>
					</div>
				</div>
				</fieldset>
				<div class="row">
					<div class="col-sm-12">
						<table id="table" class="table table-striped">
							<thead>
								<tr>
									<th width="5%"> No. </th>
									<th width="20%"> Kode </th>
									<th width="30%"> Nama Barang </th>
									<th width="10%">Jumlah</th>
									<th width="30%">Keterangan</th>
								</tr>
							</thead>
							<tbody>
							<?php $i=1;foreach($delivery_list->result() as $ol): ?>
								<tr>
									<td><?=$i++?></td>
									<td><?=$ol->kode_barang?></td>
									<td><?=$ol->deskripsi?></td>
									<td class="text-right"><?=$ol->jumlah?></td>
									<td><?=$ol->keterangan?></td>
								</tr>
							<?php endforeach;?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</form>
<?php endforeach;?>
<!-- end: INVOICE -->