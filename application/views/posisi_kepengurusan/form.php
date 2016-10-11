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
					<form id="form" enctype="multipart/form-data" action="<?php echo base_url(); ?>posisi_kepengurusan/simpan" method="post" class="form-horizontal row-border">
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Nama Posisi Kepengurusan</label>
							<div class="col-sm-6">
								<input type="hidden" class="form-control" name="id" value="<?php echo $ID_Posisi_Kepengurusan; ?>">
								<input type="text" class="form-control" name="nama_posisi" value="<?php echo $Nama_Posisi; ?>" autofocus="true">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Deskripsi </label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="deskripsi" value="<?php echo $Deskripsi_Posisi_Kepengurusan; ?>" autofocus="true">
							</div>
						</div>
											
						
						<div class="panel-footer">
							<div class="row">
								<div class="col-sm-6 col-sm-offset-3">
									<div class="btn-toolbar">
										<button class="btn-primary btn" id="simpan">Simpan</button>
										<button class="btn-default btn" onclick=self.history.back()>Kembali</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
				
			</div>
			
		</div> <!-- container -->
	</div> <!--wrap -->
</div> <!-- page-content -->

