<!-- start: PAGE TITLE -->
<section id="page-title">
    <div class="row">
        <div class="col-sm-8">
            <h1 class="mainTitle"><?php echo lang('unit');?></h1>
        </div>
        <ol class="breadcrumb">
            <li>
                <span><?php echo lang('unit');?></span>
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
                            <th width="10%" align="center">Satuan</th>
                            <th width="20%" align="center">Nama Satuan</th>
                            <th width="40%"><?php echo lang('description');?></th>
                            <th width="10%"><?php echo "action";?></th>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">User Form</h3>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabbable">
                        <ul id="myTab2" class="nav nav-tabs nav-justified">
                            <li class="active">
                                <a href="#myTab2_example1" data-toggle="tab">
                                    Info Satuan
                                </a>
                            </li>
                            <li id="konversi" style="display:none">
                                <a href="#myTab2_example2" data-toggle="tab">
                                    Konversi Satuan
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="myTab2_example1">
                                <div class="container-fluid container-fullw bg-white">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="modal-body form">
                                                <form action="#" id="form" class="form-horizontal">
                                                    <input type="hidden" value="" name="id"/> 
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Satuan</label>
                                                            <div class="col-md-9">
                                                                <input name="title" placeholder="Satuan" class="form-control" type="text">
                                                                <span class="help-block"></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Nama Satuan</label>
                                                            <div class="col-md-9">
                                                                <input name="nama" placeholder="Nama Satuan" class="form-control" type="text">
                                                                <span class="help-block"></span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Satuan Dasar</label>
                                                            <div class="col-md-6">
                                                                <input type="checkbox" id="dasar" value="1" name="is_dasar"> Ya
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Deskripsi</label>
                                                            <div class="col-md-9">
                                                                <input name="deskripsi" placeholder="<?= lang('description');?>" class="form-control" type="text">
                                                                <span class="help-block"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- TAB APPROVER -->
                            <div class="tab-pane fade" id="myTab2_example2">
                                <div class="container-fluid container-fullw bg-white">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="modal-body form">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Satuan</label>
                                                            <div class="col-md-9">
                                                                <input name="title" placeholder="Satuan" class="form-control" type="text" disabled="disabled">
                                                                <span class="help-block"></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">1 <span id="satuan-text"></span> = </label>
                                                            <div class="col-md-3">
                                                                <input type="text" class="form-control text-right" name="satuan_dasar_num" />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <?php 
                                                                    $js = 'class="select2" style="width:100%" id="jenis_barang"';
                                                                    echo form_dropdown('satuan_dasar_id', $options_jenis_satuan,'',$js); 
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->