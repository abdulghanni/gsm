
<table>

<tr id="department">
    <td width="20%">Supplier</td><td width="1%">:</td><td width="79%"><?php echo form_dropdown('supplier',GetOptAll('kontak','-All-'),'','class="kontak form-control" style="border:0"') ?></td>
</tr>
</table>
<script type="text/javascript">
	$(document).ready(function(e){
    	$(".kontak").select2();
    });
</script>