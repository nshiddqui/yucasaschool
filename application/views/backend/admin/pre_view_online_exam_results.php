<?php
    $online_exam_details = $this->db->get_where('pre_online_exam', array('online_exam_id' => $online_exam_id))->row_array();
    $students_array      = $this->db->get_where('pre_enroll', array('class_id' => $online_exam_details['class_id'], 'section_id' => $online_exam_details['section_id'], 'year' => $online_exam_details['running_year']))->result_array();
    $subject_info        = $this->crud_model->get_subject_info($online_exam_details['subject_id']);
    $total_mark          = $this->crud_model->get_total_mark($online_exam_id);
?>
<?php $activeTab = "pre_exam"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Pre Exam</a></li>
        <li class="active">Manage Online Exam</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/admission_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<div class="" style="text-align: center;">
    <h3><?php echo $online_exam_details['title']; ?></h3>
    <?php foreach ($subject_info as $subject): ?>
        <h4><?php echo get_phrase('subject').': '.$subject['name']; ?></h4>
    <?php endforeach; ?>
    <h4><?php echo get_phrase('total_mark').': '.$total_mark; ?></h4>
    <h4><?php echo get_phrase('minimum_percentage').': '.$online_exam_details['minimum_percentage'].'%'; ?></h4>
    <?php
        $current_time = time();
        $exam_end_time = strtotime(date('Y-m-d', $online_exam_details['exam_date']).' '.$online_exam_details['time_end']);
        if ($current_time < $exam_end_time):?>
            <h4 style="color: #ef5350;"> <strong><?php echo get_phrase('exam_has_not_finished_yet'); ?></strong></h4>
    <?php endif ?>
</div>
<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered" id="table_export">
			<thead>
                <tr>
                    <th><div><?php echo get_phrase('student_name');?></div></th>
                    <th><div><?php echo get_phrase('obtained_marks');?></div></th>
                    <th><div><?php echo get_phrase('result');?></div></th>
                </tr>
            </thead>
            <tbody>
            	<?php
                    foreach ($students_array as $row):
                    ?>
                    <tr>
                    	<td>
                            <?php
                                $student_details = $this->db->get_where('pre_student', array('pre_student_id' => $row['student_id']))->row_array();
                                echo $student_details['name'];
                            ?>
                        </td>
                    	<td>
                    		<?php
                                $query = $this->db->get_where('pre_online_exam_result', array('online_exam_id' => $online_exam_id, 'student_id' => $row['student_id']));
                                if ($query->num_rows() > 0){
                                    $query_result = $query->row_array();
                                    echo $query_result['obtained_mark'];
                                }
                                else {
                                    echo 0;
                                }
                             ?>
                    	</td>
                    	<td>
                            <?php
                                $query = $this->db->get_where('pre_online_exam_result', array('online_exam_id' => $online_exam_id, 'student_id' => $row['student_id']));
                                if ($query->num_rows() > 0){
                                    $query_result = $query->row_array();
                                    echo get_phrase($query_result['result']);
                                }
                                else {
                                    echo get_phrase('fail').' ( '.get_phrase('absent').' )';
                                }
                             ?>
                    	</td>
                    </tr>
            <?php endforeach; ?>
            </tbody>
		</table>
	</div>
</div>
</div>
