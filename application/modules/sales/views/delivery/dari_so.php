<?php foreach ($order->result() as $o) :?>
<fieldset>
				<legend>Info Form Kirim Barang</legend>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								No. Surat Jalan
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="No. Form" name="no" class="form-control" required="required" value="<?=date('Ymd').$last_id?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Tgl. Kirim Barang
							</label>
							<div class="col-sm-8">
								<div id="tanggal_faktur" class="input-append date success no-padding">
                                  <input type="text" class="form-control" name="tanggal_pengantaran" value="<?=$o->tanggal_transaksi?>" required>
                                  <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                                </div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Customer
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="No. Form" name="customer" class="form-control" required="required" value="<?=$o->customer?>">
								<input type="hidden" placeholder="No. Form" name="customer_id" class="form-control" required="required" value="<?=$o->customer_id?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Catatan
							</label>
							<div class="col-sm-8">
								<textarea class="form-control" name="catatan"><?=$o->catatan?></textarea>
							</div>
						</div>
                    </div>
                    <div class="col-md-6">
                    	<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								No. S.O
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="No. S.O" name="so" class="form-control" required="required" value="<?=$o->so?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Tipe Kendaraan
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="Tipe Kendaraan" name="kendaraan" class="form-control">
							</div>
						</div>
						<div class="form-group">
						<label class="col-sm-4 control-label" for="inputPassword3">
							Dikirim Dari
						</label>
						<div class="col-sm-8">
							<input type="text" placeholder="No. Form" name="gudang" class="form-control"  value="<?=$o->gudang?>">
							<input type="hidden" placeholder="No. Form" name="gudang_id" class="form-control"  value="<?=$o->gudang_id?>">
						</div>
					</div>
				</div>
				</fieldset>
				<div class="row">
					<div class="col-sm-12">
						<table id="table" class="table table-striped">
							<thead>
								<tr>
									<th width="5%"> No. </th>
									<th width="20%"> Kode </th>
									<th width="30%"> Nama Barang </th>
									<th width="10%">Jumlah</th>
									<th width="30%">Keterangan</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$i=1;foreach($order_list->result() as $ol): ?>
								<tr>
									<td><?=$i++?></td>
									<td><?=$ol->kode_barang?></td>
									<input type="hidden" name="kode_barang[]" class="form-control text-right" value="<?=$ol->kode_barang?>">
									<td><?=$ol->deskripsi?></td>
									<input type="hidden" name="deskripsi[]" class="form-control text-right" value="<?=$ol->deskripsi?>">
									<td class="text-right"><?=$ol->jumlah?></td>
									<input type="hidden" name="jumlah[]" class="form-control text-right" value="<?=$ol->jumlah?>">
									<td class="text-right"><input type="text" name="keterangan" class="form-control"></td>
									</tr>
								<?php endforeach;
								?>
							</tbody>
						</table>
						
								
					</div>
				</div>
				<hr/>
				<div class="row">
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
				</div>
				<div class="row">
					<button type="submit" id="btnSubmit" class="btn btn-lg btn-primary hidden-print pull-right" style="margin-right:15px;">
						Submit<i class="fa fa-check"></i>
					</button>
				</div>
<?php endforeach;?>
<script type="text/javascript" src="<?=assets_url('vendor/bootstrap-datepicker/bootstrap-datepicker.min.js')?>"></script>
