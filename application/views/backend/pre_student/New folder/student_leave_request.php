<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-body">

                <?php echo form_open(site_url('admin/student/create/') , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('id_no');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="student_code" value="<?php echo substr(md5(uniqid(rand(), true)), 0, 7); ?>" data-validate="required" id="class_id"
								data-message-required="<?php echo get_phrase('value_required');?>">
						</div>
					</div>
					

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Leave Type');?></label>
		                    <div class="col-sm-5">
		                        <select name="leave_day" class="form-control" id="leave_day">
		                            <option value="oneday">One Day Leave</option>
		                            <option value="multipleday">More Than One Day</option>

			                    </select>
			                </div>
					</div>

					<div class="form-group" id="leave_date">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('leave_date');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control datepicker" name="leave_date" value="">
						</div>
					</div>

					<div class="form-group" id="from_date">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('from_leave_date');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control datepicker" name="from_leave_date" value="">
						</div>
					</div>

					<div class="form-group" id="to_date">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('to_leave_date');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control datepicker" name="to_leave_date" value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('reason_for_leave');?></label>

						<div class="col-sm-5">
							<textarea type="text" class="form-control" name="reason"></textarea>
						</div>
					</div>
					
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('apply');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

	function get_class_sections(class_id) {

    	$.ajax({
            url: '<?php echo site_url('admin/get_class_section/');?>' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });

    };

    $('#leave_day').change(function(){
    	let leaveType = $('#leave_day option:selected').val();
    	//alert( $('#leave_day option:selected').val());

    	if(leaveType == 'oneday'){
    		$('#leave_date').css('display','block');
    		$('#from_date').css('display','none');
    		$('#to_date').css('display','none');
    	}

    	else if(leaveType == 'multipleday'){
    		$('#leave_date').css('display','none');
    		$('#from_date').css('display','block');
    		$('#to_date').css('display','block');
    	}
    })

</script>
