<!-- start: PAGE TITLE -->
<section id="page-title">
	<div class="row">
		<div class="col-sm-8">
			<h1 class="mainTitle"><?=$title?></h1>
			<span class="mainDescription"></span>
		</div>
		<ol class="breadcrumb">
			<li>
				<span>Pages</span>
			</li>
			<li class="active">
				<span><a href="<?= base_url($file_name)?>"><?=$title?></a></span>
			</li>
			<li>
				<span><a href="<?= base_url($file_name.'/input')?>">input</a></span>
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
							<!-- #<?=$last_id.'/PR-I/GSM/I/'.date('Y')?><small class="text-light"></small> -->
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
								<input type="text" placeholder="No. Work Order" name="no" value="" class="form-control" required="required">
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
								Customer
							</label>
							<div class="col-sm-8">
								<select class="select2" name="kontak_id" style="width:100%">
								<option value="0">-- Pilih Customer --</option>
								<?php 
                                	foreach($kontak as $r):?>
                                	<option value="<?=$r->id?>"><?=$r->title?></option>
                              	<?php endforeach;?>
                              	</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Project
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="Project" name="project" value="" class="form-control" required="required">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Tgl. Dibutuhkan
							</label>
							<div class="col-sm-8">
								<div id="tanggal_transaksi" class="input-append date success no-padding">
                                  <input type="text" class="form-control" name="tgl" required>
                                  <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                                </div>
							</div>
						</div>
                    </div>
				</div>
				<button id="btnAdd" type="button" class="btn btn-green" onclick="addRow('table')">
                    <?= lang('add').' '.lang('item') ?> <i class="fa fa-plus"></i>
                </button>
                <button id="remove" class="btn btn-danger" type="button" style="display:none">Hapus <i class="fa fa-remove"></i></button>
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
									<th width="20%"> Catatan </th>
									<th width="5%">Quantity</th>
									<th width="10%"> Satuan </th>
									<th width="20%"> Sisa Stok </th>
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
				<br/>
				<div class="row" id="btnSubmit" style="display:none">
					<div class="col-md-10"></div>
					<div class="col-md-2">
						<button type="submit" value="Submit" name="btnDraft"  class="btn btn-lg btn-primary hidden-print pull-right">
							Submit<i class="fa fa-check"></i>
						</button>
						<!--button type="submit" value="Submit" name="btnDraft" class="btn btn-lg btn-primary hidden-print pull-right" style="">Btn</button-->
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
            url: '/gsm/wo/add_row/'+rowCount,
            success: function(response){
	         	$("#"+tableID).find('tbody').append(response);
	         },
	         dataType:"html"
        });
}
</script>