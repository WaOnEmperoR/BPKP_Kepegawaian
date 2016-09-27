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
                                <div class="alert alert-info">
                                    Untuk meng-upload data nilai UN melalui import, mohon untuk mengikuti format yang telah disediakan oleh aplikasi, dengan data nilai ujian dimulai pada baris ke-7 seperti pada contoh yang dapat diunduh.
                                </div>
                            </div>

							<div class="panel">
								<?php if(!empty($this->session->flashdata('messages'))){ ?>
								<div class="alert alert-success">
									<?php echo $this->session->flashdata('messages'); ?>
								</div>
								<?php } ?>
							</div>
							<div class="panel">
								<a href="<?php echo base_url(); ?>nilaiun/tambah"> <button class="btn-primary btn"><i class="fa fa-plus"></i> Tambah</button></a> &nbsp; &nbsp; &nbsp;
								<a href="<?php echo base_url(); ?>nilaiun/import"> <button class="btn-info btn"><i class="fa fa-upload"></i> Import Excel</button></a> &nbsp; &nbsp; &nbsp;
                                <a href="<?php echo base_url(); ?>uploads/nilai_un/format.xlsx"> <button class="btn-success btn"><i class="fa fa-download"></i> Unduh Format Import Excel</button></a>
							</div>
							<div class="table-responsive">
								<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
									<thead>
										<tr>
											<th>No</th>
											<th>No. Peserta</th>
											<th>Nama Peserta</th>
											<th>Tempat Lahir</th>
											<th>Tanggal Lahir</th>
											<th>Nilai Bahasa Indonesia</th>
											<th>Nilai Bahasa Inggris</th>
											<th>Nilai Matematika</th>
											<th>Nilai IPA</th>
											<th>Nilai UN Total</th>
											<th>Sekolah Asal</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$no=1;
											foreach ($all_nilai as $db) :
										?>
										<tr class="gradeA">
											<td style="text-align: center"><?php echo $no; ?></td>
											<td><?php echo "$db[no_peserta]";?></td>
											<td><?php echo "$db[nama_peserta]";?></td>
											<td><?php echo "$db[tempat_lahir]";?></td>
											<td><?php echo "$db[tanggal_lahir]";?></td>
											<td><?php echo "$db[n_mapel_01]";?></td>
											<td><?php echo "$db[n_mapel_02]";?></td>
											<td><?php echo "$db[n_mapel_03]";?></td>
											<td><?php echo "$db[n_mapel_04]";?></td>
											<td><?php echo "$db[n_mapel_total]";?></td>
											<td><?php echo "$db[sekolah_asal]";?></td>
											<td align="center"><a href="<?php echo base_url(); ?>nilaiun/ubah/<?php echo $db['id']; ?>"><button class="btn-orange btn-sm" title="ubah"><i class="fa fa-edit"></i> Ubah</button> |
											<a href="<?php echo base_url(); ?>nilaiun/hapus/<?php echo $db['id']; ?>"> <button class="btn-danger btn-sm" title="hapus" onClick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash-o"></i> Hapus</button> </a></td>
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
				</div>
				
			</div> <!-- container -->
		</div> <!--wrap -->
	</div> <!-- page-content -->
