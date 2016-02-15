<?php 
    $js = 'class="select2" style="width:50%" id="satuan"';
    echo form_dropdown('satuan_lain[]', $options_satuan,'',$js); 
    echo form_input('value_lain[]','','style="width:20%; margin-left:10px;"'); 
?><br/><br/>
<script type="text/javascript"> $(document).find("select.select2").select2();</script>