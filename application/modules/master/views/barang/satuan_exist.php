<?php 
foreach($ex as $as){
    $js = 'class="select2" style="width:50%" id="satuan"';
    echo form_input('satuan_lain_id[]',$as['id'],'style="display:none;"'); 
    echo form_dropdown('satuan_lain[]', $options_satuan,$as['satuan'],$js); 
    echo form_input('value_lain[]',$as['value'],'style="width:20%; margin-left:10px;"'); 
}
?><br/><br/>
<script type="text/javascript"> $(document).find("select.select2").select2();</script>