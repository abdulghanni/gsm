<!-- start: PAGE TITLE -->
<section id="page-title">
    <div class="row">
        <div class="col-sm-8">
            <h1 class="mainTitle"><?php echo lang('stock');?></h1>
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
                    <button class="btn btn-green add-row" onclick="reload_table()">
                        Refresh <i class="fa fa-refresh"></i>
                    </button>
                </div>
            </div>
            <div id="MsgGood" class="alert alert-success text-center" style="display:none;"></div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover table-full-width" id="table">
                    <thead>
                        <tr>
                            <th width="5%" align="center">No.</th>
                            <th width="10%"><?php echo lang('code');?></th>
                            <th width="15%"><?php echo lang('description');?></th>
                            <th width="5%"><?php echo 'Stok'?></th>
                            <th width="5%"><?php echo lang('unit');?></th>
                            <th width="10%"><?php echo lang('price');?> Beli</th>
                            <th width="10%"><?php echo lang('price');?> Jual</th>
                            <th width="15%"><?php echo 'Gudang';?></th>
                            <th width="15%"><?php echo 'Lokasi';?></th>
                            <th width="12%"><?php echo lang('action');?></th>
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
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="row form-row">
                            <div class="col-md-12">
                                <fieldset>
                                    <legend>Info Barang</legend>
                                    <div class="form-group">
                                        <label class="control-label col-md-2"><?= 'Nama'?></label>
                                        <div class="col-md-10">
                                          <?php 
                                            $js = 'class="select2" style="width:100%" id="barang_id"';
                                            echo form_dropdown('barang_id', $options_barang,'',$js); 
                                          ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2"><?= lang('unit')?></label>
                                        <div class="col-md-10">
                                            <input name="satuan" id="satuan" class="form-control" type="text" readonly>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Gudang</label>
                                        <div class="col-md-10">
                                          <?php 
                                            $js = 'class="select2" style="width:100%"';
                                            echo form_dropdown('gudang_id', $options_gudang,'',$js); 
                                          ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Detail Lokasi</label>
                                        <div class="col-md-10">
                                          <?php 
                                            $js = ' style="width:100%"';
                                            echo form_textarea('lokasi_detail', '',$js); 
                                          ?>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="col-md-12">
                                <fieldset>
                                    <legend>Info Persediaan</legend>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Dalam Stok</label>
                                        <div class="col-md-10">
                                            <input name="dalam_stok" id="satuan" class="form-control text-right" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Minimum Stok</label>
                                        <div class="col-md-10">
                                            <input name="minimum_stok" id="satuan" class="form-control text-right" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Harga Beli</label>
                                        <div class="col-md-10">
                                            <input name="harga_beli" id="satuan" class="form-control text-right" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Harga Jual</label>
                                        <div class="col-md-10">
                                            <input name="harga_jual" id="satuan" class="form-control text-right" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->