<tr id="periodmonth">
	<td>Period</td>
	<td>:</td>
	<td>
		<input name="start_date" class="tanggal span3">
		&nbsp;s / d&nbsp;
		<input name="end_date" class="tanggal span3">
	</td>
</tr>
<script src="<?php echo base_url();?>assets/js/ui.datepicker.js" type="text/javascript"></script>
<link rel="Stylesheet" type="text/css" href="<?php echo base_url();?>assets/style/smoothness/jquery-ui-1.7.1.custom.css"  />
<script>
$(function() 
{
	$('.tanggal').datepicker({
		changeMonth: true,
		changeYear: true,
		showButtonPanel: true,
    dateFormat: 'mm-yy',
    onClose: function(dateText, inst) { 
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, month, 1));
        }
	});
});
</script>
<style>
.ui-datepicker-calendar {
    display: none;
    }
</style>