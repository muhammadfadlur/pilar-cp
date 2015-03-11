            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Profil Pengguna</h3>
                        </div><!-- /.box-header -->
                        <?php echo form_open(uri_string(), array('role' => 'form'));?>
                        <div class="box-body">
                          <!-- notif -->
                          <div class="alert alert-info alert-dismissable col-centered col-xs-5" <?php if(is_string($message)){echo 'style="display:block; margin-bottom:7px;"';}else{echo 'style="display:none;"';}?> >
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              <?php echo $message;?>  
                          </div>

                          <!-- text input -->
                          <div class="form-group">
                              <label>Nama lengkap</label>
                              <?php echo form_input($first_name);?>
                          </div>
                          <div class="form-group">
                              <label>Nama Panggilan</label>
                              <?php echo form_input($last_name);?>
                          </div>                          
                          <div class="form-group">
                              <label>Namapengguna</label>
                              <?php echo form_input($username);?>
                          </div>
                          <div class="form-group">
                              <label>Email, harap menggunakan email aktif</label>
                              <?php echo form_input($email);?>
                          </div>
                          <?php echo form_input($phone);?>
                          <div class="form-group">
                              <a href="<?php echo site_url('change_password')?>" title="Klik jika menghendaki untuk mengganti kata sandi"><span class="label label-success">Ganti Kata Sandi</span></a>
                          </div>
                          <?php echo form_hidden('id', $user->id);?>
                        </div>                               
                        <div class="box-footer">
                              <button type="submit" class="btn btn-sm btn-primary btn-flat"><span class="ion-ios7-loop-strong"></span> Update</button>
                        </div>
                        <?php echo form_close();?>
                    </div><!-- /.box -->                            
                </div>
            </div>