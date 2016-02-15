
			<div class="form-group">
					
					<?php $nm_f="from";?>
					<div class="col-sm-3">
				   <label for="<?php echo $nm_f?>">From</label>
						</div><div class="col-sm-3">
						<div class="input-group">
							<?php echo form_input($nm_f,$a= (isset($val[$nm_f]) ? $val[$nm_f] : ''),"id='$nm_f' class='validate[required] form-control date-picker' data-date-format='yyyy-mm-dd'");?>
							<span class="input-group-addon">
								<i class="fa fa-calendar bigger-110"></i>
							</span>
						</div>
					</div>
					
				</div>
			<div class="form-group">
					
					<?php $nm_f="to";?>
					<div class="col-sm-3">
				   <label for="<?php echo $nm_f?>">To</label>
						</div><div class="col-sm-3">
						<div class="input-group">
							<?php echo form_input($nm_f,$a= (isset($val[$nm_f]) ? $val[$nm_f] : ''),"id='$nm_f' class='validate[required] form-control date-picker' data-date-format='yyyy-mm-dd'");?>
							<span class="input-group-addon">
								<i class="fa fa-calendar bigger-110"></i>
							</span>
						</div>
					</div>
					
				</div>