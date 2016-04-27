
<div class="row">
	<div class="col-sm-12">
			<div class="table-responsive">
				<table id="table" class="table table-striped">
					<thead>
						<tr>
							<th width="1%">#</th>
						<!--<th width="1%"> No. </th>-->
						<th width="5%"> Kode Barang </th>
						<th width="8%"> SS Barang </th>
						<th width="20%"> Deskripsi </th>
						<th width="20%"> Catatan </th>
						<th width="5%">Qty</th>
						<th width="5%"> Satuan </th>
						<th width="10%"> Harga </th>
						<th width="5%">Disc(%)</th>
						<th width="10%"> Sub Total </th>
						<th width="10%"> Inc PPN </th>
						<th width="10%">Attachment</th>
							</tr><?php $i=1;
							$totalpluspajak = $totalpajak = $total = $saldo = $totaldiskon = 0;
							$i=1;foreach($list->result() as $ol){
							$subtotal = $ol->jumlah*$ol->harga;
							$totaldiskon = $totaldiskon + ($subtotal * ($ol->disc/100));
							$total = $total + $subtotal;
							?>
							<tr>
								<th width="5%"><?php echo $i ?> </th>
								<td><?=$ol->kode_barang?></td>
								<?php $src = (!empty($ol->photo))?base_url("uploads/barang/$ol->barang_id/$ol->photo") : assets_url('assets/images/no-image-mid.png') ?>
								<td><img height="75px" width="75px" src="<?=$src?>"></td>
								<input type="hidden" name="kode_barang[]" class=" text-right" value="<?=$ol->barang_id?>">
								</td>
								<td>
									<textarea name="deskripsi[]" class="" placeholder="Isi deskripsi dan catatan kaki perbarang disini"><?=$ol->deskripsi?></textarea>
								</td>
								<td>
									<textarea name="catatan_barang[]" class="" placeholder="Isi catatan kaki perbarang disini"><?=$ol->catatan?></textarea>
								</td>

								<td class="text-right"><input type="text" name="jumlah[]" class=" text-right" value="<?=$ol->jumlah?>" id="jumlah<?=$i?>"></td>
								<td><?=$ol->satuan?></td>
								<input type="hidden" name="satuan[]" class=" text-right" value="<?=$ol->satuan_id?>">
								<td class="text-right"><input type="text" name="harga[]" class=" text-right harga" value="<?=number_format($ol->harga, 2)?>" id="harga<?=$i?>"></td>
								<td class="text-right">
								<input type="text" name="disc[]" class=" text-right disc" value="<?=$ol->disc?>" id="disc<?=$i?>">
								<input type="hidden" name="subdisc[]" class=" text-right subdisc" value="0" id="subdisc<?=$i?>">
								</td>
								<td class="text-right"><input type="text" name="subtotal" class=" text-right subtotal" value="<?=number_format($subtotal, 2)?>" id="subtotal<?=$i?>" readonly>
								</td>
								<td>
									<?php $checked = ($ol->inc_ppn != 0)?'checked="checked"' : '';?>
									<input name= "pajak_checkbox1_checkbox[]" type="checkbox" id="pajak<?=$i?>" value="1">
									<input type="hidden" name="pajak_checkbox1[]" value="0" />
									<input type="hidden" name="pajak[]" value="<?= $ol->pajak ?>" id="subpajak<?=$i?>" class="subpajak">
								</td>
								<td>
								<?php if(!empty($ol->attachment)){?>
								<a target="_blank" href="<?= base_url("uploads/sale/".$ol->attachment)?>"><?=$ol->attachment?></a></td>
								<input type="hidden" name="attachment[]" value="<?=$ol->attachment?>">
								<?php }else{?>
								<input type="file" name="attachment[]">
								<?php } ?>
							</tr>
								<script>
										$("#pajak<?=$i?>").click(function(){
										    hitung<?=$i?>();
										});
											$("#harga<?=$i?>").maskMoney({allowZero:true});
											$("#disc<?=$i?>").add("#harga<?=$i?>").add("#jumlah<?=$i?>").add("#dibayar").add("#dibayar-nominal").add("#biaya_pengiriman").keyup(function() {
												hitung<?=$i?>();
										    });

										    function hitung<?=$i?>(){
										    	var a = parseFloat($("#jumlah<?=$i?>").val()),
										        	b = parseFloat($("#harga<?=$i?>").val().replace(/,/g,"")).toFixed(2),
										        	c = parseFloat($("#disc<?=$i?>").val()),
										        	p = parseFloat($("#subpajak<?=$i?>").val()).toFixed(2),
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
													pph23 = $("#pp23_val").val(),
													ppnx =  val*(ppn/100);
										        $("#subtotal<?=$i?>").val(addCommas(parseFloat(val).toFixed(2)));
										        $("#subdisc<?=$i?>").val(addCommas(parseFloat(disc).toFixed(2)));
										        $('.subdisc').each(function (index, element) {
										            jmlDisc = jmlDisc + parseFloat($(element).val().replace(/,/g,""));
										        });

												if($("#pajak<?=$i?>").is(':checked')){
													ppnx =  val - (val/1.1);
													$("#subpajak<?=$i?>").val(parseFloat(ppnx));
												}else{
													ppnx =  val * (10/100);
													$("#subpajak<?=$i?>").val(parseFloat(ppnx));
												}
												$('.subpajak').each(function (index, element) {
										            totalPajak = totalPajak + parseFloat($(element).val().replace(/,/g,""));
										        });

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

												p1 = parseFloat($("#totalPajak").val().replace(/,/g,"")),
												p2 = parseFloat($("#totalp2").val().replace(/,/g,"")),
										        p3 = parseFloat($("#totalp3").val().replace(/,/g,"")),
										        $("#pajak<?=$i?>").val(subPajak);
										        $('#totalPajak').val(addCommas(parseFloat(totalPajak).toFixed(2)));

										        $('.subtotal').each(function (index, element) {
										            total = total + parseFloat($(element).val().replace(/,/g,""));
										        });

										        total = total+biayaPengiriman;
										        totalpluspajak = total+p1+p2+p3;
										        totalminuspajak = total-p1-p2-p3;
										        diBayar = totalpluspajak * (diBayar/100);

										         $('#totalPajak').val(addCommas(parseFloat(totalPajak).toFixed(2)));
										        $('#total-diskon').val(addCommas(parseFloat(jmlDisc).toFixed(2)));
										        $('#total').val(addCommas(parseFloat(totalminuspajak).toFixed(2)));
										        
										        $('#totalpluspajak').val(addCommas(parseFloat(total).toFixed(2)));
										        var saldo = total-diBayar-diBayarNominal;
										        $('#saldo').val(addCommas(parseFloat(saldo).toFixed(2)));	
										    }
							</script>
							<?php $i++;} 
							
							 ?>
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
							<input type="text" name="saldo" id="saldo" class="form-control text-right" value="0" readonly="readonly">
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
$('input[type="checkbox"]').on('change', function(e){
        if($(this).prop('checked'))
        {
            $(this).next().val(1);
            //$(this).next().disabled = true;
        } else {
            $(this).next().val(0);
            //$(this).next().disabled = true;
        }
    });


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

	p1 = parseFloat($("#totalPajak").val().replace(/,/g,"")),
	p2 = parseFloat($("#totalp2").val().replace(/,/g,"")),
    p3 = parseFloat($("#totalp3").val().replace(/,/g,"")),

    total = total+biayaPengiriman;
    totalpluspajak = total+p1+p2+p3;
    totalminuspajak = total-p1-p2-p3;
    diBayar = total * (diBayar/100);
    $('#totalPajak').val(addCommas(parseFloat(totalPajak).toFixed(2)));
    $('#total-diskon').val(addCommas(parseFloat(jmlDisc).toFixed(2)));
    $('#total').val(addCommas(parseFloat(totalminuspajak).toFixed(2)));
    
    $('#totalpluspajak').val(addCommas(parseFloat(total).toFixed(2)));
    var saldo = total-diBayar-diBayarNominal;
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