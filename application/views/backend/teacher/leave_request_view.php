<?php 
  $result = $this->db->get_where('leave_request',array('leave_id'=>$param2))->row();
  $leave_details_name="";$leave_details_role="";$leave_details_email="";$leave_details_mobile="";
  $leave_details_student_name = "";$leave_details_student_email ="";
  if($result != ""){
    if($result->role_id == STUDENT){
     $leave_details = $this->db->get_where('student',array('student_id'=>$result->request_by))->row();


     $leave_details_name   = $leave_details->name;
     $leave_details_role   = 'student';
     $leave_details_email  = $leave_details->email;
     $leave_details_mobile = $leave_details->phone;
    }
    elseif($result->role_id == PARENTT){
     $leave_details = $this->db->get_where('parent',array('parent_id'=>$result->request_by))->row();
     $leave_details_student = $this->db->get_where('student',array('student_code'=>$result->id_no))->row();
     $leave_details_student_name = $leave_details_student->name;
     $leave_details_student_email= $leave_details_student->email;
     $leave_details_name   = $leave_details->name;
     $leave_details_role   = 'parent';
     $leave_details_email  = $leave_details->email;
     $leave_details_mobile = $leave_details->phone;

    }
    elseif($result->role_id == TEACHER){
     $leave_details = $this->db->get_where('teacher',array('teacher_id'=>$result->request_by))->row();


     $leave_details_name   = $leave_details->name;
     $leave_details_role   = 'teacher';
     $leave_details_email  = $leave_details->email;
     $leave_details_mobile = $leave_details->phone;
    }
  }

?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('leave_request');?>
            	</div>
            </div>
			<div class="panel-body">
				<div class="form-group row">
	                <label class="col-sm-4 control-label"><?php echo get_phrase('request_id');?> : </label>
	                <div class="col-sm-8">
					<?php echo $result->uniqid;?>	 
	                </div>
	            </div>

	            <div class="form-group row">
	                <label class="col-sm-4 control-label"><?php echo get_phrase('from_date');?> : </label>
	                <div class="col-sm-8">
						<?php  if($result->from_date != ""){ echo $result->from_date;}else{ echo $result->leave_date;}?>
	                </div>
	            </div>

	            <div class="form-group row">
	                <label class="col-sm-4 control-label"><?php echo get_phrase('to_date');?> : </label>
	                <div class="col-sm-8">
						<?php  if($result->to_date != ""){ echo $result->to_date; }else{ echo $result->leave_date;}?>
	                </div>
	            </div>

	            <div class="form-group row">
	                <label class="col-sm-4 control-label"><?php echo get_phrase('request_by');?> : </label>
	                <div class="col-sm-8">
						<?php echo $leave_details_name; ?>
	                </div>
	            </div>

	            <div class="form-group row">
	                <label class="col-sm-4 control-label"><?php echo get_phrase('user_role');?> : </label>
	                <div class="col-sm-8">
						<?php echo $leave_details_role; ?>
	                </div>
	            </div>

	            <div class="form-group row">
	                <label class="col-sm-4 control-label"><?php echo get_phrase('email_id');?> : </label>
	                <div class="col-sm-8">
						<?php echo $leave_details_email; ?> 
	                </div>
	            </div>
                <?php if($leave_details_student_name != ""){ ?>
                	<div class="form-group row">
	                <label class="col-sm-4 control-label"><?php echo get_phrase('student_name');?> / <?php echo get_phrase('email');?> : </label>
	                <div class="col-sm-8">
						<?php echo $leave_details_student_name; ?> / <?php echo $leave_details_student_email; ?>
	                </div>
	            </div>
                <?php } 
                ?>
	            <div class="form-group row">
	                <label class="col-sm-4 control-label"><?php echo get_phrase('mobile_number');?> : </label>
	                <div class="col-sm-8">
						<?php echo $leave_details_mobile; ?>  
	                </div>
	            </div>

	            <div class="form-group row">
	                <label class="col-sm-4 control-label"><?php echo get_phrase('request_status');?> : </label>
	                <div class="col-sm-8">
						<span class="<?php echo $result->status;?>"> <?php echo $result->status;?> </span>	
	                </div>
	            </div>
                
            </div>
        </div>
    </div>
</div>


