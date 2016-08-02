<?php foreach ($order->result() as $o) :?><div class="row">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputEmail3">
					Kepada
				</label>
				<div class="col-sm-7">
					<?php 
                    	$js = 'class="select2" style="width:100%" id="kontak_id"';
                    	echo form_dropdown('kontak_id', $options_kontak,'',$js); 
                  	?>
				</div>
				<div class="col-md-1">
                  	<button type="button" class="btn btn-primary btn-xs" style="margin-left: -15px" title="Tambah Supplier Baru" data-toggle="modal" data-target="#modalKontak"><i class="fa fa-plus"></i></button>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputPassword3">
					Up.
				</label>
				<div class="col-sm-8">
					<div id="up">
						<input type="text" placeholder="Up" name="up" id="" class="form-control" required="required">
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputPassword3">
					Alamat
				</label>
				<div class="col-sm-8">
					<select id="alamat" class="select2" style="width:100%" name="alamat">
						<option value="">-- Pilih Alamat Supplier --</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputPassword3">
					Mata Uang
				</label>
				<div class="col-sm-8">
					<div class="clip-radio radio-primary">
						<?php foreach($kurensi as $k):?>
						<input type="radio" id="kurensi<?=$k->id?>" name="kurensi_id" value="<?=$k->id?>" <?= ($k->id == 1)?'checked':'';?>>
						<label for="kurensi<?=$k->id?>">
							<?=$k->title.'('.$k->simbol.')'?>
						</label>
						<?php endforeach;?>
					</div>
				</div>
			</div>
            
			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputPassword3">
					Catatan
				</label>
				<div class="col-sm-8">
					<textarea class="form-control" name="catatan"></textarea>
				</div>
			</div>

            <div class="form-group">
                <label class="col-sm-4 control-label" for="inputPassword3">
                    Komponen Pajak
                </label>
                <div class="col-sm-6">
                    <div id="pajak">
                    <?php foreach($pajak_komponen as $p):?>
                    <div class="checkbox clip-check check-primary checkbox-inline">
                        <input type="checkbox" id="kpajak<?=$p->id?>" onchange="hitung()" value="<?=$p->id?>" class="<?=$p->title?>" name="pajak_komponen_id[]">
                        <label for="kpajak<?=$p->id?>">
                            <?=$p->title?>
                        </label>
                    </div>
                    <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-4 control-label" for="inputPassword3">
                    No. PO
                </label>
                <div class="col-sm-8">
                    <input type="text" placeholder="No. PO" name="po" class="form-control" required="required" value="<?=$last_id.'/PO/GSM/'.monthRomawi(date('m')).'/'.date('Y')?>">
                </div>
            </div>

        	<div class="form-group">
				<label class="col-sm-4 control-label" for="inputPassword3">
					Proyek
				</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="proyek" value="<?=$o->keperluan?>">
				</div>
			</div>

        	<div class="form-group">
				<label class="col-sm-4 control-label" for="inputPassword3">
					Dikirim Ke
				</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" value="<?=$o->gudang?>" readonly>
					<input type="hidden" class="form-control" name="gudang_id" value="<?=$o->gudang_id?>" readonly>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputEmail3">
					Tgl. Pengiriman
				</label>
				<div class="col-sm-8">
					<div id="tanggal_transaksi" class="input-append date success no-padding">
                      <input type="text" class="form-control" name="tanggal_transaksi" required>
                      <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                    </div>
				</div>
			</div>

            <div class="form-group">
                <label class="col-sm-4 control-label" for="inputEmail3">
                    Tgl. Pembuatan PO
                </label>
                <div class="col-sm-8">
                    <div id="created_on" class="input-append date success no-padding">
                      <input type="text" class="form-control" name="created_on" required>
                      <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-4 control-label" for="inputPassword3">
                    Term
                </label>
                <div class="col-sm-8">
                    <div class="clip-radio radio-primary">
                        <?php foreach($metode as $m):?>
                        <input type="radio" id="metode<?=$m->id?>" name="metode_pembayaran_id" value="<?=$m->id?>" <?= ($m->title == 'Cash')?'checked':'';?>>
                        <label for="metode<?=$m->id?>">
                            <?=$m->title?>
                        </label>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
            <div id="kredit" style="display:none">
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="inputPassword3">
                        Tempo Pembayaran
                    </label>
                    <div class="col-sm-2">
                        <input type="text" placeholder="" name="lama_angsuran_1" id="lama_angsuran_1" class="form-control text-right" value="0">
                    </div>
                    <div class="col-sm-6">
                        <select class="select2" name="lama_angsuran_2" id="lama_angsuran_2" style="width:100%">
                        <option value="0">-- Pilih Tempo Pembayaran --</option>
                        <option value="hari">Hari</option>
                        <option value="bulan">Bulan</option>
                        <option value="tahun">Tahun</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label" for="inputEmail3">
                    Opsi Desimal
                </label>
                <div class="col-sm-8">
                    <select name="opsi_desimal" id="opsi_desimal">
                    <?php for($i=0;$i<9;$i++):
                    $selected = ($i==2) ? "" : '';
                    ?>
                        <option value="<?=$i?>" <?= $selected ?>><?=$i?></option>
                    <?php endfor;?>
                    </select>
                    <input type="hidden" id="opsi_desimal_val" value="0">
                </div>
            </div>
        </div>
    </div>
    <div id="table-pr"></div>

<?php endforeach;?>

<div class="modal fade" id="modalKontak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Modal title</h4>
			</div>
			<div class="modal-body">
			<form id="form_kontak">
				<input type="hidden" name="jenis_id" value="1">
				<div class="row form-row">
                    <div class="col-sm-12">
                    <fieldset>
                    <legend>Info Identitas</legend>
                        <div class="form-body">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label col-sm-3"><?= lang('code')?></label>
                                <div class="col-sm-7">
                                    <input name="kode" placeholder="" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Nama</label>
                                <div class="col-sm-7">
                                    <input name="title" placeholder="" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Tipe</label>
                                <div class="col-sm-7">
                                    <select name="tipe_id" class="select2" style="width:100%">
                                        <option value="">-- Pilih Tipe Kontak --</option>
                                        <?php foreach($tipe->result() as $t):?>
                                            <option value="<?=$t->id?>"><?=$t->title?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label col-sm-3">UP</label>
                                <div class="col-sm-7">
                                    <input name="up[]" placeholder="" class="form-control" type="text"><br/>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label col-sm-3">Catatan</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="catatan"></textarea>
                                </div>
                            </div>
                        </div>
                        </div>
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                    <fieldset>
                    <legend>Info Kontak</legend>
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-sm-3">Email</label>
                                <div class="col-sm-7">
                                    <input name="email" placeholder="" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Fax</label>
                                <div class="col-sm-7">
                                    <input name="fax" placeholder="" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Telepon</label>
                                <div class="col-sm-7">
                                    <input name="telepon[]" placeholder="" class="form-control" type="text"><br/>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Alamat</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" name="alamat[]"></textarea><br/>
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
                                    <input name="npwp" placeholder="" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">No. Rekening</label>
                                <div class="col-sm-7">
                                    <input name="no_rekening" placeholder="" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Nama Bank</label>
                                <div class="col-sm-7">
                                    <input name="bank" placeholder="" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Atas Nama</label>
                                <div class="col-sm-7">
                                    <input name="a_n" placeholder="" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Alamat Pajak</label>
                                <div class="col-sm-7">
                                    <input name="alamat_pajak" placeholder="" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Acc</label>
                                <div class="col-sm-7">
                                    <input name="acc" placeholder="" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </fieldset>
                    </div> 
                </div>
            </form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary btn-o" data-dismiss="modal">
					Close
				</button>
				<button type="button" class="btn btn-primary" onclick="saveKontak()">
					Save changes
				</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?=assets_url('vendor/bootstrap-datepicker/bootstrap-datepicker.min.js')?>"></script>
<script type="text/javascript" src="<?=assets_url('vendor/jquery-mask-money/jquery.MaskMoney.js')?>"></script>
<script type="text/javascript">
	
    
$("input:checkbox:not(:checked)").each(function() {
	    var total = "#total"+$(this).attr("class");
	    $(total).hide();
	});

	$("input:checkbox").click(function(){
	    var total = "#total"+$(this).attr("class");
	    $(total).toggle();
	});

function saveKontak()
{
    $('#btnSaveKontak').text('saving...'); //change button text
    $('#btnSaveKontak').attr('disabled',true); //set button disable 

    // ajax adding data to database
    $.ajax({
        url : "/gsm/master/kontak/add_json",
        type: "POST",
        data: $('#form_kontak').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modalKontak').modal('hide');
                $("#kontak_id").load("/gsm/purchase/order/load_kontak");
                //reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSaveKontak').text('save'); //change button text
            $('#btnSaveKontak').attr('disabled',false); //set button enable 

        }
    });
}

function getAlamat(id)
{
    $.ajax({
        type: 'POST',
        url: '/gsm/purchase/order/get_alamat/'+id,
        data: {id : id},
        success: function(data) {
            $('#alamat').html(data);
        }
    });
}

function getUp(id)
{
    $.ajax({
        type: 'POST',
        url: '/gsm/purchase/order/get_up/'+id,
        data: {id : id},
        success: function(data) {
            $('#up').html(data);
        }
    });
}
</script>