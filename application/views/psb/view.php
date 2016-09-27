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
    <a href="<?php echo base_url(); ?>psb/tambah"> <button class="btn-primary btn"><i class="fa fa-plus"></i> Tambah</button></a>
    </div>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
<thead>
<tr>
    <th>No</th>
    <th>Nama Sekolah</th>
    <th>Kuota Total</th>
    <th>Kuota Reguler Dalam Kota</th>
    <th>Kuota Reguler Luar Kota</th>
    <th>Kuota Lokal</th>
    <th>Tgl Mulai</th>
    <th>Tgl Tutup</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody>
<?php
$no=1;
foreach ($all_psb as $db) :
?>
<tr class="gradeA">
    <td style="text-align: center"><?php echo $no; ?></td>
    <td><b><?php echo "$db[nm_sekolah]";?></b></td>
    <td align="center"><?php echo "$db[kuota_psb]";?></td>
    <td align="center"><?php echo "$db[kuota_psb_reguler]";?></td>
    <td align="center"><?php echo "$db[kuota_psb_luar]";?></td>
    <td align="center"><?php echo "$db[kuota_psb_lokal]";?></td>
    <td align="center"><?php echo "$db[tgl_awal_psb]";?></td>
    <td align="center"><?php echo "$db[tgl_akhir_psb]";?></td>
    <td align="center"><?php if("$db[stat_psb]"==1) { echo "Aktif";} else { echo "Tidak Aktif";} ?></td>
    <td align="center"><a href="<?php echo base_url(); ?>psb/ubah/<?php echo $db['id_psb']; ?>"><button class="btn-orange btn-sm" title="ubah"><i class="fa fa-edit"></i> Ubah</button> |
        <a href="<?php echo base_url(); ?>psb/hapus/<?php echo $db['id_psb']; ?>"> <button class="btn-danger btn-sm" title="hapus" onClick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash-o"></i> Hapus</button> </a></td>
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
