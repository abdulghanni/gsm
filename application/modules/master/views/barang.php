<script>
$(document).ready(function(e){

});
</script>
<!-- start: PAGE TITLE -->
<section id="page-title">
    <div class="row">
        <div class="col-sm-8">
            <h1 class="mainTitle"><?php echo 'Barang';?></h1>
        </div>
        <ol class="breadcrumb">
            <li>
                <span><?php echo lang('stock');?></span>
            </li>
            <li class="active">
                <span>Index</span>
            </li>
        </ol>
    </div>
</section>
<div class="row">
    <div class="col-lg-12">
        <div class="tabbable">
            <ul id="myTab2" class="nav nav-tabs nav-justified">
                <li class="active">
                    <a href="#myTab2_example1" data-toggle="tab">
                        Barang Produksi
                    </a>
                </li>
                <li>
                    <a href="#myTab2_example2" data-toggle="tab">
                        Barang Inventaris
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="myTab2_example1">
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 space20">
                                        <button class="btn btn-green add-row" onclick="add_user()">
                                            <?= lang('add') ?> <i class="fa fa-plus"></i>
                                        </button>
                                        <!--
                                        <button class="btn btn-green add-row" onclick="reload_table()">
                                            Refresh <i class="fa fa-refresh"></i>
                                        </button>
                                        -->
                                        <div class="btn-group">
                                            <a target="_blank" href="<?= base_url('print/file/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=barang.mrt')?>" class="btn btn-azure">
                                                Export <i class="fa fa-upload"></i>
                                            </a>
                                            <!--
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a href="<?=base_url('master/barang/pdf')?>" target="_blank">
                                                        PDF
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?=base_url('master/barang/excel')?>" target="_blank">
                                                        XLS
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        DOC
                                                    </a>
                                                </li>
                                            </ul>
                                            -->
                                        </div>
                                        <span class="btn btn-light-azure fileinput-button"><span>Import <i class="fa fa-download"></i></span>
                                            <input name="files[]" multiple="" type="file">
                                        </span>
                                        <!--
                                        <a href="<?=assets_url('template/barang.xlsx')?>">
                                            <span class="btn btn-light-azure fileinput-button"><span>Template Upload <i class="fa fa-file"></i></span>
                                                <input name="files[]" multiple="" type="file">
                                            </span>
                                        </a>
                                        -->
                                    </div>
                                </div>
                                <div class="row">
                                    
                                </div>
                                <br/>
                                <div id="MsgGood" class="alert alert-success text-center" style="display:none;"></div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-full-width" id="table" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th width="5%" align="center">No.</th>
                                                <th width="10%" align="center">Foto</th>
                                                <th width="10%"><?php echo lang('code');?></th>
                                                <th width="20%"><?php echo lang('description');?></th>
                                                <th width="10%">Alias</th>
                                                <th width="12%"><?php echo 'Jenis Barang';?></th>
                                                <th width="8%"><?php echo lang('unit');?></th>
                                                <th width="10%"><?php echo 'Action';?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB INVENTARIS -->
                <div class="tab-pane fade" id="myTab2_example2">
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    
                                    
                                    <div class="col-md-12 space20">
                                        <button class="btn btn-green add-row" onclick="add_inv()">
                                            <?= lang('add') ?> <i class="fa fa-plus"></i>
                                        </button>
                                        <!--
                                        <button class="btn btn-green add-row" onclick="reload_table()">
                                            Refresh <i class="fa fa-refresh"></i>
                                        </button>
                                        <div class="btn-group">
                                            <a target="_blank" href="<?= base_url('print/file/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=barang.mrt')?>" class="btn btn-azure">
                                                Export <i class="fa fa-upload"></i>
                                            </a>
                                            <!--
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a href="<?=base_url('master/barang/pdf')?>" target="_blank">
                                                        PDF
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?=base_url('master/barang/excel')?>" target="_blank">
                                                        XLS
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        DOC
                                                    </a>
                                                </li>
                                            </ul>
                                            
                                        </div>
                                        <span class="btn btn-light-azure fileinput-button"><span>Import <i class="fa fa-download"></i></span>
                                            <input name="files[]" multiple="" type="file">
                                        </span>
                                        <!--
                                        <a href="<?=assets_url('template/barang.xlsx')?>">
                                            <span class="btn btn-light-azure fileinput-button"><span>Template Upload <i class="fa fa-file"></i></span>
                                                <input name="files[]" multiple="" type="file">
                                            </span>
                                        </a>
                                        -->
                                    </div>
                                        
                                </div>
                                <div class="row">
                                    
                                </div>
                                <br/>
                                <div id="MsgGood" class="alert alert-success text-center" style="display:none;"></div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-full-width" id="table_inv" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th width="5%" align="center">No.</th>
                                                <th width="10%" align="center">Foto</th>
                                                <th width="10%"><?php echo lang('code');?></th>
                                                <th width="20%"><?php echo lang('description');?></th>
                                                <th width="10%">Kelompok</th>
                                                <th width="10%"><?php echo 'Nilai Perolehan';?></th>
                                                <th width="10%"><?php echo 'Umur Ekonomis';?></th>
                                                <th width="10%"><?php echo 'Akumulasi Beban'?></th>
                                                <th width="10%"><?php echo 'Beban Perbulan'?></th>
                                                <th width="10%"><?php echo 'Nilai Buku'?></th>
                                                <th width="10%"><?php echo 'Action';?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog custom-modal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Input Data Barang</h3>
            </div>
            <div class="modal-body form">
                <?php 
                echo form_open_multipart(base_url().'master/barang/ajax_add', array('id'=>'form', 'class'=>'form-horizontal'));?>
                <input type="hidden" value="" name="id"/>
                <input type="hidden" value="" name="is_update" id="is_update"/>
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3"><?= lang('code')?></label>
                                <div class="col-md-9">
                                    <input name="kode" placeholder="<?= lang('code');?>" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3"><?php echo lang('description');?></label>
                                <div class="col-md-9">
                                    <input name="title" placeholder="<?= lang('description');?>" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Alias</label>
                                <div class="col-md-9">
                                    <input name="alias" placeholder="Alias" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Brand/Merk</label>
                                <div class="col-md-9">
                                    <input name="merk" placeholder="Brand/Merk" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-3">Foto Barang</label>
                              <div class="col-md-9">
                                  <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"><img id="photo" src="<?=assets_url('assets/images/no-image-mid.png')?>" /></div>
                                    <div>
                                      <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="photo"></span>
                                      <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                  </div>
                                </div>
                            </div>

                            <div id="inv" style="display: none">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Jenis Barang Inventaris</label>
                                    <div class="col-md-9">
                                        <?php 
                                            $js = 'class="select2" style="width:100%" id="jenis_barang_inv"';
                                            echo form_dropdown('jenis_barang_inventaris_id', $options_jenis_barang_inventaris,'',$js); 
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="inputEmail3">
                                        Tgl. Pembelian
                                    </label>
                                    <div class="col-sm-9">
                                        <div id="tanggal_transaksi" class="input-append date success no-padding">
                                          <input type="text" class="form-control" name="tgl">
                                          <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Harga Perolehan</label>
                                    <div class="col-md-9">
                                        <input name="harga" placeholder="harga" class="form-control" type="text">
                                        <span class="help-block"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Tarif Penyusutan(%)</label>
                                    <div class="col-md-2">
                                        <input name="penyusutan" placeholder="penyusutan" class="form-control" type="text">
                                        <span class="help-block"></span>
                                    </div>
                                    <label class="control-label col-md-1">%</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Jenis Barang</label>
                                <div class="col-md-9">
                                    <?php 
                                        $js = 'class="select2" style="width:100%" id="jenis_barang"';
                                        echo form_dropdown('jenis_barang_id', $options_jenis_barang,'',$js); 
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Satuan Dasar</label>
                                <div class="col-md-9">
                                    <?php 
                                        $js = 'class="select2" style="width:100%" id="satuan"';
                                        echo form_dropdown('satuan', $options_satuan,'',$js); 
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Satuan Laporan</label>
                                <div class="col-md-9">
                                    <?php 
                                        $js = 'class="select2" style="width:100%" id="satuan_laporan"';
                                        echo form_dropdown('satuan_laporan', $options_satuan,'',$js); 
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Catatan</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="catatan"></textarea>
                                </div>
                            </div>
                        </div>
            			<div class="col-md-12">
            				<div class="form-group">
            					<div class="col-md-6">
            						<label class="control-label"><?php echo lang('unit') ?></label>
            					</div>
            					<div class="col-md-6">
            						<label class="control-label">Konversi Ke Satuan Dasar</label>
            					</div>
            				</div>
                        </div>
            			<div class="col-md-12">
            				<div class="form-group">
            					<div class="col-md-12">
            						<div id="satuan-exist">
            						</div>
            						<div id="satuan-lain">
            						</div>
            						<button type="button" class="btn btn-xs btn-primary" id="btnTambahSatuan">Tambah <i class="fa fa-plus"></i></button>
            					</div>
            				</div>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" id="" onclick="" class="btn btn-primary" value="save">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
             </form>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<!-- Inventaris modal -->
<div class="modal fade" id="modal_inv" role="dialog">
    <div class="modal-dialog custom-modal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Input Data Barang</h3>
            </div>
            <div class="modal-body form">
                <?php echo form_open_multipart(base_url().'master/barang/add_inv', array('id'=>'form_inv', 'class'=>'form-horizontal'));?>
                <input type="hidden" value="" name="id"/>
                <input type="hidden" value="" name="is_update" id="is_update_inv"/>
                 <div class="row">
                 <fieldset><legend>Info Barang</legend>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label col-md-4"><?= lang('code')?></label>
                                <div class="col-md-8">
                                    <input name="kode" placeholder="<?= lang('code');?>" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4"><?php echo lang('description');?></label>
                                <div class="col-md-8">
                                    <input name="title" placeholder="<?= lang('description');?>" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Alias</label>
                                <div class="col-md-8">
                                    <input name="alias" placeholder="Alias" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">Brand/Merk</label>
                                <div class="col-md-8">
                                    <input name="brand" placeholder="Brand/Merk" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-4">Foto Barang</label>
                              <div class="col-md-8">
                                  <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"><img id="photo" src="<?=assets_url('assets/images/no-image-mid.png')?>" /></div>
                                    <div>
                                      <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="photo"></span>
                                      <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Catatan</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="catatan"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="control-label col-md-4">Jenis Barang Inventaris</label>
                                <div class="col-md-3">
                                    <?php 
                                        $js = 'class="select2" style="width:100%" id="jenis_barang_inv"';
                                        echo form_dropdown('jenis_inventaris_id', $options_jenis_barang_inventaris,'',$js); 
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Lokasi</label>
                                <div class="col-md-3">
                                    <input name="lokasi" placeholder="Lokasi" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="inputEmail3">
                                    Tgl. Pembelian
                                </label>
                                <div class="col-sm-3">
                                    <div id="tanggal_transaksi" class="input-append date success no-padding">
                                      <input type="text" class="form-control" name="tgl_beli">
                                      <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                                    </div>
                                </div>
                                <label class="control-label col-md-2">Harga Perolehan</label>
                                <div class="col-md-3">
                                    <input name="harga_beli" placeholder="harga" class="form-control money text-right" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Akumulasi Beban</label>
                                <div class="col-md-3">
                                    <input name="akumulasi" placeholder="Akumulasi Beban" class="form-control money text-right" type="text">
                                    <span class="help-block"></span>
                                </div>
                                <label class="control-label col-md-2">Beban Per Tahun Ini</label>
                                <div class="col-md-3">
                                    <input name="beban_tahun_ini" placeholder="Beban Per Tahun Ini" class="form-control money text-right" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Beban Perbulan</label>
                                <div class="col-md-3">
                                    <input name="beban_perbulan" placeholder="Beban Perbulan" class="form-control money text-right" type="text">
                                    <span class="help-block"></span>
                                </div>
                                <label class="control-label col-md-2">Nilai Buku</label>
                                <div class="col-md-3">
                                    <input name="nilai_buku" placeholder="Nilai Buku" class="form-control money text-right" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <!--label class="control-label col-md-4">Tarif Penyusutan(%)</label>
                                <div class="col-md-2">
                                    <input name="tarif_penyusutan" placeholder="Tarif" class="form-control text-right" type="text">
                                    <span class="help-block"></span>
                                </div>
                                <label class="control-label col-md-1 pull-left">%</label-->
								<label class="control-label col-md-4">Umur Ekonomis</label>
                                <div class="col-md-2">
                                    <input name="umur_ekonomis" placeholder="Umur Ekonomis" class="form-control text-right" type="text" value='1'>
                                    <span class="help-block"></span>
                                </div>
                                <label class="control-label col-md-1 pull-left">Tahun</label>
                                <label class="control-label col-md-2">Nilai Residu</label>
                                <div class="col-md-3">
                                    <input name="nilai_residu" placeholder="Nilai Residu" class="form-control money text-right" type="text" value=0>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <br/><br/>
                            <div class="form-group  pull-right ">
                            <div class="col-md-12">
                                <button type="button" id="btn-hitung" onclick="hitung_penyusutan()">Hitung</button>
                                <input type="submit" id="" onclick="" class="btn btn-primary" value="Save">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            </div>
                            </div>
                        </div>
                    </div>  
                    </fieldset>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<script type="text/javascript">
  function removeFile(){
    $('#attachment').hide();
    $('#file').show();
  }
  	
  function hitung_penyusutan(){
	var thismonths=<?php echo (int)date('m',strtotime('last day of last month'));?>;
	var beli=parseFloat($('[name="harga_beli"]').val());
	var residu = parseFloat($('[name="nilai_residu"]').val());
	var ekonomis= parseFloat($('[name="umur_ekonomis"]').val())*12;
	var penyusutan= Math.ceil((beli-residu)/ekonomis);
	var beban_tahun_ini = Math.ceil(penyusutan*thismonths)
	  
	  $.post('<?php echo base_url()?>master/barang/hitung_penyusutan',{tanggal_beli:$('[name="tgl_beli"]').val(),beli:$('[name="harga_beli"]').val(),residu:$('[name="nilai_residu"]').val(),ekonomis:$('[name="umur_ekonomis"]').val()},function(e){
		  //(Harga Perolehan – Nilai Sisa/Residu) : umur ekonomis
		 
	var akumulasi=Math.ceil(penyusutan*e);
	var nilai_buku=beli-akumulasi;
		  $('[name="nilai_buku"]').val(nilai_buku);
		  $('[name="beban_perbulan"]').val(penyusutan);
		  $('[name="beban_tahun_ini"]').val(beban_tahun_ini);
		  $('[name="akumulasi"]').val(akumulasi);
		  
		  //alert('oi');
	  });
  }
  
</script>