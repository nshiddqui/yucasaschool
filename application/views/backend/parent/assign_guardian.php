<?php $activeTab = "guardian_manage"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Guardian</a></li>
        <li class="active">Assign Guardian</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/parent/guardian_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
               
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
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
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_guardian_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Guardians ID</th>
                                        <th><?php echo $this->lang->line('photo'); ?></th>
                                        <th><?php echo $this->lang->line('name'); ?></th>
                                        <th>Student Name</th>
                                        <th><?php echo $this->lang->line('relation'); ?></th>
                                        <th>Assign Date </th>
                                        <th>Expiry  Date </th>
                                        
                                        <th><?php echo $this->lang->line('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php  $count = 1; if(isset($guardians) && !empty($guardians)){ ?>
                                        <?php foreach($guardians as $obj){ ?>
                                     
                                        <tr>

                                            <td>
											<?php  if($obj->doc_photo != ''){ ?>
                                                <img src="<?php echo UPLOAD_PATH; ?>/guardian-photo/<?php echo $obj->doc_photo; ?>" onclick="view('<?php echo UPLOAD_PATH; ?>/guardian-photo/<?php echo $obj->doc_photo; ?>')" alt="" width="70" /> 
                                                <?php }else{ ?>
                                                <img src="<?php echo IMG_URL; ?>no-document.jpg"  alt="" width="70" /> 
                                                <?php } ?></td>
                                            
											<td>
                                                <?php  if($obj->photo != ''){ ?>
                                                <img src="<?php echo UPLOAD_PATH; ?>/guardian-photo/<?php echo $obj->photo; ?>" alt="" width="70" /> 
                                                <?php }else{ ?>
                                                <img src="<?php echo IMG_URL; ?>default-user.png"  alt="" width="70" /> 
                                                <?php } ?>
                                            </td>

                                            <td><?php echo $obj->guardians_name; ?></td>
                                        
                                            <td><?php echo ucfirst($obj->student); ?></td>
                                            <td><?php echo $obj->relation; ?></td>
                                            <td><?php $date1= $obj->date_from;
											 $date = new DateTime($date1);
												echo $date->format('d.M.Y'); ?>
											</td>
                                            <td><?php $date12= $obj->date_to;  $date2 = new DateTime($date12);
												echo $date2->format('d.M.Y'); ?></td>
                                            
                                            <td>

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
                                                            <!--<a  onclick="get_guardian_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-guardian-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?></a>-->

                                                             <a  onclick='showAjaxModal("<?php echo site_url('modal/popup/get-single-guardian/'.$obj->guardians_id);?>");'  ><i class="fa fa-eye"></i>&nbsp; <?php echo $this->lang->line('view'); ?> </a>
                                                             
                                                        <?php } ?>
                                                        </li>

                                                         <li class="divider"></li>

                                                         <li>
                                                             <?php if(has_permission(DELETE, 'guardian', 'guardian')){ ?>
                                                                <a href="<?php echo site_url('guardian/assign_delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" ><i class="entypo-trash"></i> <?php echo $this->lang->line('delete'); ?> </a>
                                                            <?php } ?>
                                                         </li>
                                                    </ul>
                                                </div>

                                                <!-- <a href="#" onclick="parent_delete_confirm(1)"><i class="entypo-trash"></i>&nbsp;Delete</a> -->
                                              
                                                
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
						
							<?php echo form_open(site_url('/parents/assign_guardian_add/') , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('select_student');?></label>

						<div class="col-sm-5">
							<select name="select_student" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
							   <?php
                $children_of_parent = $this->db->get_where('student' , array(
                    'parent_id' => $this->session->userdata('parent_id')
                ))->result_array();
                foreach ($children_of_parent as $row):
            ?>
                              <option value="<?php echo $row['student_id'];?>"><?php echo $row['name'];?></option>
                        <?php endforeach;?>     
                          </select>
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('select_guardian');?></label>

						<div class="col-sm-5">
							<select name="select_guardian" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
							   <?php
                $children_of_parent = $this->db->get_where('guardians' , array(
                    'created_by' => $this->session->userdata('parent_id'),'role_id'=> 8
                ))->result_array();
                foreach ($children_of_parent as $row):
            ?>
                             <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                            <?php endforeach;?>    
                          </select>
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('from_date');?></label>

						<div class="col-sm-5">
							<input type="date" class="form-control"  name="from_date"  data-validate="required" id="class_id"
								data-message-required="<?php echo get_phrase('value_required');?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('to_date');?></label>

						<div class="col-sm-5">
							<input type="date" class="form-control"  name="to_date"  data-validate="required" id="class_id"
								data-message-required="<?php echo get_phrase('value_required');?>">
						</div>
					</div>

					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('emergency_phone');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="phone" value="" >
						</div>
					</div>

					
					
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('assign_guardian');?></button>
						</div>
					</div>
                <?php echo form_close();?>
                               <!--<?php echo form_open_multipart(site_url('guardian/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                               
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
                                            <label for="student"><?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('student'); ?> <span class="required">*</span> </label>
                                             <select  class="form-control col-md-7 col-xs-12 select2" name="student_id" id="role_id" required="required">

                                            <?php
                                            $student = $this->db->get('student')->result_array();
                                            foreach($student as $row):
                                                ?>
                                              <option value="<?php echo $row['student_id'];?>">
                                              <?php echo $row['name'];?>(<?php echo $row['student_code'];?>)
                                              </option>
                                            <?php 
                                             endforeach;
                                            ?>
                                            </select>
                                            <div class="help-block"><?php echo form_error('religion'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="present_address"><?php echo $this->lang->line('present'); ?> <?php echo $this->lang->line('address'); ?></label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="present_address"  id="present_address" placeholder="<?php echo $this->lang->line('present'); ?> <?php echo $this->lang->line('address'); ?>"><?php echo isset($post['present_address']) ?  $post['present_address'] : ''; ?></textarea>
                                            <div class="help-block"><?php echo form_error('present_address'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="permanent_address"><?php echo $this->lang->line('permanent'); ?> <?php echo $this->lang->line('address'); ?></label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="permanent_address"  id="permanent_address" placeholder="<?php echo $this->lang->line('permanent'); ?> <?php echo $this->lang->line('address'); ?>"><?php echo isset($post['permanent_address']) ?  $post['permanent_address'] : ''; ?></textarea>
                                            <div class="help-block"><?php echo form_error('permanent_address'); ?></div>
                                        </div>
                                    </div>
                                    
                                </div>
                       
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo $this->lang->line('academic'); ?> <?php echo $this->lang->line('information'); ?>:</strong></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="national_id"><?php echo $this->lang->line('national_id'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="national_id"  id="national_id" value="<?php echo isset($post['national_id']) ?  $post['national_id'] : ''; ?>" placeholder="<?php echo $this->lang->line('national_id'); ?>"  type="text">
                                            <div class="help-block"><?php echo form_error('national_id'); ?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="role_id"><?php echo $this->lang->line('role'); ?> <span class="required">*</span></label>
                                            <select  class="form-control col-md-7 col-xs-12" name="role_id" id="role_id" required="required">
                                            <?php foreach($rolesdata as $obj){ ?>
                                                <?php if(in_array($obj->id, array(GUARDIAN))){ ?>
                                                <option value="<?php echo $obj->id; ?>"><?php echo $obj->name; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                            </select>
                                            <div class="help-block"><?php echo form_error('role_id'); ?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="email"><?php echo $this->lang->line('email'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="email"  id="email" value="<?php echo isset($post['email']) ?  $post['email'] : ''; ?>" placeholder="<?php echo $this->lang->line('email'); ?>" required="email" type="email">
                                            <div class="help-block"><?php echo form_error('email'); ?></div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="password"><?php echo $this->lang->line('password'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="password"  id="password" value="" placeholder="<?php echo $this->lang->line('password'); ?>" required="required" type="text">
                                            <div class="help-block"><?php echo form_error('password'); ?></div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="relation"> <?php echo $this->lang->line('relation'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="relation"  id="relation" value="" placeholder="<?php echo $this->lang->line('relation'); ?>" required="required" type="text">
                                            <div class="help-block"><?php echo form_error('relation'); ?></div>
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="docuemnt_photo">Document Photo</label>
                                            <div class="btn btn-default btn-file">
                                                <i class="fa fa-paperclip"></i> <?php echo $this->lang->line('upload'); ?>
                                                <input  class="form-control col-md-7 col-xs-12"  name="photo"  id="photo" type="file">
                                            </div>
                                            <div class="text-info"><?php echo $this->lang->line('valid_file_format_img'); ?></div>
                                            <div class="help-block"><?php echo form_error('photo'); ?></div>
                                        </div>
                                    </div>
                                    
                                </div>
                          
                                
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo $this->lang->line('other'); ?> <?php echo $this->lang->line('information'); ?>:</strong></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="other_info"><?php echo $this->lang->line('other_info'); ?> </label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="other_info"  id="other_info" placeholder="<?php echo $this->lang->line('other_info'); ?>"><?php echo isset($post['other_info']) ?  $post['other_info'] : ''; ?></textarea>
                                            <div class="help-block"><?php echo form_error('other_info'); ?></div>
                                        </div>
                                    </div>
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
								
								
								-->
								
								
                            </div>
                        </div>  

                        <?php if(isset($edit)){ ?>
                        
                        <div class="tab-pane fade in active" id="tab_edit_guardian">
                            <div class="x_content"> 
							<?php echo form_open(site_url('/parents/assign_guardians/') , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('select_student');?></label>

						<div class="col-sm-5">
							<select name="select_student" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
							   <?php
                $children_of_parent = $this->db->get_where('student' , array(
                    'parent_id' => $this->session->userdata('parent_id')
                ))->result_array();
                foreach ($children_of_parent as $row):
            ?>
                              <option value="<?php echo $row['student_id'];?>"><?php echo $row['name'];?></option>
                        <?php endforeach;?>     
                          </select>
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('select_guardian');?></label>

						<div class="col-sm-5">
							<select name="select_guardian" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
							   <?php
                $children_of_parent = $this->db->get_where('guardians' , array(
                    'created_by' => $this->session->userdata('parent_id'),'role_id'=> 8
                ))->result_array();
                foreach ($children_of_parent as $row):
            ?>
                             <option value="<?php echo $row['student_id'];?>"><?php echo $row['name'];?></option>
                            <?php endforeach;?>    
                          </select>
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('from_date');?></label>

						<div class="col-sm-5">
							<input type="date" class="form-control"  name="student_code"  data-validate="required" id="class_id"
								data-message-required="<?php echo get_phrase('value_required');?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('to_date');?></label>

						<div class="col-sm-5">
							<input type="date" class="form-control"  name="student_code"  data-validate="required" id="class_id"
								data-message-required="<?php echo get_phrase('value_required');?>">
						</div>
					</div>

					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('emergency_phone');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="phone" value="" >
						</div>
					</div>

					
					
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('assign_guardian');?></button>
						</div>
					</div>
                <?php echo form_close();?>
							<!--
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
                                   
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                          <div class="item form-group">
                                            <label for="student"><?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('student'); ?> <span class="required">*</span> </label>
                                             <select  class="form-control col-md-7 col-xs-12 select2" name="student_id" id="role_id" required="required">

                                            <?php
                                            $student = $this->db->get('student')->result_array();
                                            foreach($student as $row):
                                                ?>
                                              <option value="<?php echo $row['student_id'];?>" <?php echo ($row['student_id'] == $guardian->student_id) ? 'selected' : ''; ?>>
                                              <?php echo $row['name'];?>(<?php echo $row['student_code'];?>)
                                              </option>
                                            <?php 
                                             endforeach;
                                            ?>
                                            </select>
                                            <div class="help-block"><?php echo form_error('religion'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="present_address"><?php echo $this->lang->line('present'); ?> <?php echo $this->lang->line('address'); ?></label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="present_address"  id="present_address" placeholder="<?php echo $this->lang->line('present'); ?> <?php echo $this->lang->line('address'); ?>"><?php echo isset($guardian->present_address) ?  $guardian->present_address : ''; ?></textarea>
                                            <div class="help-block"><?php echo form_error('present_address'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="permanent_address"><?php echo $this->lang->line('permanent'); ?> <?php echo $this->lang->line('address'); ?></label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="permanent_address"  id="permanent_address" placeholder="<?php echo $this->lang->line('permanent'); ?> <?php echo $this->lang->line('address'); ?>"><?php echo isset($guardian->permanent_address) ?  $guardian->permanent_address : ''; ?></textarea>
                                            <div class="help-block"><?php echo form_error('permanent_address'); ?></div>
                                        </div>
                                    </div>
                                    
                                </div>
                       
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo $this->lang->line('academic'); ?> <?php echo $this->lang->line('information'); ?>:</strong></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="national_id"><?php echo $this->lang->line('national_id'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="national_id"  id="national_id" value="<?php echo isset($guardian->national_id) ?  $guardian->national_id : ''; ?>" placeholder="<?php echo $this->lang->line('national_id'); ?>"  type="text">
                                            <div class="help-block"><?php echo form_error('national_id'); ?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="role_id"><?php echo $this->lang->line('role'); ?> <span class="required">*</span></label>
                                            <select  class="form-control col-md-7 col-xs-12" name="role_id" id="role_id" required="required">
                                            <?php foreach($rolesdata as $obj){ ?>
                                                <?php if(in_array($obj->id, array(GUARDIAN))){ ?>
                                                    <option value="<?php echo $obj->id; ?>" <?php if($guardian->role_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                            </select>
                                            <div class="help-block"><?php echo form_error('role_id'); ?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="email"><?php echo $this->lang->line('email'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="email"  readonly="readonly"  id="email" value="<?php echo isset($guardian->email) ?  $guardian->email : ''; ?>" placeholder="<?php echo $this->lang->line('email'); ?>" required="email" type="email">
                                            <div class="help-block"><?php echo form_error('email'); ?></div>
                                        </div>
                                    </div>
                                

                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="relation"> <?php echo $this->lang->line('relation'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="relation"  id="relation" value="<?php echo isset($guardian->relation) ?  $guardian->relation : ''; ?>" placeholder="<?php echo $this->lang->line('relation'); ?>" required="required" type="text">
                                            <div class="help-block"><?php echo form_error('relation'); ?></div>
                                        </div>
                                    </div>
                                  
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="docuemnt_photo">Document Photo</label>
                                            <div class="btn btn-default btn-file">
                                                <i class="fa fa-paperclip"></i> <?php echo $this->lang->line('upload'); ?>
                                                <input  class="form-control col-md-7 col-xs-12"  name="photo"  id="photo" type="file">
                                            </div>
                                            <div class="text-info"><?php echo $this->lang->line('valid_file_format_img'); ?></div>
                                            <div class="help-block"><?php echo form_error('photo'); ?></div>
                                        </div>
                                    </div>
                                     
                                </div>
                          
                                
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo $this->lang->line('other'); ?> <?php echo $this->lang->line('information'); ?>:</strong></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="other_info"><?php echo $this->lang->line('other_info'); ?> </label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="other_info"  id="other_info" placeholder="<?php echo $this->lang->line('other_info'); ?>"><?php echo isset($guardian->other_info) ?  $guardian->other_info : ''; ?></textarea>
                                            <div class="help-block"><?php echo form_error('other_info'); ?></div>
                                        </div>
                                    </div>
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
                                <?php echo form_close(); ?> -->
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

<script type="text/javascript">
   function view(imgsrc) {
      viewwin = window.open(imgsrc,'viewwin', 'width=600,height=300'); 
   }
</script>







		