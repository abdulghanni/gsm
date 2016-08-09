<?php foreach ($order->result() as $o) :?><div class="row">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								No. Invoice
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="No. Invoice" name="no" class="form-control" value="" required="required">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Tgl. Invoice
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
								Supplier
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
								No. PO
							</label>
							<div class="col-sm-8">
								<input type="text" name="po" value="<?=$o->po?>" class="form-control" readonly>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Tanggal Pengiriman
							</label>
							<div class="col-sm-8">
								<div id="tanggal_pengiriman" class="input-append date success no-padding">
								<?php $tgl_pengiriman = getValue('tgl', 'stok_penerimaan', array('ref_id'=>'where/'.$id))?>
                                  <input type="text" class="form-control" name="tanggal_pengiriman" value="<?= date("d-m-Y", strtotime($tgl_pengiriman))?>" required>
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
								Term
							</label>
							<div class="col-sm-8">
								<input type="text" name="up" value="<?=$o->metode_pembayaran?>" class="form-control" readonly>
								<input type="hidden" name="metode_pembayaran_id" value="<?=$o->metode_pembayaran_id?>" class="form-control" readonly>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								No. Faktur
							</label>
							<div class="col-sm-8">
								<input type="text" name="no_faktur" value="" class="form-control" required="required">
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
						<?php $d = "display:none";?>
						<div id="kredit" style="<?=($o->metode_pembayaran_id == 1) ? $d : ''?>">
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
									Tempo Pembayaran
								</label>
								<div class="col-sm-2">
									<input type="text" placeholder="" name="" id="lama_angsuran_1" class="form-control text-right" value="<?= $o->lama_angsuran_1.' '.$o->lama_angsuran_2?>" disabled>
									<input type="hidden" placeholder="" name="lama_angsuran_1" id="lama_angsuran_1" class="form-control text-right" value="<?=$o->lama_angsuran_1?>">
									<input type="hidden" placeholder="" name="lama_angsuran_2" id="lama_angsuran_2" class="form-control text-right" value="<?=$o->lama_angsuran_2?>">
								</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Tanggal Jatuh Tempo
							</label>
							<div class="col-sm-8">
								<div id="jatuh_tempo" class="input-append date success no-padding">
                                  <input type="text" class="form-control" name="jatuh_tempo">
                                  <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                                </div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Komponen Pajak
							</label>
							<div class="col-sm-6">
								<?php $c = '<i class="fa fa-square"></i> PPN';
								echo (!empty($o->pajak_komponen_id)) ? $c : '<label class="form-label">Tidak Termasuk Pajak</label>';?>
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
						<th width="1%"> No. </th>
						<th width="5%"> SS barang </th>
						<th width="5%"> Kode Barang </th>
						<th width="15%"> Nama Barang </th>
						<th width="15%"> Deskripsi </th>
						<th width="15%"> Catatan </th>
						<th width="5%">Qty</th>
						<th width="10%"> Satuan </th>
						<th width="20%"> Harga </th>
						<th width="5%">Disc(%)</th>
						<th width="15%"> Sub Total </th>
						<th width="5%">Attachment</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$total = 0;
						$i=1;foreach($order_list->result() as $ol): 
						$diskon = $ol->jumlah*$ol->harga*($ol->disc/100);
						$subtotal = $ol->jumlah*$ol->harga-$diskon;
						$total += $subtotal;
						$ss_link = base_url("uploads/barang/$ol->barang_id/$ol->photo");
                 					$ss_headers = @get_headers($ss_link);
									$src = ($ss_headers[0] != 'HTTP/1.1 404 Not Found')?base_url("uploads/barang/$ol->barang_id/$ol->photo") : assets_url('assets/images/no-image-mid.png');
					?>
					<tr>
						<td><?=$i++?></td>

						<td><img height="75px" width="75px" src="<?=$src?>"></td>

						<td><?=$ol->kode_barang?></td>

						<input type="hidden" name="kode_barang[]" class="form-control text-right" value="<?=$ol->barang_id?>">
						
						<td>
							<textarea name="nama_barang[]" class="" readonly=""><?=$ol->nama_barang?></textarea>
						</td>

						<td><textarea name="deskripsi[]" class="" readonly=""><?=$ol->deskripsi?></textarea></td>

						<td>
							<textarea name="catatan_barang[]" class="" placeholder="Isi catatan kaki perbarang disini" readonly=""><?=$ol->catatan?></textarea>
						</td>

						<td class="text-right">
							<?=$ol->jumlah?>
							<input type="hidden" name="jumlah[]" class="form-control text-right" value="<?=$ol->jumlah?>" id="jumlah<?=$i?>">
						</td>

						<td><?=$ol->satuan?></td>

						<input type="hidden" name="satuan[]" class="form-control text-right" value="<?=$ol->satuan_id?>">
						
						<td class="text-right"><?=number_format($ol->harga, 2)?></td>
						
						<input type="hidden" name="harga[]" class="form-control text-right harga" value="<?=$ol->harga?>" id="harga<?=$i?>">
						
						<td class="text-right">
							<?=$ol->disc?>
							<input type="hidden" name="disc[]" class="form-control text-right disc" value="<?=$ol->disc?>" id="disc<?=$i?>">
							<input type="hidden" name="subdisc[]" class="form-control text-right subdisc" value="0" id="subdisc<?=$i?>">
						</td>

						<td class="text-right">
							<?=number_format($subtotal, 2)?>
							<input type="hidden" name="subtotal" class="form-control text-right subtotal" value="<?=number_format($subtotal, 2)?>" id="subtotal<?=$i?>" readonly>
						</td>
						
						<td>
							<a target="_blank" href="<?= base_url("uploads/pr/".$ol->attachment)?>"><?=$ol->attachment?></a>
						</td>
					</tr>
					<?php 
						endforeach;
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
					<?php if(!empty($o->total_ppn)){?>
					<li class="list-group-item">
						<div class="row">
							<div class="col-md-4">
							PPN
							</div>
							<div class="col-md-6 pull-right">
							<input type="text" id="totalPajak" value="<?=number_format($o->total_ppn, 2)?>" class="form-control text-right" readonly="readonly">
							</div>
						</div>
					</li>
					<?php  } ?>
					<li class="list-group-item">
						<div class="row">
							<div class="col-md-4">
							Biaya Pengiriman
							</div>
							<div class="col-md-6 pull-right">
							<input type="text" name="biaya_pengiriman" id="biaya_pengiriman" class="form-control text-right" value="<?=number_format($o->biaya_pengiriman, 2)?>" readonly>
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-md-4">
							Diskon
							</div>
							<div class="col-md-6 pull-right">
							<input type="text" name="total-diskon" id="total-diskon" class="form-control text-right" value="<?=number_format($o->total_diskon, 2)?>" readonly>
							</div>
						</div>
					</li>
					<?php if($o->diskon_tambahan_nominal!=0){?>
						<li class="list-group-item">
							<div class="row">
								<div class="col-md-4">
								Diskon Tambahan
								</div>
								<div class="col-md-7 pull-right">
								<input type="text" class="form-control text-right" id="diskon" value="<?=number_format($o->diskon_tambahan_nominal, 2)?>" readonly="readonly">
								</div>
							</div>
						</li>
					<?php }elseif($o->diskon_tambahan_persen!=0){?>
						<li class="list-group-item">
							<div class="row">
								<div class="col-md-4">
								Diskon Tambahan
								</div>
								<div class="col-md-2">
								</div>
								<div class="col-md-4">
								<input type="text" name="dibayar" id="dibayar" class="form-control text-right" value="<?=$o->diskon_tambahan_persen?>" readonly>
								</div>
								<div class="col-md-1">
								%
								</div>
							</div>
						</li>
					<?php }?>
					<li class="list-group-item">
						<div class="row">
							<div class="col-md-4">
							Total
							</div>
							<div class="col-md-6 pull-right">
							<input type="text" class="form-control text-right" id="total" value="<?=number_format($total, 2)?>" readonly="readonly">
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-md-4">
							Total+Pajak
							</div>
							<div class="col-md-6 pull-right">
							<input type="text" class="form-control text-right" name="gtotal" id="totalpluspajak" value="<?=number_format($o->gtotal, 2)?>" readonly="readonly">
							</div>
						</div>
					</li>
					<?php if($o->metode_pembayaran_id == 2):?>
						<li class="list-group-item">
								<div class="row">
									<div class="col-md-4">
									Uang Muka
									</div>
									<div class="col-md-2">
									</div>
									<?php if($o->dibayar != 0){?>
									<div class="col-md-4">
									<input type="text" name="dibayar" id="dibayar" class="form-control text-right" value="<?=$o->dibayar?>" readonly>
									</div>
									<div class="col-md-1">
									%
									</div>
									<?php }else{?>
									<div id="dp-nominal">
										<div class="col-md-6">
											<input type="text" name="dibayar-nominal" id="dibayar-nominal" class="form-control text-right" value="<?=number_format($o->dibayar_nominal, 2)?>" readonly>
										</div>
									</div>
									<?php  } ?>
								</div>
							</li>
							<li class="list-group-item">
							<div class="row">
								<div class="col-md-3">
								Saldo
								</div>
								<div class="col-md-6 pull-right">
								<input type="text" name="saldo" id="saldo" class="form-control text-right" value="<?=number_format($o->saldo, 2)?>" readonly="readonly">
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
	</div>
<?php endforeach;?>
<script type="text/javascript" src="<?=assets_url('vendor/jquery/jquery.min.js')?>"></script>
<script type="text/javascript" src="<?=assets_url('vendor/bootstrap-datepicker/bootstrap-datepicker.min.js')?>"></script>
<script type="text/javascript" src="<?=assets_url('vendor/jquery-mask-money/jquery.MaskMoney.js')?>"></script>
<script type="text/javascript">
	$('.input-append.date')
        .datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd-mm-yyyy"
        });
    $("#tanggal_faktur").datepicker("setDate", new Date());
</script>