<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Master Kontak</title>
<style type="text/css">
td{ height:30px;}
textarea {
    border: none;
    overflow: auto;
    outline: none;

    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
}
.catatan {font-family:Arial, sans-serif;font-size:10px;}
.list td{ height:40px;font-family:sans, sans-serif;font-size:12px;padding:12px 16px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
.list th{height:40px; font-family:sans, sans-serif;font-size:12px;font-weight:normal;padding:12px 16px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
.myfixed1 { position: absolute; 
	overflow: visible; 
	left: 0; 
	bottom: 0; 
	padding: 1.5em; 
	font-family:sans; 
	margin: 0;
}
</style>
</head>
<body>
 <div style="text-align: center;">
  <img width="100%" src="<?php echo assets_url('images/logo-po.png')?>"/>
</div>
 <hr/>
  <h3 style="margin-bottom: -10px;margin-top: -10px;text-align: center">Master Kontak</h3>
<hr/>
<table style="font-size:10px;" width="1000" border="1">
  <tbody>
    <tr>
      <td width="2%" align="center">No</td>
      <td width="3%">Kode</td>
      <td width="10%">Nama</td>
      <td width="7%">Tipe</td>
      <td width="7%">Jenis</td>
      <td width="7%">Up</td>
      <td width="7%">Email</td>
      <td width="7%">Fax</td>
      <td width="7%">telepon</td>
      <td width="7%">Alamat</td>
      <td width="7%">NPWP</td>
      <td width="7%">No.Rek</td>
      <td width="7%">Nama Bank</td>
      <td width="5%">Atas Nama</td>
      <td width="5%">Alamat Pajak</td>
      <td width="5%">ACC</td>
    </tr>
<?php 
  $i = 1;
  foreach ($data as $key=>$v) :
?>
    <tr>
    <td align="center"><?=$i++?></td>
    <td><?=$v['kode']?></td>
    <td><?=$v['title']?></td>
    <td><?=$v['tipe']?></td>
    <td><?=$v['jenis']?></td>
    <td><?=$v['up']?></td>
    <td><?=$v['email']?></td>
    <td><?=$v['fax']?></td>
    <td><?=$v['telepon']?></td>
    <td><?=$v['alamat']?></td>
    <td><?=$v['npwp']?></td>
    <td><?=$v['no_rek']?></td>
    <td><?=$v['bank']?></td>
    <td><?=$v['a_n']?></td>
    <td><?=$v['alamat_pajak']?></td>
    <td><?=$v['acc']?></td>
    </tr>
<?php endforeach;?>
  </tbody>
</table>
</body>
</html>