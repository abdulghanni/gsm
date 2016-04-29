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
      <td>No</td>
      <td>Kode</td>
      <td>Nama</td>
      <td>Tipe</td>
      <td>UP</td>
      <td>Jabatan</td>
      <td>Telepon</td>
      <td>Fax</td>
      <td>Email</td>
      <td>Alamat</td>
      <td>Catatan</td>
    </tr>
    <?php
	$a=1;
	 foreach($q as $ha){?>
    <tr>
      <td><?php echo $a; ?></td>
      <td><?php echo $ha['kode']?></td>
      <td><?php echo $ha['title']?></td>
      <td><?php echo GetValue('title','kontak_tipe',array('id'=>'where/'.$ha['tipe_id']))?></td>
      <td><?php echo $ha['up']?></td>
      <td><?php echo $ha['jabatan']?></td>
      <td><?php echo $ha['telepon']?></td>
      <td><?php echo $ha['fax']?></td>
      <td><?php echo $ha['email']?></td>
      <td><?php echo $ha['alamat']?></td>
      <td><?php echo $ha['catatan']?></td> 
    </tr>
    <?php $a++; }?>
  </tbody>
</table>
</body>
</html>