<?php 
if (!$this->ion_auth->logged_in()){
    $user ='';
    $user_groups='';
}else{
    $user = $this->ion_auth->user()->row();
    $user_groups = $this->ion_auth->get_users_groups()->result();    
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="robots" content="noindex">
        <meta charset="UTF-8">
        <title><?php echo $layout_title; ?><?php echo $this->config->item('site_title', 'ion_auth'); ?></title>
        <meta name="description" content="<?php echo $meta_desc; ?>"/>
        
        <link href="<?php echo base_url('themes/back/bundle/bootstrap/css/bootstrap.css');?>" rel="stylesheet"/>
        <link href="<?php echo base_url('themes/general/bundle/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet"/>
        <link href="<?php echo base_url('themes/general/bundle/ionicons/css/ionicons.min.css');?>" rel="stylesheet"/>
        <link href="<?php echo base_url('themes/back/bundle/radiocheck/radiocheck.css');?>" rel="stylesheet"/>

        <?php 
            if(isset($layout_includes['css']) AND count($layout_includes['css']) > 0):
                foreach($layout_includes['css'] as $css): 
        ?>
        <link rel="stylesheet" href="<?php echo $css['file']; ?>"<?php echo ($css['options'] === NULL ? '' : ' media="' . $css['options'] . '"'); ?>>
        <?php 
                endforeach;
            endif; 
        ?>
        <link href="<?php echo base_url('themes/back/css/admin.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('themes/back/css/rai.css');?>" rel="stylesheet" type="text/css" />

        <script src="<?php echo base_url('themes/general/js/jquery-2.1.3.min.js');?>"></script>
        <script src="<?php echo base_url('themes/back/bundle/filestyle/filestyle.min.js');?>"></script>
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="<?php echo base_url('themes/back/bundle/ie/html5shiv.js');?>"></script>
          <script src="<?php echo base_url('themes/back/bundle/ie/respond.min.js');?>"></script>
        <![endif]-->
        <?php if(isset($layout_includes['js']) AND count($layout_includes['js']) > 0): ?>
	        <?php foreach($layout_includes['js'] as $js): ?>
	            <?php if($js['options'] !== NULL AND $js['options'] == 'header'): ?>
	                <script src="<?php echo $js['file']; ?>"></script>
	            <?php endif; ?>
	        <?php endforeach; ?>
	    <?php endif; ?>        
        <link rel="shortcut icon" href="<?php echo base_url('themes/back/img/user.png');?>"/>
    </head>
    <body class="skin-black fixed pace-done">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="<?php echo site_url('admin')?>" class="logo" title="Beranda">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <i class="fa fa-dot-circle-o"></i> Admin page
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <span class="sub_logo"><?php echo $this->config->item('site_title', 'ion_auth').' &bull; '.$this->config->item('site_tagline', 'ion_auth');?></span>
                <div class="navbar-right">
                    <ul class="nav navbar-nav"> 
                        <?php if($this->ion_auth->in_group($this->config->item('super_admin_group','ion_auth'))){?>
                        <li class="dropdown tasks-menu <?php if($this->uri->segment(1) == 'settings'){echo 'current';}?>">
                            <a href="<?php echo site_url('settings');?>">
                                <i class="fa fa-gear"></i>
                            </a>
                        </li>
                        <?php }?>                    
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu <?php if($this->uri->segment(1) == 'auth'){echo 'current';}?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>
                                <?php 
                                if (!$this->ion_auth->logged_in()){
                                    echo 'Anda belum Login';                                    
                                }else{
                                    echo $user->last_name;
                                }
                                ?> 
                                <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?php echo base_url('themes/back/img/user.png');?>" class="img-circle" alt="User Image" />
                                    <p>                                       
                                        <?php
                                        if (!$this->ion_auth->logged_in()){
                                            echo 'Anda belum Login';                                            
                                        }else{
                                            echo $user->last_name;
                                            if ($this->ion_auth->in_group(array($this->config->item('super_admin_group', 'ion_auth'),$this->config->item('admin_group', 'ion_auth')))){
                                        ?>                                        
                                        <small><a href="<?php echo site_url('auth')?>" title="Autentikasi pengguna aplikasi ini"><i class="fa fa-key"></i> Autentikasi</a></small>
                                        <?php
                                        }}
                                        ?> 
                                        <small>
                                        <?php
                                            foreach ($user_groups as $value) {
                                                echo ucwords(str_replace('_', ' ', $value->name)).' ';
                                            }
                                        ?>
                                        </small>                                       
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo site_url('me')?>" class="btn btn-default btn-flat">Profil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo site_url('logout')?>" class="btn btn-default btn-flat">Keluar</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">