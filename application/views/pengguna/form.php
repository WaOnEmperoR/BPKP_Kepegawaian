<div id="page-content">
<div id='wrap'>
<div id="page-heading">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>home">Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>pengguna"><?php echo $breadcumb; ?></a></li>
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
<form action="<?php echo base_url(); ?>pengguna/simpan" method="post" class="form-horizontal row-border">

<div class="form-group">
    <label class="col-sm-3 control-label">Username</label>
    <div class="col-sm-6">
        <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>">
        <input type="text" class="form-control" name="nama" value="<?php echo $nama; ?>" autofocus="true">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Password</label>
    <div class="col-sm-6">
        <input type="password" class="form-control" name="password" value="" autofocus="true" <?php if(empty($id)){ ?>required<?php } ?>>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Pegawai</label>
    <div class="col-sm-6">
        <select name="pegawai" id="pegawai" class="form-control" style="width: 200px;" required>
            <?php
            if(empty($pegawai)){
                ?>
                <option value="">Pilih Pegawai</option>
            <?php
            }
            foreach($l_pegawai->result() as $t){
                if($pegawai==$t->id_pegawai){
                    ?>
                    <option value="<?php echo $t->id_pegawai;?>" selected="selected"><?php echo $t->nm_pegawai.' - '.$t->kantor;?></option>
                <?php }else{ ?>
                    <option value="<?php echo $t->id_pegawai;?>"><?php echo $t->nm_pegawai.' - '.$t->kantor;?></option>
                <?php }
            } ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Email</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="email" value="<?php echo $email; ?>" autofocus="true">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Level</label>
    <div class="col-sm-3">
        <input type="radio" name="level" value="1" <?php if($level==1) { ?> checked="checked" <?php } ?> /> Administrator <br/>
        <input type="radio" name="level" value="2" <?php if($level==2) { ?> checked="checked" <?php } ?> /> Operator Dinas <br/>
        <input type="radio" name="level" value="3" <?php if($level==3) { ?> checked="checked" <?php } ?> /> Operator Sekolah
        
    </div>
    <div class="col-sm-3">
        <input type="radio" name="level" value="5" <?php if($level==5) { ?> checked="checked" <?php } ?> /> Eksekutif <br/>
        <input type="radio" name="level" value="6" <?php if($level==6) { ?> checked="checked" <?php } ?> /> Kepala Sekolah <br/>
        <input type="radio" name="level" value="7" <?php if($level==7) { ?> checked="checked" <?php } ?> /> Operator Nilai UN
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Status</label>
    <div class="col-sm-6">
        <div class="onoffswitch">
            <input value="1" type="checkbox" name="status" class="onoffswitch-checkbox" id="status" <?php if($status!=2) { ?> checked<?php } ?>>
            <label class="onoffswitch-label" for="status"></label>
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


