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
					<form id="form" enctype="multipart/form-data" action="<?php echo base_url(); ?>users_man/deactivate/<?php echo($user->id);?>" method="post" class="form-horizontal row-border">
						<div class="form-group">
                            
							<h3><?php echo lang('deactivate_heading');?></h3>
							<p><?php echo sprintf(lang('deactivate_subheading'), $user->username);?></p>
                            <div class="toggle toggle-light"></div>
							<?php echo form_hidden($csrf); ?>
							<?php echo form_hidden(array('id'=>$user->id)); ?>
							<input type="hidden" id="confirm" name="confirm" value="no">
						</div>
						<div class="panel-footer">
							<div class="row">
								<div class="col-sm-6 col-sm-offset-3">
									<div class="btn-toolbar">
										<?php echo form_submit('submit', lang('deactivate_submit_btn'));?>	
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

<script type="text/javascript">
    
    $(document).ready(function () {

        $('.toggle').toggles({
            drag: true, // allow dragging the toggle between positions
            click: true, // allow clicking on the toggle
            text: {
                on: 'YA', // text for the ON position
                off: 'TIDAK' // and off
            },
            on: false, // is the toggle ON on init
            animate: 250, // animation time (ms)
            width: 80, // width used if not set in css
            height: 40, // height if not set in css
            easing: 'swing', // animation transition easing function
            checkbox: null, // the checkbox to toggle (for use in forms)
            clicker: null, // element that can be clicked on to toggle. removes binding from the toggle itself (use nesting)
        });

		// Getting notified of changes, and the new state:
		$('.toggle').on('toggle', function(e, active) {
			if (active) {
				document.getElementById("confirm").value = "yes";
				console.log('Toggle is now ON!');
			} else {
				document.getElementById("confirm").value = "no";
				console.log('Toggle is now OFF!');
			}
		});
    });
</script>