<fieldset>
<legend>Info Work Order</legend>
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label class="col-sm-3 control-label" for="inputPassword3">
        No. Work Order
      </label>
      <div class="col-sm-8">
        <input type="text" placeholder="No. Work Order" name="no" value="<?=$det->no?>" class="form-control" readonly>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-3 control-label" for="inputPassword3">
        Catatan
      </label>
      <div class="col-sm-8">
        <textarea class="form-control" name="catatan"><?=$det->catatan?></textarea>
      </div>
    </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
      <label class="col-sm-3 control-label" for="inputPassword3">
        Customer
      </label>
      <div class="col-sm-8">
        <input type="text" placeholder="No. Work Order" name="no" value="<?=$det->kontak?>" class="form-control" readonly>
      </div>
    </div>
    
    <div class="form-group">
      <label class="col-sm-3 control-label" for="inputPassword3">
        Project
      </label>
      <div class="col-sm-8">
        <input type="text" placeholder="Project" name="project" value="<?=$det->project?>" class="form-control" readonly>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-3 control-label" for="inputEmail3">
        Tgl. Dibutuhkan
      </label>
      <div class="col-sm-8">
        <input type="text" placeholder="No. Work Order" name="no" value="<?=dateIndo($det->tgl)?>" class="form-control" readonly>
      </div>
    </div>
   </div>
</div>
</fieldset>
<fieldset>
<legend>Info Produksi</legend>
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label class="col-sm-3 control-label" for="inputPassword3">
        No. Produksi
      </label>
      <div class="col-sm-8">
        <input type="text" placeholder="" name="no" value="" class="form-control" required="required">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label" for="inputEmail3">
        Tgl. Produksi
      </label>
      <div class="col-sm-8">
        <div id="tanggal_transaksi" class="input-append date success no-padding">
          <input type="text" class="form-control" name="tgl" required>
          <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label" for="inputPassword3">
        Catatan
      </label>
      <div class="col-sm-8">
        <textarea placeholder="" name="catatan" value="" class="form-control"></textarea>
      </div>
    </div>
  </div>
</div>
</fieldset>
<div class="panel-group" id="accordion">
  <div class="panel panel-default">
      <?php $i=1;foreach($ref as $r){?>
      <div class="panel-heading">
          <div class="panel-title small">
              <a data-toggle="collapse" data-parent="#accordion" href="#<?=$r->id?>">
                <h4><?= $i++.'.'.getValue('title', 'barang', array('id'=>'where/'.$r->barang_id))?></h4>
                <table class="table table-bordered table-hover" id="table_id" style="width:100%">
                  <thead>
                    <tr>
                      <th width="10%">Kode Barang</th>
                      <th width="50%">Nama Barang</th>
                      <th width="10%">Qty Diminta</th>
                      <th width="10%">Sisa Stok</th>
                      <th width="10%">Qty Dibuat</th>
                      <th width="10%">Satuan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <?= getValue('kode', 'barang', array('id'=>'where/'.$r->barang_id))?>
                        <input type="hidden" name="kode_barang[]" value="<?= $r->barang_id ?>">
                      </td>
                      <td>
                        <?= getValue('title', 'barang', array('id'=>'where/'.$r->barang_id))?>
                      </td>
                      <td align="right"><?=$r->qty.' '.getValue('title', 'satuan', array('id'=>'where/'.$r->satuan_id))?></td>
                      <td align="right"><?= getValue('dalam_stok', 'stok', array('barang_id'=>'where/'.$r->barang_id)).' '.getSatuan($r->barang_id)?></td>
                      <td align="right"><input type="text" name="jumlah[]" class="text-right number" value="0" style="width:100%" id="dibuat-<?=$r->id?>" onkeyup="hitung('<?=$r->id?>')"></td>
                      <td>
                        <?= getValue('title', 'satuan', array('id'=>'where/'.$r->satuan_id))?>
                        <input type="hidden" name="satuan_id[]" value="<?= $r->satuan_id ?>">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </a>
          </div>
      </div>
      <div id="<?=$r->id?>" class="panel-collapse collapse out">
          <div class="panel-body">
              <h4>Komposisi</h4>
                <?php $j=1;
                $assembly_id = getValue('id', 'assembly', array('barang_id'=>'where/'.$r->barang_id));
                $list = getAll('assembly_list', array('assembly_id'=>'where/'.$assembly_id));
                if($list->num_rows() > 0){
                ?>

                  <input type="hidden" value="1" name="is_have_komposisi">
              <table class="table table-bordered table-hover" id="table_id">
                <thead>
                  <tr>
                    <th width="1%">No</th>
                    <th width="10%">Kode Barang</th>
                    <th width="59%">Nama Barang</th>
                    <th width="10%" id="th-bth-<?=$r->id?>">Qty Dibutuhkan</th>
                    <th width="10%">Satuan</th>
                    <th width="10%">Sisa Stok</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                      foreach($list->result() as $l):
                  ?>
                  <tr>

                    <td><?=$j++?></td>
                    <td>
                      <?= getValue('kode', 'barang', array('id'=>'where/'.$l->kode_barang))?>
                      <input type="hidden" value="<?=$l->kode_barang?>" name="barang_id_komposisi[]">
                    </td>
                    <td><?= getValue('title', 'barang', array('id'=>'where/'.$l->kode_barang))?></td>
                    <td align="right" class="val-bth<?=$r->id?>">
                      <?=$l->jumlah?>
                    </td>
                      <input type="text" name="jumlah_komposisi" value="<?=$l->jumlah?>" class="fix-val<?=$r->id?>">
                    <td>
                      <?= getValue('title', 'satuan', array('id'=>'where/'.$l->satuan_id))?>
                      <input type="hidden" name="satuan_id_komposisi" value="<?=$l->satuan_id?>">
                    </td>
                    <td>
                      <?=
                      $sisa = getValue('dalam_stok', 'stok', array('barang_id'=>'where/'.$l->kode_barang));
                      $sisa.' '.getSatuan($l->kode_barang)?>
                      <input type="hidden" value="<?=$sisa?>" class="fix-val<?=$r->id?>">
                    </td>
                  </tr>
                  <?php endforeach;}else{
                    echo 'Barang tidak memiliki Komposisi rakitan';?>
                    <input type="hidden" value="<?=$r->barang_id?>" name="barang_id_komposisi[]">
                    <input type="hidden" value="<?=$r->satuan_id?>" name="satuan_id_komposisi[]">
                    <input type="hidden" value="0" name="is_have_komposisi">
                </tbody>
              </table>
              <?php } ?>
          </div>
      </div>
    <?php } ?>
  </div>
</div>

<script type="text/javascript">
$('.input-append.date')
  .datepicker({
      todayHighlight: true,
      autoclose: true,
      format: "dd-mm-yyyy"
  });

$('.number').maskMoney(
  {allowZero:true,
   precision:0
  }
  );
  function hitung(id){
    var val = $("#dibuat-"+id).val();
        val = parseInt(val);
    $("#th-bth-"+id).text("Qty Dibuthkan(x"+val+")");
    $(".val-bth"+id).each(function(index2, element2){
      var v = parseInt($("#dibuat-"+id).val());
      // var v = val;
      var x = 0;
      var x = parseInt($(".fix-val"+id).eq(index2).val());
      y = x*v;
      $(element2).text(y);
    });
  }
</script>
