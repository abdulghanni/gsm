<!-- start: PAGE TITLE -->
<section id="page-title">
    <div class="row">
        <div class="col-sm-8">
            <h1 class="mainTitle"><?php echo lang('index_heading');?></h1>
        </div>
        <ol class="breadcrumb">
            <li>
                <span><?php echo lang('index_heading');?></span>
            </li>
            <li class="active">
                <span>Index</span>
            </li>
        </ol>
    </div>
</section>
<div class="row">
    <div class="col-lg-12">
        <div class="tabbable">
            <ul id="myTab2" class="nav nav-tabs nav-justified">
                <li class="active">
                    <a href="#myTab2_example1" data-toggle="tab">
                        Daftar Pengguna
                    </a>
                </li>
                <li>
                    <a href="#myTab2_example2" data-toggle="tab">
                        Daftar Approver
                    </a>
                </li>
                <li>
                    <a href="#myTab2_example3" data-toggle="tab">
                        Daftar Group Pengguna
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="myTab2_example1">
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="over-title margin-bottom-15"><?php echo lang('index_subheading');?></h5>
                                <div class="row">
                                    <div class="col-md-12 space20">
                                        <button class="btn btn-green add-row" onclick="add_user()">
                                            <?= lang('index_create_user_link') ?> <i class="fa fa-plus"></i>
                                        </button>
                                        <button class="btn btn-green add-row" onclick="reload_table()">
                                            Refresh <i class="fa fa-refresh"></i>
                                        </button>
                                    </div>
                                </div>
                                <div id="MsgGood" class="alert alert-success text-center" style="display:none;"></div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="table">
                                        <thead>
                                            <tr>
                                                <th width="5%" align="center">No.</th>
                                                <th width="20%"><?php echo lang('index_username_th');?></th>
                                                <th width="20%"><?php echo lang('index_fullname_th');?></th>
                                                <th width="20%"><?php echo lang('index_email_th');?></th>
                                                <th width="20%"><?php echo lang('index_groups_th');?></th>
                                                <th width="10%"><?php echo lang('index_action_th');?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- TAB APPROVER -->
                <div class="tab-pane fade" id="myTab2_example2">
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 space20">
                                        <button class="btn btn-green add-row" onclick="add_approver()">
                                            <?= 'Buat Approver Baru' ?> <i class="fa fa-plus"></i>
                                        </button>
                                        <button class="btn btn-green add-row" onclick="reload_table()">
                                            Refresh <i class="fa fa-refresh"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="table_approver">
                                        <thead>
                                            <tr>
                                                <th width="5%" align="center">No.</th>
                                                <th width="35%"><?php echo lang('index_fullname_th');?></th>
                                                <th width="35%"><?php echo 'Jabatan';?></th>
                                                <th width="35%"><?php echo 'level';?></th>
                                                <th width="20%"><?php echo lang('index_action_th');?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="myTab2_example3">
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 space20">
                                        <button class="btn btn-green add-row" onclick="add_group()">
                                            <?= 'Tambah Group' ?> <i class="fa fa-plus"></i>
                                        </button>
                                        <button class="btn btn-green add-row" onclick="reload_table_group()">
                                            Refresh <i class="fa fa-refresh"></i>
                                        </button>
                                    </div>
                                </div>
                                <div id="MsgGood" class="alert alert-success text-center" style="display:none;"></div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="table_group">
                                        <thead>
                                            <tr>
                                                <th width="5%" align="center">No.</th>
                                                <th width="20%"><?php echo 'Nama Group'?></th>
                                                <th width="20%"><?php echo 'Deskripsi'?></th>
                                                <th width="10%"><?php echo lang('index_action_th');?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- add user modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">User Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                <input type="hidden" value="" name="id"/> 
                    <fieldset>
                    <legend>
                      Account Info
                    </legend>
                        <div class="row">
                            <div class="col-md-5">
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
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
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
                                        ?>
                                        <div class="checkbox clip-check check-primary">
                                          <input name="groups[]" type="checkbox" id="checkbox<?php echo $group['id'];?>" value="<?php echo $group['id'];?>" <?= $checked ?>>
                                          <label for="checkbox<?php echo $group['id'];?>">
                                            <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
                                          </label>
                                        </div>
                                    <?php endforeach?>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                  </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<!-- add approver modal -->
<div class="modal fade" id="modal_form_approver" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">User Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_approver" class="form-horizontal">
                <input type="hidden" value="" name="approver_id"/> 
                    <fieldset>
                    <legend>
                      Approver Info
                    </legend>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">
                                    Nama
                                    </label>
                                    <?php 
                                    $js = 'class="select2" style="width:100%" id="user_id"';
                                        echo form_dropdown('user_id', $options_user,'',$js); 
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">
                                    Jabatan
                                    </label>
                                    <input type="text" class="form-control" value="" name="jabatan">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">
                                    Level
                                    </label>
                                    <select class="select2" width="100%" name="level">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                  </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSaveGroup" onclick="save_approver()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<!-- add group modal -->
<div class="modal fade" id="modal_form_group" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">User Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_group" class="form-horizontal">
                <input type="hidden" value="" name="group_id"/> 
                    <fieldset>
                    <legend>
                      Group Info
                    </legend>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">
                                    Nama Group
                                    </label>
                                    <input type="text" class="form-control" value="" name="name">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">
                                    Deskripsi
                                    </label>
                                    <input type="text" class="form-control" value="" name="description">
                                </div>
                            </div>
                        </div>
                  </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSaveGroup" onclick="save_group()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->