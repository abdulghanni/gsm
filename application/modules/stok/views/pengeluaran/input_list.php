<label><?php echo ucfirst(str_replace('_',' ',$reftype)) ?> No. <?php echo $refid['so'] ;?> <?php if(isset($part)){echo "(Pengiriman Ke ".$partno.")"; }?></label>
<div class="col-sm-12">
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th width="5%"> No. </th>
					<th width="10%"> Kode Barang </th>
					<th width="10%">SS Barang</th>
                    <th width="10%">Nama Barang</th>
                    <th width="20%">Deskripsi</th>
                    <th width="20%">Catatan</th>
					<th width="5%">Quantity</th>
					<th width="10%"> Satuan </th>
					<!--th width="20%"> Harga </th>
					<th width="5%">Disc(%)</th>
					<th width="15%"> Sub Total </th>
					<th width="5%">Pajak(%)</th-->
					<th width="5%">Dikirim</th>
					<th width="5%">Satuan</th>
                    <th width="5%">Attachment</th>
				</tr><?php $c=1; foreach($list as $daftar){
						if(isset($part)){
								$carisisa=$this->db->query("SELECT * FROM stok_pengeluaran_list WHERE list_id='".$daftar['id']."' ORDER BY id DESC LIMIT 1")->row_array();
						}
						?>
				<?php echo form_hidden("idtrx[]",$daftar['order_id']) ?>
				<?php echo form_hidden("list[]",$daftar['id']) ?>
				<?php echo form_hidden("brg[]",$daftar['kode_barang']) ?>
				<?php echo form_hidden("jumlah_po[]",isset($part)?$carisisa['sisa'] : $daftar['jumlah']) ?>
				<tr>
					<th width="5%"><?php echo $c ?> </th>
					<th width="10%"> <?php echo GetValue('kode','barang',array('id'=>'where/'.$daftar['kode_barang'])) ?> </th>
					<th>
                    	<?php
                    		$img = getValue('photo', 'barang', array('id'=>'where/'.$daftar['kode_barang'])); 
                    		$src = (!empty($img)) ? base_url("uploads/barang/".$daftar['kode_barang']."/".$img) : assets_url('assets/images/no-image-mid.png') 
                    	?>
                    	<img height="75px" width="75px" src="<?=$src?>">
                    </th>
                    <th width="20%">
                    	<textarea><?php echo GetValue('title','barang',array('id'=>'where/'.$daftar['kode_barang'])) ?></textarea>
                    </th>
                    <th>
						<textarea name="deskripsi[]" class="" placeholder="Isi deskripsi barang disini"><?=$daftar['deskripsi']?></textarea>
					</th>
					<th>
						<textarea name="catatan_barang[]" class="" placeholder="Isi catatan kaki perbarang disini"><?=$daftar['catatan']?></textarea>
					</th>
					<th width="5%"><?php echo $daftar['jumlah'] ?> <?php if(isset($part)){echo "(SISA ".$carisisa['sisa'].")";} ?></th>
					<th width="10%"><?php echo GetValue('title','satuan',array('id'=>'where/'. $daftar['satuan_id']))?> </th>
					<!--th width="20%"> <?php echo $daftar['harga'] ?> </th>
					<th width="5%"><?php echo $daftar['disc'] ?></th>
					<th width="15%"> Sub Total </th>
					<th width="5%"><?php echo $daftar['pajak'] ?></th-->
					<th width="5%"><?php echo form_input("jumlah[]",isset($part)?$carisisa['sisa'] : $daftar['jumlah'],'max="'.(isset($part)?$carisisa['sisa'] : $daftar['jumlah']).'"') ?></th>
					<th width="5%"><?php echo form_dropdown("satuan[]",GetOptAll('satuan'),$daftar['satuan_id']) ?></th>
					<th>
                    	<a target="_blank" href="<?= base_url("uploads/pr/".$daftar['attachment'])?>"><?=$daftar['attachment']?></a>
                    </th>
				</tr><?php $c++;}  ?>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
<br/>