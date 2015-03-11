	<div class="row">
	    <div class="col-xs-12">
	        <div class="box">
	            <div class="box-header">
	                <h3 class="box-title">Detail Barang</h3>
	            </div><!-- /.box-header -->
	            <div class="box-body table-responsive">
	                <table class="table table-striped table-bordered table-hover table-condensed">
						<?php
							if(!empty($list)){
						?>	
							<tr>
								<th width="15%">ID Produksi</th>
								<td><?=$list['id_produksi']?></td>				
							</tr>
							<tr>
								<th>Nama Barang</th>
								<td><?=$list['nama']?></td>				
							</tr>
							<tr>
								<th>Keterangan</th>
								<td><?=$list['ket']?></td>
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