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
					<form id="form" enctype="multipart/form-data" action="<?php echo base_url(); ?>pelayanan/simpan" method="post" class="form-horizontal row-border">
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Nomor Pelayanan</label>
							<div class="col-sm-6">
								<input type="hidden" class="form-control" name="id" value="<?php echo $ID_Pelayanan; ?>">
								<input type="text" class="form-control" name="nomor_pelayanan" value="<?php echo $Nomor_Pelayanan; ?>" autofocus="true">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Judul Pelayanan </label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="judul_pelayanan" value="<?php echo $Judul_Pelayanan; ?>" autofocus="true">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Tanggal Mulai </label>
							<div class="col-sm-6">
								<div class="controls">
									<div class="input-group" id="datum1">
										<input id="tanggal_mulai" name="tanggal_mulai" type="text" class="date-picker form-control" value="<?php echo $Tanggal_Mulai; ?>" />
										<label for="tanggal_mulai" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>
										</label>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Tanggal Selesai </label>
							<div class="col-sm-6">
								<div class="controls">
									<div class="input-group" id="datum2">
										<input id="tanggal_selesai" name="tanggal_selesai" type="text" class="date-picker form-control" value="<?php echo $Tanggal_Selesai; ?>" />
										<label for="tanggal_selesai" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>
										</label>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Tanggal Laporan Pelaksanaan </label>
							<div class="col-sm-6">
								<div class="controls">
									<div class="input-group" id="datum3">
										<input id="tanggal_laporan_pelaksanaan" name="tanggal_laporan_pelaksanaan" type="text" class="date-picker form-control" value="<?php echo $Tanggal_Laporan_Pelaksanaan; ?>" />
										<label for="tanggal_laporan_pelaksanaan" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>
										</label>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Biaya </label>
							<div class="col-sm-6">
								<input type="number" class="form-control" name="biaya" value="<?php echo $Biaya; ?>" autofocus="true" >
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Nama Mitra </label>
							<div class="col-sm-6">
								<input type="hidden" name="id_mitra" id="id_mitra" value="<?php echo $Mitra_ID_Mitra;?>">
								<input type="text" class="form-control" name="nama_mitra" id="nama_mitra" value="<?php echo $Nama_Mitra; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Kategori Layanan</label>
							<div class="col-sm-6">
								<select name="kategori_layanan" id="kategori_layanan" class="form-control" style="width: 200px;" required>
									<?php 
										foreach ($list_layanan as $ll)
										{
											$id_ll = $ll['ID_Jenis_Layanan'];
											$nama_ll = $ll['Kategori_Layanan'];
											echo "<option value = $id_ll ";
											if ($id_ll == $Jenis_Layanan_ID_Jenis_Layanan)
											{
												echo "selected = 'selected' ";
											}
											echo(" > $nama_ll </option>");
										}
									?>
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
									<a href="#1" data-toggle="tab">Personil yang Terlibat</a>
								</li>
							</ul>
							
							<div class="tab-content ">
								<div class="tab-pane active" id="1">
									<?php echo($content_inner_personnel);?>
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
		$('#example3').DataTable();
		$('#tanggal_mulai').datepicker({ format: 'dd-mm-yyyy' });
		$('#tanggal_selesai').datepicker({ format: 'dd-mm-yyyy' });
		$('#tanggal_laporan_pelaksanaan').datepicker({ format: 'dd-mm-yyyy' });
		
		$( "#nama_mitra" ).autocomplete({
			source: function (request, response)
			{
				$.ajax(
				{
					url: '<?php echo base_url()."pelayanan/get_all_mitra/"; ?>' + request.term,
					dataType: "json",
					success: function (data) {
					//alert("Masuk sini");
						var parsed = (data);
						var newArray = new Array(parsed.length);
						var i = 0;
						
						parsed.forEach(function (entry) {
							var newObject = {
								label: entry.Nama_Mitra,
								ID: entry.ID_Mitra
							};
							newArray[i] = newObject;
							i++;
						});
						
						response(newArray);
					},
					error: function () {
						response([]);
					}
				});
			},
			minLength: 0,
			select:function(event, ui){
				$('#id_mitra').val(ui.item.ID);
			}
		});
	});
</script>
