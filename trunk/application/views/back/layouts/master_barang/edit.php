		<div class="row">
		    <div class="col-xs-12">
		        <div class="box box-primary">
		            <div class="box-header">
		                <h3 class="box-title">Edit Data Darang</h3>
		            </div><!-- /.box-header -->
		            <?=form_open('master_barang/update', array('role' => 'form', 'id' => 'form')); 
									if(!empty($list)){
								?>
		            <div class="box-body">				        
								<input type="hidden" name="id_barang" value="<?=$list['id_barang']?>" />
	                    <!-- text input -->
	                    <div class="form-group">
	                    	<label>ID Produksi</label>
	                       	<input class="form-control input-sm" name="id_produksi" type="text" value="<?=$list['id_produksi']?>" placeholder="ID produksi">
	                    </div>
	                    <div class="form-group">
	                        <label>Nama Barang</label>
	                       	<input class="form-control input-sm" name="nama" type="text" value="<?=$list['nama']?>" placeholder="Nama baraang">
	                    </div>
	                    <div class="form-group">
	                        <label>Keterangan</label>
	                       	<textarea class="form-control" rows="3" name="ket" placeholder="Keterangan barang"><?=$list['ket']?></textarea>
	                    </div>
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