<?php $activeTab = "teacher"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Teachers</a></li>
        <li class="active">Manage Teacher Attendance</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/teacher_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<?php echo form_open(site_url('admin/teacher_attendance_selector/'));?>
<div class="row">

	
        <div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('date');?></label>
			<input type="text" class="form-control datepicker" name="timestamp" data-format="dd-mm-yyyy"
				value="<?php echo date("d-m-Y");?>"/>
		</div>
	</div>
	<input type="hidden" name="year" value="<?php echo $running_year;?>">

	<div class="col-md-3 top-first-btn">
		<button type="submit" id = "submit" class="btn btn-info"><?php echo get_phrase('manage_attendance');?></button>
	</div>

</div>
<?php echo form_close();?>

<script type="text/javascript">


function select_section(class_id) {
	if(class_id !== ''){
		$.ajax({
			url: '<?php echo site_url('admin/get_section/'); ?>' + class_id,
			success:function (response)
			{

			jQuery('#section_holder').html(response);
			}
		});
	}
}


</script>