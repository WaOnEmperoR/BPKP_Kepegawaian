<div id="page-content">
	<div id='wrap'>
		<div id="page-heading">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>home">Dashboard</a></li>
				<li><?php echo $breadcumb; ?></li>
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
					<form id="form" enctype="multipart/form-data" action="<?php echo base_url(); ?>nilaiun/simpan" method="post" class="form-horizontal row-border">
						
						<div class="form-group">
							<label class="col-sm-3 control-label">No Peserta</label>
							<div class="col-sm-6">
								<input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>">
								<input type="text" class="form-control" name="no_peserta" value="<?php echo $no_peserta; ?>" autofocus="true">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Nama Peserta</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="nama_peserta" value="<?php echo $nama_peserta; ?>" autofocus="true">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Tempat Lahir</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="tempat_lahir" value="<?php echo $tempat_lahir; ?>" autofocus="true">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Tanggal Lahir</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="tanggal_lahir" value="<?php echo $tanggal_lahir; ?>" autofocus="true">
								<!--<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input class="form-control pull-right datepicker" type="text" name="tanggal_lahir" value="<?php echo $tanggal_lahir; ?>">
								</div>-->
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Nilai Bahasa Indonesia</label>
							<div class="col-sm-6">
								<input type="text" class="form-control numeric" name="n_mapel_01" value="<?php echo $n_mapel_01; ?>" autofocus="true">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Nilai Bahasa Inggris</label>
							<div class="col-sm-6">
								<input type="text" class="form-control numeric" name="n_mapel_02" value="<?php echo $n_mapel_02; ?>" autofocus="true">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Nilai Matematika</label>
							<div class="col-sm-6">
								<input type="text" class="form-control numeric" name="n_mapel_03" value="<?php echo $n_mapel_03; ?>" autofocus="true">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Nilai IPA</label>
							<div class="col-sm-6">
								<input type="text" class="form-control numeric" name="n_mapel_04" value="<?php echo $n_mapel_04; ?>" autofocus="true">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Nilai UN Total</label>
							<div class="col-sm-6">
								<input type="text" class="form-control numeric" name="n_mapel_total" value="<?php echo $n_mapel_total; ?>" autofocus="true">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Sekolah Asal</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="sekolah_asal" value="<?php echo $sekolah_asal; ?>" autofocus="true">
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