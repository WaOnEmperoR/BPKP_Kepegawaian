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
					<form id="form" enctype="multipart/form-data" action="<?php echo base_url(); ?>master_sertifikasi/simpan" method="post" class="form-horizontal row-border">
						<div class="form-group">
							<label class="col-sm-3 control-label">Nama Sertifikasi </label>
							<div class="col-sm-6">
								<input type="hidden" class="form-control" name="id" value="<?php echo $ID_Sertifikasi; ?>">
								<input type="text" class="form-control" name="nama_sertifikasi" value="<?php echo $Nama_Sertifikasi; ?>" autofocus="true">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Jenis Sertifikasi</label>
							<div class="col-sm-6">
								<select name="jenis_sertifikasi" id="jenis_sertifikasi" class="form-control" style="width: 200px;" required>
                                    <?php 
                                        foreach ($list_jenis_sertifikasi as $ljs)
                                        {
                                            $id_ljs = $ljs['ID_Jenis_Sertifikasi'];
                                            $nama_ljs = $ljs['Nama_Jenis_Sertifikasi'];
                                            echo "<option value = $id_ljs ";
                                            if ($id_ljs == $ID_Jenis_Sertifikasi)
                                            {
                                                echo "selected = 'selected' ";
                                            }
                                            echo("> $nama_ljs </option>");
                                        }
                                    ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Keterangan Sertifikasi </label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="keterangan_sertifikasi" value="<?php echo $Keterangan_Sertifikasi; ?>" autofocus="true">
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
		</div>
		<!-- container -->
	</div>
	<!--wrap -->
</div>
<!-- page-content -->
