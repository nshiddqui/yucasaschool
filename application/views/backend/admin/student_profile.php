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
<?php $activeTab = "student"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Admission</a></li>
        <li class="active">Admit Student</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/admission_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<?php
/*echo "<pre>";
print_r($create_dianamic_field);
echo "</pre>";*/
  $student_info = $this->db->get_where('student', array('student_id' => $student_id))->result_array();
  foreach ($student_info as $row):
    $enroll_info = $this->db->get_where('enroll', array(
      'student_id' => $row['student_id'], 'year' => $running_year
    ));
    $class_id     = $enroll_info->row()->class_id;
     $section_id     = $enroll_info->row()->section_id;
    $exams        = $this->crud_model->get_exams();

    //$route_stops_details= new object();
    if( $row['transport_id'] != NULL){
      $routedetails = $this->db->get_where('routes', array('id' => $row['transport_id']))->row();
     
      $route_stops_details = @$this->db->get_where('route_stops', array('id' => $row['transport_stop']))->row()->stop_name;
    }
    $room_no = "";$room_type="";$hosteldetails="";
  if($row['dormitory_id'] != NULL){
   $roomdetails = $this->db->get_where('rooms', array('id' => $row['dormitory_id']))->row();
   $room_no = $roomdetails->room_no;
   $room_type = $roomdetails->room_type;
   $hosteldetails = $this->db->get_where('hostels', array('id' => $roomdetails->hostel_id))->row()->name;
  }
   
?>


<?php
    $id = $student_id;
    $student = $this->db->get_where('student',array('student_id'=>$id))->row();
    $class_id = $this->db->get_where('enroll',array('student_id'=>$id))->row()->class_id;
   
   $section_id = $this->db->get_where('enroll',array('student_id'=>$id))->row()->section_id;
    $otherfields = $student->otherfields; 
    $json_data   = @json_decode($otherfields);
    $jsonval = "";

?>

<?php
     $field_arr = array();
     $create_status = $this->db->get_where('registration_form_setting',array('status'=>'1','created_html' => '0','genrate_id'=>'1'))->result();
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



    




<div class="profile-env">
	<header class="row">
	
		<div class="col-md-3">
            <div class="id_card_holder">
                <div class="id-card">
                    <div class="header" style="text-align: center;margin-left: 0px">
                        <img src="<?php echo base_url(); ?>uploads/logo.png"  style="max-height:60px;max-width: 60px"/>
                        <!-- <h2 style="display: inline;margin-left: 15px"><?php echo $this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;?></h2> -->
                    </div>
                    <div class="photo">
                        <img class="img-circle" src="<?php echo $this->crud_model->get_image_url('student',$student->student_id);?>" class="img-circle" width="30" />
                    </div>
                    <h2><?php echo $student->student_code;?></h2>
                    <div style="text-align: justify;margin-left: 7px">
                       <table class="">
                           <tr>
                               <td>Name</td>
                               <td>: </td>
                               <td > <?php echo $student->name; ?></td>
                           </tr>
                           <tr>
                               <td>Parent</td>
                               <td>: </td>
                               <td> <?php echo $this->db->get_where('parent',array('parent_id'=>$student->parent_id))->row()->name; ?></td>
                           </tr>
                           <tr>
                               <td>Class</td>
                               <td>: </td>
                               <td> <?php echo $class_name= $this->db->get_where('class',array('class_id'=>$class_id))->row()->name; ?>
                                <?php  $section_name= $this->db->get_where('section',array('section_id'=>$section_id))->row()->name; ?></td>
                           </tr>
                          
                           <tr>
                               <td>Contact </td>
                               <td>: </td>
                               <td> <?php echo $student->phone; ?></td>
                           </tr>
                           <?php foreach ($field_arr as $key => $dt) { 
                                    $name = $dt['name'];
                            ?>
                               <tr>
                               <td><?php echo $dt['description'];?> </td>
                               <td>: </td>
                               <td> <?php echo $dt['value'];
                                
                                ?> </td>
                           </tr>
                           <?php } ?>
            
                       </table>
                      <!--  </table> -->
                    </div>
            
                    <hr>
                  
                </div>
                
            </div>
<?php
//define date and time
$date = date("Y-m-d");

// output
 $time=strtotime($date);
?> 
<br>

<!--<div class="col-sm-12 p0 mt-4">-->
<!--  <a  target="_blank" href="<?php echo site_url('admin/print_id/'.$student->student_id);?>" class="btn btn-primary"><i class="entypo-print"></i> Print</a>-->
<!--</div>-->

		</div>
    <div class="col-md-9">

		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab1" data-toggle="tab" class="btn btn-default">
					<span class="visible-xs"><i class="entypo-home"></i></span>
					<span class="hidden-xs"><?php echo get_phrase('basic_info'); ?></span>
				</a>
			</li>
			<li class="">
				<a href="#tab2" data-toggle="tab" class="btn btn-default">
					<span class="visible-xs"><i class="entypo-user"></i></span>
					<span class="hidden-xs"><?php echo get_phrase('parent_info'); ?></span>
				</a>
			</li>
			<?php /*
			<li class="">
				<a href="#tab3" data-toggle="tab" class="btn btn-default">
					<span class="visible-xs"><i class="entypo-mail"></i></span>
					<span class="hidden-xs"><?php echo get_phrase('exam_marks'); ?></span>
				</a>
			</li>
      <li class="">
        <a href="#tab4" data-toggle="tab" class="btn btn-default">
          <span class="visible-xs"><i class="entypo-mail"></i></span>
          <span class="hidden-xs"><?php echo get_phrase('performance'); ?></span>
        </a>
      </li> */ ?>

			<!-- <li class="">
				<a href="#tab4" data-toggle="tab" class="btn btn-default">
					<span class="visible-xs"><i class="entypo-cog"></i></span>
					<span class="hidden-xs"><?php //echo get_phrase('attendance'); ?></span>
				</a>
			</li> -->
      <li class="">
				<a href="#tab5" data-toggle="tab" class="btn btn-default">
					<span class="visible-xs"><i class="entypo-cog"></i></span>
					<span class="hidden-xs">Fees</span>
				</a>
			</li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane active" id="tab1">
        <?php
         
          $basic_info_titles = ['name','parent', 'class', 'section', 'email', 'phone', 'address', 'gender', 'birthday', 'transport', 'dormitory'];
          $basic_info_values = [$row['name'], $row['parent_id'] == NULL ? '' : $this->db->get_where('parent', array('parent_id' => $row['parent_id']))->row()->name,
          $class_name, $section_name, $row['email'], $row['phone'] == NULL ? '' : $row['phone'], $row['address'] == NULL ? '' : $row['address'], $row['sex'] == NULL ? '' : $row['sex'], $row['birthday'],
          $row['transport_id'] == NULL ? '':@$routedetails->route_start.' - '.@$routedetails->route_end.'[ '.@$route_stops_details.' ]',
          $row['dormitory_id'] == NULL ? '' : @$hosteldetails.'[ '.@$room_no .' '.@$room_type.' ]'];

        if($row['otherfields'] != ""){
          $otherfields =  json_decode($row['otherfields']);
          foreach ($otherfields as $otherdt) {
            //echo $otherdt->json_field_elements;
           array_push($basic_info_titles,$otherdt->description);
           if($otherdt->type == 'imageupload' || $otherdt->type == 'documentupload'){
              $otherdtvalue  =  '<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                  <img src="'.base_url('uploads/other_student_image').'/'.$otherdt->value.'" alt="...">
                </div>';
           }else{
             $otherdtvalue =  $otherdt->value;
           }
             array_push($basic_info_values,$otherdtvalue);
          }
        }

        ?>
        <table class="table table-bordered" style="margin-top: 20px;">
          <tbody>
          <?php for ($i=0; $i < count($basic_info_titles) ; $i++) { 
           if(!in_array($basic_info_titles[$i], $field_arr)){
            ?>
            <tr>
              <td width="30%">
                <strong><?php echo get_phrase($basic_info_titles[$i]);
                ?></strong>
              </td>
              <td><?php echo $basic_info_values[$i]; ?></td>
            </tr>
          <?php }} ?>
          </tbody>
        </table>
			</div>
			<div class="tab-pane" id="tab2">
        <?php if ($row['parent_id'] == NULL) { ?>
          <div style="margin-top: 20px;">
            <center>
              <?php echo get_phrase('parent_information_is_not_available'); ?>
            </center>
          </div>
        <?php } else {
            $parent_info = $this->db->get_where('parent', array('parent_id' => $row['parent_id']))->result_array();
            $parent_info_titles = ['name', 'email', 'phone', 'address', 'profession'];
            foreach ($parent_info as $info) {
              $parent_info_values = [$info['name'], $info['email'], $info['phone'] == NULL ? '' : $info['phone'],
              $info['address'] == NULL ? '' : $info['address'], $info['profession'] == NULL ? '' : $info['profession']];
            }
          ?>
          <table class="table table-bordered" style="margin-top: 20px;">
            <tbody>
              <?php for ($i=0; $i < count($parent_info_titles); $i++) { ?>
                <tr>
                  <td width="30%"><strong><?php echo get_phrase($parent_info_titles[$i]); ?></strong></td>
                  <td><?php echo $parent_info_values[$i]; ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        <?php } ?>
			</div>
			<?php /*
			<div class="tab-pane" id="tab3" style="padding-top:15px;">
				<?php foreach ($exams as $row2) { ?>

          <div class="exam-marksheet col-md-12" style="background:#fff;margin-bottom: 10px;">
          <div class="tile-stats tile-white-gray" style="margin-top: 20px;">
      			<h3><?php echo $row2['name']; ?></h3>
      		</div>
          <table class="table table-bordered">
              <thead>
               <tr>
                   <td style="text-align: center;"><?php echo get_phrase('subject'); ?></td>
                   <td style="text-align: center;"><?php echo get_phrase('obtained_mark'); ?></td>
                   <td style="text-align: center;"><?php echo get_phrase('highest_mark'); ?></td>
                   <td style="text-align: center;"><?php echo get_phrase('grade'); ?></td>
                   <td style="text-align: center;"><?php echo get_phrase('comment'); ?></td>
               </tr>
           </thead>
           <tbody>
               <?php
                   $total_marks = 0;
                   $total_grade_point = 0;
                   $subjects = $this->db->get_where('subject' , array(
                       'class_id' => $class_id , 'year' => $running_year
                   ))->result_array();
                   foreach ($subjects as $row3):
               ?>
                   <tr>
                       <td style="text-align: center;"><?php echo $row3['name'];?></td>
                       <td style="text-align: center;">
                           <?php
                               $obtained_mark_query = $this->db->get_where('mark' , array(
                                           'subject_id' => $row3['subject_id'],
                                               'exam_id' => $row2['exam_id'],
                                                   'class_id' => $class_id,
                                                       'student_id' => $student_id ,
                                                           'year' => $running_year));
                               if ( $obtained_mark_query->num_rows() > 0) {
                                   $marks = $obtained_mark_query->result_array();
                                   foreach ($marks as $row4) {
                                       echo $row4['mark_obtained'];
                                       $total_marks += $row4['mark_obtained'];
                                   }
                               }
                           ?>
                       </td>
                       <td style="text-align: center;">
                           <?php

                           $highest_mark = $this->crud_model->get_highest_marks( $row2['exam_id'] , $class_id , $row3['subject_id'] );
                           echo $highest_mark;
                           ?>
                       </td>
                       <td style="text-align: center;">
                           <?php
                               if($obtained_mark_query->num_rows() > 0) {
                                   if ($row4['mark_obtained'] >= 0 || $row4['mark_obtained'] != '') {
                                       $grade = $this->crud_model->get_grade($row4['mark_obtained']);
                                       echo $grade['name'];
                                       $total_grade_point += $grade['grade_point'];
                                   }
                               }
                           ?>
                       </td>
                       <td style="text-align: center;">
                           <?php if($obtained_mark_query->num_rows() > 0)
                                   echo $row4['comment'];
                           ?>
                       </td>
                   </tr>
               <?php endforeach;?>
           </tbody>
          </table>

          <hr />
          <div class="col-md-12">
            <?php echo get_phrase('total_marks');?> : <?php echo $total_marks;?>
            <br>
            <?php echo get_phrase('average_grade_point');?> :
                 <?php
                     $this->db->where('class_id' , $class_id);
                     $this->db->where('year' , $running_year);
                     $this->db->from('subject');
                     $number_of_subjects = $this->db->count_all_results();
                     echo ($total_grade_point / $number_of_subjects);
                 ?>

             <br> <br>
             <a href="<?php echo site_url('admin/student_marksheet_print_view/'.$student_id.'/'.$row2['exam_id']);?>"
                 class="btn btn-primary" target="_blank">
                 <?php echo get_phrase('print_marksheet');?>
             </a>
             <hr />
           </div>
         </div>
        <?php } ?>
			</div>

			<div class="tab-pane" id="tab4">
				<div class="panel-group ">
          <div class="panel panel-default">

            <div id="hostel_info_chart" class="panel-collapse collapse in" data-expanded="true">
              <canvas id="line-chart" width="800" height="300"></canvas>
            </div>
          </div>
        </div>
			</div>
      */ ?>
			<div class="tab-pane" id="tab5">
				<?php
          $payments = $this->db->get_where('invoices', array(
            'student_id' => $row['student_id'], 'year' => $running_year
          ))->result_array();
         ?>
         <table class="table table-bordered" style="margin-top: 20px;">
           <thead>
             <tr>
               <th>#</th>
               <th> invoice id</th>
               <th><?php echo get_phrase('amount'); ?></th>
               <th><?php echo get_phrase('date'); ?></th>
               <th><?php echo get_phrase('status'); ?></th>
             </tr>
           </thead>
           <tbody>
             <?php
                $count = 1;
                foreach ($payments as $payment):
              ?>
                <tr>
                  <td><?php echo $count++; ?></td>
                  <td><?php echo $payment['custom_invoice_id']; ?></td>
                  <td><?php echo $payment['net_amount']; ?></td>
                  <td><?php echo $payment['month']; ?></td>
                  <td>
				  <?php echo $payment['paid_status']; ?>
                    <!--0<a href="#" class="btn btn-default"
                      onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_view_invoice/'.$payment['id']);?>')">
                      <?php echo get_phrase('view_invoice'); ?>
                    </a>-->
                  </td>
                </tr>
            <?php endforeach; ?>
           </tbody>
         </table>
			</div>
		</div>

		<br>

	</div>
	</header>
</div>
<?php endforeach; ?>


<script src="<?php echo base_url('assets/js/moment.js');?>"></script> 
<script src="<?php echo base_url('assets/js/Chart.bundle.min.js');?>"></script>
<script>
  new Chart(document.getElementById("line-chart"), {
  type: 'line',
  data: {
    labels: ['1st Term','2nd Term','Half Yearly' ],
    datasets: [{ 
        data: [82,69,79],
        label: "Percentage Secured",
        borderColor: "#2F4A65",
        fill: true
      }
    ]
  },
  options: {
    title: {
      display: true,
      text: 'Performance Comparision- Last Exams'
    },
    scales: {
        yAxes: [{
            display: true,
            ticks: {
                suggestedMin: 0,    // minimum will be 0, unless there is a lower value.
                // OR //
                beginAtZero: true   // minimum value will be 0.
            }
        }]
    }
  }
});
</script>