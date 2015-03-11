	<div class="row">
	    <div class="col-xs-12">
	        <div class="box">
	            <div class="box-header">
	                <h3 class="box-title"><i class="ion-locked"></i> Kategori Role</h3>
	                <span class="box-title pull-right">
	                	<a href="<?php echo site_url('auth/create_roles_cat')?>" title="Tambahkan kategori role baru" class="btn btn-xs btn-primary btn-flat"><i class="ion-plus-round"></i>&nbsp;&nbsp;Kategori Role Baru</button></a>
	            	</span>
	            </div><!-- /.box-header -->
	            <div class="box-body table-responsive">
	            	<!-- notif -->
	                <div class="alert alert-info alert-dismissable col-centered col-xs-5" <?php if($this->session->flashdata('message')){echo 'style="display:block; margin-bottom:7px;"';}else{echo 'style="display:none;"';}?> >
	                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                    <?php echo $this->session->flashdata('message')?>
	                </div>
	                <table class="table table-hover table-condensed table-striped">
	                	<thead>
	                		<tr>
								<th style="text-align:center;">#</th>
								<th>Order</th>
								<th>Ikon</th>
								<th>Kategori Role</th>
							</tr>
						</thead>
						<?php
							if(!empty($list)){
								$i = 1; 
								foreach ($list as $row):
						?>	
							<tr>
					            <td width="3%" style="text-align:center;"><?php echo $i++?></td>
					            <td width="3%" style="text-align:center;"><?php echo $row['order_number']; ?></td>
					            <td width="3%" style="text-align:center;"><?php echo '<i class="'.$row['icon_code'].'"></i> '; ?></td>
					            <td>
					            	<?php echo ucfirst($row['category']);?>
					            	<span class="pull-right">
					            		<?php echo anchor("auth/edit_roles_cat/".$row['id'], 'Edit','class="label label-warning" title="Edit role '.ucfirst($row['category']).'"') ;?>
					            		<?php 
											if(!multi_in_array($row['id'], $roles_cat_id)){
												echo anchor("auth/delete_roles_cat/".$row['id'], 'Hapus','class="label label-danger" title="Hapus kategori role dengan nama '.ucfirst($row['category']).'" onClick="return confirm(\'Yakin ingin menghapus kategori role dengan nama '.ucfirst($row['category']).' ?\');"');
											}else{
												echo '<small class="label label-default">Hapus</small>';
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