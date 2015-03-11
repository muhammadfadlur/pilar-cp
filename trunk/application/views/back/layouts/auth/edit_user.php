            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title"><i class="ion-person"></i> <?php echo lang('edit_user_heading');?></h3>
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
                              <label>Nama Lengkap</label>
                              <?php echo form_input($first_name);?>
                          </div>
                          <div class="form-group">
                              <label>Nama Panggilan</label>
                              <?php echo form_input($last_name);?>
                          </div>                          
                          <?php echo form_input($company);?>
                          <?php echo form_input($phone);?>
                          <div class="form-group">
                              <label>Username</label>
                              <?php echo form_input($username);?>
                          </div>
                          <div class="form-group">
                              <label>Email</label>
                              <?php echo form_input($email);?>
                          </div>                                             
                          <div class="form-group">
                              <label><?php echo lang('edit_user_password_label', 'password');?></label>
                              <?php echo form_input($password);?>
                          </div>
                          <div class="form-group">
                              <label><?php echo lang('edit_user_password_confirm_label', 'password_confirm');?></label>
                              <?php echo form_input($password_confirm);?>
                          </div>
                          <?php if ($this->ion_auth->in_group(array($this->config->item('super_admin_group','ion_auth'),$this->config->item('admin_group','ion_auth')))): ?>
                          <div class="form-group">
                              <label><?php echo lang('edit_user_groups_heading');?></label>
                              <?php foreach ($groups as $group):?>
                                <div class="checkbox checkbox-primary checkbox-circle">                                  
                                  <?php
                                      $gID=$group['id'];
                                      $checked = null;
                                      $item = null;
                                      foreach($currentGroups as $grp) {
                                          if ($gID == $grp->id) {
                                              $checked= ' checked="checked"';
                                          break;
                                          }
                                      }
                                  ?>                                  
                                  <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>" id="<?php echo $group['id'];?>" <?php echo $checked;?>>
                                  <label for="<?php echo $group['id'];?>">
                                  <?php echo htmlspecialchars(ucwords(str_replace('_', ' ', $group['name'])),ENT_QUOTES,'UTF-8');?>
                                  </label>
                                </div>
                              <?php endforeach?>
                          </div>
                          <?php endif?>
                          <?php echo form_hidden('id', $user->id);?>
                        </div>                               
                        <div class="box-footer">
                              <button type="submit" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-floppy-o"></i> Update</button>
                        </div>
                        <?php echo form_close();?>
                    </div><!-- /.box -->                            
                </div>
            </div>