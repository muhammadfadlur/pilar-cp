		<div class="row">
		    <div class="col-xs-7">
		        <div class="box box-primary">
		            <div class="box-header">
		                <h3 class="box-title">Tambah Data Gallery</h3>
		            </div><!-- /.box-header -->
		            <?php echo form_open_multipart('admin_gallery/save', array('role' => 'form', 'id' => 'form'));?>
		            <div class="box-body">				        
	                    <!-- text input -->
	                    <div class="form-group">
	                    	<label>Judul</label>
							
	                       	<input class="form-control input-sm" name="judul" type="text" placeholder="Judul Slider">
							
						</div>
						<div class="form-group">
	                    	<label>Album</label>
							<?php
							$js='class="form-control input-sm"';
							echo form_dropdown('album',$list_album,'',$js);
							?>
						</div>
	                    <div class="form-group">
	                        <label>Gambar</label>
							
	                       	<input type="file" name="gambar" id="gambar">
							<p class="help-block">Pilih gambar</p>
					   </div>
					   
	                    
						
		            </div>		                   
                    <div class="box-footer">
                         <button type="submit" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-floppy-o"></i> Simpan</button>
                    </div>
								<?php echo form_close();?>
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