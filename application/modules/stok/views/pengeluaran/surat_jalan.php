<style>
    .bio{
        font-size:12px;
    }
	.header{
		font-size:26px;
	}
</style>
<body>
<?php //print_r($pengeluaran) ?>
<title>Surat Jalan</title>
<table cellspacing="0" cellpadding="0" width="100%">
  <col width="64" span="10">
  <tr>
    <td width="105"></td>
    <td width="282"></td>
    <td width="76"></td>
    <td width="34"></td>
    <td width="89"></td>
    <td width="99"></td>
    <td width="193"></td>
    <td width="96"></td>
    <td width="85"></td>
    <td width="108"></td>
  </tr>
  <tr>
    <td align="left" valign="top"><img width="80" height="80" src="<?php echo base_url() ?>assets/images/your-logo-here.png">
      <table cellpadding="0" cellspacing="0">
        <tr>
          <td width="64"></td>
        </tr>
      </table></td>
    <td colspan="15" ><strong class="header">PT. Gramaselindo Utama</strong>
    <br>General Trading of Telecommunication, Multi Media & Electronic Goods</br>
	<hr width="91%" align="left"></hr>
	<strong>Surat Jalan</strong>
	</td>
  </tr>
  <tr>
    <td colspan="5"></td>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="13"><table width="100%" border="0" cellspacing="0" cellpadding="00" class="bio">
      <tbody>
        <tr>
          <td>Alamat</td>
          <td>:</td>
          <td>Jl. Utan Kayu Raya No. 1 Jakarta Timur 13120</td>
        </tr>
        <tr>
          <td>Phone</td>
          <td>:</td>
          <td>(021) 3671 4115</td>
        </tr>
        <tr>
          <td>Fax</td>
          <td>:</td>
          <td>(021) 8591 4372</td>
        </tr>
        <tr>
          <td>Email</td>
          <td>:</td>
          <td>marketing@gramaselindo.com</td>
        </tr>
        <tr>
          <td>Website</td>
          <td>:</td>
          <td>www.gramaselindo.com</td>
        </tr>
      </tbody>
    </table></td>
    <td colspan="5" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="00" class="bio">
      <tbody>
        <tr>
          <td colspan="3"></td>
          </tr>
        <tr>
          <td >Kepada</td>
          <td >:</td>
          <td >&nbsp;<?php echo $client ?></td>
        </tr>
        <tr>
          <td>Alamat</td>
          <td>:</td>
          <td>&nbsp;<?php echo $pengeluaran['alamat'] ?></td>
        </tr>
        <tr>
          <td>No SJ</td>
          <td>:</td>
          <td>&nbsp;<?php echo $nosurat ?></td>
        </tr>
	
      </tbody>
    </table></td>
  </tr>
  
  <tr>
    <td colspan="7">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="7" class="bio">Kami Kirimkan Barang Ini Dengan Kendaraan : </td>
    <td><?php echo $pengeluaran['driver'] ?></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="7" class="bio">No Plat Kendaraan :</td>
    <td><?php echo $pengeluaran['plat'] ?></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="7">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
<table width="100%" style="border:1px solid black;" cellspacing="0" cellpadding="0">
    <thead>
  <tr>
    <td style="border-bottom:1px solid black;border-right:1px solid black;" align="center">No</td>
    <td colspan="5" style="border-bottom:1px solid black;border-right:1px solid black;" align="center">Uraian</td>
    <td style="border-bottom:1px solid black;border-right:1px solid black;" align="center">Jumlah</td>
    <td colspan="2" style="border-bottom:1px solid black;" align="center">No. S/O</td>
  </tr>
  </thead>
  <?php
  $no=1;
   foreach($pengeluaran_list as $ls){ ?>
  <tr>
    <td align="center" style="border-right:1px solid black;"><?php echo $no;?></td>
    <td colspan="5" width="320" style="border-right:1px solid black;"><?php echo GetValue('title','barang',array('id'=>'where/'.$ls['barang_id']))?></td>
    <td style="border-right:1px solid black;" align="center"><?php echo $ls['jumlah']?></td>
    <td colspan="2" style="border-right:1px solid black;" align="center"><?php echo $ls['ref'] ?></td>
  </tr>
  <?php $no++; } ?>
</table><br>
<br>

  <table width="100%" >
  <tr align="center">
    <td  class="bio">Penerima (Received by)</td>
    <td></td>
	<td></td>
    <td class="bio">Pemeriksa (Checked by)</td>
	<td></td>
    <td></td>
	<td class="bio">Pengirim (Sent by)</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="4"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="3"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
</body>