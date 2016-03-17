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
				<span><a href="<?=base_url($module.'/'.$file_name)?>">order</a></span>
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
<form role="form" action="<?= base_url($module.'/'.$file_name.'/add')?>" method="post" class="form-horizontal" id="form-so">
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
							<input type="hidden" name="no" value="<?=date('Ymd',strtotime('now')).$last_id?>">
						</p>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Kepada
							</label>
							<div class="col-sm-8">
								<?php 
			                    	$js = 'class="select2" style="width:100%" id="kontak_id"';
			                    	echo form_dropdown('kontak_id', $options_kontak,'',$js); 
			                  	?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Up.
							</label>
							<div class="col-sm-8">
								<div id="up">
									<input type="text" placeholder="Up" name="up" id="" class="form-control" required="required">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Alamat
							</label>
							<div class="col-sm-8">
								<select id="alamat" class="select2" style="width:100%" name="alamat">
									<option value="">-- Pilih Alamat Customer --</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Mata Uang
							</label>
							<div class="col-sm-8">
								<div class="clip-radio radio-primary">
									<?php foreach($kurensi as $k):?>
									<input type="radio" id="kurensi<?=$k->id?>" name="kurensi_id" value="<?=$k->id?>" <?= ($k->id == 1)?'checked':'';?>>
									<label for="kurensi<?=$k->id?>">
										<?=$k->title.'('.$k->simbol.')'?>
									</label>
									<?php endforeach;?>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Catatan
							</label>
							<div class="col-sm-8">
								<textarea class="form-control" name="catatan"></textarea>
							</div>
						</div>

                    </div>

                    <div class="col-md-6">
                    	<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Dikirim Dari
							</label>
							<div class="col-sm-8">
								<select class="select2" name="gudang_id" style="width:100%">
								<option value="0">-- Pilih Gudang --</option>
								<?php 
                                	foreach($gudang as $g):?>
                                	<option value="<?=$g->id?>"><?=$g->title?></option>
                              	<?php endforeach;?>
                              	</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Tgl. Pengantaran
							</label>
							<div class="col-sm-8">
								<div id="tanggal_transaksi" class="input-append date success no-padding">
                                  <input type="text" class="form-control" name="tanggal_transaksi" required>
                                  <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                                </div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								No. SO
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="No. SO" name="so" class="form-control" value="<?=$last_id.'/SO-I/GSM/'.monthRomawi(date('m')).'/'.date('Y')?>" required="required">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Project
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="Project" name="project" class="form-control" value="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Term
							</label>
							<div class="col-sm-8">
								<div class="clip-radio radio-primary">
									<?php foreach($metode as $m):?>
									<input type="radio" id="metode<?=$m->id?>" name="metode_pembayaran_id" value="<?=$m->id?>" <?= ($m->title == 'Cash')?'checked':'';?>>
									<label for="metode<?=$m->id?>">
										<?=$m->title?>
									</label>
									<?php endforeach;?>
								</div>
							</div>
						</div>
						<div id="kredit" style="display:none">
							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputPassword3">
									Tempo Pembayaran
								</label>
								<div class="col-sm-2">
									<input type="text" placeholder="" name="lama_angsuran_1" id="lama_angsuran_1" class="form-control text-right" value="0">
								</div>
								<div class="col-sm-6">
									<select class="select2" name="lama_angsuran_2" id="lama_angsuran_2" style="width:100%">
									<option value="0">-- Pilih Lama Angsuran --</option>
									<option value="hari">Hari</option>
									<option value="bulan">Bulan</option>
									<option value="tahun">Tahun</option>
	                              	</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Komponen Pajak
							</label>
							<div class="col-sm-6">
								<div id="pajak">
								<?php foreach($pajak_komponen as $p):?>
								<div class="checkbox clip-check check-primary checkbox-inline">
									<input type="checkbox" id="kpajak<?=$p->id?>" value="<?=$p->id?>" class="<?=$p->title?>" name="pajak_komponen_id[]">
									<label for="kpajak<?=$p->id?>">
										<?=$p->title?>
									</label>
								</div>
								<?php endforeach;?>
								</div>
							</div>
						</div>
                    </div>
				</div>
				<button id="btnAdd" type="button" class="btn btn-green" onclick="addRow('table')">
                    <?= lang('add').' '.lang('item') ?> <i class="fa fa-plus"></i>
                </button>
                <button id="btnRemove" type="button" class="btn btn-red" onclick="deleteRow('table')" style="display:none">
                    <?= 'Remove' ?> <i class="fa fa-remove"></i>
                </button>
				<div class="row">
					<div class="col-sm-12">
					<div class="table-responsive">
						<table id="table" class="table table-striped">
							<thead>
								<tr>
									<th width="5%"> # </th>
									<th width="5%"> No. </th>
									<th width="10%"> Kode Barang </th>
									<th width="10%"> SS Barang </th>
									<th width="20%"> Deskripsi </th>
									<th width="5%">Quantity</th>
									<th width="10%"> Satuan </th>
									<th width="15%"> Harga </th>
									<th width="5%">Disc(%)</th>
									<th width="15%"> Sub Total </th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
					</div>
				</div>
				<div class="row">
					<input type="hidden" name="dp" value="0">
					<div id="subTotalPajak"></div>
					<div class="row">
						<div id="panel-total" class="panel-body col-md-5 pull-right" style="display:none">
							<ul class="list-group">
							
								<li class="list-group-item" id="totalPPN">
									<div class="row">
										<div class="col-md-4">
										PPN 10%
										</div>
										<div class="col-md-6 pull-right">
										<input type="text" id="totalPajak" name="total-ppn" value="0" class="form-control text-right">
										</div>
									</div>
								</li>
								<li class="list-group-item" id="totalPPH22">
									<div class="row">
										<div class="col-md-4">
										PPH 22
										</div>
										<div class="col-md-6 pull-right">
										<input type="text" id="totalp2" name="total-pph22" value="0" class="form-control text-right">
										</div>
									</div>
								</li>
								<li class="list-group-item" id="totalPPH23">
									<div class="row">
										<div class="col-md-4">
										PPH 23
										</div>
										<div class="col-md-6 pull-right">
										<input type="text" id="totalp3" name="total-pph23" value="0" class="form-control text-right">
										</div>
									</div>
								</li>
						
								<li class="list-group-item">
									<div class="row">
										<div class="col-md-4">
										Biaya Pengiriman
										</div>
										<div class="col-md-6 pull-right">
										<input type="text" name="biaya_pengiriman" id="biaya_pengiriman" class="form-control text-right" value="0">
										</div>
									</div>
								</li>
								<li class="list-group-item">
									<div class="row">
										<div class="col-md-4">
										Diskon
										</div>
										<div class="col-md-6 pull-right">
										<input type="text" name="total-diskon" id="total-diskon" class="form-control text-right" value="0" readonly>
										</div>
									</div>
								</li>
								<li class="list-group-item">
									<div class="row">
										<div class="col-md-4">
										Total
										</div>
										<div class="col-md-6 pull-right">
										<input type="text" class="form-control text-right" id="total" value="0" readonly="readonly">
										</div>
									</div>
								</li>
								
								<li class="list-group-item">
									<div class="row">
										<div class="col-md-4">
										Total+Pajak
										</div>
										<div class="col-md-6 pull-right">
										<input type="text" class="form-control text-right" id="totalpluspajak" value="0" readonly="readonly">
										</div>
									</div>
								</li>
								
								<div id="total_angsuran" style="display:none">
									<li class="list-group-item">
										<div class="row">
											<div class="col-md-6">
											Uang Muka
												<div class="checkbox clip-check check-primary checkbox-inline">
													<input type="checkbox" id="dp-persen-cek" value="" name="row">
													<label for="dp-persen-cek">
														Persen
													</label>
												</div>
											</div>
											<div id="dp-persen">
												<div class="col-md-4">
												<input type="text" name="dibayar" id="dibayar" class="form-control text-right" value="0">
												</div>
												<div class="col-md-1">
												%
												</div>
											</div>
											<div id="dp-nominal">
												<div class="col-md-6">
													<input type="text" name="dibayar-nominal" id="dibayar-nominal" class="form-control text-right" value="0">
												</div>
											</div>
										</div>
									</li>
									<li class="list-group-item">
										<div class="row">
											<div class="col-md-4">
											Saldo
											</div>
											<div class="col-md-6 pull-right">
											<input type="text" id="saldo" class="form-control text-right" value="0" readonly="readonly">
											</div>
										</div>
									</li>
								</div>
							</ul>
						</div>
					</div>
					<div class="row" id="btnSubmit">
						<div class="col-md-7"></div>
						<div class="col-md-2">
						<button type="button" id="btnDraft" class="btn btn-lg btn-green hidden-print pull-right" style="">
							Save as Draft <i class="fa fa-save"></i>
						</button>
						</div>
						<div class="col-md-1">
						</div>
						<div class="col-md-2">
						<button type="submit"  class="btn btn-lg btn-primary hidden-print pull-right">
							Submit Order <i class="fa fa-check"></i>
						</button>
						</div>
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

	var cell2=row.insertCell(1);
	cell2.innerHTML=rowCount+1-1;

	var cell3=row.insertCell(2);
	<?php $s = array('"', "'");$r=array('&quot;','&#39;');?>
	cell3.innerHTML = "<select name='kode_barang[]' class='select2' id="+'barang_id'+rowCount+" style='width:100%'><option value='0'>- Pilih Barang --</option><?php for($i=0;$i<sizeof($barang);$i++):?><option value='<?php echo $barang[$i]['id']?>'><?php echo $barang[$i]['kode'].' - '.str_replace($s,$r,$barang[$i]['title'])?></option><?php endfor;?></select>";  

	<?php $src = assets_url('assets/images/no-image-mid.png')?>
	var cell4=row.insertCell(3);
	cell4.innerHTML = '<img width="100px" width="100px" id="photo'+rowCount+'" src="<?=$src?>" />';


	var cell5=row.insertCell(4);
	cell5.innerHTML = '<textarea name="deskripsi[]" value="0" class="form-control" required="required" id="deskripsi'+rowCount+'"></textarea>';

	var cell6=row.insertCell(5);
	cell6.innerHTML = '<input name="jumlah[]" value="0" type="text" class="form-control jumlah text-right" required="required" id="jumlah'+rowCount+'">';

	var cell7=row.insertCell(6);
	cell7.innerHTML = "<select name='satuan[]' class='select2' style='width:100%' id="+'satuanlist'+rowCount+"><?php for($i=0;$i<sizeof($satuan);$i++):?><option value='<?php echo $satuan[$i]['id']?>'><?php echo $satuan[$i]['title']?></option><?php endfor;?></select>";

	var cell8=row.insertCell(7);
	cell8.innerHTML = '<input name="harga[]" value="0" type="text" class="form-control harga text-right" required="required" id="harga'+rowCount+'">';  

	var cell9=row.insertCell(8);
	cell9.innerHTML = '<input name="disc[]" value="0" type="text" class="form-control text-right" required="required" id="disc'+rowCount+'"><input type="hidden" name="subdisc[]" class="form-control text-right subdisc" value="0" id="subdisc'+rowCount+'">';

	var cell10=row.insertCell(9);
	cell10.innerHTML = '<input name="sub_total[]" type="text" class="form-control subtotal text-right" required="required" id="subtotal'+rowCount+'" readonly>';

	$("#barang_id"+rowCount).change(function(){
        var id = $(this).val();
         $.ajax({
            type: "GET",
            dataType: "JSON",
            url: '/gsm/purchase/order/get_nama_barang/'+id,
            success: function(data) {
            	if(id != '0'){
            		$("#deskripsi"+rowCount).val(data.nama_barang);
            		if(data.photo != ''){
			            $("#photo"+rowCount).attr("src", "http://"+window.location.host+"/gsm/uploads/barang/"+id+"/"+data.photo);
			        }else{
			            $("#photo"+rowCount).attr("src", "http://"+window.location.host+"/gsm/assets/assets/images/no-image-mid.png");    
			        }
			        $("#satuanlist"+rowCount).select2().select2('val',data.satuan);
		                $("#harga"+rowCount).val(data.harga);
            	}
            }
        });
    })

	$("#subTotalPajak").append('<input name="subpajak[]" value="0" type="hidden" class="subpajak" id="subpajak'+rowCount+'">')
	$("#harga"+rowCount).add("#jumlah"+rowCount).add("#disc"+rowCount).add("#pajak"+rowCount).keyup(function() {
		hitung();
    });

    $('.harga').maskMoney({allowZero:true});
    $('.biaya_pengiriman').maskMoney({allowZero:true});
    $("#dibayar").maskMoney({allowZero:true}).attr('maxlength', 6);
    $("#dibayar-nominal").maskMoney({allowZero:true});
    $('.harga').maskMoney({allowZero:true});
    $('#dibayar,#dibayar-nominal, #biaya_pengiriman').keyup(function(){
    	hitung();
    });

    function hitung()
    {
    	if($('#dp-persen-cek').is(':checked')){
			$('#dibayar-nominal').val(parseFloat(0));
		}else{
			$('#dibayar').val(parseFloat(0));
		}
    	var a = parseInt($('#jumlah'+rowCount).val()),
        	b = parseFloat($('#harga'+rowCount).val().replace(/,/g,"")).toFixed(2),
        	c = parseFloat($('#disc'+rowCount).val()),
        	p = parseFloat($('#pajak'+rowCount).val()).toFixed(2),
        	diBayar = parseFloat($('#dibayar').val().replace(/,/g,"")),
        	diBayarNominal = parseFloat($('#dibayar-nominal').val().replace(/,/g,"")),
        	biayaPengiriman = parseFloat($('#biaya_pengiriman').val().replace(/,/g,"")),
        	d = (a*b)*(c/100),//jumlah diskon
       		val = (a*b)-d,
       		disc = (a*b)*(c/100),
        	subPajak = val*(p/100),//jumlah pajak
        	jmlPajak = 0,
        	jmlDisc = 0,
        	total = 0;

        $('#subtotal'+rowCount).val(addCommas(parseFloat(val).toFixed(2)));
        $("#subdisc"+rowCount).val(addCommas(parseFloat(disc).toFixed(2)));
        $('.subtotal').each(function (index, element) {
            total = total + parseInt($(element).val().replace(/,/g,""));
        });
        $('.subdisc').each(function (index, element) {
            jmlDisc = jmlDisc + parseFloat($(element).val().replace(/,/g,""));
        });

        if($('#kpajak1').is(':checked')){
			parseFloat($('#totalPajak').val(total*(10/100)));
		}else{
			$('#totalPajak').val(parseFloat(0));
		}
		if($('#kpajak2').is(':checked')){
			$('#totalp2').val(parseFloat(total*(2/100)));
		}else{
			$('#totalp2').val(parseFloat(0));
		}
		if($('#kpajak3').is(':checked')){
			$('#totalp3').val(parseFloat(total*(2/100)));
		}else{
			$('#totalp3').val(parseFloat(0));
		}

		p1 = parseFloat($("#totalPajak").val()),
		p2 = parseFloat($("#totalp2").val()),
        p3 = parseFloat($("#totalp3").val()),

        total = total+biayaPengiriman;
        ttotalpluspajak = total+p1+p2+p3;
        diBayar = totalpluspajak * (diBayar/100);

        $('#total-diskon').val(addCommas(parseFloat(jmlDisc).toFixed(2)));
        $('#total').val(addCommas(parseFloat(total).toFixed(2)));
        
        $('#totalpluspajak').val(addCommas(parseFloat(total+p1+p2+p3).toFixed(2)));
        var saldo = totalpluspajak-diBayar-diBayarNominal;
        $('#saldo').val(addCommas(parseFloat(saldo).toFixed(2)));	
    }
}

function deleteRow(tableID){try{var table=document.getElementById(tableID);var rowCount=table.rows.length;for(var i=0;i<rowCount;i++){var row=table.rows[i];var chkbox=row.cells[0].childNodes[0];if(null!=chkbox&&true==chkbox.checked){table.deleteRow(i);rowCount--;i--;}}}catch(e){alert(e);}}

$("input:checkbox:not(:checked)").each(function() {
	    var total = "#total"+$(this).attr("class");
	    $(total).hide();
	});

	$("input:checkbox").click(function(){
	    var total = "#total"+$(this).attr("class");
	    $(total).toggle();
	    hitungTotal();
	});


$("#dp-persen-cek:not(:checked)").each(function() {
	     $("#dp-persen").hide("slow");
	     $("#dp-nominal").show("slow");
	});

	$("#dp-persen-cek").click(function(){
	     $("#dp-persen").toggle("slow");
	     $("#dp-nominal").toggle("slow");
	     hitungTotal();
	});

function hitungTotal()
{


	if($('#dp-persen-cek').is(':checked')){
		$('#dibayar-nominal').val(parseFloat(0));
	}else{
		$('#dibayar').val(parseFloat(0));
	}

    	diBayar = parseFloat($('#dibayar').val().replace(/,/g,"")),
    	diBayarNominal = parseFloat($('#dibayar-nominal').val().replace(/,/g,"")),
    	biayaPengiriman = parseFloat($('#biaya_pengiriman').val().replace(/,/g,"")),
    	jmlDisc = 0,
    	total = 0;
    $('.subdisc').each(function (index, element) {
        jmlDisc = jmlDisc + parseFloat($(element).val().replace(/,/g,""));
    });

    $('.subtotal').each(function (index, element) {
        total = total + parseFloat($(element).val().replace(/,/g,""));
    });

    
    if($('#kpajak1').is(':checked')){
		parseFloat($('#totalPajak').val(total*(10/100)));
	}else{
		$('#totalPajak').val(parseFloat(0));
	}
	if($('#kpajak2').is(':checked')){
		$('#totalp2').val(parseFloat(total*(2/100)));
	}else{
		$('#totalp2').val(parseFloat(0));
	}
	if($('#kpajak3').is(':checked')){
		$('#totalp3').val(parseFloat(total*(2/100)));
	}else{
		$('#totalp3').val(parseFloat(0));
	}

	p1 = parseFloat($("#totalPajak").val()),
	p2 = parseFloat($("#totalp2").val()),
    p3 = parseFloat($("#totalp3").val()),

    total = total+biayaPengiriman;
    totalpluspajak = total+p1+p2+p3;
    diBayar = totalpluspajak * (diBayar/100);
    
    var saldo = totalpluspajak-diBayar-diBayarNominal;
    $('#total-diskon').val(addCommas(parseFloat(jmlDisc).toFixed(2)));
    $('#total').val(addCommas(parseFloat(total).toFixed(2)));
    
    //$('#totalPajak').val(addCommas(parseFloat(jmlPajak).toFixed(2)));
    $('#total-diskon').val(addCommas(parseFloat(jmlDisc).toFixed(2)));
    $('#total').val(addCommas(parseFloat(total).toFixed(2)));
    
    $('#totalpluspajak').val(addCommas(parseFloat(total+p1+p2+p3).toFixed(2)));
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
</script>