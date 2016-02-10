<?php foreach ($order->result() as $o) :?><div class="row">
	<div class="row">
		<div class="col-md-5">
			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputEmail3">
					Kepada
				</label>
				<div class="col-sm-8">
					<?php 
                    	$js = 'class="select2" style="width:100%" id="kontak_id"';
                    	echo form_dropdown('kontak_id', $options_kontak,'',$js); 
                  	?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputPassword3">
					Up.
				</label>
				<div class="col-sm-8">
					<input type="text" placeholder="Up" name="up" id="up" class="form-control" required="required">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputPassword3">
					Alamat
				</label>
				<div class="col-sm-8">
					<select id="alamat" class="select2" style="width:100%" name="alamat">
						<option value="">-- Pilih Alamat Supplier --</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputPassword3">
					Mata Uang
				</label>
				<div class="col-sm-8">
					<div class="clip-radio radio-primary">
						<?php foreach($kurensi as $k):?>
						<input type="radio" id="kurensi<?=$k->id?>" name="kurensi_id" value="<?=$k->id?>" <?= ($k->id == 1)?'checked':'';?>>
						<label for="kurensi<?=$k->id?>">
							<?=$k->title.'('.$k->simbol.')'?>
						</label>
						<?php endforeach;?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputPassword3">
					Catatan
				</label>
				<div class="col-sm-8">
					<textarea class="form-control" name="catatan"></textarea>
				</div>
			</div>
        </div>

        <div class="col-md-5">
        	<div class="form-group">
				<label class="col-sm-4 control-label" for="inputPassword3">
					Dikirim Ke
				</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" value="<?=$o->gudang?>" readonly>
				</div>
			</div>



			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputPassword3">
					No. PO
				</label>
				<div class="col-sm-8">
					<input type="text" placeholder="No. PO" name="po" class="form-control" required="required" value="<?=$last_id.'/PO-I/GSM/I/'.date('Y')?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputEmail3">
					Tgl. Pengiriman
				</label>
				<div class="col-sm-8">
					<div id="tanggal_transaksi" class="input-append date success no-padding">
                      <input type="text" class="form-control" name="tanggal_transaksi" required>
                      <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                    </div>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputPassword3">
					Term
				</label>
				<div class="col-sm-8">
					<div class="clip-radio radio-primary">
						<?php foreach($metode as $m):?>
						<input type="radio" id="metode<?=$m->id?>" name="metode_pembayaran_id" value="<?=$m->id?>" <?= ($m->title == 'Cash')?'checked':'';?>>
						<label for="metode<?=$m->id?>">
							<?=$m->title?>
						</label>
						<?php endforeach;?>
					</div>
				</div>
			</div>
			<div id="kredit" style="display:none">
				<div class="form-group">
					<label class="col-sm-4 control-label" for="inputPassword3">
						Lama Angsuran
					</label>
					<div class="col-sm-2">
						<input type="text" placeholder="" name="lama_angsuran_1" id="lama_angsuran_1" class="form-control text-right" value="0">
					</div>
					<div class="col-sm-6">
						<select class="select2" name="lama_angsuran_2" id="lama_angsuran_2" style="width:100%">
						<option value="0">-- Pilih Lama Angsuran --</option>
						<option value="hari">Hari</option>
						<option value="bulan">Bulan</option>
						<option value="tahun">Tahun</option>
                      	</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-4 control-label" for="inputPassword3">
						Bunga
					</label>
					<div class="col-sm-2">
						<input type="text" placeholder="" name="bunga" id="bunga" class="form-control text-right" value="0">
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
		<div class="table-responsive">
			<table id="table" class="table table-striped">
				<thead>
					<tr>
						<th width="5%"> # </th>
						<th width="5%"> No. </th>
						<th width="10%"> Kode Barang </th>
						<th width="20%"> Deskripsi </th>
						<th width="5%">Quantity</th>
						<th width="10%"> Satuan </th>
						<th width="20%"> Harga </th>
						<th width="5%">Disc(%)</th>
						<th width="15%"> Sub Total </th>
						<th width="5%">Pajak(%)</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$i=1;foreach($order_list->result() as $ol): ?>
					<tr>
						<td><?=$i++?></td>
						<td><?=$ol->kode_barang?></td>
						<input type="hidden" name="kode_barang[]" class="form-control text-right" value="<?=$ol->kode_barang?>">
						<td><?=$ol->deskripsi?></td>
						<input type="hidden" name="deskripsi[]" class="form-control text-right" value="<?=$ol->deskripsi?>">
						<td class="text-right"><?=$ol->jumlah?></td>
						<input type="hidden" name="diorder[]" class="form-control text-right" value="<?=$ol->jumlah?>">
						<td><?=$ol->satuan?></td>
						<input type="hidden" name="satuan[]" class="form-control text-right" value="<?=$ol->satuan_id?>">
						<td class="text-right"><?= number_format($ol->harga, 2)?></td>
						<input type="hidden" name="harga[]" class="form-control text-right harga" value="<?=$ol->harga?>" id="harga<?=$i?>">
						<td class="text-right">
						<input type="text" name="disc[]" class="form-control text-right disc" value=<?=$ol->disc?> id="disc<?=$i?>"></td>
						<td class="text-right"><input type="text" name="subtotal" class="form-control text-right subtotal" value="<?= number_format($subtotal, 2)?>" id="subtotal<?=$i?>" readonly></td>
						<td class="text-right"><input type="text" name="pajak[]" class="form-control text-right pajak" value="<?=$ol->pajak?>" id="pajak<?=$i?>"></td>
						<td><input type="hidden" name="subpajak[]" class="form-control text-right subpajak" value="0" id="subpajak<?=$i?>"></td>
						</tr>
					<?php endforeach;
					?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
	<div class="row">
		<input type="hidden" name="dp" value="0">
		<div id="subTotalPajak"></div>
		<div class="row">
			<div id="panel-total" class="panel-body col-md-5 pull-right">
				<ul class="list-group">
					<li class="list-group-item">
						<div class="row">
							<div class="col-md-4">
							Total Pajak
							</div>
							<div class="col-md-6 pull-right">
							<input type="text" id="totalPajak" value="0" class="form-control text-right" readonly="readonly">
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-md-4">
							Biaya Pengiriman
							</div>
							<div class="col-md-6 pull-right">
							<input type="text" name="biaya_pengiriman" id="biaya_pengiriman" class="form-control text-right" value="0">
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-md-4">
							Total
							</div>
							<div class="col-md-6 pull-right">
							<input type="text" class="form-control text-right" id="total" value="0" readonly="readonly">
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-md-4">
							Total+Pajak
							</div>
							<div class="col-md-6 pull-right">
							<input type="text" class="form-control text-right" id="totalpluspajak" value="0" readonly="readonly">
							</div>
						</div>
					</li>
					
					<div id="total_angsuran" style="display:none">
						<li class="list-group-item">
							<div class="row">
								<div class="col-md-4">
								Uang Muka
								</div>
								<div class="col-md-6 pull-right">
								<input type="text" name="dibayar" id="dibayar" class="form-control text-right" value="">
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
								<input type="text" name="biaya_angsuran" id="biaya_angsuran" class="form-control text-right" value="0">
								</div>
								<div class="col-md-2" id="angsuran" style="margin-left:-10px">
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">
								<div class="col-md-4">
								Total+Bunga Angsuran
								</div>
								<div class="col-md-6 pull-right">
								<input type="text" id="totalplusbunga" class="form-control text-right" value="0">
								</div>
							</div>
						</li>
						<li class="list-group-item">
						<div class="row">
							<div class="col-md-4">
							Saldo
							</div>
							<div class="col-md-6 pull-right">
							<input type="text" id="saldo" class="form-control text-right" value="0" readonly="readonly">
							</div>
						</div>
					</li>
					</div>
					
				</ul>
			</div>
		</div>
		<div class="row">
			<button type="submit" id="btnSubmit" class="btn btn-lg btn-primary hidden-print pull-right" style="display:none;margin-right:15px;">
				Submit Order <i class="fa fa-check"></i>
			</button>
		</div>
	</div>
<?php endforeach;?>
<script type="text/javascript" src="<?=assets_url('vendor/bootstrap-datepicker/bootstrap-datepicker.min.js')?>"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.input-append.date')
        .datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd-mm-yyyy"
        });
    $("#tanggal_transaksi").datepicker("setDate", new Date());
    $("#kontak_id").change(function(){
        var id = $(this).val();
        if(id != 0)getAlamat(id);
    })
    .change();
});

function getAlamat(id)
{
    $.ajax({
        type: 'POST',
        url: '/gsm/purchase/order/get_alamat/'+id,
        data: {id : id},
        success: function(data) {
            $('#alamat').html(data);
        }
    });
}

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