<?php $activeTab = "student_information";
$status_code = 0;
?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Student</a></li>
        <li class="active">Student Information</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
</div>

<style>
.datahidden{
	display:none;
}
</style>

<div class="row">
<div class="col-md-3">
    <div class="form-group">
        <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class'); ?></label>
        <select name="class_id" class="form-control selectboxit"  id = "class_selection">
            <option value=""><?php echo get_phrase('select_class'); ?></option>
            <?php
            $classes = $this->db->get('class')->result_array();
            foreach ($classes as $row):
                if($row['class_id'] == $class_id){
                    $class_name = $row['name'];
                }
                ?>

                <option value="<?php echo $row['class_id']; ?>" <?php if($row['class_id'] == $class_id){echo 'selected';} ?>><?php echo $row['name']; ?></option>
                    <?php endforeach; ?>
        </select>
    </div>
</div>

<div class="col-md-2 top-first-btn">
  <button onclick="reload_url(); return false;" class="btn btn-info"><?php echo get_phrase('student_information'); ?></button>
    </div>
</div>


<?php if($class_id) {?>



<div class="row">
    <div class="col-md-12">

        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#home" data-toggle="tab">
                    <span class="visible-xs"><i class="entypo-users"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('all_students');?></span>
                </a>
            </li>
        <?php
            $query = $this->db->get_where('section' , array('class_id' => $class_id));
            $sectionsArray = array();
            if ($query->num_rows() > 0):
                $sections = $query->result_array();
                foreach ($sections as $row):
                    $sectionsArray[$row['section_id']] = $row['name'];
        ?>


            <li>
                <a href="#<?php echo $row['section_id'];?>" data-toggle="tab">
                    <span class="visible-xs"><i class="entypo-user"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('section');?> ( <?php echo $row['name'];?> )</span>
                </a>
            </li>
        <?php endforeach;?>
        <?php endif;?>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="home">

                <table class="table table-bordered" id="student_datatable">
                    <thead>
                        <tr>
                            <th width="80"><div>Roll No</div></th>
                            <th width="80"><div><?php echo get_phrase('photo');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                              <th><div><?php echo get_phrase('class');?></div></th>
                                <th><div><?php echo get_phrase('section');?></div></th>
                            <th><div>Student Phone Number</div></th>
                            <th><div>Father Name</div></th>
                            <th><div>Father Phone Number</div></th>
                            <th><div>Reason of Drop Out</div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                              
                                $this->db->select('*');
                                $this->db->from('enroll');
                                $this->db->where('class_id',$class_id);
                                $query = $this->db->get();
                            
                                foreach($query->result() as $row):
                                $student_d = $this->db->get_where('student' , array(
                                    'student_id' => $row->student_id
                                ))->row();
                                if($student_d->status != $status_code){
                                    continue;
                                }
                                ?>

                        <tr>
                            <td><?php 
                                  echo $student_d->student_code; 
                                  ?>
                                </td>
                            <td><img src="<?php echo $this->crud_model->get_image_url('student',$row->student_id);?>" class="img-circle" width="30" /></td>
                            <td>
                              <a href="<?php echo site_url('admin/student_profile/'.$row->student_id);?>">  <?php
                               echo  $student_d->name;
                             ?></a>
                            </td>
                            	<td>
                            <?php  echo $class_name ?>
                            </td>
                            	<td>
                            	<?php  echo $sectionsArray[$row->section_id]; ?>
                           
                            </td>
                            <td>
                                <?= $student_d->phone ?>
                            </td>
                            <td>
                                <?php
                                $parentDetail = $this->db->get_where('parent',['parent_id'=>$student_d->parent_id])->row();
                                    echo @$parentDetail->name;
                                ?>
                            </td>
                             <td>
                                <?php
								  echo @$parentDetail->phone;
                                ?>
                            </td>
                            <td>
                                <?php
								  echo $student_d->reason;
                                ?>
                            </td>
                            <td>

                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                        

                                        <!-- STUDENT PROFILE LINK -->
                                        <li>
                                            <a href="<?php echo site_url('admin/student_profile/'.$row->student_id);?>">
                                                <i class="entypo-user"></i>
                                                    <?php echo get_phrase('profile');?>
                                                </a>
                                        </li>
                                        
                                         <!-- ROOM CHANGE REQUEST -->
                                         <?php if($row->is_hostel_member =='1'){ ?>
                                        <li>
                                            <a href="<?php echo site_url('admin/student_roomchange_request/'.$row->student_id);?>">
                                                <i class="entypo-user"></i>
                                                    Room change request
                                                </a>
                                        </li>
                                        <?php } ?>

                                        <!-- STUDENT EDITING LINK -->
                                        <li>
                                            <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_student_edit/'.$row->student_id);?>');">
                                                <i class="entypo-pencil"></i>
                                                    <?php echo get_phrase('edit');?>
                                                </a>
                                        </li>

                                        <li class="divider"></li>
                                        <li>
                                          <a href="#" onclick="confirm_modal('<?php echo site_url('admin/delete_student/'.$row->student_id.'/'.$class_id);?>');">
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
        <?php
            $query = $this->db->get_where('section' , array('class_id' => $class_id));
            if ($query->num_rows() > 0):
                $sections = $query->result_array();
                foreach ($sections as $row):
        ?>
            <div class="tab-pane" id="<?php echo $row['section_id'];?>">

                <table class="table table-bordered" id="student_datatable_<?php echo $row['section_id'];?>">
                    <thead>
                         <tr>
                            <th width="80"><div>Roll No</div></th>
                            <th width="80"><div><?php echo get_phrase('photo');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th class="span3"><div><?php echo get_phrase('address');?></div></th>
                            <th><div><?php echo get_phrase('email');?></div></th>
                            <th><div><?php echo get_phrase('mobile');?></div></th>
                            <th><div>Father Name</div></th>
                            <th><div>Father Phone Number</div></th>
                            <th><div>Reason of Drop Out</div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $students   =   $this->db->get_where('enroll' , array(
                                    'class_id'=>$class_id , 'section_id' => $row['section_id'] , 'year' => $running_year
                                ))->result_array();
                                foreach($students as $row):
                                $student_d = $this->db->get_where('student' , array(
                                    'student_id' => $row['student_id']
                                ))->row();
                                if($student_d->status != $status_code){
                                    continue;
                                }
                                ?>
                        <tr>
                            <td><?php 
                                  echo $student_d->student_code;

                                  ?></td>
                            <td><img src="<?php echo $this->crud_model->get_image_url('student',$row['student_id']);?>" class="img-circle" width="30" /></td>
                            <td>
                                <a href="<?php echo site_url('admin/student_profile/'.$row['student_id']);?>">
                               <?php
                              
                               echo  $student_d->name;
                             ?>
                             </a>
                            </td>
                            <td>
                                <?php
                                    echo $student_d->address;
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo $student_d->email;
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo $student_d->phone;
                                ?>
                            </td>
                            <td>
                                <?php
                                $parentDetail = $this->db->get_where('parent',['parent_id'=>$student_d->parent_id])->row();
                                    echo @$parentDetail->name;
                                ?>
                            </td>
                             <td>
                                <?php
								  echo @$parentDetail->phone;
                                ?>
                            </td>
                            <td>
                                <?php
								  echo $student_d->reason;
                                ?>
                            </td>
                            <td>

                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                        
                                        <!-- STUDENT PROFILE LINK -->
                                        <li>
                                            <a href="<?php echo site_url('admin/student_profile/'.$row['student_id']);?>">
                                                <i class="entypo-user"></i>
                                                    <?php echo get_phrase('profile');?>
                                                </a>
                                        </li>

                                        <!-- STUDENT EDITING LINK -->
                                        <li>
                                            <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_student_edit/'.$row['student_id']);?>');">
                                                <i class="entypo-pencil"></i>
                                                    <?php echo get_phrase('edit');?>
                                                </a>
                                        </li>
                                        <!--<li>-->
                                        <!--    <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/student_id/'.$row['student_id']);?>');">-->
                                        <!--        <i class="entypo-vcard"></i>-->
                                        <!--        <?php echo get_phrase('generate_id');?>-->
                                        <!--    </a>-->
                                        <!--</li>-->

                                        <li class="divider"></li>
                                        <li>
                                          <a href="#" onclick="confirm_modal('<?php echo site_url('admin/delete_student/'.$row['student_id'].'/'.$class_id);?>');">
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
        <?php endforeach;?>
        <?php endif;?>

        </div>


    </div>
</div>
<?php } ?>
<script type="text/javascript">

    function reload_url() {
        class_selection = $('#class_selection').val();
        section_id = $('#section_id').val();
        if(class_selection != ""){
          window.location.href = "<?php echo site_url();?>/admin/student_information_inactive/"+class_selection;
        }
    }



        $(document).ready(function() {
            $('#student_datatable').DataTable();
          
            $('table[id^="student_datatable_"]').each(function(){
                $('#'+$(this).attr('id')).DataTable();
            });
        
        });
</script>


<script type = 'text/javascript'>

$('input[type=file]').change(function () {
alert(this.files[0].mozFullPath);
});


var class_id = '';

$("#submit").attr('disabled', 'disabled');

function book_edit_modal(student_id) {
showAjaxModal('<?php echo site_url('modal/popup/modal_student_edit/');?>' + student_id);
}

function book_delete_confirm(student_id) {
confirm_modal('<?php echo site_url('#');?>' + student_id);
}

function check_validation(){
if(class_id !== ''){
$('#submit').removeAttr('disabled');
}
else{
$("#submit").attr('disabled', 'disabled');
}
}
$('#class_id').change(function(){
class_id = $('#class_id').val();
check_validation();
});
</script>

