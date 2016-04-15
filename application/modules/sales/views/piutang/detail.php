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
				<span><a href="<?=base_url('sales/'.$file_name)?>"><?=$main_title?></a></span>
			</li>
			<li  class="active">
				<span><a href="<?=base_url("sales/$file_name/detail/".$id)?>">detail</a></span>
			</li>
		</ol>
	</div>
</section>
<!-- end: PAGE TITLE -->
<!-- start: INVOICE -->
<div class="container-fluid container-fullw bg-white">
<!--
	<div class="row pull-right">
		<a href="<?=base_url().'sales/piutang/print_pdf/'.$id;?>" target='_blank' class="btn btn-lg btn-primary hidden-print">
			 <i class="fa fa-print"></i> <?= lang('print')?>
		</a>
	</div>
-->
	<?php 
	foreach ($det->result() as $o) :?>
	<form role="form" action="<?= base_url('sales/piutang/add')?>" method="post" class="form-horizontal">
		<div class="row">
			<div class="col-md-12">
				<div class="invoice">
					<div class="row invoice-logo">
						<div class="col-sm-6">
							<img alt="" src="<?= assets_url('images/your-logo-here.png')?>">
						</div>
						<div class="col-sm-6">
							<p class="text-dark">
								#<?=$o->so?> <small class="text-light"></small>
							</p>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-5">
							<div class="form-group">
								<label class="col-sm-3 control-label" for="inputEmail3">
									NO. S.O
								</label>
								<div class="col-sm-9">
									<input type="text" name="up" value="<?=$o->so?>" class="form-control" disabled="disabled">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="inputPassword3">
									Supplier
								</label>
								<div class="col-sm-9">
									<input type="text" name="up" value="<?=$o->kontak?>" class="form-control" disabled="disabled">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="inputPassword3">
									Kurensi
								</label>
								<div class="col-sm-9">
									<input type="text" name="up" value="<?=$o->kurensi?>" class="form-control" disabled="disabled">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label" for="inputEmail3">
									Tgl. Jatuh Tempo
								</label>
								<div class="col-sm-9">
									<input type="text" name="up" value="<?=dateIndo($o->jatuh_tempo)?>" class="form-control" disabled="disabled">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="inputPassword3">
									Catatan
								</label>
								<div class="col-sm-9">
									<textarea class="form-control" disabled="disabled"><?=$o->catatan?></textarea>
								</div>
							</div>
	                    </div>

						<div class="col-md-5">
							<div class="form-group">
								<label class="col-sm-3 control-label" for="inputPassword3">
									No Transaksi
								</label>
								<div class="col-sm-9">
									<input type="text" name="up" value="<?=$o->no?>" class="form-control" disabled="disabled">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="inputPassword3">
									Tgl. Pembayaran
								</label>
								<div class="col-sm-9">
									<input type="text" name="up" value="<?=$o->tgl_dibayar?>" class="form-control" disabled="disabled">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="inputPassword3">
									COA
								</label>
								<div class="col-sm-9">
									<input type="text" name="up" value="<?=getValue('name', 'sv_setup_coa', array('id'=>'where/'.$o->coa_id))?>" class="form-control" disabled="disabled">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="inputPassword3">
									Dibayar
								</label>
								<div class="col-sm-9">
									<input type="text" name="up" value="<?=$o->dibayar?>" class="form-control" disabled="disabled">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="inputPassword3">
									Terbayar
								</label>
								<div class="col-sm-9">
									<input type="text" name="up" value="<?=$o->terbayar?>" class="form-control" disabled="disabled">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label" for="inputPassword3">
									Total Hutang
								</label>
								<div class="col-sm-9">
									<input type="text" name="up" value="<?=$o->total?>" class="form-control" disabled="disabled">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="inputPassword3">
									Saldo
								</label>
								<div class="col-sm-9">
									<input type="text" name="up" value="<?=$o->saldo?>" class="form-control" disabled="disabled">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr/>
		<div class="row form-row">
			<div class="col-md-8 col-md-offset-2">
				<div class="col-md-4 text-center">
					<h5 class="margin-bottom-30">Dibuat Oleh,</h5><br/><br/>
					<h5 class="margin-top-30"><?=getFullName($o->created_by)?></h5>
					<h5><?=dateIndo($o->created_on)?></h5>
					<h5>(<?=getUserGroup($o->created_by)?>)</h5>
				</div>
			</div>
		</div>
	</form>
	<?php endforeach;?>
</div>
<!-- end: INVOICE -->