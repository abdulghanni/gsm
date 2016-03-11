<?php foreach ($order->result() as $o) :?>
<div class="row">
<div class="col-md-6">
	<div class="form-group">
		<label class="col-sm-4 control-label" for="inputPassword3">
			No. Faktur
		</label>
		<div class="col-sm-8">
			<input type="text" placeholder="No. Faktur" name="no" value="" class="form-control" required="required">
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4 control-label" for="inputEmail3">
			Tgl. Faktur
		</label>
		<div class="col-sm-8">
			<div id="tanggal_faktur" class="input-append date success no-padding">
              <input type="text" class="form-control" name="tanggal_faktur" required>
              <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
            </div>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4 control-label" for="inputEmail3">
			Customer
		</label>
		<div class="col-sm-8">
			<input type="text" name="up" value="<?=$o->kontak?>" class="form-control" readonly>
			<input type="hidden" name="kontak_id" value="<?=$o->kontak_id?>" class="form-control" readonly>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4 control-label" for="inputPassword3">
			Mata Uang
		</label>
		<div class="col-sm-8">
			<input type="text" name="up" value="<?=$o->kurensi?>" class="form-control" readonly>
			<input type="hidden" name="kurensi_id" value="<?=$o->kurensi_id?>" class="form-control" readonly>
		</div>
	</div>
	<?php if(!empty($o->catatan)):?>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="inputPassword3">
			Catatan
		</label>
		<div class="col-sm-8">
			<textarea class="form-control" name="catatan"><?=$o->catatan?></textarea>
		</div>
	</div>
	<?php endif;?>

</div>

<div class="col-md-6">
	<div class="form-group">
		<label class="col-sm-4 control-label" for="inputPassword3">
			No. SO
		</label>
		<div class="col-sm-8">
			<input type="text" placeholder="No. SO" name="so" class="form-control" value="<?=$o->so?>" required="required"  readonly>
		</div>
	</div>

	
	<div class="form-group">
		<label class="col-sm-4 control-label" for="inputEmail3">
			Tgl. Pengantaran
		</label>
		<div class="col-sm-8">
			<div id="tanggal_pengantaran" class="input-append date success no-padding">
              <input type="text" class="form-control" name="tanggal_pengantaran" required>
              <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
            </div>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-4 control-label" for="inputPassword3">
			Dikirim Dari
		</label>
		<div class="col-sm-8">
			<input type="text" name="up" value="<?=$o->gudang?>" class="form-control" readonly>
			<input type="hidden" name="gudang_id" value="<?=$o->gudang_id?>" class="form-control" readonly>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-4 control-label" for="inputPassword3">
			Term
		</label>
		<div class="col-sm-8">
			<input type="text" name="up" value="<?=$o->metode_pembayaran?>" class="form-control" readonly>
			<input type="hidden" name="metode_pembayaran_id" value="<?=$o->metode_pembayaran_id?>" class="form-control" readonly>
		</div>
	</div>
						<?php $d = "display:none";?>
						<div id="kredit" style="<?=($o->metode_pembayaran_id == 1) ? $d : ''?>">
							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputPassword3">
									Lama Angsuran
								</label>
								<div class="col-sm-2">
									<input type="text" placeholder="" name="lama_angsuran_1" id="lama_angsuran_1" class="form-control text-right" value="<?= $o->lama_angsuran_1?>">
								</div>
								<div class="col-sm-2">
									<input type="text" placeholder="" name="lama_angsuran_2" id="lama_angsuran_2" class="form-control" value="<?= $o->lama_angsuran_2?>">
					              	</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputPassword3">
									Bunga
								</label>
								<div class="col-sm-2">
									<input type="text" placeholder="" name="bunga" id="bunga" class="form-control text-right" value="<?=$o->bunga?>">
								</div>
								<label class="col-sm-1 control-label" for="inputPassword3">
									%
								</label>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<table id="table" class="table table-striped">
							<thead>
								<tr>
									<th width="5%"> No. </th>
									<th width="10%"> Kode </th>
									<th width="15%"> Nama Barang </th>
									<th width="10%">Di Terima</th>
									<th width="10%">Di Retur</th>
									<th width="10%"> Satuan </th>
									<th width="15%"> Harga </th>
									<th width="5%">Disc(%)</th>
									<th width="15%"> Sub Total </th>
									<th width="5%">Pajak(%)</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$totalpajak = $total = $biaya_angsuran = $totalplusbunga = $saldo = 0;
									$i=1;foreach($order_list->result() as $ol): ?>
								<tr>
								<?php 
									$diskon = $ol->diterima*$ol->harga*($ol->disc/100);
									$subtotal = $ol->diterima*$ol->harga-$diskon;
									$totalpajak = $totalpajak + ($subtotal * ($ol->pajak/100));
									$total = $total + $subtotal;
								?>
									<td><?=$i++?></td>
									<td><?=$ol->kode_barang?></td>
									<input type="hidden" name="kode_barang[]" class="form-control text-right" value="<?=$ol->kode_barang?>">
									<td><?=$ol->deskripsi?></td>
									<input type="hidden" name="deskripsi[]" class="form-control text-right" value="<?=$ol->deskripsi?>">
									<td class="text-right"><?=$ol->diterima?></td>
									<input type="hidden" name="dikirim[]" class="form-control text-right" value="<?=$ol->diterima?>">
									<td class="text-right"><input type="text" name="diretur[]" class="form-control text-right diretur" value=<?=$ol->diterima?> id="diretur<?=$i?>"></td>
									<td><?=$ol->satuan?></td>
									<input type="hidden" name="satuan[]" class="form-control text-right" value="<?=$ol->satuan_id?>">
									<td class="text-right"><?= number_format($ol->harga, 2)?></td>
									<input type="hidden" name="harga[]" class="form-control text-right harga" value="<?=$ol->harga?>" id="harga<?=$i?>">
									<td class="text-right"><?=$ol->disc?></td>
									<input type="hidden" name="disc[]" class="form-control text-right disc" value=<?=$ol->disc?> id="disc<?=$i?>">
									<td class="text-right"><input type="text" name="subtotal" class="form-control text-right subtotal" value="<?= number_format($subtotal, 2)?>" id="subtotal<?=$i?>" readonly></td>
									<td class="text-right"><?=$ol->pajak?></td>
									<input type="hidden" name="pajak[]" class="form-control text-right pajak" value="<?=$ol->pajak?>" id="pajak<?=$i?>">
									<td><input type="hidden" name="subpajak[]" class="form-control text-right subpajak" value="0" id="subpajak<?=$i?>"></td>
									</tr>
								<?php endforeach;$totalpluspajak = $total+$o->biaya_pengiriman+$totalpajak;
									$grandtotal = $totalpluspajak + $o->biaya_pengiriman - $o->dibayar;
									$bunga =  ($grandtotal) * ($o->bunga/100);
								?>
							</tbody>
						</table>
						
								
					</div>
				</div>
				<hr/>
				<div class="row">
					<!--
					<div class="col-md-2">
						<div class="approve text-center" style="align:center">
						  <p class="text-center approve-head">Order By, </p>
						  <span class="small"></span><br/>
	                      <span class="small"><?=dateIndo($o->created_on)?></span><br/>
	                      <span class="semi-bold">(<?= getFullName($o->created_by)?>)</span>
						</div>
					</div>

					<div class="col-md-2">
						<div class="approve text-center" style="align:center">
						  <p class="text-center approve-head">ACC Vendor, </p>
						  <span class="small"></span><br/>
	                      <span class="semi-bold"></span><br/>
	                      <span class="semi-bold">Sign & Return By Fax</span>
						</div>
					</div>
					-->

					<div id="panel-total" class="panel-body col-md-5 pull-right">
						<ul class="list-group">
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-4">
									Total Pajak
									</div>
									<div class="col-md-6 pull-right">
									<input type="text" id="totalPajak" value="<?= number_format($totalpajak, 2)?>" class="form-control text-right"  readonly=" readonly">
									</div>
								</div>
							</li>
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-4">
									Biaya Pengiriman
									</div>
									<div class="col-md-6 pull-right">
									<input type="text" name="biaya_pengiriman" id="biaya_pengiriman" class="form-control text-right" value="<?= number_format($o->biaya_pengiriman, 2)?>"  readonly=" readonly">
									</div>
								</div>
							</li>
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-4">
									Total
									</div>
									<div class="col-md-6 pull-right">
									<input type="text" class="form-control text-right" id="total" value="<?=number_format($total+$o->biaya_pengiriman, 2)?>"  readonly=" readonly">
									</div>
								</div>
							</li>
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-4">
									Total + Pajak
									</div>
									<div class="col-md-6 pull-right">
									<input type="text" class="form-control text-right" id="totalpluspajak" value="<?=number_format($total+$o->biaya_pengiriman+$totalpajak, 2)?>"  readonly=" readonly">
									</div>
								</div>
							</li>
							<?php if($o->metode_pembayaran_id == 2):?>
								<li class="list-group-item">
									<div class="row">
										<div class="col-md-4">
										Uang Muka
										</div>
										<div class="col-md-6 pull-right">
										<input type="text" name="dibayar" id="dibayar" class="form-control text-right" value="<?=number_format($o->dibayar,2)?>"  readonly=" readonly">
										</div>
									</div>
								</li>
								<li class="list-group-item">
									<div class="row">
										<div class="col-md-4">
										Total+Bunga Angsuran
										</div>
										<div class="col-md-6 pull-right">
										<input type="text"  id="totalplusbunga" class="form-control text-right" value="<?= number_format($grandtotal+$bunga,2)?>"  readonly>
										</div>
									</div>
								</li>
								<li class="list-group-item">
									<div class="row">
										<div class="col-md-4">
										Biaya Angsuran
										</div>
										<div class="col-md-2">
										</div>
										<div class="col-md-4">
										<input type="text" name="biaya_angsuran" id="biaya_angsuran" class="form-control text-right" value="<?php echo number_format(($grandtotal+$bunga)/$o->lama_angsuran_1, 2)?>"  readonly>
										</div>
										<div class="col-md-2" id="angsuran" style="margin-left:-10px">/<?= strtoupper($o->lama_angsuran_2)?>
										</div>
									</div>
								</li>
								<li class="list-group-item">
								<div class="row">
									<div class="col-md-4">
									Saldo
									</div>
									<div class="col-md-6 pull-right">
									<input type="text" id="saldo" class="form-control text-right" value="<?=number_format($grandtotal, 2)?>"  readonly=" readonly">
									</div>
								</div>
							</li>
						<?php endif?>
							
						</ul>
					</div>
				</div>
				<div class="row">
					<button type="submit" id="btnSubmit" class="btn btn-lg btn-primary hidden-print pull-right" style="margin-right:15px;">
						Submit Order <i class="fa fa-check"></i>
					</button>
				</div>
<?php endforeach;?>
<script type="text/javascript" src="<?=assets_url('vendor/jquery/jquery.min.js')?>"></script>
<script type="text/javascript" src="<?=assets_url('vendor/bootstrap-datepicker/bootstrap-datepicker.min.js')?>"></script>
<script type="text/javascript">
	$('.input-append.date')
        .datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd-mm-yyyy"
        });
    $("#tanggal_faktur").datepicker("setDate", new Date());
    $("#tanggal_pengiriman").datepicker("setDate", new Date());
	<?php $i=1;foreach ($order_list->result() as $o):$i++;?>
	$(".diterima").keyup(function() {
		var a = parseInt($("#diterima<?=$i?>").val());
			bunga = parseFloat($('#bunga').val()),
        	b = parseFloat($("#harga<?=$i?>").val().replace(/,/g,"")).toFixed(2),
        	c = parseFloat($("#disc<?=$i?>").val()),
        	p = parseFloat($("#pajak<?=$i?>").val()).toFixed(2),
        	diBayar = parseFloat($('#dibayar').val().replace(/,/g,"")),
        	biayaPengiriman = parseFloat($('#biaya_pengiriman').val().replace(/,/g,"")),
        	lama_angsuran= parseInt($('#lama_angsuran_1').val()),
        	d = (a*b)*(c/100),//jumlah diskon
       		val = (a*b)-d,
       		subPajak = val*(p/100),
       		jmlPajak = 0,
       		total = 0;

        $("#subtotal<?=$i?>").val(addCommas(parseFloat(val).toFixed(2)));
        $("#subpajak<?=$i?>").val(subPajak);
        $('.subpajak').each(function (index, element) {
            jmlPajak = jmlPajak + parseInt($(element).val());
        });
        $('.subtotal').each(function (index, element) {
            total = total + parseInt($(element).val().replace(/,/g,""));
        });
        total = total+biayaPengiriman;
        totalpluspajak = total + jmlPajak;
        totalPlusBunga = (totalpluspajak-diBayar)*(bunga/100);
        totalPlusBunga = (totalpluspajak-diBayar)+totalPlusBunga;
        biayaAngsuran = totalPlusBunga/lama_angsuran;

        $('#totalPajak').val(addCommas(parseFloat(jmlPajak).toFixed(2)));
        $('#total').val(addCommas(parseFloat(total).toFixed(2)));
        $('#totalpluspajak').val(addCommas(parseFloat(totalpluspajak).toFixed(2)));
        var saldo = totalpluspajak-diBayar;
        $('#saldo').val(addCommas(parseFloat(saldo).toFixed(2)));
       	$('#totalplusbunga').val(addCommas(parseFloat(totalPlusBunga).toFixed(2)));
       	$('#biaya_angsuran').val(addCommas(parseFloat(biayaAngsuran).toFixed(2)))
    });
    <?php endforeach;?>

    function addCommas(nStr)
    {
      nStr += '';
      x = nStr.split('.');
      x1 = x[0];
      x2 = x.length > 1 ? '.' + x[1] : '';
      var rgx = /(\d+)(\d{3})/;
      while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
      }
      return x1 + x2;
    }
</script>