<?php $activeTab = "assignments"; ?>
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

  <!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/academic_nav_tab.php'; ?> 
  <!-- Including Navigation Tab -->
</div>



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
                    <div class="tab-content">
                        <div  >
                            <div class="x_content">
                               <?php echo form_open_multipart(site_url('assignment/view_assignment/filter/'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>


                                 <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo $this->lang->line('class'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12 quick-field"  name="class_id"  id="class_id" required="required" onchange="select_section(this.value);" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <?php foreach($classes as $obj ){ ?>
                                            <option value="<?php echo $obj->class_id; ?>" ><?php echo $obj->name; ?></option>
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
                                        <select  class="form-control col-md-7 col-xs-12"  name="section_id"  id="getsection_id" required="required" onchange="get_section_by_subject('',this.value, false);">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                      
                                        </select>
                                        
                                        <div class="help-block"><?php echo form_error('section_id'); ?></div>
                                    </div>
                                </div>





                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject_id"><?php echo $this->lang->line('subject'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12 quick-field"  name="subject_id" onchange="get_subject_list_by('',this.value, false);" id="add_subject_id" required="required" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                      
                                        </select>
                                        <a href="<?php echo site_url('academic/subject/add'); ?>" class="btn btn-success btn-md quick-add">+</a>
                                        <div class="help-block"><?php echo form_error('subject_id'); ?></div>
                                    </div>
                                </div>


                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="getsubject"><?php echo $this->lang->line('assignment'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12 quick-field"  name="assigment_id"  id="getsubject" required="required" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                        </select>
                                        <div class="help-block"><?php echo form_error('assigment_id'); ?></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('assignment'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>

                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>

                                <?php echo form_close(); ?>
                            </div>
                        	<script>
                    			function get_subject_list_by(add_subject_id,class_id,getsection_id){
                                    var section_id = $('#getsection_id').val();
                                    var class_id =  $('#class_id').val();
                                     var subject_id =  $('#add_subject_id').val();
                                    //alert(subject_id);
                                
                                    
                                    
                                           $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('ajax/get_assignment_by_subjects'); ?>",
         data   : {subject_id : subject_id,section_id : section_id,class_id :class_id},             
          success: function(response){                                                   
             if(response)
             {
                $('#getsubject').html(response);
             }
          }
       });
                                    
                                }   
                            </script> 
                            
                       <?php if($assigment_id !=''){ ?>  
                    <form action="<?php echo site_url('assignment/update_assignment_marks');?>" method="post">                    
                        <div class="x_content ">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap datatable" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th>Student Name</th>
                                        <th><?php echo $this->lang->line('subject'); ?></th>
                                        <th><?php echo $this->lang->line('class'); ?></th>
                                        <th><?php echo $this->lang->line('section'); ?></th>
                                        <th><?php echo $this->lang->line('deadline'); ?></th>
                                        
                                        <th style="width:10%">Assignment Marks</th>
                                        <th>Status</th>
                                        <th><?php echo $this->lang->line('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody> 

                                    <?php $count = 1; if(isset($filter_assignments) && !empty($filter_assignments)){ ?>
                                        <?php
                                        $assignments_value = $this->db->get_where('assignments',array('id'=>$assigment_id))->row(); 
                                        $titleval = $assignments_value->title;
                                        $deadline = $assignments_value->deadline;
                                        $subject_id= $assignments_value->subject_id;
                                        $assignment = $assignments_value->assignment;
                                       if ($assignments_value != "") {
                                          
                                         foreach($filter_assignments as $obj){ 
                                              $status = @$this->db->get_where('submit_assignment',array('assignment_id'=>$assigment_id,'student_id'=>$obj->student_id))->row(); 
                                               
                                            ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $obj->student_name;?></td>
                                            <td><?php echo $this->db->get_where('subject',array('subject_id'=>$subject_id))->row()->name; ?></td>
                                            <td><?php echo $this->db->get_where('class',array('class_id'=>$obj->class_id))->row()->name; ?></td>
                                            <td><?php echo $this->db->get_where('section',array('section_id'=>$obj->section_id))->row()->name; ?></td>
                                            <td><?php echo $deadline; ?></td>
                                            <td class="text-center"><input type="number" name="marks[]" value ="<?php echo  $status->mark;?>" style="width:30%; height:30px;" > <span>/</span>
                                            <span style="font-weight:700"><?php echo $assignments_value->assignment_marks; ?></span>
                                                <input type="hidden" name="student_id[]" value ="<?php echo $obj->student_id;?>" >
                                                <input type="hidden" name="class_id" value ="<?php echo $obj->class_id;?>" >
                                                <input type="hidden" name="assignment_id[]" value ="<?php echo $assigment_id;?>" ></td>
                                            <td><?php 
                                                 // echo $obj->id;
                                                 // echo "<br>";
                                                 // echo $obj->student_id;
                                            
                                                if($status->status == 1){
                                                    echo '<div class="alert alert-success"><strong>Submitted</strong>';
                                                }else{
                                                    echo '<div class="alert alert-warning"><strong>Pending!</strong></div>';
                                                } ?></td>
                                            <td>

                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                                        Action <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                                        

                                                        
                                                        <!-- DELETION LINK -->
                                                        <li>
                                                            <?php if(has_permission(VIEW, 'assignment', 'assignment')){ ?>
                                                           <!--  <a  onclick="get_assignment_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-assignment-modal-lg"  class=""><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> </a> -->
                                                            <?php 

                                                             $assignment_submit = @$this->db->get_where('submit_assignment',array('assignment_id'=>$assigment_id,'student_id'=>$obj->student_id))->row()->assignment_file;

                                                            if($assignment_submit != ""){ ?>
                                                            <a target="_blank" href="<?php echo base_url();?>assets/uploads/assignment_upload/<?php echo $assignment_submit; ?>" class=""><i class="fa fa-download"></i> <?php echo $this->lang->line('download'); ?> </a>
                                                            <?php  } ?>
                                                        <?php  } ?>
                                                        </li>

                                                        <li>
                                                            <?php if(has_permission(DELETE, 'assignment', 'assignment')){ ?>
                                                                <a href="<?php echo site_url('assignment/delete/'.$assigment_id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class=""><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
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
                             <div class="form-group" style="margin-top:10px;">
                                    <div class="col-md-12 text-right p0">
                                       <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                  <?php } ?>
                            </div>
                      </form> 
                      <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



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
