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
    <a href="<?php echo base_url(); ?>syarat/tambah"> <button class="btn-primary btn"><i class="fa fa-plus"></i> Tambah</button></a>
    </div>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
<thead>
<tr>
    <th>No</th>
    <th>Lampiran</th>
    <th>Nama Lampiran</th>
    <th>Ukuran File<br>(KB)</th>
    <th>Jenis File</th>
    <th>Jalur Seleksi</th>
    <th>Wajib</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody>
<?php
$no=1;
foreach ($all_syarat as $db) {
    $jenis_lampiran = $this->syarat_model->get_jenis_syarat($db['id_lampiran']);
    $datas = "";
    foreach ($jenis_lampiran as $value) {
        $datas .= $value['jenis_lampiran']." | ";
    }
    $datas = rtrim($datas, " | ");

    $jalur = $this->syarat_model->get_jalur($db['id_lampiran']);
    $datasy = "";
    foreach ($jalur as $value) {
        $datasy .= $value['nm_jalur']." | ";
    }
    $datasy = rtrim($datasy, " | ");
?>
<tr class="gradeA">
    <td style="text-align: center"><?php echo $no; ?></td>
    <td><?php echo "$db[kd_lampiran]";?></td>
    <td><?php echo "$db[nm_lampiran]";?></td>
    <td align="center"><?php echo "$db[size_lampiran]";?></td>
    <td align="center"><?php echo $datas; ?></td>
    <td align="center"><?php echo $datasy; ?></td>
    <td align="center"><?php if("$db[wajib_lampiran]"==1) { echo "Wajib";} else { echo "Tidak Wajib";} ?></td>
    <td align="center"><?php if("$db[stat_lampiran]"==1) { echo "Aktif";} else { echo "Tidak Aktif";} ?></td>
    <td align="center"><a href="<?php echo base_url(); ?>syarat/ubah/<?php echo $db['id_lampiran']; ?>"><button class="btn-orange btn-sm" title="ubah"><i class="fa fa-edit"></i> Ubah</button> |
        <a href="<?php echo base_url(); ?>syarat/hapus/<?php echo $db['id_lampiran']; ?>"> <button class="btn-danger btn-sm" title="hapus" onClick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash-o"></i> Hapus</button> </a></td>
</tr>
<?php
$no++;
    }
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
