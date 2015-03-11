            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title"><?php echo lang('change_password_heading');?></h3>
                        </div><!-- /.box-header -->
                        <?php echo form_open('auth/change_password', array('role' => 'form'));?>
                        <div class="box-body">
                          <!-- notif -->
                          <div class="alert alert-info alert-dismissable  col-centered col-xs-5" <?php if(is_string($message)){echo 'style="display:block; margin-bottom:7px;"';}else{echo 'style="display:none;"';}?> >
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              <?php echo $message;?>  
                          </div>

                          <!-- text input -->
                          <div class="form-group">
                              <label><?php echo lang('change_password_old_password_label', 'old_password');?></label>
                              <?php echo form_input($old_password);?>
                          </div>
                          <div class="form-group">
                              <label><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label>
                              <?php echo form_input($new_password);?>
                          </div>
                          <div class="form-group">
                              <label><?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?></label>
                              <?php echo form_input($new_password_confirm);?>
                          </div>
                          <?php echo form_input($user_id);?>
                        </div>                               
                        <div class="box-footer">
                              <button type="submit" class="btn btn-sm btn-primary btn-flat"><span class="ion-ios7-loop-strong"></span> Ganti Kata Sandi</button>
                        </div>
                        <?php echo form_close();?>
                    </div><!-- /.box -->                            
                </div>
            </div>