<?php error_reporting(E_ALL ^ E_NOTICE);
if(isset($list)){	
	$val=$list->row_array();
}
$cekdup=($type=='New' ? ',ajax[ajaxDuplicatePetty]' : '');
?>

    
<div class="row">
	<ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="<?php echo base_url($this->utama)?>"><?php echo ucfirst($this->utama)?></a>
        </li>
        <li>
            <a href="#"><?php echo $type?></a>
        </li>
    </ul>
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="<?php echo GetValue('icon','sv_menu',array('filez'=>'where/'.$this->utama))?>"></i> <?php echo $this->title;?></h2>

        
    </div>
    	<div class="box-content">
			<form id="form" method="post" enctype="multipart/form-data" action="<?php echo base_url($this->utama)?>/submit" class="form-horizontal formular" role="form">
				<?php echo form_hidden('id',isset($val['id']) ? $val['id'] : '')?>
		   
			
		   
		   <div class="form-group">
			   
			   <?php $nm_f="number";?>
			   <div class="col-sm-3">
				   <label for="<?php echo $nm_f?>"><?php echo ucfirst($nm_f)?></label>
				   </div><div class="col-sm-9">
				   <input type="text" name="<?php echo $nm_f?>"  id="<?php echo $nm_f?>" value="<?php echo $a= (isset($val[$nm_f]) ? $val[$nm_f] : '') ?>" class="col-sm-2 text-input" readonly>
			   </div>
		   </div>
		   <div class="form-group">
			   
			   <?php $nm_f="ref";?>
			   <div class="col-sm-3">
				   <label for="<?php echo $nm_f?>">Referal Code / No Voucher</label>
				   </div><div class="col-sm-9">
				   <input type="text" name="<?php echo $nm_f?>"  id="<?php echo $nm_f?>" value="<?php echo $a= (isset($val[$nm_f]) ? $val[$nm_f] : '') ?>" class="col-sm-4 validate[required<?php echo $cekdup?>]">
			   </div>
			   </div>
		   <div class="form-group">
			   
			   <?php $nm_f="dates";?>
			   <div class="col-sm-3">
				   <label for="<?php echo $nm_f?>">Post Tgl</label>
				   </div><div class="col-sm-4">
						<div class="input-group">
							<?php echo form_input($nm_f,$a= (isset($val[$nm_f]) ? $val[$nm_f] : ''),"id='$nm_f' class='form-control date-picker-this' data-date-format='yyyy-mm-dd'");?>
							<span class="input-group-addon">
								<i class="fa fa-calendar bigger-110"></i>
							</span>
						</div>
			   </div>
			   </div>
		   <div class="form-group">
			   
			   <?php $nm_f="remark";?>
			   <div class="col-sm-3">
				   <label for="<?php echo $nm_f?>">Remark</label>
				   </div><div class="col-sm-9">
				   <input type="text" name="<?php echo $nm_f?>"  id="<?php echo $nm_f?>" value="<?php echo $a= (isset($val[$nm_f]) ? $val[$nm_f] : '') ?>" class="col-sm-4 validate[required<?php echo $cekdup?>]">
			   </div>
			   </div>
		   <div class="form-group">
			   
			   <?php $nm_f="person";?>
			   <div class="col-sm-3">
				   <label for="<?php echo $nm_f?>">Person</label>
				   </div><div class="col-sm-9">
				   <input type="text" name="<?php echo $nm_f?>"  id="<?php echo $nm_f?>" value="<?php echo $a= (isset($val[$nm_f]) ? $val[$nm_f] : '') ?>" class="col-sm-4 validate[required]">
			   </div>
			   </div>
		   <div class="form-group">
			   
			   <?php $nm_f="job_number";?>
			   <div class="col-sm-3">
				   <label for="<?php echo $nm_f?>">Job Number</label>
				   </div><div class="col-sm-9">
				   <input type="text" name="<?php echo $nm_f?>"  id="<?php echo $nm_f?>" value="<?php echo $a= (isset($val[$nm_f]) ? $val[$nm_f] : '') ?>" class="col-sm-4 validate[required]">
			   </div>
			   </div>
		   <div class="form-group">
			   
			   <?php $nm_f="amount";?>
			   <div class="col-sm-3">
				   <label for="<?php echo $nm_f?>"><?php echo ucfirst($nm_f)?></label>
				   </div><div class="col-sm-9">
				   <?php echo form_dropdown('rc',$opt_curr,(isset($val['rc']) ? $val['rc'] : '1'))?>
				   <input type="text" name="<?php echo $nm_f?>"  id="<?php echo $nm_f?>" value="<?php echo $a= (isset($val[$nm_f]) ? $val[$nm_f] : '') ?>" class="col-sm-4 validate[required] currency">
			   </div>
			   </div>
				<div class="form-group">
				<?php $nm_f="from";?>
				<div class="col-sm-3">
					<label for="<?php echo $nm_f?>">From</label>
					</div><div class="col-sm-4">
					<?php echo form_dropdown($nm_f,$opt_from, (isset($val[$nm_f]) ? $val[$nm_f] : ''),"class='chosen-select form-control'")?>
				</div>
				</div>
				<div class="form-group">
				<?php $nm_f="coa";?>
				<div class="col-sm-3">
					<label for="<?php echo $nm_f?>">COA</label>
					</div><div class="col-sm-4">
					<?php echo form_dropdown($nm_f,$opt_coa, (isset($val[$nm_f]) ? $val[$nm_f] : ''),"class='chosen-select form-control'")?>
				</div>
				</div>
				<div class="form-group">
			   
					<div class="col-sm-3">
						<?php $nm_f="save_type";?>
						<label for="<?php echo $nm_f?>" class="">Type</label>
					</div>
				<div class="col-sm-3">
					   <?php $a="in";
						   $mark=($val[$nm_f]==$a ? TRUE : FALSE);
						   //echo $mark;
						   $data = array(
						   'name'        => $nm_f,
						   'id'          => $nm_f,
				'value'       => $a,
						   'checked'     => $mark,
						   'style'       => 'margin:10px',
						   
						   
						   );
						   
						   echo form_radio($data);
						   
					   ?>
					 <label for="<?php echo $nm_f?>"><?php echo $a?></label>&nbsp;&nbsp;&nbsp;&nbsp;
					 
					 
					 <?php $a="out";
						 $mark=($val[$nm_f]==$a ? TRUE : FALSE);
						 //echo $mark;
						 $data = array(
						 'name'        => $nm_f,
						 'id'          => $nm_f,
						 'value'       => $a,
						 'checked'     => $mark,
						 'style'       => 'margin:10px',
						 );
						 
						 echo form_radio($data);
						 
					 ?>
					 <label for="<?php echo $nm_f?>"><?php echo $a?></label>&nbsp;&nbsp;&nbsp;&nbsp;
				 </div>
			</div>
    		<div class="form-group">
            <button type="submit" class="btn pull-right">Submit</button>
            
             </div>
			 </form>
    	</div>
    </div>
    </div>
</div>