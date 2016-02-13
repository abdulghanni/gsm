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
				<span><a href="<?=base_url('purchase/receive')?>"><?=$main_title?></a></span>
			</li>
			<li  class="active">
				<span><a href="<?=base_url('purchase/receive/detail/'.$id)?>">Detail</a></span>
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
								<input type="text" placeholder="No. Purchase Request" name="no" value="<?=$o->tanggal_digunakan?>>" class="form-control" disabled>
							</div>
						</div>
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
									$i=1;foreach($request_list->result() as $ol): ?>
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
									<td class="text-right"><?= number_format($subtotal, 2)?></td>
									<td class="text-right"><?=$ol->pajak?></td>
								</tr>
								<?php endforeach;
									$totalpluspajak = $total+$totalpajak;
									$grandtotal = $totalpluspajak;								?>
							</tbody>
						</table>
					</div>
				</div>
				<hr/>
				<div class="row">
					
					<div class="col-md-3">
						<div class="approve text-center" style="align:center">
						  <p class="text-center approve-head">Requested By, </p>
						  <span class="small"></span><br/><br/><br/>
	                      <span class="semi-bold"><?= getFullName($o->created_by)?></span><br/>
	                      <span class="semi-bold">(<?= getUserGroup($o->created_by)?>)</span><br/>
	                      <span class="small"><?=dateIndo($o->created_on)?></span>
						</div>
					</div>

					<div class="col-md-3">
					  <div class="approve text-center" style="align:center">
					  <p class="text-center">Menyetujui,</p>
					  <?php if($o->is_app == 0 && $o->diajukan_ke == sessId()):?>
						  <div class="btn btn-blue" id="" type="" data-toggle="modal" data-target="#approval-modal"><i class="icon-ok"></i>Submit</div><br/><br/>
	                   <?php elseif($o->is_app == 0 && $o->diajukan_ke != sessId()): ?>
	                      <span class="small"></span>
	                      <span class="semi-bold"></span>
	                      <span class="small"></span><br/><br/>
	                      <span class="semi-bold"></span><br/>
	                    <?php else:
	                    	$status = ($o->app_status_id==1) ? assets_url('images/approved_stamp.png') : (($o->app_status_id == 2) ? assets_url('images/rejected_stamp.png') : (($o->app_status_id == 3) ? assets_url('images/pending_stamp.png')  : ""));
	                    ?>
	                      <img height="50px" width="75px" class="margin-bottom-5" src="<?=$status?>"><br/>
	                     <span class="semi-bold"><?= getFullName($o->user_app_id)?></span><br/>
	                     <span class="semi-bold">(<?= getUserGroup($o->user_app_id)?>)</span><br/>
	                      <span class="small"><?=dateIndo($o->date_app)?></span>
	                    <?php endif; ?>
	                  </div>
					</div>
					<!--
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
									<input type="text" class="form-control text-right" id="total" value="<?=number_format($total+$totalpajak, 2)?>" readonly="readonly">
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

<!--approval Modal -->
<div class="modal fade" id="approval-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval PR</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing"  id="formApp">
        <input type="hidden" value="<?=$id?>" name="id">
        <input type="hidden" value="" name="level">
            <div class="row form-row">
            	<div class="col-md-6">
					<div class="form-group">
						<label class="block">
							Status Approval
						</label>
						<div class="clip-radio radio-primary">
							<input type="radio" id="1" name="app_status_id" value="1">
							<label for="1">
								Approve
							</label>
							<input type="radio" id="2" name="app_status_id" value="2">
							<label for="2">
								Reject
							</label>
							<input type="radio" id="3" name="app_status_id" value="3">
							<label for="3">
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
						<textarea class="form-control" name="note"></textarea>
					</div>
				</div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;Close</button> 
        <button type="button" id="btnApp" onclick="approve()" class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;Save</button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end approve modal--> 