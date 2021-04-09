<?php $activeTab = "certificate_management"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Human Resource</a></li>
        <li class="active">Certificate Requests</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/human_resource_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-certificate"></i><small> <?php echo $this->lang->line('manage_certificate'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content"> 
                <?php echo form_open_multipart(site_url('certificate/index'), array('name' => 'generate', 'id' => 'generate', 'class' => 'form-horizontal form-label-left'), ''); ?>
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group" style="margin-right:5px;"> 
                            <div><?php echo $this->lang->line('class'); ?></div>
                            <select  class="form-control col-md-7 col-xs-12"  name="class_id"  id="class_id" required="required">
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>  
                                <?php
							

								foreach($class as $obj ){ ?>
								<?php print_r($class); ?>
                                <option value="<?php echo $obj->class_id; ?>" <?php if(isset($class_id) && $class_id == $obj->class_id){ echo 'selected="selected"'; } ?>><?php echo $obj->name; ?></option>
                                <?php } ?> 
                            </select>
                            <div class="help-block"><?php echo form_error('class_id'); ?></div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group" style="margin-right:5px;"> 
                            <div><?php echo $this->lang->line('certificate'); ?> <?php echo $this->lang->line('type'); ?></div>
                            <select  class="form-control col-md-7 col-xs-12"  name="certificate_id"  id="certificate_id" required="required">
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>  
                                <?php foreach($certificates as $obj ){ ?>
                                <option value="<?php echo $obj->id; ?>" <?php if(isset($certificate_id) && $certificate_id == $obj->id){ echo 'selected="selected"'; } ?>><?php echo $obj->name; ?></option>
                                <?php } ?> 
                            </select>
                            <div class="help-block"><?php echo form_error('certificate_id'); ?></div>
                        </div>
                    </div>
                
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group"><br/>
                            <button id="send" type="submit" class="btn btn-info"><?php echo $this->lang->line('find'); ?></button>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            
             <div class="x_content">
                <div class="" data-example-id="togglable-tabs">                    
                    <ul  class="nav nav-tabs bordered">                 
                        <li  class="active"><a href="#tab_user_list" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-group"></i> <?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('list'); ?></a></li>                          
                    </ul>
                    <br/>
                     <div class="tab-content">
                        <div  class="tab-pane fade in active" id="tab_user_list" >
                           
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th><?php echo $this->lang->line('photo'); ?></th>                                                                    
                                        <th><?php echo $this->lang->line('name'); ?></th>
                                        <th><?php echo $this->lang->line('phone'); ?></th>
                                        <th><?php echo $this->lang->line('email'); ?></th>
                                        <th><?php echo $this->lang->line('created'); ?></th>                                            
                                        <th><?php echo $this->lang->line('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody id="fn_mark">   
                                    <?php
                                    $count = 1;
                                    if (isset($students) && !empty($students)) {
                                        ?>
                                        <?php foreach ($students as $obj) { ?>
                                         <?php  $student_id=$obj->student_id; ?>
                                            <tr>
                                                <td><?php echo $count++;  ?></td>
                                                <td>                                      
                                                 <img src="<?php echo $this->crud_model->get_image_url('student',$student_id);?>" alt="" width="60" />
												 
                                                </td>
                                                <td><?php echo ucfirst($obj->name); ?></td>
                                                <td><?php echo $obj->phone; ?></td>
                                                <td><?php echo $obj->email; ?></td>   
                                                <td><?php echo date('M j, Y', strtotime($obj->date_added)); ?></td>   
                                                <td>    
                                                    <?php if(has_permission(VIEW, 'certificate', 'certificate')){ ?>
                                                    <a target="_blank" href="<?php echo site_url('certificate/generate/'.$obj->student_id.'/'.$class_id .'/'.$certificate_id); ?>"  class="btn btn-success btn-xs"><i class="fa fa-certificate"> <?php echo $this->lang->line('generate'); ?></i></a>
                                                    <?php } ?>
                                                </td>   
                                            </tr>
                                        <?php } ?>
                                    <?php } ?> 

                                </tbody>
                            </table> 
                        </div> 
                        </div>
                 </div>
            </div>

            
        </div>
    </div>
</div>
</div>