<div id="page-content">
   <div id='wrap'>
      <div id="page-heading">
         <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>home">Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>pegawai"><?php echo $breadcumb; ?></a></li>
            <li class="active"><?php echo $judul_halaman; ?></li>
         </ol>
         <h1><?php echo $judul_halaman; ?></h1>
      </div>
      <div class="container">
         <div class="panel panel-indigo">
            <div class="panel-heading">
               <h4>Form - <?php echo $judul_halaman; ?></h4>
            </div>
            <div class="panel-body collapse in">
               <div> 
               <select id="js-basic-multiple" multiple="multiple" class="form-control">
                <option value="AL">Alabama</option>
                <option value="WY">Wyoming</option>
                <option value="WY">Oregon</option>
                <option value="WY">Idaho</option>
                <option value="WY">Wyoming</option>
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
$("#js-basic-multiple").select2();
</script>

