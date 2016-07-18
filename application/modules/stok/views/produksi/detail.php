<!-- start: PAGE TITLE -->
<section id="page-title">
	<div class="row">
		<div class="col-sm-8">
			<h1 class="mainTitle"><?= ucwords($main_title)?></h1>
			<span class="mainDescription"></span>
		</div>
		<ol class="breadcrumb">
			<li>
				<span>Pages</span>
			</li>
			<li class="active">
				<span><a href="<?=base_url($module.'/'.$file_name)?>">produksi</a></span>
			</li>
			<li>
				<span><a href="<?=base_url($module.'/'.$file_name.'/input')?>">Detail</a></span>
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
							#<?=$d->no?> <small class="text-light"></small>
						</p>
					</div>
				</div>
				<hr>
				<div id="isi">
          <div class="row">
            <div class="col-md-7">
              <div class="form-group">
                <label class="col-sm-3 control-label" for="inputPassword3">
                  No. Produksi
                </label>
                <div class="col-sm-8">
                  <input type="text" placeholder="" name="no" value="<?=$d->no?>" class="form-control" required="required">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="inputEmail3">
                  Tgl. Produksi
                </label>
                <div class="col-sm-8">
                  <input type="text" placeholder="" name="no" value="<?=$d->tgl?>" class="form-control" required="required">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="inputPassword3">
                  Catatan
                </label>
                <div class="col-sm-8">
                  <textarea placeholder="" name="catatan" value="" class="form-control"><?=$d->catatan?></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <?php $i=1;foreach($l as $r){?>
                <div class="panel-heading">
                    <div class="panel-title small">
                        <a data-toggle="collapse" data-parent="#accordion" href="#<?=$r->id?>">
                          <h4><?= $i++.'.'.$r->barang?></h4>
                          <table class="table table-bordered table-hover" id="table_id" style="width:100%">
                            <thead>
                              <tr>
                                <th width="10%">Kode Barang</th>
                                <th width="50%">Nama Barang</th>
                                <!-- <th width="10%">Qty Diminta</th> -->
                                <!-- <th width="10%">Sisa Stok</th> -->
                                <th width="10%">Qty Dibuat</th>
                                <th width="10%">Satuan</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                  <?= $r->kode_barang ?>
                                </td>
                                <td>
                                  <?= $r->barang?>
                                </td>


                                <td align="right"><?=$r->jumlah?></td>
                                <td>
                                  <?= $r->satuan ?>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </a>
                    </div>
                </div>
                <div id="<?=$r->id?>" class="panel-collapse collapse out">
                    <div class="panel-body">
                        <h4>Komposisi</h4>
                          <?php $j=1;
                          $assembly_id = getValue('id', 'assembly', array('barang_id'=>'where/'.$r->barang_id));
                          $list = getAll('assembly_list', array('assembly_id'=>'where/'.$assembly_id));
                          if($list->num_rows() > 0){
                          ?>

                            <input type="hidden" value="1" name="is_have_komposisi">
                        <table class="table table-bordered table-hover" id="table_id">
                          <thead>
                            <tr>
                              <th width="1%">No</th>
                              <th width="10%">Kode Barang</th>
                              <th width="59%">Nama Barang</th>
                              <th width="10%" id="th-bth-<?=$r->id?>">Qty Dibutuhkan</th>
                              <th width="10%">Satuan</th>
                              <th width="10%">Sisa Stok</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                                foreach($list->result() as $l):
                            ?>
                            <tr>

                              <td><?=$j++?></td>
                              <td>
                                <?= getValue('kode', 'barang', array('id'=>'where/'.$l->kode_barang))?>
                                <input type="hidden" value="<?=$l->kode_barang?>" name="barang_id_komposisi[]">
                              </td>
                              <td><?= getValue('title', 'barang', array('id'=>'where/'.$l->kode_barang))?></td>
                              <td align="right" class="val-bth<?=$r->id?>">
                                <?=$l->jumlah*$r->jumlah?>
                                <input type="hidden" name="jumlah_komposisi" value="<?=$l->jumlah?>" class="fix-val<?=$r->id?>">
                              </td>
                              <td>
                                <?= getValue('title', 'satuan', array('id'=>'where/'.$l->satuan_id))?>
                                <input type="hidden" name="satuan_id_komposisi" value="<?=$l->satuan_id?>">
                              </td>
                              <td>
                                <?=
                                $sisa = getValue('dalam_stok', 'stok', array('barang_id'=>'where/'.$l->kode_barang));
                                $sisa.' '.getSatuan($l->kode_barang)?>
                                <input type="hidden" value="<?=$sisa?>" class="fix-val<?=$r->id?>">
                              </td>
                            </tr>
                            <?php endforeach;}else{
                              echo 'Barang tidak memiliki Komposisi rakitan';?>

                          </tbody>
                        </table>
                        <?php } ?>
                    </div>
                </div>
              <?php } ?>
            </div>
          </div>
				</div>
			</div>
		</div>
	</div>

  	<div class="col-md-12" id="btnSubmit" style="display:none">
		<div class="col-md-10"></div>
	    <div class="col-md-2">
	      <button type="submit" value="Submit" name="btnDraft"  class="btn btn-lg btn-primary hidden-print pull-right">
	        Submit <i class="fa fa-check"></i>
	      </button>
	    </div>
	</div>
</form>
</div>
<!-- end: INVOICE -->
