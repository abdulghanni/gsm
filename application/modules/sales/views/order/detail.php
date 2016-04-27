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
<form role="form" action="<?= base_url('transaksi/order/add')?>" method="post" class="form-horizontal">
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
							<label class="col-sm-4 control-label" for="inputEmail3">
								Kepada
							</label>
							<div class="col-sm-8">
								<input type="text" name="up" value="<?=$o->kontak?>" class="form-control" disabled="disabled">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Up.
							</label>
							<div class="col-sm-8">
								<input type="text" name="up" value="<?=$o->up?>" class="form-control" disabled="disabled">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Alamat
							</label>
							<div class="col-sm-8">
								<input type="text" name="up" value="<?=$o->alamat?>" class="form-control" disabled="disabled">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Mata Uang
							</label>
							<div class="col-sm-8">
								<input type="text" name="up" value="<?=$o->kurensi?>" class="form-control" disabled="disabled">
							</div>
						</div>

						<?php if(!empty($o->catatan)):?>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Catatan
							</label>
							<div class="col-sm-8">
								<textarea class="form-control" name="catatan" disabled="disabled"><?=$o->catatan?></textarea>
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
								<input type="text" name="up" value="<?=$o->so?>" class="form-control" disabled="disabled">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Batas. Pembayaran
							</label>
							<div class="col-sm-8">
								<input type="text" name="up" value="<?=dateIndo($o->tanggal_transaksi)?>" class="form-control" disabled="disabled">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Dikirim dari
							</label>
							<div class="col-sm-8">
								<input type="text" name="up" value="<?=$o->gudang?>" class="form-control" disabled="disabled">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Project
							</label>
							<div class="col-sm-8">
								<input type="text" name="up" value="<?=$o->project?>" class="form-control" disabled="disabled">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Term
							</label>
							<div class="col-sm-8">
								<input type="text" name="up" value="<?=$o->metode_pembayaran?>" class="form-control" disabled="disabled">
							</div>
						</div>
						<?php if($o->metode_pembayaran_id == 2):?>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Tempo Pembayaran
							</label>
							<div class="col-sm-4">
								<input type="text" value="<?=$o->lama_angsuran_1.' '.$o->lama_angsuran_2?>" name="lama_angsuran_1" id="lama_angsuran_1" class="form-control" disabled="disabled">
							</div>
						</div>
						<?php endif ?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="table-responsive">
						<table id="table" class="table table-striped">
							<thead>
								<tr>
									<th width="1%"> No. </th>
									<th width="10%"> Kode Barang </th>
									<th width="9%"> SS Barang </th>
									<th width="25%"> Deskripsi </th>
									<th width="25%"> Catatan </th>
									<th width="5%">Quantity</th>
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
									$totalpajak = $total = $biaya_angsuran = $totalplusbunga = $saldo = $total_diskon= 0;
									$i=1;foreach($order_list->result() as $ol): 
									$diskon = $ol->jumlah*$ol->harga*($ol->disc/100);
									$subtotal = $ol->jumlah*$ol->harga-$diskon;
									$totalpajak = $totalpajak + ($subtotal * ($ol->pajak/100));
									$total_diskon= $total_diskon + ($ol->jumlah*$ol->harga * ($ol->disc/100));
									$total = $total + $subtotal;
									$ss_link = base_url("uploads/barang/$ol->barang_id/$ol->photo");
                 					$ss_headers = @get_headers($ss_link);
									$src = ($ss_headers[0] != 'HTTP/1.1 404 Not Found')?base_url("uploads/barang/$ol->barang_id/$ol->photo") : assets_url('assets/images/no-image-mid.png');
									?>
								<tr>
									<td><?=$i++?></td>
									<td><?=$ol->kode_barang?></td>
									<td><img height="75px" width="75px" src="<?=$src?>"></td>
									<td><textarea readonly="readonly"><?=$ol->deskripsi?></textarea></td>
									<td><textarea readonly="readonly"><?=$ol->catatan?></textarea></td>
									<td class="text-right"><?=$ol->jumlah?></td>
									<td><?=$ol->satuan?></td>
									<td class="text-right"><?= number_format($ol->harga, 2)?></td>
									<td class="text-right"><?=$ol->disc?></td>
									<td class="text-right"><?= number_format($subtotal, 2)?></td>
									<td class="text-center"><?= ($ol->inc_ppn != 0)? '<i class="fa fa-check"></i>' : '<i class="fa fa-remove"></i>'?></td>
									<td class="text-center"><a target="_blank" href="<?= base_url("uploads/sale/".$ol->attachment)?>"><?=$ol->attachment?></a></td>
								</tr>
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
				</div>
				<div class="row">
					<div id="panel-total" class="panel-body col-md-5 pull-right">
						<ul class="list-group">
							<?php
							 $pajak_komponen = explode(',', $o->pajak_komponen_id);
							 if($is_ex_tax > 0){?>
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-3">
									PPN
									</div>
									<div class="col-md-6 pull-right">
									<input type="text" id="totalPajak" value="<?= number_format($o->total_ppn, 2)?>" class="form-control text-right" readonly="readonly">
									</div>
								</div>
							</li>
							<?php } ?>
							<?php if(in_array(2, $pajak_komponen)){?>
							<li class="list-group-item" id="totalPPH22">
								<div class="row">
									<div class="col-md-3">
									PPH 22%
									</div>
									<div class="col-md-6 pull-right">
									<input type="text" id="totalp2" name="total-pph22" value="<?= number_format($o->total_pph22, 2)?>" class="form-control text-right" readonly="readonly">
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
									<div class="col-md-6 pull-right">
									<input type="text" id="totalp3" name="total-pph23" value="<?= number_format($o->total_pph23, 2)?>" class="form-control text-right" readonly="readonly">
									</div>
								</div>
							</li>
							<?php } ?>
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-4">
									Biaya Pengiriman
									</div>
									<div class="col-md-6 pull-right">
									<input type="text" name="biaya_pengiriman" id="biaya_pengiriman" class="form-control text-right" value="<?= number_format($o->biaya_pengiriman, 2)?>" readonly="readonly">
									</div>
								</div>
							</li>
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-4">
									Diskon
									</div>
									<div class="col-md-6 pull-right">
									<input type="text" class="form-control text-right" id="diskon" value="<?=number_format($total_diskon, 2)?>" readonly="readonly">
									</div>
								</div>
							</li>
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
									Total + Pajak
									</div>
									<div class="col-md-6 pull-right">
									<input type="text" class="form-control text-right" id="total" value="<?=number_format($totalpluspajak, 2)?>" readonly="readonly">
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
									<div class="col-md-4">
									Saldo
									</div>
									<div class="col-md-6 pull-right">
									<input type="text" id="saldo" class="form-control text-right" value="<?=number_format($saldo, 2)?>" readonly="readonly">
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
<?php endforeach;?>
<!-- end: INVOICE -->