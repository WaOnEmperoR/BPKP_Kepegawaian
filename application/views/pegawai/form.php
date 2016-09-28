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
					<form id="form" enctype="multipart/form-data" action="<?php echo base_url(); ?>pegawai/simpan" method="post" class="form-horizontal row-border">
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Nama Pegawai</label>
							<div class="col-sm-6">
								<input type="hidden" class="form-control" name="id" value="<?php echo $ID_Pegawai; ?>">
								<input type="text" class="form-control" name="nama" value="<?php echo $Nama_Pegawai; ?>" autofocus="true">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">NIK </label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="nik" value="<?php echo $NIK; ?>" autofocus="true">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">NIP </label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="nip" value="<?php echo $NIP; ?>" autofocus="true">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Alamat Pegawai </label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="alamat" value="<?php echo $Alamat; ?>" autofocus="true">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Tempat Lahir </label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="tempat_lahir" value="<?php echo $Tempat_Lahir; ?>" autofocus="true">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Tanggal Lahir </label>
							<div class="col-sm-6">
								<!--
									***Asli, jangan dirubah***
									<div class="controls">
									<div class="input-group" id="datum">
									<input id="tanggal_lahir" type="text" class="date-picker form-control" />
									<label for="tanggal_lahir" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>
									</label>
									</div>
								</div>-->
								<div class="controls">
									<div class="input-group" id="datum">
										<input id="tanggal_lahir" name="tanggal_lahir" type="text" class="date-picker form-control" value="<?php echo $Tanggal_Lahir; ?>" />
										<label for="tanggal_lahir" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>
										</label>
									</div>
								</div>
								<!--
									***Input Bener, jangan dirubah***
									<div class='input-group datepicker' id='tanggal_lahir'>
									<input type='text' name="tanggal_lahir" />
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>-->
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Jenis Kelamin</label>
							<div class="col-sm-6">
								<select name="jenis_kelamin" id="jenis_kelamin" class="form-control" style="width: 200px;" required>
									<option value="L" <?php if($Jenis_Kelamin=='L'){ echo("selected='selected'");} ?> >Pria</option>
									<option value="P" <?php if($Jenis_Kelamin=='P'){ echo("selected='selected'");} ?> >Wanita</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Agama</label>
							<div class="col-sm-6">
								<select name="agama" id="agama" class="form-control" style="width: 200px;">
									<option value="I" <?php if($Jenis_Kelamin=='I'){ echo("selected='selected'");} ?> >Islam</option>
									<option value="KK" <?php if($Jenis_Kelamin=='KK'){ echo("selected='selected'");} ?> >Kristen Katolik</option>
									<option value="KP" <?php if($Jenis_Kelamin=='KP'){ echo("selected='selected'");} ?> >Kristen Protestan</option>
									<option value="H" <?php if($Jenis_Kelamin=='H'){ echo("selected='selected'");} ?> >Hindu</option>
									<option value="B" <?php if($Jenis_Kelamin=='B'){ echo("selected='selected'");} ?> >Buddha</option>
								</select>
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
					
					<hr></hr>
					<div id="exTabCop" class="container">	
						<ul class="nav nav-tabs">
							<li class="active">
								<a  href="#1" data-toggle="tab">Pendidikan</a>
							</li>
							<li><a href="#2" data-toggle="tab">Diklat</a>
							</li>
							<li><a href="#3" data-toggle="tab">Sertifikasi</a>
							</li>
						</ul>
						
						<div class="tab-content ">
							<div class="tab-pane active" id="1">
								<?php echo($content_inner_pendidikan);?>
							</div>
							<div class="tab-pane" id="2">
								<?php echo($content_inner_diklat);?>
							</div>
							<div class="tab-pane" id="3">
								<?php echo($content_inner_sertifikasi);?>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			
		</div> <!-- container -->
	</div> <!--wrap -->
</div> <!-- page-content -->

<script type="text/javascript">
	$(document).ready(function(){
		$('#tanggal_lahir').datepicker({ format: 'dd-mm-yyyy' });
	});
</script>
