<html>
	<head>
		<title>Report Rekap Pelayanan</title>
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
		<h2 align="center" style="font-family:helvetica;">DATA PELAYANAN</h2>
		<table border="0">
			<tr>
				<td height="20px"></td>
			</tr> 
		</table>
		
		<h4 align="left" style="font-family:helvetica;">
			DATA PELAYANAN BERDASARKAN PENYARINGAN
		</h4>
		
		<table cellpadding="0" cellspacing="0" border="1" id="example">
			<thead>
				<tr style="background-color:#424242;color:white;">
					<th width="4%" class="kategori" align="center">No</th>
					<th width="15%" class="kategori" align="center">Nomor Pelayanan</th>
					<th width="23%" class="kategori" align="center">Judul Pelayanan</th>
					<th width="23%" class="kategori" align="center">Tanggal Mulai</th>
					<th width="20%" class="kategori" align="center">Tanggal Selesai</th>
					<th width="15%" class="kategori" align="center">Tanggal Laporan Pelaksanaan</th>
					<th width="15%" class="kategori" align="center">Biaya</th>
					<th width="15%" class="kategori" align="center">Nama Mitra</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$no=1;
					foreach ($list_pelayanan as $db) :
				?>
				<tr class="gradeA">
					<td width="4%"  style="text-align: center" class="konten"><?php echo $no; ?></td>
					<td width="15%" class="konten"><?php echo $db['Nomor_Pelayanan']; ?></td>
					<td width="23%" class="konten"><?php echo $db['Judul_Pelayanan'];?></td>
					<td width="23%" class="konten"><?php echo $db['Tanggal_Mulai']; ?></td>
					<td width="20%" class="konten"><?php echo $db['Tanggal_Selesai'];?></td>
					<td width="15%" class="konten"><?php echo $db['Tanggal_Laporan_Pelaksanaan'];?></td>
					<td width="15%" class="konten"><?php echo $db['Biaya'];?></td>
					<td width="15%" class="konten"><?php echo $db['Nama_Mitra'];?></td>
				</tr>
				<?php
					$no++;
					endforeach;
				?>
				
			</tbody>
		</table>
		
	</body>
</html>	

