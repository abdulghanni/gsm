  <!--including-->
  <?php if(!isset($katakuncirahasia)){error_reporting(E_ALL^E_NOTICE);}?>
<!--
<script type="text/javascript" src="<?php echo base_url()?>assets/js/print_f.js"></script>-->
<script type="text/javascript">
function carimenu(id)
{
	$("#documents").load('<?php echo base_url()?>report/Index/response_cat/'+id);
}
function carikar(id)
{
	if(!id) id = "0";
	$("#karyawannya").load('<?php echo base_url()?>report/karyawannya/'+id);
}
</script>
<!--<fieldset style="border:1px solid black; border-radius:5px; width:40%; margin:0 auto;"> <legend> Document Report </legend>-->
<div id="search">
	
</div>
<section id="page-title">
    <div class="row">
        <div class="col-sm-8">
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
<script>
	$(document).ready(function(e){
		$('.select2').select2();
	});
</script>