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
				<span><a href="<?=base_url('purchase/'.$file_name)?>"><?=$main_title?></a></span>
			</li>
			<li  class="active">
				<span><a href="<?=base_url("purchase/$file_name/detail/".$id)?>">detail</a></span>
			</li>
		</ol>
	</div>
</section>
<!-- end: PAGE TITLE -->
<!-- start: INVOICE -->
<div class="container-fluid container-fullw bg-white">
<!--
	<div class="row pull-right">
		<a href="<?=base_url().'transaksi/order/print_pdf/'.$id;?>" target='_blank' class="btn btn-lg btn-primary hidden-print">
			 <i class="fa fa-print"></i> <?= lang('print')?>
		</a>
	</div>
-->
	<form role="form" action="<?= base_url('transaksi/order/add')?>" method="post" class="form-horizontal">
		<div class="row">
			<div class="col-md-12">
				<div class="invoice">
					<div class="row invoice-logo">
						<div class="col-sm-6">
							<img alt="" src="<?= assets_url('images/your-logo-here.png')?>">
						</div>
						<div class="col-sm-6">
							<p class="text-dark">
								#<?=$det->no?> <small class="text-light"></small>
							</p>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-3 control-label" for="inputEmail3">
									NO. Invoice
								</label>
								<div class="col-sm-9">
									<input type="text" name="up" value="<?=$det->no?>" class="form-control" disabled="disabled">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="inputPassword3">
									Supplier
								</label>
								<div class="col-sm-9">
									<input type="text" name="up" value="<?=$det->kontak?>" class="form-control" disabled="disabled">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="inputPassword3">
									Kurensi
								</label>
								<div class="col-sm-9">
									<input type="text" name="up" value="<?=$det->kurensi?>" class="form-control" disabled="disabled">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label" for="inputEmail3">
									Tgl. Jatuh Tempo
								</label>
								<div class="col-sm-9">
									<input type="text" name="up" value="<?=dateIndo($det->jatuh_tempo_pembayaran)?>" class="form-control" disabled="disabled">
								</div>
							</div>
	                    </div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-3 control-label" for="inputPassword3">
									Terbayar
								</label>
								<div class="col-sm-9">
									<input type="text" name="up" value="<?=number_format($det->terbayar,2)?>" class="form-control text-right" disabled="disabled">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label" for="inputPassword3">
									Total Hutang
								</label>
								<div class="col-sm-9">
									<input type="text" name="up" value="<?=number_format($det->total, 2)?>" class="form-control text-right" disabled="disabled">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="inputPassword3">
									Saldo
								</label>
								<div class="col-sm-9">
									<input type="text" name="up" value="<?=number_format($det->saldo, 2)?>" class="form-control text-right" disabled="disabled">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
			<div class="table-responsive">
				<table id="table" class="table table-striped">
					<thead>
						<tr>
							<th width="1%"> No. </th>
							<th width="5%"> No. Transaksi </th>
							<th width="5%"> COA </th>
							<th width="10%"> Tgl. Pembayaran </th>
							<th width="15%"> Dibayar </th>
							<th width="10%"> Input By </th>
						</tr>
					</thead>
					<tbody>
						<?php
							$i=1;
							foreach($list->result() as $l):
						?>
						<tr>
							<td width="1%"><?=$i++?></td>
							<td width="10%"><?=$l->no?></td>
							<td width="25%"><?=$l->coa?></td>
							<td width="9%"><?=$l->tgl_dibayar?></td>
							<td align="right" width="20%"><?=number_format($l->dibayar,2)?></td>
							<td width="25%"><?=getName($l->created_by)?></td>
						</tr>
						<?php endforeach;
						?>
					</tbody>
				</table>
			</div>
			</div>
		</div>
		<!-- <hr/>
		<div class="row form-row">
			<div class="col-md-8 col-md-offset-2">
				<div class="col-md-4 text-center">
					<h5 class="margin-bottom-30">Dibuat Oleh,</h5><br/><br/>
					<h5 class="margin-top-30"><?=getFullName($det->created_by)?></h5>
					<h5><?=dateIndo($det->created_on)?></h5>
					<h5>(<?=getUserGroup($det->created_by)?>)</h5>
				</div>
			</div>
		</div> -->
	</form>
</div>
<!-- end: INVOICE -->