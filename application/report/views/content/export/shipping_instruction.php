<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type"><title>shipping_instruction</title>

</head><body>
<table style="text-align: left; width: 100%;" border="1" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td colspan="2" rowspan="2" align="undefined" valign="undefined">SHIPPER<br>
        <?php echo $shipper['name']?><br>
        <?php echo $shipper['address']?>
        <br>
        <br></td>
      <td colspan="2" align="undefined" valign="undefined"><center>
        SI
        NO. : <?php echo $shipping['number'];?>
      </center></td>
    </tr>
    <tr>
      <td colspan="2" rowspan="3" align="undefined" valign="undefined"><center><img style="width: 262px; height: 218px;" alt="ecsi_logo" src="<?php echo base_url()?>assets/img/ecsi.png"></center></td>
    </tr>
    <tr>
      <td colspan="2" align="undefined" valign="undefined">CONSIGNEE<br>
      <?php echo $consignee['name']?><br>
        <?php echo $consignee['address']?>
        <br>
        <br></td>
    </tr>
    <tr>
      <td align="undefined" valign="undefined" colspan="2">NOTIFY
        PARTY<br>
        SAME AS CONSIGNEE<br>
        <br>
        <br>
        <br></td>
    </tr>
    <tr>
      <td width="32%" align="undefined" valign="undefined"><p>INTENDED VESSEL / VOYAGE</p>
      <p><?php echo GetValue('name','master_vessel',array('id'=>'where/'.$shipping['vsl']))?> </p></td>
      <td width="16%" align="undefined" valign="undefined"><p>ETD</p>
      <p><?php echo GetTanggalIndo($shipping['etd']);?></p></td>
      <td colspan="2" align="undefined" valign="undefined"><p>To : <?php echo GetValue('name','master_client',array('id'=>'where/'.$shipping['to']))?></p>
      <p>Attn : <?php echo $shipping['attention']?>  </p></td>
    </tr>
    <tr>
      <td rowspan="2" align="undefined" valign="undefined"><p>PLACE OF RECEIPT </p>
      <p>&nbsp;</p></td>
      <td rowspan="2" align="undefined" valign="undefined"><p>PORT OF LOADING</p>
      <p>TG. PRIOK, JAKARTA, INDONESIA  </p></td>
      <td colspan="2" align="undefined" valign="undefined"><p>BL : <?php echo $shipping['original_bl']?> Original &amp; <?php echo $shipping['copy_bl']?> Copies </p>      </td>
    </tr>
    <tr>
      <td colspan="2" align="undefined" valign="undefined"><p>Move Type : <?php echo $shipping['shipment_type']?> </p>      </td>
    </tr>
    <tr>
      <td align="undefined" valign="undefined"><p>PORT OF DISCHARGE</p>
      <p>TOKUYAMA </p></td>
      <td align="undefined" valign="undefined"><p>PLACE OF DELIVERY </p>      </td>
      <td width="29%" align="undefined" valign="undefined">FREIGHT PAYABLE AT </td>
      <td width="23%" align="undefined" valign="undefined"><p><input type="checkbox" checked="checked"> FREIGHT PREPAID</p>
      <p><input type="checkbox"> FREIGHT COLLECT  </p></td>
    </tr>
    <tr>
      <td align="undefined" valign="undefined"><p>Marks and Numbers</p>
      <p>&nbsp; </p></td>
      <td colspan="2" align="undefined" valign="undefined"><div align="center">Description of Packages and Goods </div></td>
      <td align="undefined" valign="undefined">G.W / Measurement </td>
    </tr>
    <tr>
      <td align="undefined" valign="undefined"><p><?php echo  $shipping['desc_goods']?></p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p></td>
      <td colspan="2" align="undefined" valign="undefined"><?php echo $shipping['param_container']?>
      <p>&nbsp;</p>
      <p>&nbsp;</p></td>
      <td align="undefined" valign="undefined"><p>Gross Weight</p>
      <p>&nbsp;&nbsp;&nbsp;<?php echo $shipping['param_gross']?> <?php echo GetValue('name','master_metric',array('id'=>'where/'.$shipping['param_gross_metric']))?> </p>
      <p>Net Weight</p>
      <p>&nbsp;&nbsp;&nbsp;<?php echo $shipping['net_weight']?> <?php echo GetValue('name','master_metric',array('id'=>'where/'.$shipping['param_gross_metric']))?> </p>
      <p>CBM</p>
      <p>&nbsp;&nbsp;&nbsp;0.0000</p></td>
    </tr>
    <tr>
      <td colspan="2" align="undefined" valign="undefined"><p>Special Instruction </p>
      <p>&nbsp;</p></td>
      <td colspan="2" align="undefined" valign="undefined"><div align="right">
		<?php echo strtoupper($shipping['issued_place'])?>,
		<?php echo GetTanggalIndo($shipping['issued_date']);?> </div></td>
    </tr>
  </tbody>
</table>
<br>
<span style="float:right; font-size:10pt;">Dicetak Oleh : <?php echo ucfirst(GetValue('name','admin_profile',array('useradmin'=>'where/'.$this->session->userdata('webmaster_id'))))?></span>
</body></html>