<div class="signwrapper">

  <div class="sign-overlay"></div>
  <div class="signpanel"></div>

  <div class="panel signin">
    <div class="panel-heading">
      <h1 class="panel-title"><?= lang('login_heading')?></h1>
    </div>
    <div class="panel-body">
    	<div class=""><?=$message?></div>
      <?php echo form_open("auth/login");?>
        <div class="form-group mb10">
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <?php echo bs_form_input($identity);?>
          </div>
        </div>
        <div class="form-group nomargin">
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <?php echo bs_form_input($password);?>
          </div>
        </div>
        <div><a href="#" class="forgot"><?= lang('login_forgot_password')?></a></div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary pull-right">
			Login <i class="fa fa-arrow-circle-right"></i>
		  </button>
        </div>
      </form>
    </div>
  </div><!-- panel -->

</div>

<!-- start: LOGIN 
		<div class="row">
			<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				<div class="logo margin-top-30">
				</div>
				<!-- start: LOGIN BOX 
				<div class="box-login">
					<?php echo form_open("auth/login");?>
						<fieldset>
							<legend>
								<?= lang('login_heading')?>
							</legend>
							<div id="infoMessage"><?php echo $message;?></div>
							<div class="form-group">
								<span class="input-icon">
									<?php echo form_input($identity);?>
									<i class="fa fa-user"></i> </span>
							</div>
							<div class="form-group form-actions">
								<span class="input-icon">
									<?php echo form_input($password);?>
									<i class="fa fa-lock"></i>
								</span>
							</div>
							<div class="form-actions">
								<button type="submit" class="btn btn-primary pull-right">
									Login <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
							<div class="new-account">
								<?= lang('login_forgot_password')?>
								<a href="login_registration.html">
									<?= lang('click_here')?>
								</a>
							</div>
						</fieldset>
					</form>
				</div>
				<!-- end: LOGIN BOX
			</div>
		</div>
		<!-- end: LOGIN -->

