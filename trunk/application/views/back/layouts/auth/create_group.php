            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title"><i class="ion-person-stalker"></i> <?php echo lang('create_group_heading');?></h3>
                        </div><!-- /.box-header -->
                        <?php echo form_open('auth/create_group', array('role' => 'form'));?>
                        <div class="box-body">
                          <!-- notif -->
                          <div class="alert alert-info alert-dismissable col-centered col-xs-5" <?php if(is_string($message)){echo 'style="display:block; margin-bottom:7px;"';}else{echo 'style="display:none;"';}?> >
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              <?php echo $message;?>  
                          </div>

                          <!-- text input -->
                          <div class="form-group">
                              <label><?php echo lang('create_group_name_label', 'group_name');?></label>
                              <?php echo form_input($group_name);?>
                          </div>
                          <div class="form-group">
                              <label><?php echo lang('create_group_desc_label', 'description');?></label>
                              <?php echo form_input($description);?>
                          </div>
                          <div class="form-group">
                              <label>Role Grup</label>
                              <?php foreach ($roles as $roles):?>
                                <div class="checkbox checkbox-primary checkbox-circle">
                                  <input type="checkbox" name="roles[]" value="<?php echo $roles['id'];?>" id="<?php echo $roles['id'];?>">
                                  <label for="<?php echo $roles['id'];?>">
                                  <?php echo $roles['name'];?>
                                  </label>
                                </div>
                              <?php endforeach?>
                          </div>
                        </div>                               
                        <div class="box-footer">
                              <button type="submit" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-floppy-o"></i> Tambahkan</button>
                        </div>
                        <?php echo form_close();?>
                    </div><!-- /.box -->                            
                </div>
            </div>