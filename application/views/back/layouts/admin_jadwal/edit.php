		<div class="row">
		    <div class="col-xs-12">
		        <div class="box box-primary">
		            <div class="box-header">
		                <h3 class="box-title">Edit Data Jadwal</h3>
		            </div><!-- /.box-header -->
		            <?=form_open('admin_jadwal/update', array('role' => 'form', 'id' => 'form')); 
									if(!empty($list)){
								?>
		            <div class="box-body">				        
						<input type="hidden" name="id_jadwal" value="<?=$list['id_jadwal']?>" />
						<div class="form-group">
	                    	<label>Nama Kegiatan</label>
							
	                       	<input value="<?=$list['nama_kegiatan']?>" class="form-control input-sm" name="nama_kegiatan" type="text" placeholder="Nama Kegiatan">
							
						</div>
	                    <div class="form-group">
	                        <label>Tgl Mulai</label>
							
	                       	<input value="<?=$list['tgl_mulai']?>" class="form-control input-sm" name="tgl_mulai" id="tgl_mulai" type="text" placeholder="Tgl Mulai">
							
					   </div>
					   <div class="form-group">
	                        <label>Tgl Selesai</label>
							
	                       	<input value="<?=$list['tgl_selesai']?>" class="form-control input-sm" name="tgl_selesai" id="tgl_selesai" type="text" placeholder="Tgl Selesai">
							
					   </div>
	                    <div class="form-group">
	                        <label >Konten</label>
							
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
		$(document).ready(function() {
    		$('#tgl_mulai').datepicker({
    			format: "yyyy-mm-dd",
    			language: "id",
				autoclose: true
    		});
			$('#tgl_selesai').datepicker({
    			format: "yyyy-mm-dd",
    			language: "id",
				autoclose: true
    		});
    	});
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