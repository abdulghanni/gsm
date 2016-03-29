<fieldset>
	<legend>List</legend><div class="col-sm-12">
					<div class="table-responsive">
						<table id="table" class="table table-striped">
							<thead>
								<tr>
									<th width="5%"> No. </th>
									<th width="10%"> Kode Barang </th>
									<th width="20%"> Deskripsi </th>
									<th width="5%">Stok</th>
									<th width="10%"> Satuan </th>
									<!--th width="20%"> Harga </th>
									<th width="5%">Disc(%)</th>
									<th width="15%"> Sub Total </th>
									<th width="5%">Pajak(%)</th-->
									<th width="5%">Dipindahkan</th>
									<th width="5%">Satuan</th>
								</tr><?php $c=1; foreach($list->result_array() as $daftar){
										/* if(isset($part)){
												$carisisa=$this->db->query("SELECT * FROM stok_penerimaan_list WHERE penerimaan_id='".$partdata['id']."' AND list_id='".$daftar['id']."' ORDER BY id DESC LIMIT 1")->row_array();
												
										}
										 */
										
										?>
								<?php //echo form_hidden("idtrx[$c]",$daftar['order_id']) ?>
								<?php // echo form_hidden("list[$c]",$daftar['id']) ?>
								<?php echo form_hidden("kode_barang[$c]",$daftar['barang_id']) ?>
								<?php echo form_hidden("deskripsi[$c]",GetValue('title','barang',array('id'=>'where/'.$daftar['barang_id']))) ?>
								<?php //echo form_hidden("jumlah_po[$c]",isset($part)?$carisisa['sisa'] : $daftar['jumlah']) ?>
								<tr>
									<th width="5%"><?php echo $c ?> </th>
									<th width="10%"> <?php echo GetValue('kode','barang',array('id'=>'where/'.$daftar['barang_id'])) ?> </th>
									<th width="20%"> <?php echo GetValue('title','barang',array('id'=>'where/'.$daftar['barang_id'])) ?> </th>
									<th width="5%"><?php echo $daftar['dalam_stok'] ?></th>
									<th width="10%"><?php echo GetValue('title','satuan',array('id'=>'where/'. GetValue('satuan','barang',array('id'=>'where/'.$daftar['barang_id']))))?> </th>
									<!--th width="20%"> <?php echo $daftar['harga'] ?> </th>
									<th width="5%"><?php echo $daftar['disc'] ?></th>
									<th width="15%"> Sub Total </th>
									<th width="5%"><?php echo $daftar['pajak'] ?></th-->
									<th width="5%"><?php echo form_input("jumlah[$c]",0); ?></th>
									<th width="5%"><?php //echo form_dropdown("satuan[$c]",getoptsatuan($daftar['barang_id']),GetValue('satuan','barang',array('id'=>'where/'.$daftar['barang_id']))) ?>
										<?php echo form_dropdown("satuan[$c]",GetOptAll('satuan'),GetValue('satuan','barang',array('id'=>'where/'.$daftar['barang_id']))) ?></th>
								</tr><?php $c++;}  ?>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
					</div>
</fieldset>
					<div class="row">
						<button type="submit" id="btnSubmit" class="btn btn-lg btn-primary hidden-print pull-right" style="margin-right:15px;">
							Submit<i class="fa fa-check"></i>
						</button>
					</div>