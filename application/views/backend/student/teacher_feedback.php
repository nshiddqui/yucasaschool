<?php  $feedback_id = $this->uri->segment(3); ?>
<?php  $teacher_id = $this->uri->segment(4); ?>
<?php $activeTab = "teacher_feedback"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Extra Curricular</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/student/extra_curricular_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>
<?php
	 
	$questions = $this->db->get_where('teacher_feedback_question', array('feed_back_id' => $feedback_id))->result_array();
	$total_marks = 0;
	foreach ($questions as $row) {
		$total_marks += $row['mark'];
	}
?>

<form class="" action="<?php echo site_url('student/student_online_feedback/'.$feedback_id.'/'.$teacher_id_); ?>" method="post" enctype="multipart/form-data" id = "answer_script">

<div class="container-fluid teacher-feedback">



  <div class="row question-response">

    <div class="col-sm-12">
      <div class="responses-details">
      <ul class="list-inline" style="color: #000">
        <li><strong>Feedback Form Name : </strong> <?php echo $name= $this->db->get_where('teacher_feedback' , array('id' => $feedback_id ))->row()->title; ?></li>
        <li><strong>Teacher Name : </strong> <?php echo $name= $this->db->get_where('teacher' , array('teacher_id' => $teacher_id ))->row()->name; ?></li>
        
      </ul>
    </div>
    </div> 
	
<?php $count = 1; foreach ($questions as $question):?>
 <div class="row">
		<div class="col-md-11">
			<h4><b><?php echo $count++;?>.</b>  <?php echo $question['question_title'];?></h4>
		</div>
		<div class="col-md-1 text-right">
			<h4><b><?php echo $question['mark'];?></b></h4>
		</div>
	</div>
	<div class="row" style="padding: 15px;">
		<!-- multiple choice -->
		<?php if ($question['type'] == 'multiple_choice'): ?>
			<?php
	            if ($question['options'] != '' || $question['options'] != null)
	            	$options = json_decode($question['options']);
	            else
	            	$options = array();
	            for ($i = 0; $i < $question['number_of_options']; $i++):
			?>
			<div class="col-md-12" style="margin-bottom: 15px;">
       <!--  checkbox-replace -->
				<div class=" color-green">
				    <input type="checkbox"  name="<?php echo $question['question_id'].'[]'; ?>" value="<?php echo $i + 1;?>">
				    <label style="color: #373e4a; font-size: 15px;">
				    	<span><?php echo $i+1;?></span><?php $no= $options[$i];?>
						
				    </label>
			    </div>
			</div>
		<?php endfor; endif;?>
		<!-- true / false -->
	
	
	</div>
	<?php endforeach;?>
  
  </div>





	
  <div class="row question-response">
    <div class="question-box">
      <div class="col-md-12">
        <div class="form-group">
             
          <button class="btn btn-info" type="submit">Submit your Reviews</button>
            
      </div>
    </div>
  </div>

  </div>


</div>


</form>

<script>
    $(document).ready(function() {
        setTimeout(() => $('.selectpicker').select2(), 1000);
    });

$('input[type="checkbox"]').on('change', function() {
    $('input[name="' + this.name + '"]').not(this).prop('checked', false);
});

</script>