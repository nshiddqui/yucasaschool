<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-pencil-square-o"></i><small> <?php echo $this->lang->line('reset_user_email'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">                 
                        <li  class="active"><a href="#tab_email_reset" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-envelope-o"></i> <?php echo $this->lang->line('reset_email'); ?></a></li>                          
                    </ul>
                    <br/>
                     <div class="tab-content">
                        <div  class="tab-pane fade in active" id="tab_email_reset" >
                            <div class="x_content">
                                <?php echo form_open(site_url('administrator/email'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                 <div class="item form-group"> 
                                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="role_id"><?php echo $this->lang->line('user'); ?> <?php echo $this->lang->line('type'); ?> <span class="required">*</span></label>
                                     <div class="col-md-6 col-sm-6 col-xs-12">
                                         <select  class="form-control col-md-12 col-xs-12"  name="role_id"  id="role_id" required="required" onchange="get_user_by_role(this.value, '');">
                                             <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                             <?php foreach($roles as $obj ){ ?>
                                             <option value="<?php echo $obj->id; ?>"><?php echo $obj->name; ?></option>
                                             <?php } ?>                                            
                                         </select>
                                         <div class="help-block"><?php echo form_error('role_id'); ?></div>
                                     </div>
                                 </div>

                                 <div class="item form-group display"> 
                                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo $this->lang->line('class'); ?> <span class="required">*</span></label>
                                     <div class="col-md-6 col-sm-6 col-xs-12">
                                         <select  class="form-control col-md-12 col-xs-12"  name="class_id"  id="class_id"  onchange="get_user('', this.value,'');">
                                             <option value="">--<?php echo $this->lang->line('select'); ?>--</option>  
                                             <?php foreach($classes as $obj ){ ?>
                                             <option value="<?php echo $obj->id; ?>" ><?php echo $obj->name; ?></option>
                                             <?php } ?> 
                                         </select>
                                         <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                     </div>
                                 </div>

                                 <div class="item form-group">  
                                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user_id"><?php echo $this->lang->line('user'); ?> <span class="required">*</span></label>
                                     <div class="col-md-6 col-sm-6 col-xs-12">
                                         <select  class="form-control col-md-12 col-xs-12"  name="user_id"  id="user_id" required="required" >
                                             <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                         
                                         </select>
                                         <div class="help-block"><?php echo form_error('user_id'); ?></div>
                                     </div>
                                 </div>
                                 <div class="item form-group">
                                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email"><?php echo $this->lang->line('email'); ?> <span class="required">*</span>
                                     </label>
                                     <div class="col-md-6 col-sm-6 col-xs-12">
                                         <input  class="form-control col-md-7 col-xs-12"  name="email"  id="email" value="" placeholder="<?php echo $this->lang->line('email'); ?>" required="required" type="email">
                                         <div class="help-block"><?php echo form_error('email'); ?></div>
                                     </div>
                                 </div>
                                 
                                 <div class="ln_solid"></div>
                                 <div class="form-group">
                                     <div class="col-md-6 col-md-offset-3">
                                         <a href="<?php echo site_url('administrator/user'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                         <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('update'); ?></button>
                                     </div>
                                 </div>
                                 <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
