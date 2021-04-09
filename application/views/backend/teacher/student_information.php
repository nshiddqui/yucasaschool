<?php $activeTab = "student_information";

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
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/student_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
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
 
            if ($query->num_rows() > 0):
                $sections = $query->result_array();
                foreach ($sections as $row):
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
                            <th width="80"><div><?php echo get_phrase('id_no');?></div></th>
                            <th width="80"><div><?php echo get_phrase('photo');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                              <th><div><?php echo get_phrase('class');?></div></th>
                                <th><div><?php echo get_phrase('section');?></div></th>
                            <th><div><?php echo get_phrase('house');?></div></th>
                            <th  class="datahidden"><div><?php echo get_phrase('email');?></div></th>
                            <th><div><?php echo get_phrase('emergency_contact');?></div></th>
                            <th class="datahidden"><div ><?php echo get_phrase('parent_name');?></div></th>
                            <th><div><?php echo get_phrase('Due_fee');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('RFID');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('Roll_No');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('birthday');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('Hostel Membar');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('hostel_id');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('dormitory_id');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('is_transport_member');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('transport_start_id');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('transport_stop_id');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('otherfields');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                              
                                $this->db->select('*,student.status');
                                $this->db->from('enroll');
                                $this->db->join('student', 'enroll.student_id = student.student_id');
                                $this->db->where('enroll.class_id', $class_id);
                                $this->db->where('enroll.year', $running_year);
                                $this->db->where('student.status', $status_code);
                                
                                $query = $this->db->get();
                            
                                foreach($query->result() as $row):?>
<?php
$row = json_decode(json_encode($row), True);?>

                        <tr>
                            <td><?php $student_d = $this->db->get_where('student' , array(
                                    'student_id' => $row['student_id']
                                ))->row();
                                  echo $student_d->student_code; 
                                  ?>
                                </td>
                            <td><img src="<?php echo $this->crud_model->get_image_url('student',$row['student_id']);?>" class="img-circle" width="30" /></td>
                            <td>
                              <a href="<?php echo site_url('admin/student_profile/'.$row['student_id']);?>">  <?php
                                 $resultfee = @$this->db->query("select sum(gross_amount) as amount from invoices where student_id = ".$row['student_id']." AND paid_status = 'unpaid'")->row();

                               // @$resultfee->amount;
                               //if(@$resultfee->amount !=""){
                               //echo  '<div class="label label-default">Due fee</div>';
                               //}
                               echo  $student_d->name;
                             ?></a>
                            </td>
                            	<td>
                            <?php  echo $this->db->get_where('class' , array( 'class_id' => $row['class_id']))->row()->name; ?>
                            </td>
                            	<td>
                            	<?php  echo $this->db->get_where('section' , array( 'section_id' => $row['section_id']))->row()->name; ?>
                           
                            </td>
                            <td>
                                <?php
                                     $house_id=$this->db->get_where('assign_house' , array(
                                        'student_id' => $row['student_id']
                                    ))->row()->house_id;
                                   echo $this->db->get_where('house_info' , array( 'house_id' => $house_id))->row()->name; 
                                ?>
                            </td>
                            <td  class="datahidden">
                                <?php
                                    echo $this->db->get_where('student' , array(
                                        'student_id' => $row['student_id']
                                    ))->row()->email;
                                ?>
                            </td>
                             <td>
                                <?php
                                    echo $student_d->phone;
                                ?>
                            </td>
                            <td class="datahidden">
                                <?php
                                    echo @$this->db->get_where('parent' , array(
                                        'parent_id' => $student_d->parent_id
                                    ))->row()->name;
                                ?>
                            </td>
                             <td>
                                <?php
								  if(@$resultfee->amount !=""){
                                echo  "<div class='label label-default  bi-pink'>Due fee @$resultfee->amount </div>"; 
								  }
                                ?>
                            </td>
							 <td class="datahidden">
                              <?php echo $row['card_code'];?>
                            </td>
							<td class="datahidden">
                              <?php echo $row['roll'];?>
                            </td>
							 <td class="datahidden"> <?php echo $student_d->birthday; ?> </td>
							 <td class="datahidden"> <?php $hostel_member=$student_d->is_hostel_member  ?>
<?php if ($hostel_member==1){ echo 'Yes';} else{ echo 'No';} ?>	 </td>
                           <td class="datahidden"><?php echo $student_d->hostel_id;?> </td>
                           <td class="datahidden"><?php echo $student_d->dormitory_id;?> </td>
							 <td class="datahidden"> <?php $transport_member=$student_d->is_transport_member  ?>
<?php if ($transport_member==1){ echo 'Yes';} else{ echo 'No';} ?>	 </td>
                            <td class="datahidden"> <?php echo $student_d->transport_id;?> </td>
                            <td class="datahidden"> <?php echo $student_d->transport_stop;?> </td>
                            <td class="datahidden"> <?php echo $student_d->otherfields;?> </td>
							
							
                            <td>

                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                        <!-- STUDENT MARKSHEET LINK  -->
                                       
                             <?php   $subject_marksPD = $this->db->get_where('mark',array('student_id'=>$row['student_id']))->row()->student_id; ?>
				                	      <?php if($subject_marksPD  !=''){?>                                
                                        <li>
                                            <a href="<?php echo site_url();?>admin/student_marksheet_print_view/<?php echo $row['student_id'];?>"  target="_blank">
                                                <i class="entypo-chart-bar"></i>
                                                    <?php echo get_phrase('mark_sheet');?>
                                                </a>
                                        </li>
                                        <?php } ?>


                                        <!-- STUDENT PROFILE LINK -->
                                        <li>
                                            <a href="<?php echo site_url('admin/student_profile/'.$row['student_id']);?>">
                                                <i class="entypo-user"></i>
                                                    <?php echo get_phrase('profile');?>
                                                </a>
                                        </li>
                                        
                                         <!-- ROOM CHANGE REQUEST -->
                                        <li>
                                            <a href="<?php echo site_url('admin/student_roomchange_request/'.$row['student_id']);?>">
                                                <i class="entypo-user"></i>
                                                    Room change request
                                                </a>
                                        </li>

                                        <!-- STUDENT EDITING LINK -->
                                        <li>
                                            <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_student_edit/'.$row['student_id']);?>');">
                                                <i class="entypo-pencil"></i>
                                                    <?php echo get_phrase('edit');?>
                                                </a>
                                        </li>
                                       <!-- <li>
                                            <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/student_id/'.$row['student_id']);?>');">
                                                <i class="entypo-vcard"></i>
                                                <?php echo get_phrase('generate_id');?>
                                            </a>
                                        </li>-->

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
        <?php
            $query = $this->db->get_where('section' , array('class_id' => $class_id));
            if ($query->num_rows() > 0):
                $sections = $query->result_array();
                foreach ($sections as $row):
        ?>
            <div class="tab-pane" id="<?php echo $row['section_id'];?>">

                <table class="table table-bordered datatable">
                    <thead>
                         <tr>
                            <th width="80"><div><?php echo get_phrase('id_no');?></div></th>
                            <th width="80"><div><?php echo get_phrase('photo');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th class="span3"><div><?php echo get_phrase('address');?></div></th>
                            <th><div><?php echo get_phrase('email');?></div></th>
                            <th><div><?php echo get_phrase('mobile');?></div></th>
                            <th><div><?php echo get_phrase('parent_name');?></div></th>
                            <th><div><?php echo get_phrase('Due_fee');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('RFID');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('Roll_No');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('birthday');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('Hostel Membar');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('hostel_id');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('dormitory_id');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('is_transport_member');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('transport_start_id');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('transport_stop_id');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('otherfields');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $students   =   $this->db->get_where('enroll' , array(
                                    'class_id'=>$class_id , 'section_id' => $row['section_id'] , 'year' => $running_year
                                ))->result_array();
                                foreach($students as $row):?>
                        <tr>
                            <td><?php $student_d = $this->db->get_where('student' , array(
                                    'student_id' => $row['student_id']
                                ))->row();
                                if($student_d->status==0){
                                    continue;
                                }
                                  echo $student_d->student_code;

                                  ?></td>
                            <td><img src="<?php echo $this->crud_model->get_image_url('student',$row['student_id']);?>" class="img-circle" width="30" /></td>
                            <td>
                                <a href="<?php echo site_url('admin/student_profile/'.$row['student_id']);?>">
                               <?php
                              
                                 $resultfee = @$this->db->query("select sum(gross_amount) as amount from invoices where student_id = ".$row['student_id']." AND paid_status = 'unpaid'")->row();

                               // @$resultfee->amount;
                               if(@$resultfee->amount !=""){
                               echo  '<div class="label label-default">Due fee</div>';
                               }
                               echo  $student_d->name;
                             ?>
                             </a><
                            </td>
                            <td>
                                <?php
                                    echo $this->db->get_where('student' , array(
                                        'student_id' => $row['student_id']
                                    ))->row()->address;
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo $this->db->get_where('student' , array(
                                        'student_id' => $row['student_id']
                                    ))->row()->email;
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo $student_d->phone;
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo @$this->db->get_where('parent' , array(
                                        'parent_id' => $student_d->parent_id
                                    ))->row()->name;
                                ?>
                            </td>
                             <td>
                                <?php
                                 echo  @$resultfee->amount;
                                ?>
                            </td>
							
							 <td class="datahidden">
                              <?php echo $row['card_code'];?>
                            </td>
							<td class="datahidden">
                              <?php echo $row['roll'];?>
                            </td>
							 <td class="datahidden"> <?php echo $student_d->birthday; ?> </td>
							 <td class="datahidden"> <?php $hostel_member=$student_d->is_hostel_member  ?>
<?php if ($hostel_member==1){ echo 'Yes';} else{ echo 'No';} ?>	 </td>
                           <td class="datahidden"><?php echo $student_d->hostel_id;?> </td>
                           <td class="datahidden"><?php echo $student_d->dormitory_id;?> </td>
							 <td class="datahidden"> <?php $transport_member=$student_d->is_transport_member  ?>
<?php if ($transport_member==1){ echo 'Yes';} else{ echo 'No';} ?>	 </td>
                            <td class="datahidden"> <?php echo $student_d->transport_id;?> </td>
                            <td class="datahidden"> <?php echo $student_d->transport_stop;?> </td>
                            <td class="datahidden"> <?php echo $student_d->otherfields;?> </td>
							
                            <td>

                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                        <!-- STUDENT MARKSHEET LINK  -->
                                      
                               <?php   $subject_marksPD = $this->db->get_where('mark',array('student_id'=>$row['student_id']))->row()->student_id; ?>
				                	      <?php if($subject_marksPD  !=''){?>                                
                                        <li>
                                            <a href="<?php echo base_url();?>admin/student_marksheet_print_view/<?php echo $row['student_id'];?>"  target="_blank">
                                                <i class="entypo-chart-bar"></i>
                                                    <?php echo get_phrase('mark_sheet');?>
                                                </a>
                                        </li>
                                        <?php } ?>

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
                                        <li>
                                            <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/student_id/'.$row['student_id']);?>');">
                                                <i class="entypo-vcard"></i>
                                                <?php echo get_phrase('generate_id');?>
                                            </a>
                                        </li>

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
<?php } else { ?>
<?php /*
<!--<div class="row">
    <div class="col-md-12">

        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#home" data-toggle="tab">
                    <span class="visible-xs"><i class="entypo-users"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('all_students');?></span>
                </a>
            </li>
        <?php
            $query = $this->db->get_where('section');
 
            if ($query->num_rows() > 0):
                $sections = $query->result_array();
                foreach ($sections as $row):
        ?>


        <?php endforeach;?>
        <?php endif;?>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="home">

                <table class="table table-bordered" id="student_datatable">
                    <thead>
                        <tr>
                            <th  class="datahidden""><div></div></th>
                            <th width="80"><div><?php echo get_phrase('id_no');?></div></th>
                            <th width="80"><div><?php echo get_phrase('photo');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                              <th><div><?php echo get_phrase('class');?></div></th>
                                <th><div><?php echo get_phrase('section');?></div></th>
                            <th><div><?php echo get_phrase('house');?></div></th>
                            <th  class="datahidden"><div><?php echo get_phrase('email');?></div></th>
                            <th><div><?php echo get_phrase('emergency_contact');?></div></th>
                            <th class="datahidden"><div ><?php echo get_phrase('parent_name');?></div></th>
                            <th><div><?php echo get_phrase('Due_fee');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('RFID');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('Roll_No');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('birthday');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('Hostel Membar');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('hostel_id');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('dormitory_id');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('is_transport_member');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('transport_start_id');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('transport_stop_id');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('otherfields');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                     
                          $this->db->select('E.*');
               $this->db->from('enroll AS E');
               $this->db->order_by('E.class_id', 'ASC'); 
               $period = $this->db->get()->result_array();
            
                                foreach($period as $row):?>


                        <tr>
                        <th  class="datahidden""></th>
                            <td><?php $student_d = $this->db->get_where('student' , array(
                                    'student_id' => $row['student_id']
                                ))->row();
                                  echo $student_d->student_code; 
                                  ?>
                                </td>
                            <td><img src="<?php echo $this->crud_model->get_image_url('student',$row['student_id']);?>" class="img-circle" width="30" /></td>
                            <td>
                                  <a href="<?php echo site_url('admin/student_profile/'.$row['student_id']);?>">  <?php
                                 $resultfee = @$this->db->query("select sum(gross_amount) as amount from invoices where student_id = ".$row['student_id']." AND paid_status = 'unpaid'")->row();

                               echo  $student_d->name;
                             ?></a>
                            </td>
                            	<td>
                            <?php  echo $this->db->get_where('class' , array( 'class_id' => $row['class_id']))->row()->name; ?>
                            </td>
                            	<td>
                            	<?php  echo $this->db->get_where('section' , array( 'section_id' => $row['section_id']))->row()->name; ?>
                           
                            </td>
                            <td>
                                <?php
                                     $house_id=$this->db->get_where('assign_house' , array(
                                        'student_id' => $row['student_id']
                                    ))->row()->house_id;
                                   echo $this->db->get_where('house_info' , array( 'house_id' => $house_id))->row()->name; 
                                ?>
                            </td>
                            <td  class="datahidden">
                                <?php
                                    echo $this->db->get_where('student' , array(
                                        'student_id' => $row['student_id']
                                    ))->row()->email;
                                ?>
                            </td>
                             <td>
                                <?php
                                    echo $student_d->phone;
                                ?>
                            </td>
                            <td class="datahidden">
                                <?php
                                    echo @$this->db->get_where('parent' , array(
                                        'parent_id' => $student_d->parent_id
                                    ))->row()->name;
                                ?>
                            </td>
                             <td>
                                <?php
                                 echo  @$resultfee->amount;
                                ?>
                            </td>
							 <td class="datahidden">
                              <?php echo $row['card_code'];?>
                            </td>
							<td class="datahidden">
                              <?php echo $row['roll'];?>
                            </td>
							 <td class="datahidden"> <?php echo $student_d->birthday; ?> </td>
							 <td class="datahidden"> <?php $hostel_member=$student_d->is_hostel_member  ?>
<?php if ($hostel_member==1){ echo 'Yes';} else{ echo 'No';} ?>	 </td>
                           <td class="datahidden"><?php echo $student_d->hostel_id;?> </td>
                           <td class="datahidden"><?php echo $student_d->dormitory_id;?> </td>
							 <td class="datahidden"> <?php $transport_member=$student_d->is_transport_member  ?>
<?php if ($transport_member==1){ echo 'Yes';} else{ echo 'No';} ?>	 </td>
                            <td class="datahidden"> <?php echo $student_d->transport_id;?> </td>
                            <td class="datahidden"> <?php echo $student_d->transport_stop;?> </td>
                            <td class="datahidden"> <?php echo $student_d->otherfields;?> </td>
							
							
                            <td>

                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                      
                                     
                                  <?php   $subject_marksPD = $this->db->get_where('mark',array('student_id'=>$row['student_id']))->row()->student_id; ?>
				                	      <?php if($subject_marksPD  !=''){?>                                
                                        <li>
                                            <a href="<?php echo base_url('admin/student_marksheet_print_view/'.$row['student_id']);?>"  target="_blank">
                                                <i class="entypo-chart-bar"></i>
                                                    <?php echo get_phrase('mark_sheet');?>
                                                </a>
                                        </li>
                                        <?php } ?>
                                
                                        <li>
                                            <a href="<?php echo site_url('admin/student_profile/'.$row['student_id']);?>">
                                                <i class="entypo-user"></i>
                                                    <?php echo get_phrase('profile');?>
                                                </a>
                                        </li>

                                        <li>
                                            <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_student_edit/'.$row['student_id']);?>');">
                                                <i class="entypo-pencil"></i>
                                                    <?php echo get_phrase('edit');?>
                                                </a>
                                        </li>
                                     

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
        <?php
            $query = $this->db->get_where('section' , array('class_id' => $class_id));
            if ($query->num_rows() > 0):
                $sections = $query->result_array();
                foreach ($sections as $row):
        ?>
            <div class="tab-pane" id="<?php echo $row['section_id'];?>">

                <table class="table table-bordered datatable">
                    <thead>
                         <tr>
                            <th width="80"><div><?php echo get_phrase('id_no');?></div></th>
                            <th width="80"><div><?php echo get_phrase('photo');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th class="span3"><div><?php echo get_phrase('address');?></div></th>
                            <th><div><?php echo get_phrase('email');?></div></th>
                            <th><div><?php echo get_phrase('mobile');?></div></th>
                            <th><div><?php echo get_phrase('parent_name');?></div></th>
                            <th><div><?php echo get_phrase('Due_fee');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('RFID');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('Roll_No');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('birthday');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('Hostel Membar');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('hostel_id');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('dormitory_id');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('is_transport_member');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('transport_start_id');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('transport_stop_id');?></div></th>
                            <th class="datahidden"><div><?php echo get_phrase('otherfields');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $students   =   $this->db->get_where('enroll' , array(
                                    'class_id'=>$class_id , 'section_id' => $row['section_id'] , 'year' => $running_year
                                ))->result_array();
                                foreach($students as $row):?>
                        <tr>
                            <td><?php $student_d = $this->db->get_where('student' , array(
                                    'student_id' => $row['student_id']
                                ))->row();
                                  echo $student_d->student_code;

                                  ?></td>
                            <td><img src="<?php echo $this->crud_model->get_image_url('student',$row['student_id']);?>" class="img-circle" width="30" /></td>
                            <td>
                                 <a href="<?php echo site_url('admin/student_profile/'.$row['student_id']);?>">  <?php
                                 $resultfee = @$this->db->query("select sum(gross_amount) as amount from invoices where student_id = ".$row['student_id']." AND paid_status = 'unpaid'")->row();

                               echo  $student_d->name;
                             ?></a>
                            </td>
                            <td>
                                <?php
                                    echo $this->db->get_where('student' , array( 'student_id' => $row['student_id'] ))->row()->address;
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo $this->db->get_where('student' , array(
                                        'student_id' => $row['student_id']
                                    ))->row()->email;
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo $student_d->phone;
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo @$this->db->get_where('parent' , array(
                                        'parent_id' => $student_d->parent_id
                                    ))->row()->name;
                                ?>
                            </td>
                             <td>
                                <?php
                                 echo  @$resultfee->amount;
                                ?>
                            </td>
							
							 <td class="datahidden">
                              <?php echo $row['card_code'];?>
                            </td>
							<td class="datahidden">
                              <?php echo $row['roll'];?>
                            </td>
							 <td class="datahidden"> <?php echo $student_d->birthday; ?> </td>
							 <td class="datahidden"> <?php $hostel_member=$student_d->is_hostel_member  ?>
<?php if ($hostel_member==1){ echo 'Yes';} else{ echo 'No';} ?>	 </td>
                           <td class="datahidden"><?php echo $student_d->hostel_id;?> </td>
                           <td class="datahidden"><?php echo $student_d->dormitory_id;?> </td>
							 <td class="datahidden"> <?php $transport_member=$student_d->is_transport_member  ?>
<?php if ($transport_member==1){ echo 'Yes';} else{ echo 'No';} ?>	 </td>
                            <td class="datahidden"> <?php echo $student_d->transport_id;?> </td>
                            <td class="datahidden"> <?php echo $student_d->transport_stop;?> </td>
                            <td class="datahidden"> <?php echo $student_d->otherfields;?> </td>
							
                            <td>

                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                <?php   $subject_marksPD = $this->db->get_where('mark',array('student_id'=>$row['student_id']))->row()->student_id; ?>
				                	      <?php if($subject_marksPD  !=''){?>                                
                                        <li>
                                            <a href="<?php echo site_url('admin/student_marksheet_print_view/'.$row['student_id']);?>"  target="_blank">
                                                <i class="entypo-chart-bar"></i>
                                                    <?php echo get_phrase('mark_sheet');?>
                                                </a>
                                        </li>
                                        <?php } ?>

                                  
                                        <li>
                                            <a href="<?php echo site_url('admin/student_profile/'.$row['student_id']);?>">
                                                <i class="entypo-user"></i>
                                                    <?php echo get_phrase('profile');?>
                                                </a>
                                        </li>

                                
                                        <li>
                                            <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_student_edit/'.$row['student_id']);?>');">
                                                <i class="entypo-pencil"></i>
                                                    <?php echo get_phrase('edit');?>
                                                </a>
                                        </li>
                                        <li>
                                            <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/student_id/'.$row['student_id']);?>');">
                                                <i class="entypo-vcard"></i>
                                                <?php echo get_phrase('generate_id');?>
                                            </a>
                                        </li>

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
</div>-->
*/ ?>
<div class="tab-pane box active" id="list">

<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="studens">
    <thead>
        <tr>
            <th width="40"><div><?php echo get_phrase('student_id');?></div></th>
            <th><div><?php echo get_phrase('photo');?></div></th>
            <th><div><?php echo get_phrase('name');?></div></th>
            <th><div><?php echo get_phrase('class');?></div></th>
            <th><div><?php echo get_phrase('section');?></div></th>
            <th><div><?php echo get_phrase('house');?></div></th>
            <th><div><?php echo get_phrase('emergency_contact');?></div></th>
            <th><div><?php echo get_phrase('due_fee');?></div></th>
            <th><div><?php echo get_phrase('options');?></div></th>
        </tr>
    </thead>
</table>
</div>
<?php } ?>
<script type="text/javascript">

    function reload_url() {
        class_selection = $('#class_selection').val();
        section_id = $('#section_id').val();
        if(class_selection != ""){
          window.location.href = "<?php echo site_url();?>/admin/student_information/"+class_selection;
        }
    }



        $(document).ready(function() {
          $('#student_datatable').DataTable( {
              dom: 'Bfrtip',
              iDisplayLength: 10,
              buttons: [
              {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':not(:last-child)',
                }
 },
      {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':not(:last-child)',
                }
 },
  
              ],
        
              search: true
          });
        });
</script>


<script type = 'text/javascript'>

$('input[type=file]').change(function () {
alert(this.files[0].mozFullPath);
});


var class_id = '';
jQuery(document).ready(function($) {
$.fn.dataTable.ext.errMode = 'throw';
$('#studens').DataTable({
"processing": true,
"serverSide": true,
"ajax":{
"url": "<?php echo site_url('admin/get_students') ?>",
"dataType": "json",
"type": "POST",
},
"columns": [
{ "data": "student_id" },
{ "data": "photo" },
{ "data": "name" },
{ "data": "class_id" },
{ "data": "section_id" },
{ "data": "house" },
{ "data": "phone" },
{ "data": "due_fee" },
{ "data": "options" },
],
"columnDefs": [
{
     "targets": [1,3,4,5,7],
    "orderable": false
},
]
});

$("#submit").attr('disabled', 'disabled');
});

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

