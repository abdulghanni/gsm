<script>

	function deletec(val){
			if(confirm('Delete items?')){
				$.ajax({
					type: "POST",
					url: "<?php echo site_url($this->utama."/delete_ledger");?>",
					data: "items="+val,
					success: function(data){
						location.reload();
						//alert(data);
						alert('Sukses!');
					}
				});
			}
	}  
	
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
				$('.select2').select2({allowClear:true});
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
</script>
    <script>
    $(window).on('beforeunload', function(){
        //return "This should create a pop-up";
    });
</script><!-- start: PAGE TITLE -->
<?php error_reporting(0); ?>
<section id="page-title">
	<div class="row">
		<div class="col-sm-8">
			<h1 class="mainTitle">Penerimaan Stok</h1>
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
<form id="form" method="post" enctype="multipart/form-data" action="<?php echo base_url($this->utama)?>/submit" class="form-horizontal formular" role="form" >
				<input type="hidden" name="id" value="<?php echo (isset($val['id']) ? $val['id'] : '') ?>">
		   
			
		   <?php
		   if($pay){
			   $val['voucher']=$val['jo'];
			   $val['ref']=$val['number'];
			   $val['rincian']='Pembayaran Invoice '.$val['number'];
			   $val['doc_tgl']=substr($val['create_date'],0,11);
			   $val['post_tgl']=date("Y-m-d");
			   echo form_hidden('pay','1');
		   } elseif($costruck){
			   $val['voucher']='';
			   $val['ref']=$val['number'];
			   $val['rincian']='Pembayaran Costing '.$val['number'];
			   $val['doc_tgl']=substr($val['create_date'],0,11);
			   $val['post_tgl']=date("Y-m-d");
			   echo form_hidden('pay','1');
		   }
		   ?>
							
								
		   <!--div class="form-group">
			   
			   <?php $nm_f="number";?>
			   <div class="col-sm-3">
				   <label for="<?php echo $nm_f?>"><?php echo ucfirst($nm_f)?></label>
				   </div><div class="col-sm-9">
				   <input type="text" name="<?php echo $nm_f?>"  id="<?php echo $nm_f?>" value="<?php echo $a= (isset($val[$nm_f]) ? $val[$nm_f] : '') ?>" class="col-sm-2 validate[required] text-input" readonly>
			   </div>
		   </div-->
		   <div class="form-group">
			   
			   <?php $nm_f="ref";
			   
								if($pay){$refs=$utamas[$nm_f];}
								else{$refs=(isset($val[$nm_f]) ? $val[$nm_f] : '');}
			   ?>
			   <div class="col-sm-3">
				   <label for="<?php echo $nm_f?>">No. Voucher</label>
				   </div><div class="col-sm-9">
				   <input type="text" name="<?php echo $nm_f?>"  id="<?php echo $nm_f?>" value="<?php echo $refs ?>" class="col-sm-4 validate[required]">
			   </div>
			   </div>
		   <div class="form-group">
			   
			 
			   </div>
				<div class="form-group">
					<?php $nm_f="doc_tgl";?>
					<div class="col-sm-3">
						<label for="<?php echo $nm_f?>">Document Date</label>
					</div>
					<div class="col-sm-3">
						<div class="input-group">
							<?php echo form_input($nm_f,$a= (isset($val[$nm_f]) ? $val[$nm_f] : ''),"id='$nm_f' class='form-control date-picker-this' data-date-format='yyyy-mm-dd'");?>
							<span class="input-group-addon">
								<i class="fa fa-calendar bigger-110"></i>
							</span>
						</div>
					</div>
					<?php $nm_f="post_tgl";?>
					<div class="col-sm-2">
						<label for="<?php echo $nm_f?>">Posting Date</label>
					</div>
					<div class="col-sm-3">
						<div class="input-group">
							<?php echo form_input($nm_f,$a= (isset($val[$nm_f]) ? $val[$nm_f] : ''),"id='$nm_f' class='validate[required,custom[date],future[$mindate]] form-control date-picker-this' data-date-format='yyyy-mm-dd'");?>
							<span class="input-group-addon">
								<i class="fa fa-calendar bigger-110"></i>
							</span>
						</div>
				</div>
				</div>
				<div class="form-group">
					<?php $nm_f="voucher";?>
					<div class="col-sm-3">
						<label for="<?php echo $nm_f?>">Job Number</label>
					</div>
					<div class="col-sm-3">
						<div class="input-group">
							<?php echo form_input($nm_f,$a= (isset($val[$nm_f]) ? $val[$nm_f] : ''),"id='$nm_f' class='form-control' ");?>
							
						</div>
					</div>
					<?php $nm_f="rincian";?>
					<div class="col-sm-2">
						<label for="<?php echo $nm_f?>">Rincian Transaksi</label>
					</div>
					<div class="col-sm-5">
							<?php echo form_input($nm_f,$a= (isset($val[$nm_f]) ? $val[$nm_f] : ''),"id='$nm_f' class='form-control'");?>
							
				</div>
				</div>
				
				<div class="form-group">
					<div class="col-md-11">
					<button type="button" class="btn pull-right" onClick="cekbal()">Save</button>
					</div>
				</div>
				<!--/form-->
			 <fieldset>
				<legend>Detail</legend>
				<button type="button" class="btn" id="add" onClick="tambah()">ADD</button>
				<!--form id="form" method="post" enctype="multipart/form-data" action="<?php echo base_url($this->utama)?>/add_ledger" class="form-horizontal formular" role="form"-->
				<div class="form-group">
					<table class="table table-striped table-bordered bootstrap-datatable responsive">
						<thead>
							<tr>
								<th class="col-md-2">Account</th>
								<th class="col-md-1">Curr</th>
								<th class="col-md-2">Debit</th>
								<th class="col-md-2">Credit</th>
								<th class="col-md-3">Remark</th>
								<th class="col-md-4">Referal</th>
							</tr>
						</thead>
						<tbody><?php 
							if($pay || $costruck){
								if($pay){
								$isi['id']=0;
								$isi['kredit']=numbers($utamas['amount']);
								$isi['debit']=numbers(0);
								$isi['akun']=$utamas['coa'];
								$isi['remark']=$utamas['remark'];
								$isi['ref']=$val['ref'];
								//$isi['ref']=$utamas['ref'];
								}
								else if($costruck){
								$isi['id']=0;
								$isi['debit']=numbers($utamas['amount']);
								$isi['kredit']=numbers(0);
								$isi['akun']=$val['coa'];
								$isi['remark']='Pembayaran Truck Periode '.$val['period'];
								$isi['ref']=$val['invoice'];
		//	print_mz($isi);
								}
							?>
							<tr>
							<?php 
							echo form_hidden('idj[]',$isi['id']); ?>
								<td><?php echo form_dropdown('akun[]',$opt_coa,$isi['akun'],'class="form-control select2"  ')?></td>
								<td><?php echo form_dropdown('rc[]',$opt_curr,(isset($isi['rc']) ? $isi['rc'] : '1'))?></td>
								<td><?php echo form_input('debit[]',$isi['debit'],'class="form-control debit currency " ')?></td>
								<td><?php echo form_input('kredit[]',$isi['kredit'],'class="form-control kredit currency "')?></td>
								<td><?php echo form_input('remark[]',$isi['remark'],'class="form-control"')?></td>
								<td><?php echo form_input('refer[]',$isi['ref'],'class="form-control"')?></td>
							</tr>	
							<?php } ?>
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
								<td><?php echo form_dropdown('rc[]',$opt_curr,(isset($isi['rc']) ? $isi['rc'] : '1'))?></td>
								<td><?php echo form_input('debit[]',$isi['debit']/$isi['kurs'],'class="form-control debit currency " ')?></td>
								<td><?php echo form_input('kredit[]',$isi['kredit']/$isi['kurs'],'class="form-control kredit currency "')?></td>
								<td><?php echo form_input('remark[]',$isi['remark'],'class="form-control"')?></td>
								<td><?php echo form_input('refer[]',$isi['ref'],'class="form-control"')?></td>
							</tr>	
						<?php }?>
							<tr>
								<?php echo form_hidden('idj[]','');?>
								<td><?php echo form_dropdown('akun[]',$opt_coa,'','class=" form-control select2" ')?></td>
								<td><?php echo form_dropdown('rc[]',$opt_curr,(isset($isi['rc']) ? $isi['rc'] : '1'))?></td>
								<td><?php echo form_input('debit[]','','class="form-control debit currency"')?></td>
								<td><?php echo form_input('kredit[]','','class="form-control kredit currency"')?></td>
								<td><?php echo form_input('remark[]','','class="form-control" onClick="addTableRow()"')?></td>
								<td><?php echo form_input('refer[]','','class="form-control" onClick="addTableRow()"')?></td>
							</tr>	
						</tbody>
					</table>
					
				</div>
			 </form>
<!-- end: INVOICE -->
<script type="text/javascript" src="<?=assets_url('vendor/jquery/jquery.min.js')?>"></script>
<script type="text/javascript">
	
	function cariref(val){
		$('#detailtrans').append('<img src="<?php echo base_url().'assets/images/loading.gif' ?>" class="loadingimg">');
		$('#detailtrans').load('<?php echo base_url() ?>stok/penerimaan/cariref',{v:val});
		$('#list').load('<?php echo base_url() ?>stok/penerimaan/carilist',{v:val});
	}
	/* function addRow(tableID){
	var table=document.getElementById(tableID);
	var rowCount=table.rows.length;
	var row=table.insertRow(rowCount);

	var cell1=row.insertCell(0);
	var element1=document.createElement("input");
	element1.type="checkbox";
	element1.name="chkbox["+rowCount+"]";
	element1.className="checkbox1";
	cell1.appendChild(element1);

	var cell2=row.insertCell(1);
	cell2.innerHTML=rowCount+1-1;

	var cell3=row.insertCell(2);
	cell3.innerHTML = "<select name='kode_barang["+rowCount+"]' class='select2' id="+'barang_id'+rowCount+" style='width:100%'><?php for($i=0;$i<sizeof($barang);$i++):?><option value='<?php echo $barang[$i]['id']?>'><?php echo $barang[$i]['kode'].' - '.$barang[$i]['title']?></option><?php endfor;?></select>";  

	var cell4=row.insertCell(3);
	cell4.innerHTML = '<input name="deskripsi['+rowCount+']" value="0" type="text" class="form-control" required="required" id="deskripsi'+rowCount+'">';

	var cell5=row.insertCell(4);
	cell5.innerHTML = '<input name="jumlah['+rowCount+']" value="0" type="text" class="form-control jumlah text-right" required="required" id="jumlah'+rowCount+'">';

	var cell6=row.insertCell(5);
	cell6.innerHTML = "<select name='satuan["+rowCount+"]' class='select2' style='width:100%'><?php for($i=0;$i<sizeof($satuan);$i++):?><option value='<?php echo $satuan[$i]['id']?>'><?php echo $satuan[$i]['title']?></option><?php endfor;?></select>";

	var cell7=row.insertCell(6);
	cell7.innerHTML = '<input name="harga['+rowCount+']" value="0" type="text" class="form-control harga text-right" required="required" id="harga'+rowCount+'">';  

	var cell8=row.insertCell(7);
	cell8.innerHTML = '<input name="disc['+rowCount+']" value="0" type="text" class="form-control text-right" required="required" id="disc'+rowCount+'">';

	var cell9=row.insertCell(8);
	cell9.innerHTML = '<input name="sub_total['+rowCount+']" type="text" class="form-control subtotal text-right" required="required" id="subtotal'+rowCount+'" readonly>';

	var cell10=row.insertCell(9);
	cell10.innerHTML = '<input name="pajak['+rowCount+']" value="0" type="text" class="form-control text-right" required="required" id="pajak'+rowCount+'">';

	$("#barang_id"+rowCount).change(function(){
        var id = $(this).val();
         $.ajax({
            type: "GET",
            dataType: "JSON",
            url: 'get_nama_barang/'+id,
            success: function(data) {
                $('#deskripsi'+rowCount).val(data);
            }
        });
    })
    .change();
	
	$("#subTotalPajak").append('<input name="subpajak['+rowCount+']" value="0" type="hidden" class="subpajak" id="subpajak'+rowCount+'">')
	$("#harga"+rowCount).add("#jumlah"+rowCount).add("#disc"+rowCount).add("#pajak"+rowCount).keyup(function() {
		hitung();
    });

    $('.harga').maskMoney({allowZero:true});
    $('#dibayar, #biaya_pengiriman').keyup(function(){
    	hitung();
    });
		$(function(){
			$('.datepicker').datepicker({
				format: 'mm-dd-yyyy'
			});
		});
    function hitung()
    {
    	var a = parseInt($('#jumlah'+rowCount).val()),
    		bunga = parseFloat($('#bunga').val()),
        	b = parseFloat($('#harga'+rowCount).val().replace(/,/g,"")).toFixed(2),
        	c = parseFloat($('#disc'+rowCount).val()),
        	p = parseFloat($('#pajak'+rowCount).val()).toFixed(2),
        	diBayar = parseFloat($('#dibayar').val().replace(/,/g,"")),
        	biayaPengiriman = parseFloat($('#biaya_pengiriman').val().replace(/,/g,"")),
        	lama_angsuran= parseInt($('#lama_angsuran_1').val()),
        	d = (a*b)*(c/100),//jumlah diskon
       		val = (a*b)-d,
        	subPajak = val*(p/100),//jumlah pajak
        	jmlPajak = 0,
        	total = 0;

        $('#subtotal'+rowCount).val(addCommas(parseFloat(val).toFixed(2)));
        $('#subpajak'+rowCount).val(subPajak);
        $('.subpajak').each(function (index, element) {
            jmlPajak = jmlPajak + parseInt($(element).val());
        });
        $('.subtotal').each(function (index, element) {
            total = total + parseInt($(element).val().replace(/,/g,""));
        });
        total = total+biayaPengiriman;
        totalPlusBunga = (total-diBayar)*(bunga/100);
        totalPlusBunga = (total-diBayar)+totalPlusBunga;
        biayaAngsuran = totalPlusBunga/lama_angsuran;
        $('#totalPajak').val(addCommas(parseFloat(jmlPajak).toFixed(2)));
        $('#total').val(addCommas(parseFloat(total).toFixed(2)));
        var saldo = total-diBayar;
        $('#saldo').val(addCommas(parseFloat(saldo).toFixed(2)));
       	$('#totalplusbunga').val(addCommas(parseFloat(totalPlusBunga).toFixed(2)));
       	$('#biaya_angsuran').val(addCommas(parseFloat(biayaAngsuran).toFixed(2)))
    }

    function addCommas(nStr)
    {
      nStr += '';
      x = nStr.split('.');
      x1 = x[0];
      x2 = x.length > 1 ? '.' + x[1] : '';
      var rgx = /(\d+)(\d{3})/;
      while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
      }
      return x1 + x2;
    }
	} */
	function deleteRow(tableID){try{var table=document.getElementById(tableID);var rowCount=table.rows.length;for(var i=0;i<rowCount;i++){var row=table.rows[i];var chkbox=row.cells[0].childNodes[0];if(null!=chkbox&&true==chkbox.checked){table.deleteRow(i);rowCount--;i--;}}}catch(e){alert(e);}}

</script>