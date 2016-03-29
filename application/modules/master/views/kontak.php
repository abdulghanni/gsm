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
                    <div class="btn-group">
                        <a href="#" data-toggle="dropdown" class="btn btn-azure dropdown-toggle">
                            Export <i class="fa fa-upload"></i> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="<?=base_url('master/kontak/pdf')?>" target="_blank">
                                    PDF
                                </a>
                            </li>
                            <li>
                                <a href="<?=base_url('master/kontak/excel')?>" target="_blank">
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
            <div id="MsgGood" class="alert alert-success text-center" style="display:none;"></div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover table-full-width" id="table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th width="5%" align="center">No.</th>
                            <th width="5%"><?php echo lang('code');?></th>
                            <th width="20%">Nama</th>
                            <th width="10%">Jenis</th>
                            <th width="10%">Tipe</th>
                            <th width="10%">Telp.</th>
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
                        <div class="col-md-12">
                        <fieldset>
                        <legend>Info Identitas</legend>
                            <div class="form-body">
                            <div class="col-md-6">
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
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">UP</label>
                                    <div class="col-md-7">
                                        <div id="up-lain">
                                        </div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                

                                <div class="form-group">
                                    <label class="control-label col-md-3">Catatan</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="catatan" disabled></textarea>
                                    </div>
                                </div>
                            </div>
                            </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
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

                            <div class="col-sm-6">
                            <fieldset>
                                <legend>Info Finansial</legend>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">NPWP</label>
                                    <div class="col-sm-7">
                                        <input name="npwp" placeholder="" class="form-control" type="text" value="" disabled>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">No. Rekening</label>
                                    <div class="col-sm-7">
                                        <input name="no_rekening" placeholder="" class="form-control" type="text" value="" disabled>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Nama Bank</label>
                                    <div class="col-sm-7">
                                        <input name="bank" placeholder="" class="form-control" type="text" value="" disabled>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Atas Nama</label>
                                    <div class="col-sm-7">
                                        <input name="a_n" placeholder="" class="form-control" type="text" value="" disabled>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Alamat Pajak</label>
                                    <div class="col-sm-7">
                                        <input name="alamat_pajak" placeholder="" class="form-control" type="text" value="" disabled>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Acc</label>
                                    <div class="col-sm-7">
                                        <input name="acc" placeholder="" class="form-control" type="text" value="" disabled>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </fieldset>
                        </div> 
                    </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->