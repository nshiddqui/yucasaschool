<?php

$activeTab = "assignments"; 

?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Assignments</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>

</div>
<div class="modal fade" id="modal_ajax">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Yucasa</h4>
                </div>

                <div class="modal-body" style="height:500px; overflow:auto;">

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php if($this->session->userdata('student_login') != 1) { ?>
<div class="col-sm-12">
<div class="col-md-3 abcd">
    <div class="form-group">
        <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class'); ?></label>
        <select name="class_id" class="form-control selectboxit"  id = "class_selection">
            <option value=""><?php echo get_phrase('select_class'); ?></option>
            <?php
            $classes = $this->db->get('class')->result_array();
            foreach ($classes as $row): ?>
                 <option value="<?php echo $row['class_id']; ?>" <?php if($row['class_id'] == $class_id){echo 'selected';} ?>><?php echo $row['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<?php } ?>

<div class="col-md-2 top-first-btn">
  <button onclick="reload_url(); return false;" class="btn btn-info"><?php echo get_phrase('view_list'); ?></button>
    </div>
</div>


<?php if($class_id || $this->session->userdata('student_login') == 1){  ?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-file-word-o"></i><small> <?php echo $this->lang->line('manage_assignment'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
           
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_assignment_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap datatable" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th><?php echo $this->lang->line('assignment'); ?> <?php echo $this->lang->line('title'); ?></th>
                                        <th><?php echo $this->lang->line('class'); ?></th>
                                        <th><?php echo $this->lang->line('section'); ?></th>
                                        <th><?php echo $this->lang->line('subject'); ?></th>
                                        <th><?php echo $this->lang->line('deadline'); ?></th>
                                        <th><?php echo $this->lang->line('academic_year'); ?></th>
                                        <th><?php echo $this->lang->line('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($assignments) && !empty($assignments)){ ?>
                                                                                <?php
                                        // echo "<pre>";
                                        //  print_r($assignments);
                                        // echo "</pre>";

                                      foreach($assignments as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $obj->title; ?></td>
                                            <td><?php echo $obj->class_name; ?></td>
                                            <td><?php
                                            if(!empty($obj->section_id)){
                                            $section_val = $this->db->query("select name from section where section_id IN ($obj->section_id)")->result();
                                            $i =0;
                                                      foreach ($section_val as $key => $value_of_section) {
                                                        if($i>0)
                                                            echo ' , ';

                                                         echo $value_of_section->name;
                                                         
                                                        $i++;
                                                      }
                                            }
                                            ?></td>
                                            <td><?php echo $obj->subject; ?></td>
                                            <td><?php echo $obj->deadline; ?></td>
                                            <td><?php echo $obj->year; ?></td>
                                            <td>
                                                 <div class="btn-group">
                                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                                        Action <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                                        
                                                        <!-- EDITING LINK -->
                                                        <li>
                                                           <?php if(has_permission(EDIT, 'assignment', 'assignment')){ ?>
                                                                <a href="<?php echo site_url('assignment/edit/'.$obj->id); ?>" class=" "><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> </a>
                                                            <?php  } ?>
                                                                        </li>
                                                        <li class="divider"></li>
                                                        
                                                        <!-- DELETION LINK -->
                                                        <li>
                                                            <?php if(has_permission(VIEW, 'assignment', 'assignment')){ ?>
                                                            <a  href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/get_single_assignment/'.$obj->id);?>');"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> </a>
                                                            <?php if($obj->assignment){ ?>
                                                            <a target="_blank" href="<?php echo UPLOAD_PATH; ?>/assignment/<?php echo $obj->assignment ?>" class=""><i class="fa fa-download"></i> <?php echo $this->lang->line('download'); ?> </a>
                                                            <?php  } ?>
                                                        <?php  } ?>
                                                        </li> 

                                                        <li>
                                                            <?php if(has_permission(DELETE, 'assignment', 'assignment')){ ?>
                                                                <a href="<?php echo site_url('assignment/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class=""><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
                                                            <?php  } ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                             </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        

                        <div class="tab-pane fade in  <?php if(isset($edit)){ echo 'active'; }?>" id="tab_edit_assignment">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('assignment/edit/'.$assignment->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title"><?php echo $this->lang->line('assignment'); ?> <?php echo $this->lang->line('title'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="title"  id="title" value="<?php echo isset($assignment->title) ?  $assignment->title : $post['title']; ?>" placeholder="<?php echo $this->lang->line('assignment'); ?> <?php echo $this->lang->line('title'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('title'); ?></div>
                                    </div>
                                </div>
                                                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo $this->lang->line('class'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                       
                                        <select  class="form-control col-md-7 col-xs-12 quick-field"  name="class_id"  id="class_id" required="required" onchange="select_section(this.value, '', true);">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <?php foreach($classes as $obj ){

                                             ?>
                                            <option value="<?php echo $obj['class_id']; ?>" <?php if($assignment->class_id == $obj['class_id']){ echo 'selected="selected"';} ?>><?php echo $obj['name']; ?></option>
                                            <?php } ?>                                            
                                        </select>
                                        <a href="<?php echo site_url('academic/classes/add'); ?>" class="btn btn-success btn-md quick-add">+</a>
                                        <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                    </div>
                                </div>

                                 <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="section_id"><?php echo $this->lang->line('section'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="section_id[]"  id="getsection_idd" required="required" onchange="get_section_by_subject('',this.value, false);" multiple>
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <?php
                                              $sectiondata = $this->db->get_where('section',array('class_id'=>$class_id))->result();
                                             foreach($sectiondata as $objj){

                                             ?>
                                            <option value="<?php echo $objj->section_id; ?>" <?php if($assignment->section_id == $objj->section_id){ echo 'selected="selected"';} ?>><?php echo $objj->name; ?></option>
                                            <?php } ?>  

                                        </select>
                                        
                                        <div class="help-block"><?php echo form_error('section_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject_id"><?php echo $this->lang->line('subject'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12 quick-field"  name="subject_id"  id="edit_subject_id" required="required" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                      
                                        </select>
                                        <a href="<?php echo site_url('academic/subject/add'); ?>" class="btn btn-success btn-md quick-add">+</a>
                                        <div class="help-block"><?php echo form_error('subject_id'); ?></div>
                                    </div>
                                </div>
                                
                                                        
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="deadline"><?php echo $this->lang->line('deadline'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="deadline"  id="edit_deadline" value="<?php echo isset($assignment->deadline) ?  date('d-m-Y', strtotime($assignment->deadline)) : $post['deadline']; ?>" placeholder="<?php echo $this->lang->line('deadline'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('deadline'); ?></div>
                                    </div>
                                </div>


                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $this->lang->line('assignment'); ?>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="hidden" name="prev_assignment" id="prev_assignment" value="<?php echo $assignment->assignment; ?>" />
                                        <?php if($assignment->assignment){ ?>
                                        <a target="_blank" href="<?php echo UPLOAD_PATH; ?>/assignment/<?php echo $assignment->assignment; ?>"><?php echo $assignment->assignment; ?></a> <br/><br/>
                                        <?php } ?>
                                        <div class="btn btn-default btn-file">
                                            <i class="fa fa-paperclip"></i> <?php echo $this->lang->line('upload'); ?>
                                            <input  class="form-control col-md-7 col-xs-12"  name="assignment"  id="assignment" type="file">
                                        </div>
                                        <div class="text-info"><?php echo $this->lang->line('valid_file_format_doc'); ?></div>
                                        <div class="help-block"><?php echo form_error('assignment'); ?></div>
                                    </div>
                                </div>
                             
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo $this->lang->line('note'); ?>"><?php echo isset($assignment->note) ?  $assignment->note : $post['note']; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                                                             
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="<?php echo isset($assignment) ? $assignment->id : $id; ?>" name="id" />
                                        <a  href="<?php echo site_url('assignment'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
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


<?php } ?>


<?php 
//date_default_timezone_set('Asia/Kolkata');
$timenow = date('d-m-Y');
$timestamp = strtotime($timenow);


 $this->db->select('*');
 $this->db->from('attendance');
 $this->db->where('timestamp', $timestamp); //For current month
 $this->db->where("status = '1' ");
 $monthly_parsent = $this->db->get()->result();
 $daily_parsent_val = count($monthly_parsent);      

$timenowday = date('d-m-Y');
$days= date('l', strtotime($timenowday));
 $this->db->select('*');
 $this->db->from('emp_attendance');
 $this->db->where('timestamp', $timestamp); //For current month
 $this->db->where("status = '1' ");
 $monthly_parsent = $this->db->get()->result();
 $daily_parsent_teacher = count($monthly_parsent);      
 

 $today = strtolower(date("l"));
         
 ?>

<script type="text/javascript">
    
    function reload_url() {
        class_selection = $('#class_selection').val();
        section_id = $('#section_id').val();
        if(class_selection != "" && section_id != ""){
          window.location.href = "<?php echo site_url();?>assignment/index/"+class_selection;
        }
    }

    function get_assignment_modal(assignment_id){
         
        $('.fn_assignment_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('admin/get_single_assignment'); ?>",
          data   : {assignment_id : assignment_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_assignment_data').html(response);
             }
          }
       });
    }
</script>

<link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
 <script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>
 <script type="text/javascript">
     
  $('#add_deadline').datepicker();
  $('#edit_deadline').datepicker();

    
    <?php if(isset($edit)){ ?>
       get_section_by_subject('<?php echo $assignment->class_id; ?>', '<?php echo $assignment->subject_id; ?>', true);
    <?php } ?>
        
    <?php if(isset($class_id)){ ?>
       get_section_by_subject('<?php echo $class_id; ?>', '', false);
    <?php } ?>
    
    function get_section_by_subject(class_id, section_id, is_edit){ 
    if(class_id == '')      
        var class_id =  $('#class_id').val();

//alert(class_id);
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_section_by_subjects'); ?>",
            data   : {class_id : class_id , section_id : section_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   if(is_edit){
                        $('#edit_subject_id').html(response);
                   }else{
                        $('#add_subject_id').html(response);
                   }
               }
            }
        });                  
        
   }
      function get_subject_(class_id, section_id, is_edit){       
      
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_section_by_subjects'); ?>",
            data   : {class_id : class_id , section_id : section_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                $('#subjectvalue').html(response);
                  
               }
            }
        });                  
        
   }
   
    function get_assignment_by_class(url){          
        if(url){
            window.location.href = url; 
        }
    }

    function select_section(class_id) {
    if(class_id !== ''){
        $.ajax({
            type   : "POST",
            url: "<?php echo site_url('ajax/get_class_by_section/');?>",
            data   : { class_id : class_id},               
            async  : false,
            success:function (response)
            {
                $('#getsection_id').html(response);

                <?php if(isset($edit)){ ?>
                         $('#getsection_idd').html(response);
                <?php } ?>
            }
        });
    }
}
 </script>