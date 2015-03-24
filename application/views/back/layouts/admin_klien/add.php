		<div class="row">
		    <div class="col-xs-7">
		        <div class="box box-primary">
		            <div class="box-header">
		                <h3 class="box-title">Tambah Data Klien</h3>
		            </div><!-- /.box-header -->
		            <?php echo form_open_multipart('admin_klien/save', array('role' => 'form', 'id' => 'form'));?>
		            <div class="box-body">				        
	                    <!-- text input -->
	                    <div class="form-group">
	                    	<label>Nama Kliens</label>
							
	                       	<input class="form-control input-sm" name="nama_klien" type="text" placeholder="Nama Kegiatan">
							
						</div>
	                    <div class="form-group">
	                        <label>Gambar</label>
							
	                       	<input type="file" name="gambar" id="gambar">
							<p class="help-block">Pilih gambar</p>
					   </div>
					   
	                    <div class="form-group">
	                        <label >Konten</label>
							
	                       	<textarea class="form-control" rows="3" name="Konten" placeholder="Konten Klien"></textarea>
							
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