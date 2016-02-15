<style>
font-family:"<?php echo $this->fonts?>";
</style>
<style>
.theader{
	background-color:cyan;
		font-weight: bold;
}
</style>
<script type="text/javascript">
	///window.jQuery || document.write("<script src='<?php echo base_url('assets')?>/ace/js/jquery.js' >"+"<"+"/script>");
</script>
<script type="text/javascript">
/* $(document).ready(function(e){


$( "tr:first" ).addClass( "theader" );

}); */
	<?php if($autoprint==TRUE){?>
	document.addEventListener("DOMContentLoaded", function(event) { 
		printDiv();
	});<?php }?>

function printDiv() {
      var printContents = document.getElementById("printarea").innerHTML;     
   var originalContents = document.body.innerHTML;       
   document.body.innerHTML = printContents;      
   window.print();      
   document.body.innerHTML = originalContents;
   }
</script>
<div id="printbutton"><button  onclick="printDiv()">Print!</button></div>
<?php if($lembarkedua){ ?>
<div id="lembarkedua"><a href="<?php echo base_url().'printing/lembarkeduatrucking/'.$lembarkeduaid?>" style="font-size:13px;" target="_blank">Lembar Kedua</a></button></div>
<?php } ?>
<div id="printarea">

<!--div id="Header"> 
	<span style="font-family:arial; float:left; font-weight:bold; text-decoration:underline; width:100%; font-size:16pt;"><?php echo GetValue('name','sv_setup_company	',array('id'=>1))?></span><br/>
	<span style=""><?php echo GetValue('address','sv_setup_company',array('id'=>1))?></span><br/>
	<span style="">Tlp <?php echo GetValue('phone1','sv_setup_company',array('id'=>1))?></span>
</div-->
<div id="isi">
	<?php $this->load->view('report/'.$content);?>
</div>
</div>