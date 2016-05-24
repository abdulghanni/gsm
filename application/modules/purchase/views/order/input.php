<!-- start: PAGE TITLE -->
<section id="page-title">
	<div class="row">
		<div class="col-sm-8">
			<h1 class="mainTitle">Purchase Order</h1>
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
<!--form role="form" action="<?= base_url('purchase/order/add')?>" method="post" class="form-horizontal" id="form-po"-->
<?php echo form_open_multipart(base_url('purchase/order/add'), array('id'=>'form-po', 'class'=>'form-horizontal'))?>
	<div class="row row-form">
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
				<div class="row">
					<div class="col-md-6">
						<div class="col-md-4">
							<label class="control-label">Salin Dari P.R</label>
						</div>
						<div class="col-md-8">
							<select class="select2 select_pr" id="list_pr" style="width:100%" name="no[]">
								<option value="0">-- Pilih NO. P.R --</option>
								<?php foreach($pr as $p):;
									if($ci->get_pr_status($p->id) != "Close"){
								?>
								<option value="<?=$p->id?>"><?=$p->no?></option>
								<?php } endforeach;?>
							</select>
						</div>
					</div>
				</div><p></p>
				<div class="row">
					<div class="col-md-6">
						<div class="col-md-4">
						</div>
						<div class="col-md-8">
							<button id="add_pr" type="button" class="btn btn-xs btn-green" style="display: none">
	                        	<?= lang('add') ?> P.R <i class="fa fa-plus"></i>
	                    	</button>
						</div>
					</div>
				</div><p></p>
				<div id="select_pr">
				</div>
				<hr>
				<div id="dari-pr">
				</div>
			</div>
		</div>
	</div>
</div>
</form>