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
							<label class="col-sm-3 control-label">First Name</label>
							<div class="col-sm-6">
								<!-- <input type="text" class="form-control" name="first_name" value="<?php echo $this->form_validation->set_value('first_name', $user->first_name); ?>" autofocus="true"> -->
								<?php echo form_input($first_name);?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Last Name</label>
							<div class="col-sm-6">
								<?php echo form_input($last_name);?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Perusahaan</label>
							<div class="col-sm-6">
								<?php echo form_input($company);?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Nomor Telepon</label>
							<div class="col-sm-6">
								<?php echo form_input($phone);?>	
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Password (Jika merubah password)</label>
							<div class="col-sm-6">
								<?php echo form_input($password);?>
							</div>
						</div>					
						<div class="form-group">
							<label class="col-sm-3 control-label">Konfirmasi Password (Jika merubah password)</label>
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

							<p><?php echo form_submit('submit', lang('edit_user_submit_btn'));?></p>
						 </div> 
					</form>
					
				</div>
				
			</div>
			
		</div> <!-- container -->
	</div> <!--wrap -->
</div> <!-- page-content -->

