<?php 
    $js = 'class="select2" style="width:100%" id="satuan"';
    echo form_dropdown('satuan[]', $options_satuan,'',$js); 
?><br/><br/>
<script type="text/javascript"> $(document).find("select.select2").select2();</script>