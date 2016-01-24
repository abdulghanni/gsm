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
				<span><a href="<?= base_url($module.'/'.$file_name)?>">Terima Barang</a></span>
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
							#<?=date('Ymd',strtotime('now')).$last_id?> / <?=dateIndo(date('Y-m-d',strtotime('now')))?> <small class="text-light"></small>
							<input type="hidden" name="no" value="<?=date('Ymd',strtotime('now')).$last_id?>">
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
								<?php 
                                	$js = 'class="select2" style="width:100%" id="supplier_id"';
                                	echo form_dropdown('supplier_id', $options_supplier,'',$js); 
                              	?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="inputPassword3">
								Up.
							</label>
							<div class="col-sm-9">
								<input type="text" placeholder="Up" name="up" id="up" class="form-control" required="required">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="inputPassword3">
								Alamat
							</label>
							<div class="col-sm-9">
								<input type="text" placeholder="Alamat" name="alamat" id="alamat" class="form-control" required="required">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label" for="inputPassword3">
								Mata Uang
							</label>
							<div class="col-sm-9">
								<div class="clip-radio radio-primary">
									<?php foreach($kurensi as $k):?>
									<input type="radio" id="kurensi<?=$k->id?>" name="kurensi_id" value="<?=$k->id?>">
									<label for="kurensi<?=$k->id?>">
										<?=$k->title.'('.$k->simbol.')'?>
									</label>
									<?php endforeach;?>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label" for="inputPassword3">
								Keterangan
							</label>
							<div class="col-sm-9">
								<input type="text" placeholder="" name="keterangan" id="" class="form-control">
							</div>
						</div>
                    </div>

                    <div class="col-md-5">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="inputEmail3">
								Tgl. Pengiriman
							</label>
							<div class="col-sm-9">
								<div id="tanggal_transaksi" class="input-append date success no-padding">
                                  <input type="text" class="form-control" name="tanggal_transaksi" required>
                                  <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                                </div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="inputPassword3">
								No. PO
							</label>
							<div class="col-sm-9">
								<input type="text" placeholder="No. PO" name="po" class="form-control" required="required">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="inputPassword3">
								Dikirim Ke
							</label>
							<div class="col-sm-9">
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
							<label class="col-sm-3 control-label" for="inputPassword3">
								Term
							</label>
							<div class="col-sm-9">
								<div class="clip-radio radio-primary">
									<?php foreach($metode as $m):?>
									<input type="radio" id="metode<?=$m->id?>" name="metode_pembayaran_id" value="<?=$m->id?>">
									<label for="metode<?=$m->id?>">
										<?=$m->title?>
									</label>
									<?php endforeach;?>
								</div>
							</div>
						</div>
						<div id="kredit" style="display:none">
							<div class="form-group">
								<label class="col-sm-3 control-label" for="inputPassword3">
									Lama Angsuran
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

							<div class="form-group">
								<label class="col-sm-3 control-label" for="inputPassword3">
									Bunga
								</label>
								<div class="col-sm-2">
									<input type="text" placeholder="" name="bunga" id="bunga" class="form-control text-right" value="0">
								</div>
								<label class="col-sm-1 control-label" for="inputPassword3">
									%
								</label>
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
						<table id="table" class="table table-striped">
							<thead>
								<tr>
									<th width="5%"> # </th>
									<th width="5%"> No. </th>
									<th width="10%"> Kode Barang </th>
									<th width="20%"> Deskripsi </th>
									<th width="5%">Quantity</th>
									<th width="10%"> Satuan </th>
									<th width="20%"> Harga </th>
									<th width="5%">Disc(%)</th>
									<th width="15%"> Sub Total </th>
									<th width="5%">Pajak(%)</th>
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
						<div id="panel-total" class="panel-body col-md-5 pull-right" style="display:none">
							<ul class="list-group">
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
					<div class="row">
						<button type="submit" id="btnSubmit" class="btn btn-lg btn-primary hidden-print pull-right" style="display:none;margin-right:15px;">
							Submit Order <i class="fa fa-check"></i>
						</button>
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
	var row=table.insertRow(rowCount);

	var cell1=row.insertCell(0);
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
	cell6.innerHTML = "<select name='satuan[]' class='select2' style='width:100%'><?php for($i=0;$i<sizeof($satuan);$i++):?><option value='<?php echo $satuan[$i]['id']?>'><?php echo $satuan[$i]['title']?></option><?php endfor;?></select>";

	var cell7=row.insertCell(6);
	cell7.innerHTML = '<input name="harga[]" value="0" type="text" class="form-control harga text-right" required="required" id="harga'+rowCount+'">';  

	var cell8=row.insertCell(7);
	cell8.innerHTML = '<input name="disc[]" value="0" type="text" class="form-control text-right" required="required" id="disc'+rowCount+'">';

	var cell9=row.insertCell(8);
	cell9.innerHTML = '<input name="sub_total[]" type="text" class="form-control subtotal text-right" required="required" id="subtotal'+rowCount+'" readonly>';

	var cell10=row.insertCell(9);
	cell10.innerHTML = '<input name="pajak[]" value="0" type="text" class="form-control text-right" required="required" id="pajak'+rowCount+'">';

	$("#barang_id"+rowCount).change(function(){
        var id = $(this).val();
         $.ajax({
            type: "GET",
            dataType: "JSON",
            url: 'get_nama_barang/'+id,
            success: function(data) {
                $('#deskripsi'+rowCount).val(data);
            }
        });
    })
    .change();

	$("#subTotalPajak").append('<input name="subpajak[]" value="0" type="hidden" class="subpajak" id="subpajak'+rowCount+'">')
	$("#harga"+rowCount).add("#jumlah"+rowCount).add("#disc"+rowCount).add("#pajak"+rowCount).keyup(function() {
		hitung();
    });

    $('.harga').maskMoney({allowZero:true});
    $('#dibayar, #biaya_pengiriman').keyup(function(){
    	hitung();
    });
    function hitung()
    {
    	var a = parseInt($('#jumlah'+rowCount).val()),
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

        $('#subtotal'+rowCount).val(addCommas(parseFloat(val).toFixed(2)));
        $('#subpajak'+rowCount).val(subPajak);
        $('.subpajak').each(function (index, element) {
            jmlPajak = jmlPajak + parseInt($(element).val());
        });
        $('.subtotal').each(function (index, element) {
            total = total + parseInt($(element).val().replace(/,/g,""));
        });
        total = total+biayaPengiriman;
        totalPlusBunga = (total-diBayar)*(bunga/100);
        totalPlusBunga = (total-diBayar)+totalPlusBunga;
        biayaAngsuran = totalPlusBunga/lama_angsuran;
        totalpluspajak = total + jmlPajak;
        $('#totalPajak').val(addCommas(parseFloat(jmlPajak).toFixed(2)));
        $('#total').val(addCommas(parseFloat(total).toFixed(2)));
        $('#totalpluspajak').val(addCommas(parseFloat(totalpluspajak).toFixed(2)));
        var saldo = total-diBayar;
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
</script>