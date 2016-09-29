
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading" id="inner_penugasan">
					<h4><?php echo $judul_halaman; ?></h4>
				</div>
				<div class="panel-body collapse in">
					<div class="panel">
						<a href="<?php echo base_url(); ?>penugasan/tambah/<?php echo($id_pegawai);?>"> <button class="btn-primary btn"><i class="fa fa-plus"></i> Tambah</button></a>
					</div>
					<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example3">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Penugasan</th>
								<th>Objek Penugasan</th>
								<th>Nama Jenis Penugasan</th>
								<th>Nama Peran</th>
								<th>Tanggal Mulai</th>
								<th>Tanggal Selesai</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no=1;
								foreach ($riwayat_penugasan as $db) :
							?>
							<tr class="gradeA">
								<td style="text-align: center"><?php echo $no; ?></td>
								<td><?php echo $db['Nama_Penugasan']; ?></td>
								<td><?php echo $db['Objek_Penugasan'];?></td>
								<td><?php echo $db['Nama_Jenis_Penugasan']; ?></td>
								<td><?php echo $db['Nama_Peran'];?></td>
								<td><?php echo $db['Tanggal_Mulai'];?></td>
								<td><?php echo $db['Tanggal_Selesai'];?></td>
								
								<td align="center"><a href="<?php echo base_url(); ?>penugasan/ubah/<?php echo $db['Pegawai_ID_Pegawai']; ?>/<?php echo $db['ID_Penugasan']; ?>"><button class="btn-orange btn-sm" title="ubah"><i class="fa fa-edit"></i> Ubah</button>
								| <a href="<?php echo base_url(); ?>penugasan/hapus/<?php echo $db['Pegawai_ID_Pegawai']; ?>/<?php echo $db['ID_Penugasan']; ?>"> <button class="btn-danger btn-sm" title="hapus" onClick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash-o"></i> Hapus</button> </a></td>
								
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
		.panel-default > #inner_penugasan.panel-heading {
		background-color: blue;
		}
	</style>		