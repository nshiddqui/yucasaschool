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
                               <?php echo form_open_multipart(site_url('assignment/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title"><?php echo $this->lang->line('assignment'); ?> <?php echo $this->lang->line('title'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="title"  id="title" value="<?php echo isset($post['title']) ?  $post['title'] : ''; ?>" placeholder="<?php echo $this->lang->line('assignment'); ?> <?php echo $this->lang->line('title'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('title'); ?></div>
                                    </div>
                                </div>           

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
                                        <select  class="form-control col-md-7 col-xs-12"  name="section_id[]"  id="getsection_id" required="required" onchange="get_section_by_subject('',this.value, false);">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                      
                                        </select>
                                        
                                        <div class="help-block"><?php echo form_error('section_id'); ?></div>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject_id"><?php echo $this->lang->line('subject'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12 quick-field"  name="subject_id"  id="add_subject_id" required="required" >
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
                                        <input  class="form-control col-md-7 col-xs-12"  name="deadline"  id="add_deadline" value="<?php echo isset($post['deadline']) ?  $post['deadline'] : ''; ?>" placeholder="<?php echo $this->lang->line('deadline'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('deadline'); ?></div>
                                    </div>
                                </div>

                                 <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="assignment_mark">Assignment mark<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="assignment_marks"  id="assignment_mark" value="<?php echo isset($post['assignment_marks']) ?  $post['assignment_marks'] : ''; ?>" placeholder="Assignment mark" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('assignment_marks'); ?></div>
                                    </div>
                                </div>
                                
                               <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $this->lang->line('assignment'); ?> 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="btn btn-default btn-file">
                                            <i class="fa fa-paperclip"></i> <?php echo $this->lang->line('upload'); ?>
                                            <input  class="form-control col-md-7 col-xs-12"  name="assignment"  id="assignment" type="file" >
                                        </div>
                                        <div class="text-info"><?php echo $this->lang->line('valid_file_format_doc'); ?></div>
                                        <div class="help-block"><?php echo form_error('assignment'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo $this->lang->line('note'); ?>"><?php echo isset($post['note']) ?  $post['note'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                               
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('assignment'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                                
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="instructions"><strong><?php echo $this->lang->line('instruction'); ?>: </strong> <?php echo $this->lang->line('add_assignment_instruction'); ?></div>
                                </div>
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
