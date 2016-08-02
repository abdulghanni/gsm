<button id="remove" class="btn btn-danger" type="button" style="display:none">Hapus <i class="fa fa-remove"></i></button>
    <div class="row">
		<div class="col-sm-12">
		<div class="table-responsive">
			<table id="table" class="table table-striped">
				<thead>
					<tr>
						<th width="1%">#</th>
						<th width="1%"> No Ref </th>
						<th width="8%"> SS Barang </th>
						<th width="5%"> Kode Barang </th>
						<th width="10%"> Nama Barang </th>
						<th width="20%"> Deskripsi </th>
						<th width="20%"> Catatan </th>
						<th width="5%">Qty</th>
						<th width="5%"> Satuan </th>
						<th width="10%"> Harga </th>
						<th width="5%">Disc(%)</th>
						<th width="10%"> Sub Total </th>
						<th width="10%">Attachment</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$totalpluspajak = $totalpajak = $total = $saldo = $totaldiskon = 0;
						$i=1;foreach($order_list->result() as $ol): 
						$subtotal = $ol->jumlah*$ol->harga;
						$totaldiskon = $totaldiskon + ($subtotal * ($ol->disc/100));
						$total = $total + $subtotal;
					?>
					<tr>
						<td>
						<div class="checkbox clip-check check-primary checkbox-inline">
							<input type="checkbox" id="row<?=$ol->id?>" value="" class="cek" name="row">
							<label for="row<?=$ol->id?>">
							</label>
						</div>
						</td>
						<td><input type="text" value="<?=getValue('no', 'purchase_request', array('id'=>'where/'.$ol->request_id))?>" readonly></td>
						<input type="hidden" name="request_id[]" value="<?=$ol->request_id?>">
						<?php $src = (!empty($ol->photo))?base_url("uploads/barang/$ol->barang_id/$ol->photo") : assets_url('assets/images/no-image-mid.png') ?>
						<td><img height="75px" width="75px" src="<?=$src?>"></td>
						<td><?=$ol->kode_barang?></td>
						<input type="hidden" name="kode_barang[]" class="text-right" value="<?=$ol->barang_id?>">
						</td>
						<td>
							<textarea name="nama_barang[]" class=""><?=$ol->nama_barang?></textarea>
						</td>
						<td>
							<textarea name="deskripsi[]" class="" placeholder="Isi deskripsi dan catatan kaki perbarang disini"><?=$ol->deskripsi?></textarea>
						</td>
						<td>
							<textarea name="catatan_barang[]" class="" placeholder="Isi catatan kaki perbarang disini"><?=$ol->catatan?></textarea>
						</td>

						<td class="text-right"><input type="text" name="jumlah[]" class="text-right" value="<?=$ol->jumlah?>" id="jumlah<?=$i?>"></td>
						<td><?=$ol->satuan?></td>
						<input type="hidden" name="satuan[]" class="text-right" value="<?=$ol->satuan_id?>">
						<td class="text-right"><input type="text" name="harga[]" class="text-right harga" value="<?=number_format($ol->harga, 2)?>" id="harga<?=$i?>"></td>
						<td class="text-right">
						<input type="text" name="disc[]" class="text-right disc" value="<?=$ol->disc?>" id="disc<?=$i?>">
						<input type="hidden" name="subdisc[]" class="text-right subdisc" value="0" id="subdisc<?=$i?>">
						<input type="hidden" name="pajak[]" class="text-right pajak" value="0" id="pajak<?=$i?>">
						</td>
						<td class="text-right"><input type="text" name="subtotal" class="text-right subtotal" value="<?=number_format($subtotal, 2)?>" id="subtotal<?=$i?>" readonly>
						</td>
						
						<td>
							<?php if(!empty($ol->attachment)){?>
							<a target="_blank" href="<?= base_url("uploads/pr/".$ol->created_by."/".$ol->attachment)?>"><?=$ol->attachment?></a>
						</td>
						<input type="hidden" name="attachment[]" value="<?=$ol->attachment?>">
						<?php }else{?>
						<input type="file" name="attachment[]">
						<?php } ?>
					</tr>
					<script>
					var dec = 2;
					$('select[name=opsi_desimal]').change(function(){ console.log($(this).val());$("#opsi_desimal_val").val($(this).val()); });
					$("#disc<?=$i?>").add('#diskon-tambahan').add("#diskon_tambahan_persen_val").add("#harga<?=$i?>").add("#jumlah<?=$i?>").add("#dibayar").add("#dibayar-nominal").add("#biaya_pengiriman").keyup(function() {

					var dec = $("#opsi_desimal_val").val();
					var dec = parseInt(dec);
					$("#harga<?=$i?>").maskMoney({allowZero:true, precision: dec});
						var a = parseFloat($("#jumlah<?=$i?>").val()),
				        	b = parseFloat($("#harga<?=$i?>").val().replace(/,/g,"")).toFixed(dec),
				        	c = parseFloat($("#disc<?=$i?>").val()),
				        	diBayar = parseFloat($('#dibayar').val().replace(/,/g,"")),
				        	diBayarNominal = parseFloat($('#dibayar-nominal').val().replace(/,/g,"")),
				        	biayaPengiriman = parseFloat($('#biaya_pengiriman').val().replace(/,/g,"")),
				        	diskonTambahan = parseFloat($('#diskon-tambahan').val().replace(/,/g,"")),
				        	diskonTambahanPersen = parseFloat($('#diskon_tambahan_persen_val').val().replace(/,/g,"")),
				        	d = (a*b)*(c/100),//jumlah diskon
				       		val = (a*b)-d,
				       		disc = (a*b)*(c/100),
				        	jmlDisc = 0,
				        	total = 0;
				        $("#subtotal<?=$i?>").val(addCommas(parseFloat(val).toFixed(dec)));
				        $("#subdisc<?=$i?>").val(addCommas(parseFloat(disc).toFixed(dec)));
				        $('.subdisc').each(function (index, element) {
				            jmlDisc = jmlDisc + parseFloat($(element).val().replace(/,/g,""));
				        });

				        $('.subtotal').each(function (index, element) {
				            total = total + parseFloat($(element).val().replace(/,/g,""));
				        });

				        if($('#kpajak1').is(':checked')){
							parseFloat($('#totalPajak').val(total*(10/100)));
							parseFloat($("#pajak<?=$i?>").val(val*(10/100)));
						}else{
							$('#totalPajak').val(parseFloat(0));
							parseFloat($("#pajak<?=$i?>").val(0));
						}
						if($('#kpajak2').is(':checked')){
							$('#totalp2').val(parseFloat(total*(2/100)));
						}else{
							$('#totalp2').val(parseFloat(0));
						}
						if($('#kpajak3').is(':checked')){
							$('#totalp3').val(parseFloat(total*(2/100)));
						}else{
							$('#totalp3').val(parseFloat(0));
						}

						p1 = parseFloat($("#totalPajak").val()),
						p2 = parseFloat($("#totalp2").val()),
				        p3 = parseFloat($("#totalp3").val()),
				        diskonTambahanPersen = total * (diskonTambahanPersen / 100),
				        total = total+biayaPengiriman-diskonTambahan-diskonTambahanPersen;
				        totalpluspajak = total+p1+p2+p3;
				        diBayar = totalpluspajak * (diBayar/100);
				        
				        $('#total-diskon').val(addCommas(parseFloat(jmlDisc).toFixed(dec)));
				        $('#total').val(addCommas(parseFloat(total).toFixed(dec)));
				        
				        //$('#totalPajak').val(addCommas(parseFloat(jmlPajak).toFixed(dec)));
				        $('#total-diskon').val(addCommas(parseFloat(jmlDisc).toFixed(dec)));
				        $('#total').val(addCommas(parseFloat(total).toFixed(dec)));
				        
				        $('#totalpluspajak').val(addCommas(parseFloat(total+p1+p2+p3).toFixed(dec)));
				        var saldo = totalpluspajak-diBayar-diBayarNominal;
				        $('#saldo').val(addCommas(parseFloat(saldo).toFixed(dec)));	
				    });
					</script>
					<?php 
					endforeach;
					$totalpluspajak = $total+$totalpajak;
					?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
	<div class="row">
		<input type="hidden" name="dp" value="0">
		<div id="subTotalPajak"></div>
		<div class="row">
			<div id="panel-total" class="panel-body col-md-5 pull-right">
				<ul class="list-group">
					<li class="list-group-item" id="totalPPN">
						<div class="row">
							<div class="col-md-4">
							PPN 10%
							</div>
							<div class="col-md-6 pull-right">
							<input type="text" id="totalPajak" name="total-ppn" value="0" class="form-control text-right">
							</div>
						</div>
					</li>
					<li class="list-group-item" id="totalPPH22">
						<div class="row">
							<div class="col-md-4">
							PPH 22
							</div>
							<div class="col-md-6 pull-right">
							<input type="text" id="totalp2" name="total-pph22" value="0" class="form-control text-right">
							</div>
						</div>
					</li>
					<li class="list-group-item" id="totalPPH23">
						<div class="row">
							<div class="col-md-4">
							PPH 23
							</div>
							<div class="col-md-6 pull-right">
							<input type="text" id="totalp3" name="total-pph23" value="0" class="form-control text-right">
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-md-4">
							Biaya Pengiriman
							</div>
							<div class="col-md-6 pull-right">
							<input type="text" name="biaya_pengiriman" id="biaya_pengiriman" class="form-control text-right" value="0">
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-md-4">
							Diskon
							</div>
							<div class="col-md-6 pull-right">
							<input type="text" name="total-diskon" id="total-diskon" class="form-control text-right" value="<?=$totaldiskon?>" readonly>
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-md-6">
							Disc Tambahan
									<input type="checkbox" onchange="hitung()" id="disc-tambahan-cek" value="" name="row"> Persen
							</div>
							<div id="disc-tambahan-persen">
								<div class="col-md-4">
								<input type="text" name="diskon_tambahan_persen" id="diskon_tambahan_persen_val" class="form-control text-right" value="0">
								</div>
								<div class="col-md-1">
								%
								</div>
							</div>
							<div id="disc-tambahan-nominal">
								<div class="col-md-6 pull-right">
									<input type="text" name="diskon_tambahan_nominal" id="diskon-tambahan" class="form-control text-right" value="0">
								</div>
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-md-4">
							Total
							</div>
							<div class="col-md-6 pull-right">
							<input type="text" name="total" class="form-control text-right" id="total" value="<?=$total?>" readonly="readonly">
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-md-4">
							Total+Pajak
							</div>
							<div class="col-md-6 pull-right">
							<input type="text" class="form-control text-right" name="gtotal" id="totalpluspajak" value="<?=$totalpluspajak?>" readonly="readonly">
							</div>
						</div>
					</li>
					<div id="total_angsuran" style="display:none">
						<li class="list-group-item">
							<div class="row">
								<div class="col-md-6">
								Uang Muka
									<div class="checkbox clip-check check-primary checkbox-inline">
										<input type="checkbox" onchange="hitung()" id="dp-persen-cek" value="" name="row">
										<label for="dp-persen-cek">
											Persen
										</label>
									</div>
								</div>
								<div id="dp-persen">
									<div class="col-md-4">
									<input type="text" name="dibayar" id="dibayar" class="form-control text-right" value="0">
									</div>
									<div class="col-md-1">
									%
									</div>
								</div>
								<div id="dp-nominal">
									<div class="col-md-6">
										<input type="text" name="dibayar-nominal" id="dibayar-nominal" class="form-control text-right" value="0">
									</div>
								</div>
							</div>
						</li>
						<li class="list-group-item">
						<div class="row">
							<div class="col-md-4">
							Saldo
							</div>
							<div class="col-md-6 pull-right">
							<input type="text" name="saldo" id="saldo" class="form-control text-right" value="0" readonly="readonly">
							</div>
						</div>
					</li>
					</div>
					
				</ul>
			</div>
		</div>
		<div class="row" id="btnSubmit">
			<div class="col-md-7"></div>
			<div class="col-md-2">
				<button type="submit" value="Save as Draft" name="btnDraft" class="btn btn-lg btn-green hidden-print pull-right" style="">
					Save Draft <i class="fa fa-save"></i>
				</button>
				<!--input type="submit" value="Save as Draft" name="btnDraft" class="btn btn-lg btn-green hidden-print pull-right" style=""-->
			</div>
			<div class="col-md-1"></div>
			<div class="col-md-2">
				<button type="submit" value="Submit" name="btnDraft"  class="btn btn-lg btn-primary hidden-print pull-right">
					Submit Request <i class="fa fa-check"></i>
				</button>
				<!--button type="submit" value="Submit" name="btnDraft" class="btn btn-lg btn-primary hidden-print pull-right" style="">Btn</button-->
			</div>
		</div>
	</div>
<script type="text/javascript">
$("#btnDraft").on('click', function(){
        $.ajax({
            url : '/gsm/purchase/order/add_draft',
            type: "POST",
            data: $('#form-po').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                if(data.status) //if success close modal and reload ajax table
                {
                    window.location.href = '/gsm/purchase/order/';
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 

            }
        });
    })
    
function hitung()
{
	if($('#dp-persen-cek').is(':checked')){
		$('#dibayar-nominal').val(parseFloat(0));
	}else{
		$('#dibayar').val(parseFloat(0));
	}

	if($('#disc-tambahan-cek').is(':checked')){
		$('#diskon-tambahan').val(parseFloat(0));
	}else{
		$('#diskon_tambahan_persen_val').val(parseFloat(0));
	}

    	diBayar = parseFloat($('#dibayar').val().replace(/,/g,"")),
    	diBayarNominal = parseFloat($('#dibayar-nominal').val().replace(/,/g,"")),
    	biayaPengiriman = parseFloat($('#biaya_pengiriman').val().replace(/,/g,"")),
    	diskonTambahan = parseFloat($('#diskon-tambahan').val().replace(/,/g,"")),
    	diskonTambahanPersen = parseFloat($('#diskon_tambahan_persen_val').val().replace(/,/g,"")),
    	jmlDisc = 0,
    	total = 0;
    $('.subdisc').each(function (index, element) {
        jmlDisc = jmlDisc + parseFloat($(element).val().replace(/,/g,""));
    });

    $('.subtotal').each(function (index, element) {
        total = total + parseFloat($(element).val().replace(/,/g,""));
    });

    if($('#kpajak1').is(':checked')){
		parseFloat($('#totalPajak').val(total*(10/100)));
	}else{
		$('#totalPajak').val(parseFloat(0));
		parseFloat($('.pajak').val(0));
	}
	if($('#kpajak2').is(':checked')){
		$('#totalp2').val(parseFloat(total*(2/100)));
	}else{
		$('#totalp2').val(parseFloat(0));
	}
	if($('#kpajak3').is(':checked')){
		$('#totalp3').val(parseFloat(total*(2/100)));
	}else{
		$('#totalp3').val(parseFloat(0));
	}

	p1 = parseFloat($("#totalPajak").val()),
	p2 = parseFloat($("#totalp2").val()),
    p3 = parseFloat($("#totalp3").val()),
    diskonTambahanPersen = total * (diskonTambahanPersen / 100),
	total = total+biayaPengiriman-diskonTambahan-diskonTambahanPersen;
    totalpluspajak = total+p1+p2+p3;
    diBayar = totalpluspajak * (diBayar/100);
    
    var saldo = totalpluspajak-diBayar-diBayarNominal;
    $('#total-diskon').val(addCommas(parseFloat(jmlDisc).toFixed(dec)));
    $('#total').val(addCommas(parseFloat(total).toFixed(dec)));
    
    //$('#totalPajak').val(addCommas(parseFloat(jmlPajak).toFixed(dec)));
    $('#total-diskon').val(addCommas(parseFloat(jmlDisc).toFixed(dec)));
    $('#total').val(addCommas(parseFloat(total).toFixed(dec)));
    
    $('#totalpluspajak').val(addCommas(parseFloat(total+p1+p2+p3).toFixed(dec)));
    $('#saldo').val(addCommas(parseFloat(saldo).toFixed(dec)));	
}
$(document).ready(function() {
	$("input:checkbox:not(:checked)").each(function() {
	    var total = "#total"+$(this).attr("class");
	    $(total).hide();
	});

	$(".cek:not(:checked)").each(function() {
	    $("#remove").hide();
	});

	$(".cek:checkbox").click(function(){
	     $("#remove").show();
	});

	 $("#remove").on("click", function () {
        $('table tr').has('input[name="row"]:checked').remove();
        hitung();
    })

	 $("#dp-persen-cek:not(:checked)").each(function() {
	     $("#dp-persen").hide("slow");
	     $("#dp-nominal").show("slow");
	});

	$("#dp-persen-cek").click(function(){
	     $("#dp-persen").toggle("slow");
	     $("#dp-nominal").toggle("slow");
	});

	$("#disc-tambahan-cek:not(:checked)").each(function() {
	     $("#disc-tambahan-persen").hide("slow");
	     $("#disc-tambahan-nominal").show("slow");
	});

	$("#disc-tambahan-cek").click(function(){
	     $("#disc-tambahan-persen").toggle("slow");
	     $("#disc-tambahan-nominal").toggle("slow");
	});

	$('.input-append.date')
        .datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd-mm-yyyy"
        });
    $("#tanggal_transaksi").datepicker("setDate", new Date());
    $("#kontak_id").change(function(){
        var id = $(this).val();
        if(id != 0)getAlamat(id);
        if(id != 0)getUp(id);
    })
    .change();

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

    $('#lama_angsuran_2').change(function(){
        var text = $(this).val();
        $('#angsuran').text('/'+text.toUpperCase());
    })
    .change();

    $('#dibayar').maskMoney({allowZero:true, precision: dec}).attr('maxlength', 6);
    $('#dibayar-nominal').maskMoney({allowZero:true, precision: dec});
    $('#biaya_pengiriman').maskMoney({allowZero:true, precision: dec});
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