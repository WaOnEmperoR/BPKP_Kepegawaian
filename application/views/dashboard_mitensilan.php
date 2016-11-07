<div id="page-content">
	<div id='wrap'>
		<div class="container">
			
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-sky">
						<div class="panel-body">
							<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
								<ol class="carousel-indicators">
									<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
									<li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
									<li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
									<li data-target="#carousel-example-generic" data-slide-to="3" class=""></li>
								</ol>
								<div class="carousel-inner">
									<div class="item active">
										<img src="<?php echo base_url(); ?>assets/img/carousel/gong_perdamaian.jpg" alt="First slide">
										
										<div class="carousel-caption">
											Gong Perdamaian
										</div>
									</div>
									<div class="item">
										<img src="<?php echo base_url(); ?>assets/img/carousel/jembatan_merah_putih.jpg" alt="Second slide">
										
										<div class="carousel-caption">
											Jembatan Merah Putih
										</div>
									</div>
									<div class="item">
										<img src="<?php echo base_url(); ?>assets/img/carousel/monumen_christina.jpg" alt="Third slide">
										
										<div class="carousel-caption">
											Monumen Christina Martha Tiahahu
										</div>
									</div>
									<div class="item">
										<img src="<?php echo base_url(); ?>assets/img/carousel/mesjid_al_fatah.jpg" alt="Fourth slide">
										
										<div class="carousel-caption">
											Masjid Raya Al-Fatah Ambon
										</div>
									</div>
								</div>
								<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
									<span class="fa fa-angle-left"></span>
								</a>
								<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
									<span class="fa fa-angle-right"></span>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						
						<div class="panel panel-sky">
							<div class="panel-heading">
								<h4 style="display: inline-block">Layanan Per Tahun</h4>
							</div>
							<div class="panel-body">
								<div id="layanan_tahunan">
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						
						<div class="panel panel-indigo">
							<div class="panel-heading">
								<h4 style="display: inline-block">Layanan Per Pegawai</h4>
							</div>
							<div class="panel-body">
								<div id="layanan_pegawai">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> 
	</div> 
</div>

<script>
	$(document).ready(function () {
		var layanan_per_tahun = [];
		var yearly_service = '<?php echo($graph['yearly_service']);?>';
		var employee_service = '<?php echo($graph['employee_service']);?>';
		
		var arr_year = [];
		$.each($.parseJSON(yearly_service), function(key,value){
			arr_year.push({
				Tahun: value.Tahun,
				Jumlah: value.Jumlah
			});
		});

		var arr_employee = [];
		$.each($.parseJSON(employee_service), function(key,value){
			arr_employee.push({
				Nama_Pegawai: value.Nama_Pegawai,
				Jumlah_Pelayanan: value.Jumlah_Pelayanan
			});
		});
				
		new Morris.Bar({
			element: 'layanan_tahunan',
			data: arr_year, // use returned data to plot the graph
			xkey: 'Tahun',
			ykeys: ['Jumlah'],
			labels: ['Jumlah']
		});

		new Morris.Bar({
			element: 'layanan_pegawai',
			data: arr_employee, // use returned data to plot the graph
			xkey: 'Nama_Pegawai',
			ykeys: ['Jumlah_Pelayanan'],
			labels: ['Jumlah_Pelayanan']
		});
		
	});
</script>