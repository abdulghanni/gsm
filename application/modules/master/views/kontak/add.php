<!-- start: PAGE TITLE -->
<section id="page-title">
    <div class="row">
        <div class="col-sm-8">
            <h1 class="mainTitle"><?=$title?></h1>
        </div>
        <ol class="breadcrumb">
            <li>
                <span><?='kontak'?></span>
            </li>
            <li class="active">
                <span><?=$title?></span>
            </li>
        </ol>
    </div>
</section>
<div class="container-fluid container-fullw bg-white">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <?php echo form_open(base_url().$module.'/'.$file_name.'/ajax_add', array('id'=>'form', 'class'=>'form-horizontal'));?>
                    <input type="hidden" value="" name="id"/> 
                    <div class="row form-row">
                        <div class="col-md-6">
                        <fieldset>
                        <legend>Info Identitas</legend>
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3"><?= lang('code')?></label>
                                    <div class="col-md-7">
                                        <input name="kode" placeholder="" class="form-control" type="text">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Nama</label>
                                    <div class="col-md-7">
                                        <input name="title" placeholder="" class="form-control" type="text">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Tipe</label>
                                    <div class="col-md-7">
                                        <select name="tipe_id" class="select2" style="width:100%">
                                            <option value="">-- Pilih Tipe Kontak --</option>
                                            <?php foreach($tipe->result() as $t):?>
                                                <option value="<?=$t->id?>"><?=$t->title?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Jenis</label>
                                    <div class="col-md-7">
                                        <select name="jenis_id" class="select2" style="width:100%">
                                            <option value="">-- Pilih Jenis Kontak --</option>
                                            <?php foreach($jenis->result() as $j):?>
                                                <option value="<?=$j->id?>"><?=$j->title?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">UP</label>
                                    <div class="col-md-7">
                                        <input name="up[]" placeholder="" class="form-control" type="text"><br/>
                                        <div id="up-lain">
                                        </div>
                                        <button type="button" class="btn btn-xs btn-primary" id="btnTambahUp">Tambah <i class="fa fa-plus"></i></button>
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
                                        <input name="email" placeholder="" class="form-control" type="text">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Fax</label>
                                    <div class="col-md-7">
                                        <input name="fax" placeholder="" class="form-control" type="text">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Telepon</label>
                                    <div class="col-md-7">
                                        <input name="telepon[]" placeholder="" class="form-control" type="text"><br/>
                                        <div id="telepon-lain">
                                        </div>
                                        <button type="button" class="btn btn-xs btn-primary" id="btnTambahTelepon">Tambah <i class="fa fa-plus"></i></button>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Alamat</label>
                                    <div class="col-md-7">
                                        <textarea class="form-control" name="alamat[]"></textarea><br/>
                                        <div id="alamat-lain">
                                        </div>
                                        <button type="button" class="btn btn-xs btn-primary" id="btnTambahAlamat">Tambah <i class="fa fa-plus"></i></button>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-lg pull-right"><i class="fa fa-save"> Save </i></button> 
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>