<?php
$activeTab = "parent_and_gaurdians"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Student</a></li>
        <li class="active">Parent & Gaurdians</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/student_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-paw"></i><small> <?php echo $this->lang->line('manage_guardian'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    <?php if(($this->session->userdata('admin_login') == 1)){ ?>
                    <ul  class="nav nav-tabs bordered">
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_guardian_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('guardian'); ?> <?php echo $this->lang->line('list'); ?></a> </li>
                        <?php if(has_permission(ADD, 'guardian', 'guardian')){ ?>
                            <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_guardian"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('guardian'); ?></a> </li>                          
                        <?php } ?>
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_guardian"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> <?php echo $this->lang->line('guardian'); ?></a> </li>                          
                        <?php } ?> 
                        <?php if(isset($detail)){ ?>
                            <li  class="active"><a href="#tab_view_guardian"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> <?php echo $this->lang->line('guardian'); ?></a> </li>                          
                        <?php } ?> 
                    </ul>
                    <?php } ?>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_guardian_list" >
                            <?= form_open('') ?>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-3">
                                            <div class="item form-group">
                                                <label class="control-label" for="class_id"><?php echo $this->lang->line('class'); ?> <span class="required">*</span>
                                                </label>
                                                
                                                <?php $classes = $this->db->get('class')->result(); 
                                                     $class_id = isset($_POST['class_id'])?$_POST['class_id']:'';                         
                                                ?>
            
            
                                                    <select  class="form-control col-md-7 col-xs-12"  name="class_id"  id="search_class_id" required="required" onchange="return get_class_sections(this.value,'search')" >
                                                        <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                                        <?php foreach($classes as $obj ){ ?>
                                                        <option value="<?php echo $obj->class_id; ?>" <?= $class_id == $obj->class_id ? 'selected':''?>><?php echo $obj->name; ?></option>
                                                        <?php } ?>                                            
                                                    </select>
                                                    <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="item form-group">
                                                <label class="control-label" for="section_selector_holder"><?php echo $this->lang->line('section'); ?>
                                                </label>
                                                    <select  class="form-control col-md-7 col-xs-12"  name="section_id"  id="searchsection_selector_holder" onchange="return get_student_by_class_sections(this.value,'search')" >
                                                        <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                                        <?php
                                                        $section_id = isset($_POST['section_id'])?$_POST['section_id']:'';
                                                        if(!empty($class_id)){
                                                            $sections = $this->db->get_where('section',['class_id'=>$class_id])->result();
                                                            foreach($sections as $section){ 
                                                                ?>
                                                                <option value="<?= $section->section_id ?>" <?= $section->section_id == $section_id ? 'selected':'' ?>> <?= $section->name ?></option>
                                                            <?php }
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="help-block"><?php echo form_error('student_id'); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="item form-group">
                                                <label class="control-label" for="add_student_id"><?php echo $this->lang->line('student'); ?>
                                                </label>
                                                    <select  class="form-control col-md-7 col-xs-12"  name="student_id"  id="search_student_id"  >
                                                        <option value="">--<?php echo $this->lang->line('select'); ?>--</option>  
                                                        <?php
                                                        $student_id = isset($_POST['student_id'])?$_POST['student_id']:'';
                                                        if(!empty($class_id) && !empty($section_id)){
                                                            $this->db->join('enroll','enroll.student_id = student.student_id');
                                                            $students = $this->db->get_where('student',['enroll.class_id'=>$class_id,'enroll.section_id' => $section_id])->result();
                                                            foreach($students as $student){ 
                                                                ?>
                                                                <option value="<?= $student->student_id ?>" <?= $student->student_id == $student_id ? 'selected':'' ?>> <?= $student->name ?></option>
                                                            <?php }
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="help-block"><?php echo form_error('student_id'); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary" style="margin-top:30px">Get Data</button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <?= form_close();?>
                            <div class="x_content">
                            <table id="datatable-responsive" class="datatable table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                       
                                        <th><?php echo $this->lang->line('photo'); ?></th>
                                        <th><?php echo $this->lang->line('name'); ?></th>
                                        <th>Student Name</th>
                                        <th><?php echo $this->lang->line('relation'); ?></th>
                                        <th><?php echo $this->lang->line('phone'); ?></th>
                                        <th><?php echo $this->lang->line('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                
                                <tbody>   
                                    <?php  $count = 1; if(isset($guardians) && !empty($guardians)){ ?>
                                        <?php foreach($guardians as $obj){ ?>
                                        <tr>

                                          
                                            <td>
                                                <?php  if($obj->photo != ''){ ?>
                                                <img src="<?php echo UPLOAD_PATH; ?>/guardian-photo/<?php echo $obj->photo; ?>" alt="" width="70" /> 
                                                <?php }else{ ?>
                                                <img src="<?php echo IMG_URL; ?>/default-user.png" alt="" width="70" /> 
                                                <?php } ?>
                                            </td>
											
                                            <td><?php echo ucfirst($obj->name); ?></td>
                                           
			

			
                                            <td><?php echo @$this->db->get_where('student',array('student_id' => $obj->student_id))->row()->name; ?></td>
                                            <td><?php echo $obj->relation; ?></td>
                                            <td><?php echo $obj->phone; ?></td>
                                            <td>
                                                <?php if($this->session->userdata('admin_login') == 1){?>
                                               <div class="btn-group">
                                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    Action <span class="caret"></span></button>

                                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                                        <li>
                                                        <?php if(has_permission(EDIT, 'guardian', 'guardian')){ ?>
                                                            <a href="<?php echo site_url('guardian/edit/'.$obj->id); ?>" ><i class="entypo-pencil"></i> <?php echo $this->lang->line('edit'); ?> </a>
                                                        <?php } ?>
                                                        </li>
                                                        <li>
                                                        <?php if(has_permission(VIEW, 'guardian', 'guardian')){ ?>
                                                          

                                                             <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/get-single-guardian/'.$obj->id);?>');">
                                                             <i class="fa fa-eye"></i>&nbsp; <?php echo $this->lang->line('view'); ?> </a>
                                                        <?php } ?>
                                                        </li>

                                                         <li class="divider"></li>

                                                         <li>
                                                             <?php if(has_permission(DELETE, 'guardian', 'guardian')){ ?>
                                                                <a href="<?php echo site_url('guardian/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" ><i class="entypo-trash"></i> <?php echo $this->lang->line('delete'); ?> </a>
                                                            <?php } ?>
                                                         </li>
                                                    </ul>
                                                </div>
                                                <?php } else { ?>
                                                     <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/get-single-guardian/'.$obj->id);?>');">
                                                             <i class="fa fa-eye"></i>&nbsp; <?php echo $this->lang->line('view'); ?> </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php $count++;?>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_guardian">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('guardian/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                               
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo $this->lang->line('basic'); ?> <?php echo $this->lang->line('information'); ?>:</strong></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="name"><?php echo $this->lang->line('name'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="name"  id="name" value="<?php echo isset($post['name']) ?  $post['name'] : ''; ?>" placeholder="<?php echo $this->lang->line('name'); ?>" required="required" type="text">
                                            <div class="help-block"><?php echo form_error('name'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="phone"><?php echo $this->lang->line('phone'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="phone"  id="phone" value="<?php echo isset($post['phone']) ?  $post['phone'] : ''; ?>" placeholder="<?php echo $this->lang->line('phone'); ?>" required="required" type="text">
                                            <div class="help-block"><?php echo form_error('phone'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="profession"><?php echo $this->lang->line('profession'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="profession"  id="profession" value="<?php echo isset($post['profession']) ?  $post['profession'] : ''; ?>" placeholder="<?php echo $this->lang->line('profession'); ?>" required="required" type="text">
                                            <div class="help-block"><?php echo form_error('profession'); ?></div>
                                        </div>
                                    </div>
                                   <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="relation"> <?php echo $this->lang->line('relation'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="relation"  id="relation" value="" placeholder="<?php echo $this->lang->line('relation'); ?>" required="required" type="text">
                                            <div class="help-block"><?php echo form_error('relation'); ?></div>
                                        </div>
                                    </div>
                                   
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-3">
                                            <div class="item form-group">
                                                <label class="control-label" for="class_id"><?php echo $this->lang->line('class'); ?> <span class="required">*</span>
                                                </label>
                                                
                                                <?php $classes = $this->db->get('class')->result(); 
                                                                              
                                                ?>
            
            
                                                    <select  class="form-control col-md-7 col-xs-12"  name="class_id"  id="add_class_id" required="required" onchange="return get_class_sections(this.value,'add')" >
                                                        <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                                        <?php foreach($classes as $obj ){ ?>
                                                        <option value="<?php echo $obj->class_id; ?>" ><?php echo $obj->name; ?></option>
                                                        <?php } ?>                                            
                                                    </select>
                                                    <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="item form-group">
                                                <label class="control-label" for="section_selector_holder"><?php echo $this->lang->line('section'); ?> <span class="required">*</span>
                                                </label>
                                                    <select  class="form-control col-md-7 col-xs-12"  name="section_id"  id="addsection_selector_holder" onchange="return get_student_by_class_sections(this.value,'add')" required="required" >
                                                        <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                      
                                                    </select>
                                                    <div class="help-block"><?php echo form_error('student_id'); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="item form-group">
                                                <label class="control-label" for="add_student_id"><?php echo $this->lang->line('student'); ?> <span class="required">*</span>
                                                </label>
                                                    <select  class="form-control col-md-7 col-xs-12"  name="student_id"  id="add_student_id" required="required" >
                                                        <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                      
                                                    </select>
                                                    <div class="help-block"><?php echo form_error('student_id'); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="item form-group">
                                            <label for="present_address"><?php echo $this->lang->line('present'); ?> <?php echo $this->lang->line('address'); ?></label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="present_address"  id="present_address" placeholder="<?php echo $this->lang->line('present'); ?> <?php echo $this->lang->line('address'); ?>"><?php echo isset($post['present_address']) ?  $post['present_address'] : ''; ?></textarea>
                                            <div class="help-block"><?php echo form_error('present_address'); ?></div>
                                        </div>
                                    </div>
                                  
                                    
                                </div>
                       
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo $this->lang->line('other'); ?> <?php echo $this->lang->line('information'); ?>:</strong></h5>
                                    </div>
                                </div>
                                <div class="row">
                                     
                                      <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="photo"><?php echo $this->lang->line('guardian'); ?> <?php echo $this->lang->line('photo'); ?> </label>
                                            <div class="btn btn-default btn-file">
                                                <i class="fa fa-paperclip"></i> <?php echo $this->lang->line('upload'); ?>
                                                <input  class="form-control col-md-7 col-xs-12"  name="photo"  id="photo" type="file">
                                            </div>
                                            <div class="text-info"><?php echo $this->lang->line('valid_file_format_img'); ?></div>
                                            <div class="help-block"><?php echo form_error('photo'); ?></div>
                                        </div>
                                    </div>
                                    
                                </div>
                          
                                
                                
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('guardian'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  

                        <?php if(isset($edit)){ ?>
                        
                        <div class="tab-pane fade in active" id="tab_edit_guardian">
                            <div class="x_content"> 
                            <?php echo form_open_multipart(site_url('guardian/edit/'. $guardian->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo $this->lang->line('basic'); ?> <?php echo $this->lang->line('information'); ?>:</strong></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="name"><?php echo $this->lang->line('name'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="name"  id="name" value="<?php echo isset($guardian->name) ?  $guardian->name : ''; ?>" placeholder="<?php echo $this->lang->line('name'); ?>" required="required" type="text">
                                            <div class="help-block"><?php echo form_error('name'); ?></div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="phone"><?php echo $this->lang->line('phone'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="phone"  id="phone" value="<?php echo isset($guardian->phone) ?  $guardian->phone : ''; ?>" placeholder="<?php echo $this->lang->line('phone'); ?>" required="required" type="text">
                                            <div class="help-block"><?php echo form_error('phone'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="profession"><?php echo $this->lang->line('profession'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="profession"  id="profession" value="<?php echo isset($guardian->profession) ?  $guardian->profession : ''; ?>" placeholder="<?php echo $this->lang->line('profession'); ?>" required="required" type="text">
                                            <div class="help-block"><?php echo form_error('profession'); ?></div>
                                        </div>
                                    </div>
                                   <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-3">
                                            <div class="item form-group">
                                                <label class="control-label" for="class_id"><?php echo $this->lang->line('class'); ?> <span class="required">*</span>
                                                </label>
                                                
                                                <?php $classes = $this->db->get('class')->result();                         
                                                ?>
            
            
                                                    <select  class="form-control col-md-7 col-xs-12"  name="class_id"  id="edit_class_id" required="required" onchange="return get_class_sections(this.value,'edit')" >
                                                        <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                                        <?php foreach($classes as $obj ){ ?>
                                                        <option value="<?php echo $obj->class_id; ?>" <?= $guardian->class_id == $obj->class_id ? 'selected':''?>><?php echo $obj->name; ?></option>
                                                        <?php } ?>                                            
                                                    </select>
                                                    <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="item form-group">
                                                <label class="control-label" for="section_selector_holder"><?php echo $this->lang->line('section'); ?>
                                                </label>
                                                    <select  class="form-control col-md-7 col-xs-12"  name="section_id"  id="editsection_selector_holder" onchange="return get_student_by_class_sections(this.value,'edit')" >
                                                        <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                                        <?php
                                                        if(!empty($guardian->class_id)){
                                                            $sections = $this->db->get_where('section',['class_id'=>$guardian->class_id])->result();
                                                            foreach($sections as $section){ 
                                                                ?>
                                                                <option value="<?= $section->section_id ?>" <?= $section->section_id == $guardian->section_id ? 'selected':'' ?>> <?= $section->name ?></option>
                                                            <?php }
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="help-block"><?php echo form_error('student_id'); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="item form-group">
                                                <label class="control-label" for="add_student_id"><?php echo $this->lang->line('student'); ?>
                                                </label>
                                                    <select  class="form-control col-md-7 col-xs-12"  name="student_id"  id="edit_student_id"  >
                                                        <option value="">--<?php echo $this->lang->line('select'); ?>--</option>  
                                                        <?php
                                                        if(!empty($guardian->student_id)){
                                                            $this->db->join('enroll AS E', 'E.student_id = student.student_id');
                                                            $students = $this->db->get_where('student',['E.section_id'=>$guardian->section_id,'E.class_id'=>$guardian->class_id])->result();
                                                            foreach($students as $student){ 
                                                                ?>
                                                                <option value="<?= $student->student_id ?>" <?= $student->student_id == $guardian->student_id ? 'selected':'' ?>> <?= $student->name ?></option>
                                                            <?php }
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="help-block"><?php echo form_error('student_id'); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary" style="margin-top:30px">Get Data</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="present_address"><?php echo $this->lang->line('present'); ?> <?php echo $this->lang->line('address'); ?></label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="present_address"  id="present_address" placeholder="<?php echo $this->lang->line('present'); ?> <?php echo $this->lang->line('address'); ?>"><?php echo isset($guardian->present_address) ?  $guardian->present_address : ''; ?></textarea>
                                            <div class="help-block"><?php echo form_error('present_address'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="relation"> <?php echo $this->lang->line('relation'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="relation"  id="relation" value="<?php echo isset($guardian->relation) ?  $guardian->relation : ''; ?>" placeholder="<?php echo $this->lang->line('relation'); ?>" required="required" type="text">
                                            <div class="help-block"><?php echo form_error('relation'); ?></div>
                                        </div>
                                    </div>
                                 
                                    
                                </div>
                       
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo $this->lang->line('other'); ?> <?php echo $this->lang->line('information'); ?>:</strong></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    
                                    
                                     

                                      <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="photo"><?php echo $this->lang->line('guardian'); ?> <?php echo $this->lang->line('photo'); ?> </label>
                                            <div class="btn btn-default btn-file">
                                                <i class="fa fa-paperclip"></i> <?php echo $this->lang->line('upload'); ?>
                                                <input  class="form-control col-md-7 col-xs-12"  name="photo"  id="photo" type="file">
                                            </div>
                                            <div class="text-info"><?php echo $this->lang->line('valid_file_format_img'); ?></div>
                                            <div class="help-block"><?php echo form_error('photo'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <input type="hidden" name="prev_photo" id="prev_photo" value="<?php echo $guardian->photo; ?>" />
                                            <?php if($guardian->photo){ ?>
                                            <img src="<?php echo UPLOAD_PATH; ?>/guardian-photo/<?php echo $guardian->photo; ?>" alt="" width="70" /><br/><br/>
                                            <?php } ?>
                                        </div>
                                    </div>
                                     
                                </div>
                          
                                
                                
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" name="id" id="id" value="<?php echo $guardian->id; ?>" />
                                        <a href="<?php echo site_url('guardian'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-info"><?php echo $this->lang->line('upload'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  
                        
                        <?php } ?>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bs-guardian-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo $this->lang->line('guardian'); ?> <?php echo $this->lang->line('information'); ?></h4>
        </div>
        <div class="modal-body fn_guardian_data">
            
        </div>       
      </div>
    </div>
</div>
</div>

<div class="modal fade bs-student-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('information'); ?></h4>
        </div>
        <div class="modal-body fn_student_data">
            
        </div>       
      </div>
    </div>
</div>

<script>
    function get_class_sections(class_id,type = '') {
        
    	$.ajax({
            url: '<?php echo site_url('admin/get_class_section/');?>' + class_id ,
            success: function(response)
            {
                jQuery('#'+type+'section_selector_holder').html(response);
            }
        });

    }
    
    function get_student_by_class_sections(section_id,type='') {
        var class_id = $('#'+type+'_class_id').val();
        if(class_id=='' || section_id==''){
            jQuery('#'+type+'_student_id').html('<option value="">Select</option>');
        }
    	$.ajax({
            url: '<?php echo site_url('admin/get_students_for_ssph/');?>' + class_id+'/'+section_id ,
            success: function(response)
            {
                jQuery('#'+type+'_student_id').html(response);
            }
        });

    }
</script>