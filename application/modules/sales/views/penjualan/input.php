<!-- start: PAGE TITLE -->
<section id="page-title">
	<div class="row">
		<div class="col-sm-8">
			<h1 class="mainTitle"><?= $main_title?></h1>
			<span class="mainDescription"></span>
		</div>
		<ol class="breadcrumb">
			<li>
				<span>Pages</span>
			</li>
			<li class="active">
				<span><a href="<?=base_url($module.'/'.$file_name)?>"><?= $main_title?></a></span>
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
<!--form role="form" action="<?= base_url($module.'/'.$file_name.'/add')?>" method="post" class="form-horizontal"-->
<?php echo form_open_multipart(base_url($module.'/'.$file_name.'/add'), array('id'=>'form-inv', 'class'=>'form-horizontal'))?>
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
				<div class="row form-row">
					<div class="col-md-6">
						<div class="col-md-6">
							<label class="control-label">Salin Dari Stok Pengeluaran</label>
						</div>
						<div class="col-md-6">
							<select class="select2 select_so" name="no_sj[]" id="list_so" style="width:100%">
								<option value="0">-- Pilih NO. Surat Jalan --</option>
								<?php foreach($so as $p):
									$no = (!empty($p->no)) ? $p->no : date('Ymd', strtotime($p->created_on)).sprintf('%04d',$p->id)
								?>
								<option value="<?=$p->id?>"><?=$no?></option>
								<?php endforeach;?>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="col-md-6">
						</div>
						<div class="col-md-6">
							<button id="add_so" type="button" class="btn btn-xs btn-green" style="display: none">
	                        	<?= lang('add') ?> dari surat jalan <i class="fa fa-plus"></i>
	                    	</button>
						</div>
					</div>
				</div><p></p>
				<div id="select_so">
				</div>
				<hr>
				<div id="dari-so">
				
				</div>
			</div>
		</div>
	</div>
</div>
</form>
<!-- end: INVOICE -->
<script type="text/javascript" src="<?=assets_url('vendor/jquery/jquery.min.js')?>"></script>
<script type="text/javascript">
	function addRow(tableID){
	var table=document.getElementById(tableID);
	var rowCount=table.rows.length;
	var row=table.insertRow(rowCount);

	var cell1=row.insertCell(0);
	var element1=document.createElement("input");
	element1.type="checkbox";
	element1.name="chkbox[]";
	element1.className="checkbox1";
	cell1.appendChild(element1);
	var x = 1;
	var cell2=row.insertCell(x++);
	cell2.innerHTML=rowCount+1-1;

	var cell3=row.insertCell(2);
	<?php $s = array('"', "'");$r=array('&quot;','&#39;');?>
	cell3.innerHTML = "<select name='kode_barang[]' class='select2' id="+'barang_id'+rowCount+" style='width:100%'><?php for($i=0;$i<sizeof($barang);$i++):?><option value='<?php echo $barang[$i]['id']?>'><?php echo $barang[$i]['kode'].' - '.str_replace($s,$r,$barang[$i]['title'])?></option><?php endfor;?></select>";

	var cell4=row.insertCell(x++);
	cell4.innerHTML = '<input name="deskripsi[]" value="0" type="text" class="form-control" required="required" id="deskripsi'+rowCount+'">';

	var cell5=row.insertCell(x++);
	cell5.innerHTML = '<input name="diorder[]" value="0" type="text" class="jumlah text-right" required="required">';

	var cell6=row.insertCell(x++);
	cell6.innerHTML = '<input name="diterima[]" value="0" type="text" class="jumlah text-right" required="required" id="jumlah'+rowCount+'">';

	var cell7=row.insertCell(x++);
	cell7.innerHTML = "<select name='satuan[]' class='select2' style='width:100%'><?php for($i=0;$i<sizeof($satuan);$i++):?><option value='<?php echo $satuan[$i]['id']?>'><?php echo $satuan[$i]['title']?></option><?php endfor;?></select>";

	var cell8=row.insertCell(x++);
	cell8.innerHTML = '<input name="harga[]" value="0" type="text" class="harga text-right" required="required" id="harga'+rowCount+'">';  

	var cell9=row.insertCell(x++);
	cell9.innerHTML = '<input name="disc[]" value="0" type="text" class="text-right" required="required" id="disc'+rowCount+'">';

	var cell10=row.insertCell(x++);
	cell10.innerHTML = '<input name="sub_total[]" type="text" class="subtotal text-right" required="required" id="subtotal'+rowCount+'" readonly>';

	var cell11=row.insertCell(x++);
	cell11.innerHTML = '<input name="pajak[]" value="0" type="text" class="form-control text-right" required="required" id="pajak'+rowCount+'">';

	$("#barang_id"+rowCount).change(function(){
        var id = $(this).val();
         $.ajax({
            type: "GET",
            dataType: "JSON",
            url: '../order/get_nama_barang/'+id,
            success: function(data) {
                $('#deskripsi'+rowCount).val(data);
            }
        });
    })
    .change();

    $('input[type="text"]').keyup(function(){
  $(this).attr({width: 'auto', size: $(this).val().length});
});

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
        totalpluspajak = total + jmlPajak;
        $('#totalPajak').val(addCommas(parseFloat(jmlPajak).toFixed(2)));
        $('#total').val(addCommas(parseFloat(total).toFixed(2)));
        $('#totalpluspajak').val(addCommas(parseFloat(totalpluspajak).toFixed(2)));
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
	}
	function deleteRow(tableID){try{var table=document.getElementById(tableID);var rowCount=table.rows.length;for(var i=0;i<rowCount;i++){var row=table.rows[i];var chkbox=row.cells[0].childNodes[0];if(null!=chkbox&&true==chkbox.checked){table.deleteRow(i);rowCount--;i--;}}}catch(e){alert(e);}}
</script>