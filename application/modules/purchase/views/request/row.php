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
	<td><div id="ss"><img width="100px" width="100px" id="photo<?=$id?>" src="<?=assets_url('assets/images/no-image-mid.png')?>" /></div></td>
	<td>
		<select name='kode_barang[]' class='select2' id="barang_id<?=$id?>" style='width:100%'>
			<option value="0">-- Pilih Barang --</option>
			<?php foreach($barang as $value=>$b):?>
			<option value='<?php echo $b['id']?>'><?php echo $b['kode'].' - '.$b['title']?></option><?php endforeach;?>
		</select>
	</td>
	<td><textarea name="deskripsi[]" value="0" type="text" class="" id="deskripsi<?=$id?>"></textarea></td>
	<td><textarea name="catatan_barang[]" value=" " class="" id=""></textarea></td>
	<td><input name="jumlah[]" value="0" type="text" class="jumlah text-right" required="required" id="jumlah<?=$id?>"></td>
	<td><select id="satuanlist<?=$id?>" name='satuan[]' class='select2' style='width:100%'><?php foreach($satuan as $s):?><option value='<?php echo $s['id']?>'><?php echo $s['title']?></option><?php endforeach;?></select><input type='hidden' value='0' id="satuanlist_num<?=$id?>"></td>
	<td><input name="harga[]" value="0" type="text" class="harga text-right" required="required" id="harga<?=$id?>"></td>
	<td><input name="sub_total[]" type="text" class="subtotal text-right" required="required" id="subtotal<?=$id?>" value="0" readonly></td>
	<td><input type="file" name="attachment[]"></td>
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
		                $("#satuanlist<?=$id?>").select2().select2('val',data.satuan);
		                $("#harga<?=$id?>").val(data.harga);
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

	$("#harga<?=$id?>").add("#jumlah<?=$id?>").add("#disc<?=$id?>").add("#pajak<?=$id?>").keyup(function() {
			hitung<?=$id?>();
	    });

function hitung<?=$id?>()
   	{
   		if($('input[name="fraksi"]').is(":checked")){
			tf_1 = parseFloat($("#tf-1<?=$id?>").val());
			tf_2 = parseFloat($("#tf-2<?=$id?>").val());
			tf_3 = parseFloat($("#tf-3<?=$id?>").val());
			sf_1_num = parseFloat($("#sf1-num<?=$id?>").val());
			sf_2_num = parseFloat($("#sf2-num<?=$id?>").val());
			sf_3_num = parseFloat($("#sf3-num<?=$id?>").val());
			satuan_utama_num = parseFloat($("#satuanlist_num<?=$id?>").val());
			b = parseFloat($("#harga<?=$id?>").val().replace(/,/g,"")).toFixed(2),
			//$("#satuan"+id).select2().select2("val",tf_1);
			v1 = tf_1*(sf_1_num/satuan_utama_num)*b,
			v2 = tf_2*(sf_2_num/satuan_utama_num)*b,
			v3 = tf_3*(sf_3_num/satuan_utama_num)*b,
			val = parseFloat(v1) + parseFloat(v2) + parseFloat(v3),
			f_val = tf_1+'.'+tf_2+'.'+tf_3;
			$("#jumlah<?=$id?>").val(f_val);
			p = parseFloat($("#pajak<?=$id?>").val()).toFixed(2),
			$("#subtotal<?=$id?>").val(addCommas(parseFloat(val).toFixed(2)));
		}else{
			var a = parseFloat($("#jumlah<?=$id?>").val()),
			b = parseFloat($("#harga<?=$id?>").val().replace(/,/g,"")).toFixed(2),
			p = parseFloat($("#pajak<?=$id?>").val()).toFixed(2),
		val = (a*b);
			$("#subtotal<?=$id?>").val(addCommas(parseFloat(val).toFixed(2)));
		}

		subPajak = val*(p/100),//jumlah pajak
    	jmlPajak = 0,
    	total = 0;

    	$("#subpajak<?=$id?>").val(subPajak);
        $('.subpajak').each(function (index, element) {
            jmlPajak = jmlPajak + parseInt($(element).val());
        });
        $('.subtotal').each(function (index, element) {
            total = total + parseFloat($(element).val().replace(/,/g,""));
        });
        totalpluspajak = total + jmlPajak;
        $('#totalPajak').val(addCommas(parseFloat(jmlPajak).toFixed(2)));
        $('#total').val(addCommas(parseFloat(total).toFixed(2)));
        $('#totalpluspajak').val(addCommas(parseFloat(totalpluspajak).toFixed(2)));
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

