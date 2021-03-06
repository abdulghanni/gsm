<!-- start: PAGE TITLE -->
<section id="page-title">
	<div class="row">
		<div class="col-sm-8">
			<h1 class="mainTitle">Purchase Order</h1>
			<span class="mainDescription"></span>
		</div>
		<ol class="breadcrumb">
			<li>
				<span>Pages</span>
			</li>
			<li>
				<span><a href="<?=base_url('purchase/order')?>">order</a></span>
			</li>
			<li  class="active">
				<span><a href="<?=base_url('purchase/order/detail/'.$id)?>">detail</a></span>
			</li>
		</ol>
	</div>
</section>
<!-- end: PAGE TITLE -->
<!-- start: INVOICE -->
<div class="container-fluid container-fullw bg-white">

<div class="row pull-right">
	<a href="<?=base_url().'transaksi/order/print_pdf/'.$id;?>" target='_blank' class="btn btn-lg btn-primary hidden-print">
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
					<div class="col-md-5">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="inputEmail3">
								Kepada
							</label>
							<div class="col-sm-9">
								<input type="text" name="up" value="<?=$o->supplier?>" class="form-control" disabled="disabled">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="inputPassword3">
								Up.
							</label>
							<div class="col-sm-9">
								<input type="text" name="up" value="<?=$o->up?>" class="form-control" disabled="disabled">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="inputPassword3">
								Alamat
							</label>
							<div class="col-sm-9">
								<input type="text" name="up" value="<?=$o->alamat?>" class="form-control" disabled="disabled">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label" for="inputPassword3">
								Mata Uang
							</label>
							<div class="col-sm-9">
								<input type="text" name="up" value="<?=$o->kurensi?>" class="form-control" disabled="disabled">
							</div>
						</div>
						<?php if(!empty($o->keterangan)):?>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="inputPassword3">
								Keterangan
							</label>
							<div class="col-sm-9">
								<input type="text" name="up" value="<?=$o->keterangan?>" class="form-control" disabled="disabled">
							</div>
						</div>
					<?php endif;?>

                    </div>

                    <div class="col-md-5">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="inputEmail3">
								Tgl. Pengiriman
							</label>
							<div class="col-sm-9">
								<input type="text" name="up" value="<?=$o->tanggal_transaksi?>" class="form-control" disabled="disabled">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="inputPassword3">
								No. PO
							</label>
							<div class="col-sm-9">
								<input type="text" name="up" value="<?=$o->po?>" class="form-control" disabled="disabled">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="inputPassword3">
								Dikirim Ke
							</label>
							<div class="col-sm-9">
								<input type="text" name="up" value="<?=$o->gudang?>" class="form-control" disabled="disabled">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label" for="inputPassword3">
								Term
							</label>
							<div class="col-sm-9">
								<input type="text" name="up" value="<?=$o->metode_pembayaran?>" class="form-control" disabled="disabled">
							</div>
						</div>
						<?php if($o->metode_pembayaran_id == 2):?>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="inputPassword3">
								Lama Angsuran
							</label>
							<div class="col-sm-4">
								<input type="text" value="<?=$o->lama_angsuran_1.' '.$o->lama_angsuran_2?>" name="lama_angsuran_1" id="lama_angsuran_1" class="form-control" disabled="disabled">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label" for="inputPassword3">
								Bunga
							</label>
							<div class="col-sm-2">
								<input type="text" value="<?=$o->bunga?>" name="bunga" id="bunga" class="form-control text-right" disabled="disabled">
							</div>
							<label class="col-sm-1 control-label" for="inputPassword3">
								%
							</label>
						</div>
						<?php endif ?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<table id="table" class="table table-striped">
							<thead>
								<tr>
									<th width="5%"> No. </th>
									<th width="5%"> Kode Barang </th>
									<th width="25%"> Nama Barang </th>
									<th width="5%">Quantity</th>
									<th width="10%"> Satuan </th>
									<th width="20%"> Harga </th>
									<th width="5%">Disc(%)</th>
									<th width="20%"> Sub Total </th>
									<th width="5%">Pajak(%)</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$totalpajak = $total = $biaya_angsuran = $totalplusbunga = $saldo = 0;
									$i=1;foreach($order_list->result() as $ol): ?>
								<tr>
								<?php 
									$subtotal = $ol->jumlah*$ol->harga;
									$totalpajak = $totalpajak + ($subtotal * ($ol->pajak/100));
									$total = $total + $subtotal;
								?>
									<td><?=$i++?></td>
									<td><?=$ol->kode_barang?></td>
									<td><?=$ol->deskripsi?></td>
									<td class="text-right"><?=$ol->jumlah?></td>
									<td><?=$ol->satuan?></td>
									<td class="text-right"><?= number_format($ol->harga, 2)?></td>
									<td class="text-right"><?=$ol->disc?></td>
									<td class="text-right"><?= number_format($ol->jumlah*$ol->harga, 2)?></td>
									<td class="text-right"><?=$ol->pajak?></td>
								</tr>
								<?php endforeach;
									$grandtotal = $total + $o->biaya_pengiriman - $o->dibayar;
									$bunga =  ($grandtotal) * ($o->bunga/100);
								?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div id="panel-total" class="panel-body col-md-5 pull-right">
						<ul class="list-group">
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-4">
									Total Pajak
									</div>
									<div class="col-md-6 pull-right">
									<input type="text" id="totalPajak" value="<?= number_format($totalpajak, 2)?>" class="form-control text-right" readonly="readonly">
									</div>
								</div>
							</li>
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
									Total
									</div>
									<div class="col-md-6 pull-right">
									<input type="text" class="form-control text-right" id="total" value="<?=number_format($total+$o->biaya_pengiriman, 2)?>" readonly="readonly">
									</div>
								</div>
							</li>
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-4">
									Dibayar
									</div>
									<div class="col-md-6 pull-right">
									<input type="text" name="dibayar" id="dibayar" class="form-control text-right" value="<?=number_format($o->dibayar,2)?>" readonly="readonly">
									</div>
								</div>
							</li>
							<?php if($o->metode_pembayaran_id == 2):?>
								<li class="list-group-item">
									<div class="row">
										<div class="col-md-4">
										Total+Bunga Angsuran
										</div>
										<div class="col-md-6 pull-right">
										<input type="text" name="dibayar" id="totalplusbunga" class="form-control text-right" value="<?= number_format($grandtotal+$bunga,2)?>" readonly>
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
										<input type="text" name="biaya_angsuran" id="biaya_angsuran" class="form-control text-right" value="<?php echo number_format(($grandtotal+$bunga)/$o->lama_angsuran_1, 2)?>" readonly>
										</div>
										<div class="col-md-2" id="angsuran" style="margin-left:-10px">/<?= strtoupper($o->lama_angsuran_2)?>
										</div>
									</div>
								</li>
						<?php endif?>
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-4">
									Saldo
									</div>
									<div class="col-md-6 pull-right">
									<input type="text" id="saldo" class="form-control text-right" value="<?=number_format($grandtotal, 2)?>" readonly="readonly">
									</div>
								</div>
							</li>
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