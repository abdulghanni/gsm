<script type="text/javascript">
function printDiv() {
      var printContents = document.getElementById("printarea").innerHTML;     
   var originalContents = document.body.innerHTML;       
   document.body.innerHTML = printContents;      
   window.print();      
   document.body.innerHTML = originalContents;
   }
</script>
<div id="printbutton" style="float:right;"><button  onclick="printDiv()">Print!</button></div>
<div id="printarea" style="width:100%;">
<div id="Header"> <span style="font-family:arial; float:left; font-weight:bold; text-decoration:underline; width:60%; font-size:12px;"><?php echo GetValue('nama','tb_kode_koperasi',array('id'=>1))?></span><br/>
	<span style=""><?php echo GetValue('alamat','tb_kode_koperasi',array('id'=>1))?></span><br/>
	<span style=""><?php echo GetValue('tlp','tb_kode_koperasi',array('id'=>1))?></span></div>
<div id="isi" style="font-size:<?php echo $this->fonthead;?>"><?php $this->load->view('report/layout/'.$content)?></div>
</div>