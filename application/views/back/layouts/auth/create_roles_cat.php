            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title"><i class="ion-locked"></i> Tambahkan Kategori Role Baru</h3>
                        </div><!-- /.box-header -->
                        <?php echo form_open('auth/create_roles_cat', array('role' => 'form'));?>
                        <div class="box-body">
                          <!-- notif -->
                          <div class="alert alert-info alert-dismissable col-centered col-xs-5" <?php if($this->session->flashdata('message')){echo 'style="display:block; margin-bottom:7px;"';}else{echo 'style="display:none;"';}?> >
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              <?php echo $this->session->flashdata('message');?>  
                          </div>

                          <!-- text input -->
                          <div class="form-group">
                              <label>Kategori Role</label>
                              <input type="text" name="category" id="kat" class="form-control input-sm" placeholder="Nama Kategori, disarankan satu kata"/>
                              <?php echo '<span style="color:red">'.form_error('category').'</span>';?>
                          </div>
                          <div class="form-group">
                              <label>Kode Ikon</label>
                              <input type="text" name="icon_code" class="form-control input-sm" placeholder="Kode Ikon, misal dari Font Awesome, Ion Icon atau Glyphicon"/>
                          </div>
                          <div class="form-group">
                              <label>Urutan ke</label>
                              <input type="text" name="order_number" class="form-control input-sm" placeholder="Urutan dalam menu sidebar, diisi dengan angka"/>
                          </div>
                        </div>                               
                        <div class="box-footer">
                              <button type="submit" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-floppy-o"></i> Tambahkan</button>
                        </div>
                        <?php echo form_close();?>
                    </div><!-- /.box -->                            
                </div>
            </div>