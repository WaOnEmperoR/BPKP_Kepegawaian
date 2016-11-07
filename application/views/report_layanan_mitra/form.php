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
			<form class="well form-horizontal" action="<?php echo base_url(); ?>report_pelayanan_mitra/print_pelayanan_mitra" method="post"  id="report_form">
				<!-- Text input-->
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Nama Mitra (*)</label>  
					<div class="col-sm-6 inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input type="hidden" name="id_mitra" id="id_mitra">
							<input name="autocomplete" placeholder="Nama Mitra" class="form-control"  type="text" id ="autocomplete">
						</div>
					</div>
				</div>
				
				<!-- Text input-->
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Kategori Layanan</label>
					<div class="col-sm-6">
						<select name="kategori_layanan" id="kategori_layanan" class="form-control" style="width: 200px;" required>
							<?php 
								echo "<option value = 'all'> -- Semua -- </option> ";
								foreach ($list_layanan as $ll)
								{
									$id_ll = $ll['ID_Jenis_Layanan'];
									$nama_ll = $ll['Kategori_Layanan'];
									echo "<option value = $id_ll> $nama_ll </option> ";
								}
							?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Tanggal Mulai (*)</label>
					<div class="col-sm-6">
						<div class="controls">
							<div class="input-group" id="datum1">
								<input id="tanggal_mulai" name="tanggal_mulai" type="text" class="date-picker form-control"/>
								<label for="tanggal_mulai" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>
								</label>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Tanggal Selesai (*)</label>
					<div class="col-sm-6">
						<div class="controls">
							<div class="input-group" id="datum2">
								<input id="tanggal_selesai" name="tanggal_selesai" type="text" class="date-picker form-control" />
								<label for="tanggal_selesai" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>
								</label>
							</div>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label><font color="red"><i>(*) = Kosongkan jika memilih semua </i></font></label>
				</div>
				
				<!-- Button -->
				<div class="form-group">
					<label class="col-md-4 control-label"></label>
					<div class="col-md-4">
						<button type="submit" class="btn btn-warning" >Cetak PDF <span class="glyphicon glyphicon-send"></span></button>
					</div>
				</div>
				<!-- End Button -->
			</form>
		</div>
		
	</div> <!--wrap -->
</div> <!-- page-content -->

<script type="text/javascript">
	$(document).ready(function(){
		$('#tanggal_mulai').datepicker({ format: 'dd-mm-yyyy' });
		$('#tanggal_selesai').datepicker({ format: 'dd-mm-yyyy' });
		
		$( "#autocomplete" ).autocomplete({
			source: function (request, response)
			{
				$.ajax(
				{
					url: '<?php echo base_url()."report_pelayanan_mitra/get_all_mitra/"; ?>' + request.term,
					dataType: "json",
					success: function (data) {
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
