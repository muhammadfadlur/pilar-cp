            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title"><?php echo lang('deactivate_heading');?></h3>
                        </div><!-- /.box-header -->
                        <?php echo form_open(current_url(), array('role' => 'form'));?>
                        <div class="box-body">
	                        <div class="callout callout-danger">
	                            <h4><?php echo sprintf(lang('deactivate_subheading'), $user->username);?></h4>
	                            <?php echo form_open("auth/deactivate/".$user->id);?>
	                            
	                            <div class="radio radio-danger  radio-inline">
	                                <input type="radio" name="confirm" id="radio1" value="yes" checked="checked"/>
	                                <label for="radio1">
	                                    Yakin
	                                </label>
	                            </div>

	                            <div class="radio radio-danger radio-inline">
	                                <input type="radio" name="confirm" id="radio2" value="no" checked="checked"/>
	                                <label for="radio2">
	                                    Tidak
	                                </label>
	                            </div>
								<br/>
								<br/>
  								<?php echo form_hidden(array('id'=>$user->id)); ?>
  								<button type="submit" class="btn btn-sm btn-danger btn-flat"><span class="ion-ios7-loop-strong"></span> Proses</button>
	                        </div>
                        </div> 
                        <?php echo form_close();?>
                    </div><!-- /.box -->                            
                </div>
            </div>