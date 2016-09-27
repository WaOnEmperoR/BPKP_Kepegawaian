<div id="page-content">
<div id='wrap'>
<div id="page-heading">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>home">Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>jenjang"><?php echo $breadcumb; ?></a></li>
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
<form action="<?php echo base_url(); ?>jenjang/simpan" method="post" class="form-horizontal row-border">

<div class="form-group">
    <label class="col-sm-3 control-label">Nama Jenjang *</label>
    <div class="col-sm-6">
        <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>">
        <input type="text" class="form-control" name="nama" value="<?php echo $nama; ?>" autofocus="true">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Deskripsi Jenjang *</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="deskripsi" value="<?php echo $deskripsi; ?>" autofocus="true">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Kejuruan</label>
    <div class="col-sm-6">
        <div class="onoffswitch">
            <input value="1" type="checkbox" name="kejuruan" class="onoffswitch-checkbox" id="kejuruan" <?php if($kejuruan!=2) { ?> checked<?php } ?>>
            <label class="onoffswitch-label" for="kejuruan"></label>
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


