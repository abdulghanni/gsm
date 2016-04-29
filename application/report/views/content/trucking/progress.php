<style>
.theader td{
	background-color:yellow;
    font-weight: bold;
}
</style>
<table width="100%" border="1" cellspacing="0" >
 
  <?php foreach($isi as $hasil) {
		$jo=$this->db->query("SELECT * FROM sv_trucking_order WHERE number='".$hasil['number']."'")->row_array();
				$vno=GetValue( 'code' ,'sv_master_truck', array('id'=>'where/'.$jo['vehicle_no']));
				$client=GetValue('name','sv_master_client',array('id'=>'where/'.$hasil['client']));
				for ($a=1;$a<=5;$a++){ 
				$p[$a]=($hasil["picture$a"]==NULL ? '' : "<img src='././assets/ace/pictures/".$hasil["picture$a"]."'width='100' height='100'/>&nbsp;");
				}
	  ?> 
<tr align="center" class="theader">
    <td>Client</td>
    <td 	width="9%%">Date</td>
    <td >Location</td>
    <td >Supir</td>
    <td >Tlp Supir</td>
    <td width="3%">Vehicle No </td>
    <td width="3%">Tiba Tempat Muat </td>
    <td width="3%">Keluar Tempat Muat</td>
    <td width="3%">Start Stuffing </td>
    <td width="3%">Finish Stuffing </td>
    <td>Bongkar</td>
    <td width="3%">Tiba Tempat Bongkar </td>
    <td width="3%">Keluar Tempat Bongkar </td>
    <td>Keterangan</td>
    <td><?php echo $hasil['label1']?></td>
    <td><?php echo $hasil['label2']?></td>
    <td><?php echo $hasil['label3']?></td>
    <td>Pictures 1</td>
    <td>Pictures 2</td>
    <td>Pictures 3</td>
    <td>Pictures 4</td>
    <td>Pictures 5</td>
  </tr>
  <tr align="center">
    <td><?php echo $client;?></td>
    <td><?php echo FormatTanggal(substr($hasil['create_date'],0,11)) ?></td>
    <td><?php echo $hasil['location'] ?></td>
    <td><?php echo $hasil['supir'] ?></td>
    <td><?php echo $hasil['tlp_supir'] ?></td>
    <td><?php echo $vno ?></td>
    <td><?php echo $hasil['ttm'] ?></td>
    <td><?php echo $hasil['ktm'] ?></td>
    <td><?php echo $hasil['ss'] ?></td>
    <td><?php echo $hasil['fs'] ?></td>
    <td><?php echo $hasil['bongkar'] ?></td>
    <td><?php echo $hasil['ttb'] ?></td>
    <td><?php echo $hasil['ktb'] ?></td>
    <td><?php echo $hasil['keterangan'] ?></td>
    <td><?php echo $hasil['val1']?></td>
    <td><?php echo $hasil['val2']?></td>
    <td><?php echo $hasil['val3']?></td>
    <td><?php echo $p['1']?></td>
    <td><?php echo $p['2']?></td>
    <td><?php echo $p['3']?></td>
    <td><?php echo $p['4']?></td>
    <td><?php echo $p['5']?></td>
    <!--td colspan="12">
	<?php for ($a=1;$a<=3;$a++){	
	echo $p[$a]; ?>
	<?php } ?><br/>
	<?php for ($a=4;$a<=5;$a++){	
	echo $p[$a]; ?>
	<?php } ?><br/>
	</td-->
  <?php } ?>
</table>
<?php  ?>