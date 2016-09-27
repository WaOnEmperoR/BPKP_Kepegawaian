<!DOCTYPE html>
<head>
	<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/FusionCharts/FusionCharts.js"></script>
	
	<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/magic/magic.css" />
</head>
<body>
	<div class="col-lg-6">
		<div class="box box-success">
			<div class="panel-heading">
				<i class="icon-bar-chart icon-2x"></i>
				<h3 style="margin-top:-25px; margin-left:40px;"><?php echo $caption_bar;?></h3>
			</div>
			<div class="panel-body">
				<?php echo $graph_bar; ?>
			</div>
		</div>
	</div>
</body>
</html>
