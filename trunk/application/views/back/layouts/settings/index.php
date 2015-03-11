    <script>
        $(document).ready(function(){
            $("#error1_2").hide();
            $("#error1_3").hide();

            $("#error2_1").hide();
            $("#error2_3").hide();

            $("#error3_1").hide();
            $("#error3_2").hide();

            $("#combo1").change(function(){
                var combo1 = $("#combo1").val();
                var combo2 = $("#combo2").val();
                var combo3 = $("#combo3").val();
                if(combo1 == combo2){
                    $("#combo1").blur();
                    $("#combo1").css({"border":"1px solid red"});
                    $("#combo2").css({"border":"1px solid red"});
                    $("#combo3").css({"border":"1px solid #ccc"});
                    $("#error1_2").show();
                    $("#error1_3").hide();
                    $("#error2_1").hide();
                    $("#error2_3").hide();
                    $("#error3_1").hide();
                    $("#error3_2").hide();
                    $("#submit").attr('disabled','disabled');
                }else if(combo1 == combo3){
                    $("#combo1").blur();
                    $("#combo2").css({"border":"1px solid #ccc"});                    
                    $("#combo1").css({"border":"1px solid red"});
                    $("#combo3").css({"border":"1px solid red"});
                    $("#error1_3").show();
                    $("#error1_2").hide();
                    $("#error2_3").hide();
                    $("#error2_1").hide();
                    $("#error3_1").hide();
                    $("#error3_2").hide();
                    $("#submit").attr('disabled','disabled');
                }else if(combo2 == combo3){
                    $("#combo2").css({"border":"1px solid red"});
                    $("#combo3").css({"border":"1px solid red"});
                    $("#submit").attr('disabled','disabled');
                    $("#error3_2").show();
                    $("#error3_1").hide();
                    $("#error1_2").hide();
                    $("#error1_3").hide();
                    $("#error2_1").hide();
                    $("#error2_3").hide();
                }else{
                    $("#combo1").css({"border":"1px solid #ccc"});
                    $("#combo2").css({"border":"1px solid #ccc"});
                    $("#combo3").css({"border":"1px solid #ccc"});
                    $("#error1_2").hide();
                    $("#error1_3").hide();
                    $("#error2_1").hide();
                    $("#error2_3").hide();
                    $("#error3_1").hide();
                    $("#error3_2").hide();
                    $("#submit").removeAttr('disabled');
                }
            });

            $("#combo2").change(function(){
                var combo1 = $("#combo1").val();
                var combo2 = $("#combo2").val();
                var combo3 = $("#combo3").val();
                if(combo2 == combo1){
                    $("#combo2").blur();
                    $("#combo2").css({"border":"1px solid red"});
                    $("#combo1").css({"border":"1px solid red"});
                    $("#combo3").css({"border":"1px solid #ccc"});
                    $("#error2_1").show();
                    $("#error2_3").hide();
                    $("#error1_2").hide();
                    $("#error1_3").hide();
                    $("#error3_1").hide();
                    $("#error3_2").hide();
                    $("#submit").attr('disabled','disabled');
                }else if(combo2 == combo3){
                    $("#combo2").blur();
                    $("#combo2").css({"border":"1px solid red"});                    
                    $("#combo3").css({"border":"1px solid red"});
                    $("#combo1").css({"border":"1px solid #ccc"});
                    $("#error2_3").show();
                    $("#error2_1").hide();
                    $("#error1_3").hide();
                    $("#error1_2").hide();
                    $("#error3_1").hide();
                    $("#error3_2").hide();
                    $("#submit").attr('disabled','disabled');
                }else if(combo1 == combo3){
                    $("#combo1").css({"border":"1px solid red"});
                    $("#combo3").css({"border":"1px solid red"});
                    $("#submit").attr('disabled','disabled');
                    $("#error3_1").show();
                    $("#error3_2").hide();
                    $("#error1_2").hide();
                    $("#error1_3").hide();
                    $("#error2_1").hide();
                    $("#error2_3").hide();
                }else{
                    $("#combo1").css({"border":"1px solid #ccc"});
                    $("#combo2").css({"border":"1px solid #ccc"});
                    $("#combo3").css({"border":"1px solid #ccc"});
                    $("#error1_2").hide();
                    $("#error1_3").hide();
                    $("#error2_1").hide();
                    $("#error2_3").hide();
                    $("#error3_1").hide();
                    $("#error3_2").hide();
                    $("#submit").removeAttr('disabled');
                }
            });

            $("#combo3").change(function(){
                var combo1 = $("#combo1").val();
                var combo2 = $("#combo2").val();
                var combo3 = $("#combo3").val();
                if(combo3 == combo1){
                    $("#combo3").blur();
                    $("#combo3").css({"border":"1px solid red"});
                    $("#combo1").css({"border":"1px solid red"});
                    $("#combo2").css({"border":"1px solid #ccc"});
                    $("#error3_1").show();
                    $("#error3_2").hide();
                    $("#error1_2").hide();
                    $("#error1_3").hide();
                    $("#error2_1").hide();
                    $("#error2_3").hide();
                    $("#submit").attr('disabled','disabled');
                }else if(combo3 == combo2){
                    $("#combo3").blur();
                    $("#combo3").css({"border":"1px solid red"});                    
                    $("#combo2").css({"border":"1px solid red"});
                    $("#combo1").css({"border":"1px solid #ccc"});
                    $("#error3_2").show();
                    $("#error3_1").hide();
                    $("#error1_2").hide();
                    $("#error1_3").hide();
                    $("#error2_1").hide();
                    $("#error2_3").hide();
                    $("#submit").attr('disabled','disabled');
                }else if(combo1 == combo2){
                    $("#combo1").css({"border":"1px solid red"});
                    $("#combo2").css({"border":"1px solid red"});
                    $("#submit").attr('disabled','disabled');
                    $("#error2_1").show();
                    $("#error2_2").hide();
                    $("#error1_2").hide();
                    $("#error1_3").hide();
                    $("#error3_1").hide();
                    $("#error3_2").hide();
                }else{
                    $("#combo1").css({"border":"1px solid #ccc"});
                    $("#combo2").css({"border":"1px solid #ccc"});
                    $("#combo3").css({"border":"1px solid #ccc"});
                    $("#error1_2").hide();
                    $("#error1_3").hide();
                    $("#error2_1").hide();
                    $("#error2_3").hide();
                    $("#error3_1").hide();
                    $("#error3_2").hide();
                    $("#submit").removeAttr('disabled');
                }
            });
        });       
    </script> 
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
                    <?php echo form_open('settings', array('role' => 'form', 'class' => 'form-horizontal', 'id' => 'form'));?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Site Title</label>
                            <div class="col-sm-3">
                                <input id="aa" value="<?php echo site_title();?>" type="text" name="site_title" class="form-control input-sm" placeholder="Site Title">
                            </div>                            
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tagline</label>
                            <div class="col-sm-7">
                                <input value="<?php echo site_tagline();?>" type="text" name="site_tagline" class="form-control input-sm" placeholder="In a few words, explain what this site is about">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Site Description</label>
                            <div class="col-sm-7">
                                <input value="<?php echo site_desc();?>" type="text" name="site_desc" class="form-control input-sm" placeholder="Site description">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">E-mail Address</label>
                            <div class="col-sm-4">
                                <input  value="<?php echo site_email();?>" type="text" name="site_email" class="form-control input-sm" placeholder="This address is used for admin purposes, like reset password">
                            </div>                            
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Super Admin Group</label>
                            <div class="col-sm-2">
                                <select name="group1" id="combo1" class="form-control input-sm">
                                    <?php 
                                    if(count($groups)>0){
                                        foreach ($groups as $row_g){                                
                                            if($row_g['name'] == super_admin_group()){
                                            ?>
                                                <option selected value="<?php echo $row_g['name']; ?>"><?php echo ucwords(str_replace('_', ' ', $row_g['name'])); ?></option>
                                            <?php
                                            }else{
                                            ?>
                                                <option value="<?php echo $row_g['name']; ?>"><?php echo ucwords(str_replace('_', ' ', $row_g['name'])); ?></option>
                                            <?php
                                            }
                                        }
                                    }else{
                                    ?>
                                        <option>Tidak ada data</option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                            </div>
                            <div class="col-sm-8 font-weight-n" id="error2_1" style="padding-top:4px;font-weight:normal;"><strong>Admin Group</strong> tidak boleh sama dengan <strong>Super Admin Group</strong></div>
                            <div class="col-sm-8 font-weight-n" id="error3_1" style="padding-top:4px;font-weight:normal;"><strong>User Default Group</strong> tidak boleh sama dengan <strong>Super Admin Group</strong></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Admin Group</label>
                            <div class="col-sm-2">
                                <select name="group2" id="combo2" class="form-control input-sm">
                                    <?php 
                                    if(count($groups)>0){
                                        foreach ($groups as $row_g){                                
                                            if($row_g['name'] == admin_group()){
                                            ?>
                                                <option selected value="<?php echo $row_g['name']; ?>"><?php echo ucwords(str_replace('_', ' ', $row_g['name'])); ?></option>
                                            <?php
                                            }else{
                                            ?>
                                                <option value="<?php echo $row_g['name']; ?>"><?php echo ucwords(str_replace('_', ' ', $row_g['name'])); ?></option>
                                            <?php
                                            }
                                        }
                                    }else{
                                    ?>
                                        <option>Tidak ada data</option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                            </div>
                            <div class="col-sm-8 font-weight-n" id="error1_2" style="padding-top:4px;font-weight:normal;"><strong>Super Admin Group</strong> tidak boleh sama dengan <strong>Admin Group</strong></div>
                            <div class="col-sm-8 font-weight-n" id="error3_2" style="padding-top:4px;font-weight:normal;"><strong>User Default Group</strong> tidak boleh sama dengan <strong>Admin Group</strong></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">User Default Group</label>
                            <div class="col-sm-2">
                                <select name="group3" id="combo3" class="form-control input-sm">
                                    <?php 
                                    if(count($groups)>0){
                                        foreach ($groups as $row_g){                                
                                            if($row_g['name'] == default_group()){
                                            ?>
                                                <option selected value="<?php echo $row_g['name']; ?>"><?php echo ucwords(str_replace('_', ' ', $row_g['name'])); ?></option>
                                            <?php
                                            }else{
                                            ?>
                                                <option value="<?php echo $row_g['name']; ?>"><?php echo ucwords(str_replace('_', ' ', $row_g['name'])); ?></option>
                                            <?php
                                            }
                                        }
                                    }else{
                                    ?>
                                        <option>Tidak ada data</option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                            </div>
                            <div class="col-sm-8 font-weight-n" id="error1_3" style="padding-top:4px;font-weight:normal;"><strong>Super Admin Group</strong> tidak boleh sama dengan <strong>User Default Group</strong></div>
                            <div class="col-sm-8 font-weight-n" id="error2_3" style="padding-top:4px;font-weight:normal;"><strong>Admin Group</strong> tidak boleh sama dengan <strong>User Default Group</strong></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Identity</label>
                            <div class="col-sm-2">
                                <select name="identity" class="form-control input-sm">
                                    <option value="email" <?php if(identity() == 'email'){echo 'selected';};?>>E-mail</option>
                                    <option value="username" <?php if(identity() == 'username'){echo 'selected';};?>>Username</option>
                                </select> 
                            </div>
                        </div>
                        <button id="submit" type="submit" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-floppy-o"></i> Simpan</button>
                    <?php 
                    echo form_close();
                    ?>   
                </div><!-- /.box-body -->
            </div><!-- /.box -->                            
        </div>
    </div>
    <script>
        jQuery.validator.addMethod("emailValid", function(value, element) {
          return this.optional(element) || /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value);
        }, "Anda belum mengisi email dengan benar");

        $("#form").validate({
            errorElement: "em",
            rules: {
                site_title: {
                    required: true
                },
                site_tagline: {
                    required: true
                },
                site_desc: {
                    required: true
                },
                site_email: {
                    required: true,
                    emailValid: true
                }
            }
        });
    </script>