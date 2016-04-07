<!doctype html>
<?php
$tgl=strtotime($penerimaan['tgl']);
$day=date("N",$tgl);
?>
<html>
<head>
<meta charset="utf-8">
<style type="text/css">
table{font-size:10px; width:100%;border:0; cellspacing:0; cellpadding:0;}
td{ height:30px;}
.list td{ height:40px;font-family:Arial, sans-serif;font-size:8px;padding:12px 16px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
.list th{height:40px; font-family:Arial, sans-serif;font-size:8px;font-weight:normal;padding:12px 16px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
</style>
</head>

		<body>
			<table>
				<tbody>
					<tr>
						<td colspan="3"><p> <center><strong><img src="<?php echo base_url()?>assets/images/your-logo-here.png" width="50px"></strong></center></p></td>
					</tr>
					<tr>
						<td colspan="3"><center><strong><u>BERITA ACARA SERAH TERIMA BARANG</u></strong></center></td>
					</tr>
					<tr>
				<td colspan="3"><p>Pada hari ini <strong> <?php echo dayindo($day)?></strong> tanggal<strong> <?php echo  substr($penerimaan['tgl'],8,2)?> </strong> bulan <strong><?php echo GetMonthFull(substr($penerimaan['tgl'],5,2))?></strong> tahun <strong><?php echo substr($penerimaan['tgl'],0,4)?></strong>, yang bertanda  tangan di bawah ini,telah melakukan serah terima barang berdasarkan:</p></td>
					</tr>
					
					<tr>
						<td>No PO              : <?php echo $penerimaan['ref'] ?><u></u></td>
						<td>&nbsp;</td>
						<td><p>No Surat Jalan    : <u>                        </u></p></td>
					</tr>
					<tr>
                                            <td height="30"><p>Project              : <?php echo GetValue('proyek', $penerimaan['ref_type'],array('no'=>'where/'.$penerimaan['ref'])) ?></p></td>
						<td>&nbsp;</td>
						<td>Tipe Kendaraan  : <u>                          </u>      </td>
					</tr>
					<tr>
						<td>Total Box         : <u>                            </u></td>
						<td>Total Volume: <u>    </u><u>                    </u></td>
						<td>Total Roll: <u>    </u><u>                    </u></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3"><p>Dan perincian  barang yang diterima dalam kondisi sebagai berikut:</p></td>
					</tr>
					<tr>
						<td><p><strong>Original packing dalam kondisi                       </strong><strong>           
							
						</strong><strong>           </strong></p></td>
						<td colspan="2"><strong>
							<input type="checkbox" name="checkbox2" id="checkbox2">
							</strong><strong>baik</strong>
							<input type="checkbox" name="checkbox" id="checkbox">
						<strong>rusak   </strong></td>
					</tr>
					<tr>
						<td><strong>Barang dalam kondisi </strong></td>
						<td colspan="2"><strong>
							<input type="checkbox" name="checkbox3" id="checkbox3">
							</strong><strong>baik</strong>
							<input type="checkbox" name="checkbox3" id="checkbox4">
						<strong>rusak   </strong></td>
					</tr>
					<tr>
						<td><strong>Jumlah material sesuai  dengan Surat Jalan </strong></td>
						<td colspan="2"><strong>
							<input type="checkbox" name="checkbox4" id="checkbox5">
							</strong><strong>baik</strong>
							<input type="checkbox" name="checkbox4" id="checkbox6">
						<strong>rusak   </strong></td>
					</tr>
					
					<tr>
						<td colspan="3"><p><strong>Keterangan: - </strong></p></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3"><p>Demikianlah Berita Acara Serah  Terima Barang ini dibuat dengan sebenarnya untuk digunakan sebagaimana mestinya</p></td>
					</tr>
					
					<tr>
						<td><p>Yang menyerahkan                           </p></td>
						<td>QC      </td>
						<td>  Inbound</td>
					</tr>
					<tr>
						<td><p>&nbsp;</p>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
						<p>&nbsp;</p></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>Nama:   </td>
						<td>Nama: </td>
						<td>Nama:</td>
					</tr>
					<tr>
						<td>Tanggal:</td>
						<td>Tanggal:</td>
						<td>Tanggal: </td>
					</tr>
					<tr>
						<td>Lembar 1 : Inbound</td>
						<td>Lembar 2 : Supplier </td>
						<td>Lembar 3 : Purchasing</td>
					</tr>
				</tbody>
			</table>
</body>
</html>
