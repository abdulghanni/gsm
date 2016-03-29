<link rel="stylesheet" href="<?php echo base_url().'assets/vendor/select2/select2.css' ?>">
	<?php $nm_f="ref";
	?>
		<!--Bagian Kanan-->
	<?php echo form_dropdown($nm_f,$opt_po,(isset($val[$nm_f]) ? $val[$nm_f] : ''),'class="select2" id="'.$nm_f.'-'.$idp.'" onchange="carilist_'.$idp.'(this.value)" style="width:100%;" ')?>
<script src="<?php echo base_url().'assets/vendor/select2/select2.min.js'?>"></script>
<script>
            $(document).ready(function(e){
            $('select.select2').select2({});
            });
                function carilist_<?php echo $idp?>(v){
                 var idlist=<?php echo $idp?>;
                 if($('#list-'+idlist).length == 0){
                    $('#list').append('<fieldset id="list-'+idlist+'" ></fieldset>');}
$('#list-'+idlist).load('<?php echo base_url() ?>stok/pengeluaran/carilist',{v:v});
    }
        function getRandomInt(min, max) {
  return Math.floor(Math.random() * (max - min)) + min;
}
</script>