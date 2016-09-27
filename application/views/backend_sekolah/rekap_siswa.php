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
            <br/>

            <!-- top tiles -->
            <div class="row tile_count">
              <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                <div class="left"></div>
                <div class="right">
                  <span class="count_top"><center><i class="fa fa-3x fa-users"></i><font size="5"><br> Total Kuota Pelamar</font></span>
                  <div class="count"><font size="5" color="magenta"><b><?php echo $total_kuota; ?></b></font></div>
                  <span class="count_bottom"><i class="green"><font color="magenta">Pelamar</font></i></span>
									</center>
                </div>
              </div>
              <!--div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                <div class="left"></div>
                <div class="right">
								<center>
                  <span class="count_top"><i class="fa fa-3x fa-clock-o"></i><font size="5"><br> Pelamar</font></span>
                  <div class="count"><font size="5" color="blue"><b><?php echo $total_pelamar; ?></b></font></div>
                  <span class="count_bottom"><i class="green"><font color="blue">Pelamar</font></i></span>
								 </center>
                </div>
              </div-->
              <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                <div class="left"></div>
                <div class="right">
								<center>
                  <span class="count_top"><i class="fa fa-3x fa-male"></i><font size="5"><br> Pelamar Laki-laki</font></span>
                  <div class="count green"><font size="5" color="orange"><b><?php echo $total_siswa; ?></b></font></div>
                  <span class="count_bottom"><i class="green"><font color="orange">Siswa</font></i></span>
								</center>
                </div>
              </div>
              <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                <div class="left"></div>
                <div class="right">
                <center>
								  <span class="count_top"><i class="fa fa-3x fa-female"></i><font size="5"><br> Pelamar Perempuan</font></span>
                  <div class="count"><font size="5" color="purple"><b><?php echo $total_siswi; ?></b></font></div>
                <span class="count_bottom"><i class="green"><font color="purple">Siswi</font></i></span>
                </center>
                </div>
              </div>
              <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                <div class="left"></div>
                <div class="right">
								<center>
                  <span class="count_top"><i class="fa fa-3x fa-trophy"></i><font size="5"><br> Nilai Tertinggi Pelamar</font></span>
                  <div class="count"><font size="5" color="green"><b><?php echo $nem_max; ?></b></font></div>
        				<span class="count_bottom"><i class="green"><font color="green">Point</font></i></span>
                </center>            
                </div>
              </div>
              <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                <div class="left"></div>
                <div class="right">
                <center>
                  <span class="count_top"><i class="fa fa-3x fa-hourglass-half"></i><font size="5"><br> Nilai Rata² Pelamar</font></span>
                  <div class="count"><font size="5" color="blue"><b><?php echo $nem_avg; ?></b></font></div>
                <span class="count_bottom"><i class="blue"><font color="blue">Point</font></i></span>
                </center>            
                </div>
              </div>
              <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                <div class="left"></div>
                <div class="right">
								 <center>
                  <span class="count_top"><i class="fa fa-3x fa-level-down"></i><font size="5"><br> Nilai Terendah Pelamar</font></span>
                  <div class="count"><font size="5" color="red"><b><?php echo $nem_min; ?></b></font></div>
        				<span class="count_bottom"><i class="green"><font color="red">Point</font></i></span>
								</center>
                </div>
              </div>
            </div>
            <!-- /top tiles -->

          </div>
        </div>
      </div>
			<hr />


        <div class="col-md-12">
          <div class="panel panel-indigo">



      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Rekap Peringkat Siswa</h2>
              <div class="clearfix"></div>
            </div>
            <div class="panel-body collapse in">
              <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
  						<thead>
                <tr>
                  <th>Peringkat</th>
                  <th>Nomor Induk Siswa Nasional (NISN)</th>
                  <th>Nama</th>
                  <th>Tgl Lahir</th>
                  <?php if(is_admin() || is_operator_disdik() || is_eksekutif()){ ?>
                    <th>Sekolah Tujuan</th>
                  <?php } ?>
                  <th>Nilai</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no=1;
                foreach ($list_pelamar as $db) :
                ?>
                <tr class="gradeA">
                    <td style="text-align: center"><?php echo $no; ?></td>
                    <td><?php echo $db['nisn']; ?></td>
                    <td><?php echo $db['nm_siswa']; ?></td>
                  	<td><?php echo $db['tgl_lahir_siswa']; ?></td>
                    <?php if(is_admin() || is_operator_disdik() || is_eksekutif()){ ?>
                      <td><?php echo $db['nm_sekolah']; ?></td>
                    <?php } ?>
                    <td align="center"><?php echo $db['nem']; ?></td>
                </tr>
                <?php
                $no++;
                    endforeach;
                ?>

                </tbody>
              </table>
						<p align="right"><a href="<?php echo base_url(); ?>sekolah_rekap/cetak_rekap/"><button class="btn-orange btn-sm" title="ubah"><i class="fa fa-3x fa-edit"></i>Cetak Daftar Siswa Lulus</button>
            </div>
          </div>
        </div>
      </div>


			</div>
			</div>
    </div> <!-- container -->
  </div> <!--wrap -->
</div> <!-- page-content -->
