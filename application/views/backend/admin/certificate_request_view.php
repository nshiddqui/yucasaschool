<?php 
  $result = $this->db->get_where('apply_certificates',array('id'=>$param2))->row();
  $leave_details = $this->db->get_where('student',array('student_id'=>$result->student_id))->row();
  $leave_detailss = $this->db->get_where('parent',array('parent_id'=>$result->apply_by))->row();



?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('certificate_request');?>
            	</div>
            </div>
			<div class="panel-body">
				<div class="form-group row">
	                <label class="col-sm-4 control-label"><?php echo get_phrase('request_id');?> : </label>
	                <div class="col-sm-8">
						<?php echo $leave_details->student_code;?>
						
	                </div>
	            </div>

	            <div class="form-group row">
	                <label class="col-sm-4 control-label"><?php echo get_phrase('request_date');?> : </label>
	                <div class="col-sm-8">
						<?php echo $result->createdate;?>
	                </div>
	            </div>


	            <div class="form-group row">
	                <label class="col-sm-4 control-label"><?php echo get_phrase('request_by');?> : </label>
	                <div class="col-sm-8">
					<?php $role_id= $result->role_id;?>
					<?php if($role_id==8) {
					 echo $leave_detailss->name; 
					}elseif($role_id==4) {
						echo '[Student]';
					} ?></div>
	            </div>


	            <div class="form-group row">
	                <label class="col-sm-4 control-label"><?php echo get_phrase('student_name');?> : </label>
	                <div class="col-sm-8">
						<?php echo $leave_details->name;?>
	                </div>
	            </div>


	            <div class="form-group row">
	                <label class="col-sm-4 control-label"><?php echo get_phrase('email_id');?> : </label>
	                <div class="col-sm-8">
						<?php echo $leave_details->email;?>
	                </div>
	            </div>

	            <div class="form-group row">
	                <label class="col-sm-4 control-label"><?php echo get_phrase('mobile_number');?> : </label>
	                <div class="col-sm-8">
						<?php echo $leave_details->phone;?>
	                </div>
	            </div>

	            <div class="form-group row">
	                <label class="col-sm-4 control-label"><?php echo get_phrase('request_status');?> : </label>
	                <div class="col-sm-8">
						<?php $status= $result->status;?>
						<?php if ($status==0){echo 'Pending';}elseif ($status==1) {echo 'Approve';} elseif($status==2){echo'Reject';} ?>
	                </div>
	            </div>
                
            </div>
        </div>
    </div>
</div>


