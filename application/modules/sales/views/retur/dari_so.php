<?php foreach ($order->result() as $o) :?><div class="row">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								No. Retur
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="No. Retur" name="no" class="form-control" value="<?=$last_id.'/RET-I/GSM/'.monthRomawi(date('m')).'/'.date('Y')?>" required="required">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Tgl. Retur
							</label>
							<div class="col-sm-8">
								<div id="tanggal_faktur" class="input-append date success no-padding">
                                  <input type="text" class="form-control" name="tanggal_transaksi" required>
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
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Catatan
							</label>
							<div class="col-sm-8">
								<textarea class="form-control" name="catatan"><?=$o->catatan?></textarea>
							</div>
						</div>
                    </div>
                    <div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								No. SO
							</label>
							<div class="col-sm-8">
								<input type="text" name="so" value="<?=$o->so?>" class="form-control" readonly>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Tanggal Pengiriman SO
							</label>
							<div class="col-sm-8">
								<div id="tanggal_pengiriman" class="input-append date success no-padding">
                                  <input type="text" class="form-control" name="tanggal_pengiriman" required>
                                  <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                                </div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Dikirim Ke
							</label>
							<div class="col-sm-8">
								<input type="text" name="up" value="<?=$o->gudang?>" class="form-control" readonly>
								<input type="hidden" name="gudang_id" value="<?=$o->gudang_id?>" class="form-control" readonly>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Komponen Pajak
							</label>
							<div class="col-sm-6">
								<div id="pajak">
								<?php foreach($pajak_komponen as $p):?>
								<div class="checkbox clip-check check-primary checkbox-inline">
									<input type="checkbox" id="kpajak<?=$p->id?>" onchange="hitung()" value="<?=$p->id?>" class="<?=$p->title?>" name="pajak_komponen_id[]">
									<label for="kpajak<?=$p->id?>">
										<?=$p->title?>
									</label>
								</div>
								<?php endforeach;?>
								</div>
							</div>
						</div>
						<?php $d = "display:none";?>
						<div id="kredit" style="<?=($o->metode_pembayaran_id == 1) ? $d : $d?>">
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Term
							</label>
							<div class="col-sm-8">
								<input type="text" name="up" value="<?=$o->metode_pembayaran?>" class="form-control" readonly>
								<input type="hidden" name="metode_pembayaran_id" value="<?=$o->metode_pembayaran_id?>" class="form-control" readonly>
							</div>
						</div>
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
				<div class="row">
		<div class="col-sm-12">
		<div class="table-responsive">
			<table id="table" class="table table-striped">
				<thead>
					<tr>
						<th width="5%"> No. </th>
						<th width="10%"> Kode Barang </th>
						<th width="25%"> Deskripsi </th>
						<th width="5%">Diorder</th>
						<th width="5%">Diretur</th>
						<th width="10%"> Satuan </th>
						<th width="20%"> Harga </th>
						<th width="5%">Disc(%)</th>
						<th width="15%"> Sub Total </th>
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
						<input type="hidden" name="diterima[]" class="form-control text-right" value="<?=$ol->jumlah?>" id="">
						<td class="text-right"><input type="text" name="diretur[]" class="form-control text-right" value="<?=$ol->jumlah?>" id="jumlah<?=$i?>"></td>
						
						<td><?=$ol->satuan?></td>
						<input type="hidden" name="satuan[]" class="form-control text-right" value="<?=$ol->satuan_id?>">
						<td class="text-right"><input type="text" name="harga[]" class="form-control text-right harga" value="<?=number_format($ol->harga, 2)?>" id="harga<?=$i?>"></td>
						<input type="hidden" name="harga[]" class="form-control text-right harga" value="<?=$ol->harga?>" id="harga<?=$i?>">
						<td class="text-right">
						<input type="text" name="disc[]" class="form-control text-right disc" value="<?=$ol->disc?>" id="disc<?=$i?>">
						<input type="hidden" name="subdisc[]" class="form-control text-right subdisc" value="0" id="subdisc<?=$i?>">
						</td>
						<td class="text-right"><input type="text" name="subtotal" class="form-control text-right subtotal" value="<?=number_format($subtotal, 2)?>" id="subtotal<?=$i?>" readonly></td>
					<script>
					$("#harga<?=$i?>").maskMoney({allowZero:true});
					$("#biaya_pengiriman").maskMoney({allowZero:true});
					$("#dibayar").maskMoney({allowZero:true}).attr('maxlength', 6);
					$("#dibayar-nominal").maskMoney({allowZero:true});
						$("#disc<?=$i?>").add("#jumlah<?=$i?>").add("#harga<?=$i?>").add("#dibayar").add("#dibayar-nominal").add("#biaya_pengiriman").keyup(function() {
						var a = parseFloat($("#jumlah<?=$i?>").val()),
				        	b = parseFloat($("#harga<?=$i?>").val().replace(/,/g,"")).toFixed(2),
				        	c = parseFloat($("#disc<?=$i?>").val()),
				        	biayaPengiriman = parseFloat($('#biaya_pengiriman').val().replace(/,/g,"")),
				        	d = (a*b)*(c/100),//jumlah diskon
				       		val = (a*b)-d,
				       		disc = (a*b)*(c/100),
				        	jmlDisc = 0,
				        	total = 0;
				        $("#subtotal<?=$i?>").val(addCommas(parseFloat(val).toFixed(2)));
				        $("#subdisc<?=$i?>").val(addCommas(parseFloat(disc).toFixed(2)));
				        $('.subdisc').each(function (index, element) {
				            jmlDisc = jmlDisc + parseFloat($(element).val().replace(/,/g,""));
				        });

				        $('.subtotal').each(function (index, element) {
				            total = total + parseFloat($(element).val().replace(/,/g,""));
				        });

				        if($('#kpajak1').is(':checked')){
							parseFloat($('#totalPajak').val(total*(10/100)));
						}else{
							$('#totalPajak').val(parseFloat(0));
						}
						if($('#kpajak2').is(':checked')){
							$('#totalp2').val(parseFloat(total*(2/100)));
						}else{
							$('#totalp2').val(parseFloat(0));
						}
						if($('#kpajak3').is(':checked')){
							$('#totalp3').val(parseFloat(total*(2/100)));
						}else{
							$('#totalp3').val(parseFloat(0));
						}

						p1 = parseFloat($("#totalPajak").val()),
						p2 = parseFloat($("#totalp2").val()),
				        p3 = parseFloat($("#totalp3").val()),

				        total = total+biayaPengiriman;
				        totalpluspajak = total+p1;
				        
				        $('#total-diskon').val(addCommas(parseFloat(jmlDisc).toFixed(2)));
				        $('#total').val(addCommas(parseFloat(total).toFixed(2)));
				        
				        //$('#totalPajak').val(addCommas(parseFloat(jmlPajak).toFixed(2)));
				        $('#total-diskon').val(addCommas(parseFloat(jmlDisc).toFixed(2)));
				        $('#total').val(addCommas(parseFloat(total).toFixed(2)));
				        
				        $('#totalpluspajak').val(addCommas(parseFloat(total+p1+p2+p3).toFixed(2)));
				        var saldo = totalpluspajak;
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
					<li class="list-group-item" id="totalPPN">
						<div class="row">
							<div class="col-md-4">
							PPN 10%
							</div>
							<div class="col-md-6 pull-right">
							<input type="text" id="totalPajak" name="total-ppn" value="0" class="form-control text-right" readonly="readonly">
							</div>
						</div>
					</li>
					<li class="list-group-item" id="totalPPH22">
						<div class="row">
							<div class="col-md-4">
							PPH 22%
							</div>
							<div class="col-md-6 pull-right">
							<input type="text" id="totalp2" name="total-pph22" value="0" class="form-control text-right" readonly="readonly">
							</div>
						</div>
					</li>
					<li class="list-group-item" id="totalPPH23">
						<div class="row">
							<div class="col-md-4">
							PPH 23%
							</div>
							<div class="col-md-6 pull-right">
							<input type="text" id="totalp3" name="total-pph23" value="0" class="form-control text-right" readonly="readonly">
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
					<?php if($o->metode_pembayaran_id == 3):?>
					<div id="total_angsuran">
						<li class="list-group-item">
							<div class="row">
								<div class="col-md-4">
								Uang Muka
								</div>
								<div class="col-md-2">
								</div>
								<div class="col-md-4">
								<input type="text" name="dibayar" id="dibayar" class="form-control text-right" value="0">
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
					<?php endif;?>
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
<!--
	<?php $i=1;foreach ($order_list->result() as $o):$i++;?>
	$(".diterima").keyup(function() {
		var a = parseInt($("#diterima<?=$i?>").val());
        	b = parseFloat($("#harga<?=$i?>").val().replace(/,/g,"")).toFixed(2),
        	c = parseFloat($("#disc<?=$i?>").val()),
        	p = parseFloat($("#pajak<?=$i?>").val()).toFixed(2),
        	diBayar = parseFloat($('#dibayar').val().replace(/,/g,"")),
        	biayaPengiriman = parseFloat($('#biaya_pengiriman').val().replace(/,/g,"")),
        	d = (a*b)*(c/100),//jumlah diskon
       		val = (a*b)-d,
       		subPajak = val*(p/100),
       		jmlPajak = 0,
       		total = 0;

        $("#subtotal<?=$i?>").val(addCommas(parseFloat(val).toFixed(2)));
        $("#subpajak<?=$i?>").val(subPajak);
        $("#subdisc<?=$i?>").val(addCommas(parseFloat(disc).toFixed(2)));
        $('.subpajak').each(function (index, element) {
            jmlPajak = jmlPajak + parseInt($(element).val());
        });
        $('.subtotal').each(function (index, element) {
            total = total + parseInt($(element).val().replace(/,/g,""));
        });
        $('.subdisc').each(function (index, element) {
		    jmlDisc = jmlDisc + parseFloat($(element).val().replace(/,/g,""));
		});
        total = total+biayaPengiriman;
        totalpluspajak = total + jmlPajak;

        $('#totalPajak').val(addCommas(parseFloat(jmlPajak).toFixed(2)));
        $('#total').val(addCommas(parseFloat(total).toFixed(2)));
        $('#totalpluspajak').val(addCommas(parseFloat(totalpluspajak).toFixed(2)));
        var saldo = totalpluspajak-diBayar;
        $('#total-diskon').val(addCommas(parseFloat(jmlDisc).toFixed(2)));
        $('#saldo').val(addCommas(parseFloat(saldo).toFixed(2)));
    });
    <?php endforeach;?>
--><script type="text/javascript" src="<?=assets_url('vendor/jquery/jquery.min.js')?>"></script>
<script type="text/javascript" src="<?=assets_url('vendor/bootstrap-datepicker/bootstrap-datepicker.min.js')?>"></script>
<script type="text/javascript" src="<?=assets_url('vendor/jquery-mask-money/jquery.MaskMoney.js')?>"></script>
<script type="text/javascript">
function hitung()
{
    	biayaPengiriman = parseFloat($('#biaya_pengiriman').val().replace(/,/g,"")),
    	jmlDisc = 0,
    	total = 0;
    $('.subdisc').each(function (index, element) {
        jmlDisc = jmlDisc + parseFloat($(element).val().replace(/,/g,""));
    });

    $('.subtotal').each(function (index, element) {
        total = total + parseFloat($(element).val().replace(/,/g,""));
    });

    if($('#kpajak1').is(':checked')){
		parseFloat($('#totalPajak').val(total*(10/100)));
	}else{
		$('#totalPajak').val(parseFloat(0));
	}
	if($('#kpajak2').is(':checked')){
		$('#totalp2').val(parseFloat(total*(2/100)));
	}else{
		$('#totalp2').val(parseFloat(0));
	}
	if($('#kpajak3').is(':checked')){
		$('#totalp3').val(parseFloat(total*(2/100)));
	}else{
		$('#totalp3').val(parseFloat(0));
	}

	p1 = parseFloat($("#totalPajak").val()),
	p2 = parseFloat($("#totalp2").val()),
    p3 = parseFloat($("#totalp3").val()),

    total = total+biayaPengiriman;
    totalpluspajak = total+p1+p2+p3;
    
    $('#total-diskon').val(addCommas(parseFloat(jmlDisc).toFixed(2)));
    $('#total').val(addCommas(parseFloat(total).toFixed(2)));
    
    //$('#totalPajak').val(addCommas(parseFloat(jmlPajak).toFixed(2)));
    $('#total-diskon').val(addCommas(parseFloat(jmlDisc).toFixed(2)));
    $('#total').val(addCommas(parseFloat(total).toFixed(2)));
    
    $('#totalpluspajak').val(addCommas(parseFloat(total+p1+p2+p3).toFixed(2)));
    var saldo = totalpluspajak;
    $('#saldo').val(addCommas(parseFloat(saldo).toFixed(2)));	
}
$(document).ready(function() {
	$("input:checkbox:not(:checked)").each(function() {
	    var total = "#total"+$(this).attr("class");
	    $(total).hide();
	});

	$("input:checkbox").click(function(){
	    var total = "#total"+$(this).attr("class");
	    $(total).toggle();
	});

	$(".cek:not(:checked)").each(function() {
	    $("#remove").hide();
	});

	$(".cek:checkbox").click(function(){
	     $("#remove").show();
	});

	 $("#remove").on("click", function () {
        $('table tr').has('input[name="row"]:checked').remove();
        hitung();
    })
});
	$('.input-append.date')
        .datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd-mm-yyyy"
        });
    $("#tanggal_faktur").datepicker("setDate", new Date());
    $("#tanggal_pengiriman").datepicker("setDate", new Date());
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