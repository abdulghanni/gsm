<!-- start: PAGE TITLE -->
<?php error_reporting(0); ?>
<section id="page-title">
	<div class="row">
		<div class="col-sm-8">
			<h1 class="mainTitle">Petty Cash</h1>
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
<form role="form" action="<?= base_url('stok/penerimaan/add')?>" method="post" class="form-horizontal">
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
						</p>
					</div>
				</div>
				<hr>
				<div class="form-group">
			   
			   <?php $nm_f="number";?>
			   <div class="col-sm-3">
				   <label for="<?php echo $nm_f?>"><?php echo ucfirst($nm_f)?></label>
				   </div><div class="col-sm-9">
				   <input type="text" name="<?php echo $nm_f?>"  id="<?php echo $nm_f?>" value="<?php echo $a= (isset($val[$nm_f]) ? $val[$nm_f] : '') ?>" class="col-sm-2 text-input" readonly>
			   </div>
		   </div>
		   <!--div class="form-group">
			   
			   <?php $nm_f="ref";?>
			   <div class="col-sm-3">
				   <label for="<?php echo $nm_f?>">Referal Code</label>
				   </div><div class="col-sm-9">
				   <input type="text" name="<?php echo $nm_f?>"  id="<?php echo $nm_f?>" value="<?php echo $a= (isset($val[$nm_f]) ? $val[$nm_f] : '') ?>" class="col-sm-4 validate[required<?php echo $cekdup?>]">
			   </div>
			   </div-->
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
				<?php $nm_f="coa";?>
				<div class="col-sm-3">
					<label for="<?php echo $nm_f?>">COA</label>
					</div><div class="col-sm-4">
					<?php echo form_dropdown($nm_f,GetOptAll('sv_setup_coa','-COA-',array(),'code','id','name'), (isset($val[$nm_f]) ? $val[$nm_f] : ''),"class='chosen-select form-control'")?>
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
				
		</div>
	</div>
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