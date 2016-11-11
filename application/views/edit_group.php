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
					<form id="form" enctype="multipart/form-data" action="<?php echo current_url(); ?>" method="post" class="form-horizontal row-border">
						<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo lang('edit_group_name_label', 'group_name');?></label>
							<div class="col-sm-6">
								<?php echo form_input($group_name);?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo lang('edit_group_desc_label', 'description');?></label>
							<div class="col-sm-6">
								<?php echo form_input($group_description);?>
							</div>
						</div>
						<div class="panel-footer">
							<div class="row">
								<div class="col-sm-6 col-sm-offset-3">
									<div class="btn-toolbar">
										<?php echo form_submit('submit', lang('edit_group_submit_btn'));?>	
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