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
					<div id="up">
						<input type="text" placeholder="Up" name="up" id="" class="form-control" required="required">
					</div>
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
					Proyek
				</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="proyek" value="<?=$o->keperluan?>">
				</div>
			</div>

        	<div class="form-group">
				<label class="col-sm-4 control-label" for="inputPassword3">
					Dikirim Ke
				</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" value="<?=$o->gudang?>" readonly>
					<input type="hidden" class="form-control" name="gudang_id" value="<?=$o->gudang_id?>" readonly>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputPassword3">
					No. PO
				</label>
				<div class="col-sm-8">
					<input type="text" placeholder="No. PO" name="po" class="form-control" required="required" value="<?=$last_id.'/PO-I/GSM/'.monthRomawi(date('m')).'/'.date('Y')?>">
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
						Tempo Pembayaran
					</label>
					<div class="col-sm-2">
						<input type="text" placeholder="" name="lama_angsuran_1" id="lama_angsuran_1" class="form-control text-right" value="0">
					</div>
					<div class="col-sm-6">
						<select class="select2" name="lama_angsuran_2" id="lama_angsuran_2" style="width:100%">
						<option value="0">-- Pilih Tempo Pembayaran --</option>
						<option value="hari">Hari</option>
						<option value="bulan">Bulan</option>
						<option value="tahun">Tahun</option>
                      	</select>
					</div>
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
						<th width="5%"> No. </th>
						<th width="10%"> Kode Barang </th>
						<th width="25%"> Deskripsi </th>
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
						$totalpajak = $total = $saldo = $totaldiskon = 0;
						$i=1;foreach($order_list->result() as $ol): 
						$subtotal = $ol->jumlah*$ol->harga;
						$totalpajak = $totalpajak + ($subtotal * ($ol->pajak/100));
						$totaldiskon = $totaldiskon + ($subtotal * ($ol->disc/100));
						$total = $total + $subtotal;
					?>
					<tr>
						<td><?=$i++?></td>
						<td><?=$ol->kode_barang?></td>
						<input type="hidden" name="kode_barang[]" class="form-control text-right" value="<?=$ol->barang_id?>">
						<td><?=$ol->deskripsi?></td>
						<input type="hidden" name="deskripsi[]" class="form-control text-right" value="<?=$ol->deskripsi?>">
						<td class="text-right"><?=$ol->jumlah?></td>
						<input type="hidden" name="jumlah[]" class="form-control text-right" value="<?=$ol->jumlah?>" id="jumlah<?=$i?>">
						<td><?=$ol->satuan?></td>
						<input type="hidden" name="satuan[]" class="form-control text-right" value="<?=$ol->satuan_id?>">
						<td class="text-right"><input type="text" name="harga[]" class="form-control text-right harga" value="<?=number_format($ol->harga, 2)?>" id="harga<?=$i?>"></td>
						<input type="hidden" name="harga[]" class="form-control text-right harga" value="<?=$ol->harga?>" id="harga<?=$i?>">
						<td class="text-right">
						<input type="text" name="disc[]" class="form-control text-right disc" value="<?=$ol->disc?>" id="disc<?=$i?>">
						<input type="hidden" name="subdisc[]" class="form-control text-right subdisc" value="0" id="subdisc<?=$i?>">
						</td>
						<td class="text-right"><input type="text" name="subtotal" class="form-control text-right subtotal" value="<?=number_format($subtotal, 2)?>" id="subtotal<?=$i?>" readonly></td>
						<td class="text-right"><input type="text" name="pajak[]" class="form-control text-right pajak" value="<?=$ol->pajak?>" id="pajak<?=$i?>"></td>
						<td><input type="hidden" name="subpajak[]" class="form-control text-right subpajak" value="0" id="subpajak<?=$i?>"></td>
						</tr>
					<script>
					$("#harga<?=$i?>").maskMoney({allowZero:true});
						$("#disc<?=$i?>").add("#harga<?=$i?>").add("#dibayar").add("#biaya_pengiriman").add("#pajak<?=$i?>").keyup(function() {
						var a = parseFloat($("#jumlah<?=$i?>").val()),
				        	b = parseFloat($("#harga<?=$i?>").val().replace(/,/g,"")).toFixed(2),
				        	c = parseFloat($("#disc<?=$i?>").val()),
				        	p = parseFloat($("#pajak<?=$i?>").val()).toFixed(2),
				        	diBayar = parseFloat($('#dibayar').val().replace(/,/g,"")),
				        	biayaPengiriman = parseFloat($('#biaya_pengiriman').val().replace(/,/g,"")),
				        	d = (a*b)*(c/100),//jumlah diskon
				       		val = (a*b)-d,
				       		disc = (a*b)*(c/100),
				        	subPajak = val*(p/100),//jumlah pajak
				        	jmlPajak = 0,
				        	jmlDisc = 0,
				        	total = 0;
				        $("#subtotal<?=$i?>").val(addCommas(parseFloat(val).toFixed(2)));
				        $("#subdisc<?=$i?>").val(addCommas(parseFloat(disc).toFixed(2)));
				        $("#subpajak<?=$i?>").val(subPajak);
				        $('.subpajak').each(function (index, element) {
				            jmlPajak = jmlPajak + parseInt($(element).val());
				        });
				        $('.subdisc').each(function (index, element) {
				            jmlDisc = jmlDisc + parseFloat($(element).val().replace(/,/g,""));
				        });

				        $('.subtotal').each(function (index, element) {
				            total = total + parseFloat($(element).val().replace(/,/g,""));
				        });
				        total = total+biayaPengiriman;
				        totalpluspajak = total + jmlPajak;
				        diBayar = totalpluspajak * (diBayar/100);
				        
				        $('#totalPajak').val(addCommas(parseFloat(jmlPajak).toFixed(2)));
				        $('#total-diskon').val(addCommas(parseFloat(jmlDisc).toFixed(2)));
				        $('#total').val(addCommas(parseFloat(total).toFixed(2)));
				        $('#totalpluspajak').val(addCommas(parseFloat(totalpluspajak).toFixed(2)));
				        var saldo = totalpluspajak-diBayar;
				        $('#saldo').val(addCommas(parseFloat(saldo).toFixed(2)));
				    });
					</script>
					<?php 
					endforeach;
						$totalpluspajak = $total+$totalpajak;
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
							<input type="text" id="totalPajak" value="<?=$totalpajak?>" class="form-control text-right" readonly="readonly">
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
							Diskon
							</div>
							<div class="col-md-6 pull-right">
							<input type="text" name="total-diskon" id="total-diskon" class="form-control text-right" value="<?=$totaldiskon?>" readonly>
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-md-4">
							Total
							</div>
							<div class="col-md-6 pull-right">
							<input type="text" class="form-control text-right" id="total" value="<?=$total?>" readonly="readonly">
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-md-4">
							Total+Pajak
							</div>
							<div class="col-md-6 pull-right">
							<input type="text" class="form-control text-right" name="gtotal" id="totalpluspajak" value="<?=$totalpluspajak?>" readonly="readonly">
							</div>
						</div>
					</li>
					<div id="total_angsuran" style="display:none">
						<li class="list-group-item">
							<div class="row">
								<div class="col-md-4">
								Uang Muka
								</div>
								<div class="col-md-2">
								</div>
								<div class="col-md-4">
								<input type="text" name="dibayar" id="dibayar" class="form-control text-right" value="">
								</div>
								<div class="col-md-1">
								%
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
			<button type="submit" id="btnSubmit" class="btn btn-lg btn-primary hidden-print pull-right" style="margin-right:15px;">
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
        if(id != 0)getUp(id);
    })
    .change();

     $('input:radio[name=metode_pembayaran_id]').click(function() {
      var val = $('input:radio[name=metode_pembayaran_id]:checked').val();
      if(val==1){
        $('#kredit').hide("slow");
        $('#total_angsuran').hide("slow");
      }else{
        $('#kredit').show("slow");
        $('#total_angsuran').show("slow");
      }
    });

    $('#lama_angsuran_2').change(function(){
        var text = $(this).val();
        $('#angsuran').text('/'+text.toUpperCase());
    })
    .change();

    $('#dibayar, #biaya_pengiriman').maskMoney({allowZero:true});
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

function getUp(id)
{
    $.ajax({
        type: 'POST',
        url: '/gsm/purchase/order/get_up/'+id,
        data: {id : id},
        success: function(data) {
            $('#up').html(data);
        }
    });
}
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