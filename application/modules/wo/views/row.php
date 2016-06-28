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
		<select name='barang_id[]' class='select2' id="barang_id<?=$id?>" style='width:100%'>
			<option value="0">-- Pilih Barang --</option>
			<?php foreach($barang as $value=>$b):?>
			<option value='<?php echo $b['id']?>'><?php echo $b['kode'].' - '.$b['title']?></option><?php endforeach;?>
		</select>
	</td>
	<td><textarea name="deskripsi[]" value="0" type="text" class="" id="deskripsi<?=$id?>"></textarea></td>
	<td><textarea name="catatan_barang[]" value=" " class="" id=""></textarea></td>
	<td><input name="jumlah[]" value="0" type="text" class="jumlah text-right" required="required" id="jumlah<?=$id?>"></td>
	<td>
		<select id="satuanlist<?=$id?>" name='satuan[]' class='select2' style='width:100%'><?php foreach($satuan as $s):?><option value='<?php echo $s['id']?>'><?php echo $s['title']?></option><?php endforeach;?></select><input type='hidden' value='0' id="satuanlist_num<?=$id?>">
		<input type="hidden" id="sisa_stok_val<?=$id?>" name="sisa_stok[]" value="0">
	</td>
	<td id="sisa_stok<?=$id?>" class="text-right">
		0
	</td>
</tr>
<script type="text/javascript"> $(document).find("select.select2").select2({
        dropdownAutoWidth : true
    });</script>
<script type="text/javascript">
	$("#barang_id<?=$id?>").change(function(){
        var id = $(this).val();
         $.ajax({
            type: "GET",
            dataType: "JSON",
            url: '/gsm/purchase/order/get_nama_barang/'+id,
            success: function(data) {
            	if(id != '0'){
            		$('#deskripsi<?=$id?>').val(data.nama_barang);
            		$('#sisa_stok<?=$id?>').text(data.sisa_stok+" "+data.satuan_title);
            		$('#sisa_stok_val<?=$id?>').val(data.sisa_stok);
            		if(data.photo != ''){
			            $("#photo<?=$id?>").attr("src", "http://"+window.location.host+"/gsm/uploads/barang/"+id+"/"+data.photo);
			        }else{
			            $("#photo<?=$id?>").attr("src", "http://"+window.location.host+"/gsm/assets/assets/images/no-image-mid.png");    
			        }      
	                $("#satuanlist<?=$id?>").select2().select2('val',data.satuan);
            	}
            }
        });
    })

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

