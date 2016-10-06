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
			<form class="well form-horizontal" action="<?php echo base_url(); ?>report_pegawai/print_single_pegawai" method="post"  id="report_form">
				<!-- Text input-->
				
				<div class="form-group">
					<label class="col-md-4 control-label">Nama Pegawai</label>  
					<div class="col-md-4 inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input type="hidden" name="id_pegawai" id="id_pegawai">
							<input  name="autocomplete" placeholder="First Name" class="form-control"  type="text" id ="autocomplete">
						</div>
					</div>
				</div>
				
				<!-- Text input-->
				
				<div class="form-group">
					<label class="col-md-4 control-label" >NIP</label> 
					<div class="col-md-4 inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input name="NIP" placeholder="NIP" class="form-control"  type="text" id="NIP" disabled>
						</div>
					</div>
				</div>
				
				<!-- Text input-->
				
				<div class="form-group">
					<label class="col-md-4 control-label" >NIK</label> 
					<div class="col-md-4 inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input name="NIK" placeholder="NIK" class="form-control"  type="text" id="NIK" disabled>
						</div>
					</div>
				</div>
				
				<!-- Button -->
				<div class="form-group">
					<label class="col-md-4 control-label"></label>
					<div class="col-md-4">
						<button type="submit" class="btn btn-warning" >Cetak PDF <span class="glyphicon glyphicon-send"></span></button>
					</div>
				</div>
			</form>
		</div>
		
	</div> <!--wrap -->
</div> <!-- page-content -->

<script type="text/javascript">
	$(document).ready(function(){
		
		$( "#autocomplete" ).autocomplete({
			source: function (request, response)
			{
				$.ajax(
				{
					url: '<?php echo base_url()."report_pegawai/get_all_pegawai/"; ?>' + request.term,
					dataType: "json",
					success: function (data) {
						var parsed = (data);
						var newArray = new Array(parsed.length);
						var i = 0;
						
						parsed.forEach(function (entry) {
							var newObject = {
								label: entry.Nama_Pegawai,
								ID: entry.ID_Pegawai,
								NIK: entry.NIK,
								NIP: entry.NIP
							};
							newArray[i] = newObject;
							i++;
						});
						
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
				$('#NIK').val(ui.item.NIK);
				$('#NIP').val(ui.item.NIP);
			}
		});
	});
</script>
