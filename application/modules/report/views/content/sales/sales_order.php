<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sales Order</title>
</head>

<body>
<table border="1" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td width="33" valign="top"><p><strong>No<u></u><u></u></strong></p></td>
      <td width="115" valign="top"><p><strong>Customer Name<u></u><u></u></strong></p></td>
      <td width="103" valign="top"><p><strong>PO Date<u></u><u></u></strong></p></td>
      <td width="133" valign="top"><p><strong>PO No<u></u><u></u></strong></p></td>
      <td width="99" valign="top"><p><strong>Project<u></u><u></u></strong></p></td>
      <td width="71" valign="top"><p><strong>Delivery Date<u></u><u></u></strong></p></td>
      <td width="105" valign="top"><p><strong>Deliver to<u></u><u></u></strong></p></td>
      <td width="69" valign="top"><p><strong>Bom Code<u></u><u></u></strong></p></td>
      <td width="227" nowrap="" valign="top"><p><strong>Material Description<u></u><u></u></strong></p></td>
      <td width="40" valign="top"><p><strong>Unit<u></u><u></u></strong></p></td>
      <td width="60" valign="top"><p><strong>Qty<u></u><u></u></strong></p></td>
      <td width="83" valign="top"><p><strong>Price<u></u><u></u></strong></p></td>
      <td width="101" valign="top"><p><strong>Total Price<u></u><u></u></strong></p></td>
      <td width="109" valign="top"><p><strong>Sub Total<u></u><u></u></strong></p></td>
      <td width="83" valign="top"><p><strong>VAT<u></u><u></u></strong></p></td>
      <td width="109" valign="top"><p><strong>Total Amount<u></u><u></u></strong></p></td>
      <td width="129" valign="top"><p><strong>Invoice No<u></u><u></u></strong></p></td>
      <td width="67" valign="top"><p><strong>Date of Invoice<u></u><u></u></strong></p></td>
      <td width="87" valign="top"><p><strong>Payment received<u></u><u></u></strong></p></td>
      <td width="80" valign="top"><p><strong>Date of payment</strong></p></td>
    </tr>
    <?php
    $keluarin=TRUE;
$no=1; //print_mz($result);
foreach($q as $hasil)
{
     if($barang){
           $listz=GetAll('sales_order_list',array('order_id'=>'where/'.$hasil->id,'kode_barang'=>'where/'.$barang));
           
           if($listz->num_rows()==0) {$keluarin=FALSE;}
           else {$keluarin=TRUE;}
       }
       if($keluarin){
    ?>
    <tr>
      <td valign="top" align="center" style="border-top:3px solid black!important;"><?php echo $no ?></td>
      <td valign="top" style="border-top:3px solid black!important;"><?php echo '&nbsp;'.GetValue('title','kontak',array('id'=>'where/'.$hasil->kontak_id))?></td>
      <td valign="top" style="border-top:3px solid black!important;">&nbsp;<?php echo $hasil->tanggal_transaksi ?></td>
      <td valign="top" style="border-top:3px solid black!important;">&nbsp;<?php echo $hasil->so ?></td>
      <td valign="top" style="border-top:3px solid black!important;">&nbsp;<?php echo $hasil->project ?></td>
      <td valign="top" style="border-top:3px solid black!important;">&nbsp;</td>
      <td valign="top" style="border-top:3px solid black!important;">&nbsp;</td>
      <td valign="top" style="border-top:3px solid black!important;">&nbsp;</td>
      <td nowrap="" valign="top" style="border-top:3px solid black!important;">&nbsp;</td>
      <td valign="top" style="border-top:3px solid black!important;">&nbsp;</td>
      <td valign="top" style="border-top:3px solid black!important;">&nbsp;</td>
      <td valign="top" style="border-top:3px solid black!important;">&nbsp;</td>
      <td valign="top" style="border-top:3px solid black!important;">&nbsp;</td>
      <td valign="top" style="border-top:3px solid black!important;">&nbsp;</td>
      <td valign="top" style="border-top:3px solid black!important;">&nbsp;</td>
      <td valign="top" style="border-top:3px solid black!important;">&nbsp;</td>
      <td valign="top" style="border-top:3px solid black!important;">&nbsp;</td>
      <td valign="top" style="border-top:3px solid black!important;">&nbsp;</td>
      <td valign="top" style="border-top:3px solid black!important;">&nbsp;</td>
      <td valign="top" style="border-top:3px solid black!important;">&nbsp;</td>
    </tr>
    <?php
    
       if($barang){
       $list=GetAll('sales_order_list',array('order_id'=>'where/'.$hasil->id,'kode_barang'=>'where/'.$barang))->result();}
       else{
       $list=GetAll('sales_order_list',array('order_id'=>'where/'.$hasil->id))->result();    }
    foreach($list as $ls){?>
    
    <tr>
      <td valign="top"></td>
      <td valign="top"></td>
      <td valign="top"></td>
      <td valign="top"></td>
      <td valign="top"></td>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td nowrap="" valign="top">&nbsp;<?php echo $ls->deskripsi ?></td>
      <td valign="top">&nbsp;<?php echo '&nbsp;'.GetValue('title','satuan',array('id'=>'where/'.$ls->satuan_id))?></td>
      <td valign="top">&nbsp;<?php echo $ls->jumlah ?></td>
      <td valign="top">&nbsp;<?php echo uang($ls->harga) ?></td>
      <td valign="top">&nbsp;<?php echo uang($ls->jumlah*$ls->harga) ?></td>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
    </tr>
    <?php }?>
<?php 
$no++;
}
}
  ?>
  </tbody>
</table>
</body>
</html>