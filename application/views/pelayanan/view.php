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
								<a href="<?php echo base_url(); ?>pelayanan/tambah"> <button class="btn-primary btn"><i class="fa fa-plus"></i> Tambah</button></a>
							</div>
							<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
								<thead>
									<tr>
										<th rowspan="2">No</th>
										<th>Nomor Pelayanan</th>
										<th>Judul Pelayanan</th>
										<th>Tanggal Mulai</th>
										<th>Tanggal Selesai</th>
										<th>Tanggal Laporan Penyelesaian</th>
										<th>Biaya</th>
										<th>Nama Mitra</th>
										<th>Kategori Layanan</th>
										<th rowspan="2">Aksi</th>
									</tr>
									<tr id="filterrow">
										<th>Nomor Pelayanan</th>
										<th>Judul Pelayanan</th>
										<th>Tanggal Mulai</th>
										<th>Tanggal Selesai</th>
										<th>Tanggal Laporan Penyelesaian</th>
										<th>Biaya</th>
										<th>Nama Mitra</th>
										<th>Kategori Layanan</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$no=1;
										foreach ($all_pelayanan as $db) :
									?>
									<tr class="gradeA">
										<td style="text-align: center"><?php echo $no; ?></td>
										<td><?php echo $db['Nomor_Pelayanan']; ?></td>
										<td><?php echo $db['Judul_Pelayanan'];?></td>
										<td><?php echo $db['Tanggal_Mulai']; ?></td>
										<td><?php echo $db['Tanggal_Selesai'];?></td>
										<td><?php echo $db['Tanggal_Laporan_Pelaksanaan'];?></td>
										<td class="uang"><?php echo $db['Biaya'];?></td>
										<td><?php echo $db['Nama_Mitra'];?></td>
										<td><?php echo $db['Kategori_Layanan'];?></td>
										
										<td align="center"><a href="<?php echo base_url(); ?>pelayanan/ubah/<?php echo $db['ID_Pelayanan']; ?>"><button class="btn-orange btn-sm" title="ubah"><i class="fa fa-edit"></i> Ubah</button>
										| <a href="<?php echo base_url(); ?>pelayanan/hapus/<?php echo $db['ID_Pelayanan']; ?>"> <button class="btn-danger btn-sm" title="hapus" onClick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash-o"></i> Hapus</button> </a></td>
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
		
		$('.uang').priceFormat({
			prefix: 'Rp ',
			centsSeparator: ',',
			thousandsSeparator: '.',
			centsLimit: 0			
		});
		
	</script>				
