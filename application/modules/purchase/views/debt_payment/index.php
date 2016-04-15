<!-- start: PAGE TITLE -->
<section id="page-title">
    <div class="row">
        <div class="col-sm-8">
            <h1 class="mainTitle"><?=$main_title?></h1>
        </div>
        <ol class="breadcrumb">
            <li>
                <span><?=$title?></span>
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
                </div>
            </div>
            <div id="MsgGood" class="alert alert-success text-center" style="display:none;"></div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover table-full-width" id="table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th width="5%" align="center">No.</th>
                            <th width="15%"><?php echo 'No. Transaksi';?></th>
                            <th width="15%"><?php echo 'No. PO';?></th>
                            <th width="10%"><?php echo 'COA';?></th>
                            <th width="10%"><?php echo 'Tgl. Pembayaran';?></th>
                            <th width="10%"><?php echo 'Tgl. Jatuh Tempo';?></th>
                            <th width="10%"><?php echo 'Supplier';?></th>
                            <th width="10%" class="text-center"><?php echo lang('action');?></th>
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
                <div class="row">
                <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label col-md-3">No. P.O</label>
                        <div class="col-md-9">
                            <?php 
                                $js = 'class="select2" style="width:100%" id="po"';
                                echo form_dropdown('po', $options_po,'',$js); 
                            ?>
                        </div>
                    </div>
                    <div id="kontak_label" style="display: none">
                    <div class="form-group">
                        <label class="control-label col-md-3">Supplier</label>
                        <div class="col-md-9">
                            <input name="kontak_id" placeholder="" class="form-control" type="text" readonly="" id="kontak">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    </div>
                    <div id="kurensi_label" style="display: none">
                    <div class="form-group">
                        <label class="control-label col-md-3">Kurensi</label>
                        <div class="col-md-9">
                            <input name="kurensi" placeholder="" class="form-control" type="text" readonly="" id="kurensi">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    </div>
                    <div id="jatuh_tempo_label" style="display: none">
                    <div class="form-group">
                        <label class="control-label col-md-3">Tgl. Jatuh Tempo</label>
                        <div class="col-md-9">
                            <input name="jatuh_tempo" placeholder="" class="form-control" type="text" readonly="" id="jatuh_tempo">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Catatan</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="catatan"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="form-group">
                        <label class="control-label col-md-3">No Transaksi</label>
                        <div class="col-md-9">
                            <input name="no" placeholder="" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">COA</label>
                        <div class="col-md-9">
                            <select name="coa_id" class="select2" style="width:100%">
                                <?php foreach($coa as $c): ?>
                                <option value="<?= $c->id?>"><?=$c->name?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="inputEmail3">
                            Tgl. Pembayaran
                        </label>
                        <div class="col-sm-9">
                            <div id="tgl_dibayar" class="input-append date success no-padding">
                              <input type="text" class="form-control" name="tgl_dibayar" required>
                              <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Dibayar</label>
                        <div class="col-md-9">
                            <input name="dibayar" placeholder="" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Terbayar</label>
                        <div class="col-md-9">
                            <input name="terbayar" placeholder="" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Total</label>
                        <div class="col-md-9">
                            <input name="total" placeholder="" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Saldo</label>
                        <div class="col-md-9">
                            <input name="saldo" placeholder="" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->