<?php foreach ($order->result() as $o) :?><div class="row">
	<div class="row">
		<div class="col-md-5">
			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputEmail3">
					Kepada
				</label>
				<div class="col-sm-8">
					<?php 
                    	$js = 'class="select2" style="width:100%" id="kontak_id"';
                    	echo form_dropdown('kontak_id', $options_kontak,'',$js); 
                  	?>
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
        </div>

        <div class="col-md-5">
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
				<label class="col-sm-4 control-label" for="inputPassword3">
					No. PO
				</label>
				<div class="col-sm-8">
					<input type="text" placeholder="No. PO" name="po" class="form-control" required="required" value="<?=$last_id.'/PO-I/GSM/'.monthRomawi(date('m')).'/'.date('Y')?>">
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
    </div>
    <div id="table-pr"></div>

<?php endforeach;?>
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