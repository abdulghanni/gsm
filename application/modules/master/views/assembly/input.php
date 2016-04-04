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
				<span><a href="<?=base_url($module.'/'.$file_name)?>"><?php echo $file_name ?></a></span>
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
							#<?=date('Ymd',strtotime('now')).'-'.$last_id?> / <?=dateIndo(date('Y-m-d',strtotime('now')))?> <small class="text-light"></small>
							<input type="hidden" name="no" value="<?=date('Ymd',strtotime('now')).$last_id?>">
						</p>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
                                                    <?php echo form_hidden('id',isset($val['id'])?$val['id'] : 0) ?>
							<label class="col-sm-4 control-label" for="inputEmail3">
								Judul
							</label>
							<div class="col-sm-8">
								<?php 
			                    	$js = 'class="" style="width:100%" id="kontak_id"';
                                                $nmf='title';
			                    	echo form_input($nmf,isset($val[$nmf])?$val[$nmf] : '',$js); 
			                  	?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Output
							</label>
							<div class="col-sm-8">
								<?php 
                                                $nmf='output';
			                    	$js = 'class="select2" style="width:100%" id="output"';
			                    	echo form_dropdown($nmf,$opt_barang,isset($val[$nmf])?$val[$nmf] : '',$js); 
			                  	?>
							</div>
						</div>
						

                    </div>

                    <div class="col-md-6">
                    	
                    </div>
				</div>
				<button id="btnAdd" type="button" class="btn btn-green" onclick="addRow('table')">
                    <?= lang('add').' '.lang('item') ?> <i class="fa fa-plus"></i>
                </button>
                <button id="btnRemove" type="button" class="btn btn-red" onclick="deleteRow('table')" style="display:<?php echo isset($val[$nmf])?'' : 'none' ?>">
                    <?= 'Remove' ?> <i class="fa fa-remove"></i>
                </button>
				<div class="row">
					<div class="col-sm-12">
					<div class="table-responsive">
						<table id="table" class="table table-striped">
							<thead>
								<tr>
									<th width="5%"> # </th
									<th width="10%"> Kode Barang </th>
									<!--th width="20%"> Deskripsi </th-->
									<th width="5%">Quantity</th>
									<th width="10%"> Satuan </th>
								</tr>
							</thead>
							<tbody>
                                                                <?php
                                                                $a=1;
                                                                foreach($list as $ls){?>
								<tr>
                                                                    <td><input type="checkbox" name="chkbox[]" class="checkbox1"/></td>
									<td> <?php 
                                                $nmf='kode_barang[]';
			                    	$js = 'class="select2" style="width:100%" id="barang_id'.$a.'"';
			                    	echo form_dropdown($nmf,$opt_barang,isset($ls['kode_barang'])?$ls['kode_barang'] : '',$js); 
			                  	?> </td>
									<!--th width="20%"> Deskripsi </th--><?php 
                                                $nmf='jumlah[]';
                                                
                                                ?>
									<td><input name="jumlah[]" value="<?php echo isset($ls['jumlah'])?$ls['jumlah'] : '' ?>" type="text" class="form-control jumlah text-right" required="required" id="jumlah<?php echo $a?>"></td>
									<td> <?php 
                                                $nmf='satuan[]';
			                    	$js = 'class="select2" style="width:100%" id="jumlah'.$a.'"';
			                    	echo form_dropdown($nmf,GetOptAll('satuan'),isset($ls['satuan_id'])?$ls['satuan_id'] : '',$js); 
			                  	?> </td>
								</tr>
                                                                <?php $a++;}?>
                                                                
							</tbody>
						</table>
					</div>
					</div>
				</div>
				<div class="row">
					
					<div class="row">
						<button type="submit" id="btnSubmit" class="btn btn-lg btn-primary hidden-print pull-right" style="margin-right:15px;">
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
    $(document).ready(function(e){
        
		var rowCount=table.rows.length;
    });
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
		
//		var cell2=row.insertCell(1);
//		cell2.innerHTML=rowCount+1-1;
		
		var cell2=row.insertCell(1);
		<?php $s = array('"', "'");$r=array('&quot;','&#39;');?>
		cell2.innerHTML = "<select name='kode_barang[]' class='select2' id="+'barang_id'+rowCount+" style='width:100%'><?php for($i=0;$i<sizeof($barang);$i++):?><option value='<?php echo $barang[$i]['id']?>'><?php echo $barang[$i]['kode'].' - '.str_replace($s,$r,$barang[$i]['title'])?></option><?php endfor;?></select>";  
		
		/* var cell4=row.insertCell(3);
		cell4.innerHTML = '<input name="deskripsi[]" value="0" type="text" class="form-control" required="required" id="deskripsi'+rowCount+'">'; */
		
		var cell3=row.insertCell(2);
		cell3.innerHTML = '<input name="jumlah[]" value="0" type="text" class="form-control jumlah text-right" required="required" id="jumlah'+rowCount+'">';
		
		var cell4=row.insertCell(3);
		cell4.innerHTML = "<select name='satuan[]' class='select2' style='width:100%'><?php for($i=0;$i<sizeof($satuan);$i++):?><option value='<?php echo $satuan[$i]['id']?>'><?php echo $satuan[$i]['title']?></option><?php endfor;?></select>";
		
		
		/* $("#barang_id"+rowCount).change(function(){
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
		.change(); */
		
		$("#subTotalPajak").append('<input name="subpajak[]" value="0" type="hidden" class="subpajak" id="subpajak'+rowCount+'">')
		$("#harga"+rowCount).add("#jumlah"+rowCount).add("#disc"+rowCount).add("#pajak"+rowCount).keyup(function() {
			hitung();
		});
		
		$('.harga').maskMoney({allowZero:true});
		
		
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
	function deleteRow(tableID){
        try{
            var table=document.getElementById(tableID);
            var rowCount=table.rows.length;
            for(var i=0;i<rowCount;i++){
                var row=table.rows[i];
                var chkbox=row.cells[0].childNodes[0];
                //alert(chkbox);
                //console.log(chkbox)
                if(null!=chkbox&&true==chkbox.checked){
                //alert('yes');    
                table.deleteRow(i);rowCount--;i--;}
            }
        }catch(e){
            alert(e);
            //alert('no');
            }}
</script>