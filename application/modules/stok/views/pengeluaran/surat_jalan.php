<style>
table td{
        font-size:14px;
}
</style>
<table cellspacing="0" cellpadding="0" width="100%">
  <col width="64" span="10">
  <tr>
    <td width="104"></td>
    <td width="278"></td>
    <td width="75"></td>
    <td width="99"></td>
    <td width="99"></td>
    <td width="99"></td>
    <td width="101"></td>
    <td width="108"></td>
    <td width="84"></td>
    <td width="103"></td>
  </tr>
  <tr>
    <td align="left" valign="top"><img width="80" height="80" src="<?php echo base_url() ?>assets/images/your-logo-here.png">
      <table cellpadding="0" cellspacing="0">
        <tr>
          <td width="64"></td>
        </tr>
      </table></td>
    <td colspan="2"><strong>PT. Gramaselindo Utama</strong>
    <p>Material Supply &amp;    Implementation Teleclommunication</p></td>
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
    <td>&nbsp;</td>
    <td colspan="5">&nbsp;</td>
    <td>Jakarta,</td>
    <td colspan="2"></td>
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
    <td>Kepada :</td>
    <td colspan="2" rowspan="3" valign="top"></td>
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
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="2">Jl.    Utan Kayu Raya No. 61</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>Address:</td>
    <td colspan="2" rowspan="2" valign="top"><?php echo $pengeluaran['address'] ?></td>
  </tr>
  <tr>
    <td colspan="2">Jakarta    Timur 13120</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td>Phone	</td>
    <td> (021) 3671 4115</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>No Surat Jalan :</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td>Fax</td>
    <td>(021) 8591 4372</td>
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
    <td>Email    </td>
    <td>marketing@gramaselindo.com</td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>Website    </td>
    <td>www.gramaselindo.com</td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td colspan="7">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="7">Kami    kirimkan barang-barang tersebut dibawah ini dengan kendaraan   </td>
    <td></td>
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
<table style="border:1px solid black; width:100%;" cellspacing="0" cellpadding="0">
    <thead>
  <tr>
    <td style="border-bottom:1px solid black;border-right:1px solid black;" align="center">No</td>
    <td colspan="5" style="border-bottom:1px solid black;border-right:1px solid black;">URAIAN</td>
    <td style="border-bottom:1px solid black;border-right:1px solid black;" align="center">Jumlah</td>
    <td colspan="2" style="border-bottom:1px solid black;" align="center">No. P/O</td>
  </tr>
    </thead>
  <?php
  $no=1;
   foreach($pengeluaran_list as $ls){ ?>
  <tr>
    <td align="center" style="border-right:1px solid black;"><?php echo $no;?></td>
    <td colspan="5" width="320" style="border-right:1px solid black;"><?php echo GetValue('title','barang',array('id'=>'where/'.$ls['barang_id']))?></td>
    <td style="border-right:1px solid black;" align="center"><?php echo $ls['jumlah']?></td>
    <td colspan="2" style="border-right:1px solid black;" align="center"><?php echo $pengeluaran['ref'] ?></td>
  </tr>
  <?php $no++; } ?>
  </table><br>
<br>

  <table width="100%">
  <tr>
    <td colspan="3">Penerima,</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="2">Hormat Kami,</td>
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
    <td colspan="4">No Doc :    002/FR-LOG/4.2.4/GSM/2015</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="3">No Rev :    REV.00/V/2015</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
