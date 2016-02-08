<!-- start: PAGE TITLE -->
<section id="page-title">
    <div class="row">
        <div class="col-sm-8">
            <h1 class="mainTitle"><?=$title?></h1>
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
                <a href="<?=base_url().$module.'/'.$file_name.'/add'?>">
                    <button class="btn btn-green add-row">
                        <?= lang('add') ?> <i class="fa fa-plus"></i>
                    </button>
                </a>
                </div>
            </div>
            <div id="MsgGood" class="alert alert-success text-center" style="display:none;"></div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover table-full-width" id="table">
                    <thead>
                        <tr>
                            <th width="5%" align="center">No.</th>
                            <th width="5%"><?php echo lang('code');?></th>
                            <th width="20%">Nama</th>
                            <th width="10%">Jenis</th>
                            <th width="10%">Tipe</th>
                            <th width="10%">Email</th>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title text-center">User Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="row form-row">
                        <div class="col-md-6">
                        <fieldset>
                        <legend>Info Identitas</legend>
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3"><?= lang('code')?></label>
                                    <div class="col-md-7">
                                        <input name="kode" placeholder="" class="form-control" type="text" disabled="">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Nama</label>
                                    <div class="col-md-7">
                                        <input name="title" placeholder="" class="form-control" type="text" disabled>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Tipe</label>
                                    <div class="col-md-7">
                                        <input name="tipe" placeholder="" class="form-control" type="text" value="" disabled>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Jenis</label>
                                    <div class="col-md-7">
                                        <input name="jenis" placeholder="" class="form-control" type="text" value="" disabled>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">UP</label>
                                    <div class="col-md-7">
                                        <div id="up-lain">
                                        </div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            </fieldset>
                        </div>

                        <div class="col-md-6">
                        <fieldset>
                        <legend>Info Kontak</legend>
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Email</label>
                                    <div class="col-md-7">
                                        <input name="email" placeholder="" class="form-control" type="text" disabled>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Fax</label>
                                    <div class="col-md-7">
                                        <input name="fax" placeholder="" class="form-control" type="text" disabled>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Telepon</label>
                                    <div class="col-md-7">
                                        <div id="telepon-lain">
                                        </div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Alamat</label>
                                    <div class="col-md-7">
                                        <div id="alamat-lain">
                                        </div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->