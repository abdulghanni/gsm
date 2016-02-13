<div class="row">
					<div class="col-sm-12">
					<div class="table-responsive">
						<table id="table" class="table table-striped">
							<thead>
								<tr>
									<th width="5%"> No. </th>
									<th width="10%"> Kode Barang </th>
									<th width="20%"> Deskripsi </th>
									<th width="5%">Buku</th>
									<th width="10%"> Fisik </th>
									<th width="20%"> Selisih </th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no=1;
								foreach($stok as $sediaan){  ?>
								<tr>
									<td width="5%"> <?php echo $no; ?> </td>
									<td width="10%"> <?php echo GetValue('kode','barang',array('id'=>'where/'.$sediaan['barang_id'])) ?> </td>
									<td width="10%"> <?php echo GetValue('title','barang',array('id'=>'where/'.$sediaan['barang_id'])) ?> </td>
									<td width="5%"><?php echo $sediaan['dalam_stok'] ?></td>
									<td width="10%"> Fisik </td>
									<td width="20%"> 0 </td>
								</tr><?php 
									$no++;
								}  ?>
							</tbody>
						</table>
					</div>
					</div>
				</div>