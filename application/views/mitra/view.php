<div id="page-content">
	<div id='wrap'>
		<div id="page-heading">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>home">Dashboard</a></li>
				<li><?php echo $breadcumb; ?></li>
				<li class="active"><?php echo $judul_halaman; ?></li>
			</ol>
		</div>
		
		
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-indigo">
						<div class="panel-heading">
							<h4><?php echo $judul_halaman; ?></h4>
						</div>
						<div class="panel-body collapse in">
							<div class="panel">
								<a href="<?php echo base_url(); ?>mitra/tambah"> <button class="btn-primary btn"><i class="fa fa-plus"></i> Tambah</button></a>
							</div>
							<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
								<thead>
									<tr>
										<th rowspan="2">No</th>
										<th>Nama Mitra</th>
										<th>Alamat Mitra</th>
										<th>Kota</th>
										<th>Provinsi</th>
										<th>Bidang Usaha</th>
										<th>Deskripsi</th>
										<th>Kategori Mitra</th>
										<th>Aksi</th>
									</tr>
									<tr id="filterrow">
										<th>Nama Mitra</th>
										<th>Alamat Mitra</th>
										<th>Kota</th>
										<th>Provinsi</th>
										<th>Bidang Usaha</th>
										<th>Deskripsi</th>
										<th>Kategori Mitra</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$no=1;
										foreach ($all_mitra as $db) :
									?>
									<tr class="gradeA">
										<td style="text-align: center"><?php echo $no; ?></td>
										<td><?php echo $db['Nama_Mitra']; ?></td>
										<td><?php echo $db['Alamat_Mitra'];?></td>
										<td><?php echo $db['Kota']; ?></td>
										<td><?php echo $db['Provinsi'];?></td>
										<td><?php echo $db['Bidang_Usaha'];?></td>
										<td><?php echo $db['Deskripsi'];?></td>
										<td><?php echo $db['Nama_Kategori'];?></td>
										
										<td align="center"><a href="<?php echo base_url(); ?>mitra/ubah/<?php echo $db['ID_Mitra']; ?>"><button class="btn-orange btn-sm" title="ubah"><i class="fa fa-edit"></i> Ubah</button>
											| <a href="<?php echo base_url(); ?>mitra/hapus/<?php echo $db['ID_Mitra']; ?>"> <button class="btn-danger btn-sm" title="hapus" onClick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash-o"></i> Hapus</button> </a></td>
											
										
										</tr>
										<?php
											$no++;
											endforeach;
										?>
										
									</tbody>
								</table>
								
								
							</div>
						</div>
					</div>
				</div>
				
			</div> <!-- container -->
		</div> <!--wrap -->
	</div> <!-- page-content -->
	
	
	<script type="text/javascript">
		// Setup - add a text input to each footer cell
		$('#example thead tr#filterrow th').each( function () {
			var title = $('#example thead th').eq( $(this).index() + 1).text();
			$(this).html( '<input type="text" class="form-control" onclick="stopPropagation(event);" placeholder="Search '+title+'" />' );
		} );
		
		
		// DataTable
		var table = $('#example').DataTable();
		
		
		// Apply the filter
		$("#example thead input").on( 'keyup change', function () {
			table.column( ($(this).parent().index() + 1) +':visible' )
            .search( this.value )
            .draw();
		} );
		
		function stopPropagation(evt) {
			if (evt.stopPropagation !== undefined) {
				evt.stopPropagation();
				} else {
				evt.cancelBubble = true;
			}
		}
		
	</script>				
