<!-- start: PAGE TITLE -->
<section id="page-title">
	<div class="row">
		<div class="col-sm-8">
			<h1 class="mainTitle"><?=$main_title?> - Draft</h1>
			<span class="mainDescription"></span>
		</div>
		<ol class="breadcrumb">
			<li>
				<span>Pages</span>
			</li>
			<li class="active">
				<span><a href="<?= base_url($module.'/'.$file_name)?>"><?=$main_title?></a></span>
			</li>
			<li>
				<span><a href="<?= base_url($module.'/'.$file_name.'/input')?>">Draft</a></span>
			</li>
		</ol>
	</div>
</section>
<!-- end: PAGE TITLE -->
<!-- start: INVOICE -->
<div class="container-fluid container-fullw bg-white">
<form role="form" action="<?= base_url($module.'/'.$file_name.'/add')?>" method="post" class="form-horizontal" id="form-pr">
	<input type="hidden" name="id" value=<?=$id?>>
	<div class="row">
		<div class="col-md-12">
			<div class="invoice">
				<div class="row invoice-logo">
					<div class="col-sm-6">
						<img alt="" src="<?= assets_url('images/your-logo-here.png')?>">
					</div>
					<div class="col-sm-6">
						<p class="text-dark">
							#<?=$last_id.'/PR-I/GSM/I/'.date('Y')?><small class="text-light"></small>
						</p>
					</div>
				</div>
				<hr>
				<?php if($request->created_by == sessId()): ?>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Diajukan Kepada
							</label>
							<div class="col-sm-8">
								<select class="select2" name="diajukan_ke" style="width:100%">
								<option value="0">-- Pilih Approver --</option>
								<?php 
                                	foreach($users->result() as $u):
                                	$selected = ($user_app_lv1 == $u->id) ? 'selected="selected"' : '';
                                ?>
                                	<option value="<?=$u->id?>" <?=$selected?>><?=$u->full_name?></option>
                              	<?php endforeach;?>
                              	</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								No. Purchase Request
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="No. Purchase Request" name="no" value="<?=$request->no?>" class="form-control" required="required">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Mata Uang
							</label>
							<div class="col-sm-8">
								<div class="clip-radio radio-primary">
									<?php foreach($kurensi as $k):?>
									<input type="radio" id="kurensi<?=$k->id?>" name="kurensi_id" value="<?=$k->id?>" <?= ($k->id == 1)?'checked':'';?>>
									<label for="kurensi<?=$k->id?>">
										<?=$k->title.'('.$k->simbol.')'?>
									</label>
									<?php endforeach;?>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Catatan
							</label>
							<div class="col-sm-8">
								<textarea class="form-control" name="catatan"><?=$request->catatan?></textarea>
							</div>
						</div>
                    </div>

                    <div class="col-md-6">
                    	<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Dikirim Ke
							</label>
							<div class="col-sm-8">
								<select class="select2" name="gudang_id" style="width:100%">
								<option value="0">-- Pilih Gudang Pengiriman --</option>
								<?php 
                                	foreach($gudang as $g):
                                		$selected = ($request->gudang_id == $g->id) ? 'selected="selected"' : '';
                                ?>
                                	<option value="<?=$g->id?>" <?=$selected?>><?=$g->title?></option>
                              	<?php endforeach;?>
                              	</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Keperluan
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="Keperluan" name="keperluan" value="<?=$request->keperluan?>" class="form-control" required="required">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Tgl. Digunakan
							</label>
							<div class="col-sm-8">
								<div id="tanggal_transaksi" class="input-append date success no-padding">
                                  <input type="text" class="form-control" name="tanggal_digunakan" value="<?=date('d-m-Y', strtotime($request->tanggal_digunakan))?>" required>
                                  <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                                </div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Jenis Barang
							</label>
							<div class="col-sm-8">
								<select class="select2" name="jenis_barang_id">
									<option value="0">-- Pilih Jenis Barang --</option>
									<?php foreach($jenis->result() as $j):
										$selected = ($request->jenis_barang_id == $j->id)?'selected="selected"':'';
									?>
										<option value="<?=$j->id?>" <?=$selected?>><?=$j->title?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
                    </div>
				</div>
				<button id="btnAdd" type="button" class="btn btn-green" onclick="addRow('table')">
                    <?= lang('add').' '.lang('item') ?> <i class="fa fa-plus"></i>
                </button>
                <button id="remove" class="btn btn-danger" type="button" style="display:none">Hapus <i class="fa fa-remove"></i></button>

				<div class="row pull-right">
					<div class="checkbox clip-check check-primary checkbox-inline">
						<input type="checkbox" id="fraksi" value="1" name="fraksi">
						<label for="fraksi">
							Fraksi
						</label>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
					
					<div class="table-responsive">
						<table id="table" class="table table-striped">
							<thead>
								<tr>
									<th width="1%"> # </th>
									<th width="1%"> No. </th>
									<th width="8%"> SS Barang </th>
									<th width="20%"> Kode Barang </th>
									<th width="20%"> Deskripsi </th>
									<th width="5%">Quantity</th>
									<th width="10%"> Satuan </th>
									<th width="10%"> Harga </th>
									<th width="5%"  style="display:none">Disc(%)</th>
									<th width="10%"> Sub Total </th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$totalpajak = $total = $biaya_angsuran = $totalplusbunga = $saldo = 0;
								$i=0;foreach($request_list->result() as $ol):
								$subtotal = $ol->jumlah*$ol->harga;
								$totalpajak = $totalpajak + ($subtotal * ($ol->pajak/100));
								$total = $total + $subtotal;
								$ss_link = base_url("uploads/barang/$ol->barang_id/$ol->photo");
             					$ss_headers = @get_headers($ss_link);
								$src = ($ss_headers[0] != 'HTTP/1.1 404 Not Found')?base_url("uploads/barang/$ol->barang_id/$ol->photo") : assets_url('assets/images/no-image-mid.png');
								$i++;
								?>
								<tr>
									<td>
										<div class="checkbox clip-check check-primary checkbox-inline">
											<input type="checkbox" id="row<?=$i?>" value="" class="cek" name="row">
											<label for="row<?=$i?>">
											</label>
										</div>
									</td>
									<td><?=$i?></td>
									<td><img height="100px" width="100px" src="<?=$src?>"></td>
									<td><?=$ol->kode_barang?></td><input type="hidden" value="<?=$ol->barang_id?>" name="kode_barang[]">
									<td><textarea class="form-control" name="deskripsi[]"><?=$ol->deskripsi?></textarea></td>
									<td class="text-right"><input type="text" id="jumlah<?=$i?>" class="form-control text-right jumlah" value="<?=$ol->jumlah?>" name="jumlah[]"></td>
									<td><?=$ol->satuan?></td><input type="hidden" name="satuan[]" value="<?=$ol->satuan_id?>">
									<td class="text-right"><input type="text" id="harga<?=$i?>" class="form-control text-right harga" value="<?= number_format($ol->harga, 2)?>" name="harga[]"></td>
									<td class="text-right"><input type="text" id="subtotal<?=$i?>" class="form-control text-right subtotal" value="<?= number_format($subtotal, 2)?>" name="subtotal"></td>

											<script>
												$("#jumlah<?=$i?>").add("#harga<?=$i?>").keyup(function() {
												var a = parseFloat($("#jumlah<?=$i?>").val()),
										        	b = parseFloat($("#harga<?=$i?>").val().replace(/,/g,"")).toFixed(2),
										       		val = (a*b),
										        	total = 0;
										        $("#subtotal<?=$i?>").val(addCommas(parseFloat(val).toFixed(2)));

										        $('.subtotal').each(function (index, element) {
										            total = total + parseFloat($(element).val().replace(/,/g,""));
										        });

										        total = total;
										        
										        $('#total').val(addCommas(parseFloat(total).toFixed(2)));
										    });
											</script>
								</tr>
									<?php endforeach;
										$totalpluspajak = $total+$totalpajak;
										$grandtotal = $totalpluspajak;								?>
									<div id="tb">
									</div>
							</tbody>
						</table>
					</div>
					</div>
				</div>
				<div class="row">
					<input type="hidden" name="dp" value="0">
					<div id="subTotalPajak"></div>
					<div class="row">
						<div id="panel-total" class="panel-body col-md-5 pull-right">
							<ul class="list-group">
								<li class="list-group-item"  style="display:none">
									<div class="row">
										<div class="col-md-4">
										Biaya Pengiriman
										</div>
										<div class="col-md-6 pull-right">
										<input type="text" name="biaya_pengiriman" id="biaya_pengiriman" class="form-control text-right" value="0">
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
								<div id="total_angsuran" style="display:none">
									<li class="list-group-item">
										<div class="row">
											<div class="col-md-4">
											Uang Muka
											</div>
											<div class="col-md-6 pull-right">
											<input type="text" name="dibayar" id="dibayar" class="form-control text-right" value="">
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
											<input type="text" name="biaya_angsuran" id="biaya_angsuran" class="form-control text-right" value="0">
											</div>
											<div class="col-md-2" id="angsuran" style="margin-left:-10px">
											</div>
										</div>
									</li>
									<li class="list-group-item">
										<div class="row">
											<div class="col-md-4">
											Total+Bunga Angsuran
											</div>
											<div class="col-md-6 pull-right">
											<input type="text" id="totalplusbunga" class="form-control text-right" value="0">
											</div>
										</div>
									</li>
									<li class="list-group-item">
									<div class="row">
										<div class="col-md-4">
										Saldo
										</div>
										<div class="col-md-6 pull-right">
										<input type="text" id="saldo" class="form-control text-right" value="0" readonly="readonly">
										</div>
									</div>
								</li>
								</div>
								
							</ul>
						</div>
					</div>
					<div class="row" id="btnSubmit">
						<div class="col-md-7"></div>
						<div class="col-md-2">
						<button type="button" id="btnDraft" class="btn btn-lg btn-green hidden-print pull-right" style="">
							Save Draft <i class="fa fa-save"></i>
						</button>
						</div>
						<div class="col-md-1">
						</div>
						<div class="col-md-2">
						<button type="submit"  class="btn btn-lg btn-primary hidden-print pull-right">
							Submit Request <i class="fa fa-check"></i>
						</button>
						</div>
					</div>
				</div>
				<?php else:
				echo 'Draft dibuat oleh '.getFullName($request->created_by);
				endif;
				?>
			</div>
		</div>
	</div>
</div>


</form>
<!-- end: INVOICE -->
<script type="text/javascript" src="<?=assets_url('vendor/jquery/jquery.min.js')?>"></script>
<script type="text/javascript">
$(document).ready(function() {
	$(".cek:not(:checked)").each(function() {
	    $("#remove").hide();
	});

	$(".cek:checkbox").click(function(){
	     $("#remove").show();
	});

	 $("#remove").on("click", function () {
        $('table tr').has('input[name="row"]:checked').remove();
        hitung();
    })
});
	function addRow(tableID){
	var table=document.getElementById(tableID);
	var rowCount=table.rows.length;
	$.ajax({
            url: '/gsm/purchase/request/add_row/'+rowCount,
            success: function(response){
	         	$("#"+tableID).find('tbody').append(response);
	         },
	         dataType:"html"
        });
	
}
	function addCommas(nStr)
    {
      nStr += '';
      x = nStr.split('.');
      x1 = x[0];
      x2 = x.length > 1 ? '.' + x[1] : '';
      var rgx = /(\d+)(\d{3})/;
      while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
      }
      return x1 + x2;
    }
</script>
<div class="modal fade" id="modal_fraksi" role="dialog">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Konversi Fraksi Satuan</h3>
            </div>
            <div class="modal-body form">
                <form class="form-horizontal" id="form_fraksi">
                <input type="hidden" value="" name="fraksi_id"/>
                <div class="form-body">
                	<div class="row">
	                    <div class="col-md-12">
	                        <div class="form-group">
	                            <label class="control-label col-md-3">Fraksi 1</label>
	                            <div class="col-md-3">
	                            <input type="text" class="form-control tf-1" value="0">
	                            </div>
	                            <div class="col-md-6">
	                                <?php 
	                                    $js = 'class="sf-1" style="width:100%" ';
	                                    echo form_dropdown('satuan', $options_satuan,'',$js); 
	                                ?>
	                            </div>
	                            <input type="text" id="sf1-num" value="0">
	                        </div>
	                        <div class="form-group">
	                            <label class="control-label col-md-3">Fraksi 2</label>
	                            <div class="col-md-3">
	                            <input type="text" class="form-control" id="tf-2" value="0">
	                            </div>
	                            <div class="col-md-6">
	                                <?php 
	                                    $js = 'class="select2" style="width:100%" id="sf-2"';
	                                    echo form_dropdown('satuan', $options_satuan,'',$js); 
	                                ?>
	                            </div>
	                            <input type="text" id="sf2-num" value="0">
	                        </div>
	                        <div class="form-group">
	                            <label class="control-label col-md-3">Fraksi 3</label>
	                            <div class="col-md-3">
	                            <input type="text" class="form-control" id="tf-3" value="0">
	                            </div>
	                            <div class="col-md-6">
	                                <?php 
	                                    $js = 'class="select2" style="width:100%" id="sf-3"';
	                                    echo form_dropdown('satuan', $options_satuan,'',$js); 
	                                ?>
	                            </div>
	                            <input type="text" id="sf3-num" value="0">
	                        </div>
	                    </div>
	                </div>
	            </div>
            </div>
            <div class="modal-footer">
                <input type="button" id="btnFraksi" class="btn btn-primary" value="ok">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="modal"></div>