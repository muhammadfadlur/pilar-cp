<?php 
    if (!$this->ion_auth->logged_in()){
        $user ='';
        $user_groups='';
    }else{
        $user = $this->ion_auth->user()->row();
        $user_groups = $this->ion_auth->get_users_groups()->result();  
    }
?>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li>
                            <a href="<?php echo site_url('admin')?>">
                                <i class="fa fa-home"></i> <span>Dashboard</span>
                            </a>
                        </li>
                       <?php $this->rule->sidebar_menu();?>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>