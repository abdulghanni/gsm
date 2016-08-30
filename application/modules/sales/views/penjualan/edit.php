<!-- start: PAGE TITLE -->
<section id="page-title">
	<div class="row">
		<div class="col-sm-8">
			<h1 class="mainTitle"><?=$main_title?></h1>
			<span class="mainDescription"></span>
		</div>
		<ol class="breadcrumb">
			<li>
				<span>Pages</span>
			</li>
			<li>
				<span><a href="<?=base_url('sales/penjualan')?>"><?=$main_title?></a></span>
			</li>
			<li  class="active">
				<span><a href="<?=base_url('sales/penjualan/detail/'.$id)?>">Edit</a></span>
			</li>
		</ol>
	</div>
</section>
<!-- end: PAGE TITLE -->
<!-- start: INVOICE -->
<div class="container-fluid container-fullw bg-white">

<form role="form" action="<?= base_url('sales/penjualan/edit/'.$id)?>" method="post" class="form-horizontal">
	<div class="row">
		<div class="col-md-12">
			<div class="invoice">
				<div class="row invoice-logo">
					<div class="col-sm-6">
						<img alt="" src="<?= assets_url('images/your-logo-here.png')?>">
					</div>
					<div class="col-sm-6">
						<p class="text-dark">
							#<?=$o->no?> / <?=$o->tanggal_transaksi?> <small class="text-light"></small>
						</p>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6">

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								No. Invoice
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="No. Invoice" name="no" class="form-control" value="<?=$o->no?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Tgl. Invoice
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="Tgl. Faktur" name="tanggal_transaksi" class="form-control" value="<?=$o->tanggal_transaksi?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Customer
							</label>
							<div class="col-sm-8">
								<input type="text" name="up" value="<?=$o->kontak?>" class="form-control" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Alamat Customer
							</label>
							<div class="col-sm-8">
								<input type="text" name="alamat" value="<?=$o->alamat?>" class="form-control">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Mata Uang
							</label>
							<div class="col-sm-8">
								<input type="text" name="up" value="<?=$o->kurensi?>" class="form-control" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Term
							</label>
							<div class="col-sm-8">
								<div class="clip-radio radio-primary">
									<?php foreach($metode as $m):
										$checked = ($m->id == $o->metode_pembayaran_id) ? 'checked="checked"' : '';
									?>
									<input type="radio" id="metode<?=$m->id?>" name="metode_pembayaran_id" value="<?=$m->id?>" <?= $checked;?>>
									<label for="metode<?=$m->id?>">
										<?=$m->title?>
									</label>
									<?php endforeach;?>
								</div>
							</div>
						</div>

						
						<?php $d = "display:none";?>
						<div id="kredit" style="<?=($o->metode_pembayaran_id == 1) ? $d : ''?>">
							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputPassword3">
									Tempo Pembayaran
								</label>
								<div class="col-sm-2">
									<input type="text" placeholder="" name="lama_angsuran_1" id="lama_angsuran_1" class="form-control text-right" value="<?= $o->lama_angsuran_1?>">
								</div>
								<div class="col-sm-6">
									<select class="select2" name="lama_angsuran_2" id="lama_angsuran_2" style="width:100%">
									<option value="0">-- Pilih Tempo Pembayaran --</option>
								    <option value="hari" <?= ($o->lama_angsuran_2 == 'hari') ? 'selected="selected"' : ''?>>Hari</option>
						            <option value="bulan" <?= ($o->lama_angsuran_2 == 'bulan') ? 'selected="selected"' : ''?>>Bulan</option>
						            <option value="tahun" <?= ($o->lama_angsuran_2 == 'tahun') ? 'selected="selected"' : ''?>>Tahun</option>
		              	            </select>
								</div>
							</div>
						</div>

						<?php 
							  $pajak_komponen = explode(',', $o->pajak_komponen_id);
						 ?>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Catatan
							</label>
							<div class="col-sm-8">
								<textarea name="up" class="form-control"><?=$o->catatan?></textarea>
							</div>
						</div>

                    </div>

                    <div class="col-md-6">
                		<?php $s = explode(',', $o->no_sj);
                			foreach($s as $j):
                				$no = getValue('no', 'stok_pengeluaran', array('id'=>'where/'.$j));
                				$created_on = getValue('created_on', 'stok_pengeluaran', array('id'=>'where/'.$j));
                				$no_sj = (!empty($no)) ? $no : date('Ymd', strtotime($created_on)).sprintf('%04d',$j);
                				?>
                    	<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								No. Surat Jalan
							</label>
							<div class="col-sm-8">
								<input type="text" name="" value="<?=$no_sj?>" class="form-control">
							</div>
						</div>
						<?php endforeach; ?>
                    	<div class="form-group">
							<?php $i = 1;$so_id = explode(',', $o->so);foreach ($so_id as $key => $v) {?>
							<label class="col-sm-4 control-label" for="inputPassword3">
								No. SO <?= (sizeof($so_id) > 1) ? '- '.$i++ : '';?>
							</label>
							<div class="col-sm-8">
								<input type="text" name="" value="<?=getValue('so', 'sales_order', array('id'=>'where/'.$v))?>" class="form-control">
							</div>
							<?php } ?>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								No. Faktur
							</label>
							<div class="col-sm-8">
								<input type="text" name="no_faktur" value="<?=$o->no_faktur?>" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Tgl. Faktur
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="Tgl. Faktur" name="tanggal_faktur" class="form-control" value="<?=$o->tanggal_faktur?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Batas Pembayaran
							</label>
							<div class="col-sm-8">
								<input type="text" name="tanggal_pengiriman" value="<?=$o->tanggal_pengantaran?>" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Dikirim dari
							</label>
							<div class="col-sm-8">
								<input type="text" name="up" value="<?=$o->gudang?>" class="form-control" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Project
							</label>
							<div class="col-sm-8">
								<input type="text" name="project" value="<?=$o->project?>" class="form-control">
							</div>
						</div>

						<div class="form-group">
			                <label class="col-sm-4 control-label" for="inputEmail3">
			                    Opsi Desimal
			                </label>
			                <div class="col-sm-8">
			                    <select name="opsi_desimal" id="opsi_desimal">
			                    <?php for($i=0;$i<9;$i++):
			                    $selected = ($i==$o->opsi_desimal) ? "selected='selected'" : '';
			                    ?>
			                        <option value="<?=$i?>" <?= $selected ?>><?=$i?></option>
			                    <?php endfor;?>
			                    </select>
			                    <input type="hidden" id="opsi_desimal_val" value="2">
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
									<th width="5%"> No. Ref </th>
									<th width="5%"> Kode Barang </th>
									<th width="8%"> SS Barang </th>
									<th width="25%"> Deskripsi </th>
									<th width="25%"> Catatan </th>
									<th width="5%"> Qty</th>
									<th width="10%"> Satuan </th>
									<th width="20%"> Harga </th>
									<th width="5%">Disc(%)</th>
									<th width="20%"> Sub Total </th>
									<th width="5%">Inc PPN</th>
									<th width="5%">Attachment</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$totalpajak = $total = $biaya_angsuran = $totalplusbunga = $saldo = $total_diskon= $p2 = $p3 = $exc = 0;
									$i=1;foreach($penjualan_list->result() as $ol): 
									$diskon = $ol->diterima*$ol->harga*($ol->disc/100);
									$subtotal = $ol->diterima*$ol->harga-$diskon;
									$totalpajak = $totalpajak + ($subtotal * ($ol->pajak/100));
									$exc = ($ol->inc_ppn != 0) ? 0 : $exc + ($subtotal * (10/100));
									$total_diskon= $total_diskon + ($ol->diterima*$ol->harga * ($ol->disc/100));
									$total = $total + $subtotal;
									$ss_link = base_url("uploads/barang/$ol->barang_id/$ol->photo");
                 					$ss_headers = @get_headers($ss_link);
									$src = ($ss_headers[0] != 'HTTP/1.1 404 Not Found')?base_url("uploads/barang/$ol->barang_id/$ol->photo") : assets_url('assets/images/no-image-mid.png');
									$pengeluaran_date =  getValue('created_on', 'stok_pengeluaran', array('id'=>'where/'.$ol->ref_id));
									$pengeluaran_date = date('Ymd', strtotime($pengeluaran_date));
									?>
								<tr>
									<input type="hidden" name="list_id[]" value="<?=$ol->id?>">
									<input type="hidden" name="ref_id[]" value="<?=$ol->ref_id?>">
									<input type="hidden" name="kode_barang[]" class=" text-right" value="<?=$ol->barang_id?>">
									<td><?=$i++?></td>
									<td><input type="text" value="<?=$pengeluaran_date.sprintf('%04d',$ol->ref_id)?>" readonly></td>
									<td><?=$ol->kode_barang?></td>
									<td><img height="75px" width="75px" src="<?=$src?>"></td>
									<td>
										<textarea name="deskripsi[]" class="" placeholder="Isi deskripsi dan catatan kaki perbarang disini"><?=$ol->deskripsi?></textarea>
									</td>
									<td>
										<textarea name="catatan_barang[]" class="" placeholder="Isi catatan kaki perbarang disini"><?=$ol->catatan?></textarea>
									</td>

									<td class="text-right">
										<input type="text" name="jumlah[]" class=" text-right" value="<?=$ol->diterima?>" id="jumlah<?=$i?>">
									</td>
									<td><?=$ol->satuan?></td>
									<td class="text-right"><input type="text" name="harga[]" class=" text-right harga" value="<?=number_format($ol->harga, $o->opsi_desimal)?>" id="harga<?=$i?>"></td>
									<td class="text-right">
									<input type="text" name="disc[]" class=" text-right disc" value="<?=number_format($ol->disc, 2)?>" id="disc<?=$i?>">
									<input type="hidden" name="subdisc[]" class=" text-right subdisc" value="0" id="subdisc<?=$i?>">
									</td>
									<td class="text-right"><input type="text" name="subtotal" class=" text-right subtotal" value="<?=number_format($subtotal, $o->opsi_desimal)?>" id="subtotal<?=$i?>" readonly>
									</td>
									<td>
										<?php $checked = ($ol->inc_ppn != 0)?'checked="checked"' : '';?>
										<input name= "pajak_checkbox1_checkbox[]" type="checkbox" id="pajak<?=$i?>" value="1" <?=$checked?> >
										<input type="hidden" name="pajak_checkbox1[]" value="0" />
										<input type="hidden" name="pajak[]" value="<?= $subtotal * (10/100) ?>" id="subpajak<?=$i?>" class="subpajak">
										<input type="hidden" name="" value="<?= $subtotal * (10/100) ?>" id="exc<?=$i?>" class="exc">
									</td>
									<td class="text-center"><a target="_blank" href="<?= base_url("uploads/sale/".$ol->attachment)?>"><?=$ol->attachment?></a></td>
								</tr>
								<script>
								var dec = 2;
								$('select[name=opsi_desimal]').change(function(){ console.log($(this).val());$("#opsi_desimal_val").val($(this).val()); });

								$("#pajak<?=$i?>").click(function(){
								    hitung<?=$i?>();
								});

								$("#disc<?=$i?>").add("#harga<?=$i?>").add("#jumlah<?=$i?>").add("#dibayar").add("#dibayar-nominal").add("#biaya_pengiriman").keyup(function() {
									hitung<?=$i?>();
							    });

								    function hitung<?=$i?>(){
										var dec = $("#opsi_desimal_val").val();
										var dec = parseInt(dec);
										$("#harga<?=$i?>").maskMoney({allowZero:true, precision: dec});
								    	var a = parseFloat($("#jumlah<?=$i?>").val()),
								        	b = parseFloat($("#harga<?=$i?>").val().replace(/,/g,"")).toFixed(dec),
								        	c = parseFloat($("#disc<?=$i?>").val()),
								        	p = parseFloat($("#subpajak<?=$i?>").val()).toFixed(dec),
								        	diBayar = parseFloat($('#dibayar').val().replace(/,/g,"")),
								        	diBayarNominal = parseFloat($('#dibayar-nominal').val().replace(/,/g,"")),
								        	biayaPengiriman = parseFloat($('#biaya_pengiriman').val().replace(/,/g,"")),
								        	d = (a*b)*(c/100),//jumlah diskon
								       		val = (a*b)-d,
								       		disc = (a*b)*(c/100),
								       		subPajak = val*(p/100),//jumlah pajak
    										totalPajak = 0,
								        	jmlDisc = 0,
								        	total = 0;
									        ppn = $("#ppn_val").val(),
											pph22 = $("#pp22_val").val(),
											pph23 = $("#pp23_val").val(),
											ppnx =  val*(ppn/100);
											exc = 0;
								        $("#subtotal<?=$i?>").val(addCommas(parseFloat(val).toFixed(dec)));
								        $("#subdisc<?=$i?>").val(addCommas(parseFloat(disc).toFixed(dec)));
								        $('.subdisc').each(function (index, element) {
								            jmlDisc = jmlDisc + parseFloat($(element).val().replace(/,/g,""));
								        });

										if($("#pajak<?=$i?>").is(':checked')){
											ppnx =  val - (val/1.1);
											$("#subpajak<?=$i?>").val(parseFloat(ppnx));
											$("#exc<?=$i?>").val(parseFloat(0));
										}else{
											ppnx =  val * (10/100);
											$("#subpajak<?=$i?>").val(parseFloat(ppnx));
											$("#exc<?=$i?>").val(parseFloat(ppnx));
										}
										$('.subpajak').each(function (index, element) {
								            totalPajak = totalPajak + parseFloat($(element).val().replace(/,/g,""));
								        });
										 $('.exc').each(function (index, element) {
								            exc = exc + parseFloat($(element).val().replace(/,/g,""));
								        });
										parseFloat($('#totalPajak').val(totalPajak));
										if($('#kpajak2').is(':checked')){
											$('#totalp2').val(parseFloat(total*(2/100)));
										}else{
											//$('#totalp2').val(parseFloat(0));
										}
										if($('#kpajak3').is(':checked')){
											$('#totalp3').val(parseFloat(total*(2/100)));
										}else{
											$('#totalp3').val(parseFloat(0));
										}

										p1 = parseFloat($("#totalPajak").val().replace(/,/g,"")),
										p2 = parseFloat($("#totalp2").val().replace(/,/g,"")),
								       p3 = parseFloat($("#totalp3").val().replace(/,/g,"")),
								        $("#pajak<?=$i?>").val(subPajak);
								        $('#totalPajak').val(addCommas(parseFloat(totalPajak).toFixed(dec)));

								        $('.subtotal').each(function (index, element) {
								            total = total + parseFloat($(element).val().replace(/,/g,""));
								        });

								        total = total+biayaPengiriman+exc;
								        totalpluspajak = total+p1+p2+p3;
								       // totalpluspajak = total+p1;
								        totalminuspajak = total-p1-p2-p3;
								        // totalminuspajak = total-p1;
								        diBayar = totalpluspajak * (diBayar/100);
								        // diBayar = 0;

								         $('#totalPajak').val(addCommas(parseFloat(totalPajak).toFixed(dec)));
								        $('#total-diskon').val(addCommas(parseFloat(jmlDisc).toFixed(dec)));
								        $('#total').val(addCommas(parseFloat(totalminuspajak).toFixed(dec)));
								        
								        $('#totalpluspajak').val(addCommas(parseFloat(total).toFixed(dec)));
								        var saldo = total-diBayar-diBayarNominal;
								        $('#saldo').val(addCommas(parseFloat(saldo).toFixed(dec)));	
								    }
							</script>
							<?php $i++;
							
							 ?>
								<?php endforeach;
									$total_pajak = $o->total_ppn + $o->total_pph22 + $o->total_pph23;
									//$total = $total+$o->biaya_pengiriman;
									$total = $total+$o->biaya_pengiriman-$total_pajak+$exc;
									//$totalpluspajak = $total+$total_pajak;
									$totalpluspajak = $total + $total_pajak;
									$dp = $totalpluspajak * ($o->dibayar/100);
									$saldo = $totalpluspajak - $dp- $o->dibayar_nominal;
								?>
							</tbody>
						</table>
					</div>
					</div>
				</div>
				<hr/>

					<div id="panel-total" class="panel-body col-md-6 pull-right">
						<ul class="list-group">
							<li class="list-group-item" id="totalPPN">
								<div class="row">
									<div class="col-md-4">
									PPN
									</div>
									<div class="col-md-6 pull-right">
									<input type="text" id="totalPajak" name="total-ppn" value="<?= number_format($o->total_ppn, $o->opsi_desimal)?>" class="form-control text-right" readonly="readonly">
									</div>
								</div>
							</li>
							<li class="list-group-item" id="totalPPH22">
								<div class="row">
									<div class="col-md-4">
									PPH 22
									</div>
									<div class="col-md-6 pull-right">
									<input type="text" id="totalp2" name="total-pph22" value="0" class="form-control text-right" readonly="readonly">
									</div>
								</div>
							</li>
							<li class="list-group-item" id="totalPPH23">
								<div class="row">
									<div class="col-md-4">
									PPH 23
									</div>
									<div class="col-md-6 pull-right">
									<input type="text" id="totalp3" name="total-pph23" value="0" class="form-control text-right" readonly="readonly">
									</div>
								</div>
							</li>
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-3">
									Biaya Pengiriman
									</div>
									<div class="col-md-7 pull-right">
									<input type="text" name="biaya_pengiriman" id="biaya_pengiriman" class="form-control text-right" value="<?= number_format($o->biaya_pengiriman, $o->opsi_desimal)?>" readonly="readonly">
									</div>
								</div>
							</li>
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-3">
									Diskon
									</div>
									<div class="col-md-7 pull-right">
									<input type="text" class="form-control text-right" name="total-diskon" id="diskon" value="<?=number_format($total_diskon, $o->opsi_desimal)?>" readonly="readonly">
									</div>
								</div>
							</li>
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-3">
									Total
									</div>
									<div class="col-md-7 pull-right">
									<input type="text" class="form-control text-right" name="total" id="total" value="<?=number_format($o->total, $o->opsi_desimal)?>" readonly="readonly">
									</div>
								</div>
							</li>
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-3">
									Total + Pajak
									</div>
									<div class="col-md-7 pull-right">
									<input type="text" class="form-control text-right" id="totalpluspajak" name="total_plus_pajak" value="<?=number_format($o->total_plus_pajak, $o->opsi_desimal)?>" readonly="readonly">
									</div>
								</div>
							</li>
							<?php if($o->metode_pembayaran_id == 2):?>
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
											<input type="text" name="dibayar" id="dibayar" class="form-control text-right" value="0">
											</div>
											<div class="col-md-1">
											%
											</div>
										</div>
										<div id="dp-nominal">
											<div class="col-md-6">
												<input type="text" name="dibayar-nominal" id="dibayar-nominal" class="form-control text-right" value="0">
											</div>
										</div>
									</div>
								</li>
								<li class="list-group-item">
								<div class="row">
									<div class="col-md-3">
									Saldo
									</div>
									<div class="col-md-7 pull-right">
									<input type="text" name="saldo" id="saldo" class="form-control text-right" value="<?=number_format($o->saldo, $o->opsi_desimal)?>" readonly="readonly">
									</div>
								</div>
							</li>
						<?php endif?>
							
						</ul>
					</div>
				</div>
			</div>
		</div>

				
					<div class="row">
						<button type="submit" id="btnSubmit" class="btn btn-lg btn-primary hidden-print pull-right" style="margin-right:15px;">
							Submit <i class="fa fa-check"></i>
						</button>
					</div>
	</div>
</div>
</form>
<!-- end: INVOICE -->

<script type="text/javascript">
$('input[type="checkbox"]').on('change', function(e){
        if($(this).prop('checked'))
        {
            $(this).next().val(1);
            //$(this).next().disabled = true;
        } else {
            $(this).next().val(0);
            //$(this).next().disabled = true;
        }
    });


	$("#dp-persen-cek:not(:checked)").each(function() {
	     $("#dp-persen").hide("slow");
	     $("#dp-nominal").show("slow");
	});

	$("#dp-persen-cek").click(function(){
	     $("#dp-persen").toggle("slow");
	     $("#dp-nominal").toggle("slow");
	     hitung();
	});

    $('#dibayar,#dibayar-nominal, #biaya_pengiriman').keyup(function(){
    	hitung();
    });

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
    	totalPajak = 0,
    	jmlDisc = 0,
    	total = 0;
		ppn = $("#ppn_val").val(),
		pph22 = $("#pp22_val").val(),
		pph23 = $("#pp23_val").val();

	if($('#dp-persen-cek').is(':checked')){
		$('#dibayar-nominal').val(parseFloat(0));
	}else{
		$('#dibayar').val(parseFloat(0));
	}

    $('.subpajak').each(function (index, element) {
        totalPajak = totalPajak + parseFloat($(element).val().replace(/,/g,""));
    });
    $('.subtotal').each(function (index, element) {
        total = total + parseFloat($(element).val().replace(/,/g,""));
    });
    $('.subdisc').each(function (index, element) {
        jmlDisc = jmlDisc + parseFloat($(element).val().replace(/,/g,""));
    });
    /*
    if($('#kpajak1').is(':checked')){
		parseFloat($('#totalPajak').val(total*(10/100)));
	}else{
		$('#totalPajak').val(parseFloat(0));
	}
	*/
	parseFloat($('#totalPajak').val(totalPajak));

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

	p1 = parseFloat($("#totalPajak").val().replace(/,/g,"")),
	p2 = parseFloat($("#totalp2").val().replace(/,/g,"")),
    p3 = parseFloat($("#totalp3").val().replace(/,/g,"")),

    total = total+biayaPengiriman+exc;
    totalpluspajak = total+p1+p2+p3;
    totalminuspajak = total-p1-p2-p3;
    diBayar = total * (diBayar/100);
    $('#totalPajak').val(addCommas(parseFloat(totalPajak).toFixed(dec)));
    $('#total-diskon').val(addCommas(parseFloat(jmlDisc).toFixed(dec)));
    $('#total').val(addCommas(parseFloat(totalminuspajak).toFixed(dec)));
    
    $('#totalpluspajak').val(addCommas(parseFloat(total).toFixed(dec)));
    var saldo = total-diBayar-diBayarNominal;
    $('#saldo').val(addCommas(parseFloat(saldo).toFixed(dec)));	
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