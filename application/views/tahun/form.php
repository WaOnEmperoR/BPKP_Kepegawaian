<div id="page-content">
<div id='wrap'>
<div id="page-heading">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>home">Dashboard</a></li>
        <li><?php echo $breadcumb; ?></li>
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
<form id="form" enctype="multipart/form-data" action="<?php echo base_url(); ?>tahun/simpan" method="post" class="form-horizontal row-border">

<div class="form-group">
    <label class="col-sm-3 control-label">Periode</label>
    <div class="col-sm-6">
        <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>">
        <input type="text" class="form-control" name="periode" value="<?php echo $periode; ?>" autofocus="true">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Sekolah</label>
    <div class="col-sm-6">
        <select name="sekolah" id="sekolah" class="form-control" style="width: 200px;" required>
            <?php
            if(empty($sekolah)){
                ?>
                <option value="">Pilih Sekolah</option>
            <?php
            }
            foreach($l_sekolah->result() as $t){
                if($sekolah==$t->id_sekolah){
                    ?>
                    <option value="<?php echo $t->id_sekolah;?>" selected="selected"><?php echo $t->nm_sekolah?></option>
                <?php }else{ ?>
                    <option value="<?php echo $t->id_sekolah;?>"><?php echo $t->nm_sekolah;?></option>
                <?php }
            } ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Tahun</label>
    <div class="col-sm-6">
        <input type="text" class="form-control numeric" name="tahun" value="<?php echo $tahun; ?>" autofocus="true">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Semester</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="semester" value="<?php echo $semester; ?>" autofocus="true">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Tanggal Mulai</label>
    <div class="col-sm-6">
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input class="form-control pull-right datepicker" type="text" name="tgl_mulai" value="<?php echo $tgl_mulai; ?>">
        </div>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">Tanggal Berakhir</label>
    <div class="col-sm-6">
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input class="form-control pull-right datepicker" type="text" name="tgl_akhir" value="<?php echo $tgl_akhir; ?>">
        </div>
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