
			<div class="form-group">
					
					<?php $nm_f="period";?>
					<div class="col-sm-3">
				   <label for="<?php echo $nm_f?>">Period</label>
						</div><div class="col-sm-3">
						<div class="input-group">
							<?php echo form_input($nm_f,$a= (isset($val[$nm_f]) ? $val[$nm_f] : ''),"id='$nm_f' class='validate[required] form-control date-picker' data-date-format='yyyy-mm'");?>
							<span class="input-group-addon">
								<i class="fa fa-calendar bigger-110"></i>
							</span>
						</div>
					</div>
					
				</div>