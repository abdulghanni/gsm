<br><div id='title'>
  <p><br>
    <br>
    <span style="margin:0 auto; font-family:Calibri;">PERIOD : <?php echo $period?></span><br><br>
    <span style="margin:0 auto; font-family:Calibri;">Tanggal Cetak : <?php echo date("d-m-Y")?></span><br>
   <?php if($this->input->post('gudang')){ ?>
    <span style="margin:0 auto; font-family:Calibri;">Gudang : <?php echo GetValue('title', 'gudang',array('id'=>'where/'.$this->input->post('gudang')))?></span><br>
   <?php } ?>
   <?php if($this->input->post('barang')){ ?>
    <span style="margin:0 auto; font-family:Calibri;">Barang : <?php echo GetValue('title', 'barang',array('id'=>'where/'.$this->input->post('barang'))) ?></span><br>
   <?php }?>
  <?php error_reporting(0);// echo print_r($kolom); ?>
  </p>
  <table width="100%" border="1" cellspacing="0" cellpadding="0" >
    <tbody>
      <tr align="center">
        <td>No</td>
        <td>Customer / Supplier</td>
        <td>Transaksi</td>
        <td>No Transaksi</td>
        <td>Gudang</td>
        <td>Barang</td>
        <td>Masuk</td>
        <td>Keluar</td>
        <td>Satuan</td>
        <td>Tanggal Transaksi</td>
        <td>Catatan</td>
      </tr>
      <?php
      $no=1;
      foreach($q as $hasil){
          if($hasil['type']=='out'){
              $qk=$this->db->query("SELECT * FROM sales_order WHERE so='".$hasil['no']."'")->row_array();
              $kontak=$qk['kontak_id'];
              $cust=GetValue('title','kontak',array('id'=>'where/'.$kontak));
              $qcat=$this->db->query("SELECT keterangan FROM stok_pengeluaran WHERE ref='".$hasil['no']."'")->row_array();
              $catatan=$qcat['keterangan'];

          }
          elseif($hasil['type']=='in'){
              $qk=$this->db->query("SELECT * FROM purchase_order WHERE po='".$hasil['no']."'")->row_array();
              $kontak=$qk['kontak_id'];
              $cust=GetValue('title','kontak',array('id'=>'where/'.$kontak));
              $qcat=$this->db->query("SELECT keterangan FROM stok_penerimaan WHERE ref='".$hasil['no']."'")->row_array();
              $catatan=$qcat['keterangan'];
          }
          ?>
      <tr align="center">
        <td><?php echo $no ?></td>
        <td><?php echo $cust ?></td>
        <td><?php echo strtoupper(str_replace('_',' ',$hasil['source'])) ?></td>
        <td><?php echo $hasil['no'] ?></td>
        <td><?php echo GetValue('title', 'gudang',array('id'=>'where/'.$hasil['gudang'])) ?></td>
        <td><?php echo GetValue('title', 'barang',array('id'=>'where/'.$hasil['barang'])) ?></td>
        <td><?php echo ($hasil['type']=='in' ? $hasil['qty'] : '') ?></td>
        <td><?php echo ($hasil['type']=='out' ? $hasil['qty'] : '') ?></td>
        <td><?php echo GetValue('title','satuan',array('id'=>'where/'.$hasil['satuan'])) ?></td>
        <td><?php echo date('d-m-Y',strtotime($hasil['tgl'])) ?></td>
        <td><?php echo $catatan ?></td>
      </tr>
      <?php $no++; }?>
    </tbody>
  </table>
  <p>&nbsp;</p>
</div>
<div id='dataarea'></div>