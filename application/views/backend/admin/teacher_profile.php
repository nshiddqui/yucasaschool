<?php $activeTab = "teacher"; ?>
<style>
  .exam_chart {
    width       : 100%;
    height      : 265px;
    font-size   : 11px;
  }
</style>


<style>

    .id-card-holder {
        width: 225px;
        padding: 4px;
        margin: 0 auto;
        background-color: #1f1f1f;
        border-radius: 5px;
        position: relative;
    }
    .id-card-holder:after {
        content: '';
        width: 7px;
        display: block;
        background-color: #0a0a0a;
        height: 100px;
        position: absolute;
        top: 105px;
        border-radius: 0 5px 5px 0;
    }
    .id-card-holder:before {
        content: '';
        width: 7px;
        display: block;
        background-color: #0a0a0a;
        height: 100px;
        position: absolute;
        top: 105px;
        left: 222px;
        border-radius: 5px 0 0 5px;
    }
    .id-card {

        background-color: #fff;
        padding: 10px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 0 1.5px 0px #b9b9b9;
    }
    .id-card img {
        margin: 0 auto;
    }
    .header img {
        width: 100px;
        margin-top: 15px;
    }
    .photo img {
        width: 80px;
        margin-top: 15px;
    }
    .id-card  h2 {
        font-size: 15px;
        margin: 5px 0;
    }
    .id-card h3 {
        font-size: 12px;
        margin: 2.5px 0;
        font-weight: 300;
    }
    .qr-code img {
        width: 50px;
    }
    .id-card  p {
        font-size: 5px;
        margin: 2px;
    }
    .id-card-hook {
        background-color: #000;
        width: 70px;
        margin: 0 auto;
        height: 15px;
        border-radius: 5px 5px 0 0;
    }
    .id-card-hook:after {
        content: '';
        background-color: #d7d6d3;
        width: 47px;
        height: 6px;
        display: block;
        margin: 0px auto;
        position: relative;
        top: 6px;
        border-radius: 4px;
    }
    .id-card-tag-strip {
         width: 45px;
        height: 40px;
        background-color: #2e3e65;
        margin: 0 auto;
        border-radius: 5px;
        position: relative;
        top: 9px;
        z-index: 1;
        border: 1px solid #2e3e65;
    
    }
    .id-card-tag-strip:after {
        content: '';
        display: block;
        width: 100%;
        height: 1px;
        background-color: #c1c1c1;
        position: relative;
        top: 10px;
    }
    .id-card-tag {
        width: 0;
        height: 0;
        border-left: 100px solid transparent;
        border-right: 100px solid transparent;
        border-top: 100px solid #0958db;
        margin: -10px auto -30px auto;
    }
    .id-card-tag:after {
        content: '';
        display: block;
        width: 0;
        height: 0;
        border-left: 50px solid transparent;
        border-right: 50px solid transparent;
        border-top: 100px solid #d7d6d3;
        margin: -10px auto -30px auto;
        position: relative;
        top: -130px;
        left: -50px;
    }
</style>


<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Teacher</a></li>
        <li class="active">Teacher Profile</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/teacher_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>
<?php
/*echo "<pre>";
print_r($create_dianamic_field);
echo "</pre>";*/
  $teacher_info = $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->result_array();
  foreach ($teacher_info as $row):
  
    //$exams        = $this->crud_model->get_exams();   
?>


<?php
    $teacher = $this->db->get_where('teacher',array('teacher_id'=>$teacher_id))->row();
    $otherfields = $teacher->otherfields; 
    $json_data   = @json_decode($otherfields);
    $jsonval = "";

?>

<?php
     $field_arr = array();
     $create_status = $this->db->get_where('registration_form_setting_teacher',array('status'=>'1','created_html' => '0'))->result();
     $i =0;
     foreach ($create_status as $key => $field_dt) {
        $field_arr[$i]['name'] = $field_dt->name;
        $field_arr[$i]['description'] = $field_dt->description;

        $field_arr[$i]['value'] = "";
          foreach ($json_data as $key => $jdt) {
              if($field_dt->name == $jdt->name){
                $field_arr[$i]['value'] = $jdt->value;
               }
          }
        $i++;
     }
?>
<section class="container-fluid">
  <div class="row mt-4 mb-4">

	
	<div class="col-md-3">
      <div class="id-card-tag-strip"></div>
<div class="id-card-hook"></div>
<div class="id-card">
        <div class="header" style="text-align: center;margin-left: 0px">
            <img src="<?php echo base_url(); ?>uploads/logo.png" style="max-height:60px;max-width: 60px">
          
        </div>
        <div class="photo">
            <img class="img-circle" src="<?php echo $this->crud_model->get_image_url('teacher',$teacher->teacher_id);?>" width="30">
        </div>
        <h2><?php echo $teacher->rfid_code;?></h2>
        <div style="text-align: justify;margin-left: 7px">
           <table class="">
               <tbody><tr>
                   <td>Name</td>
                   <td>:</td>
                   <td><?php echo $teacher->name;?></td>
               </tr>
               <tr>
                   <td>Contact </td>
                   <td>:</td>
                   <td>  <?php echo $teacher->phone;?></td>
               </tr>
               <tr>
                   <td>Designation </td>
                   <td>:</td>
                   <td>  <?php echo $teacher->designation;?></td>
               </tr>
               
           </tbody></table>
          <!--  </table> -->
        </div>

        <hr>
       



    </div>

<br>
<?php
//define date and time
$date = date("Y-m-d");

// output
 $time=strtotime($date);
?> 
<div class="col-sm-12 p0 mb-4 student_tags">
<?php
$id = $teacher_id;
$attendance = @$this->db->query("Select *from emp_attendance where emp_id=$id AND role_id=5 AND timestamp='$time'")->row();
if(@$attendance->status =="1"){
?>
<span class="badge badge-info">Attendance Status : Present</span>
<?php } elseif(@$attendance->status =="0") { ?>
<span class="badge badge-info">Attendance Status : Absent</span>
<?php }else { ?>
<span class="badge badge-info">Attendance Status : Not Mark</span>
<?php } ?>

<?php
$id = $teacher_id;

$datetime = date("m/d/Y");

$attendance = @$this->db->query("Select * from leave_request where request_by=3 AND role_id=5 AND from_date='$datetime'")->row();
if(@$attendance->status =="pending"){
?>
<span class="badge badge-warning">Leave Status : Present</span>
<?php }  ?>


</div>


		</div>
    <div class="col-md-9">

    <ul class="nav nav-tabs">
      <li class="active"><a href="#basicinfo" data-toggle="tab" class="btn btn-default" aria-expanded="true">
          <span class="visible-xs"><i class="entypo-home"></i></span>
          <span class="hidden-xs">Basic Info</span>
        </a>
      </li>

      <li class="">
        <a href="#classes" data-toggle="tab" class="btn btn-default" aria-expanded="false">
          <span class="visible-xs"><i class="entypo-cog"></i></span>
          <span class="hidden-xs">Classes</span>
        </a>
      </li>

      <li class="">
        <a href="#salary" data-toggle="tab" class="btn btn-default" aria-expanded="false">
          <span class="visible-xs"><i class="entypo-cog"></i></span>
          <span class="hidden-xs">Salary</span>
        </a>
      </li>
    </ul>

    <div class="tab-content">
      <div class="tab-pane active bg-white" id="basicinfo">
                <table class="table table-bordered" style="margin-top: 20px;">
          <tbody>
                      <tr>
              <td width="30%">
                <strong>Name</strong>
              </td>
              <td><?php echo $teacher->name;?></td>
            </tr>
            
            
                      <tr>
              <td width="30%">
                <strong>Email</strong>
              </td>
              <td><?php echo $teacher->email;?></td>
            </tr>
                      <tr>
              <td width="30%">
                <strong>Phone</strong>
              </td>
              <td><?php echo $teacher->phone;?></td>
            </tr>
                      <tr>
              <td width="30%">
                <strong>Address</strong>
              </td>
              <td><?php echo $teacher->address;?></td>
            </tr>
                      <tr>
              <td width="30%">
                <strong>Gender</strong>
              </td>
              <td><?php echo $teacher->sex;?></td>
            </tr>
                      <tr>
              <td width="30%">
                <strong>Birthday</strong>
              </td>
              <td><?php echo $teacher->birthday;?></td>
            </tr>
                      <tr>
              <td width="30%">
                <strong>Designation</strong>
              </td>
              <td><?php echo $teacher->designation;?></td>
            </tr>
                        <?php foreach ($field_arr as $key => $dt) { 
                       echo $name = $dt['name'];
                ?>
                   <tr>
                   <td><?php echo $dt['description'];?> </td>
                   <td>: </td>
                   <td> <?php echo $dt['value'];
                    
                    ?> </td>
               </tr>
               <?php } ?>
                    </tbody>
        </table>
      </div>


      <div class="tab-pane bg-white" id="classes">
                 <table class="table table-bordered" style="margin-top: 20px;">
           <thead>
             <tr>
               <th>#</th>
               <th>Class</th>
               <th>Section</th>
               <th>Subject</th>
             </tr>
           </thead>
           <tbody>
		   
		   <?php  
		   $i=1;
		   $teacher_sub = $this->db->query( "select * from class_routine where teacher_id=$teacher_id ")->result_array(); 
		
		    foreach ($teacher_sub as $sub){
				 $section_id=$sub['section_id'];
				 $class_id=$sub['class_id'];
				 $subject_id=$sub['subject_id'];
		    ?>
			
                <tr>
                  <td><?php echo $i ;?></td>
                  <td><?php echo $this->db->get_where('class',array('class_id'=>$class_id))->row()->name; ?></td>
                  <td><?php echo $this->db->get_where('section',array('section_id'=>$section_id))->row()->name; ?></td>
                  <td><?php echo $this->db->get_where('subject',array('subject_id'=>$subject_id))->row()->name; ?></td>
                </tr>
				
			<?php $i++; } ?>
                       </tbody>
         </table>
      </div>

      
      <div class="tab-pane bg-white" id="salary">
                 <table class="table table-bordered" style="margin-top: 20px;">
           <thead>
             <tr>
               <th>#</th>
               <th>Month</th>
               <th>Amount</th>
               <th>Payment Method</th>
               <th>Year</th>
               <th>Status</th>
             </tr>
           </thead>
           <tbody>
		   <?php  
		   $i=1;
		   $teacher_salary = $this->db->query( "select * from salary_payments where user_id=$teacher_id AND payment_to='teacher'")->result_array(); 
		 
		    foreach ($teacher_salary as $salary){
				
		    ?>
                   <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $salary['salary_month']; ?></td>
                  <td><?php echo $salary['net_salary']; ?></td>
                  <td><?php echo $salary['payment_method']; ?></td>
                  <td><?php echo $salary['academic_year_id']; ?> </td>
                  <td>
         <?php if($salary['status']==1){ echo 'Paid';} else { echo 'Unpaid'; } ;?>                <!--0<a href="#" class="btn btn-default"
                      onclick="showAjaxModal('http://localhost/edurama_pos_full/index.php/modal/popup/modal_view_invoice/23')">
                      View Invoice                    </a>-->
                  </td>
				  
                </tr>
				<?php $i++; } ?>
                       </tbody>
         </table>
      </div>
    </div>

    <br>

  </div>
  </div>
</section>
<?php endforeach; ?>