<?php $activeTab = "exam"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Exam</a></li>
        <li class="active">Manage Marks</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support <?php echo $cycle_id;?> </a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/examination_results_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<?php echo form_open(site_url('admin/marks_selector'));?>
<div class="row">
<input type='hidden' name='mode' value='1'>
	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('exam');?></label>
			<select name="exam_id" class="form-control selectboxit" id="exam_id" onchange="get_user_list(this.value)" required>
				<?php
					$exams = $this->db->get_where('exam' , array('year' => $running_year))->result_array();
					foreach($exams as $row):
				?>
				<option value="<?php echo $row['exam_id'];?>"
					<?php if($exam_id == $row['exam_id']) echo 'selected';?>><?php echo $row['name'];?></option>
				<?php endforeach;?>
			</select>
		</div>
	</div>
   <div class="col-md-2">
                        <div class="item form-group"> 
                           	<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('exam_cycle');?></label>
                            <select  class="form-control "  name="cycle_id"  id="cycle_id" >
                               	<?php
				        	$classes = $this->db->get('exam_cycle')->result_array();
				    	foreach($classes as $row):
			             	?>
			        	<option value="<?php echo $row['id'];?>" <?php if($cycle_id == $row['id']) echo 'selected';?>><?php echo $row['name'];?></option>
			            	<?php endforeach;?>
                            </select>
                            <div class="help-block"><?php echo form_error('cycle_id'); ?></div>
                        </div>
                    </div>   
	<div class="col-md-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class');?></label>
			<select name="class_id" class="form-control selectboxit" onchange="get_class_subject(this.value)">
				<option value=""><?php echo get_phrase('select_class');?></option>
				<?php
					$classes = $this->db->get('class')->result_array();
					foreach($classes as $row):
				?>
				<option value="<?php echo $row['class_id'];?>"
					<?php if($class_id == $row['class_id']) echo 'selected';?>><?php echo $row['name'];?></option>
				<?php endforeach;?>
			</select>
		</div>
	</div>

	<div id="subject_holder">
		<div class="col-md-2">
			<div class="form-group">
			<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section');?></label>
				<select name="section_id" id="section_id" class="form-control selectboxit" onchange="get_class_subject(<?php echo $class_id;?>)">
					<?php 
						$sections = $this->db->get_where('section' , array(
							'class_id' => $class_id 
						))->result_array();
						foreach($sections as $row):
					?>
					<option value="<?php echo $row['section_id'];?>" 
						<?php if($section_id == $row['section_id']) echo 'selected';?>>
							<?php echo $row['name'];?>
					</option>
					<?php endforeach;?>
				</select>
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
			<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('subject');?></label>
				<select name="subject_id" id="subject_id" class="form-control selectboxit">
					<?php 
						//$subjects = $this->db->get_where('subject' , array('class_id' => $class_id ,'section_id' => $section_id, 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description))->result_array();
					$runing_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
			      	$subjects = $this->db->query("select * from subject where FIND_IN_SET($class_id,class_id) AND year = '".$runing_year."'")->result_array();
						foreach($subjects as $row):
					?>
					<option value="<?php echo $row['subject_id'];?>"
						<?php if($subject_id == $row['subject_id']) echo 'selected';?>>
							<?php echo $row['name'];?>
					</option>
					<?php endforeach;?>
				</select>
			</div>
		</div>
		<div class="col-md-2" style="margin-top: 20px;">
			<center>
				<button type="submit" class="btn btn-info"><?php echo get_phrase('manage_marks');?></button>
			</center>
		</div>
	</div>

</div>
<?php echo form_close();?>

<hr />
<div class="row" style="text-align: center;">
	<div class="col-sm-4"></div>
	<div class="col-sm-4">
		<div class="tile-stats tile-gray">
			<div class="icon"><i class="entypo-chart-bar"></i></div>
			
			<h3 style="color: #696969;"><?php echo get_phrase('marks_for');?> <?php echo $this->db->get_where('exam' , array('exam_id' => $exam_id))->row()->name;?></h3>
			<h4 style="color: #696969;">
				<?php echo get_phrase('class');?> <?php echo $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;?> : 
				<?php echo get_phrase('section');?> <?php echo $this->db->get_where('section' , array('section_id' => $section_id))->row()->name;?> 
			</h4>
			<h4 style="color: #696969;">
				<?php echo get_phrase('subject');?> : <?php echo $this->db->get_where('subject' , array('subject_id' => $subject_id))->row()->name;?>
			</h4>
		</div>
	</div>
	<div class="col-sm-4"></div>
</div>
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
	<?php $subject = $this->db->get_where('subject' , array('class_id' => $class_id))->result_array(); ?>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th><?php echo get_phrase('id');?></th>
						<th><?php echo get_phrase('name');?></th>
						
							<?php	foreach($subject as $row) { 	?>
							<th>Marks obtained in <?php echo $row['name'];?></th>
					<?php } ?>
					
					
						<th><?php echo get_phrase('comment');?></th>
					</tr>
				</thead>
				<tbody>
				<?php
					$count = 1;
					$marks_of_students = $this->db->get_where('enroll' , array(
						'class_id' => $class_id, 
							'section_id' => $section_id,
							 'year' => $running_year
					))->result_array();
					
					foreach($marks_of_students as $row):
				?>
					<tr>
						<td><?php echo $count++;?></td>

                        <td><?php echo $this->db->get_where('student',array('student_id'=>$row['student_id']))->row()->student_code;?></td>

						<td>
							<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;?>
						</td>
					
			        	<?php foreach($subject as $rows) { 
			        	$marks_of_student = $this->db->get_where('mark' , array(
						'class_id' => $class_id, 
							'cycle_id' => $cycle_id, 
							'section_id' => $section_id ,
								'year' => $running_year,
									'subject_id' => $rows['subject_id'],
									'student_id' => $row['student_id'],
										'exam_id' => $exam_id
					))->result_array();
					//print_r($marks_of_student);
			        	?>
							<td>
							    <?php echo $marks_of_student[0]['mark_obtained'];?>
								</td>
						<?php } ?>
						
						
						<td>
							<?php echo $row['comment'];?>
						</td>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>

	
		
	</div>
	<div class="col-md-2"></div>
</div>
</div>





<script type="text/javascript">
	function get_class_subject(class_id) {
	if (class_id !== '') {
		var section  = $('#section_id').val();
	$.ajax({
            url: '<?php echo site_url('admin/marks_get_subject/');?>' + class_id +'/'+section,
            success: function(response)
            {
                jQuery('#subject_holder').html(response);
            }
        });
	  }
	}
</script>

<script type="text/javascript">

	   function get_user_list(exam_id, cycle_id){
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_cycle_list_by_exam'); ?>",
            data   : { exam_id : exam_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   $('#cycle_id').html(response); 
               }
             }
          }); 
        }
</script>