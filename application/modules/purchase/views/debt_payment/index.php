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
<div class="col-lg-12">
    <div class="tabbable">
        <ul id="myTab2" class="nav nav-tabs nav-justified">
            <li class="active">
                <a href="#myTab2_example1" data-toggle="tab">
                    Pembayaran Hutang
                </a>
            </li>
            <!--li>
                <a href="#myTab2_example2" data-toggle="tab">
                    List Hutang
                </a>
            </li-->
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
            </div>
            <!-- TAB List -->
            <div class="tab-pane fade" id="myTab2_example2">
                <div class="container-fluid container-fullw bg-white">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-full-width" id="table_list" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th width="5%" align="center">No.</th>
                                                <th width="15%"><?php echo 'Supplier';?></th>
                                                <th width="15%"><?php echo 'Mata Uang';?></th>
                                                <th width="10%"><?php echo 'Total Hutang';?></th>
                                                <th width="10%"><?php echo 'Terbayar';?></th>
                                                <th width="10%"><?php echo 'Saldo';?></th>
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
                            <input name="no" placeholder="" id="no" class="form-control" type="text" value="">
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
                        <label class="control-label col-md-3">Hutang Dibayar</label>
                        <div class="col-md-9">
                            <input name="dibayar" id="dibayar" placeholder="" class="form-control money text-right" value="0" type="text" required>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Hutang Terbayar</label>
                        <div class="col-md-9">
                            <input name="terbayar" id="terbayar" placeholder="" class="form-control text-right" type="text" value="0" readonly="readonly">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Total Hutang</label>
                        <div class="col-md-9">
                            <input name="total" id="total" placeholder="" class="form-control text-right" type="text" value="0" readonly="readonly">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Saldo Hutang</label>
                        <div class="col-md-9">
                            <input name="saldo" id="saldo" placeholder="" class="form-control text-right" type="text" value="0" readonly="readonly">
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

<script type="text/javascript">
    $("#dibayar").keyup(function(){
        var terbayar = $("#terbayar").val().replace(/,/g,"");
        var dibayar = $("#dibayar").val().replace(/,/g,"");
        var total = $("#total").val().replace(/,/g,"");
        var saldo = total-terbayar-dibayar;
        $("#saldo").val(addCommas(parseFloat(saldo).toFixed(2)));
    });

    function addCommas(nStr)
    {
      nStr += '';
      x = nStr.split('.');
      x1 = x[0];
      x2 = x.length > 1 ? '.' + x[1] : '';
      var rgx = /(\d+)(\d{3})/;
      while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
      }
      return x1 + x2;
    }
</script>