<?php
	$class_name		 	= 	$this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
	$exam_name  		= 	$this->db->get_where('exam' , array('exam_id' => $exam_id))->row()->name;
	$system_name        =	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
	$running_year       =	$this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
	$marks_type         = marks_type();
?>
<div id="print">
	<script src="assets/js/jquery-1.11.0.min.js"></script>
	<style type="text/css">
		td {
			padding: 5px;
		}
	</style>

	<center>
		<img src="<?php echo base_url(); ?>uploads/logo.png" style="max-height : 60px;"><br>
		<h3 style="font-weight: 100;"><?php echo $system_name;?></h3>
		<?php echo get_phrase('tabulation_sheet');?><br>
		<?php echo get_phrase('class') . ' ' . $class_name;?><br>
		<?php echo $exam_name;?>


	</center>
<?php function getGrade($percentage){
    $grade='';
    if($percentage<100 && $percentage>90){
        $grade='Outstanding';
    }elseif($percentage<90 && $percentage>80){
        $grade='Excellent';
    }elseif($percentage<80 && $percentage>70){
        $grade='Very good';
    }elseif($percentage<70 && $percentage>60){
        $grade='Good';
    }elseif($percentage<60 && $percentage>50){
        $grade='Fair';
    }else{
        $grade='Poor';
    }
return $grade; 
}?>

	<table style="width:100%; border-collapse:collapse;border: 1px solid #ccc; margin-top: 10px;" border="1">
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
			<td style="text-align: center;">Marks Obtained</td>
				    <td style="text-align: center;">Maximum marks/subject</td>
				    <td style="text-align: center;">Percentage(in %)</td>
				    <td style="text-align: center;">Grade</td>
			<!-- <td style="text-align: center;"><?php echo get_phrase('average_grade_point');?></td> -->
			</tr>
		</thead>
		<tbody>
		<?php

			$students = $this->db->get_where('enroll' , array('class_id' => $class_id , 'year' => $running_year))->result_array();
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
								echo $obtained_marks;
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
								echo $obtained_marks;
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
			<td style="text-align: center;"><?php $percentage=($total_marks/$total_marks_from)*100; echo $percentage;?></td>
			<td style="text-align: center;"><?php echo getGrade($percentage);?></td>
				</tr>

		<?php endforeach;?>

		</tbody>
	</table>
</div>



<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		var elem = $('#print');
		PrintElem(elem);
		Popup(data);

	});

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data)
    {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        mywindow.document.write('<html><head><title></title>');
        //mywindow.document.write('<link rel="stylesheet" href="assets/css/print.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        //mywindow.document.write('<style>.print{border : 1px;}</style>');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }
</script>
