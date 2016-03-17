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
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Barang Produksi
							</label>
							<div class="col-sm-8">
								<?php 
			                    	$js = 'class="select2" style="width:100%" id="output"';
			                    	echo form_dropdown('title',$opt_produksi,'',$js); 
			                  	?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Tanggal
							</label>
							<div class="col-sm-8">
								<?php 
			                    	$js = 'class="select2" style="width:100%" id="tgl"';
			                    	echo form_input('tgl',date('Y-m-d'),'class="datepicker"'); 
			                  	?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Jumlah
							</label>
							<div class="col-sm-8">
								<?php 
			                    	$js = 'class="select2" style="width:100%" id="tgl"';
			                    	echo form_input('jumlah','1','id="jumlahbikin"'); 
			                  	?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Catatan
							</label>
							<div class="col-sm-8">
								<?php 
			                    	$js = 'class="select2" style="width:100%" id="tgl"';
			                    	echo form_textarea('keterangan','',''); 
			                  	?>
							</div>
						</div>
						

                    </div>

                    <div class="col-md-6">
                    	
                    </div>
				</div>
				<div id="barangproduksi">
				</div>
			</div>
		</div>
	</div>
</div>
</form>
<!-- end: INVOICE -->
<script type="text/javascript" src="<?=assets_url('vendor/jquery/jquery.min.js')?>"></script>
<script type="text/javascript">
	$(document).ready(function(e){
		
		$('.datepicker')
        .datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "yyyy-mm-dd"
        });
		$('#output').change(function(e){
				$('#barangproduksi').empty();
			var val=$('#output').val();
			$('#barangproduksi').append('<img src="<?php echo base_url().'assets/images/loading.gif' ?>" class="loadingimg">');
			$('#barangproduksi').load('<?php echo base_url() ?>stok/produksi/mentahlist',{v:val});
		
		});
	});
	function addRow(tableID){
		var table=document.getElementById(tableID);
		var rowCount=table.rows.length;
		var row=table.insertRow(rowCount);
		
		/* var cell1=row.insertCell(0);
		var element1=document.createElement("input");
		element1.type="checkbox";
		element1.name="chkbox[]";
		element1.className="checkbox1";
		cell1.appendChild(element1); */
		
		var cell1=row.insertCell(0);
		cell1.innerHTML=rowCount+1-1;
		
		var cell2=row.insertCell(1);
		<?php $s = array('"', "'");$r=array('&quot;','&#39;');?>
		cell2.innerHTML = "<select name='barang_komposisi[]' class='select2' id="+'barang_id'+rowCount+" style='width:100%'><?php for($i=0;$i<sizeof($barang);$i++):?><option value='<?php echo $barang[$i]['id']?>'><?php echo $barang[$i]['kode'].' - '.str_replace($s,$r,$barang[$i]['title'])?></option><?php endfor;?></select>";  
		
		/* var cell4=row.insertCell(3);
		cell4.innerHTML = '<input name="deskripsi[]" value="0" type="text" class="form-control" required="required" id="deskripsi'+rowCount+'">'; */
		
		var cell3=row.insertCell(2);
		cell3.innerHTML = '<input name="jumlah_komposisi[]" value="0" type="text" class="jumlah text-right" required="required" id="jumlah'+rowCount+'">';
		
		var cell4=row.insertCell(3);
		cell4.innerHTML = "<select name='satuan[]' class='select2' style='width:100%' readonly='readonly'><?php for($i=0;$i<sizeof($satuan);$i++):?><option value='<?php echo $satuan[$i]['id']?>'><?php echo $satuan[$i]['title']?></option><?php endfor;?></select>";
		
		
		/* $("#barang_id"+rowCount).change(function(){
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
		.change(); */
		
		$("#subTotalPajak").append('<input name="subpajak[]" value="0" type="hidden" class="subpajak" id="subpajak'+rowCount+'">')
		$("#harga"+rowCount).add("#jumlah"+rowCount).add("#disc"+rowCount).add("#pajak"+rowCount).keyup(function() {
			hitung();
		});
		
		$('.harga').maskMoney({allowZero:true});
		$('#dibayar, #biaya_pengiriman').keyup(function(){
			hitung();
		});
		function hitung()
		{
			var a = parseInt($('#jumlah'+rowCount).val()),
        	b = parseFloat($('#harga'+rowCount).val().replace(/,/g,"")).toFixed(2),
        	c = parseFloat($('#disc'+rowCount).val()),
        	p = parseFloat($('#pajak'+rowCount).val()).toFixed(2),
        	diBayar = parseFloat($('#dibayar').val().replace(/,/g,"")),
        	biayaPengiriman = parseFloat($('#biaya_pengiriman').val().replace(/,/g,"")),
        	d = (a*b)*(c/100),//jumlah diskon
       		val = (a*b)-d,
       		disc = (a*b)*(c/100),
        	subPajak = val*(p/100),//jumlah pajak
        	jmlPajak = 0,
        	jmlDisc = 0,
        	total = 0;
			
			$('#subtotal'+rowCount).val(addCommas(parseFloat(val).toFixed(2)));
			$('#subpajak'+rowCount).val(subPajak);
			$("#subdisc"+rowCount).val(addCommas(parseFloat(disc).toFixed(2)));
			$('.subpajak').each(function (index, element) {
				jmlPajak = jmlPajak + parseInt($(element).val());
			});
			$('.subtotal').each(function (index, element) {
				total = total + parseInt($(element).val().replace(/,/g,""));
			});
			$('.subdisc').each(function (index, element) {
				jmlDisc = jmlDisc + parseFloat($(element).val().replace(/,/g,""));
			});
			total = total+biayaPengiriman;
			totalpluspajak = total + jmlPajak;
			diBayar = totalpluspajak * (diBayar/100);
			$('#totalPajak').val(addCommas(parseFloat(jmlPajak).toFixed(2)));
			$('#total').val(addCommas(parseFloat(total).toFixed(2)));
			$('#totalpluspajak').val(addCommas(parseFloat(totalpluspajak).toFixed(2)));
			$('#total-diskon').val(addCommas(parseFloat(jmlDisc).toFixed(2)));
			var saldo = totalpluspajak-diBayar;
			$('#saldo').val(addCommas(parseFloat(saldo).toFixed(2)));
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
	}
	function deleteRow(tableID){try{var table=document.getElementById(tableID);var rowCount=table.rows.length;for(var i=0;i<rowCount;i++){var row=table.rows[i];var chkbox=row.cells[0].childNodes[0];if(null!=chkbox&&true==chkbox.checked){table.deleteRow(i);rowCount--;i--;}}}catch(e){alert(e);}}
</script>