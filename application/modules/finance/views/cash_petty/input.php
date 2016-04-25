<!-- start: PAGE TITLE -->
<?php error_reporting(0); ?>
<section id="page-title">
	<div class="row">
		<div class="col-sm-8">
			<h1 class="mainTitle">Kas & Bank</h1>
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
<form role="form" action="<?= base_url('finance/cash_petty/add')?>" method="post" class="form-horizontal">
	<div class="row">
		<div class="col-md-12">
			<div class="invoice">
				<div class="row invoice-logo">
					<div class="col-sm-6">
						<img alt="" src="<?= assets_url('images/your-logo-here.png')?>">
					</div>
					<div class="col-sm-6">
						<p class="text-dark">
							#<?=date('Ymd',strtotime('now')).$last_id?> / <?=dateIndo(date('Y-m-d',strtotime('now')))?> <small class="text-light"></small>
							<input type="hidden" name="no" value="<?=date('Ymd',strtotime('now')).$last_id?>">
                                                        <?php echo form_hidden('id',(isset($val['id']) ? $val['id']:0)); ?>
						</p>
					</div>
				</div>
				<hr>
				<div class="form-group">
			   
			   <?php $nm_f="number";?>
			   <div class="col-sm-3">
				   <label for="<?php echo $nm_f?>"><?php echo ucfirst($nm_f)?></label>
				   </div><div class="col-sm-9">
				   <input type="text" name="<?php echo $nm_f?>"  id="<?php echo $nm_f?>" value="<?php echo $a= (isset($val[$nm_f]) ? $val[$nm_f] : date('Ymd',strtotime('now')).$last_id) ?>" class="col-sm-2 text-input">
			   </div>
		   </div>
		   <div class="form-group">
			   
			   <?php $nm_f="dates";?>
			   <div class="col-sm-3">
				   <label for="<?php echo $nm_f?>">Post Tgl</label>
				   </div><div class="col-sm-4">
						<div class="input-group">
							<?php echo form_input($nm_f,$a= (isset($val[$nm_f]) ? $val[$nm_f] : ''),"id='$nm_f' class='form-control date-picker-this' data-date-format='yyyy-mm-dd'");?>
							
						</div>
			   </div>
			   </div>
		   <div class="form-group">
			   
			   <?php $nm_f="memo";?>
			   <div class="col-sm-3">
				   <label for="<?php echo $nm_f?>">Memo</label>
				   </div><div class="col-sm-9">
				   <input type="text" name="<?php echo $nm_f?>"  id="<?php echo $nm_f?>" value="<?php echo $a= (isset($val[$nm_f]) ? $val[$nm_f] : '') ?>" class="col-sm-4 validate[required<?php echo $cekdup?>]">
			   </div>
			   </div>
		   <div class="form-group">
			   
			   <?php $nm_f="from";?>
			   <div class="col-sm-3">
				   <label for="<?php echo $nm_f?>">Dari / Ke</label>
				   </div><div class="col-sm-9">
				   <input type="text" name="<?php echo $nm_f?>"  id="<?php echo $nm_f?>" value="<?php echo $a= (isset($val[$nm_f]) ? $val[$nm_f] : '') ?>" class="col-sm-4 validate[required]">
			   </div>
			   </div>
		   <div class="form-group">
			   
			   <?php $nm_f="amount";?>
			   <div class="col-sm-3">
				   <label for="<?php echo $nm_f?>">Amount</label>
				   </div><div class="col-sm-9">
				   <input type="text" name="<?php echo $nm_f?>"  id="<?php echo $nm_f?>" value="<?php echo $a= (isset($val[$nm_f]) ? $val[$nm_f] : '') ?>" class="col-sm-4 validate[required]" onclick="jumlahamount()">
			   </div>
			   </div>
		   <div class="form-group">
			   
			   <?php $nm_f="terbilang";?>
			   <div class="col-sm-3">
				   <label for="<?php echo $nm_f?>">Terbilang</label>
				   </div><div class="col-sm-9">
				<?php echo form_textarea($nm_f,$a= (isset($val[$nm_f]) ? $val[$nm_f] : ''),"id='$nm_f' class='date-picker-this' onclick='jumlahamount()' ");?>
			   </div>
			   </div>
		  
		  
                   
				<div class="form-group">
				<?php $nm_f="coa";?>
				<div class="col-sm-3">
					<label for="<?php echo $nm_f?>">Akun Kas</label>
					</div><div class="col-sm-4">
					<?php echo form_dropdown($nm_f,$opt_coa, (isset($val[$nm_f]) ? $val[$nm_f] : ''),"class='select2 form-control' style='border:0px;'")?>
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
                    <fieldset>
				<legend>Detail</legend>
				<button type="button" class="btn" id="add" onClick="tambah()">ADD</button>
				<!--form id="form" method="post" enctype="multipart/form-data" action="<?php echo base_url($this->utama)?>/add_ledger" class="form-horizontal formular" role="form"-->
				<div class="form-group">
					<table class="table table-striped table-bordered bootstrap-datatable responsive">
						<thead>
							<tr>
								<th class="col-md-2">Account</th>
								<th class="col-md-2">Amount</th>
								<th class="col-md-3">Remark</th>
							</tr>
						</thead>
						<tbody>
						<?php
						//print_mz($detail);
						foreach($detail as $isi){
							if($pay){
								$isi['id']=0;
								$isi['debit']=numbers($isi['total']);
								$isi['remark']=$isi['desc'];
								$isi['ref']=$isi['invoice'];
								$isi['kurs']=1;
							}
								elseif($costruck){
									$truck=GetValue('code','master_truck',array('id'=>'where/'.$isi['truck']));
									if($truck==0){
										$truck=GetValue('name','master_vendor',array('id'=>'where/'.$val['vendor']));
										$mess='Penyewaan Truck Client '.$truck." Periode ".$val['period'];
									}
									else{
										$mess='Pembayaran Truck '.$truck." Periode ".$val['period'];
										
									}
									
								$isi['id']=0;
								$isi['kredit']=$isi['amount'];
								$isi['remark']=$mess;
								$isi['kurs']=1;
								$isi['ref']=$val['invoice'];
								}
							
							?>
							<tr>
							<?php 
							echo form_hidden('idj[]',$isi['id']); ?>
								<td><?php echo form_dropdown('akun[]',$opt_coa,$isi['akun'],'class="form-control select2" ')?></td>
								<td><?php echo form_input('amounts[]',$isi['amount']/$isi['kurs'],'class="form-control debit currency duit " ')?></td>
								<td><?php echo form_input('remark[]',$isi['remark'],'class="form-control"')?></td>
							</tr>	
						<?php }?>
							<tr>
								<?php echo form_hidden('idj[]','');?>
								<td><?php echo form_dropdown('akun[]',$opt_coa,'','class=" form-control select2" ')?></td>
								<td><?php echo form_input('amounts[]','0','class="form-control debit currency duit"')?></td>
								<td><?php echo form_input('remark[]','','class="form-control" onClick="addTableRow()"')?></td>
							</tr>	
						</tbody>
					</table>
					
				</div>
    		<div class="form-group">
            <button type="submit" class="btn pull-right">Submit</button>
             </div>
				
		</div>
	</div>
</div>
</form>
<!-- end: INVOICE -->
<script type="text/javascript" src="<?=assets_url('vendor/jquery/jquery.min.js')?>"></script>
<script type="text/javascript">
     
function tambah(){
	//alert('go');
$('.select2').select2('destroy'); 
  //location.reload();
	/* var $select = $('.select2').select2();
//console.log($select);
$select.each(function(i,item){
  //console.log(item);
  $(item).select2("destroy");
}); */
  setTimeout(addrow(), 2000);
  setTimeout(addlines(), 3000);
  setTimeout(selectadd(), 4000);
};
$('.debit').change(function(e){
    jumlahamount();
});
function terbilang(){
    var totalamount=$('#amount').val();
    $.post("<?php echo base_url()?>finance/cash_petty/terbilang",{v:totalamount},function(e){
        $('#terbilang').val(e);
    });
}
function jumlahamount(){
    var debit = 0;
    
$('.debit').each(function(){
    if($(this).val()){
    a=$(this).val();
    //alert(a);
    var a= a.replace(',','');
    var a= a.replace(',','');
    var a= a.replace(',','');
    var a= a.replace(',','');
    var a= a.replace(',','');
    var a= a.replace(',','');
    var a= a.replace(',','');
    var a= a.replace(',','');
    var a= a.replace(',','');
    var a= a.replace(',','');
    var a= a.replace(',','');
        //alert(a);
    debit += parseFloat(a);}
    else{
    debit+=0;
        }
        
        //Or this.innerHTML, this.innerText 
});
    if(isNaN(debit)){
    $('#amount').val(0);
    }
else{
    $('#amount').val(debit);
    
    }
    terbilang();
}

function addrow(){
  $("table tr:last").clone().appendTo("table");
}
function addlines(){
    $('.currency').maskMoney({thousands:",",decimal:".",precision:2});
}
function selectadd(){	//////////////////
				//select2
				//$('select.form-select').select2();
				//$('.select2').select2({allowClear:true});
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				}); 
				//////////////////
				}

function cekbal(){
    var totaldeb = 0;
    var totalkred = 0;
	$( ".debit" ).each( function(e){
		var a=$( this ).val();
		var a= a.replace(',','');
		var a= a.replace(',','');
		var a= a.replace(',','');
		var a= a.replace(',','');
		var a= a.replace(',','');
		totaldeb += parseFloat( a ) || 0;
	});
	$( ".kredit" ).each( function(e){
		var b=$( this ).val();
		var b= b.replace(',','');
		var b= b.replace(',','');
		var b= b.replace(',','');
		var b= b.replace(',','');
		var b= b.replace(',','');
		totalkred += parseFloat( b ) || 0;
	});
	
			
	var balance=totaldeb-totalkred;
	if(balance==0){
		$('#form').submit();
	}
	else{
    alert('Kredit '+totalkred);	
    alert('Debit '+totaldeb);	
    alert('Belum Balance!!');	
	}
}
   $(document).ready(function(e){
        
    $('.duit, #amount').maskMoney({allowZero:true});
        
        //$('.select2').select2();
        $('#dates').datepicker();
    });
	
	function cariref(val){
		$('#detailtrans').append('<img src="<?php echo base_url().'assets/images/loading.gif' ?>" class="loadingimg">');
		$('#detailtrans').load('<?php echo base_url() ?>stok/penerimaan/cariref',{v:val});
		$('#list').load('<?php echo base_url() ?>stok/penerimaan/carilist',{v:val});
	}
	
	function deleteRow(tableID){try{var table=document.getElementById(tableID);var rowCount=table.rows.length;for(var i=0;i<rowCount;i++){var row=table.rows[i];var chkbox=row.cells[0].childNodes[0];if(null!=chkbox&&true==chkbox.checked){table.deleteRow(i);rowCount--;i--;}}}catch(e){alert(e);}}

</script>