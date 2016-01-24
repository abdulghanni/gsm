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
	<a href="<?=base_url().'purchase/order/print_pdf/'.$id;?>" target='_blank' class="btn btn-lg btn-primary hidden-print">
		 <i class="fa fa-print"></i> <?= lang('print')?>
	</a>
</div>
<?php foreach ($order->result() as $o) :?>
<form role="form" action="<?= base_url('purchase/order/add')?>" method="post" class="form-horizontal">
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
						<?php if(!empty($o->catatan)):?>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="inputPassword3">
								Catatan
							</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="catatan" disabled="disabled"><?=$o->catatan?></textarea>
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
				<hr/>
				<div class="row">
					<div class="col-md-2">
					  <div class="approve text-center" style="align:center">
					  <p class="text-center">Menyetujui,</p>
					  <?php if($o->is_app_lv1 == 0 && $user_app_lv1 == sessId()):?>
						  <div class="btn btn-blue" id="" type="" data-toggle="modal" data-target="#approval-modal1"><i class="icon-ok"></i>Submit</div><br/><br/>
	                   <?php elseif($o->is_app_lv1 == 0 && $user_app_lv1 != sessId()): ?>
	                      <span class="small"></span>
	                      <span class="semi-bold"></span>
	                      <span class="small"></span><br/><br/>
	                      <span class="semi-bold"></span><br/>
	                    <?php else:
	                    	$status = ($o->app_status_id_lv1==1) ? assets_url('images/approved_stamp.png') : assets_url('images/rejected_stamp.png');
	                    ?>
	                      <img height="50px" width="75px" src="<?=$status?>"><br/>
	                      <span class="small"><?=dateIndo($o->date_app_lv1)?></span><br/>
	                     <span class="semi-bold"><?= getFullName($o->user_app_id_lv1)?></span><br/>
	                     <span class="semi-bold">(<?= $jabatan_lv1?>)</span>
	                    <?php endif; ?>
	                  </div>
					</div>

					<div class="col-md-2">
					  <div class="approve text-center" style="align:center">
					  <p class="text-center">Menyetujui,</p>
					  <?php if($o->is_app_lv2 == 0 && $user_app_lv2 == sessId()):?>
						  <div class="btn btn-blue" id="" type="" data-toggle="modal" data-target="#approval-modal2"><i class="icon-ok"></i>Submit</div><br/><br/>
	                   <?php elseif($o->is_app_lv2 == 0 && $user_app_lv2 != sessId()): ?>
	                      <span class="small"></span>
	                      <span class="semi-bold"></span>
	                      <span class="small"></span><br/><br/>
	                      <span class="semi-bold"></span><br/>
	                    <?php else:
	                    	$status = ($o->app_status_id_lv2==1) ? assets_url('images/approved_stamp.png') : assets_url('images/rejected_stamp.png');
	                    ?>
	                      <img height="50px" width="75px" src="<?=$status?>"><br/>
	                      <span class="small"><?=dateIndo($o->date_app_lv2)?></span><br/>
	                     <span class="semi-bold"><?= getFullName($o->user_app_id_lv2)?></span><br/>
	                     <span class="semi-bold">(<?= $jabatan_lv2?>)</span>
	                    <?php endif; ?>
	                  </div>
					</div>

					<div class="col-md-2">
					  <div class="approve text-center" style="align:center">
					  <p class="text-center">Menyetujui,</p>
					  <?php if($o->is_app_lv3 == 0 && $user_app_lv3 == sessId()):?>
						  <div class="btn btn-blue" id="" type="" data-toggle="modal" data-target="#approval-modal3"><i class="icon-ok"></i>Submit</div><br/><br/>
	                   <?php elseif($o->is_app_lv3 == 0 && $user_app_lv3 != sessId()): ?>
	                      <span class="small"></span>
	                      <span class="semi-bold"></span>
	                      <span class="small"></span><br/><br/>
	                      <span class="semi-bold"></span><br/>
	                    <?php else:
	                    	$status = ($o->app_status_id_lv3==1) ? assets_url('images/approved_stamp.png') : assets_url('images/rejected_stamp.png');
	                    ?>
	                      <img height="50px" width="75px" src="<?=$status?>"><br/>
	                      <span class="small"><?=dateIndo($o->date_app_lv3)?></span><br/>
	                     <span class="semi-bold"><?= getFullName($o->user_app_id_lv3)?></span><br/>
	                     <span class="semi-bold">(<?= $jabatan_lv3?>)</span>
	                    <?php endif; ?>
	                  </div>
					</div>

					<!--
					<div class="col-md-2">
						<div class="approve text-center" style="align:center">
						  <p class="text-center approve-head">Order By, </p>
						  <span class="small"></span><br/>
	                      <span class="small"><?=dateIndo($o->created_on)?></span><br/>
	                      <span class="semi-bold">(<?= getFullName($o->created_by)?>)</span>
						</div>
					</div>

					<div class="col-md-2">
						<div class="approve text-center" style="align:center">
						  <p class="text-center approve-head">ACC Vendor, </p>
						  <span class="small"></span><br/>
	                      <span class="semi-bold"></span><br/>
	                      <span class="semi-bold">Sign & Return By Fax</span>
						</div>
					</div>
					-->

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
									Total + Pajak
									</div>
									<div class="col-md-6 pull-right">
									<input type="text" class="form-control text-right" id="total" value="<?=number_format($total+$o->biaya_pengiriman+$totalpajak, 2)?>" readonly="readonly">
									</div>
								</div>
							</li>
							<?php if($o->metode_pembayaran_id == 2):?>
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
									<input type="text" id="saldo" class="form-control text-right" value="<?=number_format($grandtotal, 2)?>" readonly="readonly">
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

<?php for($i=0;$i<4;$i++):?>
<!--approval Modal -->
<div class="modal fade" id="approval-modal<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval PO</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing"  id="formApp<?= $i ?>">
        <input type="hidden" value="<?=$id?>" name="id">
        <input type="hidden" value="<?= $i ?>" name="level">
            <div class="row form-row">
            	<div class="col-md-6">
					<div class="form-group">
						<label class="block">
							Status Approval
						</label>
						<div class="clip-radio radio-primary">
							<input type="radio" id="1<?= $i ?>" name="app_status_id_lv<?= $i ?>" value="1">
							<label for="1<?= $i ?>">
								Approve
							</label>
							<input type="radio" id="2<?= $i ?>" name="app_status_id_lv<?= $i ?>" value="2">
							<label for="2<?= $i ?>">
								Reject
							</label>
						</div>
					</div>
				</div>
            </div>
            <div class="row form-row">
            	<div class="col-md-6">
					<div class="form-group">
						<label class="block">
							Note(Optional)
						</label>
						<textarea class="form-control" name="note_lv$level"></textarea>
					</div>
				</div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;Close</button> 
        <button type="button" id="btnApp" onclick="approve<?=$i?>()" class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;Save</button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end approve modal--> 
<?php endfor; ?>