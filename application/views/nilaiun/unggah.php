<div id="page-content">
	<div id='wrap'>
		<div id="page-heading">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>home">Dashboard</a></li>
				<li><?php echo $breadcumb; ?></li>
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
					<form id="form" enctype="multipart/form-data" action="<?php echo base_url(); ?>nilaiun/upload" method="post" class="form-horizontal row-border">
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Import Data UN</label>
							<div class="col-sm-6">
								<input type="file" name="file_name" size="20" />
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