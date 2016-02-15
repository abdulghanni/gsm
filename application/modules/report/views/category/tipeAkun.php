<div class="form-group">
					
					<div 

class="col-sm-3">
						

<?php $nm_f="type_account";?>
						

<label for="<?php echo $nm_f?>">Type Account</label>
					</div>
					<div class 

="col-sm-3">
						

<?php echo 

form_dropdown($nm_f,$opt_account,(isset($val[$nm_f]

) ? $val[$nm_f] : ''),'class="chosen-select 

form-control" id="'.$nm_f.'" 

data-placeholder="Choose a State..." required ')?>
					</div>
				</div>