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
	
	ul.ui-autocomplete {
    z-index: 1100;
	}
</style>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading" id="inner_peran_penugasan">
					<h4><?php echo $judul_halaman; ?></h4>
				</div>
				<div class="panel-body collapse in">
					<div class="panel">
						<button class="btn-primary btn" onclick="add_petugas_layanan()"><i class="glyphicon glyphicon-plus"></i> Tambah</button>
					</div>
					<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example1">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Pegawai</th>
								<th>Peran</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no=1;
								foreach ($susunan_petugas_pelayanan as $db) :
							?>
							<tr class="gradeA">
								<td style="text-align: center"><?php echo $no; ?></td>
								<td><?php echo $db['Nama_Pegawai']; ?></td>
								<td><?php echo $db['Nama_Peran'];?></td>
								
								<td align="center">
									<button type="button" id="btnEdit" onclick="edit_petugas_layanan(<?php echo $db['ID_Pelayanan_has_Pegawai']; ?>)" class="btn btn-primary">Ubah</button>
								| <a href="<?php echo base_url(); ?>petugas_pelayanan/hapus/<?php echo $db['Pelayanan_ID_Pelayanan']; ?>/<?php echo $db['ID_Pelayanan_has_Pegawai']; ?>"> <button class="btn-danger btn-sm" title="hapus" onClick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash-o"></i> Hapus</button> </a></td>
								
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
	
</div> <!-- container -->

<style type="text/css">
	.panel-default > #inner_peran_penugasan.panel-heading {
	background-color: green;
	}
</style>	


<script type="text/javascript">
	
	
	function save(id_pelayanan)
	{
		$('#btnSave').text('saving...'); //change button text
		$('#btnSave').attr('disabled',true); //set button disable 
		var url;
		
		if(save_method == 'add') {
			url = "<?php echo site_url('petugas_pelayanan/tambah')?>";
			//url = "<?php //echo site_url('person/ajax_add')?>";
			} else {
			//url = "<?php //echo site_url('person/ajax_update')?>";
			url = "<?php echo site_url('petugas_pelayanan/ubah')?>";
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
					url = "<?php echo site_url('pelayanan/ubah')?>/"+id_pelayanan;
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
	
	function add_petugas_layanan()
	{
		save_method = 'add';
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#modal_form').modal('show'); // show bootstrap modal
		$('.modal-title').text('Tambah Petugas Pelayanan'); // Set Title to Bootstrap modal title
	}
	
	
	function edit_petugas_layanan(id)
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
		
		url = "<?php echo site_url('petugas_pelayanan/getData/')?>/"+id;
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
				$('[name="id_pelayanan_has_pegawai"]').val(id);
				$('[name="id_pelayanan"]').val(data.Pelayanan_ID_Pelayanan);
				$('[name="id_pegawai"]').val(data.Pegawai_ID_Pegawai);
				$('[name="nama_pegawai"]').val(data.Nama_Pegawai);
				$('[name="id_peran"]').val(data.Master_Peran_ID_Peran);
				$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Ubah Petugas Pelayanan'); // Set title to Bootstrap modal title
				
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
				<h3 class="modal-title">Tambah Petugas Pelayanan</h3>
			</div>
			<div class="modal-body form">
				<form action="#" id="form" class="form-horizontal">
					<input type="hidden" class="form-control" name="id_pelayanan_has_pegawai" id="id_pelayanan_has_pegawai" value="<?php if(isset($ID_Pelayanan_has_Pegawai)) echo $ID_Pelayanan_has_Pegawai; ?>"/>
					<input type="hidden" class="form-control" name="id_pelayanan" id="id_pelayanan" value="<?php echo $id_pelayanan; ?>"/>
					
					<div class="form-body">
						<div class="form-group">
							<label class="control-label col-md-3">Nama Pegawai</label>
							<div class="col-md-9">
								<input type="hidden" class="form-control" name="id_pegawai" id="id_pegawai" value="<?php if(isset($pegawai_id_pegawai)) echo $pegawai_id_pegawai; ?>"/>
								<input name="nama_pegawai" id="nama_pegawai" placeholder="Nama Pegawai" class="form-control" type="text" value="<?php if(isset($nama_pegawai)) echo $nama_pegawai;?>"/>
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Nama Peran</label>
							<div class="col-md-9">
								<select name="id_peran" class="form-control">
									<option value="">--Pilih Peran--</option>
									<?php foreach ($all_peran_penugasan as $pp) :?>
									<option value="<?php echo $pp['ID_Peran'];?>"><?php echo $pp['Nama_Peran'];?></option>
									<?php endforeach; ?>   
								</select>
								<span class="help-block"></span>
							</div>
						</div>                                              
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSave" onclick="save(<?php echo $id_pelayanan; ?>)" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$( "#nama_pegawai" ).autocomplete({
			source: function (request, response)
			{
				$.ajax(
				{
					url: '<?php echo base_url()."petugas_pelayanan/get_all_pegawai/"; ?>' + request.term,
					dataType: "json",
					success: function (data) {
						//alert("Masuk sini");
						var parsed = (data);
						var newArray = new Array(parsed.length);
						var i = 0;
						parsed.forEach(function (entry) {
							var newObject = {
								label: entry.Nama_Pegawai,
								ID: entry.ID_Pegawai
							};
							newArray[i] = newObject;
							i++;
						});
						//alert(newArray);
						response(newArray);
					},
					error: function () {
						response([]);
					}
				});
			},
			minLength: 0,
			select:function(event, ui){
				$('#id_pegawai').val(ui.item.ID);
			}
		});
	});
</script>

<!-- End Bootstrap modal -->
