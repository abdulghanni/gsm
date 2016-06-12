<div class="row">

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
								<?php 
			                    	$js = 'class="select2" style="width:100%" id="kontak_id"';
			                    	echo form_dropdown('kontak_id', $options_kontak,'',$js); 
			                  	?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputEmail3">
								Alamat Customer
							</label>
							<div class="col-sm-8">
								<div id="alamat">
								<input type="text" name="" value="" class="form-control" readonly>
								</div>
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
                    <div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								No. PO
							</label>
							<div class="col-sm-8">
								<input type="text" name="so" value="" class="form-control">
							</div>
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
								<select class="select2" name="gudang_id" style="width:100%">
								<option value="0">-- Pilih Gudang --</option>
								<?php 
                                	foreach($gudang as $g):?>
                                	<option value="<?=$g->id?>"><?=$g->title?></option>
                              	<?php endforeach;?>
                              	</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword3">
								Project
							</label>
							<div class="col-sm-8">
								<input type="text" name="project" value="" class="form-control">
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
									<option value="0">-- Pilih Lama Angsuran --</option>
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
				<div id="table"></div>
				
<script type="text/javascript" src="<?=assets_url('vendor/bootstrap-datepicker/bootstrap-datepicker.min.js')?>"></script>
<script type="text/javascript" src="<?=assets_url('vendor/jquery-mask-money/jquery.MaskMoney.js')?>"></script>
<script type="text/javascript">
$("#kontak_id").change(function(){
        var id = $(this).val();
        if(id != 0)getAlamat(id);
    })
    .change();
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
</script>