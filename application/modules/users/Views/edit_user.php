<section id="page-title">
    <div class="row">
        <div class="col-sm-8">
          <h1><?php echo lang('edit_user_heading');?></h1>
        </div>
        <ol class="breadcrumb">
            <li>
                <a href="<?=base_url('users')?>"><span><?php echo lang('index_heading');?></span></a>
            </li>
            <li class="active">
                <span><?php echo lang('edit_user_heading');?></span>
            </li>
        </ol>
    </div>
</section>

<div class="container-fluid container-fullw bg-white">
  <div class="row">
    <div class="col-md-12">
      <div id="infoMessage"><?php echo $message;?></div>
      <?php //echo form_open(uri_string());?>
        <div class="container-fluid container-fullw bg-white">
              <?php echo form_open_multipart(uri_string(), array('id'=>'uploadForm'));?>
                          <fieldset>
                            <legend>
                              Account Info
                            </legend>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="control-label">
                                    <?php echo lang('edit_user_fullname_label', 'full_name');?>
                                  </label>
                                  <?php echo bs_form_input($full_name);?>
                                </div>
                                
                                <div class="form-group">
                                  <label class="control-label">
                                    Email Address
                                  </label>
                                  <?php echo bs_form_input($email);?>
                                </div>
                                
                                <div class="form-group">
                                  <label class="control-label">
                                    <?php echo lang('edit_user_password_label', 'password');?> <br />
                                  </label>
                                    <?php echo bs_form_input($password);?>
                                </div>
                                
                                <div class="form-group">
                                  <label>
                                    Photo Profile
                                  </label>
                                  <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"><img src="<?=$photo?>" /></div>
                                    <div>
                                      <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="photo"></span>
                                      <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="control-label">
                                    <?php echo lang('edit_user_username_label', 'username');?>
                                  </label>
                                    <?php echo bs_form_input($username);?>
                                </div>
                                <div class="form-group">
                                  <label class="control-label">
                                   <?php echo lang('edit_user_phone_label', 'phone');?>
                                  </label>
                                    <?php echo bs_form_input($phone);?>
                                </div> 
                                <div class="form-group">
                                  <label class="control-label">
                                   <?php echo lang('edit_user_password_confirm_label', 'password_confirm');?>
                                  </label>
                                  <?php echo bs_form_input($password_confirm);?>
                                </div> 
                                <div class="form-group">
                                  <?php if ($this->ion_auth->is_admin()): ?>
                                    <label class="control-label">
                                      <?php echo lang('edit_user_groups_heading');?>
                                    </label>
                                    <?php foreach ($groups as $group):?>
                                        <?php
                                            $gID=$group['id'];
                                            $checked = null;
                                            $item = null;
                                            foreach($currentGroups as $grp) {
                                                if ($gID == $grp->id) {
                                                    $checked= ' checked="checked"';
                                                break;
                                                }
                                            }
                                        ?>
                                        <div class="checkbox clip-check check-primary">
                                          <input name="groups[]" type="checkbox" id="checkbox<?php echo $group['id'];?>" value="<?php echo $group['id'];?>" <?= $checked ?>>
                                          <label for="checkbox<?php echo $group['id'];?>">
                                            <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
                                          </label>
                                        </div>
                                    <?php endforeach?>

                                    <?php endif ?>

                                    <?php //echo form_hidden('id', $user->id);?>
                                    <?php //echo form_hidden($csrf); ?>
                                </div>
                              </div>
                            </div>
                          </fieldset>
                          
                          <div class="row">
                            <div class="col-md-12">
                              <button class="btn btn-primary pull-right" type="submit">
                                Update <i class="fa fa-arrow-circle-right"></i>
                              </button>
                            </div>
                          </div>
                        </form>
            </div>
      <!--
            <p>
                  
            </p>

            <p>
                  
            </p>

            <p>
                  <?php echo lang('edit_user_company_label', 'company');?> <br />
                  <?php echo form_input($company);?>
            </p>

            <p>
                  
            </p>

            <p>
                  
            </p>

            <p>
                  <br />
                  
            </p>

            

            <p><?php echo form_submit('submit', lang('edit_user_submit_btn'));?></p>
  -->
      <?php echo form_close();?>
    </div>
  </div>
</div>
<!--
<form id="uploadForm" action="<?php echo base_url().'users/upload'?>" method="post">
<div id="targetLayer">No Image</div>
<div id="uploadFormLayer">
<label>Upload Image File:</label><br/>
<input name="photo" type="file" class="inputFile" />
<input type="submit" value="Submit" class="btnSubmit" />
</form>
-->