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
			<li class="active">
				<span><a href="<?= base_url($module.'/'.$file_name)?>"><?=$main_title?></a></span>
			</li>
			<li>
				<span><a href="<?= base_url($module.'/'.$file_name.'/input')?>">input</a></span>
			</li>
		</ol>
	</div>
</section>
<!-- end: PAGE TITLE -->
<!-- start: INVOICE -->
<div class="container-fluid container-fullw bg-white">
<form role="form" action="<?= base_url($module.'/'.$file_name.'/add')?>" method="post" class="form-horizontal" id="form-pr">
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
                                	foreach($users->result() as $u):?>
                                	<option value="<?=$u->id?>"><?=$u->full_name?></option>
                              	<?php endforeach;?>
                              	</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								No. Purchase Request
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="No. Purchase Request" name="no" value="<?=$last_id.'/PR-I/GSM/I/'.date('Y')?>" class="form-control" required="required">
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
								Dikirim Ke
							</label>
							<div class="col-sm-8">
								<select class="select2" name="gudang_id" style="width:100%">
								<option value="0">-- Pilih Gudang Pengiriman --</option>
								<?php 
                                	foreach($gudang as $g):?>
                                	<option value="<?=$g->id?>"><?=$g->title?></option>
                              	<?php endforeach;?>
                              	</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Keperluan
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="Keperluan" name="keperluan" class="form-control" required="required">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Tgl. Digunakan
							</label>
							<div class="col-sm-8">
								<div id="tanggal_transaksi" class="input-append date success no-padding">
                                  <input type="text" class="form-control" name="tanggal_digunakan" required>
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
									<?php foreach($jenis->result() as $j):?>
										<option value="<?=$j->id?>"><?=$j->title?></option>
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
						<div id="panel-total" class="panel-body col-md-5 pull-right" style="display:none">
							<ul class="list-group">
								<!--
								<li class="list-group-item">
									<div class="row">
										<div class="col-md-4">
										Total Pajak
										</div>
										<div class="col-md-6 pull-right">
										<input type="text" id="totalPajak" value="0" class="form-control text-right" readonly="readonly">
										</div>
									</div>
								</li>
								-->
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
										<input type="text" class="form-control text-right" id="total" value="0" readonly="readonly">
										</div>
									</div>
								</li>
								<!--
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
								-->
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
					<div class="row" id="btnSubmit" style="display:none">
						<div class="col-md-7"></div>
						<div class="col-md-2">
						<button type="button" id="btnDraft" class="btn btn-lg btn-green hidden-print pull-right" style="">
							Save as Draft <i class="fa fa-save"></i>
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
			</div>
		</div>
	</div>
</div>


</form>
<!-- end: INVOICE -->
<script type="text/javascript" src="<?=assets_url('vendor/jquery/jquery.min.js')?>"></script>
<script type="text/javascript">
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
	/*var cell1=row.insertCell(0);
	var element1=document.createElement("input");
	element1.type="checkbox";
	element1.name="chkbox[]";
	element1.className="checkbox1";
	cell1.appendChild(element1);

	var cell2=row.insertCell(1);
	cell2.innerHTML=rowCount+1-1;

	var cell3=row.insertCell(2);
	cell3.innerHTML = "<select name='kode_barang[]' class='select2' id="+'barang_id'+rowCount+" style='width:100%'><?php for($i=0;$i<sizeof($barang);$i++):?><option value='<?php echo $barang[$i]['id']?>'><?php echo $barang[$i]['kode'].' - '.$barang[$i]['title']?></option><?php endfor;?></select>";  

	var cell4=row.insertCell(3);
	cell4.innerHTML = '<input name="deskripsi[]" value="0" type="text" class="form-control" required="required" id="deskripsi'+rowCount+'">';

	var cell5=row.insertCell(4);
	cell5.innerHTML = '<input name="jumlah[]" value="0" type="text" class="form-control jumlah text-right" required="required" id="jumlah'+rowCount+'">';

	var cell6=row.insertCell(5);
	cell6.innerHTML = "<select id="+'satuanlist'+rowCount+" name='satuan[]' class='select2' style='width:100%'><?php for($i=0;$i<sizeof($satuan);$i++):?><option value='<?php echo $satuan[$i]['id']?>'><?php echo $satuan[$i]['title']?></option><?php endfor;?></select><input type='text' value='0' id="+'satuanlist_num'+rowCount+"> ";

	var cell7=row.insertCell(6);
	cell7.innerHTML = '<input name="harga[]" value="0" type="text" class="form-control harga text-right" required="required" id="harga'+rowCount+'"><input name="disc[]"  style="display:none" value="0" type="hidden" class="form-control text-right" required="required" id="disc'+rowCount+'">';  

	var cell8=row.insertCell(7);
	cell8.innerHTML = '<input name="sub_total[]" type="text" class="form-control subtotal text-right" required="required" id="subtotal'+rowCount+'" readonly>';

	var cell9=row.insertCell(8);
	cell9.innerHTML = '<input name="pajak[]" value="0" type="text" class="form-control text-right" required="required" id="pajak'+rowCount+'">';
	//var a = $('input[name="fraksi"]').val();alert(a);
	$('#jumlah'+rowCount).on('click', function () {
        if($('input[name="fraksi"]').is(":checked")){
        	$('#form_fraksi')[0].reset();
			$('[name="fraksi_id"]').val(rowCount);
			$('.sf-1').attr('id', 'sf-1'+rowCount);
			$('.tf-1').attr('id', 'tf-1'+rowCount);
        	showFModal(rowCount);
        }
    });
function showFModal(id){
	
	$('#modal_fraksi').modal('show');
}

$('#btnFraksi').on('click', function () {
		$('#modal_fraksi').modal('hide');
    });

	$("#barang_id"+rowCount).change(function(){
        var id = $(this).val();
         $.ajax({
            type: "GET",
            dataType: "JSON",
            url: '../order/get_nama_barang/'+id,
            success: function(data) {
                $('#deskripsi'+rowCount).val(data);
            }
        });
         $.ajax({
            type: 'POST',
            url: '/gsm/purchase/request/get_satuan/'+id,
            data: {id : id},
            success: function(data) {
                $('#satuan'+rowCount).html(data);
            }
        });

    })
    .change();
    
	$("#subTotalPajak").append('<input name="subpajak[]" value="0" type="hidden" class="subpajak" id="subpajak'+rowCount+'">')
	$("#harga"+rowCount).add("#jumlah"+rowCount).add("#disc"+rowCount).add("#pajak"+rowCount).keyup(function() {
		hitung();
    });

    $('.harga').maskMoney({allowZero:true});
    $('#dibayar, #biaya_pengiriman, #tf-1, #tf-2, #tf-3').keyup(function(){
    	hitung();
    });
    function hitung()
    {
    	var a = parseFloat($('#jumlah'+rowCount).val()),
    		bunga = parseFloat($('#bunga').val()),
        	b = parseFloat($('#harga'+rowCount).val().replace(/,/g,"")).toFixed(2),
        	c = parseFloat($('#disc'+rowCount).val()),
        	p = parseFloat($('#pajak'+rowCount).val()).toFixed(2),
        	diBayar = parseFloat($('#dibayar').val().replace(/,/g,"")),
        	biayaPengiriman = parseFloat($('#biaya_pengiriman').val().replace(/,/g,"")),
        	lama_angsuran= parseInt($('#lama_angsuran_1').val()),
        	d = (a*b)*(c/100),//jumlah diskon
       		val = (a*b)-d,
        	subPajak = val*(p/100),//jumlah pajak
        	jmlPajak = 0,
        	total = 0;
        	if($('input[name="fraksi"]').is(":checked")){
        		tf_1 = parseFloat($('#tf-1').val());
				tf_2 = parseFloat($('#tf-2').val());
				tf_3 = parseFloat($('#tf-3').val());
				sf_1_num = parseFloat($("#sf1-num").val());
				sf_2_num = parseFloat($("#sf2-num").val());
				sf_3_num = parseFloat($("#sf3-num").val());
				sf_3_num = parseFloat($("#sf3-num").val());
				satuan_utama_num = parseFloat($('#satuanlist_num'+rowCount).val());
				b = parseFloat($('#harga'+rowCount).val().replace(/,/g,"")).toFixed(2),
				//$('#satuan'+id).select2().select2('val',tf_1);
				v1 = tf_1*(sf_1_num/satuan_utama_num)*b,
				v2 = tf_2*(sf_2_num/satuan_utama_num)*b,
				v3 = tf_3*(sf_3_num/satuan_utama_num)*b,
				val = parseFloat(v1) + parseFloat(v2) + parseFloat(v3);//alert(v1+'='+tf_1+'*('+sf_1_num+'/'+satuan_utama_num+'*'+b);
        		$('#subtotal'+rowCount).val(addCommas(parseFloat(val).toFixed(2)));
        	}else{
        		$('#subtotal'+rowCount).val(addCommas(parseFloat(val).toFixed(2)));
        	}
        
        $('#subpajak'+rowCount).val(subPajak);
        $('.subpajak').each(function (index, element) {
            jmlPajak = jmlPajak + parseInt($(element).val());
        });
        $('.subtotal').each(function (index, element) {
            total = total + parseInt($(element).val().replace(/,/g,""));
        });
        total = total+biayaPengiriman;
        totalPlusBunga = (totalpluspajak-diBayar)*(bunga/100);
        totalPlusBunga = (totalpluspajak-diBayar)+totalPlusBunga;
        biayaAngsuran = totalPlusBunga/lama_angsuran;
        totalpluspajak = total + jmlPajak;
        $('#totalPajak').val(addCommas(parseFloat(jmlPajak).toFixed(2)));
        $('#total').val(addCommas(parseFloat(total).toFixed(2)));
        $('#totalpluspajak').val(addCommas(parseFloat(totalpluspajak).toFixed(2)));
        var saldo = totalpluspajak-diBayar;
        $('#saldo').val(addCommas(parseFloat(saldo).toFixed(2)));
       	$('#totalplusbunga').val(addCommas(parseFloat(totalPlusBunga).toFixed(2)));
       	$('#biaya_angsuran').val(addCommas(parseFloat(biayaAngsuran).toFixed(2)))
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
	}
	function deleteRow(tableID){try{var table=document.getElementById(tableID);var rowCount=table.rows.length;for(var i=0;i<rowCount;i++){var row=table.rows[i];var chkbox=row.cells[0].childNodes[0];if(null!=chkbox&&true==chkbox.checked){table.deleteRow(i);rowCount--;i--;}}}catch(e){alert(e);}}
	*/
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