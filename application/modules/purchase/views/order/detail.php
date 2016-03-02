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
							#<?=$o->po?><small class="text-light"></small>
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
								Proyek
							</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="proyek" value="<?=$o->proyek?>" disabled>
							</div>
						</div>
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
								<input type="text" name="up" value="<?=$o->tanggal_transaksi?>" class="form-control" disabled="disabled">
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
						<!--
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
						-->
						<?php endif ?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<table id="table" class="table table-striped">
							<thead>
								<tr>
									<th width="1%"> No. </th>
									<th width="5%"> Kode Barang </th>
									<th width="8%"> SS Barang </th>
									<th width="15%"> Nama Barang </th>
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
									<td><textarea class="form-control" readonly="readonly"><?=$ol->nama_barang?></textarea></td>
									<td><textarea class="form-control" readonly="readonly"><?=$ol->deskripsi?></textarea></td>
									<td class="text-right"><?=$ol->jumlah?></td>
									<td><?=$ol->satuan?></td>
									<td class="text-right"><?= number_format($ol->harga, 2)?></td>
									<td class="text-right"><?=$ol->disc?></td>
									<td class="text-right"><?= number_format($subtotal, 2)?></td>
								</tr>
								<?php endforeach;
									$total_pajak = $o->total_ppn + $o->total_pph22 + $o->total_pph23;
									$diskon_tambahan = $o->diskon_tambahan_persen + $o->diskon_tambahan_nominal;
									$total = $total+$o->biaya_pengiriman-$diskon_tambahan;
									$totalpluspajak = $total+$total_pajak;
									$dp = $totalpluspajak * ($o->dibayar/100);
									$saldo = $totalpluspajak - $dp - $o->dibayar_nominal;
								?>
							</tbody>
						</table>
					</div>
				</div>
				<hr/>
				<div class="form-actions">
                    <div class="row form-row">
                        <div class="col-md-6 text-center">
                        <?php if($o->is_app_lv1 == 1 && $user_app_lv1 == sessId()):?>
                        	<div class='btn  btn-primary btn-xs text-center' title='Edit Approval' data-toggle="modal" data-target="#approval-modal1"><i class='fa fa-edit'> Edit Approval</i></div>
                        <?php elseif($o->is_app_lv2 == 1 && $user_app_lv2 == sessId()):?>
                        	<div class='btn  btn-primary btn-xs text-center' title='Edit Approval' data-toggle="modal" data-target="#approval-modal2"><i class='fa fa-edit'> Edit Approval</i></div>
                        <?php elseif($o->is_app_lv3 == 1 && $user_app_lv3 == sessId()):?>
                        	<div class='btn  btn-primary btn-xs text-center' title='Edit Approval' data-toggle="modal" data-target="#approval-modal3"><i class='fa fa-edit'> Edit Approval</i></div>
                        <?php endif;?>
                        </div>
                    </div>
                </div>
                <?php $no_pr = getValue('no', 'purchase_order', array('id'=>'where/'.$id));
			        $jenis = getValue('jenis_barang_id', 'purchase_request', array('id'=>'where/'.$no_pr));
			        $gtotal = getValue('gtotal', 'purchase_order', array('id'=>'where/'.$id));
			        if($jenis == 3):
			            if($gtotal > 1000000){
			           		$col = 2;
			            }else{
			                $col = 4;
			            }
			        else:
			            $col  = 3;
			        endif;
			    ?>
				<div class="row">
					<div class="col-md-<?=$col?>">
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
	                    	$status = ($o->app_status_id_lv1==1) ? assets_url('images/approved_stamp.png') : (($o->app_status_id_lv1 == 2) ? assets_url('images/rejected_stamp.png') : (($o->app_status_id_lv1 == 3) ? assets_url('images/pending_stamp.png')  : ""));
	                    ?>
	                      <img height="50px" width="75px" src="<?=$status?>"><br/>
	                      <span class="small"><?=dateIndo($o->date_app_lv1)?></span><br/>
	                     <span class="semi-bold"><?= getFullName($o->user_app_lv1)?></span><br/>
	                     <span class="semi-bold">(<?= $jabatan_lv1?>)</span>
	                    <?php endif; ?>
	                  </div>
					</div>
					<?php if($jenis == 3):?>
					<div class="col-md-<?=$col?>">
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
	                    	$status = ($o->app_status_id_lv2==1) ? assets_url('images/approved_stamp.png') : (($o->app_status_id_lv2 == 2) ? assets_url('images/rejected_stamp.png') : (($o->app_status_id_lv2 == 3) ? assets_url('images/pending_stamp.png')  : ""));
	                    ?>
	                      <img height="50px" width="75px" src="<?=$status?>"><br/>
	                      <span class="small"><?=dateIndo($o->date_app_lv2)?></span><br/>
	                     <span class="semi-bold"><?= getFullName($o->user_app_lv2)?></span><br/>
	                     <span class="semi-bold">(<?= $jabatan_lv2?>)</span>
	                    <?php endif; ?>
	                  </div>
					</div>
				<?php endif;?>
			            <?php if(($gtotal > 1000000 && $jenis == 3) || $jenis !=3){?>
					<div class="col-md-<?=$col?>">
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
	                    	$status = ($o->app_status_id_lv3==1) ? assets_url('images/approved_stamp.png') : (($o->app_status_id_lv3 == 2) ? assets_url('images/rejected_stamp.png') : (($o->app_status_id_lv3 == 3) ? assets_url('images/pending_stamp.png')  : ""));
	                    ?>
	                      <img height="50px" width="75px" src="<?=$status?>"><br/>
	                      <span class="small"><?=dateIndo($o->date_app_lv3)?></span><br/>
	                     <span class="semi-bold"><?= getFullName($o->user_app_lv3)?></span><br/>
	                     <span class="semi-bold">(<?= $jabatan_lv3?>)</span>
	                    <?php endif; ?>
	                  </div>
					</div>

					<div class="col-md-<?=$col?>">
					  <div class="approve text-center" style="align:center">
					  <p class="text-center">Menyetujui,</p>
					  <?php if($o->is_app_lv4 == 0 && $user_app_lv4 == sessId()):?>
						  <div class="btn btn-blue" id="" type="" data-toggle="modal" data-target="#approval-modal4"><i class="icon-ok"></i>Submit</div><br/><br/>
	                   <?php elseif($o->is_app_lv4 == 0 && $user_app_lv4 != sessId()): ?>
	                      <span class="small"></span>
	                      <span class="semi-bold"></span>
	                      <span class="small"></span><br/><br/>
	                      <span class="semi-bold"></span><br/>
	                    <?php else:
	                    	$status = ($o->app_status_id_lv4==1) ? assets_url('images/approved_stamp.png') : (($o->app_status_id_lv4 == 2) ? assets_url('images/rejected_stamp.png') : (($o->app_status_id_lv4 == 3) ? assets_url('images/pending_stamp.png')  : ""));
	                    ?>
	                      <img height="50px" width="75px" src="<?=$status?>"><br/>
	                      <span class="small"><?=dateIndo($o->date_app_lv4)?></span><br/>
	                     <span class="semi-bold"><?= getFullName($o->user_app_lv4)?></span><br/>
	                     <span class="semi-bold">(<?= $jabatan_lv4?>)</span>
	                    <?php endif; ?>
	                  </div>
					</div>
					<?php } ?>
					<div id="panel-total" class="panel-body col-md-4 pull-right">
						<ul class="list-group">
							<?php
							 $pajak_komponen = explode(',', $o->pajak_komponen_id);
							 if(in_array(1, $pajak_komponen)){?>
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-3">
									PPN
									</div>
									<div class="col-md-7 pull-right">
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
									<div class="col-md-7 pull-right">
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
									<div class="col-md-7 pull-right">
									<input type="text" id="totalp3" name="total-pph23" value="<?= number_format($o->total_pph23, 2)?>" class="form-control text-right" readonly="readonly">
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
							<?php if(!empty($o->diskon_tambahan_nominal)){?>
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
							<?php }
							if(!empty($ol->diskon_tambahan_persen)){?>
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
							<?php } ?>
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-3">
									Total
									</div>
									<div class="col-md-7 pull-right">
									<input type="text" class="form-control text-right" id="total" value="<?=number_format($total, 2)?>" readonly="readonly">
									</div>
								</div>
							</li>
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-3">
									Total + Pajak
									</div>
									<div class="col-md-7 pull-right">
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
									<div class="col-md-3">
									Saldo
									</div>
									<div class="col-md-7 pull-right">
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
	<?php 
	for($a=0;$a<5;$a++):
		$note = 'note_app_lv'.$a;
		$user = 'user_app_lv'.$a;
	if(!empty($o->$note)):
		?>
	<div class="row">
    	<div class="col-md-4">
			<div class="form-group">
				<label class="block">
					Note(<?= getFullName($o->$user)?>)
				</label>
				<textarea class="form-control" name="" disabled="disabled"><?= $o->$note ?></textarea>
			</div>
		</div>
    </div>
	<?php endif;endfor;?>
</div>
</form>
<!-- end: INVOICE -->

<?php for($i=1;$i<5;$i++):?>
<!--approval Modal -->
<div class="modal fade" id="approval-modal<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval PO</h4>
      </div>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing"  id="formApp<?= $i ?>">
        <input type="hidden" value="<?=$id?>" name="id">
        <input type="hidden" value="<?= $i ?>" name="level">
            <div class="row form-row">
            	<div class="col-md-6">
					<div class="form-group">
						<label class="block">
							Status Approval
							<?php
								$status ='app_status_id_lv'.$i;
								$note = 'note_app_lv'.$i;
							?>
						</label>
						<div class="clip-radio radio-primary">
							<input type="radio" id="1<?= $i ?>" name="app_status_id_lv<?= $i ?>" value="1" <?= ($o->$status == 1)?'checked':'';?>>
							<label for="1<?= $i ?>">
								Approve
							</label>
							<input type="radio" id="2<?= $i ?>" name="app_status_id_lv<?= $i ?>" value="2" <?= ($o->$status == 2)?'checked':'';?>>
							<label for="2<?= $i ?>">
								Reject
							</label>
							<input type="radio" id="3<?= $i ?>" name="app_status_id_lv<?= $i ?>" value="3" <?= ($o->$status == 3)?'checked':'';?>>
							<label for="3<?= $i ?>">
								Pending
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
						<textarea class="form-control" name="note_lv<?= $i ?>"><?= $o->$note?></textarea>
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

<?php endforeach;?>