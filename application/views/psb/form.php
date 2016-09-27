<div id="page-content">
<div id='wrap'>

<div id="page-heading">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>home">Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>psb"><?php echo $breadcumb; ?></a></li>
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
<form id="form" enctype="multipart/form-data" action="<?php echo base_url(); ?>psb/simpan" method="post" class="form-horizontal row-border">

<div class="form-group">
    <label class="col-sm-3 control-label">Nama PSB</label>
    <div class="col-sm-6">
        <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>">
        <input type="text" class="form-control" name="nm_psb" value="<?php echo $nm_psb; ?>" autofocus="true">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">Info PSB</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="info_psb" value="<?php echo $info_psb; ?>" autofocus="true">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">Tanggal Mulai</label>
    <div class="col-sm-6">
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input class="form-control pull-right datepicker" type="text" name="tgl_awal_psb" value="<?php echo $tgl_awal_psb; ?>">
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
            <input class="form-control pull-right datepicker" type="text" name="tgl_akhir_psb" value="<?php echo $tgl_akhir_psb; ?>">
        </div>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">Kuota Reguler Dalam Kota</label>
    <div class="col-sm-6">
        <input type="text" class="form-control numeric" name="kuota_psb_reguler" value="<?php echo $kuota_psb_reguler; ?>" autofocus="true">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">Kuota Lokal</label>
    <div class="col-sm-6">
        <input type="text" class="form-control numeric" name="kuota_psb_lokal" value="<?php echo $kuota_psb_lokal; ?>" autofocus="true">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">Kuota Reguler Luar Kota</label>
    <div class="col-sm-6">
        <input type="text" class="form-control numeric" name="kuota_psb_luar" value="<?php echo $kuota_psb_luar; ?>" autofocus="true">
    </div>
</div>

<div class="form-group">
        <label class="col-sm-3 control-label">Status</label>
        <div class="col-sm-6">
            <div class="onoffswitch">
                <input value="1" type="checkbox" name="stat_psb" class="onoffswitch-checkbox" id="stat_psb" <?php if($stat_psb!=2) { ?> checked<?php } ?>>
                <label class="onoffswitch-label" for="stat_psb"></label>
            </div>
        </div>
    </div>

<div class="form-group">
    <label class="col-sm-3 control-label">Sekolah</label>
    <div class="col-sm-6">
        <select name="id_sekolah" id="sekolah" class="form-control" style="width: 200px;" required>
            <?php
            if(empty($dinas)){
                ?>
                <option value="">Pilih Sekolah</option>
            <?php
            }
            foreach($l_sekolah->result() as $t){
                if($id_sekolah==$t->id_sekolah){
                    ?>
                    <option value="<?php echo $t->id_sekolah;?>" selected="selected"><?php echo $t->nm_sekolah;?></option>
                <?php }else{ ?>
                    <option value="<?php echo $t->id_sekolah;?>"><?php echo $t->nm_sekolah;?></option>
                <?php }
            } ?>
        </select>
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