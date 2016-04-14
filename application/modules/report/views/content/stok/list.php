<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<table width="100%" border="1" cellspacing="0" cellpadding="00">
  <tbody>
    <tr>
      <td>Kode</td>
      <td>Nama Barang</td>
      <td>Stok</td>
      <td>Harga Beli</td>
      <td>Total</td>
    </tr>
    <?php $brg=0; foreach($q as $h){
        $barang=GetAll('barang',array('id'=>'where/'.$h->barang_id))->row_array();
       
        ?>
    <tr>
      <td><?php echo $barang['kode'] ?></td>
      <td><?php echo $barang['title'] ?></td>
      <td><?php echo $h->dalam_stok ?></td>
      <td><?php echo $h->harga_beli ?></td>
      <td><?php echo $tot=$h->dalam_stok*$h->harga_beli ?></td>
    </tr><?php
    $brg+=$tot;
    
    }  ?>
    <tr>
      <td colspan="4">TOTAL</td>
      <td><?php echo $brg ?></td>
    </tr>
  </tbody>
</table>
</body>
</html>