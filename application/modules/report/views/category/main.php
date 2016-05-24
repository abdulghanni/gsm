
<script src="<?php echo assets_url('vendor/bootstrap-datepicker/bootstrap-datepicker.min.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo assets_url('vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css'); ?>">
<?php $document=$document->row_array(); ?>
	<form class="form-horizontal formular" id="form_edit" method="post" action="<?php echo site_url($document['aksi_print']);?>" name="detailreport" target="_blank">
	<h3><?php echo $document['title_document']?></h3>
        
	<?php 
		if($document['attrib']!=NULL){?>
	<fieldset>
		<legend>Kondisi</legend>
		<div class="col-md-12">
			<?php $input=explode(',',$document['attrib']);
			for($a=0;$a<count($input);$a++){
				$this->load->view('report/category/'.$input[$a]);
                                echo "<br/>";
	
			} ?>
		</div>
	</fieldset><?php };?>

	<?php if($document['kolom']!=NULL){?>
	<fieldset>
		<legend>Kolom</legend>
		<div class="col-md-12">
			<input type="hidden" name="category" value="<?php echo $document['aksi_print']?>">
			<input type="hidden" name="idcategory" value="<?php echo $document['id']?>">
			<?php
					$kolom=unserialize($document['kolom']);
					foreach($kolom as $key=>$item){
							
							echo form_checkbox("kolom[$key]",'1','checked').' '.$item.'<br/>';
							
					}
			?>
		</div>
	</fieldset>		
	<?php } ?>

	
	<div class="col-md-12 pull-right">
		<div class="form-group">
			<input class="btn btn-primary" type="submit" name="print" value="Print Preview" style="margin-left:0px;">
		</div>
	</div>
</form>