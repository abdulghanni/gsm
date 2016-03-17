
				
			<fieldset>
			
			<legend>Hasil Barang</legend>
				<div class="row">
					<div class="col-sm-12">
					<?php echo form_hidden('output',$barang['output']) ?>
					<?php echo GetValue('title','barang',array('id'=>'where/'.$barang['output'])); ?>
					</div>
				</div>
			</fieldset>
				
				<button id="btnAdd" type="button" class="btn btn-green" onclick="addRow('table')">
                    <?= lang('add').' Komposisi '.lang('item') ?> <i class="fa fa-plus"></i>
                </button>
                <button id="btnRemove" type="button" class="btn btn-red" onclick="deleteRow('table')" style="display:none">
                    <?= 'Remove' ?> <i class="fa fa-remove"></i>
                </button>
			<fieldset>
			
			<legend>Komposisi</legend>
				<div class="row">
					<div class="col-sm-12">
					<div class="table-responsive">
						<table id="table" class="table table-striped">
							<thead>
								<tr>
									<th width="5%"> No. </th>
									<th width="10%"> Kode Barang </th>
									<!--th width="20%"> Deskripsi </th-->
									<th width="5%">Quantity x <span id="qtys"></span></th>
									<th width="10%"> Satuan </th>
								</tr>
								<?php
									$a=1;
								foreach($list->result() as $ls){ ?>
								<tr>
								<?php echo form_input('barang_komposisi[]',$ls->kode_barang,'style="display:none"'); ?>
									<td width="5%"> <?php echo $a ?> </td>
									<td width="10%"> <?php echo GetValue('title','barang',array('id'=>'where/'.$ls->kode_barang)); ?> </td>
									<!--th width="20%"> Deskripsi </th-->
									<td width="5%"><?php echo form_input('jumlah_komposisi[]',$ls->jumlah); ?></td>
									<td width="10%"> <?php echo form_dropdown('satuan[]',getoptsatuan($ls->kode_barang),$ls->satuan_id); ?> </td>
								</tr>
								<?php $a++; } ?>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
					</div>
				</div>
				</fieldset>
				<div class="row">
					
					<div class="row">
						<button type="submit" id="btnSubmit" class="btn btn-lg btn-primary hidden-print pull-right" style="margin-right:15px;">
							Submit <i class="fa fa-check"></i>
						</button>
					</div>
				</div>
				<script>
				$(document).ready(function(e){
						$('#qtys').text($('#jumlahbikin').val());
						$('#jumlahbikin').change(function(e){
							
							$('#qtys').text($('#jumlahbikin').val());
						});
				});
				</script>