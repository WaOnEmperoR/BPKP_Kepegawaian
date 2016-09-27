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
								<a href="<?php echo base_url(); ?>pegawai/tambah"> <button class="btn-primary btn"><i class="fa fa-plus"></i> Tambah</button></a>
							</div>
							<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama pegawai</th>
										<th>NIK</th>
										<th>NIP</th>
										<th>Tempat Lahir</th>
										<th>Tanggal Lahir</th>
										<th>Alamat</th>
										<th>Jenis Kelamin</th>
										<th>Agama</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$no=1;
										foreach ($all_pegawai as $db) :
									?>
									<tr class="gradeA">
										<td style="text-align: center"><?php echo $no; ?></td>
										<td><?php echo $db['Nama_Pegawai']; ?></td>
										<td><?php echo $db['NIK'];?></td>
										<td><?php echo $db['NIP']; ?></td>
										<td><?php echo $db['Tempat_Lahir'];?></td>
										<td><?php echo $db['Tanggal_Lahir'];?></td>
										<td><?php echo $db['Alamat'];?></td>
										<td><?php echo $db['Jenis_Kelamin'];?></td>
										<td><?php echo $db['Agama'];?></td>
										
										<td align="center"><a href="<?php echo base_url(); ?>pegawai/ubah/<?php echo $db['ID_Pegawai']; ?>"><button class="btn-orange btn-sm" title="ubah"><i class="fa fa-edit"></i> Ubah</button>
											<?php
												if (!is_current_user($db['ID_Pegawai']))
												{
												?>
											| <a href="<?php echo base_url(); ?>pegawai/hapus/<?php echo $db['ID_Pegawai']; ?>"> <button class="btn-danger btn-sm" title="hapus" onClick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash-o"></i> Hapus</button> </a></td>
											<?php
											}
											
										?>
										
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
