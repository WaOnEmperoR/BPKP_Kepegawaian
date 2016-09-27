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
                <li role="presentation" class="active">
                  <a href="#tab_reguler" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Regular Dalam Tangsel</a>
                </li>
                <li role="presentation" class="">
                  <a href="#tab_luar" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Regular Luar Tangsel</a>
                </li>
                <li role="presentation" class="">
                  <a href="#tab_lokal_alamat" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Lokal Alamat</a>
                </li>
                <li role="presentation" class="">
                  <a href="#tab_lokal_prestasi" role="tab" id="profile-tab3" data-toggle="tab" aria-expanded="false">Lokal Prestasi</a>
                </li><li role="presentation" class="">
                  <a href="#tab_lokal_ekonomi" role="tab" id="profile-tab4" data-toggle="tab" aria-expanded="false">Lokal Ekonomi</a>
              </li>
            </ul>
            <div id="myTabContent" class="tab-content">
              <div role="tabpanel" class="tab-pane fade active in" id="tab_reguler" aria-labelledby="home-tab">
                <!-- start reguler dalam tangsel -->
                <div class="panel-body collapse in">
                  <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nomor Induk Siswa Nasional (NISN)</th>
                        <th>Nama</th>
                        <th>Tanggal Lahir</th>
                        <?php if(is_admin() || is_operator_disdik() || is_eksekutif()){ ?>
                          <th>Sekolah Tujuan</th>
                        <?php } ?>
                        <th>Status Lulus</th>
                        <th>Status Verifikasi</th>
                        <?php if(is_admin() || is_operator_sekolah()){ ?>
                          <th>Aksi</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no=1;
                      foreach ($list_pelamar_reguler as $db) :
                      ?>
                      <tr class="gradeA">
                        <td style="text-align: center"><?php echo $no; ?></td>
                        <td><?php echo $db['nisn']; ?></td>
                        <td><?php echo $db['nm_siswa']; ?></td>
                        <td><?php echo $db['tgl_lahir_siswa']; ?></td>
                        <?php if(is_admin() || is_operator_disdik() || is_eksekutif()){ ?>
                          <td><?php echo $db['nm_sekolah']; ?></td>
                        <?php } ?>
                        <td align="center"><?php echo get_status_lulus($db['stat_lulus']); ?></td>
                        <td align="center"><?php echo get_status_verifikasi($db['verified_status']); ?></td>
                        <?php if(is_admin() || is_operator_sekolah()){ ?>
                          <td align="center"><a href="<?php echo base_url(); ?>sekolah_verifikasi/verifikasi/<?php echo $db['id_registrasi']; ?>"><button class="btn-orange btn-sm" title="ubah"><i class="fa fa-edit"></i>Verifikasi</button></td>
                        <?php } ?>
                      </tr>
                      <?php
                      $no++;
                      endforeach;
                      ?>
                    </tbody>
                  </table>
                </div>

                <!-- end reguler dalam tangsel -->

              </div>
              <div role="tabpanel" class="tab-pane fade" id="tab_luar" aria-labelledby="profile-tab">

                <!-- start reguler luar tangsel -->
                <div class="panel-body collapse in">
                  <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nomor Induk Siswa Nasional (NISN)</th>
                        <th>Nama</th>
                        <th>Tanggal Lahir</th>
                        <?php if(is_admin() || is_operator_disdik() || is_eksekutif()){ ?>
                          <th>Sekolah Tujuan</th>
                        <?php } ?>
                        <th>Status Lulus</th>
                        <th>Status Verifikasi</th>
                        <?php if(is_admin() || is_operator_sekolah()){ ?>
                          <th>Aksi</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no=1;
                      foreach ($list_pelamar_luar as $db) :
                      ?>
                      <tr class="gradeA">
                        <td style="text-align: center"><?php echo $no; ?></td>
                        <td><?php echo $db['nisn']; ?></td>
                        <td><?php echo $db['nm_siswa']; ?></td>
                        <td><?php echo $db['tgl_lahir_siswa']; ?></td>
                        <?php if(is_admin() || is_operator_disdik() || is_eksekutif()){ ?>
                          <td><?php echo $db['nm_sekolah']; ?></td>
                        <?php } ?>
                        <td align="center"><?php echo get_status_lulus($db['stat_lulus']); ?></td>
                        <td align="center"><?php echo get_status_verifikasi($db['verified_status']); ?></td>
                        <?php if(is_admin() || is_operator_sekolah()){ ?>
                          <td align="center"><a href="<?php echo base_url(); ?>sekolah_verifikasi/verifikasi/<?php echo $db['id_registrasi']; ?>"><button class="btn-orange btn-sm" title="ubah"><i class="fa fa-edit"></i>Verifikasi</button></td>
                        <?php } ?>
                      </tr>
                      <?php
                      $no++;
                      endforeach;
                      ?>
                    </tbody>
                  </table>
                </div>
                <!-- end reguler luar tangsel -->

              </div>
              <div role="tabpanel" class="tab-pane fade" id="tab_lokal_alamat" aria-labelledby="profile-tab">
                <!-- start lokal alamat tangsel -->
                <div class="panel-body collapse in">
                  <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nomor Induk Siswa Nasional (NISN)</th>
                        <th>Nama</th>
                        <th>Tanggal Lahir</th>
                        <?php if(is_admin() || is_operator_disdik() || is_eksekutif()){ ?>
                          <th>Sekolah Tujuan</th>
                        <?php } ?>
                        <th>Status Lulus</th>
                        <th>Status Verifikasi</th>
                        <?php if(is_admin() || is_operator_sekolah()){ ?>
                          <th>Aksi</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no=1;
                      foreach ($list_pelamar_lokal_alamat as $db) :
                      ?>
                      <tr class="gradeA">
                        <td style="text-align: center"><?php echo $no; ?></td>
                        <td><?php echo $db['nisn']; ?></td>
                        <td><?php echo $db['nm_siswa']; ?></td>
                        <td><?php echo $db['tgl_lahir_siswa']; ?></td>
                        <?php if(is_admin() || is_operator_disdik() || is_eksekutif()){ ?>
                          <td><?php echo $db['nm_sekolah']; ?></td>
                        <?php } ?>
                        <td align="center"><?php echo get_status_lulus($db['stat_lulus']); ?></td>
                        <td align="center"><?php echo get_status_verifikasi($db['verified_status']); ?></td>
                        <?php if(is_admin() || is_operator_sekolah()){ ?>
                          <td align="center"><a href="<?php echo base_url(); ?>sekolah_verifikasi/verifikasi/<?php echo $db['id_registrasi']; ?>"><button class="btn-orange btn-sm" title="ubah"><i class="fa fa-edit"></i>Verifikasi</button></td>
                        <?php } ?>
                      </tr>
                      <?php
                      $no++;
                      endforeach;
                      ?>
                    </tbody>
                  </table>
                </div>
                <!-- end lokal alamat tangsel -->


              </div>

              <div role="tabpanel" class="tab-pane fade" id="tab_lokal_prestasi" aria-labelledby="profile-tab">

                <!-- start lokal prestasi -->
                <div class="panel-body collapse in">
                  <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nomor Induk Siswa Nasional (NISN)</th>
                        <th>Nama</th>
                        <th>Tanggal Lahir</th>
                        <?php if(is_admin() || is_operator_disdik() || is_eksekutif()){ ?>
                          <th>Sekolah Tujuan</th>
                        <?php } ?>
                        <th>Status Lulus</th>
                        <th>Status Verifikasi</th>
                        <?php if(is_admin() || is_operator_sekolah()){ ?>
                          <th>Aksi</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no=1;
                      foreach ($list_pelamar_lokal_prestasi as $db) :
                      ?>
                      <tr class="gradeA">
                        <td style="text-align: center"><?php echo $no; ?></td>
                        <td><?php echo $db['nisn']; ?></td>
                        <td><?php echo $db['nm_siswa']; ?></td>
                        <td><?php echo $db['tgl_lahir_siswa']; ?></td>
                        <?php if(is_admin() || is_operator_disdik() || is_eksekutif()){ ?>
                          <td><?php echo $db['nm_sekolah']; ?></td>
                        <?php } ?>
                        <td align="center"><?php echo get_status_lulus($db['stat_lulus']); ?></td>
                        <td align="center"><?php echo get_status_verifikasi($db['verified_status']); ?></td>
                        <?php if(is_admin() || is_operator_sekolah()){ ?>
                          <td align="center"><a href="<?php echo base_url(); ?>sekolah_verifikasi/verifikasi/<?php echo $db['id_registrasi']; ?>"><button class="btn-orange btn-sm" title="ubah"><i class="fa fa-edit"></i>Verifikasi</button></td>
                        <?php } ?>
                      </tr>
                      <?php
                      $no++;
                      endforeach;
                      ?>
                    </tbody>
                  </table>
                </div>
                <!-- end lokal prestasi -->

              </div>


              <div role="tabpanel" class="tab-pane fade" id="tab_lokal_ekonomi" aria-labelledby="profile-tab">

                <!-- start lokal ekonomi -->
                <div class="panel-body collapse in">
                  <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nomor Induk Siswa Nasional (NISN)</th>
                        <th>Nama</th>
                        <th>Tanggal Lahir</th>
                        <?php if(is_admin() || is_operator_disdik() || is_eksekutif()){ ?>
                          <th>Sekolah Tujuan</th>
                        <?php } ?>
                        <th>Status Lulus</th>
                        <th>Status Verifikasi</th>
                        <?php if(is_admin() || is_operator_sekolah()){ ?>
                          <th>Aksi</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no=1;
                      foreach ($list_pelamar_lokal_ekonomi as $db) :
                      ?>
                      <tr class="gradeA">
                        <td style="text-align: center"><?php echo $no; ?></td>
                        <td><?php echo $db['nisn']; ?></td>
                        <td><?php echo $db['nm_siswa']; ?></td>
                        <td><?php echo $db['tgl_lahir_siswa']; ?></td>
                        <?php if(is_admin() || is_operator_disdik() || is_eksekutif()){ ?>
                          <td><?php echo $db['nm_sekolah']; ?></td>
                        <?php } ?>
                        <td align="center"><?php echo get_status_lulus($db['stat_lulus']); ?></td>
                        <td align="center"><?php echo get_status_verifikasi($db['verified_status']); ?></td>
                        <?php if(is_admin() || is_operator_sekolah()){ ?>
                          <td align="center"><a href="<?php echo base_url(); ?>sekolah_verifikasi/verifikasi/<?php echo $db['id_registrasi']; ?>"><button class="btn-orange btn-sm" title="ubah"><i class="fa fa-edit"></i>Verifikasi</button></td>
                        <?php } ?>
                      </tr>
                      <?php
                      $no++;
                      endforeach;
                      ?>
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
