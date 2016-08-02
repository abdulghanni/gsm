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

	<td>
		<select name='kode_barang[]' class='barang' id="barang_id<?=$id?>" style='width:100%'>		<option value="0">-- Pilih Barang --</option>
		<?php foreach($barang as $value=>$b):?>
		<option value='<?php echo $b['id']?>'><?php echo $b['kode'].' - '.$b['title']?></option><?php endforeach;?></select>
	</td>

	<td>
		<div id="ss"><img width="75px" width="75px" id="photo<?=$id?>" src="<?=assets_url('assets/images/no-image-mid.png')?>" /></div>
	</td>

	<td>
		<textarea name="deskripsi[]" value="0" type="text" class="" required="required" id="deskripsi<?=$id?>"></textarea>
	</td>

	<td>
		<textarea name="catatan_barang[]" value="0" type="text" class=""></textarea>
	</td>

	<td>
		<input name="jumlah[]" value="0" type="text" class="jumlah text-right" style="width:100%" required="required" id="jumlah<?=$id?>">
	</td>

	<td id="sisa_stok<?=$id?>">
	</td>

	<td>
		<select id="satuanlist<?=$id?>" name='satuan[]' class='select2' style='width:100%'><?php foreach($satuan as $s):?><option value='<?php echo $s['id']?>'><?php echo $s['title']?></option><?php endforeach;?></select><input type='hidden' value='0' id="satuanlist_num<?=$id?>">
	</td>

	<td>
		<input name="harga[]" value="0" type="text" class=" harga text-right" required="required" id="harga<?=$id?>">
	</td>

	<td class="text-right">
		<input type="text" name="disc[]" class=" text-right disc" style="width:100%" value="0" id="disc<?=$id?>">
		<input type="hidden" name="subdisc[]" class=" text-right subdisc" value="0" id="subdisc<?=$id?>">
	</td>

	<td>
		<input name="sub_total[]" type="text" class=" subtotal text-right" required="required" id="subtotal<?=$id?>" value="0" readonly>
	</td>

	<td class="text-center">
		<input name= "pajak_checkbox1_checkbox[]" type="checkbox" id="pajak<?=$id?>" value="1">
		<input type="hidden" name="pajak_checkbox1[]" value="0" />
		<input name="pajak[]" value="0" type="hidden" class="subpajak" id="subpajak<?=$id?>">
		<input name="" value="0" type="hidden" class="exc" id="exc<?=$id?>">
	</td>

	<td><input type="file" name="attachment[]"></td>

</tr>
<script type="text/javascript"> $(document).find("select.barang").select2({
        dropdownAutoWidth : true,
        placeholder: "Cari Barang",
        minimumInputLength: 3,
    });
    $(document).find("select.select2").select2({
        dropdownAutoWidth : true
    });
    </script>
<script type="text/javascript">
var dec = 2;
var dec = $("#opsi_desimal_val").val();
var dec = parseInt(dec);
$('.harga').maskMoney({allowZero:true, precision: dec});
	$("#pajak<?=$id?>").click(function(){
	    hitung<?=$id?>();
	});
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

	$("#barang_id<?=$id?>").change(function(){
	        var id = $(this).val();
	         $.ajax({
	            type: "GET",
	            dataType: "JSON",
	            url: '/gsm/purchase/order/get_nama_barang/'+id,
	            success: function(data) {
	            	if(id != '0'){
	            		cekStok(id);
	            		$('#deskripsi<?=$id?>').val(data.nama_barang);
	            		$('#sisa_stok<?=$id?>').text(data.sisa_stok+' '+data.satuan_title);
	            		if(data.photo != ''){
				            $("#photo<?=$id?>").attr("src", "http://"+window.location.host+"/gsm/uploads/barang/"+id+"/"+data.photo);
				        }else{
				            $("#photo<?=$id?>").attr("src", "http://"+window.location.host+"/gsm/assets/assets/images/no-image-mid.png");    
				        }
	            	}
	            }
	        });
	    })

	function cekStok(id){
		 $.ajax({
	            type: "GET",
	            dataType: "JSON",
	            url: '/gsm/sales/order/cek_stok/'+id,
	            success: function(data) {
	            	if(data == '0'){
	            		alert('Stok Barang Yang Dipilih Kosong')
	            	}
	            }
	        });
	}

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
   		if($('#dp-persen-cek').is(':checked')){
			$('#dibayar-nominal').val(parseFloat(0));
		}else{
			$('#dibayar').val(parseFloat(0));
		}
    	var a = parseFloat($('#jumlah'+<?=$id?>).val()),
        	b = parseFloat($('#harga'+<?=$id?>).val().replace(/,/g,"")).toFixed(dec),
        	c = parseFloat($('#disc'+<?=$id?>).val()),
        	p = parseFloat($("#subpajak<?=$id?>").val()).toFixed(dec),
			
        	diBayar = parseFloat($('#dibayar').val().replace(/,/g,"")),
        	diBayarNominal = parseFloat($('#dibayar-nominal').val().replace(/,/g,"")),
        	biayaPengiriman = parseFloat($('#biaya_pengiriman').val().replace(/,/g,"")),
        	d = (a*b)*(c/100),//jumlah diskon
       		val = (a*b)-d,
       		disc = (a*b)*(c/100),
        	subPajak = val*(p/100),//jumlah pajak
        	ppn = $("#ppn_val").val(),
			pph22 = $("#pp22_val").val(),
			pph23 = $("#pp23_val").val(),
			//ppnx =  val*(ppn/100);
			ppnx =  val - (val/1.1);
        	totalPajak = 0,
        	jmlDisc = 0,
        	total = 0;
        	exc= 0;

        $('#subtotal'+<?=$id?>).val(addCommas(parseFloat(val).toFixed(dec)));
        $("#subdisc"+<?=$id?>).val(addCommas(parseFloat(disc).toFixed(dec)));
        $('.subtotal').each(function (index, element) {
            total = total + parseFloat($(element).val().replace(/,/g,""));
        });
        $('.subdisc').each(function (index, element) {
            jmlDisc = jmlDisc + parseFloat($(element).val().replace(/,/g,""));
        });

        if($("#pajak<?=$id?>").is(':checked')){
        	ppnx =  val - (val/1.1);
			$("#subpajak<?=$id?>").val(parseFloat(ppnx));
			$("#exc<?=$id?>").val(parseFloat(0));
		}else{
			ppnx =  val * (10/100);
			$("#subpajak<?=$id?>").val(parseFloat(ppnx));
			$("#exc<?=$id?>").val(parseFloat(ppnx));
		}
		$('.subpajak').each(function (index, element) {
            totalPajak = totalPajak + parseFloat($(element).val().replace(/,/g,""));
        });

        $('.exc').each(function (index, element) {
            exc = exc + parseFloat($(element).val().replace(/,/g,""));
        });

		parseFloat($('#totalPajak').val(totalPajak));
		/*
        if($('#kpajak1').is(':checked')){
			parseFloat($('#totalPajak').val(total*(10/100)));
		}else{
			$('#totalPajak').val(parseFloat(0));
		}
		*/
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

        total = total+biayaPengiriman+exc;
        totalpluspajak = total+p1+p2+p3;
        totalminuspajak = total-p1-p2-p3;
        diBayar = totalpluspajak * (diBayar/100);
        $('#totalPajak').val(addCommas(parseFloat(totalPajak).toFixed(dec)));
        $('#total-diskon').val(addCommas(parseFloat(jmlDisc).toFixed(dec)));
        $('#total').val(addCommas(parseFloat(totalminuspajak).toFixed(dec)));
        
        $('#totalpluspajak').val(addCommas(parseFloat(total).toFixed(dec)));
        var saldo = total-diBayar-diBayarNominal;
        $('#saldo').val(addCommas(parseFloat(saldo).toFixed(dec)));	
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

