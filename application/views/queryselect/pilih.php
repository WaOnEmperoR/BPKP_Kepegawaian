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
                    <div>
                        <select id="js-basic-multiple" multiple="multiple" class="form-control">
                        <?php
                            foreach ($list_fakjur as $key => $value)
                            {
                                echo("<optgroup label = '$key'>");
                                foreach ($value as $subval)
                                {
                                    echo("<option value='$subval'>$subval</option>");
                                }
                                echo("</optgroup>");
                            }
                            ?>
                        </select>
                    </div>
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

        $("#js-basic-multiple").select2({});

    });
</script>