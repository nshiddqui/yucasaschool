<?php $activeTab = "scholarship_dashboard"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
		<li><a href="#">Scholarship</a></li>
        <li class="active">Online Exam</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/student/scholarship_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>


<div class="row hidden">
	<div class="col-md-12">
		<a href="<?php echo site_url('student/scholarship_exam_online'); ?>" class="btn btn-<?php echo $data == 'active' ? 'primary' : 'white'; ?>">
			<?php echo get_phrase('active_exams');?>
		</a>
		<a href="<?php echo site_url('student/scholarship_exam_result'); ?>" class="btn btn-<?php echo $data == 'result' ? 'primary' : 'white'; ?>">
			<?php echo get_phrase('view_results');?>
		</a>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered datatable" >
			<thead>
                <tr>
                    <th><div><?php echo get_phrase('exam_name');?></div></th>
                   <!--  <th><div><?php //echo get_phrase('subject');?></div></th> -->
                    <th><div><?php echo get_phrase('exam_date');?></div></th>
                    <th width="40%"><div><?php echo get_phrase('options');?></div></th>
                </tr>
            </thead>
            <tbody>
            	<?php
                    foreach ($exams as $row):
                    	 $current_time    = time();
                    	 $exam_start_time = strtotime(date('Y-m-d', $row['exam_date']).' '.$row['time_start']);
                    	 $exam_end_time   = strtotime(date('Y-m-d', $row['exam_date']).' '.$row['time_end']);
                    	if ($current_time > $exam_end_time)
                    		continue;
            	?>
                    <tr>
                    	<td><?php echo $row['title'];?></td>
                    	<td>
                    		<?php
                            echo '<b>'.get_phrase('date').':</b> '.date('M d, Y', $row['exam_date']).'<br>'.'<b>'.get_phrase('time').':</b> '.$row['time_start'].' - '.$row['time_end'];
                        ?>
                    	</td>
                    	<td>
							<?php if ($this->crud_model->check_availability_for_student_in_scholarship($row['online_exam_id']) != "submitted"): ?>
								<?php if ($current_time >= $exam_start_time && $current_time <= $exam_end_time): ?>
									<a href="<?php echo site_url('student/take_scholarship_exam/'.$row['code']);?>" class="btn btn-success">
										<i class="entypo-docs"></i>&nbsp; <?php echo get_phrase('take_exam');?>
									</a>
								<?php else: ?>
									<div class="alert alert-info">
										<?php echo get_phrase('you_can_only_take_the_exam_during_the_scheduled_time');?>
									</div>
								<?php endif; ?>

							<?php else: ?>
								<div class="alert alert-success">
									<?php echo get_phrase('already_submitted');?>
								</div>
							<?php endif; ?>
                    	</td>
                    </tr>
            <?php endforeach; ?>
            </tbody>
		</table>
	</div>
</div>
</div>
