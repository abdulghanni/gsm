
<table>

<tr id="department">
    <td width="20%">Barang</td><td width="1%">:</td><td width="79%"><?php echo form_dropdown('barang',GetOptAll('barang','-All-','','kode','id','title'),'','class="barang form-control" style="border:0"') ?></td>
</tr>
</table>
<script type="text/javascript">
	$(document).ready(function(e){
			
		
    	$(".barang").select2();
    });
</script>