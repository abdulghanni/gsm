<!-- start: PAGE TITLE -->
<section id="page-title">
	<div class="row">
		<div class="col-sm-8">
			<h1 class="mainTitle"><?= ucwords($module.' '.$file_name)?></h1>
			<span class="mainDescription"></span>
		</div>
		<ol class="breadcrumb">
			<li>
				<span>Pages</span>
			</li>
			<li class="active">
				<span><a href="<?=base_url($module.'/'.$file_name)?>">order</a></span>
			</li>
			<li>
				<span><a href="<?=base_url($module.'/'.$file_name.'/input')?>">input</a></span>
			</li>
		</ol>
	</div>
</section>
<!-- end: PAGE TITLE -->
<!-- start: INVOICE -->
<div class="container-fluid container-fullw bg-white">
<!--form role="form" action="<?= base_url($module.'/'.$file_name.'/add')?>" method="post" class="form-horizontal" id="form-so"-->
<?php echo form_open_multipart(base_url($module.'/'.$file_name.'/add'), array('id'=>'form-so', 'class'=>'form-horizontal'))?>
	<div class="row">
		<div class="col-md-12">
			<div class="invoice">
				<div class="row invoice-logo">
					<div class="col-sm-6">
						<img alt="" src="<?= assets_url('images/your-logo-here.png')?>">
					</div>
					<div class="col-sm-6">
						<p class="text-dark">
							#<?=date('Ymd',strtotime('now')).'-'.$last_id?> / <?=dateIndo(date('Y-m-d',strtotime('now')))?> <small class="text-light"></small>
							<input type="hidden" name="no" value="<?=date('Ymd',strtotime('now')).$last_id?>">
						</p>
					</div>
				</div>
				<hr>
				<input type="hidden" id="ppn_val" value="<?=$ppn_val?>">
	<input type="hidden" id="pph22_val" value="<?=$pph22_val?>">
	<input type="hidden" id="pph23_val" value="<?=$pph23_val?>">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Kepada
							</label>
							<div class="col-sm-7">
								<?php 
			                    	$js = 'class="select2" style="width:100%" id="kontak_id"';
			                    	echo form_dropdown('kontak_id', $options_kontak,'',$js); 
			                  	?>
							</div>
							<div class="col-md-1">
			                  	<button type="button" class="btn btn-primary btn-xs" style="margin-left: -15px" title="Tambah Customer Baru" data-toggle="modal" data-target="#modalKontak"><i class="fa fa-plus"></i></button>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Up.
							</label>
							<div class="col-sm-8">
								<div id="up">
									<input type="text" placeholder="Up" name="up" id="" class="form-control" required="required">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Alamat
							</label>
							<div class="col-sm-8">
								<select id="alamat" class="select2" style="width:100%" name="alamat">
									<option value="">-- Pilih Alamat Customer --</option>
								</select>
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
								<textarea class="form-control" name="catatan"></textarea>
							</div>
						</div>

                    </div>

                    <div class="col-md-6">
                    	<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Dikirim Dari
							</label>
							<div class="col-sm-8">
								<select class="select2" name="gudang_id" style="width:100%">
								<option value="0">-- Pilih Gudang --</option>
								<?php 
                                	foreach($gudang as $g):?>
                                	<option value="<?=$g->id?>"><?=$g->title?></option>
                              	<?php endforeach;?>
                              	</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Tgl. SO
							</label>
							<div class="col-sm-8">
								<div id="tanggal_transaksi" class="input-append date success no-padding">
                                  <input type="text" class="form-control" name="tanggal_transaksi" required>
                                  <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                                </div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								No. SO
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="No. SO" name="so" class="form-control" value="<?=$last_id.'/SO-I/GSM/'.monthRomawi(date('m')).'/'.date('Y')?>" required="required">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Project
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="Project" name="project" class="form-control" value="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Term
							</label>
							<div class="col-sm-8">
								<div class="clip-radio radio-primary">
									<?php foreach($metode as $m):?>
									<input type="radio" id="metode<?=$m->id?>" name="metode_pembayaran_id" value="<?=$m->id?>" <?= ($m->title == 'Cash')?'checked':'';?>>
									<label for="metode<?=$m->id?>">
										<?=$m->title?>
									</label>
									<?php endforeach;?>
								</div>
							</div>
						</div>
						<div id="kredit" style="display:none">
							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputPassword3">
									Tempo Pembayaran
								</label>
								<div class="col-sm-2">
									<input type="text" placeholder="" name="lama_angsuran_1" id="lama_angsuran_1" class="form-control text-right" value="0">
								</div>
								<div class="col-sm-6">
									<select class="select2" name="lama_angsuran_2" id="lama_angsuran_2" style="width:100%">
									<option value="0">-- Pilih Lama Angsuran --</option>
									<option value="hari">Hari</option>
									<option value="bulan">Bulan</option>
									<option value="tahun">Tahun</option>
	                              	</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Komponen Pajak
							</label>
							<div class="col-sm-6">
								<div id="pajak">
								<?php foreach($pajak_komponen as $p):?>
								<div class="checkbox clip-check check-primary checkbox-inline">
									<input type="checkbox" id="kpajak<?=$p->id?>" value="<?=$p->id?>" class="<?=$p->title?>" name="pajak_komponen_id[]">
									<label for="kpajak<?=$p->id?>">
										<?=$p->title?>
									</label>
								</div>
								<?php endforeach;?>
								</div>
							</div>
						</div>
                    </div>
				</div>
				<button id="btnAdd" type="button" class="btn btn-green" onclick="addRow('table')">
                    <?= lang('add').' '.lang('item') ?> <i class="fa fa-plus"></i>
                </button>
                <button id="btnRemove" type="button" class="btn btn-red" onclick="deleteRow('table')" style="display:none">
                    <?= 'Remove' ?> <i class="fa fa-remove"></i>
                </button>
				<div class="row">
					<div class="col-sm-12">
					<div class="table-responsive">
						<table id="table" style="width: 100%;" class="table table-striped">
							<thead>
								<tr>
									<th width="5%"> # </th>
									<th width="5%"> No. </th>
									<th width="10%"> Kode Barang </th>
									<th width="10%"> SS Barang </th>
									<th width="20%"> Deskripsi </th>
									<th width="20%"> Catatan </th>
									<th width="5%">Quantity</th>
									<th width="10%"> Satuan </th>
									<th width="15%"> Harga </th>
									<th width="5%">Disc(%)</th>
									<th width="15%"> Sub Total </th>
									<th width="5%" class="text-center"> Inc PPN </th>
									<th width="5%" class="text-center"> Attachment </th>
								</tr>
							</thead>
							<tbody>
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
								<li class="list-group-item" id="totalPPN">
									<div class="row">
										<div class="col-md-4">
										PPN
										</div>
										<div class="col-md-6 pull-right">
										<input type="text" id="totalPajak" name="total-ppn" value="0" class="form-control text-right">
										</div>
									</div>
								</li>
								<li class="list-group-item" id="totalPPH22">
									<div class="row">
										<div class="col-md-4">
										PPH 22
										</div>
										<div class="col-md-6 pull-right">
										<input type="text" id="totalp2" name="total-pph22" value="0" class="form-control text-right">
										</div>
									</div>
								</li>
								<li class="list-group-item" id="totalPPH23">
									<div class="row">
										<div class="col-md-4">
										PPH 23
										</div>
										<div class="col-md-6 pull-right">
										<input type="text" id="totalp3" name="total-pph23" value="0" class="form-control text-right">
										</div>
									</div>
								</li>
						
								<li class="list-group-item">
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
										Diskon
										</div>
										<div class="col-md-6 pull-right">
										<input type="text" name="total-diskon" id="total-diskon" class="form-control text-right" value="0" readonly>
										</div>
									</div>
								</li>
								<li class="list-group-item">
									<div class="row">
										<div class="col-md-4">
										Total
										</div>
										<div class="col-md-6 pull-right">
										<input type="text" class="form-control text-right" id="total" value="0" readonly="readonly">
										</div>
									</div>
								</li>
								
								<li class="list-group-item">
									<div class="row">
										<div class="col-md-4">
										Total+Pajak
										</div>
										<div class="col-md-6 pull-right">
										<input type="text" class="form-control text-right" id="totalpluspajak" value="0" readonly="readonly">
										</div>
									</div>
								</li>
								
								<div id="total_angsuran" style="display:none">
									<li class="list-group-item">
										<div class="row">
											<div class="col-md-6">
											Uang Muka
												<div class="checkbox clip-check check-primary checkbox-inline">
													<input type="checkbox" id="dp-persen-cek" value="" name="row">
													<label for="dp-persen-cek">
														Persen
													</label>
												</div>
											</div>
											<div id="dp-persen">
												<div class="col-md-4">
												<input type="text" name="dibayar" id="dibayar" class="form-control text-right" value="0">
												</div>
												<div class="col-md-1">
												%
												</div>
											</div>
											<div id="dp-nominal">
												<div class="col-md-6">
													<input type="text" name="dibayar-nominal" id="dibayar-nominal" class="form-control text-right" value="0">
												</div>
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
							<button type="submit" value="Save as Draft" name="btnDraft" class="btn btn-lg btn-green hidden-print pull-right" style="">
								Save Draft <i class="fa fa-save"></i>
							</button>
							<!--input type="submit" value="Save as Draft" name="btnDraft" class="btn btn-lg btn-green hidden-print pull-right" style=""-->
						</div>
						<div class="col-md-1"></div>
						<div class="col-md-2">
							<button type="submit" value="Submit" name="btnDraft"  class="btn btn-lg btn-primary hidden-print pull-right">
								Submit Request <i class="fa fa-check"></i>
							</button>
							<!--button type="submit" value="Submit" name="btnDraft" class="btn btn-lg btn-primary hidden-print pull-right" style="">Btn</button-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</form>
<!-- end: INVOICE -->


<div class="modal fade" id="modalKontak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Modal title</h4>
			</div>
			<div class="modal-body">
			<form id="form_kontak">
				<input type="hidden" name="jenis_id" value="2">
				<div class="row form-row">
                    <div class="col-sm-12">
                    <fieldset>
                    <legend>Info Identitas</legend>
                        <div class="form-body">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label col-sm-3"><?= lang('code')?></label>
                                <div class="col-sm-7">
                                    <input name="kode" placeholder="" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Nama</label>
                                <div class="col-sm-7">
                                    <input name="title" placeholder="" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Tipe</label>
                                <div class="col-sm-7">
                                    <select name="tipe_id" class="select2" style="width:100%">
                                        <option value="">-- Pilih Tipe Kontak --</option>
                                        <?php foreach($tipe->result() as $t):?>
                                            <option value="<?=$t->id?>"><?=$t->title?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label col-sm-3">UP</label>
                                <div class="col-sm-7">
                                    <input name="up[]" placeholder="" class="form-control" type="text"><br/>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label col-sm-3">Catatan</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="catatan"></textarea>
                                </div>
                            </div>
                        </div>
                        </div>
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                    <fieldset>
                    <legend>Info Kontak</legend>
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-sm-5">Email</label>
                                <div class="col-sm-7">
                                    <input name="email" placeholder="" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-5">Fax</label>
                                <div class="col-sm-7">
                                    <input name="fax" placeholder="" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-5">Telepon</label>
                                <div class="col-sm-7">
                                    <input name="telepon[]" placeholder="" class="form-control" type="text"><br/>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-5">Alamat</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" name="alamat[]"></textarea><br/>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    </div>
                    <div class="col-sm-6">
                        <fieldset>
                            <legend>Info Finansial</legend>
                            <div class="form-group">
                                <label class="control-label col-sm-5">NPWP</label>
                                <div class="col-sm-7">
                                    <input name="npwp" placeholder="" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-5">No. Rekening</label>
                                <div class="col-sm-7">
                                    <input name="no_rekening" placeholder="" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-5">Nama Bank</label>
                                <div class="col-sm-7">
                                    <input name="bank" placeholder="" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-5">Atas Nama</label>
                                <div class="col-sm-7">
                                    <input name="a_n" placeholder="" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-5">Alamat Pajak</label>
                                <div class="col-sm-7">
                                    <input name="alamat_pajak" placeholder="" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-5">Acc</label>
                                <div class="col-sm-7">
                                    <input name="acc" placeholder="" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </fieldset>
                    </div> 
                </div>
            </form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary btn-o" data-dismiss="modal">
					Close
				</button>
				<button type="button" class="btn btn-primary" onclick="saveKontak()">
					Save changes
				</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?=assets_url('vendor/jquery/jquery.min.js')?>"></script>
<script type="text/javascript">
function addRow(tableID){
	var table=document.getElementById(tableID);
	var rowCount=table.rows.length;
	$.ajax({
            url: '/gsm/sales/order/add_row/'+rowCount,
            success: function(response){
	         	$("#"+tableID).find('tbody').append(response);
	         },
	         dataType:"html"
        });
}

function deleteRow(tableID){try{var table=document.getElementById(tableID);var rowCount=table.rows.length;for(var i=0;i<rowCount;i++){var row=table.rows[i];var chkbox=row.cells[0].childNodes[0];if(null!=chkbox&&true==chkbox.checked){table.deleteRow(i);rowCount--;i--;}}}catch(e){alert(e);}}

$('#dibayar, #biaya_pengiriman, #dibayar-nominal').keyup(function(){
    	hitungTotal();
    });

$("input:checkbox:not(:checked)").each(function() {
	    var total = "#total"+$(this).attr("class");
	    $(total).hide();
	});

	$("input:checkbox").click(function(){
	    var total = "#total"+$(this).attr("class");
	    $(total).toggle();
	    hitungTotal();
	});

$("#dp-persen-cek:not(:checked)").each(function() {
	     $("#dp-persen").hide("slow");
	     $("#dp-nominal").show("slow");
	});

	$("#dp-persen-cek").click(function(){
	     $("#dp-persen").toggle("slow");
	     $("#dp-nominal").toggle("slow");
	     hitungTotal();
	});

function hitungTotal()
{
	if($('#dp-persen-cek').is(':checked')){
		$('#dibayar-nominal').val(parseFloat(0));
	}else{
		$('#dibayar').val(parseFloat(0));
	}

    	diBayar = parseFloat($('#dibayar').val().replace(/,/g,"")),
    	diBayarNominal = parseFloat($('#dibayar-nominal').val().replace(/,/g,"")),
    	biayaPengiriman = parseFloat($('#biaya_pengiriman').val().replace(/,/g,"")),
    	jmlDisc = 0,
    	total = 0;
    $('.subdisc').each(function (index, element) {
        jmlDisc = jmlDisc + parseFloat($(element).val().replace(/,/g,""));
    });


    $('.subtotal').each(function (index, element) {
        total = total + parseFloat($(element).val().replace(/,/g,""));
    });

    /*
    if($('#kpajak1').is(':checked')){
		parseFloat($('#totalPajak').val(total*(10/100)));
	}else{
		$('#totalPajak').val(parseFloat(0));
	}
	*/
	if($('#kpajak2').is(':checked')){
		$('#totalp2').val(parseFloat(total*(2/100)));
	}else{
		$('#totalp2').val(parseFloat(0));
	}
	if($('#kpajak3').is(':checked')){
		$('#totalp3').val(parseFloat(total*(2/100)));
	}else{
		$('#totalp3').val(parseFloat(0));
	}

	p1 = parseFloat($("#totalPajak").val().replace(/,/g,"")),
	p2 = parseFloat($("#totalp2").val().replace(/,/g,"")),
    p3 = parseFloat($("#totalp3").val().replace(/,/g,"")),

    total = total+biayaPengiriman+exc;
    totalpluspajak = total+p1+p2+p3;
    totalminuspajak = total-p1-p2-p3;
    diBayar = totalpluspajak * (diBayar/100);
    $('#total-diskon').val(addCommas(parseFloat(jmlDisc).toFixed(2)));
    $('#total').val(addCommas(parseFloat(totalminuspajak).toFixed(2)));
    
    $('#totalpluspajak').val(addCommas(parseFloat(total).toFixed(2)));
    var saldo = total-diBayar-diBayarNominal;
    $('#saldo').val(addCommas(parseFloat(saldo).toFixed(2)));	
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