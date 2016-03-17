<div class="modal fade" id="modal_fraksi<?=$id?>" role="dialog">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">User Form</h3>
            </div>
            <div class="modal-body form">
                <form class="form-horizontal" id="form_fraksi">
                <input type="hidden" value="" name="fraksi_id"/>
                <div class="form-body">
                	<div class="row">
	                    <div class="col-md-12">
	                        <div class="form-group">
	                            <label class="control-label col-md-3">Fraksi 1</label>
	                            <div class="col-md-3">
	                            <input type="text" class="form-control" value="0" id="tf-1<?=$id?>">
	                            </div>
	                            <div class="col-md-6">
	                                <?php 
	                                    $js = "class='select2' style='width:100%'' id='sf-1$id'";
	                                    echo form_dropdown('satuan', $options_satuan,'',$js); 
	                                ?>
	                            </div>
	                            <input type="hidden" id="sf1-num<?=$id?>" value="0">
	                        </div>
	                        <div class="form-group">
	                            <label class="control-label col-md-3">Fraksi 2</label>
	                            <div class="col-md-3">
	                            <input type="text" class="form-control" id="tf-2<?=$id?>" value="0">
	                            </div>
	                            <div class="col-md-6">
	                                <?php 
	                                    $js = "class='select2' style='width:100%'' id='sf-2$id'";
	                                    echo form_dropdown('satuan', $options_satuan,'',$js); 
	                                ?>
	                            </div>
	                            <input type="hidden" id="sf2-num<?=$id?>" value="0">
	                        </div>
	                        <div class="form-group">
	                            <label class="control-label col-md-3">Fraksi 3</label>
	                            <div class="col-md-3">
	                            <input type="text" class="form-control" id="tf-3<?=$id?>" value="0">
	                            </div>
	                            <div class="col-md-6">
	                                <?php 
	                                    $js = "class='select2' style='width:100%'' id='sf-1$id'";
	                                    echo form_dropdown('satuan', $options_satuan,'',$js); 
	                                ?>
	                            </div>
	                            <input type="hidden" id="sf3-num<?=$id?>" value="0">
	                        </div>
	                    </div>
	                </div>
	            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnFraksi<?=$id?>">OK</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">

$("#sf-1<?=$id?>").change(function(){
    var id = $(this).val(),
    fraksi_id = $('[name="fraksi_id"]').val();
    if(id != 0){
        $("#satuanlist<?=$id?>").select2().select2('val',id);
         $.ajax({
            type: "GET",
            dataType: "JSON",
            url: '/gsm/purchase/request/get_satuan_num/'+id,
            success: function(data) {
                $("#sf1-num<?=$id?>").val(data);

        		$("#satuanlist_num<?=$id?>").val(data);
            }
        });
    }
})
.change();

    $("#sf-3<?=$id?>").change(function(){
        var id = $(this).val();
        if(id != 0){
	         $.ajax({
	            type: "GET",
	            dataType: "JSON",
	            url: '/gsm/purchase/request/get_satuan_num/'+id,
	            success: function(data) {
	                $("#sf3-num<?=$id?>").val(data);
	            }
	        });
	    }
    })
    .change();
    $("#sf-2<?=$id?>").change(function(){
        var id = $(this).val();
        if(id != 0){
	         $.ajax({
	            type: "GET",
	            dataType: "JSON",
	            url: '/gsm/purchase/request/get_satuan_num/'+id,
	            success: function(data) {
	                $("#sf2-num<?=$id?>").val(data);
	            }
	        });
	    }
    })
    .change();

    $("#satuanlist<?=$id?>").change(function(){
        var id = $(this).val();
        if(id != 0){
	        $("#sf-1<?=$id?>").select2().select2('val',id);
	         $.ajax({
	            type: "GET",
	            dataType: "JSON",
	            url: '/gsm/purchase/request/get_satuan_num/'+id,
	            success: function(data) {
	                $("#satuanlist_num<?=$id?>").val(data);
	                $("#sf1-num<?=$id?>").val(data);
	            }
	        });
	         hitung<?=$id?>();
	    }
    })
    .change();

   	$("#btnFraksi<?=$id?>").on('click', function () {
   		hitung<?=$id?>()
		$("#modal_fraksi<?=$id?>").modal('hide');
    });

</script>