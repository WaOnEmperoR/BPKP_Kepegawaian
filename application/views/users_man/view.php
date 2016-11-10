<div id="page-content">
	<div id='wrap'>
		<div id="page-heading">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>home">Dashboard</a></li>
				<li><?php echo $breadcumb; ?></li>
				<li class="active"><?php echo $judul_halaman; ?></li>
			</ol>
		</div>
		
		
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-indigo">
						<div class="panel-heading">
							<h4><?php echo $judul_halaman; ?></h4>
						</div>
						<div class="panel-body collapse in">
							<div class="panel">
								<a href="<?php echo base_url(); ?>usersman/tambah"> <button class="btn-primary btn"><i class="fa fa-plus"></i> Tambah</button></a>
							</div>
							<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
								<thead>
									<tr>
										<th>No</th>
										<th>First Name</th>
                                        <th>Last Name</th>
										<th>Email</th>
                                        <th>Groups</th>
                                        <th>Status</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$no=1;
										foreach ($users as $user):
									?>
									<tr class="gradeA">
										<td style="text-align: center"><?php echo $no; ?></td>
										<td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
										<td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
                                        <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
										
										<td>
                                            <?php foreach ($user->groups as $group):?>
                                                <?php echo anchor("/users_man/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
                                            <?php endforeach?>
			                            </td>
                                        <td><?php echo ($user->active) ? anchor("/deactivate".$user->id, lang('index_active_link')) : anchor("/activate". $user->id, lang('index_inactive_link'));?></td>
                                        <td><?php echo anchor("/users_man/ubah/".$user->id, 'Edit') ;?></td>
										
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
		</div> <!--wrap -->
	</div> <!-- page-content -->
