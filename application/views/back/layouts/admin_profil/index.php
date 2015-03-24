	<div class="row">
	    <div class="col-xs-12">
	        <div class="box box-primary">
	            <div class="box-header">
                <h3 class="box-title">Profil</h3>
                <span class="box-title pull-right">
                	<a href="<?php echo site_url('admin_profil/add')?>" class="btn btn-xs btn-primary btn-flat"><i class="ion-plus-round"></i>&nbsp;&nbsp;Tambah</button></a>
                </span>
                <div class="box-tools box-cari">
                <?=form_open('admin_profil/cari')?>
	                <div class="input-group">
	                  <input type="text" name="keyword" value="<?=$this->session->userdata('keyword');?>"class="form-control input-sm pull-right" style="width: 150px;" placeholder="Cari nama..."/>
                    <div class="input-group-btn">
                      <button type="submit" name="submit" class="btn btn-sm btn-default btn-flat"><i class="fa fa-search"></i></button>
                    </div>
	                </div>
	              <?=form_close();?>
              	</div>
	            </div><!-- /.box-header -->
	            <div class="box-body box-export-tools table-responsive">
	            	<span class="notif notif-primary" <?php if(is_string($this->session->flashdata('sukses'))){echo 'style="display:block;"';}else{echo 'style="display:none;"';}?>>
	            		<i class="fa fa-check"></i>
	            		<?php echo $this->session->flashdata('sukses'); ?>
	            		<button type="button" class="close">&times;</button>
	            	</span>

	            	<span class="notif notif-danger" <?php if(is_string($this->session->flashdata('gagal'))){echo 'style="display:block;"';}else{echo 'style="display:none;"';}?>>
	            		<i class="fa fa-check"></i>
	            		<?php echo $this->session->flashdata('gagal'); ?>
	            		<button type="button" class="close">&times;</button>
	            	</span>

	            	
                <table class="table table-hover table-condensed table-striped">
									<thead>
									<tr>
										<th style="text-align:center;">#</th>
										<th>Judul</th>
										<th></th>
										
									</tr>
									</thead>
									<?php 
										if(!empty($results)){
											foreach ($results as $row) {
									?>
									<tr>
										<td width="3%" align="center"><?php echo $ordinal_num++ ?></td>
										<td><?php echo $row['judul']?></td>
										
										<td>
											
											<span class="pull-right">
												<?php echo anchor('admin_profil/detail/'.$row['id_profil'].'','Lihat','class="label label-primary" title="Lihat detail data jadwal"'); ?>
												<?php echo anchor('admin_profil/edit/'.$row['id_profil'].'','Edit','class="label label-warning" title="Edit data jadwal"'); ?>
												<?php echo anchor('admin_profil/delete/'.$row['id_profil'].'','Hapus','class="label label-danger" title="Hapus data jadwal" onClick="return confirm(\'Yakin ingin menghapus '.$row['judul'].' dari data master Jadwal?\');"'); ?>
											</span>
										</td>
									</tr>
									<?php 
											}
										}else{
									?>
									<tr>
										<td colspan="4" align="center">Tida ada data</td>
									</tr>
									<?php
										}
									?>							
								</table>									
	            </div><!-- /.box-body -->
	            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                  <?php echo $pagination; ?>
                </ul>        
	            </div>
	        </div><!-- /.box -->                            
	    </div>
	</div>