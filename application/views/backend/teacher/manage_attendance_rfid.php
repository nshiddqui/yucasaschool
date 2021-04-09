<?php $activeTab = "attendance"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Student</a></li>
        <li class="active">Daily Attendance Rfid</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/teacher/student_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>


<style>
#attendance_rfid{height: 150px;}	
</style>
<?php echo form_open(site_url('teacher/daily_bulk_attendance_reports/'));?>
<div class="row">

	<!--<div class="col-md-3 ">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('attendance_date');?></label>
			<input type="text" class="form-control datepicker" name="timestamp" data-format="dd-mm-yyyy"
				value="<?php echo date("d-m-Y");?>"/>
		</div>
	</div>-->


	<div class="col-md-12">
		<input type="hidden" name="class_id" value="">
		<input type="hidden" name="year" value="">
	</div>
	
	
	<div class="col-md-8">
		<div class="form-group">
			<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('attendance_list');?></label>
		<textarea name="attendance_rfid" id="attendance_rfid" class="form-control" ></textarea>
		</div>
	</div>

	
	<div class="col-md-12" style="margin-top: 20px;">
		<button type="submit" class="btn btn-info"><?php echo get_phrase('submit_attendance');?></button>
	</div>

</div>
<?php echo form_close();?>