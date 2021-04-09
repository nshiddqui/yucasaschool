<?php $activeTab = "leave"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Leave Request</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/parent/parent_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-body">

                <?php echo form_open(site_url('parents/student_leave_requests/create/') , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('student_code');?></label>

						<!--<div class="col-sm-5">
							<input type="text" class="form-control" name="student_code" value="<?php echo substr(md5(uniqid(rand(), true)), 0, 7); ?>" data-validate="required" id="class_id"
								data-message-required="<?php echo get_phrase('value_required');?>">
						</div>-->
						 <div class="col-sm-5">
		                        <select name="student_code" class="form-control" id="student_code">
		                            <option >Select Student</option>
									<?php
                $children_of_parent = $this->db->get_where('student' , array(
                    'parent_id' => $this->session->userdata('parent_id')
                ))->result_array();

                foreach ($children_of_parent as $row):
            ?>
		                            <option value="<?php echo $row['student_code'];?>"><?php echo $row['name'];?></option>
  <?php endforeach;?>
			                    </select>
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
