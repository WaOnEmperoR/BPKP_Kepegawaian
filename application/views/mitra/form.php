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
					<form id="form" enctype="multipart/form-data" action="<?php echo base_url(); ?>mitra/simpan" method="post" class="form-horizontal row-border">
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Nama Mitra</label>
							<div class="col-sm-6">
								<input type="hidden" class="form-control" name="id" value="<?php echo $ID_Mitra; ?>">
								<input type="text" class="form-control" name="nama" value="<?php echo $Nama_Mitra; ?>" autofocus="true">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Alamat </label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="alamat" value="<?php echo $Alamat_Mitra; ?>" autofocus="true">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Kota </label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="kota" value="<?php echo $Kota; ?>" autofocus="true">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Provinsi </label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="provinsi" value="<?php echo $Provinsi; ?>" autofocus="true">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Bidang Usaha </label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="bidang_usaha" value="<?php echo $Bidang_Usaha; ?>" autofocus="true">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Deskripsi </label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="deskripsi" value="<?php echo $Deskripsi; ?>" autofocus="true">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Kategori Mitra</label>
							<div class="col-sm-6">
								<select class="form-control" name="ketegori_mitra" >
								<option value="0">-Pilih Kategori-</option>
								<?php foreach($all_kategori_mitra as $row):?>	 
								  <option value="<?php echo $row['ID_Kategori_Mitra']?>" <?php if($Kategori_Mitra_ID_Kategori_Mitra == $row['ID_Kategori_Mitra']){ echo 'selected=selected';}?>><?php echo $row['Nama_Kategori']?></option>
								<?php endforeach;?>
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
					
					<?php if($Action=='Ubah'){?>
						<hr></hr>
						<div id="exTabCop" class="container">	
							<ul class="nav nav-tabs">
								<li class="active">
									<a  href="#1" data-toggle="tab">Susunan Kepengurusan</a>
								</li>
								
							</ul>
							
							<div class="tab-content ">
								<div class="tab-pane active" id="1">
									<?php echo($content_inner_pendidikan);?>
								</div>
								
							</div>
						</div>
						
					<?php } ?>
				</div>
				
			</div>
			
		</div> <!-- container -->
	</div> <!--wrap -->
</div> <!-- page-content -->

<script type="text/javascript">
	$(document).ready(function(){
		$('#example').DataTable();	
		$('#example1').DataTable();
		$('#example2').DataTable();
		$('#tanggal_lahir').datepicker({ format: 'dd-mm-yyyy' });
	});
</script>
