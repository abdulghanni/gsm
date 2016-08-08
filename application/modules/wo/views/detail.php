<!-- start: PAGE TITLE -->
<section id="page-title">
	<div class="row">
		<div class="col-sm-8">
			<h1 class="mainTitle">Work Order</h1>
			<span class="mainDescription"></span>
		</div>
		<ol class="breadcrumb">
			<li>
				<span>Pages</span>
			</li>
			<li>
				<span><a href="<?=base_url('wo')?>">order</a></span>
			</li>
			<li  class="active">
				<span><a href="<?=base_url('wo/detail/'.$id)?>">detail</a></span>
			</li>
		</ol>
	</div>
</section>
<!-- end: PAGE TITLE -->
<!-- start: INVOICE -->
<div class="container-fluid container-fullw bg-white">
<?php echo form_open_multipart(base_url($file_name.'/add'), array('id'=>'form-pr', 'class'=>'form-horizontal'))?>
	<div class="row">
		<div class="col-md-12">
			<div class="invoice">
				<div class="row invoice-logo">
					<div class="col-sm-6">
						<img alt="" src="<?= assets_url('images/your-logo-here.png')?>">
					</div>
					<div class="col-sm-6">
						<p class="text-dark">
							#<?=$det->no?><small class="text-light"></small>
						</p>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								No. Work Order
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="No. Work Order" name="no" value="<?=$det->no?>" class="form-control" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Catatan
							</label>
							<div class="col-sm-8">
								<textarea class="form-control" name="catatan"><?=$det->catatan?></textarea>
							</div>
						</div>
                    </div>

                    <div class="col-md-6">
                    	<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Customer
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="No. Work Order" name="no" value="<?=$det->kontak?>" class="form-control" readonly>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Project
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="Project" name="project" value="<?=$det->project?>" class="form-control" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Tgl. Dibutuhkan
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="No. Work Order" name="no" value="<?=dateIndo($det->tgl)?>" class="form-control" readonly>
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
									<th width="1%"> No. </th>
									<th width="8%"> SS Barang </th>
									<th width="5%"> Kode Barang </th>
									<th width="20%"> Nama Barang </th>
									<th width="20%"> Deskripsi </th>
									<th width="20%"> Catatan </th>
									<th width="5%">Qty</th>
									<th width="10%"> Satuan </th>
									<th width="15%"> Sisa Stok </th>
								</tr>
							</thead>
							<tbody>
							<?php 
								$i=1;foreach($list as $l){
								$ss_link = base_url("uploads/barang/$l->barang_id/$l->photo");
                 				$ss_headers = @get_headers($ss_link);
								$src = ($ss_headers[0] != 'HTTP/1.1 404 Not Found')?base_url("uploads/barang/$l->barang_id/$l->photo") : assets_url('assets/images/no-image-mid.png');
							?>
								<tr>
									<td><?=$i?></td>
									<td><img height="75px" width="75px" src="<?=$src?>"></td>
									<td><?=$l->kode_barang?></td>
									<td><?=$l->nama_barang?></td>
									<td><?=$l->deskripsi?></td>
									<td><?=$l->catatan?></td>
									<td><?=$l->qty?></td>
									<td><?=$l->satuan?></td>
									<td><?=$l->sisa_stok.' '.getValue('title', 'satuan', array('id'=>'where/'.$l->satuan_barang))?></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
					</div>
				</div>
				<hr/>
				<div class="form-actions">
                    <div class="row form-row">
                        <div class="col-md-6 text-center">
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
</form>
<!-- end: INVOICE -->