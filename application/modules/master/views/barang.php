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
                        <a href="#" data-toggle="dropdown" class="btn btn-azure dropdown-toggle">
                            Export <i class="fa fa-download"></i> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="#">
                                    PDF
                                </a>
                            </li>
                            <li>
                                <a href="#">
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
                    <span class="btn btn-light-azure fileinput-button"><span>Import <i class="fa fa-upload"></i></span>
                        <input name="files[]" multiple="" type="file">
                    </span>
                </div>
            </div>
            <div class="row">
                
            </div>
            <br/>
            <div id="MsgGood" class="alert alert-success text-center" style="display:none;"></div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover table-full-width" id="table">
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


<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">User Form</h3>
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
                        <!--
                        <div class="form-group">
                            <label class="control-label col-md-3">Attachment</label>
                            <div class="col-md-9">
                                <span class=""><span>
                                    <div id="attachment" style="display:none;"><button onclick="removeFile()" type='button' class='btn btn-danger btn-small' title='Remove File'><i class='icon-remove'></i></button></div>
                                    <input type='file' name='attachment' id="file" style="display:none;">
                                </span>
                            </div>
                        </div>
                        -->
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
            <div class="modal-footer">
                <input type="submit" id="" onclick="" class="btn btn-primary" value="save">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
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
</script>