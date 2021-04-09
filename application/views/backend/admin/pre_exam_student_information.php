<?php $activeTab = "pre_exam"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Pre Exam</a></li>
        <li class="active">Student Information</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/admission_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<div class="filter_form mb-15">
    
    <div class="row">
        
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class'); ?></label>
                <select name="class_id" class="form-control selectboxit"  id = "class_selection">
                    <option value=""><?php echo get_phrase('select_class'); ?></option>
                    <?php
                    $classes = $this->db->get('class')->result_array();
                    foreach ($classes as $row):
                        ?>
        
                        <option value="<?php echo $row['class_id']; ?>" <?php if($row['class_id'] == $class_id){echo 'selected';} ?>><?php echo $row['name']; ?></option>
                            <?php endforeach; ?>
                </select>
            </div>
        </div>
    
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;">Option</label>
        	    <button onclick="reload_url(); return false;" class="btn btn-info btn-block"><?php echo get_phrase('student_information'); ?></button>
        	</div>
        </div>
        
        <!--<div class="col-md-2 top-first-btn">-->
        <!--    <button onclick="reload_url(); return false;" class="btn btn-info"><?php echo get_phrase('student_information'); ?></button>-->
        <!--</div>-->
    </div>
</div>
<a href="<?php echo site_url('admin/pre_exam_student_registration');?>"
    class="btn btn-primary pull-right">
        <i class="entypo-plus-circled"></i>
        <?php echo get_phrase('add_new_student');?>
</a>

<div class="row">
    <div class="col-md-12">

        <ul class="nav nav-tabs bordered hidden">
            <li class="active">
                <a href="#home" data-toggle="tab">
                    <span class="visible-xs"><i class="entypo-users"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('all_students');?></span>
                </a>
            </li>
       
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="home">

                <table class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <th width="80"><div><?php echo get_phrase('id_no');?></div></th>
                            <th width="80"><div><?php echo get_phrase('photo');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th class="span3"><div><?php echo get_phrase('address');?></div></th>
                            <th><div><?php echo get_phrase('email');?></div></th>
                            <th><div><?php echo get_phrase('Student_status');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $students   =   $this->db->get_where('pre_enroll' , array(
                                    'class_id' => $class_id , 'year' => $running_year
                                ))->result_array();
                    
                       foreach($students as $row):?>
                        <tr>
                           
                             <td><?=$row['enroll_code'];?>
                            </td>
                            <td><img src="<?php echo $this->crud_model->get_image_url('pre_student',$row['student_id']);?>" class="img-circle" width="30" />
                            </td>
                            <td>
                                <?php
                                    echo $this->db->get_where('pre_student' , array(
                                        'pre_student_id' => $row['student_id']
                                    ))->row()->name;
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo $this->db->get_where('pre_student' , array(
                                        'pre_student_id' => $row['student_id']
                                    ))->row()->address;
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo $this->db->get_where('pre_student' , array(
                                        'pre_student_id' => $row['student_id']
                                    ))->row()->email;
                                ?>
                            </td>
							
							    <td>
								<?php
                                    $pre_student_id= $this->db->get_where('pre_student' , array(
                                        'pre_student_id' => $row['student_id']
                                    ))->row()->pre_student_id;
                                ?>
								<?php
                                    
                                ?>
                                <?php
        $islogin= $this->db->get_where('pre_student' , array('pre_student_id' => $row['student_id'] ))->row()->islogin;
								 if($islogin==0){ ?>
								<button class="alert alert-danger" onclick ='field_islogin_pre_student_active("<?php echo $pre_student_id;?>")'>Deactive </button><?php } else {
									?> <button class="alert alert-success" onclick = 'field_islogin_pre_student_active("<?php echo $pre_student_id;?>")'> Active</button>
								<?php  }
                                ?>
                            </td>
                            <td>

                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                        <!-- STUDENT EDITING LINK -->
                                        <li>
                                            <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_preexam_student_edit/'.$row['student_id']);?>');">
                                                <i class="entypo-pencil"></i>
                                                    <?php echo get_phrase('edit');?>
                                                </a>
                                        </li>
                                        <li>
                                            <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/admit_card/'.$row['student_id']);?>');">
                                                <i class="entypo-vcard"></i>
                                                <?php echo get_phrase('generate_admit_card');?>
                                            </a>
                                        </li>

                                        <li class="divider"></li>
                                        <li>
                                          <a href="#" onclick="confirm_modal('<?php echo site_url('admin/pre_delete_student/'.$row['student_id'].'/'.$class_id);?>');">
                                            <i class="entypo-trash"></i>
                                              <?php echo get_phrase('delete');?>
                                          </a>
                                        </li>
                                    </ul>
                                </div>

                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>

            </div>

        </div>


    </div>
</div>
<script>
   function field_islogin_pre_student_active(field_id){
    //alert(field_id);
      $('.msgs').text("")
      $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('ajax/update_status_pre_student_id'); ?>",
          data   : { field_id : field_id},               
          async  : false,
          success: function(data){                                                   
          
              location.reload();
        
          }
      }); 
   }


   

</script>
<script type="text/javascript">

    function reload_url() {
        class_selection = $('#class_selection').val();
        section_id = $('#section_id').val();
        if(class_selection != "" && section_id != ""){
          window.location.href = "<?php echo site_url();?>/admin/pre_exam_student_information/"+class_selection;
        }
    }
</script>
<!-- <script type="text/javascript">

	jQuery(document).ready(function($) {
        $('.datatable').DataTable();
	});

</script> -->



<!-- NOTE :: Removed Section wise student list, marksheet, profile from action. -->