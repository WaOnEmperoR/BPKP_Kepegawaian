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
               <div id="builder"></div>
            </div>
         </div>
      </div>
      <!-- container -->
   </div>
   <!--wrap -->
</div>
<!-- page-content -->

<script>
  $('#builder').queryBuilder({
    filters: [{
    id: 'name',
    label: 'Name',
    type: 'string'
  }, {
    id: 'category',
    label: 'Category',
    type: 'integer',
    input: 'select',
    values: {
      1: 'Books',
      2: 'Movies',
      3: 'Music',
      4: 'Tools',
      5: 'Goodies',
      6: 'Clothes'
    },
    operators: ['equal', 'not_equal', 'in', 'not_in', 'is_null', 'is_not_null']
  }, {
    id: 'in_stock',
    label: 'In stock',
    type: 'integer',
    input: 'radio',
    values: {
      1: 'Yes',
      0: 'No'
    },
    operators: ['equal']
  }, {
    id: 'price',
    label: 'Price',
    type: 'double',
    validation: {
      min: 0,
      step: 0.01
    }
  }, {
    id: 'id',
    label: 'Identifier',
    type: 'string',
    placeholder: '____-____-____',
    operators: ['equal', 'not_equal'],
    validation: {
      format: /^.{4}-.{4}-.{4}$/
    }
  }]
  });
</script>