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
<!-- end: PAGE TITLE -->
<!-- start: DYNAMIC TABLE -->
<div class="container-fluid container-fullw bg-white">
	<div class="row">
		<div class="col-md-12">
			<h5 class="over-title margin-bottom-15"><?php echo lang('index_subheading');?></h5>
			<div class="row">
				<div class="col-md-12 space20">
					<button class="btn btn-green add-row" data-toggle="modal" data-target="#addModal">
						<?= lang('index_create_user_link') ?> <i class="fa fa-plus"></i>
					</button>
				</div>
			</div>
            <div id="MsgGood" class="alert alert-success text-center" style="display:none;"></div>
			<div class="table-responsive">
				<table class="table table-striped table-hover" id="sample_1">
					<thead>
						<tr>
							<th>No</th>
							<th><?php echo lang('index_fname_th');?></th>
							<th><?php echo lang('index_lname_th');?></th>
							<th><?php echo lang('index_email_th');?></th>
							<th><?php echo lang('index_groups_th');?></th>
							<th><?php echo lang('index_status_th');?></th>
							<th><?php echo lang('index_action_th');?></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1;foreach ($users as $user):?>
						<tr>
							<td><?= $i++ ?>
							<td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
				            <td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
				            <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
							<td>
								<?php foreach ($user->groups as $group):?>
									<?php echo anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
				                <?php endforeach?>
							</td>
							<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></td>
							<td><?php echo anchor("auth/edit_user/".$user->id, 'Edit') ;?></td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Add  Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"><?php echo lang('create_user_heading');?></h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" id="MsgBad" style="background: #fff; display: none;"></div>
             <?php echo form_open('auth/create_user/', array('id'=>'formadd'))?> 
                <div class="row column-seperation">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-with-icon right">                                       
                                <i class=""></i>
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php echo lang('create_user_fname_label', 'first_name');?>
                                        <?php echo bs_form_input($first_name);?>
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo lang('create_user_lname_label', 'last_name');?>
                                        <?php echo bs_form_input($last_name);?>                             
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="form-group">
                            <div class="input-with-icon  right">                                       
                                <i class=""></i>
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php echo lang('create_user_email_label', 'email');?>
                                        <?php echo bs_form_input($email);?> 
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo lang('create_user_phone_label', 'phone');?>
                                        <?php echo bs_form_input($phone);?>
                                    </div>
                                </div>                               
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-with-icon  right">                                       
                                <i class=""></i>
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php echo lang('create_user_password_label', 'password');?>
                                        <?php echo bs_form_input($password);?>   
                                    </div>      
                                    <div class="col-md-6">
                                        <?php echo lang('create_user_password_confirm_label', 'password_confirm');?>
                                        <?php echo bs_form_input($password_confirm);?>   
                                    </div>  
                                </div>                              
                            </div>
                        </div>
                    </div>
                </div>                 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('cancel')?></button> 
                <button class="btn btn-primary" style="margin-top: 3px;" id=""><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save')?></button> 
            </div>
            <?php echo form_close()?>
        </div>
    </div>
</div>
