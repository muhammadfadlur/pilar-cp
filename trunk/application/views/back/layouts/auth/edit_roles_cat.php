            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title"><i class="ion-locked"></i> Edit Kategori Role</h3>
                        </div><!-- /.box-header -->
                        <?php echo form_open('auth/update_roles_cat', array('role' => 'form'));?>
                        <div class="box-body">
                          <!-- notif -->
                          <div class="alert alert-info alert-dismissable col-centered col-xs-5" <?php if($this->session->flashdata('message')){echo 'style="display:block; margin-bottom:7px;"';}else{echo 'style="display:none;"';}?> >
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              <?php echo $this->session->flashdata('message');?>  
                          </div>
                          <?php
                            foreach ($list as $row) {
                          ?>
                          <input type="hidden" value="<?php echo $row['id']?>" name="id">
                          <?php echo validation_errors(); ?>
                          <!-- text input -->
                          <div class="form-group">
                              <label>Nama Kategori</label>
                              <input value="<?php echo $row['category']; ?>" type="text" name="category" id="category" class="form-control input-sm" placeholder="Nama Kategori, disarankan satu kata"/>
                          </div>
                          <div class="form-group">
                              <label>Kode Ikon</label>
                              <input value="<?php echo $row['icon_code']; ?>" type="text" name="icon_code" id="category" class="form-control input-sm" placeholder="Kode Ikon, misal dari Font Awesome, Ion Icon atau Glyphicon"/>
                          </div>
                          <div class="form-group">
                              <label>Order</label>
                              <input value="<?php echo $row['order_number']; ?>" type="text" name="order_number" id="category" class="form-control input-sm" placeholder="Urutan dalam menu sidebar, diisi dengan angka"/>
                          </div>
                          <?php
                            }
                          ?>
                        </div>                               
                        <div class="box-footer">
                              <button type="submit" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-floppy-o"></i> Update</button>
                        </div>
                        <?php echo form_close();?>
                    </div><!-- /.box -->                            
                </div>
            </div>