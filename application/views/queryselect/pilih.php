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
                    <form class="well form-horizontal" action="<?php echo base_url(); ?>queryselect/get_params" method="post"  id="report_form">
                        <div class="form-group">
                            <label for="fakjur">Jurusan</label>
                            <select id="js-fakjur" multiple="multiple" class="form-control">
                            </select>
                        </div>
                        <br/>
                        <div class="form-group">
                            <label for="diklat">Diklat</label>
                            <select id="js-diklat" multiple="multiple" class="form-control">
                            </select>
                        </div>
                        <br/>
                        <div class="form-group">
                            <label for="sertifikasi">Sertifikasi</label>
                            <select id="js-sertifikasi" multiple="multiple" class="form-control">
                            </select>
                        </div>
                        <br/>
                        <button  type="button" id="btn_coba" onclick=getValue();>Tekan Saya</button>
                        <br/>
                        <!-- Button -->
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
        var list_2 = [{
            id: "1",
            text: "TEKNIK",
            children: [{
                id: "4",
                text: "Teknik Mesin"
            }, {
                id: "5",
                text: "Teknik Sipil"
            }]
        }, {
            id: "2",
            text: "KEDOKTERAN",
            children: [{
                id: "6",
                text: "Kedokteran Umum"
            }]
        }, {
            id: "3",
            text: "KOMPUTER",
            children: [{
                id: "2",
                text: "Teknik Informatika"
            }, {
                id: "3",
                text: "Teknik Komputer"
            }]
        }, {
            id: "4",
            text: "EKONOMI"
        }, {
            id: "5",
            text: "IPA",
            children: [{
                id: "7",
                text: "IPA"
            }]
        }, {
            id: "6",
            text: "IPS",
            children: [{
                id: "8",
                text: "IPS"
            }]
        }];

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

        var JSON_str = '[{"id":"1","text":"TEKNIK","children":[{"id":"4","text":"Teknik Mesin"},{"id":"5","text":"Teknik Sipil"}]},{"id":"2","text":"KEDOKTERAN","children":[{"id":"6","text":"Kedokteran Umum"}]},{"id":"3","text":"KOMPUTER","children":[{"id":"2","text":"Teknik Informatika"},{"id":"3","text":"Teknik Komputer"}]},{"id":"4","text":"EKONOMI"},{"id":"5","text":"IPA","children":[{"id":"7","text":"IPA"}]},{"id":"6","text":"IPS","children":[{"id":"8","text":"IPS"}]}]';

    });

    function getValue() {
        alert("Selected value is: " + $("#js-fakjur").select2("val"));
    }
</script>