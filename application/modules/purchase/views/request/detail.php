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
				<span><a href="<?=base_url('purchase/request')?>"><?=$main_title?></a></span>
			</li>
			<li  class="active">
				<span><a href="<?=base_url('purchase/request/detail/'.$id)?>">Detail</a></span>
			</li>
		</ol>
	</div>
</section>
<!-- end: PAGE TITLE -->
<!-- start: INVOICE -->
<div class="container-fluid container-fullw bg-white">

<div class="row pull-right">
	<a href="<?=base_url().'purchase/request/print_pdf/'.$id;?>" target='_blank' class="btn btn-lg btn-primary hidden-print">
		 <i class="fa fa-print"></i> <?= lang('print')?>
	</a>
</div>
<?php foreach ($request->result() as $o) :?>
<form role="form" action="<?= base_url($module.'/'.$file_name.'/add')?>" method="post" class="form-horizontal">
	<div class="row">
		<div class="col-md-12">
			<div class="invoice">
				<div class="row invoice-logo">
					<div class="col-sm-6">
						<img alt="" src="<?= assets_url('images/your-logo-here.png')?>">
					</div>
					<div class="col-sm-6">
						<p class="text-dark">
							#<?=$o->no?><small class="text-light"></small>
						</p>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Diajukan Kepada
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="No. Purchase Request" name="no" value="<?=getFullName($o->diajukan_ke)?>" class="form-control" disabled>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								No. Purchase Request
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="No. Purchase Request" name="no" value="<?=$o->no?>" class="form-control" disabled>
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
						
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Catatan
							</label>
							<div class="col-sm-8">
								<textarea class="form-control" name="catatan" disabled=""><?=$o->catatan?></textarea>
							</div>
						</div>
                    </div>

                    <div class="col-md-6">
                    	<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Dikirim Ke
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="No. Purchase Request" name="no" value="<?=$o->gudang?>" class="form-control" disabled>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Keperluan
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="Keperluan" name="keperluan" class="form-control" value="<?=$o->keperluan?>" disabled>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Tgl. Digunakan
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="No. Purchase Request" name="no" value="<?=$o->tanggal_digunakan?>" class="form-control" disabled>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Jenis Barang
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="No. Purchase Request" name="no" value="<?=$o->jenis_barang?>" class="form-control" disabled>
							</div>
						</div>
                    </div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<table id="table" class="table table-striped">
							<thead>
								<tr>
									<th width="1%"> No. </th>
									<th width="10%"> Kode Barang </th>
									<th width="9%"> SS Barang </th>
									<th width="25%"> Nama Barang </th>
									<th width="5%">Quantity</th>
									<th width="10%"> Satuan </th>
									<th width="20%"> Harga </th>
									<!--<th width="5%">Disc(%)</th>-->
									<th width="20%"> Sub Total </th>
									<!--<th width="5%">Pajak(%)</th>-->
								</tr>
							</thead>
							<tbody>
								<?php 
									$totalpajak = $total = $biaya_angsuran = $totalplusbunga = $saldo = 0;
									$i=1;foreach($request_list->result() as $ol): ?>
								<tr>
								<?php 
									$subtotal = $ol->jumlah*$ol->harga;
									$totalpajak = $totalpajak + ($subtotal * ($ol->pajak/100));
									$total = $total + $subtotal;
									$ss_link = base_url("uploads/barang/$ol->barang_id/$ol->photo");
                 					$ss_headers = @get_headers($ss_link);
									$src = ($ss_headers[0] != 'HTTP/1.1 404 Not Found')?base_url("uploads/barang/$ol->barang_id/$ol->photo") : assets_url('assets/images/no-image-mid.png');
								?>
									<td><?=$i++?></td>
									<td><?=$ol->kode_barang?></td>
									<td><img height="75px" width="75px" src="<?=$src?>"></td>
									<td><?=$ol->deskripsi?></td>
									<td class="text-right"><?=$ol->jumlah?></td>
									<td><?=$ol->satuan?></td>
									<td class="text-right"><?= number_format($ol->harga, 2)?></td>
									<!--<td class="text-right"><?=$ol->disc?></td>-->
									<td class="text-right"><?= number_format($subtotal, 2)?></td>
									<!--<td class="text-right"><?=$ol->pajak?></td>-->
								</tr>
								<?php endforeach;
									$totalpluspajak = $total+$totalpajak;
									$grandtotal = $totalpluspajak;								?>
							</tbody>
						</table>
					</div>
				</div>
				<hr/>
				<div class="form-actions">
                    <div class="row form-row">
                        <div class="col-md-8 text-center">
                        <?php if($o->is_app_lv1 == 1 && $user_app_lv1 == sessId()):?>
                        	<div class='btn  btn-primary btn-xs text-center' title='Edit Approval' data-toggle="modal" data-target="#approval-modal1"><i class='fa fa-edit'> Edit Approval</i></div>
                        <?php elseif($o->is_app_lv2 == 1 && $user_app_lv2 == sessId()):?>
                        	<div class='btn  btn-primary btn-xs text-center' title='Edit Approval' data-toggle="modal" data-target="#approval-modal2"><i class='fa fa-edit'> Edit Approval</i></div>
                        <?php elseif($o->is_app_lv3 == 1 && $user_app_lv3 == sessId()):?>
                        	<div class='btn  btn-primary btn-xs text-center' title='Edit Approval' data-toggle="modal" data-target="#approval-modal3"><i class='fa fa-edit'> Edit Approval</i></div>
                    	<?php elseif($o->is_app_lv4 == 1 && $user_app_lv4 == sessId()):?>
                        	<div class='btn  btn-primary btn-xs text-center' title='Edit Approval' data-toggle="modal" data-target="#approval-modal4"><i class='fa fa-edit'> Edit Approval</i></div>
                        <?php endif;?>
                        </div>
                    </div>
                </div>
                <?php $col = ($o->jenis_barang_id == 3) ? '2' : 3;?>
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
					<?php if($o->jenis_barang_id == 2):?>
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

					<div id="panel-total" class="panel-body col-md-3 pull-right">
						<ul class="list-group">
						<!--
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-3">
									Total Pajak
									</div>
									<div class="col-md-8 pull-right">
									<input type="text" id="totalPajak" value="<?= number_format($totalpajak, 2)?>" class="form-control text-right" readonly="readonly">
									</div>
								</div>
							</li>
						-->
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-3">
									Total
									</div>
									<div class="col-md-8 pull-right">
									<input type="text" class="form-control text-right" id="total" value="<?=number_format($total, 2)?>" readonly="readonly">
									</div>
								</div>
							</li>
						<!--
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-3">
									Total+Pajak
									</div>
									<div class="col-md-8 pull-right">
									<input type="text" class="form-control text-right" id="total" value="<?=number_format($total+$totalpajak, 2)?>" readonly="readonly">
									</div>
								</div>
							</li>
						-->
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
        <h4 class="modal-title" id="myModalLabel">Approval PR</h4>
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
							<input type="radio" id="1<?= $i ?>" name="app_status_id_lv<?= $i ?>" value="1" <?= ($o->$status == 1)?'checked="checked"':'';?>>
							<label for="1<?= $i ?>">
								Approve
							</label>
							<input type="radio" id="2<?= $i ?>" name="app_status_id_lv<?= $i ?>" value="2" <?= ($o->$status == 2)?'checked="checked"':'';?>>
							<label for="2<?= $i ?>">
								Reject
							</label>
							<input type="radio" id="3<?= $i ?>" name="app_status_id_lv<?= $i ?>" value="3" <?= ($o->$status == 3)?'checked="checked"':'';?>>
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