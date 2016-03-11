<div class="row form-row">
	<div class="col-md-6">
		<div class="col-md-4">
		</div>
		<div class="col-md-8">
			<select class="select2 select_pr" id="" style="width:100%" name="no">
				<option value="0">-- Pilih NO. P.R --</option>
				<?php foreach($pr as $p):?>
				<option value="<?=$p->id?>"><?=$p->no?></option>
				<?php endforeach;?>
			</select>
		</div>
	</div>
</div><p></p>
<script type="text/javascript">
	$(".select_pr").change(function(){
        $(document).find("select.select2").select2();
        var id = $(this).val();
        if(id != 0){
            getPrLain(id);
            hitung();
        }
    })

    function getPrLain(id)
    {
        var rowCount = $('#table tr').length;
        $.ajax({
            type: 'POST',
            url: '/gsm/purchase/order/get_dari_pr_lain/'+id,
            data: {id : id, row_count : rowCount},
            success: function(data) {
                $('#table').append(data);
                hitung();
            }
        });
    }
</script>