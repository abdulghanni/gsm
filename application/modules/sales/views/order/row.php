<tr>
	<td>
		<div class="checkbox clip-check check-primary checkbox-inline">
			<input type="checkbox" id="row<?=$id?>" value="" class="cek" name="row">
			<label for="row<?=$id?>">
			</label>
		</div>
	</td>
	<td><?= $id ?></td>
	<?php $src = (!empty($ol->photo))?assets_url("gsm/uploads/barang/$ol->barang_id/$ol->photo") : assets_url('assets/images/no-image-mid.png') ?>
	<td><select name='kode_barang[]' class='select2' id="barang_id<?=$id?>" style='width:100%'>		<option value="0">-- Pilih Barang --</option>
		<?php foreach($barang as $value=>$b):?>
		<option value='<?php echo $b['id']?>'><?php echo $b['kode'].' - '.$b['title']?></option><?php endforeach;?></select>
	</td>
	<td><div id="ss"><img width="75px" width="75px" id="photo<?=$id?>" src="<?=assets_url('assets/images/no-image-mid.png')?>" /></div></td>
	<td><textarea name="deskripsi[]" value="0" type="text" class="form-control" required="required" id="deskripsi<?=$id?>"></textarea></td>
	<td><input name="jumlah[]" value="0" type="text" class="form-control jumlah text-right" required="required" id="jumlah<?=$id?>"></td>
	<td><select id="satuanlist<?=$id?>" name='satuan[]' class='select2' style='width:100%'><?php foreach($satuan as $s):?><option value='<?php echo $s['id']?>'><?php echo $s['title']?></option><?php endforeach;?></select><input type='hidden' value='0' id="satuanlist_num<?=$id?>"></td>
	<td><input name="harga[]" value="0" type="text" class="form-control harga text-right" required="required" id="harga<?=$id?>"></td>
	<td class="text-right">
		<input type="text" name="disc[]" class="form-control text-right disc" value="0" id="disc<?=$id?>">
		<input type="hidden" name="subdisc[]" class="form-control text-right subdisc" value="0" id="subdisc<?=$id?>">
	</td>
	<td><input name="sub_total[]" type="text" class="form-control subtotal text-right" required="required" id="subtotal<?=$id?>" value="0" readonly></td>
	<input name="pajak[]" value="0" type="hiddent" class="form-control text-right" required="required" id="pajak<?=$id?>">
	<input name="subpajak[]" value="0" type="hidden" class="subpajak" id="subpajak<?=$id?>">
</tr>
<script type="text/javascript"> $(document).find("select.select2").select2();</script>
<script type="text/javascript">
	var a = parseFloat($("#jumlah<?=$id?>").val()),
		b = parseFloat($("#harga<?=$id?>").val().replace(/,/g,"")).toFixed(2),
		c = parseFloat($("#disc<?=$id?>").val()),
		p = parseFloat($("#pajak<?=$id?>").val()).toFixed(2),
		d = (a*b)*(c/100),//jumlah diskon
		val = (a*b)-d;

	$("#barang_id<?=$id?>").change(function(){
	        var id = $(this).val();
	         $.ajax({
	            type: "GET",
	            dataType: "JSON",
	            url: '/gsm/purchase/order/get_nama_barang/'+id,
	            success: function(data) {
	            	if(id != '0'){
	            		$('#deskripsi<?=$id?>').val(data.nama_barang);
	            		if(data.photo != ''){
				            $("#photo<?=$id?>").attr("src", "http://"+window.location.host+"/gsm/uploads/barang/"+id+"/"+data.photo);
				        }else{
				            $("#photo<?=$id?>").attr("src", "http://"+window.location.host+"/gsm/assets/assets/images/no-image-mid.png");    
				        }
	            	}
	            }
	        });
	    })

	$("#jumlah<?=$id?>").on('click', function () {
	    if($('input[name="fraksi"]').is(":checked")){
	    	$.ajax({
	            url: '/gsm/purchase/request/show_modal/'+<?=$id?>,
	            success: function(response){
		         	$("#modal").append(response);
		         	$("#modal_fraksi<?=$id?>").modal('show');
		         },
		         dataType:"html"
	        });
	    }
	});

	$("#harga<?=$id?>").add("#jumlah<?=$id?>").add("#disc<?=$id?>").keyup(function() {
			hitung<?=$id?>();
	    });

function hitung<?=$id?>()
   	{
   		if($('#dp-persen-cek').is(':checked')){
			$('#dibayar-nominal').val(parseFloat(0));
		}else{
			$('#dibayar').val(parseFloat(0));
		}
    	var a = parseFloat($('#jumlah'+<?=$id?>).val()),
        	b = parseFloat($('#harga'+<?=$id?>).val().replace(/,/g,"")).toFixed(2),
        	c = parseFloat($('#disc'+<?=$id?>).val()),
        	p = parseFloat($('#pajak'+<?=$id?>).val()).toFixed(2),
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

        $('#subtotal'+<?=$id?>).val(addCommas(parseFloat(val).toFixed(2)));
        $("#subdisc"+<?=$id?>).val(addCommas(parseFloat(disc).toFixed(2)));
        $('.subtotal').each(function (index, element) {
            total = total + parseFloat($(element).val().replace(/,/g,""));
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

   	
$(document).ready(function() {
	$(".cek:not(:checked)").each(function() {
	    $("#remove").hide();
	});

	$(".cek:checkbox").click(function(){
	     $("#remove").show();
	});

	 $("#remove").on("click", function () {
        $('table tr').has('input[name="row"]:checked').remove();
        hitung<?=$id?>();
    })
});
</script>

