<tr>
	<td>
		<div class="checkbox clip-check check-primary checkbox-inline">
			<input type="checkbox" id="row<?=$id?>" value="" class="cek" name="row">
			<label for="row<?=$id?>">
			</label>
		</div>
	</td>

	<td><?= $id ?></td>

	<td>
		<select name='barang_id[]' class='barang' id="barang_id<?=$id?>" style='width:100%'>
			<option value="0">-- Pilih Barang --</option>
			<?php foreach($barang as $value=>$b):?>
				<option value='<?php echo $b['id']?>'><?php echo $b['kode'].' - '.$b['title']?></option>
			<?php endforeach;?>
		</select>
	</td>

	<td>
		<textarea name="catatan_barang[]" value="" type="text" class=""></textarea>
	</td>

	<td id="sisa_stok<?=$id?>">
	</td>
	<input type="hidden" id="stok_buku<?=$id?>" name="buku[]" value="">
	<input type="hidden" id="satuan_buku<?=$id?>" name="satuan_buku[]" value="">

	<td>
		<input name="fisik[]" value="0" type="text" class="jumlah text-right" style="width:100%" required="required" id="jumlah<?=$id?>">
	</td>

	<td>
		<select id="satuanlist<?=$id?>" name='satuan_id[]' class='select2' style='width:100%'><?php foreach($satuan as $s):?><option value='<?php echo $s['id']?>'><?php echo $s['title']?></option><?php endforeach;?></select><input type='hidden' value='0' id="satuanlist_num<?=$id?>">
	</td>

</tr>

<script type="text/javascript">
 $(document).find("select.barang").select2({
    dropdownAutoWidth : true,
    placeholder: "Cari Barang",
    minimumInputLength: 3,
});
$(document).find("select.select2").select2({
    dropdownAutoWidth : true
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
        		$('#sisa_stok<?=$id?>').text(data.sisa_stok+' '+data.satuan_title);
        		$('#stok_buku<?=$id?>').val(data.sisa_stok);
        		$('#satuan_buku<?=$id?>').val(data.satuan);
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
</script>
