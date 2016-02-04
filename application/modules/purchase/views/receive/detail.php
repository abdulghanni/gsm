<!-- start: PAGE TITLE -->
<section id="page-title">
	<div class="row">
		<div class="col-sm-8">
			<h1 class="mainTitle"><?=$main_title?></h1>
			<span class="mainDescription"></span>
		</div>
		<ol class="breadcrumb">
			<li>
				<span>Pages</span>
			</li>
			<li>
				<span><a href="<?=base_url('purchase/receive')?>"><?=$main_title?></a></span>
			</li>
			<li  class="active">
				<span><a href="<?=base_url('purchase/receive/detail/'.$id)?>">Detail</a></span>
			</li>
		</ol>
	</div>
</section>
<!-- end: PAGE TITLE -->
<div class="container-fluid container-fullw bg-white">
	<div class="row pull-right">
		<a href="<?=base_url().'purchase/receive/print_pdf/'.$id;?>" target='_blank' class="btn btn-lg btn-primary hidden-print">
			 <i class="fa fa-print"></i> <?= lang('print')?>
		</a>
	</div>
	<?php foreach ($receive->result() as $o) :?>
	<form class="form-horizontal">
	<div class="row">
		<div class="col-md-12">
			<div class="invoice">
				<div class="row invoice-logo">
					<div class="col-sm-6">
						<img alt="" src="<?= assets_url('images/your-logo-here.png')?>">
					</div>
					<div class="col-sm-6">
						<p class="text-dark">
							#<?=$o->no?>
						</p>
					</div>
				</div>

				<hr>
				<div id="dari-po">
					<fieldset>
					<legend>Info Form Terima Barang</legend>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputPassword3">
									No. Form
								</label>
								<div class="col-sm-8">
									<input type="text" placeholder="No. Form" name="no" class="form-control" required="required" value="<?=$o->no?>" disabled>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputEmail3">
									No. P.O
								</label>
								<div class="col-sm-8">
									<input type="text" placeholder="No. Form" name="po" class="form-control" required="required" value="<?=$o->po?>"  disabled>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputEmail3">
									Tgl. Terima Barang
								</label>
								<div class="col-sm-8">
									<input type="text" placeholder="No. Form" name="po" class="form-control" required="required" value="<?=dateIndo($o->tanggal_terima)?>" disabled>
								</div>
							</div>
	                    </div>
	                    <div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputPassword3">
									No. Surat Jalan
								</label>
								<div class="col-sm-8">
									<input type="text" placeholder="No. Surat Jalan" name="no_surat" class="form-control" value="<?=$o->no_surat?>" disabled>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputPassword3">
									Project
								</label>
								<div class="col-sm-8">
									<input type="text" placeholder="Project" name="project" class="form-control" value="<?=$o->project?>" disabled>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputPassword3">
									Tipe Kendaraan
								</label>
								<div class="col-sm-8">
									<input type="text" placeholder="Tipe Kendaraan" name="kendaraan" class="form-control" value="<?=$o->kendaraan?>" disabled>
								</div>
							</div>
	                    </div>
					</div>
					</fieldset>
					<fieldset>
					<legend>Info Jumlah Barang</legend>
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputPassword3">
									Total Box
								</label>
								<div class="col-sm-8">
									<input type="text" placeholder="Total Box" name="box" class="form-control text-right" value="<?=$o->box?>" disabled>
								</div>
							</div>
						</div>

						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputPassword3">
									Total Volume
								</label>
								<div class="col-sm-8">
									<input type="text" placeholder="Total Volume" name="volume" class="form-control text-right" value="<?=$o->volume?>" disabled>
								</div>
							</div>
						</div>

						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputPassword3">
									Total Roll
								</label>
								<div class="col-sm-8">
									<input type="text" placeholder="Total Roll" name="roll" class="form-control text-right" value="<?=$o->roll?>" disabled>
								</div>
							</div>
						</div>
					</div>
					</fieldset>
					<fieldset>
					<legend>Rincian Kondisi Barang Yang Diterima</legend>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<label class="form-label">Original packing dalam kondisi</label>
							</div>
							<div class="col-md-6">
								<div class="checkbox clip-check check-primary checkbox-inline">
									<input type="checkbox" id="kondisi-packing-1" value="1" name="kondisi-packing[]" <?=(in_array(1,$kondisi_packing)) ? 'checked' : '';?> disabled>
									<label for="kondisi-packing-1">
										Baik&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									</label>
								</div>
								<div class="checkbox clip-check check-primary checkbox-inline">
									<input type="checkbox" id="kondisi-packing-2" value="2" name="kondisi-packing[]" <?=(in_array(2,$kondisi_packing)) ? 'checked' : '';?> disabled>
									<label for="kondisi-packing-2">
										Rusak
									</label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label class="form-label">Barang dalam kondisi</label>
							</div>
							<div class="col-md-6">
								<div class="checkbox clip-check check-primary checkbox-inline">
									<input type="checkbox" id="kondisi-barang-1" value="1" name="kondisi-barang[]" <?=(in_array(1,$kondisi_barang)) ? 'checked' : '';?> disabled>
									<label for="kondisi-barang-1">
										Baik&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									</label>
								</div>
								<div class="checkbox clip-check check-primary checkbox-inline">
									<input type="checkbox" id="kondisi-barang-2" value="2"  name="kondisi-barang[]" <?=(in_array(2,$kondisi_barang)) ? 'checked' : '';?> disabled>
									<label for="kondisi-barang-2">
										Rusak
									</label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label class="form-label">Jumlah material sesuai dengan surat jalan</label>
							</div>
							<div class="col-md-6">
								<div class="checkbox clip-check check-primary checkbox-inline">
									<input type="checkbox" id="kondisi-jumlah-1" value="1"name="kondisi-jumlah[]" <?=(in_array(1,$kondisi_jumlah)) ? 'checked' : '';?> disabled>
									<label for="kondisi-jumlah-1">
										Lengkap
									</label>
								</div>
								<div class="checkbox clip-check check-primary checkbox-inline">
									<input type="checkbox" id="kondisi-jumlah-2" value="2" name="kondisi-jumlah[]" <?=(in_array(2,$kondisi_jumlah)) ? 'checked' : '';?> disabled>
									<label for="kondisi-jumlah-2">
										Kurang
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-2 control-label text-left" for="inputPassword3">
								Keterangan
							</label>
							<div class="col-sm-10">
								<textarea class="form-control" name="keterangan" disabled><?=$o->keterangan?></textarea>
							</div>
						</div>
					</div>
					</fieldset>
				</div>
			</div>
			<div class="row">
					<div class="col-md-4">
					  <div class="approve text-center" style="align:center">
					  <p class="text-center">Yang Menyerahkan, </p><br/><br/><br/><br/>
	                     <span class="semi-bold"><?= getFullName($o->created_by)?></span><br/>
	                      <span class="small"><?=dateIndo($o->created_on)?></span><br/>
	                  </div>
					</div>

					<div class="col-md-4">
					  <div class="approve text-center" style="align:center">
					  <p class="text-center">QC, </p><br/><br/><br/><br/>
	                      <span class="semi-bold"><?= getFullName($qc)?></span><br/>
	                      <span class="small"><?=dateIndo($o->created_on)?></span><br/>
	                  </div>
					</div>

					<div class="col-md-4">
					  <div class="approve text-center" style="align:center">
					  <p class="text-center">Inbound, </p><br/><br/><br/><br/>
	                      <span class="semi-bold"><?= getFullName($inbound)?></span><br/>
	                      <span class="small"><?=dateIndo($o->created_on)?></span><br/>
	                  </div>
					</div>
			</div>
		</div>
	</div>
	</form>
	<?php endforeach;?>
</div>