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

<form role="form" action="<?= base_url('sales/penjualan/edit')?>" method="post" class="form-horizontal">
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
								<input type="text" placeholder="Tgl. Faktur" name="no" class="form-control" value="<?=$o->tanggal_transaksi?>">
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
								<input type="text" name="up" value="<?=$o->metode_pembayaran?>" class="form-control">
							</div>
						</div>
						<?php if($o->metode_pembayaran_id == 2):?>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Tempo Pembayaran
							</label>
							<div class="col-sm-4">
								<input type="text" value="<?=$o->lama_angsuran_1.' '.$o->lama_angsuran_2?>" name="lama_angsuran_1" id="lama_angsuran_1" class="form-control">
							</div>
						</div>
						<?php endif;
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
								<input type="text" name="up" value="<?=$no_sj?>" class="form-control">
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
								<input type="text" name="up" value="<?=$o->no_faktur?>" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Tgl. Faktur
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="Tgl. Faktur" name="no" class="form-control" value="<?=$o->tanggal_faktur?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Batas Pembayaran
							</label>
							<div class="col-sm-8">
								<input type="text" name="up" value="<?=$o->tanggal_pengantaran?>" class="form-control">
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
								<input type="text" name="up" value="<?=$o->project?>" class="form-control">
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
									<td><?=$i++?></td>
									<td><input type="text" value="<?=$pengeluaran_date.sprintf('%04d',$ol->ref_id)?>" readonly></td>
									<td><?=$ol->kode_barang?></td>
									<td><img height="75px" width="75px" src="<?=$src?>"></td>
									<td><textarea readonly="readonly"><?=$ol->deskripsi?></textarea></td>
									<td><textarea readonly="readonly"><?=$ol->catatan?></textarea></td>
									<td class="text-right">
										<input type="text" name="jumlah[]" class=" text-right" value="<?=$ol->diterima?>" id="jumlah<?=$i?>">
									</td>
									<td><?=$ol->satuan?></td>
									<td class="text-right"><?= number_format($ol->harga, $o->opsi_desimal)?></td>
									<td class="text-right"><?=number_format($ol->disc, 2)?></td>
									<td class="text-right"><?= number_format($subtotal, $o->opsi_desimal)?></td>
									<td class="text-center"><?= ($ol->inc_ppn != 0)? '<i class="fa fa-check"></i>' : '<i class="fa fa-remove"></i>'?></td>
									<td class="text-center"><a target="_blank" href="<?= base_url("uploads/sale/".$ol->attachment)?>"><?=$ol->attachment?></a></td>
								</tr>
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
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-3">
									PPN
									</div>
									<div class="col-md-7 pull-right">
									<input type="text" id="totalPajak" value="<?= number_format($o->total_ppn, $o->opsi_desimal)?>" class="form-control text-right" readonly="readonly">
									</div>
								</div>
							</li>
							<?php if(in_array(2, $pajak_komponen)){?>
							<li class="list-group-item" id="totalPPH22">
								<div class="row">
									<div class="col-md-3">
									PPH 22%
									</div>
									<div class="col-md-7 pull-right">
									<input type="text" id="totalp2" name="total-pph22" value="<?= number_format($o->total_pph22, $o->opsi_desimal)?>" class="form-control text-right" readonly="readonly">
									</div>
								</div>
							</li>
							<?php } ?>
							<?php if(in_array(3, $pajak_komponen)){?>
							<li class="list-group-item" id="totalPPH23">
								<div class="row">
									<div class="col-md-3">
									PPH 23%
									</div>
									<div class="col-md-7 pull-right">
									<input type="text" id="totalp3" name="total-pph23" value="<?= number_format($o->total_pph23, $o->opsi_desimal)?>" class="form-control text-right" readonly="readonly">
									</div>
								</div>
							</li>
							<?php } ?>
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
									<input type="text" class="form-control text-right" id="diskon" value="<?=number_format($total_diskon, $o->opsi_desimal)?>" readonly="readonly">
									</div>
								</div>
							</li>
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-3">
									Total
									</div>
									<div class="col-md-7 pull-right">
									<input type="text" class="form-control text-right" id="total" value="<?=number_format($o->total, $o->opsi_desimal)?>" readonly="readonly">
									</div>
								</div>
							</li>
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-3">
									Total + Pajak
									</div>
									<div class="col-md-7 pull-right">
									<input type="text" class="form-control text-right" id="total" value="<?=number_format($o->total_plus_pajak, $o->opsi_desimal)?>" readonly="readonly">
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
													<input type="text" name="dibayar-nominal" id="dibayar-nominal" class="form-control text-right" value="<?=number_format($o->dibayar_nominal, $o->opsi_desimal)?>" readonly>
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
									<div class="col-md-7 pull-right">
									<input type="text" id="saldo" class="form-control text-right" value="<?=number_format($o->saldo, $o->opsi_desimal)?>" readonly="readonly">
									</div>
								</div>
							</li>
						<?php endif?>
							
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</form>
<!-- end: INVOICE -->