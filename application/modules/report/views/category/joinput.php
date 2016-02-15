<div class="form-group">
					
					<div class="col-sm-3">
						<?php $nm_f="jo";?>
						<label for="<?php echo $nm_f?>">Job Order</label>
					</div>
					<div class ="col-sm-3">
						<?php echo form_input($nm_f,(isset($val[$nm_f]) ? $val[$nm_f] : ''),'class=" form-control" id="'.$nm_f.'" ')?>
					</div>
				</div>