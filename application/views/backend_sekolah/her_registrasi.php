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


<div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Regular Dalam Tangsel</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Regular Luar Tangsel</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Lokal Alamat</a>
                        </li>
												<li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab3" data-toggle="tab" aria-expanded="false">Lokal Prestasi</a>
                        </li><li role="presentation" class=""><a href="#tab_content5" role="tab" id="profile-tab4" data-toggle="tab" aria-expanded="false">Lokal Ekonomi</a>
                        </li>
                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                          <!-- start reguler dalam tangsel -->
<div class="panel-body collapse in">
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
<thead>
<tr>
    <th>Peringkat</th>
    <th>Nomor Induk Siswa Nasional (NISN)</th>
    <th>Nama</th>
    <th>Sekolah Asal</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody>
<?php
$no=1;
/*foreach ($all_kecamatan as $db) :*/
?>
<tr class="gradeA">
    <td style="text-align: center"><?php echo $no; ?></td>
    <td>100006109/19580714198103200</td>
    <td>SRI SUHARTINI</td>
    <td>SMPN 6 TANGERANG</td>

<td align="center"><a href="<?php echo base_url(); ?>pengguna/ubah/<?php //echo $db['id_syarat']; ?>"><button class="btn-orange btn-sm" title="ubah"><i class="fa fa-edit"></i>Her Registrasi</button></td></tr>
<?php
$no++;
    /*endforeach;*/
?>
<tr>
  <td style="text-align: center"><?php echo $no; ?></td>
  <td>100010487/19580821199003100</td>
  <td>TATANG SUPRIATNA</td>
    <td>SMPN 7 TANGERANG</td>

<td align="center"><a href="<?php echo base_url(); ?>pengguna/ubah/<?php //echo $db['id_syarat']; ?>"><button class="btn-orange btn-sm" title="ubah"><i class="fa fa-edit"></i>Her Registrasi</button></td></tr>

</tbody>
</table>
</div>

                          <!-- end reguler dalam tangsel -->

                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                          <!-- start reguler luar tangsel -->
<div class="panel-body collapse in">
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
<thead>
<tr>
    <th>Peringkat</th>
    <th>Nomor Induk Siswa Nasional (NISN)</th>
    <th>Nama</th>
    <th>Sekolah Asal</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody>
<?php
$no=1;
/*foreach ($all_kecamatan as $db) :*/
?>
<tr class="gradeA">
    <td style="text-align: center"><?php echo $no; ?></td>
    <td>100006109/19580714198103200</td>
    <td>SRI SUHARTINI</td>
    <td>SMPN 10 TANGERANG</td>

<td align="center"><a href="<?php echo base_url(); ?>pengguna/ubah/<?php //echo $db['id_syarat']; ?>"><button class="btn-orange btn-sm" title="ubah"><i class="fa fa-edit"></i>Her Registrasi</button></td></tr>
<?php
$no++;
    /*endforeach;*/
?>
<tr>
  <td style="text-align: center"><?php echo $no; ?></td>
  <td>100010487/19580821199003100</td>
  <td>TATANG SUPRIATNA</td>
  <td>SMPN 2 TANGERANG</td>

<td align="center"><a href="<?php echo base_url(); ?>pengguna/ubah/<?php //echo $db['id_syarat']; ?>"><button class="btn-orange btn-sm" title="ubah"><i class="fa fa-edit"></i>Her Registrasi</button></td></tr>

</tbody>
</table>
</div>
                          <!-- end reguler luar tangsel -->

                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                          <!-- start reguler luar tangsel -->
<div class="panel-body collapse in">
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
<thead>
<tr>
    <th>Peringkat</th>
    <th>Nomor Induk Siswa Nasional (NISN)</th>
    <th>Nama</th>
    <th>Sekolah Asal</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody>
<?php
$no=1;
/*foreach ($all_kecamatan as $db) :*/
?>
<tr class="gradeA">
    <td style="text-align: center"><?php echo $no; ?></td>
    <td>100006109/19580714198103200</td>
    <td>SRI SUHARTINI</td>
    <td>SMP WIRASWASTA TANGERANG</td>

<td align="center"><a href="<?php echo base_url(); ?>pengguna/ubah/<?php //echo $db['id_syarat']; ?>"><button class="btn-orange btn-sm" title="ubah"><i class="fa fa-edit"></i>Her Registrasi</button></td></tr>

<?php
$no++;
    /*endforeach;*/
?>
<tr>
  <td style="text-align: center"><?php echo $no; ?></td>
  <td>100010487/19580821199003100</td>
  <td>TATANG SUPRIATNA</td>
    <td>SMPN 5 TANGERANG</td>

<td align="center"><a href="<?php echo base_url(); ?>pengguna/ubah/<?php //echo $db['id_syarat']; ?>"><button class="btn-orange btn-sm" title="ubah"><i class="fa fa-edit"></i>Her Registrasi</button></td></tr>

</tbody>
</table>
</div>
                          <!-- end reguler luar tangsel -->
                        

												</div>

                        <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">

                          <!-- start lokal alamat -->
<div class="panel-body collapse in">
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
<thead>
<tr>
    <th>Peringkat</th>
    <th>Nomor Induk Siswa Nasional (NISN)</th>
    <th>Nama</th>
    <th>Sekolah Asal</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody>
<?php
$no=1;
/*foreach ($all_kecamatan as $db) :*/
?>
<tr class="gradeA">
    <td style="text-align: center"><?php echo $no; ?></td>
    <td>100006109/19580714198103200</td>
    <td>SRI SUHARTINI</td>
    <td>SMP YPKI 1 TANGERANG</td>

<td align="center"><?php echo (rand(10,100)); ?></td>
</tr>
<?php
$no++;
    /*endforeach;*/
?>
<tr>
  <td style="text-align: center"><?php echo $no; ?></td>
  <td>100010487/19580821199003100</td>
  <td>TATANG SUPRIATNA</td>
  <td>SMPN 7 TANGERANG</td>

<td align="center"><a href="<?php echo base_url(); ?>pengguna/ubah/<?php //echo $db['id_syarat']; ?>"><button class="btn-orange btn-sm" title="ubah"><i class="fa fa-edit"></i>Her Registrasi</button></td></tr>

</tbody>
</table>
</div>
                          <!-- end lokal alamat -->

                        </div>


<div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">

                          <!-- start lokal prestasi -->
<div class="panel-body collapse in">
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
<thead>
<tr>
    <th>Peringkat</th>
    <th>Nomor Induk Siswa Nasional (NISN)</th>
    <th>Nama</th>
    <th>Sekolah Asal</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody>
<?php
$no=1;
/*foreach ($all_kecamatan as $db) :*/
?>
<tr class="gradeA">
    <td style="text-align: center"><?php echo $no; ?></td>
    <td>100006109/19580714198103200</td>
    <td>SRI SUHARTINI</td>
		<td>SMPN 9 TANGERANG</td>

<td align="center"><a href="<?php echo base_url(); ?>pengguna/ubah/<?php //echo $db['id_syarat']; ?>"><button class="btn-orange btn-sm" title="ubah"><i class="fa fa-edit"></i>Her Registrasi</button></td></tr>
<?php
$no++;
    /*endforeach;*/
?>
<tr>
  <td style="text-align: center"><?php echo $no; ?></td>
  <td>100010487/19580821199003100</td>
  <td>TATANG SUPRIATNA</td>
    <td>SMP PGRI 1 TANGERANG</td>

<td align="center"><a href="<?php echo base_url(); ?>pengguna/ubah/<?php //echo $db['id_syarat']; ?>"><button class="btn-orange btn-sm" title="ubah"><i class="fa fa-edit"></i>Her Registrasi</button></td></tr>

</tbody>
</table>
</div>
                          <!-- end lokal prestasi -->

                        </div>

<div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab">

                          <!-- start lokal ekonomi -->
<div class="panel-body collapse in">
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
<thead>
<tr>
    <th>Peringkat</th>
    <th>Nomor Induk Siswa Nasional (NISN)</th>
    <th>Nama</th>
    <th>Sekolah Asal</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody>
<?php
$no=1;
/*foreach ($all_kecamatan as $db) :*/
?>
<tr class="gradeA">
    <td style="text-align: center"><?php echo $no; ?></td>
    <td>100006109/19580714198103200</td>
    <td>SRI SUHARTINI</td>
    <td>SMPN 11 TANGERANG</td>

<td align="center"><a href="<?php echo base_url(); ?>pengguna/ubah/<?php //echo $db['id_syarat']; ?>"><button class="btn-orange btn-sm" title="ubah"><i class="fa fa-edit"></i>Her Registrasi</button></td></tr>
<?php
$no++;
    /*endforeach;*/
?>
<tr>
  <td style="text-align: center"><?php echo $no; ?></td>
  <td>100010487/19580821199003100</td>
  <td>TATANG SUPRIATNA</td>
  <td>SMPN 1 TANGERANG</td>
<td align="center"><a href="<?php echo base_url(); ?>pengguna/ubah/<?php //echo $db['id_syarat']; ?>"><button class="btn-orange btn-sm" title="ubah"><i class="fa fa-edit"></i>Her Registrasi</button></td>
</tr>
</tbody>
</table>
</div>
                          <!-- end lokal ekonomi -->

                        </div>


</div>
</div>
</div>

</div> <!-- container -->
</div> <!--wrap -->
</div> <!-- page-content -->
