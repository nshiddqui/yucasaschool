<?php $activeTab = "academic_dashboard"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Assignment</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/teacher/academic_nav_tab.php'; ?> 
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
                    
                    <ul  class="nav nav-tabs bordered hidden">
                       <li class="active"><a href="#tab_view_assignment"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('view'); ?> <?php echo $this->lang->line('assignment'); ?></a> </li>
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab_view_assignment">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('teacher/assignment/'.$class_id.'/filter/'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >
                                        <?php echo $this->lang->line('section'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12 quick-field"  name="section_id"  id="section_view" required="required" onchange="get_subject_(<?php echo $class_id;?>,this.value,false);">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>  
                                            <?php foreach($sections as $section){  ?>
                                            <option value="<?php echo $section->section_id;?>"><?php echo $section->name;?></option> 
                                        <?php }?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('assigment_id'); ?></div>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject_id"><?php echo $this->lang->line('subject'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12 quick-field"  name="subject_id" onchange="get_subject_list(this.value);" id="subjectvalue" required="required" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>  
											 					
                                        </select>
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
                    			function get_subject_list(subject_id){
                                    var section_id = $('#section_view').val();
                                    $.ajax({       
                                        type   : "POST",
                                        url    : "<?php echo site_url('ajax/get_assignment_by_subjects'); ?>",
                                        data   : {subject_id : subject_id,section_id : section_id},               
                                        async  : false,
                                        success: function(response){                                                   
                                        if(response)
                                          {
                                           $('#getsubject').html(response); 
                                          }
                                        }
                                    }); 
                                }   
                            </script> 
                        <div class="x_content ">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th>Student Name</th>
                                        <th><?php echo $this->lang->line('subject'); ?></th>
                                        <th><?php echo $this->lang->line('class'); ?></th>
                                        <th><?php echo $this->lang->line('deadline'); ?></th>
                                        <th>Status</th>
                                        <th><?php echo $this->lang->line('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($filter_assignments) && !empty($filter_assignments)){ ?>
                                        <?php foreach($filter_assignments as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $obj->student_name;?></td>
                                            <td><?php echo $obj->subject_name;?></td>
                                            <td><?php echo $obj->class_name; ?></td>
                                            <td><?php echo $obj->deadline ?></td>
                                            <td><?php $status = @$this->db->get_where('submit_assignment',array('assignment_id'=>$obj->id,'student_id'=>$obj->student_id))->row()->status;
                                                if($status == 1){
                                                    echo 'Submitted';
                                                }else{
                                                    echo 'pending';
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
                                                            <a  onclick="get_assignment_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-assignment-modal-lg"  class=""><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> </a>
                                                             <?php 

                                                             $assignment = @$this->db->get_where('submit_assignment',array('assignment_id'=>$obj->id,'student_id'=>$obj->student_id))->row()->assignment_file;

                                                            if($assignment != ""){ ?>
                                                            <a target="_blank" href="<?php echo base_url();?>assets/uploads/assignment_upload/<?php echo $assignment; ?>" class=""><i class="fa fa-download"></i> <?php echo $this->lang->line('download'); ?> </a>
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

                                          
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bs-assignment-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo $this->lang->line('assignment'); ?> <?php echo $this->lang->line('information'); ?></h4>
        </div>
        <div class="modal-body fn_assignment_data">
            
        </div>       
      </div>
    </div>
</div>
<script type="text/javascript">
         
    function get_assignment_modal(assignment_id){
         
        $('.fn_assignment_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('assignment/get_single_assignment'); ?>",
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
        var class_id =  $('#class_id').val();
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
            }
        });
    }
}


 </script>
  <script type="text/javascript">
        // $(document).ready(function() {
        //   $('#datatable-responsive').DataTable( {
        //       dom: 'Bfrtip',
        //       iDisplayLength: 15,
        //       buttons: [
        //           'copyHtml5',
        //           'excelHtml5',
        //           'csvHtml5',
        //           'pdfHtml5',
        //           'pageLength'
        //       ],
        //       search: true
        //   });
        // });
    $("#add").validate();     
    $("#edit").validate(); 
</script>