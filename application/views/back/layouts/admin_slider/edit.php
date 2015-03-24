		<div class="row">
		    <div class="col-xs-12">
		        <div class="box box-primary">
		            <div class="box-header">
		                <h3 class="box-title">Edit Data Slider</h3>
		            </div><!-- /.box-header -->
		            <?=form_open_multipart('admin_slider/update', array('role' => 'form', 'id' => 'form')); 
									if(!empty($list)){
								?>
		            <div class="box-body">				        
						<input type="hidden" name="id_slider" value="<?=$list['id_slider']?>" />
						<input type="hidden" name="tmp_gambar" value="<?php echo $list['gambar']?>" id="tmp_gambar" />
					
					<div class="form-group">
	                    	<label>Judul</label>
							
	                       	<input value="<?=$list['judul']?>" class="form-control input-sm" name="judul" type="text" placeholder="Nama Klien">
							
						</div>
						<div class="form-group">
						  <label>Gambar</label>
						  <div>
						  <?php
						  $path_gambar=base_url()."foto_slider/".$list['gambar'];
						  ?>
							<img src="<?php echo $path_gambar?>" width="200" />
						  </div>
						</div>
						<div class="form-group">
	                        <label>Ganti Gambar</label>
							
	                       	<input type="file" name="gambar" id="gambar">
							<p class="help-block">Pilih gambar</p>
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