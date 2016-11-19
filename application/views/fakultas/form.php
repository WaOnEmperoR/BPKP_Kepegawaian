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
					<form id="form" enctype="multipart/form-data" action="<?php echo base_url(); ?>fakultas/simpan" method="post" class="form-horizontal row-border">
						<div class="form-group">
							<label class="col-sm-3 control-label">Nama Fakultas </label>
							<div class="col-sm-6">
								<input type="hidden" class="form-control" name="id" value="<?php echo $ID_Fakultas; ?>">
								<input type="text" class="form-control" name="nama_fakultas" value="<?php echo $Nama_Fakultas; ?>" autofocus="true">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Tingkat Pendidikan</label>
							<div class="col-sm-6">
								<select name="tingkat_pendidikan" id="tingkat_pendidikan" class="form-control" style="width: 200px;" required>
                                    <?php 
                                        foreach ($list_tingkat_pendidikan as $ltp)
                                        {
                                            $id_ltp = $ltp['ID_Tingkat_Pendidikan'];
                                            $nama_ltp = $ltp['Nama_Tingkat_Pendidikan'];
                                            echo "<option value = $id_ltp ";
                                            if ($id_ltp == $ID_Tingkat_Pendidikan)
                                            {
                                                echo "selected = 'selected' ";
                                            }
                                            echo("> $nama_ltp </option>");
                                        }
                                    ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Keterangan Fakultas </label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="keterangan_fakultas" value="<?php echo $Keterangan_Fakultas; ?>" autofocus="true">
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
<script type="text/javascript">
	$(document).ready(function(){
		$('#tanggal_sertifikat').datepicker({ format: 'dd-mm-yyyy' });
	});
</script>