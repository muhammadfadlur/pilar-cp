		<script type="text/javascript">
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
		</script>
		<div class="row">
		    <div class="col-xs-7">
		        <div class="box box-primary">
		            <div class="box-header">
		                <h3 class="box-title">Tambah Data Jadwal</h3>
		            </div><!-- /.box-header -->
		            <?php echo form_open('admin_jadwal/save', array('role' => 'form', 'id' => 'form'));?>
		            <div class="box-body">				        
	                    <!-- text input -->
	                    <div class="form-group">
	                    	<label>Nama Kegiatan</label>
							
	                       	<input class="form-control input-sm" name="nama_kegiatan" type="text" placeholder="Nama Kegiatan">
							
						</div>
	                    <div class="form-group">
	                        <label>Tgl Mulai</label>
							
	                       	<input class="form-control input-sm" name="tgl_mulai" id="tgl_mulai" type="text" placeholder="Tgl Mulai">
							
					   </div>
					   <div class="form-group">
	                        <label>Tgl Selesai</label>
							
	                       	<input class="form-control input-sm" name="tgl_selesai" id="tgl_selesai" type="text" placeholder="Tgl Selesai">
							
					   </div>
	                    <div class="form-group">
	                        <label >Konten</label>
							
	                       	<textarea class="form-control" rows="3" name="konten" placeholder="Konten Jadwal"></textarea>
							
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