
<div id="department">
    <div class="row">
		<div class="col-md-4">
		Mata Uang
		</div>
		<div class="col-md-1">
		:
		</div>
		<div class="col-md-7">
	      <?php echo form_dropdown('kurensi',GetOptAll('kurensi','All'),'','class="kurensi form-control" style="width:100%"') ?>
		</div>
	</div>
</div>
</table>
<script type="text/javascript">
	$(document).ready(function(e){
    	$(".kurensi").select2();
    });
</script>

