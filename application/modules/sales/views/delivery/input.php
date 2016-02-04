<!-- start: PAGE TITLE -->
<section id="page-title">
	<div class="row">
		<div class="col-sm-8">
			<h1 class="mainTitle"><?= $main_title?></h1>
			<span class="mainDescription"></span>
		</div>
		<ol class="breadcrumb">
			<li>
				<span>Pages</span>
			</li>
			<li class="active">
				<span><a href="<?=base_url($module.'/'.$file_name)?>"><?= $main_title?></a></span>
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
				<div class="row form-row">
					<div class="col-md-6">
						<div class="col-md-4">
							<label class="control-label">Salin Dari S.O</label>
						</div>
						<div class="col-md-8">
							<select class="select2" id="list_so" style="width:100%">
								<option value="0">-- Pilih NO. S.O --</option>
								<?php foreach($so as $p):?>
								<option value="<?=$p->id?>"><?=$p->so?></option>
								<?php endforeach;?>
							</select>
						</div>
					</div>
				</div>
				<hr>
				<div id="dari-so">
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
                                  <input type="text" class="form-control" name="tanggal_pengantaran" required>
                                  <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                                </div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Customer
							</label>
							<div class="col-sm-8">
								<?php 
                                	$js = 'class="select2" style="width:100%" id="customer_id"';
                                	echo form_dropdown('customer_id', $options_customer,'',$js); 
                              	?>
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
								No. S.O
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="No. S.O" name="so" class="form-control" required="required" value="">
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
							<select class="select2" name="gudang_id" style="width:100%">
							<option value="0">-- Pilih Gudang Pengiriman --</option>
							<?php 
                            	foreach($gudang as $g):?>
                            	<option value="<?=$g->id?>"><?=$g->title?></option>
                          	<?php endforeach;?>
                          	</select>
						</div>
					</div>
				</div>
				</fieldset>
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
									<th width="5%">#</th>
									<th width="5%"> No. </th>
									<th width="20%"> Kode </th>
									<th width="30%"> Nama Barang </th>
									<th width="10%">Jumlah</th>
									<th width="30%">Keterangan</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
					</div>
				</div>
				
				<div class="row">
					<button type="submit" id="btnSubmit" class="btn btn-lg btn-primary hidden-print pull-right" style="display:none;margin-right:15px;">
						Submit <i class="fa fa-check"></i>
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
	var x = 1;
	var cell2=row.insertCell(x++);
	cell2.innerHTML=rowCount+1-1;

	var cell3=row.insertCell(x++);
	cell3.innerHTML = "<select name='kode_barang[]' class='select2' id="+'barang_id'+rowCount+" style='width:100%'><?php for($i=0;$i<sizeof($barang);$i++):?><option value='<?php echo $barang[$i]['id']?>'><?php echo $barang[$i]['kode'].' - '.$barang[$i]['title']?></option><?php endfor;?></select>";  

	var cell4=row.insertCell(x++);
	cell4.innerHTML = '<input name="deskripsi[]" value="" type="text" class="form-control" required="required" id="deskripsi'+rowCount+'">';

	var cell5=row.insertCell(x++);
	cell5.innerHTML = '<input name="jumlah[]" value="0" type="text" class="form-control jumlah text-right" required="required">';

	var cell6=row.insertCell(x++);
	cell6.innerHTML = '<input name="keterangan[]" value="" type="text" class="form-control jumlah text-right" required="required" id="jumlah'+rowCount+'">';

	
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
    })
    .change();
	}
	function deleteRow(tableID){try{var table=document.getElementById(tableID);var rowCount=table.rows.length;for(var i=0;i<rowCount;i++){var row=table.rows[i];var chkbox=row.cells[0].childNodes[0];if(null!=chkbox&&true==chkbox.checked){table.deleteRow(i);rowCount--;i--;}}}catch(e){alert(e);}}
</script>