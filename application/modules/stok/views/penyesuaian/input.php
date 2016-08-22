<!-- start: PAGE TITLE -->
<section id="page-title">
	<div class="row">
		<div class="col-sm-8">
			<h1 class="mainTitle">Penyesuaian Stok</h1>
			<span class="mainDescription"></span>
		</div>
		<ol class="breadcrumb">
			<li>
				<span>Stok</span>
			</li>
			<li class="active">
				<span><a href="<?=base_url('stok/penyesuaian')?>">Penyesuaian</a></span>
			</li>
			<li>
				<span><a href="<?=base_url('stok/penyesuaian/input')?>">input</a></span>
			</li>
		</ol>
	</div>
</section>
<!-- end: PAGE TITLE -->
<!-- start: INVOICE -->
<div class="container-fluid container-fullw bg-white">
<form role="form" action="<?= base_url('stok/penyesuaian/add')?>" method="post" class="form-horizontal">
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
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="inputEmail3">
								No. Transaksi
							</label>
							<div class="col-sm-8">
								<?php $nm_f="mo";
								?>
								<?php echo form_input($nm_f,(isset($val[$nm_f]) ? $val[$nm_f] : date('Ymd',strtotime('now')).$last_id),'class="form-control" id="'.$nm_f.'" required')?>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label" for="inputEmail3">
								Tgl. Penyesuaian
							</label>
							<?php $nm_f="tgl";
							?>
							<div class="col-sm-8">
								<div id="tanggal_transaksi" class="input-append date success no-padding">
                                  <input type="text" class="form-control" name="tgl" required>
                                  <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                                </div>
							</div>
						</div>
                    </div>

                    <div class="col-md-6">
						<div class="form-group">
							<?php $nm_f="catatan";
							?>
							<label class="col-sm-3 control-label" for="inputPassword3">
								Keterangan
							</label>
							<div class="col-sm-8">
								<?php echo form_textarea($nm_f,(isset($val[$nm_f]) ? $val[$nm_f] : ''),'class="" id="'.$nm_f.'"')?>
							</div>
						</div>
					</div>
				</div>
				<hr/>
				<button id="btnAdd" type="button" class="btn btn-green" onclick="addRow('table')">
                    <?= lang('add').' '.lang('item') ?> <i class="fa fa-plus"></i>
                </button>
                <button id="remove" class="btn btn-danger" type="button" style="display:none">Hapus <i class="fa fa-remove"></i></button>
                <div class="row">
					<div class="col-sm-12">
						<div class="table-responsive">
							<table id="table" style="width:100%" class="table table-striped">
								<thead>
									<tr>
										<th width="1%">#</th>
										<th width="1%"> No. </th>
										<th width="30%"> Nama Barang </th>
										<th width="18%"> Catatan </th>
										<th width="20%">Buku</th>
										<th width="15%">Fisik</th>
										<th width="15%">Satuan</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="row" id="btnSubmit" style="display:none">
					<div class="col-md-7"></div>
					<div class="col-md-3"></div>
					<div class="col-md-2">
						<button type="submit" value="Submit" name="btnDraft"  class="btn btn-lg btn-primary hidden-print pull-right">
							Submit <i class="fa fa-check"></i>
						</button>
						<!--button type="submit" value="Submit" name="btnDraft" class="btn btn-lg btn-primary hidden-print pull-right" style="">Btn</button-->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</form>
<!-- end: INVOICE -->