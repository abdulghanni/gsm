<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Master Barang</title>
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
  <h3 style="margin-bottom: -10px;margin-top: -10px;text-align: center">Master Barang</h3>
<hr/>
<table style="font-size:10px;" width="100%" border="1">
  <tbody>
    <tr>
      <td width="5%" align="center">No</td>
      <td width="8%">Kode</td>
      <td width="50%">Deskripsi</td>
      <td width="20%">Alias</td>
      <td width="10%">Jenis Barang</td>
      <td width="8%" align="center">Satuan Dasar</td>
      <td width="8%" align="center">Satuan Laporan</td>
    </tr>
<?php 
  $i = 1;
  foreach ($data as $key=>$v) :
?>
    <tr>
    <td align="center"><?=$i++?></td>
    <td><?=$v['kode']?></td>
    <td><?=$v['title']?></td>
    <td><?=$v['alias']?></td>
    <td><?=$v['jenis_barang']?></td>
    <td><?=$v['satuan']?></td>
    <td><?=$v['satuan_laporan']?></td>
    </tr>
<?php endforeach;?>
  </tbody>
</table>
</body>
</html>