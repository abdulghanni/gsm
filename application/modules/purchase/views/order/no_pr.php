<div class="row form-row">
	<div class="col-md-6">
		<div class="col-md-4">
		</div>
		<div class="col-md-8">
			<select class="select2 select_pr" id="" style="width:100%" name="no[]">
				<option value="0">-- Pilih NO. P.R --</option>
                <?php foreach($pr as $p):;
                    if($ci->get_pr_status($p->id) != "Close"){
                ?>
                <option value="<?=$p->id?>"><?=$p->no?></option>
                <?php } endforeach;?>
			</select>
		</div>
	</div>
</div><p></p>
<script type="text/javascript">
	$(".select_pr").change(function(){
        $(document).find("select.select2").select2();
        var id = $(this).val();
        if(id != 0){
            //getPrLain(id);
            getTablePr();
            //hitung();
        }
    })

    function getTablePr()
    {
        var prId = '';
        $('.select_pr').each(function (index, element) {
                if($(element).val() != ''){
                    prId += $(element).val()+',';
                }
            });
        $.ajax({
            type: 'POST',
            url: '/gsm/purchase/order/get_table_pr/',
            data: {pr_id : prId},
            success: function(data) {
                //alert(data)
                $('#table-pr').html(data);
            }
        });
    }

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