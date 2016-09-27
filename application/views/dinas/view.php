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
    <a href="<?php echo base_url(); ?>dinas/tambah"> <button class="btn-primary btn"><i class="fa fa-plus"></i> Tambah</button></a>
    </div>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
<thead>
<tr>
    <th>No</th>
    <th></th>
    <th>Nama Dinas</th>
    <th>Aktif</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody>
<?php
$no=1;
foreach ($all_dinas as $db) :
?>
<tr class="gradeA">
    <td style="text-align: center"><?php echo $no; ?></td>
    <td><img src="<?php echo base_url(); ?>uploads/logo_dinas/thumbs/<?php echo $db['logo_dinas']; ?>" ></td>
    <td><?php echo "$db[nm_dinas]";?><br><?php echo "$db[almt_dinas]";?></td>
    <td align="center"><?php if("$db[stat_aktif]"==1) { echo "Aktif";} else { echo "Tidak Aktif";} ?></td>
    <td align="center"><a href="<?php echo base_url(); ?>dinas/ubah/<?php echo $db['id_dinas']; ?>"><button class="btn-orange btn-sm" title="ubah"><i class="fa fa-edit"></i> Ubah</button> |
        <a href="<?php echo base_url(); ?>dinas/hapus/<?php echo $db['id_dinas']; ?>"> <button class="btn-danger btn-sm" title="hapus" onClick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash-o"></i> Hapus</button> </a></td>
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

