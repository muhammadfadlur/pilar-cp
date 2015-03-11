		<div class="row">
		    <div class="col-xs-12">
		        <div class="box box-primary">
		            <div class="box-header">
		                <h3 class="box-title">Tambah Data Barang</h3>
		            </div><!-- /.box-header -->
		            <?php echo form_open('master_barang/save', array('role' => 'form', 'id' => 'form'));?>
		            <div class="box-body">				        
	                    <!-- text input -->
	                    <div class="form-group">
	                    	<label>ID Produksi</label>
	                       	<input class="form-control input-sm" name="id_produksi" type="text" placeholder="ID produksi">
	                    </div>
	                    <div class="form-group">
	                        <label>Nama Barang</label>
	                       	<input class="form-control input-sm" name="nama" type="text" placeholder="Nama baraang">
	                    </div>
	                    <div class="form-group">
	                        <label>Keterangan</label>
	                       	<textarea class="form-control" rows="3" name="ket" placeholder="Keterangan barang"></textarea>
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