
<table>

<tr id="department">
    <td>Barang</td><td>:</td><td><?php echo form_dropdown('barang',GetOptAll('barang','-All-'),'class="barang"') ?></td>
</tr>
</table>
<script type="text/javascript">
	$(document).ready(function(e){
			
		
    	$(".barang").select2({});
    });
</script>