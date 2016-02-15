<style>
.bDiv{
		height:300px!important;
}
</style>

<?php
error_reporting(0);
 echo $js_grid; ?>
<!--input type="button" value="Tambah" onclick="window.location = '<?//= base_url() ?>index.php/ms_con/add'"/-->
<script type="text/javascript">
var _base_url = '<?php echo  base_url() ?>';
var controller = '<?php echo $this->file_name?>/';
function del(id) { 
  i = confirm('Hapus : ' + id + ' ?');;
  if (i) {
    window.location = _base_url + controller + 'delete/' + id;
  }
}
//$('.flex1').flexigrid({height:'auto',width:'auto',striped:false});

function edit(id) {
  window.location = _base_url + controller + 'input/' + id;
}

function detail(id) {
  window.location = _base_url + controller + 'form/' + id;
}
function btn(com,grid)
{
    if (com == 'add' ) {
		window.location = _base_url + controller + 'form/';
    }
	
    if (com == 'select' )
    {
		$('.bDiv tbody tr',grid).addClass('trSelected');
    }

    if (com == 'deselect')
    {
		$('.bDiv tbody tr',grid).removeClass('trSelected');
    }
	if(com=='edit'){
		if($('.trSelected',grid).length==1){ 
    			var abbr = [];
    				$('.hDiv th', flex).each( function(index){
       			 abbr[index] = $(this).attr('abbr');
  				  });
		//var items = $('.trSelected',grid);
 		 window.location = _base_url + controller + 'form/' + $('td:nth-child('+ (1+$.inArray('idnya',abbr)) +')>div', '.trSelected',grid).text();
			} else {
				return false;
			} 
	}
	if (com=='delete')
    {
           if($('.trSelected',grid).length>0){
			   if(confirm('Delete ' + $('.trSelected',grid).length + ' items?')){
		        var flex = $(grid).closest('.flexigrid');
    			var abbr = [];
    				$('.hDiv th', flex).each( function(index){
       			 abbr[index] = $(this).attr('abbr');
  				  });
    	
   				 $('.res').html('');//div.res - area for display result
		            var items = $('.trSelected',grid);
		            var itemlist ='';
		        	for(i=0;i<items.length;i++){
					//itemlist+=items[i].id+",";
					//var iteming=$('td:"no_reg" >div', items[i]).text();
					itemlist+=$('td:nth-child('+ (1+$.inArray('idnya',abbr)) +')>div', items[i]).text()+",";
					}
					  	
					$.ajax({
					   type: "POST",
					   url: "<?php echo site_url($this->utama."/deletec");?>",
					   data: "items="+itemlist,
					   success: function(data){
					   	$('#flex1').flexReload();
						//alert(data);
						alert('Sukses!');
					   }
					});
				}
			} else {
				return false;
			} 
      }           
}
setInterval("$('#flex1').flexReload()",50000 );
</script>
<!-- start: PAGE TITLE -->
<section id="page-title">
    <div class="row">
        <div class="col-sm-8">
            <h1 class="mainTitle"><?php echo $title?></h1>
        </div>
        <ol class="breadcrumb">
            <li>
                <span><?php echo lang('order');?></span>
            </li>
            <li class="active">
                <span>Index</span>
            </li>
        </ol>
    </div>
</section>
    <div class="container-fluid container-fullw bg-white">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
				<div class="col-md-12">
				<form method="post">
					<table >
						<tr>
						<th><h4>FILTER</h4></th>
						</tr>
				<tr>
					<td><?php echo form_checkbox('gdg','1',($this->input->post('gdg')?$this->input->post('gdg'):'')); ?>&nbsp;</td>
					<td>Gudang</td>
					<td>:</td>
					<td><?php echo bs_form_dropdown('gudang_id',$opt_gudang,($this->input->post('gudang_id')?$this->input->post('gudang_id'):'')); ?></td>
				</tr>
					<tr>
						<td><?php echo form_checkbox('item','1',($this->input->post('item')?$this->input->post('item'):'')); ?>&nbsp;</td>
					<td>Item</td>
					<td>:</td>
					<td><?php echo bs_form_dropdown('barang_id',$opt_item,($this->input->post('barang_id')?$this->input->post('barang_id'):'')); ?></td>
				</tr>
					<tr>
						<td colspan='3'><input type="submit" value="GO"></td>
					</tr>
				</table>
				</form><br/>
				</div>
				<!--div class="col-md-12 space20">
                    <a href="<?= base_url('purchase/order/input')?>" class="btn btn-green add-row">
                        <?= lang('add') ?> <i class="fa fa-plus"></i>
                    </a>
                </div-->
            </div>
            <div id="MsgGood" class="alert alert-success text-center" style="display:none;"></div>
            <div class="table-responsive">
                
				<div class="layout-grid">
					<table id="flex1" style="display:none; "></table>
				</div>
					
						<!--table class="table table-striped table-bordered table-hover table-full-width" id="table">
                    <thead>
                        <tr>
                            <th width="5%" align="center">No.</th>
                            <th width="10%"><?php echo 'No. Transaksi';?></th>
                            <th width="15%"><?php echo 'Supplier';?></th>
                            <th width="5%" class="text-center"><?php echo 'Tanggal Pengiriman';?></th>
                            <th width="5%" class="text-center"><?php echo 'Metode Pembayaran';?></th>
                            <th width="10%"><?php echo 'No. PO';?></th>
                            <th width="15%"><?php echo 'Dikirim Ke';?></th>
                            <th width="10%" class="text-center"><?php echo lang('action');?></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table-->
            </div>
        </div>
    </div>
</div>