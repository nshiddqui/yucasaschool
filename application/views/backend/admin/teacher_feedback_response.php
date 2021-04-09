<?php
 $online_exam_id = $this->uri->segment(3);
 $online_exam_details = $this->db->get_where('teacher_feedback', array('id' => $online_exam_id))->row_array();
	  //print_r($online_exam_details);
 $students_array = $this->db->query("select * from student_online_feedback_result where feedback_id = ".$online_exam_details['id']."  GROUP BY  teacher_id" )->result_array(); 
// $students_array= $this->db->get_where('student_online_feedback_result ', array('feedback_id' => $online_exam_details['id'], 'teacher_id' => $online_exam_id))->result_array();
 $total_mark     = $this->crud_model->get_total_mark($online_exam_id);
?>
<?php $activeTab = "teacher_feedback"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Teacher Dashboard</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/teacher_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>


<div class="container-fluid teacher-feedback">
  
  <div class="row">

        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        <i class="entypo-plus-circled"></i>
                        Quaterly Feedback Form Responses           
                    </div>
                </div>
                <div class="panel-body">
                   <table class="table datatable table-stripped feedbackResponse">
                      <thead>
                          <tr>
                              <th>Teacher Name</th>
                              <th>Average Rating</th>
                              <th>Title</th>
                          </tr>
                      </thead>

                      <tbody>
            	<?php

              // echo "<pre>";
              //   print_r($students_array);
              // echo "</pre>";
                  foreach ($students_array as $row):

                    $total_student =  $this->db->get_where('student_online_feedback_result ', array('teacher_id' => $row['teacher_id'],'feedback_id' =>$online_exam_details['id']))->result();

                    
                  

                  
                     $question_title =  $this->db->get_where('teacher_feedback',array('id'=>$row['feedback_id']))->row()->title;
                   

                    
                    ?>
                    <tr class="button"reviewId="<?php $row['teacher_id']; ?>">
                    	<td>
                          <?php  echo  $this->db->get_where('teacher',array('teacher_id'=>$row['teacher_id']))->row()->name; ?>
                      </td>
                    	<td>
                    <?php 	 
                      $rating_total = 0;$student_value = 0;
                    foreach ($total_student as $key => $total_student_row) {
                        $answer_json =   json_decode($total_student_row->answer_script);
                         // echo "<pre>";
                         // print_r($answer_json);
                         foreach($answer_json as $dt){
                           $submitted_answer =  json_decode($dt->submitted_answer);
                           $rating =  implode(" ", $submitted_answer);
                           $total_rating = $total_rating+$rating;
                           $student_value++;
                         }
                          } 
                      //echo $total_rating/$student_value;
                      echo    $total_rating/$student_value;
                    ?>

                    	</td>
                    	<td>
                        <?php echo $question_title;?>    
                    	</td>
                    </tr>
            <?php endforeach; ?>
            </tbody>
                  </table>
    
                </div>
            </div>
        </div>
      
</div>

</div>



<script>

$('.feedbackResponse tbody tr').click(()=>{
    let reviewId = $(this).attr('reviewId');
    showAjaxModal('<?php echo site_url('modal/popup/teacher_feedback_response_view/');?>' + reviewId);
});

  $(document).ready(function() {
        setTimeout(() => $('.selectpicker').select2(), 1000);
    });

</script>