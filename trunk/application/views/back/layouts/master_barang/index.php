	<div class="row">
	    <div class="col-xs-12">
	        <div class="box box-primary">
	            <div class="box-header">
                <h3 class="box-title">Barang</h3>
                <span class="box-title tmb-title">
                	<a href="<?php echo site_url('master_barang/add')?>" class="btn btn-xs btn-primary btn-flat"><i class="ion-plus-round"></i>&nbsp;&nbsp;Tambah</button></a>
                </span>
                <div class="box-tools box-cari">
                <?=form_open('master_barang/cari')?>
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

	            	<div class="pull-right">
		            	<a href="<?php echo site_url('master_barang/excel')?>" class="btn btn-xs btn-tbl btn-flat"><i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Save as Excel</button></a>
	                <a href="<?php echo site_url('master_barang/pdf')?>" target="_blank" class="btn btn-xs btn-tbl btn-flat"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Save as PDF</button></a>  	
                </div>
                <table class="table table-hover table-condensed table-striped">
									<thead>
									<tr>
										<th style="text-align:center;">#</th>
										<th>ID Produksi</th>
										<th>Nama Barang</th>
										<th>Keterangan</th>
									</tr>
									</thead>
									<?php 
										if(!empty($results)){
											foreach ($results as $row) {
									?>
									<tr>
										<td width="3%" align="center"><?php echo $ordinal_num++ ?></td>
										<td width="15%"><?php echo $row['id_produksi']?></td>
										<td width="20%"><?php echo $row['nama']?></td>
										<td>
											<?php echo $row['ket']?>
											<span class="pull-right">
												<?php echo anchor('master_barang/barang_detail/'.$row['id_barang'].'/'.$row['id_produksi'].'','Lihat','class="label label-primary" title="Lihat detail data barang"'); ?>
												<?php echo anchor('master_barang/edit/'.$row['id_barang'].'/'.$row['id_produksi'].'','Edit','class="label label-warning" title="Edit data barang"'); ?>
												<?php echo anchor('master_barang/delete/'.$row['id_barang'].'','Hapus','class="label label-danger" title="Hapus data barang" onClick="return confirm(\'Yakin ingin menghapus '.$row['nama'].' dari data master barang?\');"'); ?>
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