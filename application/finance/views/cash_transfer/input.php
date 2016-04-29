<!-- start: PAGE TITLE -->
<?php error_reporting(0); ?>
<section id="page-title">
	<div class="row">
		<div class="col-sm-8">
			<h1 class="mainTitle">Transfer Kas</h1>
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
<form role="form" action="<?= base_url('finance/cash_transfer/add')?>" method="post" class="form-horizontal">
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
                                                        <?php echo form_hidden('id',isset($val['id']) ? $val['id'] : 0); ?>
						</p>
					</div>
				</div>
				<hr>
                     <div class="form-group">
				<?php $nm_f="dari";?>
				<div class="col-sm-3">
					<label for="<?php echo $nm_f?>">Dari Kas</label>
					</div><div class="col-sm-4">
					<?php echo form_dropdown($nm_f,$opt_coa, (isset($val[$nm_f]) ? $val[$nm_f] : ''),"class='select2 form-control' style='border:0px;'")?>
				</div>
                    </div>
                     <div class="form-group">
				<?php $nm_f="ke";?>
				<div class="col-sm-3">
					<label for="<?php echo $nm_f?>">Ke Kas</label>
					</div><div class="col-sm-4">
					<?php echo form_dropdown($nm_f,$opt_coa, (isset($val[$nm_f]) ? $val[$nm_f] : ''),"class='select2 form-control' style='border:0px;'")?>
				</div>
                    </div>
                    
                                
                    <div class="form-group">
			   
			   <?php $nm_f="number";?>
			   <div class="col-sm-3">
				   <label for="<?php echo $nm_f?>"><?php echo ucfirst($nm_f)?></label>
				   </div><div class="col-sm-9">
				   <input type="text" name="<?php echo $nm_f?>"  id="<?php echo $nm_f?>" value="<?php echo $a= (isset($val[$nm_f]) ? $val[$nm_f] : date('Ymd',strtotime('now')).$last_id) ?>" class="col-sm-2 text-input" >
			   </div>
		   </div>
		   <div class="form-group">
			   
			   <?php $nm_f="tanggal";?>
			   <div class="col-sm-3">
				   <label for="<?php echo $nm_f?>">Post Tgl</label>
				   </div><div class="col-sm-4">
						<div class="input-group">
							<?php echo form_input($nm_f,$a= (isset($val[$nm_f]) ? $val[$nm_f] : date("Y-m-d")),"id='$nm_f' class='form-control date-picker-this' data-date-format='yyyy-mm-dd'");?>
							
						</div>
			   </div>
			   </div>
		   <div class="form-group">
			   
			   <?php $nm_f="ref";?>
			   <div class="col-sm-3">
				   <label for="<?php echo $nm_f?>">Ref</label>
				   </div><div class="col-sm-9">
				   <input type="text" name="<?php echo $nm_f?>"  id="<?php echo $nm_f?>" value="<?php echo $a= (isset($val[$nm_f]) ? $val[$nm_f] : '') ?>" class="col-sm-4 validate[required<?php echo $cekdup?>]">
			   </div>
			   </div>
		   <div class="form-group">
			   
			   <?php $nm_f="keterangan";?>
			   <div class="col-sm-3">
				   <label for="<?php echo $nm_f?>">Keterangan</label>
				   </div><div class="col-sm-9">
				   <input type="text" name="<?php echo $nm_f?>"  id="<?php echo $nm_f?>" value="<?php echo $a= (isset($val[$nm_f]) ? $val[$nm_f] : '') ?>" class="col-sm-4 validate[required<?php echo $cekdup?>]">
			   </div>
			   </div>
		  
		    <div class="form-group">
			   <?php $nm_f="currency";?>
			   <div class="col-sm-3">
				   <label for="<?php echo $nm_f?>">Currency</label>
				   </div><div class="col-sm-9">
                                       <?php echo form_dropdown($nm_f,GetOptAll('kurensi'),isset($val[$nm_f]) ? $val[$nm_f] : '','class="validate[required]"')?><?php $nm_f="kurs";?>
                                       <?php echo form_input($nm_f,isset($val[$nm_f]) ? $val[$nm_f] : '','class="validate[required] duit" placeholder="Kurs"')?>
			   </div>
                    </div>
                                
		    <div class="form-group">
			   <?php $nm_f="amount";
                           ?>
			   <div class="col-sm-3">
				   <label for="<?php echo $nm_f?>">Amount</label>
				   </div><div class="col-sm-9">
				   <input type="text" name="<?php echo $nm_f?>"  id="<?php echo $nm_f?>" value="<?php echo $a= (isset($val[$nm_f]) ? $val['rv'] : '') ?>" class="col-sm-4 validate[required]">
			   </div>
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