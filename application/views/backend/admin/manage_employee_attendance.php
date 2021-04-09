<?php $activeTab = "daily_attendance"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Employee</a></li>
        <li class="active">Daily Attendance</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
</div>

<div class="filter_form">
<?php echo form_open(site_url('admin/attendance_employee_selector/'));?>
<div class="row">

	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('Designation');?></label>
			<select name="class_id" class="form-control selectboxit" id = "class_selection">
				<option value=""><?php echo get_phrase('Select Designation');?></option>
				<option value="all"><?php echo get_phrase('All');?></option>
				<?php
					$designations = $this->db->get('designations')->result_array();
					foreach($designations as $row):
                                            
				?>
                                
				<option value="<?php echo $row['id'];?>"
					><?php echo $row['name'];?></option>
                                
				<?php endforeach;?>
			</select>
		</div>
	</div>


	
        <div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('date');?></label>
			<input type="text" class="form-control datepicker" name="timestamp" data-format="dd-mm-yyyy"
				value="<?php echo date("d-m-Y");?>"/>
		</div>
	</div>
	<input type="hidden" name="year" value="<?php echo $running_year;?>">

	
	<div class="col-md-3">
	    <div class="form-group">
	        <label class="control-label" style="margin-bottom: 5px;">Option</label>
		    <button type="submit" id = "submit" class="btn btn-info btn-block"><?php echo get_phrase('manage_attendance');?></button>
		</div>
	</div>

</div>
<?php echo form_close();?>
</div>
<script type="text/javascript">
var class_selection = "";
jQuery(document).ready(function($) {
	$('#submit').attr('disabled', 'disabled');
});

function check_validation(){
	if(class_selection !== ''){
		$('#submit').removeAttr('disabled')
	}
	else{
		$('#submit').attr('disabled', 'disabled');
	}
}

$('#class_selection').change(function(){
	class_selection = $('#class_selection').val();
	check_validation();
});
</script>