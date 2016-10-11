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
					<form id="form" enctype="multipart/form-data" action="<?php echo base_url(); ?>pendidikan/simpan/<?php echo $Pegawai_ID_Pegawai;?>" method="post" class="form-horizontal row-border">
						<div class="form-group">
							<label class="col-sm-3 control-label">Nama Pegawai </label>
							<div class="col-sm-6">
								<input type="hidden" class="form-control" name="id" value="<?php echo $ID_Pendidikan; ?>">
								<input type="text" class="form-control" name="nama_pegawai" value="<?php echo $Nama_Pegawai; ?>" autofocus="true" disabled>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Tingkat Pendidikan</label>
							<div class="col-sm-6">
								<select name="tingkat_pendidikan" id="tingkat_pendidikan" class="form-control" style="width: 200px;" required>
									<?php 
										foreach ($list_tingkat as $tp)
										{
											$id_tp = $tp['ID_Tingkat_Pendidikan'];
											$nama_tp = $tp['Nama_Tingkat_Pendidikan'];
											echo "<option value = $id_tp ";
											if ($id_tp == $Tingkat_Pendidikan_ID_Tingkat_Pendidikan)
											{
												echo "selected = 'selected' ";
											}
											echo(" > $nama_tp </option>");
										}
									?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Nama Instansi </label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="nama_instansi" value="<?php echo $Nama_Instansi; ?>" autofocus="true">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Jurusan </label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="jurusan" value="<?php echo $Jurusan; ?>" autofocus="true">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Nomor Ijazah </label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="no_ijazah" value="<?php echo $Nomor_Ijazah; ?>" autofocus="true">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Tanggal Ijazah </label>
							<div class="col-sm-6">
								<div class="controls">
									<div class="input-group" id="datum">
										<input id="tanggal_ijazah" name="tanggal_ijazah" type="text" class="date-picker form-control" value="<?php echo $Tanggal_Ijazah; ?>" />
										<label for="tanggal_ijazah" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>
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
		$('#tanggal_ijazah').datepicker({ format: 'dd-mm-yyyy' });
	});
</script>
