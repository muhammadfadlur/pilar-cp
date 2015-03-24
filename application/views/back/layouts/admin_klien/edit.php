		<div class="row">
		    <div class="col-xs-12">
		        <div class="box box-primary">
		            <div class="box-header">
		                <h3 class="box-title">Edit Data Klien</h3>
		            </div><!-- /.box-header -->
		            <?=form_open_multipart('admin_klien/update', array('role' => 'form', 'id' => 'form')); 
									if(!empty($list)){
								?>
		            <div class="box-body">				        
						<input type="hidden" name="id_klien" value="<?=$list['id_klien']?>" />
						<input type="hidden" name="tmp_gambar" value="<?php echo $list['gambar']?>" id="tmp_gambar" />
					
					<div class="form-group">
	                    	<label>Nama Klien</label>
							
	                       	<input value="<?=$list['nama_klien']?>" class="form-control input-sm" name="nama_klien" type="text" placeholder="Nama Klien">
							
						</div>
						<div class="form-group">
						  <label>Gambar</label>
						  <div>
						  <?php
						  $path_gambar=base_url()."foto_klien/".$list['gambar'];
						  ?>
							<img src="<?php echo $path_gambar?>" width="200" />
						  </div>
						</div>
						<div class="form-group">
	                        <label>Ganti Gambar</label>
							
	                       	<input type="file" name="gambar" id="gambar">
							<p class="help-block">Pilih gambar</p>
					   </div>
	                    <div class="form-group">
	                        <label >Deskripsi</label>
							
	                       	<textarea class="form-control" rows="3" name="konten" placeholder="Konten Jadwal"><?=$list['konten']?></textarea>
							
						</div>
	                    <!-- text input -->
	                    
	                    <?php if (isset($_SERVER['HTTP_REFERER'])) {?>
			                <input type="hidden" name="redirurl" value="<?php echo $_SERVER['HTTP_REFERER'];?>" />
			                <?php }?>
		            </div>		                   
                    <div class="box-footer">
                         <button type="submit" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-floppy-o"></i> Update</button>
                    </div>
	                <?php 
										}else{
									?>
									Tidak ada data
									<?php 
										}
									echo form_close();
									?>
		        </div><!-- /.box -->                            
		    </div>
		</div>

		<script>
		
		$("#form").validate({
			rules: {
				id_produksi: {
					required: true
				},
				nama: {
					required: true,
					minlength: 5
				},
				ket: {
					required: true,
					minlength: 10
				}
			}
		});
		</script>