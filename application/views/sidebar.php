<nav id="page-leftbar" role="navigation">
	<!-- BEGIN SIDEBAR MENU -->
	<ul class="acc-menu" id="sidebar">
		<li id="search">
			<a href="javascript:;"><i class="fa fa-search opacity-control"></i></a>
			<form>
				<input type="text" class="search-query" placeholder="Search...">
				<button type="submit"><i class="fa fa-search"></i></button>
			</form>
		</li>
		
		<li class="divider"></li>
        <li><a href="<?php echo base_url(); ?>home"><i class="fa fa-area-chart"></i> <span>Dashboard</span></a></li>
		<li class="divider"></li>
		<li><a href="javascript:;"><i class="fa fa-clone"></i> <span>Data Master</span> </a>
			<ul class="acc-menu">
				<li><a href="<?php echo base_url(); ?>tingkat_pendidikan"><i class="fa fa-building "></i> <span>Master Tingkat Pendidikan</span></a></li>
				<li><a href="<?php echo base_url(); ?>jenis_diklat"><i class="fa fa-graduation-cap"></i> <span>Master Jenis Diklat</span></a></li>
				<li><a href="<?php echo base_url(); ?>jenis_sertifikasi"><i class="fa fa-sitemap"></i> <span>Master Jenis Sertifikasi</span></a></li>
				<li><a href="<?php echo base_url(); ?>master_penugasan"><i class="fa fa fa-university"></i> <span>Master Jenis Penugasan</span></a></li>
				<li><a href="<?php echo base_url(); ?>master_peran"><i class="fa fa-file-text"></i> <span>Master Peran</span></a></li>
			</ul>
		</li>
		<li><a href="javascript:;"><i class="fa fa-key"></i> <span>Data Pegawai</span> </a>
			<ul class="acc-menu">
				<li><a href="<?php echo base_url(); ?>pegawai"><i class="fa fa-check-square"></i> <span>Pegawai</span></a></li>
				<li><a href="<?php echo base_url(); ?>tahun"><i class="fa fa-calendar"></i> <span>Data Tahun Ajaran</span></a></li>
				<li><a href="<?php echo base_url(); ?>pengguna"><i class="fa fa-user"></i> <span>Data Pengguna</span></a></li>
				<li><a href="<?php echo base_url(); ?>pegawai"><i class="fa fa-users"></i> <span>Data Pegawai</span></a></li>
				<li><a href="<?php echo base_url(); ?>psb"><i class="fa fa-pencil-square-o"></i> <span>Data Input Kuota</span></a></li>
				<li><a href="<?php echo base_url(); ?>nilaiun"><i class="fa fa-certificate"></i> <span>Master Nilai UN</span></a></li> 
			</ul>
		</li>
		<li><a href="javascript:;"><i class="fa fa-clone"></i> <span>Laporan</span> </a>
			<ul class="acc-menu">
				<li><a href="<?php echo base_url(); ?>report_pegawai"><i class="fa fa-file-archive-o"></i> <span>Laporan Pegawai</span></a></li>
				<li><a href="<?php echo base_url(); ?>sekolah_peringkat"><i class="fa fa-trophy"></i> <span>Peringkat Siswa</span></a></li>
			</ul>
		</li>
		<li class="divider"></li>
		<li><a href="<?php echo base_url(); ?>login/logout"> <i class="fa fa-sign-out"></i> <span>Logout</span></a>
		</ul>
		<!-- END SIDEBAR MENU -->
	</nav>
