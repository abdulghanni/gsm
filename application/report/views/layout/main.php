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
<?php if(isset($lembarkedua)){ ?>
<div id="lembarkedua"><a href="<?php echo base_url().'printing/lembarkeduatrucking/'.$lembarkeduaid?>" style="font-size:13px;" target="_blank">Lembar Kedua</a></button></div>
<?php } ?>
<div id="printarea">

<div id="Header"> 
	<span style="font-family:arial; float:left; font-weight:bold; text-decoration:underline; width:100%; font-size:16pt;">
            <img src="<?php echo base_url()?>assets/images/logo-po.jpg" width="250px">
       
        </span>
</div>
<div id="isi">
	<?php $this->load->view('content/'.$content);?>
</div>
</div>