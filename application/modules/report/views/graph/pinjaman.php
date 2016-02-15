<form method="post" action="<?php echo site_url('graph_pinjaman').'/view'?>"><tr id="periodmonth">
	<td>Period</td>
	<td>:</td>
	<td>
		<input name="period" class="tanggal span3" value="<?php echo date('Y-m')?>">
	<input type="submit" value="GO" class="span3">
    </td>
</tr>
</form>
<script src="<?php echo base_url();?>assets/js/ui.datepicker.js" type="text/javascript"></script>
<link rel="Stylesheet" type="text/css" href="<?php echo base_url();?>assets/style/smoothness/jquery-ui-1.7.1.custom.css"  />
<script>
$(function() 
{
	$('.tanggal').datepicker({
		changeMonth: true,
		changeYear: true,
		showButtonPanel: true,
    dateFormat: 'yy-mm',
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
<script src="<?php echo site_url('assets')?>/hichart/highcharts.js"></script>
<script src="<?php echo site_url('assets')?>/hichart/modules/data.js"></script>
<script src="<?php echo site_url('assets')?>/hichart/modules/exporting.js"></script>
<script type="text/javascript">
$(function () {
    $('#laba').highcharts({
        data: {
            table: document.getElementById('isi_laba')
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Pinjaman - <?php echo getBulan(substr($fulldate,5,2)).' '.substr($fulldate,0,4) ?>'
        },
        yAxis: { 
            allowDecimals: false,
            title: {
                text: 'Rupiah'
            }
        }, 
        tooltip: {
            formatter: function() {
                return '<b>'+ this.point.name.toLowerCase() +'</b><br/>'+
                    this.point.y +' '+ 'Rupiah';
            }
        },
		credits:{
			enabled: false,
			href: '',
			text : "Fauzan Rabbani"	
			
		}
    });
});
		</script>

<div id="laba" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<table id="isi_laba">
	<thead>
		<tr>
			<th>Tanggal</th>
			<th>Pinjaman(Rupiah)</th>
		</tr>
	</thead>
	<tbody>
    <?php
	 for($a=1;$a<=substr($fulldate,8,2);$a++){
		 $f=explode('-',$fulldate);
		 if(strlen($a)==1){$s='0'.$a;}else{$s=$a;}
		 ?>
		<tr>
			<th><?php echo 'Tgl '.$a;
			?></th>
			<td><?php echo GetPinjamanHarian($f[0].'-'.$f[1].'-'.$s)?></td>
		</tr>
        <?php } ?>
	</tbody>
</table>
	</body>
</html>