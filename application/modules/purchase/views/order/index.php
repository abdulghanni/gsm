<!-- start: PAGE TITLE -->
<section id="page-title">
    <div class="row">
        <div class="col-sm-8">
            <h1 class="mainTitle"><?php echo 'Order';?></h1>
        </div>
        <ol class="breadcrumb">
            <li>
                <span><?php echo 'order';?></span>
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
                    <a href="<?= base_url('transaksi/order/input')?>" class="btn btn-green add-row">
                        <?= lang('add') ?> <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <div id="MsgGood" class="alert alert-success text-center" style="display:none;"></div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover table-full-width" id="table">
                    <thead>
                        <tr>
                            <th width="5%" align="center">No.</th>
                            <th width="10%"><?php echo 'No. Transaksi';?></th>
                            <th width="15%"><?php echo 'Supplier';?></th>
                            <th width="5%" class="text-center"><?php echo 'Tanggal Pengiriman';?></th>
                            <th width="5%" class="text-center"><?php echo 'Metode Pembayaran';?></th>
                            <th width="10%"><?php echo 'No. PO';?></th>
                            <th width="15%"><?php echo 'Dikirim Ke';?></th>
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


<!-- Bootstrap modal 
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">User Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3"><?= 'Nama Barang'?></label>
                            <div class="col-md-9">
                              <?php 
                                $js = 'class="select2" style="width:100%"';
                                echo form_dropdown('kode', $options_supplier,'',$js); 
                              ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?= lang('total')?></label>
                            <div class="col-md-9">
                                <input name="jumlah" placeholder="<?= lang('total')?>" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?= lang('total')?></label>
                            <div class="col-md-4">
                                <div id="tanggal_transaksi" class="input-append date success no-padding">
                                  <input type="text" class="form-control" name="start_cuti" required>
                                  <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3"><?= lang('unit')?></label>
                            <div class="col-md-9">
                               <?php 
                                $js = 'class="select2" style="width:100%"';
                                echo form_dropdown('satuan', $options_metode_pembayaran,'',$js); 
                               ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Kurensi</label>
                            <div class="col-md-9">
                                <?php 
                                    $js = 'class="select2" style="width:100%"';
                                    echo form_dropdown('kurensi_id', $options_kurensi,'',$js); 
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3"><?= lang('price')?></label>
                            <div class="col-md-9">
                                <input name="harga" placeholder="<?= lang('price')?>" class="form-control" type="text">
                                <span class="help-block"></span>
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