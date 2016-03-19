
<table>

<tr id="department">
    <td>Gudang</td><td>:</td><td><?php echo form_dropdown('gudang',GetOptAll('gudang','-All-'),'class="barang"') ?></td>
</tr>
</table>
<script type="text/javascript">
	$(document).ready(function(e){
			
		
    	$(".barang").select2({});
    });
</script>