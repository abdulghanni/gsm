<link href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.css" rel="stylesheet"/>
<!-- start: PAGE TITLE -->
<script>
        function klikdisini(){
            if($('.allcek').is(':checked')){
            $('.checkboxx').prop('checked', true); 
            $('.checkboxx').prop('unchecked', false); 
                
            }else{
            $('.checkboxx').prop('checked', false); 
            $('.checkboxx').prop('unchecked', true); 
                
            }
            
        }
</script>
<section id="page-title">
	<div class="row">
		<div class="col-sm-8">
			<h1 class="mainTitle">Hak Akses Laporan</h1>
			<span class="mainDescription"></span>
		</div>
		<ol class="breadcrumb">
			<li>
				<span>Pages</span>
			</li>
			<li class="active">
				<span><a href="<?=base_url('pengaturan/laporan')?>">Hak Akses Laporan</a></span>
			</li>
			<li>
				<span><a href="<?=base_url('pengaturan/laporan')?>">input</a></span>
			</li>
		</ol>
	</div>
</section>
<!-- end: PAGE TITLE -->
<!-- start: INVOICE -->
<div class="container-fluid container-fullw bg-white">
        
<form role="form" action="<?= base_url('pengaturan/laporan/add')?>" method="post" class="form-horizontal">
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
					<div class="col-md-12">	
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
				</div>
                            <div class="row">
                                <table id="tabledata" >
            <thead>
            <tr>
                <th><?php echo form_checkbox('checkall','1',FALSE,'onclick="klikdisini()" class="allcek"')?>Hak</th>
                <th>Laporan</th>
                <th>Deskripsi</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($laporan->result_array() as $rp){
                $getv=GetValue('view','report_permission',array('menu_id'=>'where/'.$rp['id'],'user_id'=>'where/'.$id_user));
                ?>
            <tr><?php echo form_hidden('laporan[]',$rp['id']) ?>
                <td><?php echo form_checkbox('m_v['.$rp['id'].']','1',($getv==0 ? FALSE:TRUE),' class="checkboxx"') ?></td>
                <td><?php echo $rp['title_document']?></td>
                <td><?php echo $rp['detail']?></td>
            </tr>
            <?php }?>
            </tbody>
        </table>    
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
                        $('#tabledata').dataTable({
                            
    "bPaginate": false
                        });
	});
</script>