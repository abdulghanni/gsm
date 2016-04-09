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
			<li class="active">
				<span><a href="<?=base_url('purchase/retur')?>">retur</a></span>
			</li>
			<li>
				<span><a href="<?=base_url('purchase/retur/input')?>">input</a></span>
			</li>
		</ol>
	</div>
</section>
<!-- end: PAGE TITLE -->
<!-- start: INVOICE -->
<div class="container-fluid container-fullw bg-white">
<form role="form" action="<?= base_url('purchase/retur/add')?>" method="post" class="form-horizontal" id="form-po">
	<div class="row">
		<div class="col-md-12">
			<div class="invoice">
				<div class="row invoice-logo">
					<div class="col-sm-6">
						<img alt="" src="<?= assets_url('images/your-logo-here.png')?>">
					</div>
					<div class="col-sm-6">
						<p class="text-dark">
							#<?=$last_id.'/PO-I/GSM/I/'.date('Y')?><small class="text-light"></small>
						</p>
					</div>
				</div>
				<div class="row form-row">
					<div class="col-md-6">
						<div class="col-md-5">
							<label class="control-label">Salin Dari Penerimaan Stok</label>
						</div>
						<div class="col-md-7">
							<select class="select2" id="list_pembelian" style="width:100%" name="penerimaan_id">
								<option value="0">-- Pilih NO. Penerimaan --</option>
								<?php foreach($po as $p):?>
								<option value="<?=$p->id?>"><?=date('Ymd', strtotime($p->created_on)).sprintf('%04d',$p->id)?></option>
								<!--<option value="<?=$p->id?>"><?=$p->po?></option>-->
								<?php endforeach;?>
							</select>
						</div>
					</div>
				</div>
				<hr>
				<div id="dari-pembelian">
				</div>
			</div>
		</div>
	</div>
</div>
</form>