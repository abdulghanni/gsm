<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Purchase Order</title>
</head>

<body>
  <br><div id='title'><br><br><span style="margin:0 auto; font-family:Calibri;">PERIOD : <?php echo $period?></span><br><br><span style="margin:0 auto; font-family:Calibri;">Tanggal Cetak : <?php echo date("d-m-Y")?></span><br>
<?php error_reporting(E_ALL);// echo print_r($kolom); ?>
</div>  
    
   <?php
   $keluarin=TRUE;
   foreach($q as $h){ 
       //echo $barang;
       if($barang){
           $listz=GetAll('purchase_order_list',array('order_id'=>'where/'.$h['id'],'kode_barang'=>'where/'.$barang));
           
           if($listz->num_rows()==0) {$keluarin=FALSE;}
           else {$keluarin=TRUE;}
       }
      if($keluarin){
        $list=GetAll('purchase_order_list',array('order_id'=>'where/'.$h['id']))->result_array();
       ?>
<table width="100%" border="0" style="border:1px solid black;">
  <tbody>
    <tr>
      <td><strong>Tgl</strong></td>
      <td><strong>Nama Supplier</strong></td>
      <td><strong>Divisi</strong></td>
      <td><strong>Project</strong></td>
      <td><strong>No PO</strong></td>
      <td><strong>Harga</strong></td>
      <td><strong>Qty</strong></td>
      <td><strong>Dpp</strong></td>
      <td><strong>Discount</strong></td>
      <td><strong>PPn</strong></td>
      <td><strong>Total</strong></td>
    </tr>
    <tr>
      <td><strong>Kode Barang</strong></td>
      <td><strong>Nama Barang</strong></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="46"><?php echo GetValue('title','gudang',array('id'=>'where/'.$h['gudang_id']));?>
          <br/>
      <?php echo date('d-m-Y',strtotime($h['tanggal_transaksi']));?> <br/>
           <br/>
      </td>
      <td><br/>
           <br/>
           <br/>
           <strong><?php echo GetValue('title','kontak',array('id'=>'where/'.$h['kontak_id']));?></strong>
           <br/>
</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
      <?php
      $dpptot=$distot=$ppntot=$tot=0;
      foreach($list as $ls){
          $totharsat=$ls['jumlah'] * $ls['harga'] - $ls['disc'] + $ls['pajak'];
          $dpptot+=0;
          $distot+=$ls['disc'];
          $ppntot+=$ls['pajak'];
          $tot+=$totharsat;
          
          ?>
          
    <tr>
      <td border="0" cellspacing="0" cellpading="0"><?php echo GetValue('kode','barang',array('id'=>'where/'.$ls['kode_barang']));?></td>
      <td><?php echo $ls['deskripsi'];?></td>
      <td><?php echo '';?></td>
      <td><?php echo $h['proyek'] ?></td>
      <td><?php echo $h['po'] ?></td>
      <td><?php echo $ls['harga'] ?></td>      
      <td><?php echo $ls['jumlah'] ?></td>
      <td>&nbsp;</td>
      <td><?php echo $ls['disc'] ?></td>
      <td><?php echo $ls['pajak'] ?></td>
      <td><?php echo $totharsat ?></td>
    </tr>
    
      <?php }?>
    <tr>
      <td><strong>SubTotal</strong></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><strong><?php echo $dpptot ?></strong></td>
      <td><strong><?php echo $distot ?></strong></td>
      <td><strong><?php echo $ppntot ?></strong></td>
      <td><strong><?php echo $tot ?></strong></td>
    </tr>
  </tbody>
</table>
      <?php } }?>
</body>
</html>