<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">

<div id="page-content">
  <div id='wrap'>
    <div id="page-heading">
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>home">Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>sekolah_verifikasi"><?php echo $breadcumb; ?></a></li>
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

            <div class="x_panel">
              <div class="x_title">
               <br>
               <h2>Proses Verifikasi Siswa </h2>
               <div class="clearfix"></div>
             </div>
             <div class="x_content">


              <!-- Smart Wizard -->
              <!-- <p>This is a basic form wizard example that inherits the colors from the selected scheme.</p> -->
              <div id="wizard" class="form_wizard wizard_horizontal">
                <ul class="wizard_steps">
                  <li>
                    <a href="#step-1">
                      <span class="step_no">1</span>
                      <span class="step_descr">
                        Langkah 1<br />
                        <small>Biodata Siswa</small>
                      </span>
                    </a>
                  </li>
                  <li>
                    <a href="#step-2">
                      <span class="step_no">2</span>
                      <span class="step_descr">
                        Langkah 2<br />
                        <small>Data Nilai</small>
                      </span>
                    </a>
                  </li>
                  <li>
                    <a href="#step-3">
                      <span class="step_no">3</span>
                      <span class="step_descr">
                        Langkah 3<br />
                        <small>Verifikasi Berkas</small>
                      </span>
                    </a>
                  </li>
                </ul>

                <div id="step-1">
                  <h2 class="StepTitle">Biodata Siswa</h2>

                  <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama lengkap</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" readonly="readonly" disabled="disabled" value="<?php echo $data_siswa["nm_siswa"]; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Kelamin</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" readonly="readonly" disabled="disabled" value="<?php echo get_jenis_kelamin($data_siswa["jk"]); ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nomor Registrasi </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" readonly="readonly" disabled="disabled" value="<?php echo $data_siswa["no_registrasi"]; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">NISN</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" readonly="readonly" disabled="disabled" value="<?php echo $data_siswa["nisn"]; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat Siswa</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <textarea class="form-control" rows="4" readonly="readonly" disabled="disabled" value="<?php echo $data_siswa["almt_siswa"]; ?>"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">No Telp</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" readonly="readonly" disabled="disabled" value="<?php echo $data_siswa["telp_siswa"]; ?>">
                        </div>
                      </div>

                    </form>        
                  </div>
                </div>
                <div id="step-2">
                  <h2 class="StepTitle">Data Nilai Siswa</h2>

                  <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">NEM</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" readonly="readonly" disabled="disabled" value="<?php echo $data_siswa["nem"]; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nilai Bhs. Indonesia</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" readonly="readonly" disabled="disabled" value="<?php echo $data_siswa["nilai_bhs"]; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nilai Bhs. Inggris</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" readonly="readonly" disabled="disabled" value="<?php echo $data_siswa["nilai_eng"]; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nilai Matematika</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" readonly="readonly" disabled="disabled" value="<?php echo $data_siswa["nilai_mtk"]; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nilai IPA</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" readonly="readonly" disabled="disabled" value="<?php echo $data_siswa["nilai_ipa"]; ?>">
                        </div>
                      </div>
                    </form>        
                  </div>
                </div>
                <div id="step-3">
                  <h2 class="StepTitle">Data Peryaratan Siswa</h2>
                  <div class="x_content">
                    <form id="data" class="form-horizontal form-label-left" action="<?php echo base_url(); ?>sekolah_verifikasi/simpan" method="post">
                      <input type="hidden" value="<?php echo $data_siswa['id_registrasi'] ?>" name="id"/>
                      <table class="table table-striped responsive-utilities jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th>
                            <th class="column-title">Persyaratan </th>
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;"> <span class="action-cnt"> </span>  <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($lampiran_berkas as $key => $db) { ?>
                          <tr class="<?php echo get_even_odd($key); ?> pointer">
                            <td class="a-center "  align="center">
                              <input type="checkbox" class="flat" name="status_berkas[<?php echo $key; ?>]" value="2" <?php if($db['stat_berkas'] == 2) { ?>checked<?php } ?>>
                            </td>
                            <td class=" "><?php echo $db['nm_lampiran'] ?></td>
                            <td class=" last" align="center">
                              <?php if(!empty($db['file_lampiran'])){ ?>
                                <a href="<?php echo base_url("upload/".$data_siswa['no_registrasi'].'/'.rawurlencode($db['file_lampiran'])); ?>" target="_blank">Lihat</a>
                              <?php }else{ ?>
                                Tidak ada data
                              <?php } ?>
                              <input type="hidden" name="id_berkas[<?php echo $key; ?>]" value="<?php echo $db['id_berkas']; ?>">
                            </td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>

                      <div class="panel-footer">
                        <div id="keterangan" class="row" <?php if(empty($verified_status)){ ?>style="display:none;"<?php } ?>>
                          <div class="col-sm-12">
                            <div class="btn-toolbar">
                              <textarea name="keterangan"><?php echo $keterangan; ?></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6 col-sm-offset-3">
                            <div class="btn-toolbar">
                              <a href="#" class="btn-danger btn" id="tolak_btn">Tolak</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="panel-footer">
                        <div class="row">
                          <div class="col-sm-6 col-sm-offset-3">
                            <div class="btn-toolbar">
                              <input id="status_tolak" type="hidden" name="status_tolak" value="0"/>
                            </div>
                          </div>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>

              </div>
            </div>                    
            <!-- End SmartWizard Content -->

          </div>
        </div>
      </div>

    </div> <!-- container -->
  </div> <!--wrap -->
</div> <!-- page-content -->
<link href="<?php echo base_url(); ?>assets/css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/icheck/flat/green.css" rel="stylesheet">

<!-- bootstrap progress js -->
<script src="<?php echo base_url(); ?>assets/js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/nicescroll/jquery.nicescroll.min.js"></script> 
<!-- icheck -->
<script src="<?php echo base_url(); ?>assets/js/icheck/icheck.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
<!-- form wizard -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/wizard/jquery.smartWizard.js"></script>
<!-- pace -->
<script src="<?php echo base_url(); ?>assets/js/pace/pace.min.js"></script>
<script type="text/javascript">
  function verifikasiBerkas() {
    //$('#wizard').smartWizard('showMessage', 'Finish Clicked');
    var r = confirm("Yakin data verifikasi akan disimpan?");
    if (r == true) {
        $("#data").submit();
    } else {
        x = "You pressed Cancel!";
    } 
  }

  $(document).ready(function() {
      // Smart Wizard
      $('#wizard').smartWizard({
        labelNext:'Berikut', // label for Next button
        labelPrevious:'Sebelum', // label for Previous button
        labelFinish:'Simpan',  // label for Finish button        
        noForwardJumping:true,
        onFinish: verifikasiBerkas
      });

      $("#tolak_btn").click(function(){
        if($("#status_tolak").val() == "0"){
          $("#keterangan").show();
          $("#status_tolak").val("1");
        }else{
          $("#keterangan").hide();
          $("#status_tolak").val("0");
        }
      });
    });

  $(document).ready(function() {
      // Smart Wizard
      $('#wizard_verticle').smartWizard({
        transitionEffect: 'slide'
      });

    });
  </script>
