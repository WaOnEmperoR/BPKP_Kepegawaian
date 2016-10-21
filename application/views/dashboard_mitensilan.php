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
								</ol>
								<div class="carousel-inner">
									<div class="item active">
										<img src="http://placehold.it/900x500/39CCCC/ffffff&text=I+Love+Bootstrap" alt="First slide">
										
										<div class="carousel-caption">
											First Slide
										</div>
									</div>
									<div class="item">
										<img src="http://placehold.it/900x500/3c8dbc/ffffff&text=I+Love+Bootstrap" alt="Second slide">
										
										<div class="carousel-caption">
											Second Slide
										</div>
									</div>
									<div class="item">
										<img src="http://placehold.it/900x500/f39c12/ffffff&text=I+Love+Bootstrap" alt="Third slide">
										
										<div class="carousel-caption">
											Third Slide
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
								<div id="myfirstchart">
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
		
		var arr = [];
		$.each($.parseJSON(yearly_service), function(key,value){
			arr.push({
				Tahun: value.Tahun,
				Jumlah: value.Jumlah
			});
		});
				
		new Morris.Bar({
			element: 'myfirstchart',
			data: arr, // use returned data to plot the graph
			xkey: 'Tahun',
			ykeys: ['Jumlah'],
			labels: ['Jumlah']
		});
		
	});
</script>