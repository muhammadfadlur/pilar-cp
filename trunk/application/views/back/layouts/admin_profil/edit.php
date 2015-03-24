		<div class="row">
		    <div class="col-xs-12">
		        <div class="box box-primary">
		            <div class="box-header">
		                <h3 class="box-title">Edit Data Profil</h3>
		            </div><!-- /.box-header -->
		            <?=form_open('admin_profil/update', array('role' => 'form', 'id' => 'form')); 
									if(!empty($list)){
								?>
		            <div class="box-body">				        
						<input type="hidden" name="id_profil" value="<?=$list['id_profil']?>" />
						<input type="hidden" name="tmp_slug" value="<?php echo $list['slug']?>" id="tmp_slug" />
						<div class="form-group">
	                    	<label>Judul</label>
							
	                       	<input value="<?=$list['judul']?>" class="form-control input-sm" name="judul" type="text" placeholder="Judul Berita">
							
						</div>
	                    <div class="form-group">
	                        <label>Keyword</label>
							
	                       	<input value="<?=$list['keyword']?>" class="form-control input-sm" name="keyword" id="keyword" type="text" placeholder="Keyword">
							
					   </div>
					   
					   <div class="form-group">
	                        <label>Urutan</label>
							
	                       	<input value="<?=$list['urutan']?>" class="form-control input-sm" name="urutan" id="urutan" type="text" placeholder="Urutan">
							
					   </div>
					  
	                    <div class="form-group">
	                        <label >Konten</label>
							
	                       	<textarea class="form-control" rows="3" name="konten" placeholder="Konten Berita"><?=$list['konten']?></textarea>
							
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