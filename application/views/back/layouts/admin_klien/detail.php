	<div class="row">
	    <div class="col-xs-12">
	        <div class="box">
	            <div class="box-header">
	                <h3 class="box-title">Detail Klien</h3>
	            </div><!-- /.box-header -->
	            <div class="box-body table-responsive">
	                <table class="table table-striped table-bordered table-hover table-condensed">
						<?php
							if(!empty($list)){
						?>	
							<tr>
								<th width="15%">Nama Klien</th>
								<td><?=$list['nama_klien']?></td>				
							</tr>
							
							<tr>
								<th>Deskripsi</th>
								<td><?=$list['konten']?></td>
							</tr>
							<tr>
								<th>Gambar</th>
								<td><?php
						  $path_gambar=base_url()."foto_klien/".$list['gambar'];
						  ?>
							<img src="<?php echo $path_gambar?>" width="200" /></td>
							</tr>
						<?php 
							}else{
						?>
							<tr><td colspan="2" align="center">Tidak ada data</td></tr>
						<?php 
							}
						?>
					</table>									
	            </div><!-- /.box-body -->
	        </div><!-- /.box -->                            
	    </div>
	</div>