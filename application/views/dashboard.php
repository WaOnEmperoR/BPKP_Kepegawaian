<!--<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/tablesorter/jquery-latest.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/tablesorter/jquery.tablesorter.min.js"></script>-->
<script src="<?php echo base_url()?>assets/plugins/FusionCharts/FusionCharts.js"></script>
<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/style_tab.css">-->
<!--<script>
	$(document).ready(function() 
	{ 
	$("#dayatampung_reg").tablesorter(); 
	} 
	); 
</script>-->

<div id="page-content">
	<div id='wrap'>
		<div id="page-heading">
			<ol class="breadcrumb">
				<li class='active'><a href="<?php echo base_url(); ?>">Dashboard</a></li>
			</ol>
			
			<h1>Dashboard</h1>
			<div class="options">
				<div class="btn-toolbar">
					<button class="btn btn-default" id="daterangepicker2">
						<i class="fa fa-calendar-o"></i>
						<span class="hidden-xs hidden-sm"><?php date_default_timezone_set("Asia/Jakarta"); echo date('l, d F Y'); ?></span>
					</button>
				</div>
			</div>
		</div>
		
		
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="panel panel-sky">
						<div class="panel-heading">
							<h4>Jumlah Pendaftar per SMA</h4>
						</div>
						<div class="panel-body">
							<?php 
								$tmpl = array ( 'table_open'  => '<table cellpadding="2" cellspacing="1" id="dayatampung_reg" class="tablesorter">' );
								$this->table->set_template($tmpl);
								$header = array('Nomor', 'No. Ijazah', 'Nama Siswa', 'No Peserta UN', 'NEM');
								$this->table->set_heading($header);
								
								echo $this->table->generate($jumlah_pendaftar); 
							?>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-4">
					<div class="panel panel-gray">
						<div class="panel-heading">
							<h4>Top 5 Daya Tampung Reguler</h4>
						</div>
						<div class="panel-body">
							<?php 
								$tmpl = array ( 'table_open'  => '<table cellpadding="2" cellspacing="1" id="dayatampung_reg" class="tablesorter">' );
								$this->table->set_template($tmpl);
								$header = array('Nama Sekolah', 'Nama PSB', 'Daya Tampung');
								$this->table->set_heading($header);
								
								echo $this->table->generate($tampung_reguler); 
							?>
						</div>
					</div>
				</div>
				
				<div class="col-md-4">
					<div class="panel panel-grape">
						<div class="panel-heading">
							<h4>Top 5 Daya Tampung Lokal</h4>
						</div>
						<div class="panel-body">
							<?php 
								$tmpl_A = array ( 'table_open'  => '<table cellpadding="2" cellspacing="1" id="dayatampung_lokal" class="tablesorter">' );
								$this->table->set_template($tmpl_A);
								$header = array('Nama Sekolah', 'Nama PSB', 'Daya Tampung');
								$this->table->set_heading($header);
								
								echo $this->table->generate($tampung_lokal); 
							?>
						</div>
					</div>
				</div>
				
				<div class="col-md-4">
					<div class="panel panel-magenta">
						<div class="panel-heading">
							<h4>Top 5 Daya Tampung Luar</h4>
						</div>
						<div class="panel-body">
							<?php 
								$tmpl_B = array ( 'table_open'  => '<table cellpadding="2" cellspacing="1" id="dayatampung_luar" class="tablesorter">' );	
								$this->table->set_template($tmpl_B);
								$header = array('Nama Sekolah', 'Nama PSB', 'Daya Tampung');
								$this->table->set_heading($header);
								
								echo $this->table->generate($tampung_luar); 
							?>
						</div>
					</div>
					
				</div>
				
			</div>
			
			<div class="row">
				<div class="col-md-6">
					<div class="panel panel-sky">
						<div class="panel-heading">
							<h4>Top 5 SMA by Pendaftar</h4>
							<div class="options">
								<a href="javascript:;"><i class="fa fa-cog"></i></a>
								<a href="javascript:;"><i class="fa fa-wrench"></i></a>
								<a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
							</div>
						</div>
						<div class="panel-body">
							<?php echo $graph_bar; ?>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="panel panel-magenta">
						<div class="panel-heading">
							<h4>Pendaftar per Jenis Kelamin</h4>
						</div>
						<div class="panel-body">
							<?php echo $graph_bar_04; ?>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-4">
					<div class="panel panel-brown">
						<div class="panel-heading">
							<h4>Top 5 Rata-rata NEM per PSB</h4>
							<!--<div class="options">
								<a href="javascript:;"><i class="fa fa-cog"></i></a>
								<a href="javascript:;"><i class="fa fa-wrench"></i></a>
								<a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
							</div>-->
						</div>
						<div class="panel-body">
							<?php echo $graph_bar_01; ?>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-brown">
						<div class="panel-heading">
							<h4>Top 5 Nilai Tertinggi NEM per PSB</h4>
							<!--<div class="options">
								<a href="javascript:;"><i class="fa fa-cog"></i></a>
								<a href="javascript:;"><i class="fa fa-wrench"></i></a>
								<a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
							</div>-->
						</div>
						<div class="panel-body">
							<?php echo $graph_bar_02; ?>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-brown">
						<div class="panel-heading">
							<h4>Top 5 Nilai Terendah NEM per PSB</h4>
							<!--<div class="options">
								<a href="javascript:;"><i class="fa fa-cog"></i></a>
								<a href="javascript:;"><i class="fa fa-wrench"></i></a>
								<a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
							</div>-->
						</div>
						<div class="panel-body">
							<?php echo $graph_bar_03; ?>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6">
					<div class="panel panel-indigo">
						<div class="panel-heading">
							<h4>Pengelompokan Berdasarkan Usia</h4>
							<!--<div class="options">
								<a href="javascript:;"><i class="fa fa-cog"></i></a>
								<a href="javascript:;"><i class="fa fa-wrench"></i></a>
								<a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
							</div>-->
						</div>
						<div class="panel-body">
							<?php echo $graph_bar_05; ?>
						</div>
					</div>
				</div>
			</div>
			
		</div> <!-- container -->
	</div> <!--wrap -->
</div> <!-- page-content -->
