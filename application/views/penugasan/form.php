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
					<form id="form" enctype="multipart/form-data" action="<?php echo base_url(); ?>penugasan/simpan/<?php echo $Pegawai_ID_Pegawai;?>" method="post" class="form-horizontal row-border">
						<div class="form-group">
							<label class="col-sm-3 control-label">Nama Pegawai </label>
							<div class="col-sm-6">
								<input type="hidden" class="form-control" name="id" value="<?php echo $ID_Penugasan; ?>">
								<input type="text" class="form-control" name="nama_pegawai" value="<?php echo $Nama_Pegawai; ?>" autofocus="true" disabled>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Nama Jenis Penugasan</label>
							<div class="col-sm-6">
								<select name="nama_jenis_penugasan" id="nama_jenis_penugasan" class="form-control" style="width: 200px;" required>
									<?php 
										foreach ($list_penugasan as $jp)
										{
											$id_jp = $jp['ID_Jenis_Penugasan'];
											$nama_jp = $jp['Nama_Jenis_Penugasan'];
											echo "<option value = $id_jp ";
											if ($id_jp == $Master_Penugasan_ID_Jenis_Penugasan)
											{
												echo "selected = 'selected' ";
											}
											echo(" > $nama_jp </option>");
										}
									?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Nama Jenis Peran</label>
							<div class="col-sm-6">
								<select name="nama_jenis_peran" id="nama_jenis_peran" class="form-control" style="width: 200px;" required>
									<?php 
										foreach ($list_peran as $lp)
										{
											$id_lp = $lp['ID_Peran'];
											$nama_lp = $lp['Nama_Peran'];
											echo "<option value = $id_lp ";
											if ($id_lp == $Master_Peran_ID_Peran)
											{
												echo "selected = 'selected' ";
											}
											echo(" > $nama_lp </option>");
										}
									?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Nama Penugasan </label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="nama_penugasan" value="<?php echo $Nama_Penugasan; ?>" autofocus="true">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Objek Penugasan </label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="objek_penugasan" value="<?php echo $Objek_Penugasan; ?>" autofocus="true">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Tanggal Mulai Penugasan </label>
							<div class="col-sm-6">
								<div class="controls">
									<div class="input-group" id="datum">
										<input id="tanggal_mulai_penugasan" name="tanggal_mulai_penugasan" type="text" class="date-picker form-control" value="<?php echo $Tanggal_Mulai_Penugasan; ?>" />
										<label for="tanggal_mulai_penugasan" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>
										</label>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Tanggal Selesai Penugasan </label>
							<div class="col-sm-6">
								<div class="controls">
									<div class="input-group" id="datum">
										<input id="tanggal_selesai_penugasan" name="tanggal_selesai_penugasan" type="text" class="date-picker form-control" value="<?php echo $Tanggal_Selesai_Penugasan; ?>" />
										<label for="tanggal_selesai_penugasan" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>
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
		$('#tanggal_mulai_penugasan').datepicker({ format: 'dd-mm-yyyy' });
		$('#tanggal_selesai_penugasan').datepicker({ format: 'dd-mm-yyyy' });
	});
</script>
