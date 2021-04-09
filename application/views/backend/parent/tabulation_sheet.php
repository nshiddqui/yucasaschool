<?php $activeTab = "exam"; 

 $marks_type    = marks_type();
 ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Exam</a></li>
        <li class="active">Tabulation Sheet</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
</div>

<div class="row">
	<div class="col-md-12">
		<?php echo form_open(site_url('admin/tabulation_sheet'));?>
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label"><?php echo get_phrase('select_student');?></label>
					<select name="class_id" class="form-control selectboxit" id = 'class_id'>
                        <option value=""><?php echo get_phrase('select_student');?></option>
                        <?php 
                        $classes = $this->db->get('student',['parent_id'=>$this->session->userdata('login_user_id')])->result_array();
                        foreach($classes as $row):
                        ?>
                            <option value="<?php echo $row['student_id'];?>"
                            	<?php if ($class_id == $row['student_id']) echo 'selected';?>>
                            		<?php echo $row['name'];?>
                            </option>
                        <?php
                        endforeach;
                        ?>
                    </select>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
				<label class="control-label"><?php echo get_phrase('exam');?></label>
					<select name="exam_id" class="form-control selectboxit" id = 'exam_id'>
                        <option value=""><?php echo get_phrase('select_an_exam');?></option>
                        <?php 
                        $exams = $this->db->get_where('exam' , array('year' => $running_year))->result_array();
                        foreach($exams as $row):
                        ?>
                            <option value="<?php echo $row['exam_id'];?>"
                            	<?php if ($exam_id == $row['exam_id']) echo 'selected';?>>
                            		<?php echo $row['name'];?>
                            </option>
                        <?php
                        endforeach;
                        ?>
                    </select>
				</div>
			</div>
			<input type="hidden" name="operation" value="selection">
			<div class="col-md-4 top-first-btn">
				<button type="submit" id = '' class="btn btn-info"><?php echo get_phrase('view_tabulation_sheet');?></button>
			</div>
		<?php echo form_close();?>
	</div>
</div>

<?php if ($class_id != '' && $exam_id != ''):?>
<br>
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4" style="text-align: center;">
		<div class="tile-stats" style="background:var(--main-bg-color);">
		<div class="icon"></div>
			<h3 style="color: #fff;">
				<?php
					$exam_name  = $this->db->get_where('exam' , array('exam_id' => $exam_id))->row()->name; 
					$student_id = $class_id;
					$students = $this->db->get_where('enroll',['student_id'=>$student_id])->result_array();
					$class_id = $students[0]['class_id'];
					$class_name = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name; 
					echo get_phrase('tabulation_sheet');
				?>
			</h3>
			<h4 style="color: #fff;">
				<?php echo get_phrase('class') . ' ' . $class_name;?> : <?php echo $exam_name;?>
			</h4>
		</div>
	</div>
	<div class="col-md-4"></div>
</div>


<hr />
<?php
$grades = $this->db->get_where('grade')->result();
function getGrade($percentage,$grades){
    foreach($grades as $grade){
        if($grade->mark_from <= $percentage && $grade->mark_upto >= $percentage){
            return $grade->name;
        }
    }
return ''; 
}?>
<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered">
			<thead>
				<tr>
				<td style="text-align: center;">
					<?php echo get_phrase('students');?> <i class="entypo-down-thin"></i> | <?php echo get_phrase('subjects');?> <i class="entypo-right-thin"></i>
				</td>
				<td style="text-align: center;">Roll no</td>
				<?php 
					$subjects = $this->db->get_where('subject' , array('class_id' => $class_id , 'year' => $running_year))->result_array();
					foreach($subjects as $row):
				?>
					<td style="text-align: center;"><?php echo $row['name'];?></td>
					
				<?php endforeach;?>
				<?php 	if($marks_type =='marks_and_grade' || $marks_type =='only_marks'){  ?>
				
				    <td style="text-align: center;">Marks Obtained</td>
				    <td style="text-align: center;">Maximum marks/subject</td>
				    <td style="text-align: center;">Total marks obtained</td>
				    <td style="text-align: center;">Percentage(in %)</td>
				    <td style="text-align: center;">Grade</td>
				    <td style="text-align: center;">Mark Sheet</td>
				  <!--   <td style="text-align: center;"><?php //echo get_phrase('average_grade_point');?></td> -->
			   <?php } ?>
				</tr>
			</thead>
			<tbody>
			<?php
				$max_name='';
				$max_marks=0;
				// $students = $this->db->get_where('enroll' , array('class_id' => $class_id , 'year' => $running_year))->result_array();
				foreach($students as $row):
			?>
				<tr>
					<td style="text-align: center;">
						<?php 
						$name=$this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
						echo $name;?>
					</td>
					<td style="text-align: center;">
					<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->student_code;?>
				</td>
				<?php
				
					$total_marks = 0;
					$total_grade_point = 0;
					$inc=1;
					$mark_total=0;
					$total_marks_from=0;
					foreach($subjects as $row2):
					    
				?>
					<td style="text-align: center;">
						<?php 
							$obtained_mark_query = 	$this->db->get_where('mark' , array(
													'class_id' => $class_id , 
														'exam_id' => $exam_id , 
															'subject_id' => $row2['subject_id'] , 
																'student_id' => $row['student_id'],
																	'year' => $running_year
												));
						if($marks_type =='marks_and_grade' || $marks_type =='only_marks'){ 
							if ( $obtained_mark_query->num_rows() > 0) {
								$obtained_marks = $obtained_mark_query->row()->mark_obtained;
								$mark_total = $obtained_mark_query->row()->mark_total ? $obtained_mark_query->row()->mark_total : 100;
								echo (int)$obtained_marks;
								if ($obtained_marks >= 0 && $obtained_marks != '') {
									$grade = $this->crud_model->get_grade($obtained_marks);
									$total_grade_point += $grade['grade_point'];
								}
								$total_marks += $obtained_marks;
								$total_marks_from += $mark_total;
							}
							if($marks_type =='only_marks'){
							 if($obtained_mark_query->num_rows() > 0) {
                                $marks = $obtained_mark_query->result_array();
								// foreach ($marks as $row4) {
	       //                         $row4['mark_obtained'];
	       //                         $total_marks += $row4['mark_obtained'];
	       //                     }
								if ($row4['mark_obtained'] >= 0 || $row4['mark_obtained'] != '') {
	                                $grade = $this->crud_model->get_grade($row4['mark_obtained']);
	                                echo "&nbsp;&nbsp;";
	                                echo $grade['name'];
	                                $total_grade_point += $grade['grade_point'];
	                            }
                            }
                          }
                        }						

                        if($marks_type =='marks_and_grade' || $marks_type =='only_grade'){ 
                        	if($marks_type !='only_grade'){
                        	if ( $obtained_mark_query->num_rows() > 0) {
								$obtained_marks = $obtained_mark_query->row()->mark_obtained;
								$mark_total = $obtained_mark_query->row()->mark_total ? $obtained_mark_query->row()->mark_total : 100;
								echo (int)$obtained_marks;
								 echo "&nbsp;&nbsp;";
								if ($obtained_marks >= 0 && $obtained_marks != '') {
									$grade = $this->crud_model->get_grade($obtained_marks);
									$total_grade_point += $grade['grade_point'];
								}
								$total_marks += $obtained_marks;
								$total_marks_from += $mark_total;
							 }
						    }   

                            if($obtained_mark_query->num_rows() > 0) {
                                $marks = $obtained_mark_query->result_array();
								foreach ($marks as $row4) {
	                                $row4['mark_obtained'];
	                                $total_marks += $row4['mark_obtained'];
	                                $total_marks_from += $row4['mark_obtained'];
	                            }
								if ($row4['mark_obtained'] >= 0 || $row4['mark_obtained'] != '') {
	                                $grade = $this->crud_model->get_grade($row4['mark_obtained']);

	                                echo $grade['name'];
	                                $total_grade_point += $grade['grade_point'];
	                            }
                            }
						}	
						
						if( $obtained_mark_query->num_rows() === 0){
						    echo '0';
						}

						?>
					</td>
				<?php $inc++; endforeach;?>
			<?php 	if($marks_type =='marks_and_grade' || $marks_type =='only_marks'){  ?>
				<td style="text-align: center;"><?php echo $total_marks.'/'.$total_marks_from;?></td>
				<!-- <td style="text-align: center;">
					<?php 
						// $this->db->where('class_id' , $class_id);
						// $this->db->where('year' , $running_year);
						// $this->db->from('subject');
						//  $number_of_subjects = $this->db->count_all_results();
						// //echo ($total_grade_point / $number_of_subjects);
						//  $stotal_marks= ($total_marks*100)/($number_of_subjects*100);
						// echo number_format((float)$stotal_marks, 2, '.', '');
					?>
				</td> -->
			<?php } ?>
			<td style="text-align: center;"><?php echo $total_marks_from;?></td>
			<td style="text-align: center;"><?php echo $total_marks;?></td>
			<td style="text-align: center;"><?php $percentage=($total_marks/$total_marks_from)*100; echo round($percentage,2);?></td>
			
			<td style="text-align: center;"><?php echo getGrade($percentage,$grades);?></td>
			<td style="text-align: center;"/><a style="color:red;" href="<?php echo site_url();?>admin/student_marksheet_print_view_individual/<?php echo $row['student_id'];?>/<?php echo $exam_id;?>" target="_blank">Print Result</a></td>
				</tr>

			<?php 
			if($percentage>$max_marks){
			    $max_marks=round($percentage,2);
			    $max_name=$name;
			}
			endforeach;?>

			</tbody>
		</table>
		<br>
		
		<!--<center>-->
		<!--	<a href="<?php echo site_url('admin/tabulation_sheet_print_view/'.$class_id.'/'.$exam_id);?>" -->
		<!--		class="btn btn-primary" target="_blank">-->
		<!--		<?php echo get_phrase('print_tabulation_sheet');?>-->
		<!--	</a>-->
		<!--</center>-->
		<br><br>
		<!--<?php if($max_marks==0){?>-->
		<!--<h1>Results not announced yet.</h1>-->
		<!--<?php }else{?>-->
		<!--<h1 style='color:red;'><center><?php echo $max_name;?>:<?php echo $max_marks;?></center></h1>-->
		<!--<?php } ?>-->
	</div>
</div>




<?php endif;?>
<script type="text/javascript">
	var class_id = '';
	var exam_id  = '';
	jQuery(document).ready(function($) {
		$('#submit').attr('disabled', 'disabled');
	});
	function check_validation(){
		if(class_id !== '' && exam_id !== ''){
			$('#submit').removeAttr('disabled');
		}
		else{
			$('#submit').attr('disabled', 'disabled');	
		}
	}
	$('#class_id').change(function() {
		class_id = $('#class_id').val();
		check_validation();
	});
	$('#exam_id').change(function() {
		exam_id = $('#exam_id').val();
		check_validation();
	});
</script>