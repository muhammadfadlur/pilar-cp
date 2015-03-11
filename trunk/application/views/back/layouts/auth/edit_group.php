<script>
  $(document).ready(function(){
    <?php foreach ($roles as $role):?>
    $('#<?php echo $role['id'];?>').click(function(){
        if($('#<?php echo $role['id'];?>').is(":checked")){
            $('#cr<?php echo $role['id'];?>').show();
            $('#re<?php echo $role['id'];?>').show();
            $('#up<?php echo $role['id'];?>').show();
            $('#de<?php echo $role['id'];?>').show();

            $('#cre<?php echo $role['id'];?>').val('0');
            $('#rea<?php echo $role['id'];?>').val('0');
            $('#upd<?php echo $role['id'];?>').val('0');
            $('#del<?php echo $role['id'];?>').val('0');

            $('#cre<?php echo $role['id'];?>').attr('name','c[]');
            $('#rea<?php echo $role['id'];?>').attr('name','r[]');
            $('#upd<?php echo $role['id'];?>').attr('name','u[]');
            $('#del<?php echo $role['id'];?>').attr('name','d[]');
        }else{
            $('#cr<?php echo $role['id'];?>').hide();
            $('#re<?php echo $role['id'];?>').hide();
            $('#up<?php echo $role['id'];?>').hide();
            $('#de<?php echo $role['id'];?>').hide();

            $('#c<?php echo $role['id'];?>').attr('checked', false);
            $('#r<?php echo $role['id'];?>').attr('checked', false);
            $('#u<?php echo $role['id'];?>').attr('checked', false);
            $('#d<?php echo $role['id'];?>').attr('checked', false);

            $('#cre<?php echo $role['id'];?>').val('0');
            $('#rea<?php echo $role['id'];?>').val('0');
            $('#upd<?php echo $role['id'];?>').val('0');
            $('#del<?php echo $role['id'];?>').val('0');

            $('#cre<?php echo $role['id'];?>').removeAttr('name');
            $('#rea<?php echo $role['id'];?>').removeAttr('name');
            $('#upd<?php echo $role['id'];?>').removeAttr('name');
            $('#del<?php echo $role['id'];?>').removeAttr('name');
        }
    });

    $('#c<?php echo $role['id'];?>').click(function(){
        if($(this).is(":checked")){
            $('#cre<?php echo $role['id'];?>').val('1');
        }else{
            $('#cre<?php echo $role['id'];?>').val('0');
        }
    });
    $('#r<?php echo $role['id'];?>').click(function(){
        if($(this).is(":checked")){
            $('#rea<?php echo $role['id'];?>').val('1');
        }else{
            $('#rea<?php echo $role['id'];?>').val('0');
        }
    });
    $('#u<?php echo $role['id'];?>').click(function(){
        if($(this).is(":checked")){
            $('#upd<?php echo $role['id'];?>').val('1');
        }else{
            $('#upd<?php echo $role['id'];?>').val('0');
        }
    });
    $('#d<?php echo $role['id'];?>').click(function(){
        if($(this).is(":checked")){
            $('#del<?php echo $role['id'];?>').val('1');
        }else{
            $('#del<?php echo $role['id'];?>').val('0');
        }
    });
    <?php endforeach;?>
  });
</script>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title"><i class="ion-person-stalker"></i> <?php echo lang('edit_group_heading');?></h3>
                        </div><!-- /.box-header -->
                        <?php echo form_open(current_url(), array('role' => 'form'));?>
                        <div class="box-body">
                          <!-- notif -->
                          <div class="alert alert-info alert-dismissable col-centered col-xs-5" <?php if(is_string($message)){echo 'style="display:block; margin-bottom:7px;"';}else{echo 'style="display:none;"';}?> >
                              <button type="button" class="close" data-dismiss="alert" aria-text="true">&times;</button>
                              <?php echo $message;?>  
                          </div>

                          <!-- text input -->
                          <div class="form-group">
                              <label><?php echo lang('edit_group_name_label', 'group_name');?></label>
                              <?php echo form_input($group_name);?>
                              <?php echo form_input($group_name_hide);?>
                          </div>
                          <div class="form-group">
                              <label><?php echo lang('edit_group_desc_label', 'description');?></label>
                              <?php echo form_input($group_description);?>
                          </div>
                          <div class="form-group">
                              <label class="col-xs-4 role">Roles</label>
                              <label class="col-xs-8 role">Permissions</label>
                              <table class="table table-checkbox col-xs-12">
                              <?php 
                                if ($roles>0) {
                                foreach ($roles as $roles):?>
                                  <?php
                                      $rID=$roles['id'];
                                      $checked = null;
                                      $item = null;
                                      if($currentRoles > 0){
                                        foreach($currentRoles as $rls) {
                                          if ($rID == $rls['role_id']) {
                                            $checked= ' checked="checked"';
                                            break;
                                          }
                                        }
                                      }
                                  ?>

                                <tr> 
                                    <td class="col-xs-4"> 
                                      <div class="checkbox checkbox-primary checkbox-circle">  
                                        <input type="checkbox" name="roles[]" id="<?php echo $roles['id'];?>" value="<?php echo $roles['id'];?>"<?php echo $checked;?>/>
                                        <label for="<?php echo $roles['id'];?>">
                                          <?php echo $roles['name'];?>
                                        </label>
                                      </div>
                                    </td>
                                    <!-- CRUD -->
                                    <td class="col-xs-2">                                      
                                      <div id="cr<?php echo $roles['id'];?>" class="checkbox checkbox-success checkbox-circle" <?php if($checked!=' checked="checked"'){echo 'style="display:none;"';}?>>  
                                        <input type="hidden" id="cre<?php echo $roles['id'];?>" <?php if($checked ==' checked="checked"'){echo 'name="c[]"';}?> value="<?php if(isset($rls['rule'])){echo substr($rls['rule'], 0,1);}else{echo '0';}?>"/>
                                        <input type="checkbox" id="c<?php echo $roles['id'];?>" <?php if(isset($rls['rule']) && $checked ==' checked="checked"'){if (substr($rls['rule'], 0,1)=='1') { echo 'checked';}}?>/>
                                        <label for="c<?php echo $roles['id'];?>">
                                          Create
                                        </label>
                                      </div>                                      
                                    </td>
                                    <td class="col-xs-2">                                      
                                      <div id="re<?php echo $roles['id'];?>" class="checkbox checkbox-info checkbox-circle" <?php if($checked!=' checked="checked"'){echo 'style="display:none;"';}?>>  
                                        <input type="hidden" id="rea<?php echo $roles['id'];?>" <?php if($checked ==' checked="checked"'){echo 'name="r[]"';}?>  value="<?php if(isset($rls['rule'])){echo substr($rls['rule'], 1,1);}else{echo '0';}?>"/>
                                        <input type="checkbox" id="r<?php echo $roles['id'];?>" <?php if(isset($rls['rule']) && $checked ==' checked="checked"'){if (substr($rls['rule'], 1,1)=='1') { echo 'checked';}}?>/>                                        
                                        <label for="r<?php echo $roles['id'];?>">
                                          Read
                                        </label>
                                      </div>                                      
                                    </td>
                                    <td class="col-xs-2">                                      
                                      <div id="up<?php echo $roles['id'];?>" class="checkbox checkbox-warning checkbox-circle" <?php if($checked!=' checked="checked"'){echo 'style="display:none;"';}?>>  
                                        <input type="hidden" id="upd<?php echo $roles['id'];?>" <?php if($checked ==' checked="checked"'){echo 'name="u[]"';}?> value="<?php if(isset($rls['rule'])){echo substr($rls['rule'], 2,1);}else{echo '0';}?>"/>
                                        <input type="checkbox" id="u<?php echo $roles['id'];?>" <?php if(isset($rls['rule']) && $checked ==' checked="checked"'){if (substr($rls['rule'], 2,1)=='1') { echo 'checked';}}?>/>                                        
                                        <label for="u<?php echo $roles['id'];?>">
                                          Update
                                        </label>
                                      </div>                                      
                                    </td>
                                    <td class="col-xs-2">                                      
                                      <div id="de<?php echo $roles['id'];?>" class="checkbox checkbox-danger checkbox-circle" <?php if($checked!=' checked="checked"'){echo 'style="display:none;"';}?>>  
                                        <input type="hidden" id="del<?php echo $roles['id'];?>" <?php if($checked ==' checked="checked"'){echo 'name="d[]"';}?> value="<?php if(isset($rls['rule'])){echo substr($rls['rule'], 3,1);}else{echo '0';}?>"/>
                                        <input type="checkbox" id="d<?php echo $roles['id'];?>" <?php if(isset($rls['rule']) && $checked ==' checked="checked"'){if (substr($rls['rule'], 3,1)=='1') { echo 'checked';}}?>/>                                        
                                        <label for="d<?php echo $roles['id'];?>">
                                          Delete
                                        </label>
                                      </div>                                      
                                    </td>
                                </tr>
                              <?php 
                                endforeach; 
                              }
                              ?>
                              </table>
                          </div>
                        </div>                               
                        <div class="box-footer">
                              <button type="submit" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-floppy-o"></i> Update</button>
                        </div>
                        <?php echo form_close();?>
                    </div><!-- /.box -->                            
                </div>

            </div>