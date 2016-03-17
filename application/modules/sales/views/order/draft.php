<!-- start: PAGE TITLE -->
<section id="page-title">
	<div class="row">
		<div class="col-sm-8">
			<h1 class="mainTitle">Sales Order</h1>
			<span class="mainDescription"></span>
		</div>
		<ol class="breadcrumb">
			<li>
				<span>Pages</span>
			</li>
			<li>
				<span><a href="<?=base_url('sales/order')?>">order</a></span>
			</li>
			<li  class="active">
				<span><a href="<?=base_url('sales/order/detail/'.$id)?>">detail</a></span>
			</li>
		</ol>
	</div>
</section>
<!-- end: PAGE TITLE -->
<!-- start: INVOICE -->
<div class="container-fluid container-fullw bg-white">

	<div class="row pull-right">
		<a href="<?=base_url().'sales/order/print_pdf/'.$id;?>" target='_blank' class="btn btn-lg btn-primary hidden-print">
			 <i class="fa fa-print"></i> <?= lang('print')?>
		</a>
	</div>
	<?php foreach ($order->result() as $o) :?>
	<form role="form" action="<?= base_url('sales/order/add')?>" method="post" class="form-horizontal" id="form-so">
	<input type="hidden" name="no" value="<?=$o->no?>">
		<div class="row">
			<div class="col-md-12">
				<div class="invoice">
					<div class="row invoice-logo">
						<div class="col-sm-6">
							<img alt="" src="<?= assets_url('images/your-logo-here.png')?>">
						</div>
						<div class="col-sm-6">
							<p class="text-dark">
								#<?=$o->so?><small class="text-light"></small>
							</p>
						</div>
					</div>
					<hr/>
					<?php if($o->created_by == sessId()): ?>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputEmail3">
									Kepada
								</label>
								<div class="col-sm-8">
									<select id="kontak_id" class="select2" name="kontak_id" style="width:100%">
									<option value="0">-- Pilih Supplier --</option>
									<?php 
	                                	foreach($kontak->result() as $u):
	                                	$selected = ($o->kontak_id == $u->id) ? 'selected="selected"' : '';
	                                ?>
	                                	<option value="<?=$u->id?>" <?=$selected?>><?=$u->title?></option>
	                              	<?php endforeach;?>
	                              	</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputPassword3">
									Up.
								</label>
								<div class="col-sm-8">
									<div id="up">
										<input type="text" placeholder="Up" name="up" id="" class="form-control" value="<?=$o->up?>">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputPassword3">
									Alamat
								</label>
								<div class="col-sm-8">
									<select id="alamat" class="select2" style="width:100%" name="alamat">
										<option value="<?=$o->alamat?>"><?=$o->alamat?></option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputPassword3">
									Mata Uang
								</label>
								<div class="col-sm-8">
									<input type="text" name="" value="<?=$o->kurensi?>" class="form-control" disabled="disabled">
									<input type="hidden" name="kurensi_id" value="<?=$o->kurensi_id?>" class="form-control">
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
									Proyek
								</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="project" value="<?=$o->project?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputPassword3">
									No. so
								</label>
								<div class="col-sm-8">
									<input type="text" name="so" value="<?=$o->so?>" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputEmail3">
									Tgl. Digunakan
								</label>
								<div class="col-sm-8">
									<div id="tanggal_transaksi" class="input-append date success no-padding">
	                                  <input type="text" class="form-control" name="tanggal_transaksi" value="<?=date('d-m-Y', strtotime($o->tanggal_transaksi))?>" required>
	                                  <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
	                                </div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputPassword3">
									Dikirim Dari
								</label>
								<div class="col-sm-8">
									<select class="select2" name="gudang_id" style="width:100%">
									<option value="0">-- Pilih Gudang Pengiriman --</option>
									<?php 
	                                	foreach($gudang as $g):
	                                		$selected = ($o->gudang_id == $g->id) ? 'selected="selected' : '';
	                                ?>
	                                	<option value="<?=$g->id?>" <?=$selected?>><?=$g->title?></option>
	                              	<?php endforeach;?>
	                              	</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputPassword3">
									Term
								</label>
								<div class="col-sm-8">
									<div class="clip-radio radio-primary">
										<?php foreach($metode as $m):?>
										<input type="radio" id="metode<?=$m->id?>" name="metode_pembayaran_id" value="<?=$m->id?>" <?= ($m->id == $o->metode_pembayaran_id)?'checked':'';?>>
										<label for="metode<?=$m->id?>">
											<?=$m->title?>
										</label>
										<?php endforeach;?>
									</div>
								</div>
							</div>
							<div id="kredit" <?= ($o->metode_pembayaran_id != 2)? 'style="display:none"':'';?>>
								<div class="form-group">
									<label class="col-sm-4 control-label" for="inputPassword3">
										Tempo Pembayaran
									</label>
									<div class="col-sm-2">
										<input type="text" placeholder="" name="lama_angsuran_1" id="lama_angsuran_1" class="form-control text-right" value="<?=$o->lama_angsuran_1?>">
									</div>
									<div class="col-sm-6">
										<select class="select2" name="lama_angsuran_2" id="lama_angsuran_2" style="width:100%">
										<option value="0">-- Pilih Tempo Pembayaran --</option>
										<option value="hari" <?=($o->lama_angsuran_2 == 'hari') ? 'selected="selected"' :'';?>>Hari</option>
										<option value="bulan" <?=($o->lama_angsuran_2 == 'bulan') ? 'selected="selected"' :'';?>>Bulan</option>
										<option value="tahun" <?=($o->lama_angsuran_2 == 'tahun') ? 'selected="selected"' :'';?>>Tahun</option>
				                      	</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputPassword3">
									Komponen Pajak
								</label>
								<div class="col-sm-6">
									<div id="pajak">
									<?php foreach($pajak_komponen as $p):
										  $pajak_komponen = explode(',', $o->pajak_komponen_id);
									?>
									<div class="checkbox clip-check check-primary checkbox-inline">
										<input type="checkbox" id="kpajak<?=$p->id?>" onchange="hitung()" value="<?=$p->id?>" class="<?=$p->title?>" name="pajak_komponen_id[]" <?=(in_array($p->id, $pajak_komponen) ? 'checked' : '')?>>
										<label for="kpajak<?=$p->id?>">
											<?=$p->title?>
										</label>
									</div>
									<?php endforeach;?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<button id="btnAdd" type="button" class="btn btn-green" onclick="addRow('table')">
                    	<?= lang('add').' '.lang('item') ?> <i class="fa fa-plus"></i>
                	</button>
					<button id="remove" class="btn btn-danger" type="button" style="display:none">Hapus <i class="fa fa-remove"></i></button>
					<div class="row">
						<div class="col-sm-12">
							<table id="table" class="table table-striped">
								<thead>
									<tr>
										<th width="1%"> # </th>
										<th width="1%"> No. </th>
										<th width="5%"> Kode Barang </th>
										<th width="8%"> SS Barang </th>
										<th width="20%"> Deskripsi & Catatan </th>
										<th width="5%">Quantity</th>
										<th width="5%"> Satuan </th>
										<th width="10%"> Harga </th>
										<th width="5%">Disc(%)</th>
										<th width="10%"> Sub Total </th>
									</tr>
								</thead>
								<tbody>
									<?php
										$totalpajak = $total = $biaya_angsuran = $totalplusbunga = $saldo = $total_diskon= 0;
										$i=0;foreach($order_list->result() as $ol): 
										$diskon = $ol->jumlah*$ol->harga*($ol->disc/100);
										$subtotal = $ol->jumlah*$ol->harga-$diskon;
										$totalpajak = $totalpajak + ($subtotal * ($ol->pajak/100));
										$total_diskon= $total_diskon + ($ol->jumlah*$ol->harga * ($ol->disc/100));
										$total = $total + $subtotal;
										$ss_link = base_url("uploads/barang/$ol->barang_id/$ol->photo");
	                 					$ss_headers = @get_headers($ss_link);
										$src = ($ss_headers[0] != 'HTTP/1.1 404 Not Found')?base_url("uploads/barang/$ol->barang_id/$ol->photo") : assets_url('assets/images/no-image-mid.png');
										$i++;
										?>
									<tr>
										<td>
										<div class="checkbox clip-check check-primary checkbox-inline">
											<input type="checkbox" id="row<?=$ol->barang_id?>" value="" class="cek" name="row">
											<label for="row<?=$ol->barang_id?>">
											</label>
										</div>
										</td>
										<?php $src = (!empty($ol->photo))?base_url("uploads/barang/$ol->barang_id/$ol->photo") : assets_url('assets/images/no-image-mid.png') ?>
										<td><?=$i?></td>
										<td><?=$ol->kode_barang?></td>
										<td><img height="75px" width="75px" src="<?=$src?>"></td>
										<input type="hidden" name="kode_barang[]" class="form-control text-right" value="<?=$ol->barang_id?>">
										</td>
										<td>
											<textarea name="deskripsi[]" class="form-control" placeholder="Isi deskripsi dan catatan kaki perbarang disini"><?=$ol->deskripsi?></textarea>
										</td>
										<td class="text-right"><input type="text" name="jumlah[]" class="form-control text-right" value="<?=$ol->jumlah?>" id="jumlah<?=$i?>"></td>
										<td><?=$ol->satuan?></td>
										<input type="hidden" name="satuan[]" class="form-control text-right" value="<?=$ol->satuan_id?>">
										<td class="text-right"><input type="text" name="harga[]" class="form-control text-right harga" value="<?=number_format($ol->harga, 2)?>" id="harga<?=$i?>"></td>
										<td class="text-right">
										<input type="text" name="disc[]" class="form-control text-right disc" value="<?=$ol->disc?>" id="disc<?=$i?>">
										<input type="hidden" name="subdisc[]" class="form-control text-right subdisc" value="0" id="subdisc<?=$i?>">
										</td>
										<td class="text-right"><input type="text" name="subtotal" class="form-control text-right subtotal" value="<?=number_format($subtotal, 2)?>" id="subtotal<?=$i?>" readonly></td>
										</tr>
									<script type="text/javascript" src="<?=assets_url('vendor/jquery-mask-money/jquery.MaskMoney.js')?>"></script>
									<script>
										$("#harga<?=$i?>").maskMoney({allowZero:true});
										$("#disc<?=$i?>").add("#harga<?=$i?>").add("#jumlah<?=$i?>").add("#dibayar").add("#dibayar-nominal").add("#biaya_pengiriman").keyup(function() {
											hitung();
											
											var a = parseFloat($("#jumlah<?=$i?>").val()),
									        	b = parseFloat($("#harga<?=$i?>").val().replace(/,/g,"")).toFixed(2),
									        	c = parseFloat($("#disc<?=$i?>").val()),
									        	diBayar = parseFloat($('#dibayar').val().replace(/,/g,"")),
									        	diBayarNominal = parseFloat($('#dibayar-nominal').val().replace(/,/g,"")),
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
									        //alert(jmlDisc);
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
									        diBayar = totalpluspajak * (diBayar/100);
									        
									        $('#total-diskon').val(addCommas(parseFloat(jmlDisc).toFixed(2)));
									        $('#total').val(addCommas(parseFloat(total).toFixed(2)));
									        
									        //$('#totalPajak').val(addCommas(parseFloat(jmlPajak).toFixed(2)));
									        $('#total-diskon').val(addCommas(parseFloat(jmlDisc).toFixed(2)));
									        $('#total').val(addCommas(parseFloat(total).toFixed(2)));
									        //alert(diBayar);
									        $('#totalpluspajak').val(addCommas(parseFloat(total+p1+p2+p3).toFixed(2)));
									        var saldo = totalpluspajak-diBayar-diBayarNominal;
									        $('#saldo').val(addCommas(parseFloat(saldo).toFixed(2)));	
									    });
										</script>
										<div id="tb">
										</div>
									<?php endforeach;
										$total_pajak = $o->total_ppn + $o->total_pph22 + $o->total_pph23;
										$total = $total+$o->biaya_pengiriman;
										$totalpluspajak = $total+$total_pajak;
										$dp = $totalpluspajak * ($o->dibayar/100);
										$saldo = $totalpluspajak - $dp - $o->dibayar_nominal;
									?>
								</tbody>
							</table>
						</div>
					</div>
					<div id="panel-total" class="panel-body col-md-6 pull-right">
							<ul class="list-group">
								<li class="list-group-item" id="totalPPN">
									<div class="row">
										<div class="col-md-4">
										PPN 10%
										</div>
										<div class="col-md-6 pull-right">
										<input type="text" id="totalPajak" name="total-ppn" value="<?=$o->total_ppn?>" class="form-control text-right">
										</div>
									</div>
								</li>
								<li class="list-group-item" id="totalPPH22">
									<div class="row">
										<div class="col-md-4">
										PPH 22
										</div>
										<div class="col-md-6 pull-right">
										<input type="text" id="totalp2" name="total-pph22" value="<?=$o->total_pph22?>" class="form-control text-right">
										</div>
									</div>
								</li>
								<li class="list-group-item" id="totalPPH23">
									<div class="row">
										<div class="col-md-4">
										PPH 23
										</div>
										<div class="col-md-6 pull-right">
										<input type="text" id="totalp3" name="total-pph23" value="<?=$o->total_pph23?>" class="form-control text-right">
										</div>
									</div>
								</li>
								<li class="list-group-item">
									<div class="row">
										<div class="col-md-4">
										Biaya Pengiriman
										</div>
										<div class="col-md-6 pull-right">
										<input type="text" name="biaya_pengiriman" id="biaya_pengiriman" class="form-control text-right" value="<?=$o->biaya_pengiriman?>">
										</div>
									</div>
								</li>
								<li class="list-group-item">
									<div class="row">
										<div class="col-md-4">
										Diskon
										</div>
										<div class="col-md-6 pull-right">
										<input type="text" name="total-diskon" id="total-diskon" class="form-control text-right" value="<?=$total_diskon?>" readonly>
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
								<div id="total_angsuran" <?= ($o->metode_pembayaran_id != 2)? 'style="display:none"':'';?>>
									<li class="list-group-item">
										<div class="row">
											<div class="col-md-6">
											Uang Muka
												<div class="checkbox clip-check check-primary checkbox-inline">
													<input type="checkbox" onchange="hitung()" id="dp-persen-cek" value="" name="row">
													<label for="dp-persen-cek">
														Persen
													</label>
												</div>
											</div>
											<div id="dp-persen">
												<div class="col-md-4">
												<input type="text" name="dibayar" id="dibayar" class="form-control text-right" value="<?=$o->dibayar?>">
												</div>
												<div class="col-md-1">
												%
												</div>
											</div>
											<div id="dp-nominal">
												<div class="col-md-6">
													<input type="text" name="dibayar-nominal" id="dibayar-nominal" class="form-control text-right" value="<?=$o->dibayar_nominal?>">
												</div>
											</div>
										</div>
									</li>
									<li class="list-group-item">
									<div class="row">
										<div class="col-md-4">
										Saldo
										</div>
										<div class="col-md-6 pull-right">
										<input type="text" id="saldo" class="form-control text-right" value="<?=$saldo?>" readonly="readonly">
										</div>
									</div>
								</li>
								</div>
								
							</ul>
						</div>
					</div>
				</div>
				<div class="row" id="btnSubmit">
			<div class="col-md-7"></div>
			<div class="col-md-2">
			<button type="button" id="btnDraft" class="btn btn-lg btn-green hidden-print pull-right" style="">
				Save Draft <i class="fa fa-save"></i>
			</button>
			</div>
			<div class="col-md-1">
			</div>
			<div class="col-md-2">
			<button type="submit"  class="btn btn-lg btn-primary hidden-print pull-right">
				Submit Order <i class="fa fa-check"></i>
			</button>
			</div>
			<?php else:
				echo 'Draft dibuat oleh '.getFullName($o->created_by);
				endif;
				?>
		</div>
			</div>
		</div>
	</form>
<?php endforeach;?>
</div>
<script type="text/javascript" src="<?=assets_url('vendor/bootstrap-datepicker/bootstrap-datepicker.min.js')?>"></script>
<script type="text/javascript">

					function hitung()
					{


						if($('#dp-persen-cek').is(':checked')){
							$('#dibayar-nominal').val(parseFloat(0));
						}else{
							$('#dibayar').val(parseFloat(0));
						}

				        	diBayar = parseFloat($('#dibayar').val().replace(/,/g,"")),
				        	diBayarNominal = parseFloat($('#dibayar-nominal').val().replace(/,/g,"")),
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
				        diBayar = totalpluspajak * (diBayar/100);
				        
				        var saldo = totalpluspajak-diBayar-diBayarNominal;
				        $('#total-diskon').val(addCommas(parseFloat(jmlDisc).toFixed(2)));
				        $('#total').val(addCommas(parseFloat(total).toFixed(2)));
				        
				        //$('#totalPajak').val(addCommas(parseFloat(jmlPajak).toFixed(2)));
				        $('#total-diskon').val(addCommas(parseFloat(jmlDisc).toFixed(2)));
				        $('#total').val(addCommas(parseFloat(total).toFixed(2)));
				        
				        $('#totalpluspajak').val(addCommas(parseFloat(total+p1+p2+p3).toFixed(2)));
				        $('#saldo').val(addCommas(parseFloat(saldo).toFixed(2)));	
					}
$(document).ready(function() {
	$("#disc<?=$i?>").add("#harga<?=$i?>").add("#jumlah<?=$i?>").add("#dibayar").add("#dibayar-nominal").add("#biaya_pengiriman").keyup(function() {
		hitung();
	});
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

	 $("#dp-persen-cek:not(:checked)").each(function() {
	     $("#dp-persen").hide("slow");
	     $("#dp-nominal").show("slow");
	});

	$("#dp-persen-cek").click(function(){
	     $("#dp-persen").toggle("slow");
	     $("#dp-nominal").toggle("slow");
	});

	$('.input-append.date')
        .datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd-mm-yyyy"
        });
    $("#tanggal_transaksi").datepicker("setDate", new Date());

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

    $('#dibayar').maskMoney({allowZero:true}).attr('maxlength', 6);
    $('#dibayar-nominal').maskMoney({allowZero:true});
    $('#biaya_pengiriman').maskMoney({allowZero:true});
});

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
    function addRow(tableID){
	var table=document.getElementById(tableID);
	var rowCount=table.rows.length;
	$.ajax({
            url: '/gsm/sales/order/add_row/'+rowCount,
            success: function(response){
	         	$("#"+tableID).find('tbody').append(response);
	         },
	         dataType:"html"
        });
	
}
</script>