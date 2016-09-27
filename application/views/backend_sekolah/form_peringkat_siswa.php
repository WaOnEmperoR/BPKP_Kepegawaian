<div id="page-content">
<div id='wrap'>

<div id="page-heading">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>home">Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>sekolah_peringkat"><?php echo $breadcumb; ?></a></li>
        <li class="active"><?php echo $judul_halaman; ?></li>
    </ol>

    <h1><?php echo $judul_halaman; ?></h1>
</div>

<div class="container">

<div class="panel panel-midnightblue">
    <div class="panel-heading">
        <h4>Form - <?php echo $judul_halaman; ?></h4>
    </div>
<div class="panel-body collapse in">
<form id="form" enctype="multipart/form-data" action="<?php echo base_url(); ?>sekolah_peringkat/simpan" method="post" class="form-horizontal row-border">

<div class="form-group">
    <label class="col-sm-3 control-label">No Registrasi</label>
    <div class="col-sm-6">
        <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>">
        <span><?php echo $no_registrasi; ?></span>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">Nama</label>
    <div class="col-sm-6">
        <span><?php echo $nm_siswa; ?></span>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">Jenis Kelamin</label>
    <div class="col-sm-6">
        <span><?php echo $jk_siswa; ?></span>
    </div>
</div>
    
<div class="form-group">
    <label class="col-sm-3 control-label">Tempat Lahir</label>
    <div class="col-sm-6">
        <span><?php echo $tmp_lahir_siswa; ?></span>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">Tanggal Lahir</label>
    <div class="col-sm-6">
        <span><?php echo $tgl_lahir_siswa; ?></span>
    </div>
</div>
    
<div class="form-group">
    <label class="col-sm-3 control-label">Alamat</label>
    <div class="col-sm-6">
        <span><?php echo $almt_siswa; ?></span>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">Agama</label>
    <div class="col-sm-6">
        <span><?php echo $agama_siswa; ?></span>
    </div>
</div>
    
<div class="form-group">
    <label class="col-sm-3 control-label">Pilihan Sekolah</label>
    <div class="col-sm-6">
        <span><?php echo $sekolah; ?></span>
    </div>
</div>    

<div class="form-group">
    <label class="col-sm-3 control-label">Status</label>
    <div class="col-sm-6">
        <input type="radio" name="stat_lulus" value="1" <?php if($stat_lulus==1) { ?> checked="checked" <?php } ?> /> Lulus <br>
        <input type="radio" name="stat_lulus" value="2" <?php if($stat_lulus==2) { ?> checked="checked" <?php } ?> /> Tidak Lulus <br>
        <input type="radio" name="stat_lulus" value="3" <?php if($stat_lulus==3) { ?> checked="checked" <?php } ?> /> Cadangan <br>
        <input type="radio" name="stat_lulus" value="0" <?php if($stat_lulus==0) { ?> checked="checked" <?php } ?> /> Belum diverifikasi
    </div>
</div>
    
<div class="panel-footer">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="btn-toolbar">
                <button class="btn-primary btn" id="simpan">Simpan</button>
                <button class="btn-default btn" onclick=self.history.back()>Kembali</button>
            </div>
        </div>
    </div>
</div>

</form>
</div>

</div>

</div> <!-- container -->
</div> <!--wrap -->
</div> <!-- page-content -->
