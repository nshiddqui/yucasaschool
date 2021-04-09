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
</div>

<?php echo form_open(site_url('admin/marks_selector'));?>
<div class="row">

	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('exam');?></label>
			<select name="exam_id" class="form-control selectboxit" id="exam_id" onchange="get_user_list(this.value)" required>
			    <option>--SELECT--</option>
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
	<?php /*
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
                    </div>    */ ?>
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
				<select name="" id="" class="form-control selectboxit" disabled="disabled">
					<option value=""><?php echo get_phrase('select_class_first');?></option>		
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
		<div class="tile-stats" style="background:var(--main-bg-color);">
			<div class="icon"></div>
			
			<h3 style="color: #fff;"><?php echo get_phrase('marks_for');?> <?php echo $this->db->get_where('exam' , array('exam_id' => $exam_id))->row()->name;?></h3>
			<h4 style="color: #fff;">
				<?php echo get_phrase('class');?> <?php echo $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;?> : 
				<?php echo get_phrase('section');?> <?php echo $this->db->get_where('section' , array('section_id' => $section_id))->row()->name;?> 
			</h4>
			<h4 style="color: #fff;">
				<?php echo get_phrase('subject');?> : <?php echo $this->db->get_where('subject' , array('subject_id' => $subject_id))->row()->name;?>
			</h4>
		</div>
	</div>
	<div class="col-sm-4"></div>
</div>
<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-10">
	<?php $subject = $this->db->get_where('subject_competencies' , array('subject_id' => $subject_id))->result_array(); ?>
	
	<?php $grades = $this->db->get('grade')->result_array(); 
	?>
		<?php $practial = $this->db->get_where('subject_practial' , array('subject_id' => $subject_id))->result_array(); ?>
		<?php echo form_open(site_url('admin/marks_update/'.$exam_id.'/'.$class_id.'/'.$section_id.'/'.$subject_id));?>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>Roll no</th>
						<th><?php echo get_phrase('name');?></th>
						
						<th><?php echo get_phrase('marks_obtained');?></th>
						<th>Maximum marks</th>
							<?php	foreach($subject as $row) { 	?>
							<th><?php echo $row['name'];?></th>
					<?php } ?>
					
						<?php	foreach($practial as $rowd) { 	?>
							<th><?php echo $rowd['name'];?></th>
				    	<?php } ?>
				    	<th>Grades</th>
						
					</tr>
				</thead>
				<tbody>
				<?php
					$count = 1;
					$marks_of_students = $this->db->get_where('mark' , array(
						'class_id' => $class_id, 
							//'cycle_id' => $cycle_id, 
							'section_id' => $section_id ,
								'year' => $running_year,
									'subject_id' => $subject_id,
										'exam_id' => $exam_id
					))->result_array();
					foreach($marks_of_students as $row):
					    $marks_editable =0;
					     if($teacher_id && $subject_id){
            	$sections = $this->db->get_where('assign_subject' , array(
							'teacher_id' => $teacher_id,'subject_id' => $subject_id  
						))->result_array();
						if(!empty($sections)){
						    $marks_editable  =   1;
						}
						//print_r($sections);die;
					
        } else if($this->session->userdata('admin_login')==1 ) {
            $marks_editable  =   1;
        }
       
        
				?>
					<tr>
						<td data-src="<?php echo $marks_editable;  ?>"><?php echo $count++;?></td>

                        <td><?php echo $this->db->get_where('student',array('student_id'=>$row['student_id']))->row()->student_code;?></td>

						<td>
							<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;?>
						</td>
						<td>
							<input type="text" class="form-control mark-obtained" data-id="<?php echo $row['mark_id'];?>" name="marks_obtained_<?php echo $row['mark_id'];?>"
								value="<?php echo $row['mark_obtained'];?>" <?php if($marks_editable==0){?>disabled<?php } ?>>	
						</td>
						<td>
							<input type="text" class="form-control" data-upto="<?php echo $row['mark_id'];?>" name="max_marks_<?php echo $row['mark_id'];?>"
								<?php if($marks_editable==0){?>disabled<?php } ?> value="<?php echo ($row['mark_total']!='') ? $row['mark_total'] : 100;?>">	
						</td>
			        	<?php	foreach($subject as $rows) { 	?>
							<td>
							<input type="text" class="form-control" name="marks_<?php echo str_replace(' ', '',  $rows['name']);?>_<?php echo $row['mark_id'];?>" <?php if($marks_editable==0){?>disabled<?php } ?>
								value="<?php echo $this->db->get_where('cat_mark',array('competencies_name'=>$rows['name'],'mark_id'=>$row['mark_id']))->row()->competencies_marks;?>">	
					    	</td>
						<?php } ?>
						
							<?php	foreach($practial as $rowsp) { 	?>
							<td>
							<input type="text" class="form-control" <?php if($marks_editable==0){?>disabled<?php } ?> name="marks_<?php echo str_replace(' ', '',  $rowsp['name']);?>_<?php echo $row['mark_id'];?>"
								value="<?php echo $this->db->get_where('cat_mark',array('competencies_name'=>$rowsp['name'],'mark_id'=>$row['mark_id']))->row()->competencies_marks;?>">	
					    	</td>
						<?php } ?>
						
						
							<td data-src="<?php echo $row['grade_id'];?>">
							    <select name="grade_id_<?php echo $row['mark_id'];?>" data-id="<?php echo $row['mark_id'];?>" class="form-control" <?php if($marks_editable==0){?>disabled<?php } ?> readonly>
							        <option>--SELECT GRADE--</option> 
							        <?php	foreach($grades as $grade) { 	?>
							        <option data-min="<?= $grade['mark_from'] ?>" data-max="<?= $grade['mark_upto'] ?>" value="<?php echo $grade['grade_id'];?>" <?php if($row['grade_id']==$grade['grade_id']){ echo "selected";}?>><?php echo $grade['name'];?></option> 
							        <?php } ?>
							        </select>
							</td>
						
						<!--<td>-->
						<!--	<input type="text" class="form-control" name="comment_<?php echo $row['mark_id'];?>"-->
						<!--		value="<?php echo $row['comment'];?>" <?php if($marks_editable){ echo "disabled";}?>>-->
						<!--</td>-->
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>

		<center>
		    <?php if($marks_editable==1){?>
			<button type="submit" class="btn btn-success">
				<i class="entypo-check"></i> <?php echo get_phrase('save_changes');?>
			</button>
			<?php } ?>
		</center>
		<?php echo form_close();?>
		
	</div>
	<div class="col-md-2"></div>
</div>
</div>





<script type="text/javascript">
jQuery(document).ready(function($) {
	$("#submit").attr('disabled', 'disabled');
	get_class_subject(<?php echo $class_id;?>,<?= $subject_id ?>);
});
	function get_class_subject(class_id,subject_id ='') {
	if (class_id !== '') {
		var section  = $('#section_id').val();
	$.ajax({
            url: '<?php echo site_url('admin/marks_get_subject/');?>' + class_id +'/'+section+'/'+subject_id,
            success: function(response)
            {
                jQuery('#subject_holder').html(response);
            }
        });
	  }
	}
	
	
	$('.mark-obtained').on('keyup',function(){
	    var $value = $(this).val();
	    var $upto = parseInt($('input[data-upto="'+$(this).attr('data-id')+'"]').val());
	    $value = (($value/$upto) * 100);
	    var change = true;
        $('select[data-id="'+$(this).attr('data-id')+'"] > option').each(function() {
            $min = parseInt($(this).attr('data-min'));
            $max = parseInt($(this).attr('data-max'));
            if(($min <= $value ) && ($max >= $value)){
                $(this).prop('selected',true);
                change = false;
            }
        });
        if(change){
            $('select[data-id="'+$(this).attr('data-id')+'"]').prop('selectedIndex',0);
        }
	});
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