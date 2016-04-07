<div class="row form-row">
	<div class="col-md-6">
		<div class="col-md-4">
		</div>
		<div class="col-md-8">
			<select class="select2 select_so" id="" style="width:100%" name="no">
				<option value="0">-- Pilih NO. S.O --</option>
				<?php foreach($so as $p):?>
				<option value="<?=$p->id?>"><?=$p->so?></option>
				<?php endforeach;?>
			</select>
		</div>
	</div>
</div><p></p>
<script type="text/javascript">
	$(".select_so").change(function(){
        $(document).find("select.select2").select2();
        var id = $(this).val();
        if(id != 0){
            getTable(id);
            //hitung();
        }
    })

    function getTable()
    {
        var id = '';
        $('.select_so').each(function (index, element) {
                if($(element).val() != ''){
                    id += $(element).val()+',';
                }
            });
        $.ajax({
            type: 'POST',
            url: '/gsm/sales/penjualan/get_table/',
            data: {id : id},
            success: function(data) {
                $('#table').html(data);
            }
        });
    }
</script>