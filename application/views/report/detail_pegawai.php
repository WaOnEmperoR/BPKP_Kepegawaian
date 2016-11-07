<html>
	<head>
		<title>Report Detail per Pegawai</title>
		<style type="text/css">
			.kategori{
			font-family: calibrib;
			padding-left: 5px;
			vertical-align: center;
			}
			.konten
			{
			font-family: calibri;
			padding-left: 5px;
			}
		</style>
	</head>
	<body>
		<h2 align="center" style="font-family:helvetica;">BIODATA PEGAWAI</h2>
		<table border="0">
			<tr>
				<td height="20px"></td>
			</tr> 
		</table>
		
		<table border="0">
			<tr>
				<td width="18%" class="kategori">Nama Pegawai</td>
				<td width="3%" align="centre">:</td>
				<td width="60%" class="konten" align="left"><?php echo $pegawai['Nama_Pegawai']; ?></td>
			</tr>
			<tr>
				<td width="18%" class="kategori">NIK</td>
				<td width="3%" align="centre">:</td>
				<td width="60%" class="konten"><?php echo $pegawai['NIK']; ?></td>
			</tr>
			<tr>
				<td width="18%" class="kategori">NIP</td>
				<td width="3%" align="centre">:</td>
				<td width="60%" class="konten"><?php echo $pegawai['NIP']; ?></td>
			</tr>
			<tr>
				<td width="18%" class="kategori">Tempat Lahir</td>
				<td width="3%" align="centre">:</td>
				<td width="60%" class="konten"><?php echo $pegawai['Tempat_Lahir']; ?></td>
			</tr>
			<tr>
				<td width="18%" class="kategori">Tanggal Lahir</td>
				<td align="centre">:</td>
				<td width="60%" class="konten" align="left"><?php echo $pegawai['Tanggal_Lahir']; ?></td>
			</tr>
			<tr>
				<td width="18%" class="kategori">Alamat</td>
				<td align="centre">:</td>
				<td width="60%" class="konten" align="left"><?php echo $pegawai['Alamat']; ?></td>
			</tr>
			<tr>
				<td width="18%" class="kategori">Jenis Kelamin</td>
				<td align="centre">:</td>
				<td width="60%" class="konten" align="left"><?php echo $pegawai['Jenis_Kelamin']; ?></td>
			</tr>
			<tr>
				<td width="18%" class="kategori">Agama</td>
				<td align="centre">:</td>
				<td width="60%" class="konten" align="left"><?php echo $pegawai['Agama']; ?></td>
			</tr>
			
			
		</table>
		
		<h4 align="left" style="font-family:helvetica;">
			DATA RIWAYAT PENDIDIKAN
		</h4>
		
		<table cellpadding="0" cellspacing="0" border="1" id="example">
			<thead>
				<tr style="background-color:#424242;color:white;">
					<th width="4%" class="kategori" align="center">No</th>
					<th width="15%" class="kategori" align="center">Tingkat Pendidikan</th>
					<th width="23%" class="kategori" align="center">Nama Instansi</th>
					<th width="23%" class="kategori" align="center">Jurusan</th>
					<th width="20%" class="kategori" align="center">Nomor Ijazah</th>
					<th width="15%" class="kategori" align="center">Tanggal Ijazah</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$no=1;
					foreach ($riwayat_pendidikan as $db) :
				?>
				<tr class="gradeA">
					<td width="4%"  style="text-align: center" class="konten"><?php echo $no; ?></td>
					<td width="15%" class="konten"><?php echo $db['Nama_Tingkat_Pendidikan']; ?></td>
					<td width="23%" class="konten"><?php echo $db['Nama_Instansi'];?></td>
					<td width="23%" class="konten"><?php echo $db['Jurusan']; ?></td>
					<td width="20%" class="konten"><?php echo $db['Nomor_Ijazah'];?></td>
					<td width="15%" class="konten"><?php echo $db['Tanggal_Ijazah'];?></td>
					
				</tr>
				<?php
					$no++;
					endforeach;
				?>
				
			</tbody>
		</table>
		
		<h4 align="left" style="font-family:helvetica;">
			DATA RIWAYAT DIKLAT
		</h4>
		
		<table cellpadding="0" cellspacing="0" border="1" id="example">
			<thead>
				<tr style="background-color:#424242;color:white;">
					<th width="4%" class="kategori" align="center">No</th>
					<th width="15%" class="kategori" align="center">Jenis Diklat</th>
					<th width="23%" class="kategori" align="center">Nama Diklat</th>
					<th width="23%" class="kategori" align="center">Lembaga Penyelenggara</th>
					<th width="20%" class="kategori" align="center">Nomor Sertifikat</th>
					<th width="15%" class="kategori" align="center">Tanggal Sertifikat</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$no=1;
					foreach ($riwayat_diklat as $db) :
				?>
				<tr class="gradeA">
					<td width="4%"  style="text-align: center" class="konten"><?php echo $no; ?></td>
					<td width="15%" class="konten"><?php echo $db['Nama_Jenis_Diklat']; ?></td>
					<td width="23%" class="konten"><?php echo $db['Nama_Pelatihan'];?></td>
					<td width="23%" class="konten"><?php echo $db['Lembaga_Penyelenggara']; ?></td>
					<td width="20%" class="konten"><?php echo $db['No_Sertifikat'];?></td>
					<td width="15%" class="konten"><?php echo $db['Tanggal_Sertifikat'];?></td>
					
				</tr>
				<?php
					$no++;
					endforeach;
				?>
				
			</tbody>
		</table>
		
		<h4 align="left" style="font-family:helvetica;">
			DATA RIWAYAT SERTIFIKASI
		</h4>
		
		<table cellpadding="0" cellspacing="0" border="1" id="example">
			<thead>
				<tr style="background-color:#424242;color:white;">
					<th width="4%" class="kategori" align="center">No</th>
					<th width="15%" class="kategori" align="center">Jenis Sertifikasi</th>
					<th width="23%" class="kategori" align="center">Nama Sertifikat</th>
					<th width="23%" class="kategori" align="center">Lembaga Penyelenggara</th>
					<th width="20%" class="kategori" align="center">Nomor Sertifikat</th>
					<th width="15%" class="kategori" align="center">Tanggal Sertifikat</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$no=1;
					foreach ($riwayat_sertifikasi as $db) :
				?>
				<tr class="gradeA">
					<td width="4%"  style="text-align: center" class="konten"><?php echo $no; ?></td>
					<td width="15%" class="konten"><?php echo $db['Nama_Jenis_Sertifikasi']; ?></td>
					<td width="23%" class="konten"><?php echo $db['Nama_Sertifikasi'];?></td>
					<td width="23%" class="konten"><?php echo $db['Lembaga_Penyelenggara']; ?></td>
					<td width="20%" class="konten"><?php echo $db['No_Sertifikat'];?></td>
					<td width="15%" class="konten"><?php echo $db['Tanggal_Sertifikat'];?></td>
					
				</tr>
				<?php
					$no++;
					endforeach;
				?>
				
			</tbody>
		</table>
		
		<br pagebreak="true" />
		
		<h4 align="left" style="font-family:helvetica;">
			DATA RIWAYAT PENUGASAN
		</h4>
		
		<table cellpadding="0" cellspacing="0" border="1" id="example">
			<thead>
				<tr style="background-color:#424242;color:white;">
					<th width="4%" class="kategori" align="center">No</th>
					<th width="15%" class="kategori" align="center">Nama Penugasan</th>
					<th width="23%" class="kategori" align="center">Objek Penugasan</th>
					<th width="23%" class="kategori" align="center">Nama Jenis Penugasan</th>
					<th width="20%" class="kategori" align="center">Nama Peran</th>
					<th width="15%" class="kategori" align="center">Periode</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$no=1;
					foreach ($riwayat_penugasan as $db) :
				?>
				<tr class="gradeA">
					<td width="4%"  style="text-align: center" class="konten"><?php echo $no; ?></td>
					<td width="15%" class="konten"><?php echo $db['Nama_Penugasan']; ?></td>
					<td width="23%" class="konten"><?php echo $db['Objek_Penugasan'];?></td>
					<td width="23%" class="konten"><?php echo $db['Nama_Jenis_Penugasan']; ?></td>
					<td width="20%" class="konten"><?php echo $db['Nama_Peran'];?></td>
					<td width="15%" class="konten"><?php echo $db['Periode'];?></td>
					
				</tr>
				<?php
					$no++;
					endforeach;
				?>
				
			</tbody>
		</table>
		
		<h4 align="left" style="font-family:helvetica;">
			DATA RIWAYAT PELAYANAN
		</h4>
		
		<table cellpadding="0" cellspacing="0" border="1" id="example">
			<thead>
				<tr style="background-color:#424242;color:white;">
					<th width="4%" class="kategori" align="center">No</th>
					<th width="15%" class="kategori" align="center">Nomor Pelayanan</th>
					<th width="23%" class="kategori" align="center">Judul Pelayanan</th>
					<th width="23%" class="kategori" align="center">Nama Mitra</th>
					<th width="20%" class="kategori" align="center">Nama Peran</th>
					<th width="15%" class="kategori" align="center">Periode</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$no=1;
					foreach ($riwayat_pelayanan as $db) :
				?>
				<tr class="gradeA">
					<td width="4%"  style="text-align: center" class="konten"><?php echo $no; ?></td>
					<td width="15%" class="konten"><?php echo $db['Nomor_Pelayanan']; ?></td>
					<td width="23%" class="konten"><?php echo $db['Judul_Pelayanan'];?></td>
					<td width="23%" class="konten"><?php echo $db['Nama_Mitra']; ?></td>
					<td width="20%" class="konten"><?php echo $db['Nama_Peran'];?></td>
					<td width="15%" class="konten"><?php echo $db['Pelaksanaan'];?></td>
					
				</tr>
				<?php
					$no++;
					endforeach;
				?>
				
			</tbody>
		</table>
	</body>
</html>	

