<?php foreach ($order->result() as $o) :?><div class="row">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								No. Retur
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="No. Retur" name="no" class="form-control" value="<?=$last_id.'/RET-I/GSM/'.monthRomawi(date('m')).'/'.date('Y')?>" required="required">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Tgl. Retur
							</label>
							<div class="col-sm-8">
								<div id="tanggal_faktur" class="input-append date success no-padding">
                                  <input type="text" class="form-control" name="tanggal_transaksi" required>
                                  <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                                </div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Supplier
							</label>
							<div class="col-sm-8">
								<input type="text" name="up" value="<?=$o->kontak?>" class="form-control" readonly>
								<input type="hidden" name="kontak_id" value="<?=$o->kontak_id?>" class="form-control" readonly>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Mata Uang
							</label>
							<div class="col-sm-8">
								<input type="text" name="up" value="<?=$o->kurensi?>" class="form-control" readonly>
								<input type="hidden" name="kurensi_id" value="<?=$o->kurensi_id?>" class="form-control" readonly>
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
								No. PO
							</label>
							<div class="col-sm-8">
								<input type="text" name="po" value="<?=$o->po?>" class="form-control" readonly>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Tanggal Penerimaan Barang
							</label>
							<div class="col-sm-8">
								<div id="tanggal_pengiriman" class="input-append date success no-padding">
                                  <input type="text" class="form-control" name="tanggal_pengiriman" value="<?= $tgl_terima ?>" disable="disable">
                                  <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                                </div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Diretur Dari
							</label>
							<div class="col-sm-8">
								<input type="text" name="up" value="<?=$o->gudang?>" class="form-control" readonly>
								<input type="hidden" name="gudang_id" value="<?=$o->gudang_id?>" class="form-control" readonly>
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
							<th width="5%"> No. </th>
							<th width="15%"> Kode Barang </th>
							<th width="15%"> Nama Barang </th>
							<th width="35%"> Deskripsi & Catatan</th>
							<th width="10%">Diterima</th>
							<th width="10%">Diretur</th>
							<th width="10%"> Satuan </th>
						</tr>
					</thead>
					<tbody>
					<?php $i=1;foreach($order_list->result() as $ol): ?>
						<tr>
							<td><?=$i++?></td>
							<td><?=getValue('kode', 'barang', array('id'=>'where/'.$ol->barang_id))?></td>
							<input type="hidden" name="kode_barang[]" class="form-control text-right" value="<?=$ol->barang_id?>">
							<td><?=getValue('title', 'barang', array('id'=>'where/'.$ol->barang_id))?></td>
							<td><textarea name="deskripsi[]"><?=getValue('title', 'barang', array('id'=>'where/'.$ol->barang_id))?></textarea></td>
							<td class="text-right"><?=$ol->jumlah?></td>
							<input type="hidden" name="diterima[]" class="form-control text-right" value="<?=$ol->jumlah?>" id="">
							<td class="text-right"><input type="text" name="diretur[]" class="form-control text-right" value="<?=$ol->jumlah?>" id="jumlah<?=$i?>"></td>
							
							<td><?=getValue('title', 'satuan', array('id'=>'where/'.$ol->satuan_id))?></td>
							<input type="hidden" name="satuan[]" class="form-control text-right" value="<?=$ol->satuan_id?>">
						</tr>
					<?php endforeach;?>
					</tbody>
				</table>
			</div>
			<div class="row" id="btnSubmit">
					<div class="col-md-12">
						<button type="submit"  class="btn btn-lg btn-primary hidden-print pull-right">
							Submit <i class="fa fa-check"></i>
						</button>
					</div>
				</div>
		</div>
	</div>
<?php endforeach;?>

<script type="text/javascript" src="<?=assets_url('vendor/bootstrap-datepicker/bootstrap-datepicker.min.js')?>"></script>
<script type="text/javascript">
	$(document).ready(function() {

    $('.input-append.date')
        .datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd-mm-yyyy"
        });
    });
</script>