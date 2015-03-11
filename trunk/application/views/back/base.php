<?php $this->load->view('back/partials/header'); ?>
<?php $this->load->view('back/partials/sidebar'); ?>
			<!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?php
                        if(!isset($primary_title)){
                            echo "Judul Utama";
                        }else{
                            echo $primary_title;    
                        }                        
                        ?>
                        <small>
                        <?php 
                        if(!isset($sub_primary_title)){
                            echo "Sub judul utama";
                        }else{
                            echo $sub_primary_title;    
                        }       
                        ?>
                        </small>
                    </h1>
                    <ol class="breadcrumb">
                        <!-- <i class="ion-ios7-home"></i> -->
                        <?php echo $this->breadcrumb->output()?>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                	<?php echo $layout_content; ?>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->	
<?php $this->load->view('back/partials/footer'); ?>