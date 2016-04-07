<?php 
	$totalpajak = $total = $saldo = $totaldiskon = 0;
	$i=$row_count;foreach($order_list->result() as $ol): 
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