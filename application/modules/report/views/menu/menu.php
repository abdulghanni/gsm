<?php if(!isset($katakuncirahasia)){error_reporting(E_ALL^E_NOTICE);}?>
<script type="text/javascript">
$(document).ready(function(e){
	$('.select2').select2({
        dropdownAutoWidth : true
    });
});
function carimenu(id)
{
	$.ajax({
        type: 'POST',
        url: '/gsm/report/Index/response_cat/'+id,
        success: function(data) {
        	//$(document).find("select.select2").select2();
			$("#documents").html(data);
			$(document).find("select.select2").select2({
		        dropdownAutoWidth : true
		    });
        }
    });
}
function carikar(id)
{
	if(!id) id = "0";
	$("#karyawannya").load('<?php echo base_url()?>report/karyawannya/'+id);
}
</script>

<section id="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="mainTitle">Laporan</h1>
        </div>
        <ol class="breadcrumb">
            <li>
                <span><?php echo lang('order');?></span>
            </li>
            <li class="active">
                <span>Index</span>
            </li>
        </ol>
    </div>
</section>
    <div class="container-fluid container-fullw bg-white">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
				<table style='width:50%;'>
		<tr id="head">
	    <td>Type Document</td>
	  </tr>
		<tr>
			<td>
					<?php echo form_dropdown($nm_f,$opt_dok, (isset($val[$nm_f]) ? $val[$nm_f] : ''),"class='chosen-select select2' onChange='carimenu(this.value)' style='width:100%;'")?>
			</td>
		</tr>
		<tr>
			<td style="padding-left:0px;">
				<div id='documents' style="margin-top:25px;"></div>
			</td>
		</tr>
	</table>
            </div>
            
        </div>
    </div>
</div>