<div class="form-group">
					
					<div 

class="col-sm-3">
						

<?php $nm_f="entry_by";?>
						

<label for="<?php echo $nm_f?>">Entry By</label>
					</div>
					<div class 

="col-sm-3">
						

<?php echo 

form_dropdown($nm_f,$opt_user,(isset($val[$nm_f]

) ? $val[$nm_f] : ''),'class="chosen-select 

form-control" id="'.$nm_f.'" 

data-placeholder="Choose a State..."  ')?>
					</div>
				</div>