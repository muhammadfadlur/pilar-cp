	<div class="row">
	    <div class="col-xs-12">
	        <div class="box">
	            <div class="box-header">
	                <h3 class="box-title"><i class="ion-person-stalker"></i> Grup Pengguna</h3>
	                <span class="box-title pull-right">
	                	<a href="<?php echo site_url('auth/create_group')?>" title="Tambahkan grup baru" class="btn btn-xs btn-primary btn-flat"><i class="ion-plus-round"></i>&nbsp;&nbsp;Grup Baru</button></a>
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
								<th>Nama Grup</th>
								<th colspan="2">Deskripsi</th>
							</tr>
						</thead>
						<?php
							if(!empty($list)){
								$i = 1; 
								foreach ($list as $row):
						?>	
							<tr>
					            <td width="3%" style="text-align:center;"><?php echo $i++?></td>
					            <td><?php echo ucwords(str_replace('_', ' ', $row['name']));?></td>
					            <td><?php echo $row['description'];?></td>
					            <td>
					            	<span class="label label-primary"><?php echo $row['jml_role'];?> role</span>					            	
					            	<span class="pull-right">
					            		<?php echo anchor("auth/edit_group/".$row['id'], 'Edit','class="label label-warning" title="Edit grup '.$row['name'].'"') ;?>
					            		<?php 
					            			if($row['name'] == $this->config->item('super_admin_group', 'ion_auth')||$row['name'] == $this->config->item('admin_group', 'ion_auth')||$row['name'] == $this->config->item('default_group', 'ion_auth')){
					            				echo '<small class="label label-default">Hapus</small>';
					            			}else{
					            				echo anchor("auth/delete_group/".$row['id'], 'Hapus','class="label label-danger" title="Hapus grup '.$row['name'].'" onClick="return confirm(\'Yakin ingin menghapus grup pengguna dengan nama '.$row['name'].' ?\');"');
					            			}
					            		?>
					            		
					            	</span>
					            </td>					            
							</tr>
						<?php 
								endforeach;
							}else{
						?>
							<tr><td colspan="3" align="center">Tidak ada data</td></tr>
						<?php 
							}
						?>
					</table>
				</div><!-- /.box-body -->
	        </div><!-- /.box -->                            
	    </div>
	</div>