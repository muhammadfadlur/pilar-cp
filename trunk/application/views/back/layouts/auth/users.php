	<div class="row">
	    <div class="col-xs-12">
	        <div class="box">
	            <div class="box-header">
	                <h3 class="box-title"><i class="ion-person"></i> Users</h3>
	                <span class="box-title pull-right">
	                	<a href="<?php echo site_url('auth/create_user')?>" title="Create a new User" class="btn btn-xs btn-primary btn-flat"><i class="ion-plus-round"></i>&nbsp;&nbsp;Create User</button></a>
	            	</span>
	            </div><!-- /.box-header -->
	            <div class="box-body table-responsive">
	            	<!-- notif -->
	                <div class="alert alert-info alert-dismissable col-centered col-xs-5" <?php if(is_string($message)){echo 'style="display:block; margin-bottom:7px;"';}else{echo 'style="display:none;"';}?> >
	                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                    <?php echo $message;?>  
	                </div>

	                <table class="table table-hover table-condensed table-striped">
	                	<thead>
	                		<tr>
								<th style="text-align:center;">#</th>
								<th>Full Name</th>
								<th>Email</th>
								<th>Groups</th>
							</tr>
						</thead>
						<?php
							if(!empty($users)){
								$i = 1; 
								foreach ($users as $user):
						?>	
							<tr>
					            <td width="3%" style="text-align:center;"><?php echo $i++?></td>
					            <td width="25%"><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?> <?php //echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
					            <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
								<td>
									<?php foreach ($user->groups as $group):?>
										<span class="label label-info"><?php echo htmlspecialchars(ucwords(str_replace('_', ' ', $group->name)),ENT_QUOTES,'UTF-8')?></span>
					                <?php endforeach;?>
									
									<span class="pull-right">
										<?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, 'Active','class="label label-success" title="Deactivate this user"') : anchor("auth/activate/". $user->id, 'Non Active','class="label label-default" title="Activate this user"');?>
										<?php echo anchor("auth/edit_user/".$user->id, 'Edit','class="label label-warning" title="Edit '.htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8').' data"');?>
										<?php 
											if(!($this->ion_auth->user()->row()->id == $user->id)){
												echo anchor("auth/delete_user/".$user->id, 'Delete','class="label label-danger" title="Delete '.htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8').' data" onClick="return confirm(\'Yakin ingin menghapus data pengguna dengan nama '.htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8').' ?\');"');
											}else{
												echo '<small class="label label-default">Delete</small>';
											}
										?>
									</span>
								</td>
							</tr>
						<?php 
								endforeach;
							}else{
						?>
							<tr><td colspan="7" align="center">Tidak ada data</td></tr>
						<?php 
							}
						?>
					</table>
				</div><!-- /.box-body -->
	        </div><!-- /.box -->                            
	    </div>
	</div>