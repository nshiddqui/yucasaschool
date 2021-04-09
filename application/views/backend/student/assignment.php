<?php $activeTab = "academic_dashboard"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Academic Assignment</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/student/academic_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<div class="row student_assignment">
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
                    
                    <ul  class="nav nav-tabs bordered">
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_assignment_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('assignment'); ?> <?php echo $this->lang->line('list'); ?></a> </li>
                        <!--<?php if(has_permission(ADD, 'assignment', 'assignment')){ ?>
                            <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_assignment"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('assignment'); ?></a> </li>                          
                        <?php } ?>
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_assignment"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> <?php echo $this->lang->line('assignment'); ?></a> </li>                          
                        <?php } ?>   -->             
                        <?php if(isset($detail)){ ?>
                            <li  class="active"><a href="#tab_view_assignment"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> <?php echo $this->lang->line('assignment'); ?></a> </li>                          
                        <?php } ?> 
                        
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_assignment_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap datatable" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th><?php echo $this->lang->line('assignment'); ?> <?php echo $this->lang->line('title'); ?></th>
                                        <!--<th><?php echo $this->lang->line('class'); ?></th>-->
                                        <th><?php echo $this->lang->line('subject'); ?></th>
                                        <th><?php echo $this->lang->line('deadline'); ?></th>
                                        <th><?php echo $this->lang->line('academic_year'); ?></th>
                                        <th>Status</th>
                                        <th><?php echo $this->lang->line('action'); ?></th>
                                        <th>Upload Assignment</th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($assignments) && !empty($assignments)){ ?>
                                        <?php foreach($assignments as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $obj->title; ?></td>
                                            <!--<td><?php echo $obj->class_name; ?></td>-->
                                            <td><?php echo $obj->subject; ?></td>
                                            <td><?php echo $obj->deadline ?></td>
                                            <td><?php echo $obj->year; ?></td>
                                            <td>
                                            <?php  $status = @$this->db->get_where('submit_assignment',array('assignment_id'=>$obj->id,'student_id'=>$student_id))->row()->status;
                                            //echo $status;
                                                if($status == 1){
                                                    echo 'Submitted';
                                                }else{
                                                    echo 'pending';
                                                }

                                            ?>
                                                
                                            </td>
                                            <td>

                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                                        Action <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                                        
                                                        <!-- EDITING LINK -->
                                                       <!-- <li>
                                                           <?php if(has_permission(EDIT, 'assignment', 'assignment')){ ?>
                                                                <a href="<?php echo site_url('assignment/edit/'.$obj->id); ?>" class=" "><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> </a>
                                                            <?php  } ?>
                                                            <?php if(has_permission(VIEW, 'assignment', 'assignment')){ ?>
                                                            <a  onclick="get_assignment_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-assignment-modal-lg"  class=""><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> </a>               </li>
                                                        <li class="divider"></li>-->
                                                        
                                                        <!-- DELETION LINK -->
                                                        <li>
                                                         
                                                            <?php if($obj->assignment){ ?>
                                                            <a target="_blank" href="<?php echo UPLOAD_PATH; ?>/assignment/<?php echo $obj->assignment; ?>" class=""><i class="fa fa-download"></i> <?php echo $this->lang->line('download'); ?> </a>
                                                            <?php  } ?>
                                                        <?php  } ?>
                                                        </li>

                                                        <!--<li>
                                                            <?php if(has_permission(DELETE, 'assignment', 'assignment')){ ?>
                                                                <a href="<?php echo site_url('assignment/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class=""><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
                                                            <?php  } ?>
                                                        </li>-->
                                                    </ul>
                                                </div>

                                            </td>

                                            <td>
                                                 <?php echo form_open_multipart(site_url('student/add_assignment'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                                    <div class="">
                                                    <input type="hidden"  name="assignment_id" value="<?php echo $obj->id; ?>">
                                                    <input type="hidden"  name="class_id" value="<?php echo $class_id; ?>">
                                                    <input type="hidden"  name="student_id" value="<?php echo logged_in_user_id() ?> ">
                                                    <input  class="form-control col-md-7 col-xs-12"  name="assignment"  id="assignment" type="file" >
                                                    
                                                    </div>

                                                    <div class="" style="margin-top: 5px;">
                                                        <button type="submit" class="btn btn-success">Upload</button>
                                                    </div>
                                                   </form>
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
        get_subject_by_class('<?php echo $assignment->class_id; ?>', '<?php echo $assignment->subject_id; ?>', true);
    <?php } ?>
        
    <?php if(isset($class_id)){ ?>
        get_subject_by_class('<?php echo $class_id; ?>', '', false);
    <?php } ?>
    
    function get_subject_by_class(class_id, subject_id, is_edit){       
           
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_subject_by_class'); ?>",
            data   : { class_id : class_id , subject_id : subject_id},               
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
    function get_assignment_by_class(url){          
        if(url){
            window.location.href = url; 
        }
    }
 </script>
  <script type="text/javascript">
    $("#add").validate();     
    $("#edit").validate(); 
</script>