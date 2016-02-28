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
                <?php echo form_open(base_url().$module.'/'.$file_name.'/ajax_update', array('id'=>'form', 'class'=>'form-horizontal'));?>
                    <input type="hidden" value="<?=$r->id?>" name="id"/> 
                    <div class="row form-row">
                        <div class="col-md-12">
                        <fieldset>
                        <legend>Info Identitas</legend>
                            <div class="form-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><?= lang('code')?></label>
                                        <div class="col-md-7">
                                            <input name="kode" placeholder="" class="form-control" type="text" value="<?=$r->kode?>">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Nama</label>
                                        <div class="col-md-7">
                                            <input name="title" placeholder="" class="form-control" type="text" value="<?=$r->title?>">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Tipe</label>
                                        <div class="col-md-7">
                                            <select name="tipe_id" class="select2" style="width:100%">
                                                <option value="">-- Pilih Tipe Kontak --</option>
                                                <?php foreach($tipe->result() as $t):
                                                    $selected = ($r->tipe_id == $t->id) ? "selected" : '';
                                                ?>
                                                    <option value="<?=$t->id?>" <?=$selected?>><?=$t->title?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Jenis</label>
                                        <div class="col-md-7">
                                            <select name="jenis_id" class="select2" style="width:100%">
                                                <option value="">-- Pilih Jenis Kontak --</option>
                                                <?php foreach($jenis->result() as $j):
                                                $selected2 = ($r->jenis_id == $j->id) ? "selected" : '';
                                                ?>
                                                    <option value="<?=$j->id?>" <?=$selected2?>><?=$j->title?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">UP</label>
                                        <div class="col-md-7">
                                        <?php foreach($up as $u=>$v):?>
                                            <input name="up[]" placeholder="" class="form-control" type="text" value=<?=$v?>><br/>
                                        <?php endforeach?>
                                            <div id="up-lain">
                                            </div>
                                            <button type="button" class="btn btn-xs btn-primary" id="btnTambahUp">Tambah <i class="fa fa-plus"></i></button>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Catatan</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" name="catatan"><?=$r->catatan?></textarea>
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
                                            <input name="email" placeholder="" class="form-control" type="text" value="<?=$r->email?>">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Fax</label>
                                        <div class="col-md-7">
                                            <input name="fax" placeholder="" class="form-control" type="text" value="<?=$r->fax?>">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Telepon</label>
                                        <div class="col-md-7">
                                        <?php foreach ($telepon as $key => $v):?>
                                            <input name="telepon[]" placeholder="" class="form-control" type="text" value="<?=$v?>"><br/>
                                        <?php endforeach;?>
                                            <div id="telepon-lain">
                                            </div>
                                            <button type="button" class="btn btn-xs btn-primary" id="btnTambahTelepon">Tambah <i class="fa fa-plus"></i></button>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Alamat</label>
                                        <div class="col-md-7">
                                        <?php foreach ($alamat as $key => $v):?>
                                            <textarea class="form-control" name="alamat[]"><?=$v?></textarea><br/>
                                        <?php endforeach;?>
                                            <div id="alamat-lain">
                                            </div>
                                            <br/><button type="button" class="btn btn-xs btn-primary" id="btnTambahAlamat">Tambah <i class="fa fa-plus"></i></button>
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
                                        <input name="npwp" placeholder="" class="form-control" type="text" value="<?=$r->npwp?>">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">No. Rekening</label>
                                    <div class="col-sm-7">
                                        <input name="no_rekening" placeholder="" class="form-control" type="text" value="<?=$r->no_rekening?>">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Nama Bank</label>
                                    <div class="col-sm-7">
                                        <input name="bank" placeholder="" class="form-control" type="text" value="<?=$r->bank?>">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Atas Nama</label>
                                    <div class="col-sm-7">
                                        <input name="a_n" placeholder="" class="form-control" type="text" value="<?=$r->a_n?>">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Alamat Pajak</label>
                                    <div class="col-sm-7">
                                        <input name="alamat_pajak" placeholder="" class="form-control" type="text" value="<?=$r->alamat_pajak?>">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Acc</label>
                                    <div class="col-sm-7">
                                        <input name="acc" placeholder="" class="form-control" type="text" value="<?=$r->acc?>">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </fieldset>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-lg pull-right"><i class="fa fa-save"> Update </i></button> 
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>