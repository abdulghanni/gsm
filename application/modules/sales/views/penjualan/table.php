
<div class="row">
	<div class="col-sm-12">
			<div class="table-responsive">
				<table id="table" class="table table-striped">
					<thead>
						<tr>
							<th width="5%"> No. </th>
							<th width="10%"> Kode Barang </th>
							<th width="10%"> Nama Barang </th>
							<th width="10%"> Deskripsi & Catatan </th>
							<th width="5%">Qty</th>
							<th width="10%"> Satuan </th>
							<th width="20%"> Harga </th>
							<th width="5%">Disc(%)</th>
							<th width="15%"> Sub Total </th>
							<th width="5%" align="center">Exclude PPN</th>
							</tr><?php $c=1;$total=$totaldiskon=0; 
							foreach($list->result_array() as $daftar){

							$so = $this->db->where('so', $daftar['ref'])->get('sales_order')->row_array();
							$det_list = GetAll('sales_order_list',array('order_id'=>'where/'.$so['id'], 'kode_barang'=>'where/'.$daftar['barang_id']))->row_array();
								$subtotal = $det_list['harga']*$det_list['jumlah'];

								$totaldiskon = $totaldiskon + ($subtotal * ($det_list['disc']/100));
								$total = $total + $subtotal;
								$totalpluspajak = $total+$so['total_ppn']+$so['total_pph22']+$so['total_pph23'];
							?>
							<tr>
								<th width="5%"><?php echo $c ?> </th>
								<th width="10%"> <?php echo GetValue('kode','barang',array('id'=>'where/'.$daftar['barang_id'])) ?> </th>
								<input type="hidden" name="kode_barang[]" class="form-control text-right" value="<?=$daftar['barang_id']?>">
								<th width="10%"> <?php echo GetValue('title','barang',array('id'=>'where/'.$daftar['barang_id'])) ?> </th>
								<th width="10%"> <textarea name="deskripsi[]" class=""><?php echo GetValue('title','barang',array('id'=>'where/'.$daftar['barang_id'])) ?></textarea> </th>
								<th width="5%" class="text-right">
									<?=$det_list['jumlah']?>
									<input type="hidden" name="diterima[]" id="jumlah<?=$daftar['id']?>" value="<?=$daftar['jumlah']?>">
									<input type="hidden" name="diorder[]" class="form-control text-right" value="<?=$det_list['jumlah']?>" id="">
								</th>
								<th width="10%"><?php echo GetValue('title','satuan',array('id'=>'where/'. $daftar['satuan_id']))?> </th>
								<input type="hidden" name="satuan[]" class="form-control text-right" value="<?=$daftar['satuan_id']?>">
								<th width="20%"><input name="harga[]" type="text" id="harga<?=$daftar['id']?>" class="harga text-right" value="<?= number_format($det_list['harga'], 2)?>"></th>
									<th width="5%"><input name="disc[]" type="text" id="disc<?=$daftar['id']?>" class="disc form-control text-right" value="<?=$det_list['disc']?>"></th>
									<input type="hidden" name="subdisc[]" class="form-control text-right subdisc" value="0" id="subdisc<?=$daftar['id']?>">
									<th width="15%"><input type="text" id="subtotal<?=$daftar['id']?>" class="subtotal text-right" value="<?= number_format($det_list['harga']*$det_list['jumlah'], 2)?>" readonly="readonly"></th>
								<th width="5%" class="text-center">
									<input id="pajak<?=$daftar['id']?>" class="checkbox_pajak text-center" type="checkbox">
									<input name="pajak[]" value="0" type="hidden" class="subpajak" id="subpajak<?=$daftar['id']?>">
								</th>
							</tr>
								<script type="text/javascript">
								//$("#subTotalPajak").append('<input name="subpajak[]" value="0" type="hidden" class="subpajak" id="subpajak<?=$daftar['id']?>"+'">')
								$("#harga<?=$daftar['id']?>").add("#jumlah<?=$daftar['id']?>").add("#disc<?=$daftar['id']?>").keyup(function() {
									hitung<?=$daftar['id']?>();
							    });

							    $('.harga').maskMoney({allowZero:true});
							    $('.biaya_pengiriman').maskMoney({allowZero:true});
							    $("#dibayar").maskMoney({allowZero:true}).attr('maxlength', 6);
							    $("#dibayar-nominal").maskMoney({allowZero:true});
							    $('.harga').maskMoney({allowZero:true});

								$("#pajak<?=$daftar['id']?>").click(function(){
								    hitung<?=$daftar['id']?>();
								});

							    function hitung<?=$daftar['id']?>()
							    {
							    		var a = parseFloat($("#jumlah<?=$daftar['id']?>").val()),
							        	b = parseFloat($("#harga<?=$daftar['id']?>").val().replace(/,/g,"")).toFixed(2),
							        	c = parseFloat($("#disc<?=$daftar['id']?>").val()),
							        	p = parseFloat($("#subpajak<?=$daftar['id']?>").val()).toFixed(2),
							        	diBayar = parseFloat($('#dibayar').val().replace(/,/g,"")),
							        	diBayarNominal = parseFloat($('#dibayar-nominal').val().replace(/,/g,"")),
							        	biayaPengiriman = parseFloat($('#biaya_pengiriman').val().replace(/,/g,"")),
							        	d = (a*b)*(c/100),//jumlah diskon
							       		val = (a*b)-d,
							       		disc = (a*b)*(c/100),
							        	subPajak = val*(p/100),//jumlah pajak
							        	totalPajak = 0,
							        	jmlDisc = 0,
							        	total = 0;
										ppn = $("#ppn_val").val(),
										pph22 = $("#pp22_val").val(),
										pph23 = $("#pp23_val").val();
										ppnx =  val*(ppn/100)

									if($("#pajak<?=$daftar['id']?>").is(':checked')){
										$("#subpajak<?=$daftar['id']?>").val(parseFloat(ppnx));
									}else{
										$("#subpajak<?=$daftar['id']?>").val(parseFloat(0));
									}


							    	if($('#dp-persen-cek').is(':checked')){
										$('#dibayar-nominal').val(parseFloat(0));
									}else{
										$('#dibayar').val(parseFloat(0));
									}
							    	
							        $("#subtotal<?=$daftar['id']?>").val(addCommas(parseFloat(val).toFixed(2)));
							        $("#subdisc<?=$daftar['id']?>").val(addCommas(parseFloat(disc).toFixed(2)));
							        $("#pajak<?=$daftar['id']?>").val(subPajak);
							        $('.subpajak').each(function (index, element) {
							            totalPajak = totalPajak + parseFloat($(element).val().replace(/,/g,""));
							        });
							        $('.subtotal').each(function (index, element) {
							            total = total + parseFloat($(element).val().replace(/,/g,""));
							        });
							        $('.subdisc').each(function (index, element) {
							            jmlDisc = jmlDisc + parseFloat($(element).val().replace(/,/g,""));
							        });
							        /*
							        if($('#kpajak1').is(':checked')){
										parseFloat($('#totalPajak').val(total*(10/100)));
									}else{
										$('#totalPajak').val(parseFloat(0));
									}
									*/
									parseFloat($('#totalPajak').val(totalPajak));

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

							        $('#total-diskon').val(addCommas(parseFloat(jmlDisc).toFixed(2)));
							        $('#total').val(addCommas(parseFloat(total).toFixed(2)));
							        
							        $('#totalpluspajak').val(addCommas(parseFloat(total+p1+p2+p3).toFixed(2)));
							        var saldo = totalpluspajak-diBayar-diBayarNominal;
							        $('#saldo').val(addCommas(parseFloat(saldo).toFixed(2)));	
							    }
							</script>
							<?php $c++;}  ?>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<input type="hidden" name="dp" value="0">
	<div id="subTotalPajak"></div>
	<div class="row">
		<div id="panel-total" class="panel-body col-md-5 pull-right">
			<ul class="list-group">
				<li class="list-group-item" id="totalPPN">
					<div class="row">
						<div class="col-md-4">
						PPN 10%
						</div>
						<div class="col-md-6 pull-right">
						<input type="text" id="totalPajak" name="total-ppn" value="0" class="form-control text-right" readonly="readonly">
						</div>
					</div>
				</li>
				<li class="list-group-item" id="totalPPH22">
					<div class="row">
						<div class="col-md-4">
						PPH 22%
						</div>
						<div class="col-md-6 pull-right">
						<input type="text" id="totalp2" name="total-pph22" value="0" class="form-control text-right" readonly="readonly">
						</div>
					</div>
				</li>
				<li class="list-group-item" id="totalPPH23">
					<div class="row">
						<div class="col-md-4">
						PPH 23%
						</div>
						<div class="col-md-6 pull-right">
						<input type="text" id="totalp3" name="total-pph23" value="0" class="form-control text-right" readonly="readonly">
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-4">
						Biaya Pengiriman
						</div>
						<div class="col-md-6 pull-right">
						<input type="text" name="biaya_pengiriman" id="biaya_pengiriman" class="biaya_pengiriman form-control text-right" value="0">
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-4">
						Diskon
						</div>
						<div class="col-md-6 pull-right">
						<input type="text" name="total-diskon" id="total-diskon" class="form-control text-right" value="<?=$totaldiskon?>" readonly>
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-4">
						Total
						</div>
						<div class="col-md-6 pull-right">
						<input type="text" class="form-control text-right" id="total" value="<?=$total?>" readonly="readonly">
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-4">
						Total+Pajak
						</div>
						<div class="col-md-6 pull-right">
						<input type="text" class="form-control text-right" name="gtotal" id="totalpluspajak" value="<?=$totalpluspajak?>" readonly="readonly">
						</div>
					</div>
				</li>
				<div id="total_angsuran" style="display:none">
					<li class="list-group-item">
						<div class="row">
							<div class="col-md-6">
							Uang Muka
								<div class="checkbox clip-check check-primary checkbox-inline">
									<input type="checkbox" onchange="hitung()" id="dp-persen-cek" value="" name="row">
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
	<div class="row">
		<button type="submit" id="btnSubmit" class="btn btn-lg btn-primary hidden-print pull-right" style="margin-right:15px;">
			Submit Order <i class="fa fa-check"></i>
		</button>
	</div>
</div>

<script type="text/javascript">
	$("#dp-persen-cek:not(:checked)").each(function() {
	     $("#dp-persen").hide("slow");
	     $("#dp-nominal").show("slow");
	});

	$("#dp-persen-cek").click(function(){
	     $("#dp-persen").toggle("slow");
	     $("#dp-nominal").toggle("slow");
	     hitung();
	});

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

    	diBayar = parseFloat($('#dibayar').val().replace(/,/g,"")),
    	diBayarNominal = parseFloat($('#dibayar-nominal').val().replace(/,/g,"")),
    	biayaPengiriman = parseFloat($('#biaya_pengiriman').val().replace(/,/g,"")),
    	totalPajak = 0,
    	jmlDisc = 0,
    	total = 0;
		ppn = $("#ppn_val").val(),
		pph22 = $("#pp22_val").val(),
		pph23 = $("#pp23_val").val();

	if($('#dp-persen-cek').is(':checked')){
		$('#dibayar-nominal').val(parseFloat(0));
	}else{
		$('#dibayar').val(parseFloat(0));
	}

    $('.subpajak').each(function (index, element) {
        totalPajak = totalPajak + parseFloat($(element).val().replace(/,/g,""));
    });
    $('.subtotal').each(function (index, element) {
        total = total + parseFloat($(element).val().replace(/,/g,""));
    });
    $('.subdisc').each(function (index, element) {
        jmlDisc = jmlDisc + parseFloat($(element).val().replace(/,/g,""));
    });
    /*
    if($('#kpajak1').is(':checked')){
		parseFloat($('#totalPajak').val(total*(10/100)));
	}else{
		$('#totalPajak').val(parseFloat(0));
	}
	*/
	parseFloat($('#totalPajak').val(totalPajak));

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

    $('#total-diskon').val(addCommas(parseFloat(jmlDisc).toFixed(2)));
    $('#total').val(addCommas(parseFloat(total).toFixed(2)));
    
    $('#totalpluspajak').val(addCommas(parseFloat(total+p1+p2+p3).toFixed(2)));
    var saldo = totalpluspajak-diBayar-diBayarNominal;
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