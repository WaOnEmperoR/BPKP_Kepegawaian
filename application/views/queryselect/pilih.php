<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>home">Dashboard</a></li>
                <li>
                    <a href="<?php echo base_url(); ?>pegawai">
                    <?php echo $breadcumb; ?>
                    </a>
                </li>
                <li class="active">
                    <?php echo $judul_halaman; ?>
                </li>
            </ol>
            <h1>
                <?php echo $judul_halaman; ?>
            </h1>
        </div>
        <div class="container">
            <div class="panel panel-indigo">
                <div class="panel-heading">
                    <h4>Form -
                        <?php echo $judul_halaman; ?>
                    </h4>
                </div>
                <div class="panel-body collapse in">
                    <form id="form_pilih" class="well form-horizontal" action="<?php echo base_url(); ?>queryselect/get_params" method="post"  id="report_form">
                        <div class="form-group">
                            <label for="fakjur">Jurusan</label>
                            <select id="js-fakjur" multiple="multiple" class="form-control">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="diklat">Diklat</label>
                            <select id="js-diklat" multiple="multiple" class="form-control">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sertifikasi">Sertifikasi</label>
                            <select id="js-sertifikasi" multiple="multiple" class="form-control">
                            </select>
                        </div>
                        <br/>
                        <br/>
                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-warning" >CARI PEGAWAI <span class="glyphicon glyphicon-send"></span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- container -->
    </div>
    <!--wrap -->
</div>
<!-- page-content -->
<script type="text/javascript">
    $(document).on("ready", function() {
        var url = '<?php echo (base_url());?>queryselect/getJSONFakjur';
        $.get(url, function(data) {
            var parsed = JSON.parse(data);
            $("#js-fakjur").select2({
                data: parsed
            });
        });

        var url = '<?php echo (base_url());?>queryselect/getJSONDiklat';
        $.get(url, function(data) {
            var parsed = JSON.parse(data);
            $("#js-diklat").select2({
                data: parsed
            });
        });

        var url = '<?php echo (base_url());?>queryselect/getJSONSertifikasi';
        $.get(url, function(data) {
            var parsed = JSON.parse(data);
            $("#js-sertifikasi").select2({
                data: parsed
            });
        });

    });

    $('#form_pilih').submit(function() {
        getValue();
    });

    function getValue() {
        var panjang_fakjur = $("#js-fakjur").select2("val").length;
        for (i = 0; i < panjang_fakjur; i++) {
            alert($("#js-fakjur").select2("val")[i]);
            var tampil = '<input type="hidden" name="result_fakjur[]" value="' + $("#js-fakjur").select2("val")[i] + '">'
            $("#form_pilih").append(tampil);
        }

        var panjang_diklat = $("#js-diklat").select2("val").length;
        for (i = 0; i < panjang_diklat; i++) {
            alert($("#js-diklat").select2("val")[i]);
            var tampil = '<input type="hidden" name="result_diklat[]" value="' + $("#js-diklat").select2("val")[i] + '">'
            $("#form_pilih").append(tampil);
        }

        var panjang_sertifikat = $("#js-sertifikasi").select2("val").length;
        for (i = 0; i < panjang_sertifikat; i++) {
            alert($("#js-sertifikasi").select2("val")[i]);
            var tampil = '<input type="hidden" name="result_sertifikat[]" value="' + $("#js-sertifikasi").select2("val")[i] + '">'
            $("#form_pilih").append(tampil);
        }
    }
</script>