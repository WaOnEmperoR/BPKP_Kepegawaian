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
		<li>
			<a href="javascript:;"><i class="fa fa-user"></i> <span>Data Pegawai</span> </a>
			<ul class="acc-menu">
				<li><a href="<?php echo base_url(); ?>pegawai"><i class="fa fa-check-square"></i> <span>Pegawai</span></a></li>
			</ul>
		</li>
		<li>
			<a href="javascript:;"><i class="fa fa-building"></i> <span>Data Mitra</span> </a>
			<ul class="acc-menu">
				<li><a href="<?php echo base_url(); ?>mitra"><i class="fa fa-check-square"></i> <span>Mitra</span></a></li>
			</ul>
		</li>
		<li>
			<a href="javascript:;"><i class="fa fa-folder-open"></i> <span>Data Pelayanan</span> </a>
			<ul class="acc-menu">
				<li><a href="<?php echo base_url(); ?>pelayanan"><i class="fa fa-check-square"></i> <span>Pelayanan</span></a></li>
			</ul>
		</li>
		<li>
			<a href="javascript:;"><i class="fa fa-file-pdf-o"></i> <span>Laporan</span> </a>
			<ul class="acc-menu">
				<li><a href="<?php echo base_url(); ?>report_pegawai"><i class="fa fa-check-square"></i> <span>Laporan Pegawai</span></a></li>
				<li><a href="<?php echo base_url(); ?>report_pelayanan_mitra"><i class="fa fa-check-square"></i> <span>Laporan Pelayanan Mitra</span></a></li>
			</ul>
		</li>
		<li>
			<a href="javascript:;"><i class="fa fa-search-plus"></i> <span>Pencarian</span> </a>
			<ul class="acc-menu">
				<li><a href="<?php echo base_url(); ?>queryselect"><i class="fa fa-check-square"></i> <span>Pegawai Berdasarkan Kompetensi</span></a></li>
			</ul>
		</li>
		<li class="divider"></li>
		<li><a href="<?php echo base_url(); ?>login/logout"> <i class="fa fa-sign-out"></i> <span>Logout</span></a>
	</ul>
	<!-- END SIDEBAR MENU -->
</nav>