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
							#<?php if(!empty($r->kode))echo $r->kode; ?> <small class="text-light"></small>
						</p>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-8">
                        <?php echo form_hidden('id',isset($val['id'])?$val['id'] : 0) ?>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="inputEmail3">
								Output Barang
							</label>
							<div class="col-sm-10">
								<?php 
									$nmf='output';
									if(isset($val['id'])){ 
								?>
								<textarea type="text" class="form-control" style="width:100%" readonly><?=$r->title?></textarea>
								<input type="hidden" name="output" class="form-control" value="<?=$r->barang_id?>" readonly>
								<?php
									}else{ ?>
				                    	<select name="output" class="barang" style="width:100%" id="output">
				                    		<option value="0">-- Pilih Barang --</option>
				                    	<?php foreach($opt_barang->result() as $b):?>
											<option value="<?=$b->id?>"><?= $b->kode.' - '.$b->title ?></option>
										<?php endforeach; ?> 
										</select>
			                    	<?php }
			                  	?>
							</div>
						</div>
                    </div>
                    <div class="col-md-8"></div>
				</div>
				<hr/>
				<h4>Komposisi</h4>
				<button id="btnAdd" type="button" class="btn btn-green" onclick="addRow('table')">
                    <?= lang('add').' '.lang('item') ?> <i class="fa fa-plus"></i>
                </button>
                <button id="btnRemove" type="button" class="btn btn-red" onclick="deleteRow('table')" >
                    <?= 'Remove' ?> <i class="fa fa-remove"></i>
                </button>
				<div class="row">
					<div class="col-sm-12">
					<div class="table-responsive">
						<table id="table" class="table table-striped">
							<thead>
								<tr>
									<th width="1%"> # </th>
									<th width="50%"> Kode Barang </th>
									<!--th width="20%"> Deskripsi </th-->
									<th width="20%">Quantity</th>
									<th width="30%"> Satuan </th>
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
							Save <i class="fa fa-check"></i>
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

		var cell2=row.insertCell(1);
		<?php $s = array('"', "'");$r=array('&quot;','&#39;');?>
		cell2.innerHTML = "<select name='kode_barang[]' class='barang' id="+'barang_id'+rowCount+" style='width:100%'><option value='0'>-- Pilih Barang --</option><?php for($i=0;$i<sizeof($barang);$i++):?><<option value='<?php echo $barang[$i]['id']?>'><?php echo $barang[$i]['kode'].' - '.str_replace($s,$r,$barang[$i]['title'])?></option><?php endfor;?></select>"; 

		var cell3=row.insertCell(2);
		cell3.innerHTML = '<input name="jumlah[]" value="0" type="text" class="form-control jumlah text-right" required="required" id="jumlah'+rowCount+'">';
		
		var cell4=row.insertCell(3);
		cell4.innerHTML = "<select name='satuan[]' class='select2' style='width:100%'><?php for($i=0;$i<sizeof($satuan);$i++):?><option value='<?php echo $satuan[$i]['id']?>'><?php echo $satuan[$i]['title']?></option><?php endfor;?></select>";
		
		$(document).find("select.select2").select2().on('select2-open', function() {

        // however much room you determine you need to prevent jumping
        var requireHeight = 600;
        var viewportBottom = $(window).scrollTop() + $(window).height();

        // figure out if we need to make changes
        if (viewportBottom < requireHeight) 
        {           
            // determine how much padding we should add (via marginBottom)
            var marginBottom = requireHeight - viewportBottom;

            // adding padding so we can scroll down
            $(".aLwrElmntOrCntntWrppr").css("marginBottom", marginBottom + "px");

            // animate to just above the select2, now with plenty of room below
            $('html, body').animate({
                scrollTop: $("#mySelect2").offset().top - 10
            }, 1000);
        }
    });;
		$(document).find("select.barang").select2({
	        dropdownAutoWidth : true,
	        placeholder: "Cari Barang",
	        minimumInputLength: 3,
	    }).on('select2-open', function() {

        // however much room you determine you need to prevent jumping
        var requireHeight = 600;
        var viewportBottom = $(window).scrollTop() + $(window).height();

        // figure out if we need to make changes
        if (viewportBottom < requireHeight) 
        {           
            // determine how much padding we should add (via marginBottom)
            var marginBottom = requireHeight - viewportBottom;

            // adding padding so we can scroll down
            $(".aLwrElmntOrCntntWrppr").css("marginBottom", marginBottom + "px");

            // animate to just above the select2, now with plenty of room below
            $('html, body').animate({
                scrollTop: $("#mySelect2").offset().top - 10
            }, 1000);
        }
    });
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