	<div class="row">
	    <div class="col-xs-12">
	        <div class="box">
	            <div class="box-header">
	                <h3 class="box-title"><i class="ion-locked"></i> Role Grup</h3>
	                <span class="box-title pull-right">
	                	<a href="<?php echo site_url('auth/create_role')?>" title="Tambahkan role baru" class="btn btn-xs btn-primary btn-flat"><i class="ion-plus-round"></i>&nbsp;&nbsp;Role Baru</button></a>
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
								<th>Kategori</th>
								<th>Nama Role</th>
								<th>URL</th>
								<th>Deskripsi</th>								
								<th>Sebagai induk menu?</th>								
							</tr>
						</thead>
						<?php
							if(!empty($list)){
								$i = 1; 
								foreach ($list as $row):
						?>	
							<tr>
					            <td width="3%" style="text-align:center;"><?php echo $i++?></td>
					            <td><span class="label label-primary"><?php echo ucfirst($row['category']);?></span></td>
					            <td><?php echo $row['name'];?></td>
					            <td><?php echo $row['url'];?></td>
					            <td><?php echo ucfirst($row['desc']);?></td>
					            <td>
					            	<?php if($row['parent']=='1'){echo '<font color="green">Ya</font>';}else{echo '<font color="#ccc">Tidak</font>';};?>
					            	<span class="pull-right">
					            		<?php echo anchor("auth/edit_role/".$row['id'], 'Edit','class="label label-warning" title="Edit role '.$row['name'].'"');?>
						            	<?php echo anchor("auth/delete_role/".$row['id'], 'Hapus','class="label label-danger" title="Hapus role '.$row['name'].'" onClick="return confirm(\'Yakin ingin menghapus role dengan nama '.$row['name'].' ?\');"');?>
					            	</span>
					            </td>					            
							</tr>
						<?php 
								endforeach;
							}else{
						?>
							<tr><td colspan="4" align="center">Tidak ada data</td></tr>
						<?php 
							}
						?>
					</table>
				</div><!-- /.box-body -->
	        </div><!-- /.box -->                            
	    </div>
	</div>