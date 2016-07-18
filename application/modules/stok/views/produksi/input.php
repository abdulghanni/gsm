<!-- start: PAGE TITLE -->
<section id="page-title">
	<div class="row">
		<div class="col-sm-8">
			<h1 class="mainTitle"><?= ucwords($module.' '.$file_name)?></h1>
			<span class="mainDescription"></span>
		</div>
		<ol class="breadcrumb">
			<li>
				<span>Pages</span>
			</li>
			<li class="active">
				<span><a href="<?=base_url($module.'/'.$file_name)?>">produksi</a></span>
			</li>
			<li>
				<span><a href="<?=base_url($module.'/'.$file_name.'/input')?>">input</a></span>
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
							#<?=date('Ymd',strtotime('now')).'-'.$last_id?> / <?=dateIndo(date('Y-m-d',strtotime('now')))?> <small class="text-light"></small>
							<input type="hidden" name="po" value="<?=date('Ymd',strtotime('now')).$last_id?>">
						</p>
					</div>
				</div>
				<hr>
				<div class="row so" id="so">
                	<div class="col-md-7">
						<div class="form-group">
                            <label class="col-sm-3 control-label" for="inputEmail3">No. Referensi</label>
	                        <div class="col-sm-6">
								<select class="select2" style="width:100%" name="ref_id" id="ref_id">
									<option value="0">Pilih No. Referensi</option>
									<?php
										foreach($ref as $r){
											$selected = ($r->id == $id) ? 'selected="selected"' : '';
											$ref_no = ($r->ref_type == 'wo') ? getValue('no','wo', array('id'=>'where/'.$r->ref_id)) : getValue('so','sales_order', array('id'=>'where/'.$r->ref_id));
											echo '<option value="'.$r->id.'" '.$selected.'>'.strtoupper($r->ref_type).' - '.$ref_no.'</option>';
										}
									?>
								</select>
							</div>
						</div>
                    </div>
				</div>
				<div id="isi">
                                   
				</div>
			</div>
		</div>
	</div>
	
  	<div class="col-md-12" id="btnSubmit" style="display:none">
		<div class="col-md-10"></div>
	    <div class="col-md-2">
	      <button type="submit" value="Submit" name="btnDraft"  class="btn btn-lg btn-primary hidden-print pull-right">
	        Submit <i class="fa fa-check"></i>
	      </button>
	    </div>
	</div>
</form>
</div>
<!-- end: INVOICE -->
<script type="text/javascript" src="<?=assets_url('vendor/jquery/jquery.min.js')?>"></script>
<script type="text/javascript">
	$(document).ready(function(e){
		$('#ref_id').change(function(e){
			if($(this).val() != 0){ 
				$(document).find(".number").maskMoney();
				$('#isi').empty();
				$('#btnSubmit').show();
				var val=$('#ref_id').val();
				$('#isi').append('<img src="<?php echo base_url().'assets/images/loading.gif' ?>" class="loadingimg">');
				$('#isi').load('<?php echo base_url() ?>stok/produksi/isi',{v:val});
			}
		});
	});
</script>