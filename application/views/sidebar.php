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
				<li><a href="<?php echo base_url(); ?>master_peran"><i class="fa fa-file-text"></i> <span>Master Peran Penugasan</span></a></li>
				<li><a href="<?php echo base_url(); ?>jenis_layanan"><i class="fa fa-file-text"></i> <span>Master Jenis Layanan</span></a></li>
				<li><a href="<?php echo base_url(); ?>posisi_kepengurusan"><i class="fa fa-file-text"></i> <span>Master Posisi Kepengurusan</span></a></li>
				<li><a href="<?php echo base_url(); ?>kategori_mitra"><i class="fa fa-file-text"></i> <span>Master Kategori Mitra</span></a></li>
			</ul>
		</li>
		<li><a href="javascript:;"><i class="fa fa-key"></i> <span>Data Pegawai</span> </a>
			<ul class="acc-menu">
				<li><a href="<?php echo base_url(); ?>pegawai"><i class="fa fa-check-square"></i> <span>Pegawai</span></a></li>
			</ul>
		</li>
		<li><a href="javascript:;"><i class="fa fa-key"></i> <span>Data Mitra</span> </a>
			<ul class="acc-menu">
				<li><a href="<?php echo base_url(); ?>mitra"><i class="fa fa-check-square"></i> <span>Mitra</span></a></li>
			</ul>
		</li>
		<li><a href="javascript:;"><i class="fa fa-clone"></i> <span>Laporan</span> </a>
			<ul class="acc-menu">
				<li><a href="<?php echo base_url(); ?>report_pegawai"><i class="fa fa-file-archive-o"></i> <span>Laporan Pegawai</span></a></li>
			</ul>
		</li>
		<li class="divider"></li>
		<li><a href="<?php echo base_url(); ?>login/logout"> <i class="fa fa-sign-out"></i> <span>Logout</span></a>
		</ul>
		<!-- END SIDEBAR MENU -->
	</nav>
