<br><div id='title'><br><br><span style="margin:0 auto; font-family:Calibri;">PERIOD : <?php echo $period?></span><br><br><span style="margin:0 auto; font-family:Calibri;">Tanggal Cetak : <?php echo date("d-m-Y")?></span><br>

</div>
<div id='dataarea'><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid black;">
<tr style="font-size:<?php echo $this->fonthead;?>; font-family:Comic Sans MS; font-weight:bold;" >
<th width="2%" style="border:1px double black;">No</th>
<th width="20%" style="border:1px double black;">Tanggal</th>
<th width="23%" style="border:1px double black;">No. Faktur</th>
<th width="23%" style="border:1px double black;">Keterangan</th>
<th width="12%" style="border:1px double black;">Penjualan</th>
<th width="12%" style="border:1px double black;">HPP Jual</th>
<th width="12%" style="border:1px double black;">Diskon</th>
<th width="12%" style="border:1px double black;">Biaya</th>
<th width="12%" style="border:1px double black;">Laba Rugi</th>
</tr>
<?php if($_POST['selfield'][0]==1){?>
<tr style="font-size:<?php echo $this->fonthead;?>; font-family:Comic Sans MS; font-weight:bold;" >
<th width="2%" style="border:1px double black;">Kode Barang</th>
<th width="20%" style="border:1px double black;">QTY</th>
<th width="23%" style="border:1px double black;">Harga Jual</th>
<th width="23%" style="border:1px double black;">Harga Pokok</th>
<th width="12%" style="border:1px double black;">Selisih Laba/Rugi</th>
</tr>
<?php }?>
<?php
$no=1; //print_mz($result);
$semua=0;
//print_mz($this->input->post());
foreach($result as $hasil)
$pnjualandetail=GetSummaryPenjualan($hasil->id_penjualan);
{
 	?>
<tr style="border:1px solid black; font-size:12; font-family:Comic Sans MS;">
<th valign="top" style="border:1px solid black;"><?php echo $no;?></th>
<th valign="top" align="center" style="border:1px solid black;"><?php echo '&nbsp;'.$hasil->tanggal?></th>
<th valign="top" style="border:1px solid black;"><?php echo '&nbsp;'.$hasil->id_penjualan?></th>
<th valign="top" style="border:1px solid black;"><?php echo 'Penjualan'?></th>
<th valign="top" style="border:1px solid black;"><?php echo '&nbsp;'.$pnjualandetail['total']?></th>
<th valign="top" style="border:1px solid black;"><?php echo '&nbsp;'.$pnjualandetail['beli']?></th>
<th valign="top" style="border:1px solid black;"><?php echo '&nbsp;'?></th>
<th valign="top" style="border:1px solid black;"><?php echo '&nbsp;' ?></th>
<th valign="top" style="border:1px solid black;"><?php echo '&nbsp;'.$pnjualandetail['laba']?></th>
</tr>
<?php if($_POST['selfield'][0]==1){
	$qs=$this->db->select('*')->from('tb_penjualan_detail')->where('id_penjualan',$hasil->id_penjualan)->get()->result_array();
	//lastq();
	foreach($qs as $qs){
	?>
<tr style="font-size:<?php echo $this->fonthead;?>; font-family:Comic Sans MS; font-weight:bold;" >
<th width="2%" style="border:1px double black;"><?php echo $qs['kode_barang']?></th>
<th width="20%" style="border:1px double black;"><?php echo $qs['jumlah']?></th>
<th width="23%" style="border:1px double black;"><?php echo $qs['jumlah']*$qs['satuan']?></th>
<th width="23%" style="border:1px double black;"><?php echo $qs['jumlah']*$qs['beli']?></th>
<th width="12%" style="border:1px double black;"><?php echo ($qs['jumlah']*$qs['satuan'])-($qs['jumlah']*$qs['beli'])?></th>
</tr>
<?php } }?>
<?php 
$no++;
$semua+=$pnjualandetail['laba'];
}
  
  ?>
  <tr><th colspan="6">TOTAL</th>
  <th><?php echo $semua;?></th>
  </th>
  </tr>
</table></div>