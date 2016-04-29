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
<form role="form" action="<?= base_url('pengaturan/hak_akses/add')?>" method="post" class="form-horizontal">
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
				<div class="row">
				<div class="form-group">
					<div class="col-md-12" style="margin-top:20px;border-top:1px solid #8CE5FF;">	
						<div class="col-md-6">
							<div class="col-md-3">
							<label>
							Username
							</label>
							</div><div class="col-md-6">
							<?php echo form_dropdown('user_id',GetOptAll('users','-Username-',array(),'username'),$id_user) ?>
							</div>
						</div>
					</div>
				</div>
				<!--div class="form-group">
					<div class="col-md-12" style="margin-top:20px;border-top:1px solid #8CE5FF;">	
						<div class="col-md-6">
							<div class="col-md-3">
							<label>
							User Group
							</label>
							</div><div class="col-md-6">
							<?php echo form_dropdown('user_group',GetOptAll('groups','-Username-',array(),'username'),$id_user) ?>
							</div>
						</div>
					</div>
				</div-->
				</div>
				<hr>
				<div class="row">
						<?php foreach($modul->result_array() as $mod){ 
						$getv=GetValue('view','users_permission',array('menu_id'=>'where/'.$mod['id'],'user_id'=>'where/'.$id_user));
						$getc=GetValue('create','users_permission',array('menu_id'=>'where/'.$mod['id'],'user_id'=>'where/'.$id_user));
						$getu=GetValue('update','users_permission',array('menu_id'=>'where/'.$mod['id'],'user_id'=>'where/'.$id_user));
						$getd=GetValue('delete','users_permission',array('menu_id'=>'where/'.$mod['id'],'user_id'=>'where/'.$id_user));
						
							$submodul=GetAll('menu',array('id_parents'=>'where/'.$mod['id']));
						?>
							
							<div class="col-md-12" style="margin-top:20px;border-top:1px solid #8CE5FF;">	
								<div class="col-md-2">
								<label>
									<b>
									<?php echo form_hidden('menu[]',$mod['id']) ?>
									
									<?php echo $mod['title'] ?></b>
                                                                    <?php echo form_checkbox('m_v['.$mod['id'].']','1',($getv==0 ? '':'checked')) ?>
                                                                    
								</label>
								</div>
								<!--div class="col-md-2" style="border-left:1px solid #8CE5FF;">
								<?php echo form_checkbox('m_c['.$mod['id'].']','1','1',($getc==0 ? '':'checked')) ?>
								Create
								</div>
								<div class="col-md-2" style="border-left:1px solid #8CE5FF;">
									<?php echo form_checkbox('m_u['.$mod['id'].']','1',($getu==0 ? '':'checked')) ?>
								Update
								</div>
								<div class="col-md-2" style="border-left:1px solid #8CE5FF;">
									<?php echo form_checkbox('m_d['.$mod['id'].']','1',($getd==0 ? '':'checked')) ?>
								Delete
								</div-->
								
							</div>
							<?php foreach($submodul->result_array() as $sm){ 
								
								$getv=GetValue('view','users_permission',array('menu_id'=>'where/'.$sm['id'],'user_id'=>'where/'.$id_user));
								$getc=GetValue('create','users_permission',array('menu_id'=>'where/'.$sm['id'],'user_id'=>'where/'.$id_user));
								$getu=GetValue('update','users_permission',array('menu_id'=>'where/'.$sm['id'],'user_id'=>'where/'.$id_user));
								$getd=GetValue('delete','users_permission',array('menu_id'=>'where/'.$sm['id'],'user_id'=>'where/'.$id_user));
							?>
								
								<div class="col-md-12" style="border-bottom:1px solid grey;">	
									<div class="col-md-2">
										<label>
											<b>&nbsp;</b>
										</label>
									</div>
									<div class="col-md-3">
										<label>
											<b>
											<?php echo form_hidden('submenu[]',$sm['id']) ?>
											
											<?php echo $sm['title'] ?></b></label>
                                                                                     
									</div>
									<div class="col-md-3">       
                                                                                            <?php echo form_checkbox('s_v['.$sm['id'].']','1',($getv==0 ? '':'checked')) ?><label>View</label>
									</div>
									<div class="col-md-3">
                                                                                            <?php echo form_checkbox('s_u['.$sm['id'].']','1',($getu==0 ? '':'checked')) ?><label>Edit</label>
										
									</div>
									<!--div class="col-md-2" style="border-left:1px solid #8CE5FF;">
										<?php echo form_checkbox('s_c['.$sm['id'].']','1',($getc==0 ? '':'checked')) ?>
										Create
									</div>
									<div class="col-md-2" style="border-left:1px solid #8CE5FF;">
										<?php echo form_checkbox('s_u['.$sm['id'].']','1',($getu==0 ? '':'checked')) ?>
										Update
									</div>
									<div class="col-md-2" style="border-left:1px solid #8CE5FF;">
										<?php echo form_checkbox('s_d['.$sm['id'].']','1',($getd==0 ? '':'checked')) ?>
										Delete
									</div-->
									
								</div>
							<?php }  ?>
							
						<?php } ?>


                    <!--div class="col-md-5">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="inputEmail3">
								Tgl. Transaksi
							</label>
							<?php $nm_f="tgl";
							?>
							<div class="col-sm-9">
								<!--Bagian Kanan->
								<?php echo form_input($nm_f,(isset($val[$nm_f]) ? $val[$nm_f] : ''),'class="form-control date" id="'.$nm_f.'" required')?>
								
								<!--//Bagian Kanan->
							</div>
						</div>
						<div class="form-group">
							
						</div>

						
						
                    </div-->
				</div>
				
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