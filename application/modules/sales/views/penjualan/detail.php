<!-- start: PAGE TITLE -->
<section id="page-title">
	<div class="row">
		<div class="col-sm-8">
			<h1 class="mainTitle"><?= $main_title ?></h1>
			<span class="mainDescription"></span>
		</div>
		<ol class="breadcrumb">
			<li>
				<span>Pages</span>
			</li>
			<li>
				<span><a href="<?=base_url($module.'/'.$file_name)?>"><?= $main_title ?></a></span>
			</li>
			<li  class="active">
				<span><a href="<?=base_url($module.'/'.$file_name.'/detail/'.$id)?>">detail</a></span>
			</li>
		</ol>
	</div>
</section>
<!-- end: PAGE TITLE -->
<!-- start: INVOICE -->
<div class="container-fluid container-fullw bg-white">

<div class="row pull-right">
	<a href="<?=base_url().'sales/penjualan/print_pdf/'.$id;?>" target='_blank' class="btn btn-lg btn-primary hidden-print">
		 <i class="fa fa-print"></i> <?= lang('print')?>
	</a>
</div>
<?php foreach ($penjualan->result() as $o) :?>
<form role="form" action="<?= base_url('transaksi/penjualan/add')?>" method="post" class="form-horizontal">
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
								No. Faktur
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="No. Faktur" name="no" value="<?=$o->no?>" class="form-control" required="required" disabled>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Tgl. Faktur
							</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" value="<?=dateIndo($o->tanggal_transaksi)?>" name="tanggal_transaksi" required disabled>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Customer
							</label>
							<div class="col-sm-8">
								<input type="text" name="up" value="<?=$o->customer?>" class="form-control" disabled="disabled">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Mata Uang
							</label>
							<div class="col-sm-8">
								<input type="text" name="up" value="<?=$o->gudang?>" class="form-control" disabled="disabled">
							</div>
						</div>
						<?php if(!empty($o->catatan)):?>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Catatan
							</label>
							<div class="col-sm-8">
								<textarea class="form-control" name="catatan"><?=$o->catatan?></textarea>
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
								<input type="text" placeholder="No. SO" name="so" class="form-control" value="<?=$o->so?>" required="required" disabled>
							</div>
						</div>

						
                    	<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Tgl. Pengantaran
							</label>
							<div class="col-sm-8">
								<input type="text" name="up" value="<?=dateIndo($o->tanggal_pengantaran)?>" class="form-control" disabled="disabled">
							</div>
						</div>
						
                    	<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Dikirim Dari
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
								Lama Angsuran
							</label>
							<div class="col-sm-4">
								<input type="text" value="<?=$o->lama_angsuran_1.' '.$o->lama_angsuran_2?>" name="lama_angsuran_1" id="lama_angsuran_1" class="form-control" disabled="disabled">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
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
									<th width="10%"> Kode </th>
									<th width="15%"> Nama Barang </th>
									<th width="10%">Di Order</th>
									<th width="10%">Di Terima</th>
									<th width="10%"> Satuan </th>
									<th width="15%"> Harga </th>
									<th width="5%">Disc(%)</th>
									<th width="15%"> Sub Total </th>
									<th width="5%">Pajak(%)</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$totalpajak = $total = $biaya_angsuran = $totalplusbunga = $saldo = 0;
									$i=1;foreach($penjualan_list->result() as $ol): ?>
								<tr>
								<?php 
									$diskon = $ol->diterima*$ol->harga*($ol->disc/100);
									$subtotal = $ol->diterima*$ol->harga-$diskon;
									$totalpajak = $totalpajak + ($subtotal * ($ol->pajak/100));
									$total = $total + $subtotal;
								?>
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
								<?php endforeach;$totalpluspajak = $total+$o->biaya_pengiriman+$totalpajak;
									$grandtotal = $totalpluspajak + $o->biaya_pengiriman - $o->dibayar;
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
									<input type="text" id="totalPajak" value="<?= number_format($totalpajak, 2)?>" class="form-control text-right" disabled>
									</div>
								</div>
							</li>
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-4">
									Biaya Pengiriman
									</div>
									<div class="col-md-6 pull-right">
									<input type="text" name="biaya_pengiriman" id="biaya_pengiriman" class="form-control text-right" value="<?= number_format($o->biaya_pengiriman, 2)?>" disabled>
									</div>
								</div>
							</li>
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-4">
									Total
									</div>
									<div class="col-md-6 pull-right">
									<input type="text" class="form-control text-right" id="total" value="<?=number_format($total+$o->biaya_pengiriman, 2)?>" disabled>
									</div>
								</div>
							</li>
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-4">
									Total + Pajak
									</div>
									<div class="col-md-6 pull-right">
									<input type="text" class="form-control text-right" id="total" value="<?=number_format($total+$o->biaya_pengiriman+$totalpajak, 2)?>" disabled>
									</div>
								</div>
							</li>
							<?php if($o->metode_pembayaran_id == 2):?>

								<li class="list-group-item">
									<div class="row">
										<div class="col-md-4">
										Uang Muka
										</div>
										<div class="col-md-6 pull-right">
										<input type="text" name="dibayar" id="dibayar" class="form-control text-right" value="<?=number_format($o->dibayar,2)?>" disabled>
										</div>
									</div>
								</li>
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
								<li class="list-group-item">
									<div class="row">
										<div class="col-md-4">
										Saldo
										</div>
										<div class="col-md-6 pull-right">
										<input type="text" id="saldo" class="form-control text-right" value="<?=number_format($grandtotal, 2)?>" disabled>
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