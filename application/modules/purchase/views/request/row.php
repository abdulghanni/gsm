<tr>
	<td><?= $id ?></td>
	<td><select name='kode_barang[]' class='select2' id="barang_id<?=$id?>" style='width:100%'><?php foreach($barang as $value=>$b):?><option value='<?php echo $b['id']?>'><?php echo $b['kode'].' - '.$b['title']?></option><?php endforeach;?></select></td>
	<td><input name="deskripsi[]" value="0" type="text" class="form-control" required="required" id="deskripsi<?=$id?>"></td>
	<td><input name="jumlah[]" value="0" type="text" class="form-control jumlah text-right" required="required" id="jumlah<?=$id?>"></td>
	<td><select id="satuanlist<?=$id?>" name='satuan[]' class='select2' style='width:100%'><?php foreach($satuan as $s):?><option value='<?php echo $s['id']?>'><?php echo $s['title']?></option><?php endforeach;?></select><input type='hidden' value='0' id="satuanlist_num<?=$id?>"></td>
	<td><input name="harga[]" value="0" type="text" class="form-control harga text-right" required="required" id="harga<?=$id?>"></td>
	<td><input name="sub_total[]" type="text" class="form-control subtotal text-right" required="required" id="subtotal<?=$id?>" value="0" readonly></td>
	<td><input name="pajak[]" value="0" type="text" class="form-control text-right" required="required" id="pajak<?=$id?>"></td>
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
            url: '../order/get_nama_barang/'+id,
            success: function(data) {
                $('#deskripsi<?=$id?>').val(data);
            }
        });
         /*
         $.ajax({
            type: 'POST',
            url: '/gsm/purchase/request/get_satuan/'+id,
            data: {id : id},
            success: function(data) {
                $('#satuan'+rowCount).html(data);
            }
        });
        */

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
   			alert('an');
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
			$("#subtotal<?=$id?>").val(addCommas(parseFloat(val).toFixed(2)));
		}else{
			alert('dsa');
			$("#subtotal<?=$id?>").val(addCommas(parseFloat(val).toFixed(2)));
		}
   	}
</script>

