<div id="page-content">
<div id='wrap'>
<div id="page-heading">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>home">Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>syarat"><?php echo $breadcumb; ?></a></li>
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
<form action="<?php echo base_url(); ?>syarat/simpan" method="post" class="form-horizontal row-border">
<div class="form-group">
    <label class="col-sm-3 control-label">Kode Lampiran *</label>
    <div class="col-sm-6">
        <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>">
        <input type="text" class="form-control" name="kode" value="<?php echo $kode; ?>" autofocus="true">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Nama Lampiran *</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="nama" value="<?php echo $nama; ?>" autofocus="true">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Ukuran Maksimal File (KB) *</label>
    <div class="col-sm-6">
        <input type="text" class="form-control numeric" name="ukuran" value="<?php echo $ukuran; ?>" autofocus="true">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Ekstensi File *</label>
    <div class="col-sm-6">
        <select name="jenis[]" id="jenis" class="js-example-basic-multiple" multiple="multiple" style="width: 200px;" required>
            <?php
            if(!empty($l_jenislampiran)){
                foreach($l_jenislampiran->result() as $t){
                    if(!empty($l_jenis)){
                        $is_found = false;
                        foreach($l_jenis->result() as $l){
                            if($l->id_jenis_lampiran==$t->id_jenis_lampiran){
                                ?>
                                <option value="<?php echo $t->id_jenis_lampiran;?>" selected="selected"><?php echo $t->jenis_lampiran;?></option>
                            <?php $is_found = true; }
                        }
                        if(!$is_found){ ?>
                            <option value="<?php echo $t->id_jenis_lampiran;?>"><?php echo $t->jenis_lampiran;?></option>
                        <?php }
                    }else{ ?>
                        <option value="<?php echo $t->id_jenis_lampiran;?>"><?php echo $t->jenis_lampiran;?></option>
                        <?php
                    }
                }
            }
             ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Jalur Seleksi *</label>
    <div class="col-sm-6">
        <select name="jalur[]" id="jalur" class="js-example-basic-multiple" multiple="multiple" style="width: 200px;" required>
            <?php
            if(!empty($l_jalur)){
                foreach($l_jalur->result() as $t){
                    if(!empty($l_jalurlampiran)){
                        $is_found = false;
                        foreach($l_jalurlampiran->result() as $l){
                            if($l->id_jalur==$t->id_jalur){
                                ?>
                                <option value="<?php echo $t->id_jalur;?>" selected="selected"><?php echo $t->nm_jalur;?></option>
                            <?php $is_found = true; }
                        }
                        if(!$is_found){ ?>
                            <option value="<?php echo $t->id_jalur;?>"><?php echo $t->nm_jalur;?></option>
                        <?php }
                    }else{ ?>
                        <option value="<?php echo $t->id_jalur;?>"><?php echo $t->nm_jalur;?></option>
                        <?php
                    }
                }
            }
             ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Wajib</label>
    <div class="col-sm-6">
        <input type="radio" name="wajib" value="1" <?php if($wajib==1) { ?> checked="checked" <?php } ?> /> Iya <br>
        <input type="radio" name="wajib" value="2" <?php if($wajib==2) { ?> checked="checked" <?php } ?> /> Tidak
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

<script type="text/javascript">
$(".js-example-basic-multiple").select2();
</script>

