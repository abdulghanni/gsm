<!-- start: PAGE TITLE -->
<section id="page-title">
	<div class="row">
		<div class="col-sm-8">
			<h1 class="mainTitle">Pemindahan Stok</h1>
			<span class="mainDescription"></span>
		</div>
		<ol class="breadcrumb">
			<li>
				<span>Pages</span>
			</li>
			<li class="active">
				<span><a href="<?=base_url('purchase/order')?>">order</a></span>
			</li>
			<li>
				<span><a href="<?=base_url('purchase/order/input')?>">input</a></span>
			</li>
		</ol>
	</div>
</section>
<!-- end: PAGE TITLE -->
<!-- start: INVOICE -->
<div class="container-fluid container-fullw bg-white">
<form role="form" action="<?= base_url('stok/pemindahan/add')?>" method="post" class="form-horizontal">
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
					<div class="col-md-5">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="inputEmail3">
								Ref
							</label>
							<div class="col-sm-9">
								<?php $nm_f="ref";
								?>
								<!--Bagian Kanan-->
								<?php echo form_input($nm_f,(isset($val[$nm_f]) ? $val[$nm_f] : date('Ymd',strtotime('now')).$last_id),'class="form-control" id="'.$nm_f.'" required')?>
								
								<!--//Bagian Kanan-->
							</div>
						</div>
						<div class="form-group">
							<?php $nm_f="gudang_from";
							?>
							<label class="col-sm-3 control-label" for="inputEmail3">
								Asal Gudang
							</label>
							<div class="col-sm-9">
								<!--Bagian Kanan-->
									<?php echo form_dropdown($nm_f,$gudang,(isset($val[$nm_f]) ? $val[$nm_f] : ''),'class="chosen-select form-control select2" onchange="caristok(this.value)" id="'.$nm_f.'" data-placeholder="Choose a State..." required ')?>
								
								<!--//Bagian Kanan-->
							</div>
						</div>
						<div class="form-group">
							<?php $nm_f="gudang_to";
							?>
							<label class="col-sm-3 control-label" for="inputPassword3">
								Gudang Tujuan
							</label>
							<div class="col-sm-9">
								<!--Bagian Kanan-->
								<?php echo form_dropdown($nm_f,$gudang,(isset($val[$nm_f]) ? $val[$nm_f] : ''),'class="chosen-select form-control select2" id="'.$nm_f.'" data-placeholder="Choose a State..." required ')?>
								
								<!--//Bagian Kanan-->
							</div>
						</div>
						

						<div class="form-group">
							<?php $nm_f="keterangan";
							?>
							<label class="col-sm-3 control-label" for="inputPassword3">
								Keterangan
							</label>
							<div class="col-sm-9">
								<!--Bagian Kanan-->
								<?php echo form_input($nm_f,(isset($val[$nm_f]) ? $val[$nm_f] : ''),'class="form-control" id="'.$nm_f.'"')?>
								
								<!--//Bagian Kanan-->
							</div>
						</div>

                    </div>

                    <div class="col-md-5">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="inputEmail3">
								Tgl. Transaksi
							</label>
							<?php $nm_f="tgl";
							?>
							<div class="col-sm-9">
								<!--Bagian Kanan-->
								<?php echo form_input($nm_f,(isset($val[$nm_f]) ? $val[$nm_f] : ''),'class="form-control date" id="'.$nm_f.'" required')?>
								
								<!--//Bagian Kanan-->
							</div>
						</div>
						<div class="form-group">
							
						</div>

						
						
                    </div>
				</div>
				<div class="col-md-12" id="listpemindahan">
				</div>
				<!--button id="btnAdd" type="button" class="btn btn-green" onclick="addRow('table')">
                    <?= lang('add').' '.lang('item') ?> <i class="fa fa-plus"></i>
                </button>
                <button id="btnRemove" type="button" class="btn btn-red" onclick="deleteRow('table')" style="display:none">
                    <?= 'Remove' ?> <i class="fa fa-remove"></i>
                </button-->
				<!--div class="row">
					<div class="col-sm-12">
					<div class="table-responsive">
						<table id="table" class="table table-striped">
							<thead>
								<tr>
									<th width="5%"> # </th>
									<th width="5%"> No. </th>
									<th width="10%"> Kode Barang </th>
									<th width="20%"> Deskripsi </th>
									<th width="5%">Quantity</th>
									<th width="10%"> Satuan </th>
									<th width="20%"> Harga </th>
									<th width="5%">Disc(%)</th>
									<th width="15%"> Sub Total </th>
									<th width="5%">Pajak(%)</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
					</div>
				</div>
				<div class="row">
					<input type="hidden" name="dp" value="0">
					<div id="subTotalPajak"></div>
					<div class="row">
						<div id="panel-total" class="panel-body col-md-5 pull-right" style="display:none">
							<ul class="list-group">
								<li class="list-group-item">
									<div class="row">
										<div class="col-md-4">
										Total Pajak
										</div>
										<div class="col-md-6 pull-right">
										<input type="text" id="totalPajak" value="0" class="form-control text-right" readonly="readonly">
										</div>
									</div>
								</li>
								<li class="list-group-item">
									<div class="row">
										<div class="col-md-4">
										Biaya Pengiriman
										</div>
										<div class="col-md-6 pull-right">
										<input type="text" name="biaya_pengiriman" id="biaya_pengiriman" class="form-control text-right" value="0">
										</div>
									</div>
								</li>
								<li class="list-group-item">
									<div class="row">
										<div class="col-md-4">
										Total
										</div>
										<div class="col-md-6 pull-right">
										<input type="text" class="form-control text-right" id="total" value="0" readonly="readonly">
										</div>
									</div>
								</li>
								<li class="list-group-item">
									<div class="row">
										<div class="col-md-4">
										Dibayar
										</div>
										<div class="col-md-6 pull-right">
										<input type="text" name="dibayar" id="dibayar" class="form-control text-right" value="">
										</div>
									</div>
								</li>
								<div id="total_angsuran" style="display:none">
									<li class="list-group-item">
										<div class="row">
											<div class="col-md-4">
											Biaya Angsuran
											</div>
											<div class="col-md-2">
											</div>
											<div class="col-md-4">
											<input type="text" name="biaya_angsuran" id="biaya_angsuran" class="form-control text-right" value="0">
											</div>
											<div class="col-md-2" id="angsuran" style="margin-left:-10px">
											</div>
										</div>
									</li>
									<li class="list-group-item">
										<div class="row">
											<div class="col-md-4">
											Total+Bunga Angsuran
											</div>
											<div class="col-md-6 pull-right">
											<input type="text" id="totalplusbunga" class="form-control text-right" value="0">
											</div>
										</div>
									</li>
								</div>
								<li class="list-group-item">
									<div class="row">
										<div class="col-md-4">
										Saldo
										</div>
										<div class="col-md-6 pull-right">
										<input type="text" id="saldo" class="form-control text-right" value="0" readonly="readonly">
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div-->
				</div>
			</div>
		</div>
	</div>
</div>
</form>
<!-- end: INVOICE -->
<script type="text/javascript" src="<?=assets_url('vendor/jquery/jquery.min.js')?>"></script>
<script type="text/javascript">
	
	function caristok(gudang){
			$('#listpemindahan').empty();
			$('#listpemindahan').append('<img src="<?php echo base_url() ?>assets/images/loading.gif" />');
			$('#listpemindahan').load('<?php echo base_url() ?>stok/pemindahan/liststok',{g:gudang});
	}
	$(document).ready(function(e){
		
			$('.date').datepicker({
				format: 'yyyy-mm-dd'
			});
	});
</script>