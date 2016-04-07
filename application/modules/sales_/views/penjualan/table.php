<button id="remove" class="btn btn-danger" type="button" style="display:none">Hapus <i class="fa fa-remove"></i></button>
				<div class="row">
		<div class="col-sm-12">
		<div class="table-responsive">
			<table id="table" class="table table-striped">
				<thead>
					<tr>
						<th width="1%">#</th>
						<!--<th width="1%"> No </th>-->
						<th width="10%"> Kode Barang </th>
						<th width="9%"> SS Barang </th>
						<th width="10%"> Nama Barang </th>
						<th width="20%"> Deskripsi </th>
						<th width="5%">Diorder</th>
						<th width="5%">Dikirim</th>
						<th width="10%"> Satuan </th>
						<th width="15%"> Harga </th>
						<th width="5%">Disc(%)</th>
						<th width="15%"> Sub Total </th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$totalpajak = $total = $saldo = $totaldiskon = 0;
						$i=1;foreach($order_list->result() as $ol): 
						$subtotal = $ol->jumlah*$ol->harga-($ol->jumlah*$ol->harga*($ol->disc/100));
						$totalpajak = $totalpajak + ($subtotal * ($ol->pajak/100));
						$totaldiskon = $totaldiskon + ($subtotal * ($ol->disc/100));
						$total = $total + $subtotal;
						$src = (!empty($ol->photo))?base_url("uploads/barang/$ol->barang_id/$ol->photo") : assets_url('assets/images/no-image-mid.png');
					?>
					<tr>
						<td>
						<div class="checkbox clip-check check-primary checkbox-inline">
							<input type="checkbox" id="row<?=$ol->barang_id?>" value="" class="cek" name="row">
							<label for="row<?=$ol->barang_id?>">
							</label>
						</div>
						</td>
						<!--<td><?=$i++?></td>-->
						<td><?=$ol->kode_barang?></td>
						<input type="hidden" name="kode_barang[]" class="form-control text-right" value="<?=$ol->barang_id?>">
						<td><img height="75px" width="75px" src="<?=$src?>"></td>
						<td><input type="text" name="nama_barang[]" class="form-control" value="<?=$ol->nama_barang?>" readonly>
						</td>
						<td>
							<textarea name="deskripsi[]" class="form-control" placeholder="Isi deskripsi dan catatan kaki perbarang disini"><?=$ol->deskripsi?></textarea>
						</td>
						<td class="text-right"><?=$ol->jumlah?></td>
						<input type="hidden" name="diorder[]" class="form-control text-right" value="<?=$ol->jumlah?>" id="">
						<td class="text-right"><input type="text" name="diterima[]" class="form-control text-right" value="<?=$ol->jumlah?>" id="jumlah<?=$i?>"></td>
						
						<td><?=$ol->satuan?></td>
						<input type="hidden" name="satuan[]" class="form-control text-right" value="<?=$ol->satuan_id?>">
						<td class="text-right"><input type="text" name="harga[]" class="form-control text-right harga" value="<?=number_format($ol->harga, 2)?>" id="harga<?=$i?>"></td>
						<input type="hidden" name="harga[]" class="form-control text-right harga" value="<?=$ol->harga?>" id="harga<?=$i?>">
						<td class="text-right">
						<input type="text" name="disc[]" class="form-control text-right disc" value="<?=$ol->disc?>" id="disc<?=$i?>">
						<input type="hidden" name="subdisc[]" class="form-control text-right subdisc" value="0" id="subdisc<?=$i?>">
						</td>
						<td class="text-right"><input type="text" name="subtotal" class="form-control text-right subtotal" value="<?=number_format($subtotal, 2)?>" id="subtotal<?=$i?>" readonly></td>
						</tr>
					<script>
					$("#harga<?=$i?>").maskMoney({allowZero:true});
					$("#biaya_pengiriman").maskMoney({allowZero:true});
					$("#dibayar").maskMoney({allowZero:true}).attr('maxlength', 6);
					$("#dibayar-nominal").maskMoney({allowZero:true});
						$("#disc<?=$i?>").add("#jumlah<?=$i?>").add("#harga<?=$i?>").add("#dibayar").add("#dibayar-nominal").add("#biaya_pengiriman").keyup(function() {
						var a = parseFloat($("#jumlah<?=$i?>").val()),
				        	b = parseFloat($("#harga<?=$i?>").val().replace(/,/g,"")).toFixed(2),
				        	c = parseFloat($("#disc<?=$i?>").val()),
				        	diBayar = parseFloat($('#dibayar').val().replace(/,/g,"")),
				        	diBayarNominal = parseFloat($('#dibayar-nominal').val().replace(/,/g,"")),
				        	biayaPengiriman = parseFloat($('#biaya_pengiriman').val().replace(/,/g,"")),
				        	d = (a*b)*(c/100),//jumlah diskon
				       		val = (a*b)-d,
				       		disc = (a*b)*(c/100),
				        	jmlDisc = 0,
				        	total = 0;
				        $("#subtotal<?=$i?>").val(addCommas(parseFloat(val).toFixed(2)));
				        $("#subdisc<?=$i?>").val(addCommas(parseFloat(disc).toFixed(2)));
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
				        totalpluspajak = total+p1;
				        diBayar = totalpluspajak * (diBayar/100);
				        
				        $('#total-diskon').val(addCommas(parseFloat(jmlDisc).toFixed(2)));
				        $('#total').val(addCommas(parseFloat(total).toFixed(2)));
				        
				        //$('#totalPajak').val(addCommas(parseFloat(jmlPajak).toFixed(2)));
				        $('#total-diskon').val(addCommas(parseFloat(jmlDisc).toFixed(2)));
				        $('#total').val(addCommas(parseFloat(total).toFixed(2)));
				        
				        $('#totalpluspajak').val(addCommas(parseFloat(total+p1+p2+p3).toFixed(2)));
				        var saldo = totalpluspajak-diBayar-diBayarNominal;
				        $('#saldo').val(addCommas(parseFloat(saldo).toFixed(2)));	
				    });
					</script>
					<?php 
					endforeach;
						$totalpluspajak = $total+$totalpajak;
					?>
				</tbody>
			</table>
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
    
    $('#total-diskon').val(addCommas(parseFloat(jmlDisc).toFixed(2)));
    $('#total').val(addCommas(parseFloat(total).toFixed(2)));
    
    //$('#totalPajak').val(addCommas(parseFloat(jmlPajak).toFixed(2)));
    $('#total-diskon').val(addCommas(parseFloat(jmlDisc).toFixed(2)));
    $('#total').val(addCommas(parseFloat(total).toFixed(2)));
    
    $('#totalpluspajak').val(addCommas(parseFloat(total+p1+p2+p3).toFixed(2)));
    var saldo = totalpluspajak-diBayar-diBayarNominal;
    $('#saldo').val(addCommas(parseFloat(saldo).toFixed(2)));	
}
$(document).ready(function() {
	$("input:checkbox:not(:checked)").each(function() {
	    var total = "#total"+$(this).attr("class");
	    $(total).hide();
	});

	$(".cek:not(:checked)").each(function() {
	    $("#remove").hide();
	});

	$(".cek:checkbox").click(function(){
	     $("#remove").show();
	});

	 $("#remove").on("click", function () {
        $('table tr').has('input[name="row"]:checked').remove();
        hitung();
    })

	 $("#dp-persen-cek:not(:checked)").each(function() {
	     $("#dp-persen").hide("slow");
	     $("#dp-nominal").show("slow");
	});

	$("#dp-persen-cek").click(function(){
	     $("#dp-persen").toggle("slow");
	     $("#dp-nominal").toggle("slow");
	});
});
	$('.input-append.date')
        .datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd-mm-yyyy"
        });
    $("#tanggal_faktur").datepicker("setDate", new Date());
    $("#tanggal_pengiriman").datepicker("setDate", new Date());
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