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
			<!-- <ol class="breadcrumb">
				<li class='active'><a href="<?php echo base_url(); ?>">Dashboard</a></li>
			</ol> -->
			
			<h1>Dashboard <?php echo($nama_sekolah);?></h1>
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
			<div class ="row">
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h4>Rekap Progress Peserta</h4>
						</div>
						<br/>
												
						<!-- top tiles -->
						<div class="row tile_count">
							<div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
								<div class="left"></div>
								<div class="right">
									<center>
										<span class="count_top"><i class="fa fa-3x fa-print"></i><font size="5"><br> Tahap Cetak Formulir </font></span>
										<div class="count"><font size="5" color="purple"><b><?php echo $tahap03; ?></b></font></div>
										<span class="count_bottom"><i class="green"><font color="purple">Pelamar</font></i></span>
									</center>
								</div>
							</div>
							<div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
								<div class="left"></div>
								<div class="right">
									<center>
										<span class="count_top"><i class="fa fa-3x fa-upload"></i><font size="5"><br> Tahap Upload Persyaratan </font></span>
										<div class="count"><font size="5" color="green"><b><?php echo $tahap04; ?></b></font></div>
										<span class="count_bottom"><i class="green"><font color="green">Pelamar</font></i></span>
									</center>            
								</div>
							</div>
							<div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
								<div class="left"></div>
								<div class="right">
									<center>
										<span class="count_top"><i class="fa fa-3x fa-check-square"></i><font size="5"><br> Tahap Verifikasi Berkas</font></span>
										<div class="count"><font size="5" color="blue"><b><?php echo $tahap05; ?></b></font></div>
										<span class="count_bottom"><i class="blue"><font color="blue">Pelamar</font></i></span>
									</center>            
								</div>
							</div>
							<div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
								<div class="left"></div>
								<div class="right">
									<center>
										<span class="count_top"><i class="fa fa-3x fa-newspaper-o"></i><font size="5"><br>Tahap Cetak Bukti Pendaftaran</font></span>
										<div class="count"><font size="5" color="red"><b><?php echo $tahap06; ?></b></font></div>
										<span class="count_bottom"><i class="green"><font color="red">Pelamar</font></i></span>
									</center>
								</div>
							</div>
							<div class="animated flipInY col-md-1 col-sm-2 col-xs-2 tile_stats_count">
								<div class="left"></div>
								<div class="right">
									<center>
										<span class="count_top"><i class="fa fa-3x fa-graduation-cap"></i><font size="5"><br>Tahap Kelulusan/Tidak</font></span>
										<div class="count"><font size="5" color="red"><b><?php echo $tahap07; ?></b></font></div>
										<span class="count_bottom"><i class="green"><font color="red">Pelamar</font></i></span>
									</center>
								</div>
							</div>
						</div>
						<!-- /top tiles -->
						
					</div>
				</div>
				
			</div>
		
			<div class="row">
				<div class="col-md-4">
					<div class="panel panel-sky">
						<div class="panel-heading">
							<h4>Pendaftar Dalam Tangsel</h4>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<?php 
									$tmpl = array ( 'table_open'  => '<table cellpadding="2" cellspacing="1" id="dayatampung_reg" class="tablesorter">' );
									$this->table->set_template($tmpl);
									$header = array('Nomor', 'Nama Siswa', 'No Peserta UN', 'Nilai UN');
									$this->table->set_heading($header);
									
									echo $this->table->generate($jumlah_pendaftar_dalam); 
								?>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-md-4">
					<div class="panel panel-sky">
						<div class="panel-heading">
							<h4>Pendaftar Luar Tangsel</h4>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<?php 
									$tmpl = array ( 'table_open'  => '<table cellpadding="2" cellspacing="1" id="dayatampung_reg" class="tablesorter">' );
									$this->table->set_template($tmpl);
									$header = array('Nomor', 'Nama Siswa', 'No Peserta UN', 'Nilai UN');
									$this->table->set_heading($header);
									
									echo $this->table->generate($jumlah_pendaftar_luar); 
								?>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-md-4">
					<div class="panel panel-sky">
						<div class="panel-heading">
							<h4>Pendaftar Jalur Lokal</h4>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<?php 
									$tmpl = array ( 'table_open'  => '<table cellpadding="2" cellspacing="1" id="dayatampung_reg" class="tablesorter">' );
									$this->table->set_template($tmpl);
									$header = array('Nomor', 'Nama Siswa', 'No Peserta UN');
									$this->table->set_heading($header);
									
									echo $this->table->generate($jumlah_pendaftar_lokal); 
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
			
			<div class="row">
				<div class="col-md-6">
					<div class="panel panel-indigo">
						<div class="panel-heading">
							<h4>5 Nilai Tertinggi Jalur Reguler Dalam Tangsel</h4>
						</div>
						<div class="panel-body">
							<?php echo $graph_bar_06; ?>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="panel panel-indigo">
						<div class="panel-heading">
							<h4>5 Nilai Terendah Jalur Reguler Dalam Tangsel</h4>
						</div>
						<div class="panel-body">
							
							<?php echo $graph_bar_07; ?>
							
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6">
					<div class="panel panel-sky">
						<div class="panel-heading">
							<h4>5 Nilai Tertinggi Jalur Reguler Luar Tangsel</h4>
						</div>
						<div class="panel-body">
							<?php echo $graph_bar_08; ?>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="panel panel-sky">
						<div class="panel-heading">
							<h4>5 Nilai Terendah Jalur Reguler Luar Tangsel</h4>
						</div>
						<div class="panel-body">
							
							<?php echo $graph_bar_09; ?>
							
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6">
					<div class="panel panel-indigo">
						<div class="panel-heading">
							<h4>Pendaftar Berdasarkan Usia</h4>
							
						</div>
						<div class="panel-body">
							<?php echo $graph_bar_05; ?>
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
			
		</div> <!-- container -->
	</div> <!--wrap -->
</div> <!-- page-content -->
