<!-- start: PAGE TITLE -->
<section id="page-title">
	<div class="row">
		<div class="col-sm-8">
			<h1 class="mainTitle">Hak Akses</h1>
			<span class="mainDescription"></span>
		</div>
		<ol class="breadcrumb">
			<li>
				<span>Pages</span>
			</li>
			<li class="active">
				<span><a href="<?=base_url('purchase/order')?>">Hak Akses</a></span>
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
<form role="form" action="<?= base_url().$module.'/'.$file_name.'/update'?>" method="post" class="form-horizontal">
	<div class="row">
		<div class="col-md-12">
			<div class="invoice">
				<div class="row invoice-logo">
					<div class="col-sm-6">
						<img alt="" src="<?= assets_url('images/your-logo-here.png')?>">
					</div>
					<div class="col-sm-6">
						<!--p class="text-dark">
							#<?=date('Ymd',strtotime('now')).$last_id?> / <?=dateIndo(date('Y-m-d',strtotime('now')))?> <small class="text-light"></small>
							<input type="hidden" name="no" value="<?=date('Ymd',strtotime('now')).$last_id?>">
						</p-->
					</div>
				</div>
				
				<div class="row"><?php echo form_hidden('id',isset($nm['id'])? $nm['id'] : '') ?>
					<div class="form-group">
					<div class="col-md-12" style="margin-top:20px;border-top:1px solid #8CE5FF;">	
						<div class="col-md-6">
							<div class="col-md-3">
							<label>
							Parents
							</label>
							</div><div class="col-md-6">
							<?php $v='id_parents';
							 echo form_dropdown($v,$opt_parents,isset($nm[$v])? $nm[$v] : '','class="select2"') ?>
							</div>
						</div>
					</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
					<div class="col-md-12">	
						<div class="col-md-6">
							<div class="col-md-3">
							<label>
							Title
							</label>
							</div><div class="col-md-9">
							<?php $v='title';
							 echo form_input($v,isset($nm[$v])? $nm[$v] : '','class="form-control"') ?>
							</div>
						</div>
					</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
					<div class="col-md-12">	
						<div class="col-md-6">
							<div class="col-md-3">
							<label>
							Filez
							</label>
							</div><div class="col-md-9">
							<?php $v='filez';
							 echo form_input($v,isset($nm[$v])? $nm[$v] : '','class="form-control"') ?>
							</div>
						</div>
					</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
					<div class="col-md-12">	
						<div class="col-md-6">
							<div class="col-md-3">
							<label>
							Icon
							</label>
							</div><div class="col-md-9">
							<?php $v='icon';
							 echo form_input($v,isset($nm[$v])? $nm[$v] : '','class="form-control"') ?>
							</div>
						</div>
					</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
					<div class="col-md-12">	
						<div class="col-md-6">
							<div class="col-md-3">
							<label>
							Sort
							</label>
							</div><div class="col-md-9">
							<?php $v='sort';
							 echo form_input($v,isset($nm[$v])? $nm[$v] : '','class="form-control"') ?>
							</div>
						</div>
					</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
					<div class="col-md-12">	
						<div class="col-md-6">
							<div class="col-md-3">
							<label>
							Is Active
							</label>
							</div><div class="col-md-9">
							<?php $v='is_active';
							 echo form_checkbox($v,1,'class="form-control" '.isset($nm[$v]) && $nm[$v]=='Active' ? 'checked':'') ?>
							</div>
						</div>
					</div>
					</div>
				</div>
				<hr>
				
				
				<div class="row">
					<button type="submit" id="btnSubmit" class="btn btn-lg btn-primary hidden-print pull-right" style="margin-right:15px;">
						Submit<i class="fa fa-check"></i>
					</button>
				</div>
				
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