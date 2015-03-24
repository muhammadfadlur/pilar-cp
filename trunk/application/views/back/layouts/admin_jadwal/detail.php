	<div class="row">
	    <div class="col-xs-12">
	        <div class="box">
	            <div class="box-header">
	                <h3 class="box-title">Detail Jadwal</h3>
	            </div><!-- /.box-header -->
	            <div class="box-body table-responsive">
	                <table class="table table-striped table-bordered table-hover table-condensed">
						<?php
							if(!empty($list)){
						?>	
							<tr>
								<th width="15%">Nama Kegiatan</th>
								<td><?=$list['nama_kegiatan']?></td>				
							</tr>
							<tr>
								<th>Tgl Mulai</th>
								<td><?=$list['tgl_mulai']?></td>				
							</tr>
							<tr>
								<th>Tgl Selesai</th>
								<td><?=$list['tgl_selesai']?></td>
							</tr>
							<tr>
								<th>Konten</th>
								<td><?=$list['konten']?></td>
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