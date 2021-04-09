<hr />

<?php echo form_open(site_url('admin/attendance_selector/'));?>
<div class="row">

        <div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('start_date');?></label>
			<input type="text" class="form-control datepicker" name="timestamp" data-format="dd-mm-yyyy"
				value="<?php echo date("d-m-Y");?>"/>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('end_date');?></label>
			<input type="text" class="form-control datepicker" name="timestamp" data-format="dd-mm-yyyy"
				value="<?php echo date("d-m-Y");?>"/>
		</div>
	</div>
	<input type="hidden" name="year" value="<?php echo $running_year;?>">

	<div class="col-md-3" style="margin-top: 20px;">
		<button type="submit" id = "submit" class="btn btn-info"><?php echo get_phrase('show_report');?></button>
	</div>

</div>
<?php echo form_close();?>

<script type="text/javascript">
var class_selection = "";
jQuery(document).ready(function($) {
	$('#submit').attr('disabled', 'disabled');
});

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