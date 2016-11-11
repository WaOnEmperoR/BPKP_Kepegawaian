<div id="page-content">
	<div id='wrap'>
		<div id="page-heading">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>home">Dashboard</a></li>
				<li><a href="<?php echo base_url(); ?>pegawai"><?php echo $breadcumb; ?></a></li>
				<li class="active"><?php echo $judul_halaman; ?></li>
			</ol>
			<h1><?php echo $judul_halaman; ?></h1>
		</div>
		<div class="container">
			<div class="panel panel-midnightblue">
				<div class="panel-heading">
					<h4>Form - <?php echo $judul_halaman; ?></h4>
				</div>
				<div class="panel-body collapse in">
					<form id="form" enctype="multipart/form-data" action="<?php echo base_url(); ?>users_man/ubah/<?php echo($user->id);?>" method="post" class="form-horizontal row-border">
						<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo lang('edit_user_fname_label', 'first_name');?></label>
							<div class="col-sm-6">
								<?php echo form_input($first_name);?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo lang('edit_user_lname_label', 'last_name');?></label>
							<div class="col-sm-6">
								<?php echo form_input($last_name);?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo lang('edit_user_company_label', 'company');?></label>
							<div class="col-sm-6">
								<?php echo form_input($company);?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo lang('edit_user_phone_label', 'phone');?></label>
							<div class="col-sm-6">
								<?php echo form_input($phone);?>	
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo lang('edit_user_password_label', 'password');?></label>
							<div class="col-sm-6">
								<?php echo form_input($password);?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo lang('edit_user_password_confirm_label', 'password_confirm');?></label>
							<div class="col-sm-6">
								<?php echo form_input($password_confirm);?>
							</div>
						</div>
						<div class="form-group">
							<?php if ($this->ion_auth->is_admin()): ?>
							<h3><?php echo lang('edit_user_groups_heading');?></h3>
							<?php foreach ($groups as $group):?>
							<label class="checkbox">
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
							<input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
							<?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
							</label>
							<?php endforeach?>
							<?php endif ?>
							<?php echo form_hidden('id', $user->id);?>
							<?php echo form_hidden($csrf); ?>
						</div>
						<div class="panel-footer">
							<div class="row">
								<div class="col-sm-6 col-sm-offset-3">
									<div class="btn-toolbar">
										<?php echo form_submit('submit', lang('edit_user_submit_btn'));?>	
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- container -->
	</div>
	<!--wrap -->
</div>
<!-- page-content -->