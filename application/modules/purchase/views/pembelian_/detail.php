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
				<span><a href="<?=base_url('purchase/pembelian')?>"><?=$main_title?></a></span>
			</li>
			<li  class="active">
				<span><a href="<?=base_url('purchase/pembelian/detail/'.$id)?>">Detail</a></span>
			</li>
		</ol>
	</div>
</section>
<!-- end: PAGE TITLE -->
<!-- start: INVOICE -->
<div class="container-fluid container-fullw bg-white">

<div class="row pull-right">
	<a href="<?=base_url().'purchase/pembelian/print_pdf/'.$id;?>" target='_blank' class="btn btn-lg btn-primary hidden-print">
		 <i class="fa fa-print"></i> <?= lang('print')?>
	</a>
</div>
<?php foreach ($pembelian->result() as $o) :?>
<form role="form" action="<?= base_url('transaksi/pembelian/add')?>" method="post" class="form-horizontal">
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
								<input type="text" placeholder="No. Invoice" name="no" class="form-control" value="<?=$o->no?>" disabled>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Tgl. Invoice
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="Tgl. Faktur" name="no" class="form-control" value="<?=$o->tanggal_transaksi?>" disabled>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Supplier
							</label>
							<div class="col-sm-8">
								<input type="text" name="up" value="<?=$o->kontak?>" class="form-control" disabled="disabled">
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

                    </div>

                    <div class="col-md-6">
                    	<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								No. PO
							</label>
							<div class="col-sm-8">
								<input type="text" name="up" value="<?=$o->po?>" class="form-control" disabled="disabled">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Tgl. Pengiriman
							</label>
							<div class="col-sm-8">
								<input type="text" name="up" value="<?=$o->tanggal_pengiriman?>" class="form-control" disabled="disabled">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Dikirim Ke
							</label>
							<div class="col-sm-8">
								<input type="text" name="up" value="<?=$o->gudang?>" class="form-control" disabled="disabled">
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
						<table id="table" class="table table-striped">
							<thead>
								<tr>
									<th width="5%"> No. </th>
									<th width="5%"> Kode Barang </th>
									<th width="25%"> Nama Barang </th>
									<th width="5%">Diorder</th>
									<th width="5%">Diterima</th>
									<th width="10%"> Satuan </th>
									<th width="20%"> Harga </th>
									<th width="5%">Disc(%)</th>
									<th width="20%"> Sub Total </th>
									<th width="5%">Pajak(%)</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$totalpajak = $total = $biaya_angsuran = $totalplusbunga = $saldo = $total_diskon= 0;
									$i=1;foreach($pembelian_list->result() as $ol): 
									$diskon = $ol->diterima*$ol->harga*($ol->disc/100);
									$subtotal = $ol->diterima*$ol->harga-$diskon;
									$totalpajak = $totalpajak + ($subtotal * ($ol->pajak/100));
									$total_diskon= $total_diskon + ($ol->diterima*$ol->harga * ($ol->disc/100));
									$total = $total + $subtotal;
									?>
								<tr>
									<td><?=$i++?></td>
									<td><?=$ol->kode_barang?></td>
									<td><?=$ol->deskripsi?></td>
									<td class="text-right"><?=$ol->diorder?></td>
									<td class="text-right"><?=$ol->diterima?></td>
									<td><?=$ol->satuan?></td>
									<td class="text-right"><?= number_format($ol->harga, 2)?></td>
									<td class="text-right"><?=$ol->disc?></td>
									<td class="text-right"><?= number_format($subtotal, 2)?></td>
									<td class="text-right"><?=$ol->pajak?></td>
								</tr>
								<?php endforeach;
									$totalpluspajak = $total+$o->biaya_pengiriman+$totalpajak;
									$dp = $totalpluspajak * ($o->dibayar/100);
									$totalplusbunga = ($totalpluspajak-$dp)*($o->bunga/100);
									//$totalplusbunga = ($totalpluspajak-$dp)+$totalplusbunga;
									$grandtotal = ($totalpluspajak-$dp)+$totalplusbunga;//print_mz($totalpluspajak.'-'.$dp.'+'.$totalplusbunga);
									$bunga =  ($grandtotal) * ($o->bunga/100);
								?>
							</tbody>
						</table>
					</div>
				</div>
				<hr/>

					<div id="panel-total" class="panel-body col-md-5 pull-right">
						<ul class="list-group">
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-3">
									Total Pajak
									</div>
									<div class="col-md-7 pull-right">
									<input type="text" id="totalPajak" value="<?= number_format($totalpajak, 2)?>" class="form-control text-right" readonly="readonly">
									</div>
								</div>
							</li>
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-3">
									Biaya Pengiriman
									</div>
									<div class="col-md-7 pull-right">
									<input type="text" name="biaya_pengiriman" id="biaya_pengiriman" class="form-control text-right" value="<?= number_format($o->biaya_pengiriman, 2)?>" readonly="readonly">
									</div>
								</div>
							</li>
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-3">
									Diskon
									</div>
									<div class="col-md-7 pull-right">
									<input type="text" class="form-control text-right" id="diskon" value="<?=number_format($total_diskon, 2)?>" readonly="readonly">
									</div>
								</div>
							</li>
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-3">
									Total
									</div>
									<div class="col-md-7 pull-right">
									<input type="text" class="form-control text-right" id="total" value="<?=number_format($total+$o->biaya_pengiriman, 2)?>" readonly="readonly">
									</div>
								</div>
							</li>
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-3">
									Total + Pajak
									</div>
									<div class="col-md-7 pull-right">
									<input type="text" class="form-control text-right" id="total" value="<?=number_format($total+$o->biaya_pengiriman+$totalpajak, 2)?>" readonly="readonly">
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
											<div class="col-md-4">
											<input type="text" name="dibayar" id="dibayar" class="form-control text-right" value="<?=$o->dibayar?>" readonly>
											</div>
											<div class="col-md-1">
											%
											</div>
										</div>
									</li>
								<li class="list-group-item">
								<div class="row">
									<div class="col-md-3">
									Saldo
									</div>
									<div class="col-md-7 pull-right">
									<input type="text" id="saldo" class="form-control text-right" value="<?=number_format($totalpluspajak-$dp, 2)?>" readonly="readonly">
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