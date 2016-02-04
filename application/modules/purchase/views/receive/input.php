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
			<li class="active">
				<span><a href="<?= base_url($module.'/'.$file_name)?>"><?=$main_title?></a></span>
			</li>
			<li>
				<span><a href="<?= base_url($module.'/'.$file_name.'/input')?>">input</a></span>
			</li>
		</ol>
	</div>
</section>
<!-- end: PAGE TITLE -->
<!-- start: INVOICE -->
<div class="container-fluid container-fullw bg-white">
<form role="form" action="<?= base_url($module.'/'.$file_name.'/add')?>" method="post" class="form-horizontal">
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
									<input type="text" placeholder="No. Form" name="no" class="form-control" required="required" value="<?=$last_id?>/FR-LOG/4.2.4/GSM/<?=date('Y')?>">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputEmail3">
									No. P.O
								</label>
								<div class="col-sm-8">
									<select class="select2" style="width:100%" name="po">
										<option value="0">-- Pilih No. P.O --</option>
										<?php foreach($po as $p):?>
											<option value="<?=$p->po?>"><?=$p->po?></option>
										<?php endforeach;?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputEmail3">
									Tgl. Terima Barang
								</label>
								<div class="col-sm-8">
									<div id="tanggal_faktur" class="input-append date success no-padding">
	                                  <input type="text" class="form-control" name="tanggal_terima" required>
	                                  <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
	                                </div>
								</div>
							</div>
	                    </div>
	                    <div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputPassword3">
									No. Surat Jalan
								</label>
								<div class="col-sm-8">
									<input type="text" placeholder="No. Surat Jalan" name="no_surat" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputPassword3">
									Project
								</label>
								<div class="col-sm-8">
									<input type="text" placeholder="Project" name="project" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputPassword3">
									Tipe Kendaraan
								</label>
								<div class="col-sm-8">
									<input type="text" placeholder="Tipe Kendaraan" name="kendaraan" class="form-control">
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
									<input type="text" placeholder="Total Box" name="box" class="form-control text-right">
								</div>
							</div>
						</div>

						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputPassword3">
									Total Volume
								</label>
								<div class="col-sm-8">
									<input type="text" placeholder="Total Volume" name="volume" class="form-control text-right">
								</div>
							</div>
						</div>

						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputPassword3">
									Total Roll
								</label>
								<div class="col-sm-8">
									<input type="text" placeholder="Total Roll" name="roll" class="form-control text-right">
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
									<input type="checkbox" id="kondisi-packing-1" value="1" name="kondisi-packing[]" checked="">
									<label for="kondisi-packing-1">
										Baik&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									</label>
								</div>
								<div class="checkbox clip-check check-primary checkbox-inline">
									<input type="checkbox" id="kondisi-packing-2" value="2" name="kondisi-packing[]">
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
									<input type="checkbox" id="kondisi-barang-1" value="1" checked="" name="kondisi-barang[]">
									<label for="kondisi-barang-1">
										Baik&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									</label>
								</div>
								<div class="checkbox clip-check check-primary checkbox-inline">
									<input type="checkbox" id="kondisi-barang-2" value="2"  name="kondisi-barang[]">
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
									<input type="checkbox" id="kondisi-jumlah-1" value="1" checked="" name="kondisi-jumlah[]">
									<label for="kondisi-jumlah-1">
										Lengkap
									</label>
								</div>
								<div class="checkbox clip-check check-primary checkbox-inline">
									<input type="checkbox" id="kondisi-jumlah-2" value="2" name="kondisi-jumlah[]">
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
								<textarea class="form-control" name="keterangan" ></textarea>
							</div>
						</div>
					</div>
					</fieldset>
				</div>
				<div class="row">
					<button type="submit" id="btnSubmit" class="btn btn-lg btn-primary hidden-print pull-right" style="margin-right:15px;">
						Submit <i class="fa fa-check"></i>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
</form>