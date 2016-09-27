<div id="page-content">
<div id='wrap'>
<div id="page-heading">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>home">Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>dinas"><?php echo $breadcumb; ?></a></li>
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
<form id="form" enctype="multipart/form-data" action="<?php echo base_url(); ?>dinas/simpan" method="post" class="form-horizontal row-border">
<div class="form-group">
    <label class="col-sm-3 control-label">Nama Dinas Pendidikan </label>
    <div class="col-sm-6">
        <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>">
        <input type="text" class="form-control" name="nama" value="<?php echo $nama; ?>" autofocus="true">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Alamat Dinas </label>
    <div class="col-sm-6">
        <input type="textarea" class="form-control" name="alamat" value="<?php echo $alamat; ?>" autofocus="true">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label"></label>
    <div class="col-sm-3">
        <select name="prov" id="prov" class="form-control" style="width: 200px;" required>
            <?php
            if(empty($prov)){
                ?>
                <option value="">Pilih Provinsi</option>
            <?php
            }
            if(!empty($l_provinsi)){
                foreach($l_provinsi->result() as $t){
                    if($prov==$t->no_prov){
                        ?>
                        <option value="<?php echo $t->no_prov;?>" selected><?php echo $t->nm_prov;?></option>
                    <?php }else{ ?>
                        <option value="<?php echo $t->no_prov;?>"><?php echo $t->nm_prov;?></option>
                    <?php }
                }
            }
             ?>
        </select>
    </div>
    <div class="col-sm-3">
        <select name="kab" id="kab" class="form-control" style="width: 200px;" required>
            <?php
            if(empty($kab)){
                ?>
                <option value="">Pilih Kabupaten</option>
            <?php
            }
            if(!empty($l_kabupaten)){
                foreach($l_kabupaten->result() as $t){
                if($kab==$t->id_kab){
                    ?>
                    <option value="<?php echo $t->id_kab;?>" selected><?php echo $t->nm_kab;?></option>
                <?php }else{ ?>
                    <option value="<?php echo $t->id_kab;?>"><?php echo $t->nm_kab;?></option>
                <?php }
            }
            }
             ?>
        </select>
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

<div class="form-group">
    <label class="col-sm-3 control-label">Logo</label>
    <div class="col-sm-9">
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
            <div>
                <span class="btn btn-default btn-file"><span class="fileinput-new">Pilih Logo</span><span class="fileinput-exists">Change</span>
                    <input type="file" name="logo"></span>
                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
            </div>
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
    $(document).ready(function(){
        $("#prov").change(function(){
            $("#kab").html("");
            $.getJSON("<?php echo base_url(); ?>dinas/get_kab?id="+$(this).val(), function(data) {
                $.each(data, function(){
                    $("#kab").append('<option value="'+ this.id_kab +'">'+ this.nm_kab +'</option>')
                });
            });
        });
    });
</script>

