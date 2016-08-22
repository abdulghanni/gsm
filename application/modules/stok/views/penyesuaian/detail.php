<!-- start: PAGE TITLE -->
<section id="page-title">
	<div class="row">
		<div class="col-sm-8">
			<h1 class="mainTitle">Penyesuaian Stok</h1>
			<span class="mainDescription"></span>
		</div>
		<ol class="breadcrumb">
			<li>
				<span>Stok</span>
			</li>
			<li class="active">
				<span><a href="<?=base_url('stok/penyesuaian')?>">Penyesuaian</a></span>
			</li>
			<li>
				<span><a href="#">detail</a></span>
			</li>
		</ol>
	</div>
</section>
<!-- end: PAGE TITLE -->
<!-- start: INVOICE -->
<div class="container-fluid container-fullw bg-white">
<form role="form" action="<?= base_url('stok/pemindahan/add')?>" method="post" class="form-horizontal">
	<div class="row">
		<div class="col-md-12">
			<div class="invoice">
				<div class="row invoice-logo">
					<div class="col-sm-6">
						<img alt="" src="<?= assets_url('images/your-logo-here.png')?>">
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="inputEmail3">
								No. Transaksi
							</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" value="<?=$r->no?>" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label" for="inputEmail3">
								Tgl. Transaksi
							</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" value="<?=$r->tgl?>" readonly>
							</div>
						</div>
                    </div>

                    <div class="col-md-6">
						<div class="form-group">
							<?php $nm_f="catatan";
							?>
							<label class="col-sm-3 control-label" for="inputPassword3">
								Keterangan
							</label>
							<div class="col-sm-9">
								<textarea readonly="readonly"><?=$r->catatan?></textarea>
							</div>
						</div>
                    </div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="table-responsive">
							<table id="table" style="width:100%" class="table table-striped">
								<thead>
									<tr>
										<th width="1%"> No. </th>
										<th width="10%"> Kode Barang </th>
										<th width="20%"> Nama Barang </th>
										<th width="18%"> Catatan </th>
										<th width="20%">Buku</th>
										<th width="15%">Fisik</th>
										<th width="15%">Satuan</th>
									</tr>
								</thead>
								<tbody>
									<?php $i=1;foreach ($list as $v) {?>
										<td> <?=$i++?> </td>
										<td> <?=$v->kode_barang ?> </td>
										<td> <?=$v->nama_barang ?> </td>
										<td> <?=$v->catatan?></td>
										<td> <?=$v->buku.' ' .$v->satuan_buku?></td>
										<td> <?=$v->fisik?> </td>
										<td> <?=$v->satuan?> </td>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
</div>