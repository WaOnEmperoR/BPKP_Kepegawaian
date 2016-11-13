<style>
	.example-modal .modal {
	position: relative;
	top: auto;
	bottom: auto;
	right: auto;
	left: auto;
	display: block;
	z-index: 1;
	}
	.example-modal .modal {
	background: transparent !important;
	}
</style>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading" id="inner_pendidikan">
					<h4><?php echo $judul_halaman; ?></h4>
				</div>
				<div class="panel-body collapse in">
					<div class="panel">
						<button class="btn-primary btn" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Tambah</button>
					</div>
					<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Pengurus</th>
								<th>Posisi</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no=1;
								foreach ($susunan_kepengurusan as $db) :
								?>
							<tr class="gradeA">
								<td style="text-align: center"><?php echo $no; ?></td>
								<td><?php echo $db['Nama_Pengurus']; ?></td>
								<td><?php echo $db['Nama_Posisi'];?></td>
								<td align="center">
									<button type="button" id="btnEdit" onclick="edit_person(<?php echo $db['ID_Susunan_Kepengurusan']; ?>)" class="btn btn-primary">Ubah</button>
									| <a href="<?php echo base_url(); ?>susunan_kepengurusan/hapus/<?php echo $db['ID_Susunan_Kepengurusan']; ?>/<?php echo $id_mitra; ?>"> <button class="btn-danger btn-sm" title="hapus" onClick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash-o"></i> Hapus</button> </a>
								</td>
							</tr>
							<?php
								$no++;
								endforeach;
								?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- container -->
<style type="text/css">
	.panel-default > #inner_pendidikan.panel-heading {
	background-color: green;
	}
</style>
<script type="text/javascript">
	function save(id_mitra)
	{
	    $('#btnSave').text('saving...'); //change button text
	    $('#btnSave').attr('disabled',true); //set button disable 
	    var url;
	
	    if(save_method == 'add') {
	        url = "<?php echo site_url('susunan_kepengurusan/tambah')?>";
	        //url = "<?php //echo site_url('person/ajax_add')?>";
	    } else {
	        //url = "<?php //echo site_url('person/ajax_update')?>";
	        url = "<?php echo site_url('susunan_kepengurusan/ubah')?>";
	    }
	    console.log(url);
	
	    // ajax adding data to database
	    $.ajax({
	        url : url,
	        type: "POST",
	        data: $('#form').serialize(),
	        dataType: "JSON",
	        success: function(data)
	        {
	
	            if(data.status) //if success close modal and reload ajax table
	            {
	                $('#modal_form').modal('hide');
	                url = "<?php echo site_url('mitra/ubah')?>/"+id_mitra;
	                window.location = url;
	                //reload_table();
	            }
	
	            $('#btnSave').text('save'); //change button text
	            $('#btnSave').attr('disabled',false); //set button enable 
	
	            //window.location = site_url('susunan_kepengurusan/mitra');
	
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error adding / update data');
	            $('#btnSave').text('save'); //change button text
	            $('#btnSave').attr('disabled',false); //set button enable 
	
	        }
	    });
	}
	
	function add_person()
	{
	    save_method = 'add';
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string
	    $('#modal_form').modal('show'); // show bootstrap modal
	    $('.modal-title').text('Tambah Kepengurusan'); // Set Title to Bootstrap modal title
	}
	
	
	function edit_person(id)
	{
	    /*
	    save_method = 'add';
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string
	    $('#modal_form').modal('show'); // show bootstrap modal
	    $('.modal-title').text('Tambah Kepengurusan'); // Set Title to Bootstrap modal title
	    */
	    save_method = 'update';
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string
	
	     url = "<?php echo site_url('susunan_kepengurusan/getData/')?>/"+id;
	     console.log(url);
	
	    //Ajax Load data from ajax
	    $.ajax({
	        //url : "<?php //echo site_url('susunan_kepengurusan/getData/')?>/" + id,
	        url : url,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {
	            //nama='Dani Ramdani';
	            console.log(data);
	            //alert(data);
	            //$('[name="nama_pengurus"]').val(nama);
	            //$('[name="id_mitra"]').nama;
	            $('[name="id_susunan_kepengurusan"]').val(id);
	            $('[name="id_mitra"]').val(data.Mitra_ID_Mitra);
	            $('[name="nama_pengurus"]').val(data.Nama_Pengurus);
	            $('[name="id_posisi"]').val(data.Master_Posisi_Kepengurusan_idMaster_Posisi);
	            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
	            $('.modal-title').text('Edit Pengurus'); // Set title to Bootstrap modal title
	
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error get data from ajax');
	        }
	    });
	    
	
	}
	
	
	
</script>
<!-- --------------------------------- INPUT DATA ------------------------------------------------ -->
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">Tambah Kepengurusan</h3>
			</div>
			<div class="modal-body form">
				<form action="#" id="form" class="form-horizontal">
					<input type="hidden" class="form-control" name="id_susunan_kepengurusan" value="<?php if(isset($ID_Susunan_Kepengurusan)) echo $ID_Susunan_Kepengurusan; ?>">
					<?php //echo "id ".$ID_Susunan_Kepengurusan;?>
					<input type="hidden" class="form-control" name="id_mitra" value="<?php echo $id_mitra; ?>">
					<div class="form-body">
						<div class="form-group">
							<label class="control-label col-md-3">Nama Pengurus</label>
							<div class="col-md-9">
								<input name="nama_pengurus" placeholder="Nama Pengurus" class="form-control" type="text" value=<?php //if(isset($nama_pengurus))  echo $nama_pengurus; ?>>
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Posisi kepengurusan</label>
							<div class="col-md-9">
								<select name="id_posisi" class="form-control">
									<option value="">--Pilih Posisi Kepengurusan--</option>
									<?php foreach ($all_posisi_kepengurusan as $pk) :
										?>
									<option value="<?php echo $pk['idMaster_Posisi'];?>"><?php echo $pk['Nama_Posisi'];?></option>
									<?php endforeach; ?>   
								</select>
								<span class="help-block"></span>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSave" onclick="save(<?php echo $id_mitra; ?>)" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- End Bootstrap modal -->