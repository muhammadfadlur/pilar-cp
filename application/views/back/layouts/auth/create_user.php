            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title"><i class="ion-person"></i> <?php echo lang('create_user_heading');?></h3>
                        </div><!-- /.box-header -->
                        <?php echo form_open('auth/create_user', array('role' => 'form'));?>
                        <div class="box-body">
                          <!-- notif -->
                          <div class="alert alert-info alert-dismissable col-centered col-xs-5" <?php if(is_string($message)){echo 'style="display:block; margin-bottom:7px;"';}else{echo 'style="display:none;"';}?> >
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              <?php echo $message;?>  
                          </div>

                          <!-- text input -->
                          <div class="form-group">
                              <label>Nama Lengkap</label>
                              <?php echo form_input($first_name);?>
                          </div>
                          <div class="form-group">
                              <label>Nama Panggilan</label>
                              <?php echo form_input($last_name);?>
                          </div>
                          <div class="form-group">
                              <label><?php echo lang('create_user_email_label', 'email');?></label>
                              <?php echo form_input($email);?>
                          </div>
                          <div class="form-group">
                              <label>Namapengguna</label>
                              <?php echo form_input($username);?>
                          </div>
                          <div class="form-group">
                              <label><?php echo lang('create_user_password_label', 'password');?></label>
                              <?php echo form_input($password);?>
                          </div>
                          <div class="form-group">
                              <label><?php echo lang('create_user_password_confirm_label', 'password_confirm');?></label>
                              <?php echo form_input($password_confirm);?>
                          </div>
                        </div>                               
                        <div class="box-footer">
                              <button type="submit" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-floppy-o"></i> Tambahkan</button>
                        </div>
                        <?php echo form_close();?>
                    </div><!-- /.box -->                            
                </div>
            </div>