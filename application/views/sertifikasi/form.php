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
			
			<div class="panel panel-indigo">
				<div class="panel-heading">
					<h4>Form - <?php echo $judul_halaman; ?></h4>
				</div>
				<div class="panel-body collapse in">
					<form id="form" enctype="multipart/form-data" action="<?php echo base_url(); ?>sertifikasi/simpan/<?php echo $Pegawai_ID_Pegawai;?>" method="post" class="form-horizontal row-border">
						<div class="form-group">
							<label class="col-sm-3 control-label">Nama Pegawai </label>
							<div class="col-sm-6">
								<input type="hidden" class="form-control" name="id" value="<?php echo $ID_Sertifikasi; ?>">
								<input type="text" class="form-control" name="nama_pegawai" value="<?php echo $Nama_Pegawai; ?>" autofocus="true" disabled>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Jenis Sertifikasi</label>
							<div class="col-sm-6">
								<select name="jenis_sertifikasi" id="jenis_sertifikasi" class="form-control" style="width: 200px;" required>
									<?php 
										foreach ($list_sertifikasi as $ls)
										{
											$id_ls = $ls['ID_Jenis_Sertifikasi'];
											$nama_ls = $ls['Nama_Jenis_Sertifikasi'];
											echo "<option value = $id_ls ";
											if ($id_ls == $Jenis_Sertifikasi_ID_Jenis_Sertifikasi)
											{
												echo "selected = 'selected' ";
											}
											echo(" > $nama_ls </option>");
										}
									?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Nama Sertifikasi </label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="nama_sertifikasi" value="<?php echo $Nama_Sertifikasi; ?>" autofocus="true">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Lembaga Penyelenggara </label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="lembaga_penyelenggara" value="<?php echo $Lembaga_Penyelenggara; ?>" autofocus="true">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Nomor Sertifikat </label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="no_sertifikat" value="<?php echo $No_Sertifikat; ?>" autofocus="true">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Tanggal Sertifikat </label>
							<div class="col-sm-6">
								<div class="controls">
									<div class="input-group" id="datum">
										<input id="tanggal_sertifikat" name="tanggal_sertifikat" type="text" class="date-picker form-control" value="<?php echo $Tanggal_Sertifikat; ?>" />
										<label for="tanggal_sertifikat" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>
										</label>
									</div>
								</div>
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

<script type="text/javascript">
	$(document).ready(function(){
		$('#tanggal_sertifikat').datepicker({ format: 'dd-mm-yyyy' });
	});
</script>
