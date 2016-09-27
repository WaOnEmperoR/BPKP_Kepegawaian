<html>
	<head>
		<title>Jotorres Table class example</title>
		<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/tablesorter/jquery-latest.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/tablesorter/jquery.tablesorter.min.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/style_tab.css">
		<script>
			$(document).ready(function() 
			{ 
				$("#dayatampung").tablesorter(); 
			} 
			); 
		</script>
	</head>
	<body>
		<?php 
			echo $this->table->generate($tampung); 
		?>
		
		
	</body>
</html>