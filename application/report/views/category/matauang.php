
<table>

<tr id="department">
    <td width="20%">Mata Uang</td><td width="1%">:</td><td width="79%"><?php echo form_dropdown('kurensi',GetOptAll('kurensi','-All-'),'','class="kurensi form-control" style="border:0"') ?></td>
</tr>
</table>
<script type="text/javascript">
	$(document).ready(function(e){
    	$(".kurensi").select2();
    });
</script>