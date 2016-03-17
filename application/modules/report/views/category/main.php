
        <script src="<?php echo assets_url('vendor/bootstrap-datepicker/bootstrap-datepicker.min.js'); ?>"></script>
        <link rel="stylesheet" href="<?php echo assets_url('vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css'); ?>">
<?php $document=$document->row_array(); ?>
<body>
	
	<form class="form-horizontal formular" id="form_edit" method="post" action="<?php echo site_url($document['aksi_print']);?>" name="detailreport" target="_blank">
	<h3><?php echo $document['title_document']?></h3>
	<fieldset>
		<legend>Kondisi</legend>
		<div class="col-md-12">
	<?php 
		if($document['attrib']!=NULL){
			$input=explode(',',$document['attrib']);
			for($a=0;$a<count($input);$a++){
				$this->load->view('report/category/'.$input[$a]);
			}};?>
	
</div>
	</fieldset>
	<fieldset>
		<legend>Kolom</legend>
		<div class="col-md-12">
<input type="hidden" name="category" value="<?php echo $document['aksi_print']?>">
<input type="hidden" name="idcategory" value="<?php echo $document['id']?>">
	<?php if($document['kolom']!=NULL){
			$kolom=unserialize($document['kolom']);
			foreach($kolom as $key=>$item){
					
					echo form_checkbox("kolom[$key]",'1','checked').' '.$item.'<br/>';
					
			}
			
	} ?>

	
</div>
	</fieldset>
	<div class="col-md-12">
			<div class="form-group">
	<input class="btn" type="submit" name="print" value="Print Preview" style="margin-left:0px;">
	</div>
	</div>
	</body>
</form>
<script>

		/* 
					$('.chosen-select').chosen({allow_single_deselect:true}); 
			$('.date-picker').datepicker({
				autoclose: true,
				todayHighlight: true
			}).next().on(ace.click_event, function(){
				$(this).prev().focus();
			}); */
</script>