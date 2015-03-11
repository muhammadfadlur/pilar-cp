                    <div class="row">                    
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        Users
                                    </h3>
                                    <p>
                                        Users data for this application 
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios7-person"></i>
                                </div>
                                <a href="<?php echo site_url('auth/users');?>" class="small-box-footer">
                                    Enter <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        Groups
                                    </h3>
                                    <p>
                                        groups access for users
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios7-people"></i>
                                </div>
                                <a href="<?php echo site_url('auth/groups');?>" class="small-box-footer">
                                    Enter <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <?php 
                            if($this->ion_auth->in_group(array($this->config->item('super_admin_group', 'ion_auth')))){
                        ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        Role
                                    </h3>
                                    <p>
                                        Role groups aka index of controller  
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios7-locked"></i>
                                </div>
                                <a href="<?php echo site_url('auth/roles');?>" class="small-box-footer">
                                    Enter <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        Roles Category
                                    </h3>
                                    <p>
                                        This categories also as parent menu
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios7-locked-outline"></i>
                                </div>
                                <a href="<?php echo site_url('auth/roles_cat');?>" class="small-box-footer">
                                    Enter <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <?php 
                            }
                        ?>
                    </div><!-- /.row -->