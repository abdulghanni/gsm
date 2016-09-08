<?php foreach ($order->result() as $o) :?><div class="row">

	<input type="hidden" id="ppn_val" value="<?=$ppn_val?>">
	<input type="hidden" id="pph22_val" value="<?=$pph22_val?>">
	<input type="hidden" id="pph23_val" value="<?=$pph23_val?>">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								No. Invoice
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="No. Invoice" name="no" class="form-control" value="<?=$last_id.'/INV-I/GSM/'.monthRomawi(date('m')).'/'.date('Y')?>" required="required">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Tgl. Invoice
							</label>
							<div class="col-sm-8">
								<div id="tanggal_faktur" class="input-append date success no-padding">
                                  <input type="text" class="form-control" name="tanggal_transaksi" required>
                                  <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                                </div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Customer
							</label>
							<div class="col-sm-8">
								<input type="text" name="up" value="<?=$o->kontak?>" class="form-control" readonly>
								<input type="hidden" name="kontak_id" value="<?=$o->kontak_id?>" class="form-control" readonly>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Alamat Customer
							</label>
							<div class="col-sm-8">
								<input type="text" name="alamat" value="<?=$o->alamat?>" class="form-control" readonly>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Mata Uang
							</label>
							<div class="col-sm-8">
								<input type="text" name="up" value="<?=$o->kurensi?>" class="form-control" readonly>
								<input type="hidden" name="kurensi_id" value="<?=$o->kurensi_id?>" class="form-control" readonly>
							</div>
						</div>


						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Term
							</label>
							<div class="col-sm-8">
								<div class="clip-radio radio-primary">
									<?php foreach($metode as $m):
										$checked = ($m->id == $o->metode_pembayaran_id) ? 'checked="checked"' : '';
									?>
									<input type="radio" id="metode<?=$m->id?>" name="metode_pembayaran_id" value="<?=$m->id?>" <?= $checked;?>>
									<label for="metode<?=$m->id?>">
										<?=$m->title?>
									</label>
									<?php endforeach;?>
								</div>
							</div>
						</div>
						<?php $d = "display:none";?>
						<div id="kredit" style="<?=($o->metode_pembayaran_id == 1) ? $d : ''?>">
							<div class="form-group">
								<label class="col-sm-4 control-label" for="inputPassword3">
									Tempo Pembayaran
								</label>
								<div class="col-sm-2">
									<input type="text" placeholder="" name="lama_angsuran_1" id="lama_angsuran_1" class="form-control text-right" value="<?= $o->lama_angsuran_1?>">
								</div>
								<div class="col-sm-6">
									<select class="select2" name="lama_angsuran_2" id="lama_angsuran_2" style="width:100%">
									<option value="0">-- Pilih Tempo Pembayaran --</option>
								    <option value="hari" <?= ($o->lama_angsuran_2 == 'hari') ? 'selected="selected"' : ''?>>Hari</option>
						            <option value="bulan" <?= ($o->lama_angsuran_2 == 'bulan') ? 'selected="selected"' : ''?>>Bulan</option>
						            <option value="tahun" <?= ($o->lama_angsuran_2 == 'tahun') ? 'selected="selected"' : ''?>>Tahun</option>
		              	            </select>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Opsi Bank
							</label>
							<div class="col-sm-8">
								<select class="bank" id="multi" name="" style="width:100%" multiple>
									<?php foreach($bank as $b):?>
                                		<option value="Transfer to <?=$b->nama_bank?> Bank, for <?=$b->an?>, account : <?=$b->norek?>"><?=$b->nama_bank?> - <?=$b->norek?></option>
                                	<?php endforeach;?>
                                </select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Catatan
							</label>
							<div class="col-sm-8">
								<textarea class="form-control" id="catatan" name="catatan"><?=$o->catatan?></textarea>
								<textarea class="form-control" id="catatan-fix" name="" style="display:none;"><?=$o->catatan?></textarea>
							</div>
						</div>
                    </div>
                    <div class="col-md-6">
						<div class="form-group">
							<?php $i = 1;foreach ($so_id as $key => $v) {?>
							<label class="col-sm-4 control-label" for="inputPassword3">
								No. SO <?= (sizeof($so_id) > 1) ? '- '.$i++ : '';?>
							</label>
							<div class="col-sm-8">
								<input type="text" name="so" value="<?=getValue('so', 'sales_order', array('id'=>'where/'.$v))?>" class="form-control">
								<!--<input type="hidden" name="so" value="<?=$pengeluaran['ref_id']?>">-->
							</div>
							<?php } ?>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Batas Pembayaran
							</label>
							<div class="col-sm-8">
								<div id="tanggal_pengiriman" class="input-append date success no-padding">
                                  <input type="text" class="form-control" name="tanggal_pengiriman" required>
                                  <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                                </div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Dikirim Dari
							</label>
							<div class="col-sm-8">
								<input type="text" name="up" value="<?=$o->gudang?>" class="form-control" readonly>
								<input type="hidden" name="gudang_id" value="<?=$o->gudang_id?>" class="form-control" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Project
							</label>
							<div class="col-sm-8">
								<input type="text" name="project" value="<?=$o->project?>" class="form-control">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								No. Faktur
							</label>
							<div class="col-sm-8">
								<input type="text" name="no_faktur" value="" class="form-control" required="required">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Tgl. Faktur
							</label>
							<div class="col-sm-8">
								<div id="tanggal_faktur" class="input-append date success no-padding">
                                  <input type="text" class="form-control" name="tanggal_faktur" required>
                                  <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
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
			                    $selected = ($i==2) ? "selected='selected'" : '';
			                    ?>
			                        <option value="<?=$i?>" <?= $selected ?>><?=$i?></option>
			                    <?php endfor;?>
			                    </select>
			                    <input type="hidden" id="opsi_desimal_val" value="2">
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
				<div id="table"></div>
				
<?php endforeach;?>
<script type="text/javascript" src="<?=assets_url('vendor/bootstrap-datepicker/bootstrap-datepicker.min.js')?>"></script>
<script type="text/javascript" src="<?=assets_url('vendor/jquery-mask-money/jquery.MaskMoney.js')?>"></script>
<script type="text/javascript">
$(document).ready(function() {
	$(document).find("select.bank").select2({
        dropdownAutoWidth : true
    });
});

$(".bank").change(function(){
     var id = $(this).val();
     $("#catatan").val($("#catatan-fix").val()+'\n'+id);
});
$('.input-append.date')
        .datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd-mm-yyyy"
        });
	$("input:checkbox:not(:checked)").each(function() {
	    var total = "#total"+$(this).attr("class");
	    $(total).hide();
	});

	$("input:checkbox").click(function(){
	    var total = "#total"+$(this).attr("class");
	    $(total).toggle();
	});

	$('input:radio[name=metode_pembayaran_id]').click(function() {
      var val = $('input:radio[name=metode_pembayaran_id]:checked').val();
      if(val==1){
        $('#kredit').hide("slow");
        $('#total_angsuran').hide("slow");
      }else{
        $('#kredit').show("slow");
        $('#total_angsuran').show("slow");
      }
    });
</script>