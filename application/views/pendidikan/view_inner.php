
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading" id="inner_pendidikan">
					<h4><?php echo $judul_halaman; ?></h4>
				</div>
				<div class="panel-body collapse in">
					<div class="panel">
						<a href="<?php echo base_url(); ?>pendidikan/tambah/<?php echo($id_pegawai);?>"> <button class="btn-primary btn"><i class="fa fa-plus"></i> Tambah</button></a>
					</div>
					<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
						<thead>
							<tr>
								<th>No</th>
								<th>Tingkat Pendidikan</th>
								<th>Nama Instansi</th>
								<th>Jurusan</th>
								<th>Nomor Ijazah</th>
								<th>Tanggal Ijazah</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no=1;
								foreach ($riwayat_pendidikan as $db) :
							?>
							<tr class="gradeA">
								<td style="text-align: center"><?php echo $no; ?></td>
								<td><?php echo $db['Nama_Tingkat_Pendidikan']; ?></td>
								<td><?php echo $db['Nama_Instansi'];?></td>
								<td><?php echo $db['Jurusan']; ?></td>
								<td><?php echo $db['Nomor_Ijazah'];?></td>
								<td><?php echo $db['Tanggal_Ijazah'];?></td>
								
								<td align="center"><a href="<?php echo base_url(); ?>pendidikan/ubah/<?php echo $db['Pegawai_ID_Pegawai']; ?>/<?php echo $db['ID_Pendidikan']; ?>"><button class="btn-orange btn-sm" title="ubah"><i class="fa fa-edit"></i> Ubah</button>
								| <a href="<?php echo base_url(); ?>pendidikan/hapus/<?php echo $db['Pegawai_ID_Pegawai']; ?>/<?php echo $db['ID_Pendidikan']; ?>"> <button class="btn-danger btn-sm" title="hapus" onClick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash-o"></i> Hapus</button> </a></td>
								
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
	
	<style type="text/css">
		.panel-default > #inner_pendidikan.panel-heading {
		background-color: green;
		}
	</style>	
