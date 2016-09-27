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
    <a href="<?php echo base_url(); ?>pengguna/tambah"> <button class="btn-primary btn"><i class="fa fa-plus"></i> Tambah</button></a>
    </div>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
<thead>
<tr>
    <th>No</th>
    <th>Nama Lengkap</th>
    <th>Username</th>
    <th>Email</th>
    <th>Level</th>
    <th>Instansi</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody>
<?php
$no=1;
foreach ($all_pengguna as $db) :
?>
<?php if($db['level']!=1 || (is_admin() && $db['level']==1)){
 ?>
<tr class="gradeA">
    <td style="text-align: center"><?php echo $no; ?></td>
    <td><b><?php echo "$db[nm_pegawai]";?></b></td>
    <td><?php echo "$db[username]";?></td>
    <td><?php echo "$db[email]";?></td>
    <td align="center"><?php echo get_level_pengguna($db['level']); ?></td>
    <td><?php echo "$db[instansi]";?></td>
    <td align="center"><?php if("$db[sta_aktif]"==1) {
            echo "AKTIF";
        } else {echo "TIDAK AKTIF"; }?></td>
    <td align="center"><a href="<?php echo base_url(); ?>pengguna/ubah/<?php echo $db['id_login']; ?>"><button class="btn-orange btn-sm" title="ubah"><i class="fa fa-edit"></i> Ubah</button> |
        <a href="<?php echo base_url(); ?>pengguna/hapus/<?php echo $db['id_login']; ?>"> <button class="btn-danger btn-sm" title="hapus" onClick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash-o"></i> Hapus</button> </a></td>
</tr>
<?php $no++;} ?>
<?php
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
