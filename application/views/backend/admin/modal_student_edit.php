<?php 
$field_arr  = $this->crud_model->registration_form_fiels();
$create_dianamic_field  = $this->crud_model->get_registration_fields();

$edit_data		=	$this->db->get_where('enroll' , array(
	'student_id' => $param2 , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
))->result_array();
foreach ($edit_data as $row):
  
?>
<?php $stdentDetails =  $this->db->get_where('student' , array('student_id' => $row['student_id']))->row(); ?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_student');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(site_url('admin/student/do_update/'.$row['student_id'].'/'.$row['class_id'])  , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                
                	
					<?php if(!in_array("photo", $field_arr)){ ?>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                        
						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="<?php echo $this->crud_model->get_image_url('student' , $row['student_id']);?>" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="photo" accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" 
								value="<?php echo $stdentDetails->name; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="class" disabled
								value="<?php echo $this->db->get_where('class' , array('class_id' => $row['class_id']))->row()->name; ?>" >
								<input type="hidden" value="<?php echo $row['class_id'];?>" id="class_id">
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('section');?></label>
                        
						<div class="col-sm-5">
						  <select name="section_id" class="form-control" onchange="get_edit_autogenrate_roll(this.value,'<?php echo $param2;?>','<?php echo $row['section_id'];?>');">
                              <option value=""><?php echo get_phrase('select_section');?></option>
                              <?php
                              	$sections = $this->db->get_where('section' , array('class_id' => $row['class_id']))->result_array();
                              	foreach($sections as $row2): ?>
                                 <option value="<?php echo $row2['section_id'];?>"
                               	 <?php if($row['section_id'] == $row2['section_id']) echo 'selected';?>><?php echo $row2['name'];?></option>
                              <?php endforeach;?>
                          </select>
						</div> 
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('id');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="student_code"
								value="<?php echo $stdentDetails->student_code;?>">
						</div>
					</div>

					<div class="form-group">
						<?php 
						   $class_perifix  = $this->db->get_where('section',array('section_id'=>$row['section_id'],'class_id'=>$row['class_id'],'sub_teacher_status'=>0))->row()->perifix_code;
                           $school_perifix = $this->db->get_where('settings',array('type'=>'perifix_code'))->row()->description;
						?>
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('roll_no');?></label>
                        <div class="col-sm-5">
							<div class="input-group">
							  <div class="input-group-addon" id="perifix_code_value"><?php echo $school_perifix.$class_perifix;?></div>
							  <input type="text" class="form-control" name="roll" value="<?php echo $row['roll'];?>" readonly data-validate = "required" id = "roll_no"
								data-message-required = "<?php echo get_phrase('value_required');?>" >
							</div>
						</div> 
					</div>
					<div class="form-group">
						<label for="rfid" class="col-sm-3 control-label">RFID Number</label>
                        <div class="col-sm-5">
							<div class="input-group">
							  <input type="text" class="form-control" name="rf_id" value="<?php echo $row['card_code'];?>" id = "rfid" >
							</div>
						</div> 
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('parent');?></label>
                        
						<div class="col-sm-5">
							<select name="parent_id" class="form-control select2" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
									$parents = $this->db->get('parent')->result_array();
									$parent_id = $stdentDetails->parent_id;
									foreach($parents as $row3):
										?>
                                		<option value="<?php echo $row3['parent_id'];?>"
                                        	<?php if($row3['parent_id'] == $parent_id)echo 'selected';?>>
													<?php echo $row3['name'];?>
                                                </option>
	                                <?php
									endforeach;
								  ?>
                          </select>
						</div> 
					</div>
               <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('mother_name');?></label>

						<div class="col-sm-5">
						
							<input type="text" class="form-control" name="mother_name" value="<?php echo $stdentDetails->mother_name; ?>" data-validate="required" 
								data-message-required="<?php echo get_phrase('value_required');?>" >
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="email" 
								value="<?php echo $stdentDetails->email; ?>">
						</div>
					</div>
					<?php  
 				    if(!in_array("birthday", $field_arr)){ ?>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('birthday');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control datepicker" name="birthday" 
								value="<?php echo $stdentDetails->birthday; ?>" 
									data-start-view="2">
						</div> 
					</div>
					<?php } 
 				    if(!in_array("gender", $field_arr)){ ?>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('gender');?></label>
                        
						<div class="col-sm-5">
							<select name="sex" class="form-control">
							<?php
								$gender = $stdentDetails->sex;
							?>
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="Male" <?php if($gender == 'Male')echo 'selected';?>><?php echo get_phrase('male');?></option>
                              <option value="Female"<?php if($gender == 'Female')echo 'selected';?>><?php echo get_phrase('female');?></option>
                          </select>
						</div> 
					</div>
					<?php } 
 				    if(!in_array("address", $field_arr)){ ?>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="address" 
								value="<?php echo $stdentDetails->address; ?>" >
						</div> 
					</div>
					<?php } 
 				    if(!in_array("phone", $field_arr)){ ?>
					<div class="form-group">
					 <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>
                        <div class="col-sm-5">
							<input type="text" class="form-control" name="phone" 
								value="<?php echo $stdentDetails->phone; ?>" >
						</div> 
					</div>
                <?php }
					$studentdetails = $stdentDetails;
					$dorm_id="";$room_id=""; $trans_id="";$trans_stop="";$is_hostel_member=0;$is_transport_member=0;
                               	if($studentdetails !=""){
                               	   $is_hostel_member    = $studentdetails->is_hostel_member;
                               	   $is_transport_member = $studentdetails->is_transport_member;

                               	   $dorm_id    = $studentdetails->hostel_id;
                               	   $room_id    = $studentdetails->dormitory_id;
                               	   $trans_id   = $studentdetails->transport_id;
                               	   $trans_stop = $studentdetails->transport_stop;
                               	}
 				    if(!in_array("dormitory", $field_arr)){ 
 				    	if($is_hostel_member!=0){ ?>
                   
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('dormitory');?></label>
                        
						<div class="col-sm-5">
							<select name="hostel_id" class="form-control" onchange="get_room_by_hostel(this.value,'edit');">
                              <option value=""><?php echo get_phrase('select');?></option>
	                            <?php
	                              $hostels = $this->db->get_where('hostels',array('status'=>1))->result();
                                  foreach($hostels as $hostel){ ?>
                                    <option value="<?php echo $hostel->id;?>" <?php if($dorm_id == $hostel->id) echo 'selected';?> ><?php echo $hostel->name; ?> [<?php echo $this->lang->line($hostel->type); ?>]</option>
                                <?php } ?>
                            </select>
						</div> 

					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('room');?></label>
                        <div class="col-sm-5">
							<select name="dormitory_id"  class="form-control edit_room_id">
                              <option value=""><?php echo get_phrase('room_no');?></option>
	                       </select>
						</div>
					</div>

					<?php } }
 				    if(!in_array("transport", $field_arr)){ 
 				    	if($is_transport_member!=0){ ?>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('transport_route');?></label>
                        
						<div class="col-sm-5">
							<select name="transport_id" class="form-control" onchange = "transportroute(this.value,'edit');">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php
                               $transports = $this->db->get('routes')->result_array();
                               foreach($transports as $row):
                                ?>
                              	<option value="<?php echo $row['id'];?>" <?php if($trans_id == $row['id']) echo 'selected';?> ><?php echo $row['route_start'];?></option>
                          		<?php endforeach;?>
                           </select>
						</div> 
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('transport_stop');?></label>

						<div class="col-sm-5">
							<select name="stop_id" id="edit_stop_id" class="form-control">
                              <option value=""><?php echo get_phrase('select');?></option>
                            </select>
						</div>
					</div>

                    <?php } }
                     //if(!in_array("transport_stop", $field_arr)){ ?>
                     <div class="form-group"><label for="field-1" class="col-sm-3 control-label">Blood Group</label>
                        	<div class="col-sm-5">
                        	    <select  class="form-control col-md-7 col-xs-12" name="blood_group" id="blood_group">
                                    <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                    <?php $bloods = get_blood_group(); ?>
                                    <?php foreach($bloods as $key=>$value){ ?>
                                        <option value="<?php echo $key; ?>" <?= ($stdentDetails->blood_group==$key?'selected':'')?>><?php echo $value; ?></option>
                                    <?php } ?>
                                </select>
                        </div>
                       </div>
					<?php //} 
                    // $i=0;
                    /* foreach ($create_dianamic_field as $htmlcode) { 
                    	//if(){ textbox  textarea selectbox  imageupload documentupload
                    	$othervalue = "";
                    	$otherfieldss = $studentval->otherfields;
                    	if($otherfieldss != ""){
                    	 $otherjosn   = json_decode($otherfieldss);
                    	 $othervalue  = $otherjosn[$i]->value;
                    	}
                    	$field_type  = json_decode($htmlcode->json_field_elements);
                    	if($field_type->type == 'textbox'){
                    	?>
                        <div class="form-group"><label for="field-1" class="col-sm-3 control-label"><?php echo $field_type->description;?></label>
                        	<div class="col-sm-5">
                        		<input type="text" class="form-control" name="<?php echo $field_type->name;?>" data-validate="required" value="<?php echo $stdentDetails->blood_group; ?>" autofocus required>
                        </div>
                      </div>
                   
                  <?php }elseif($field_type->type == 'textarea'){ ?>
                      <div class="form-group"><label for="field-1" class="col-sm-3 control-label"><?php echo $field_type->description;?></label>
                      	<div class="col-sm-5"><textarea name = "<?php echo $field_type->name;?>"><?php echo $othervalue;?></textarea>
                      	</div>
                      </div>

                  <?php }elseif($field_type->type == 'selectbox'){ ?>
                          <div class="form-group fieldBox"><label for="field-2" class="col-sm-3 control-label"><?php echo $field_type->description;?></label><div class="col-sm-5">
                          	<select name="<?php echo $field_type->name;?>" id="fieldType" class="form-control col-md-12" ><?php echo $field_type->value;?></select>
                          </div>
                         </div>
                   

                    <?php }elseif($field_type->type == 'imageupload'){ 

                    		$imagevalue_ = $otherjosn[$i]->value
                    	?>
                          <div class="form-group"><label for="field-1" class="col-sm-3 control-label"><?php echo $field_type->description;?></label>
                          <div class="col-sm-5">
                          	<div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden" >
                          		<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                          			<img src="<?php echo base_url('uploads/other_student_image').'/'.$imagevalue_;?>" alt="...">
                          		</div>
                          		<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;">
                          		</div>
                          		<div>
                          			<span class="btn btn-white btn-file">
                          				<span class="fileinput-new">Select image</span>
                          			<span class="fileinput-exists">Change</span>
                          			<input name="<?php echo $field_type->name;?>" accept="image/*" type="file"></span><a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                          		</div>
                          	</div>
                          </div>
                      </div>
                   
                    <?php }elseif($field_type->type == 'documentupload'){ 
                    	$documentvalue_ = $otherjosn[$i]->value
                    	?>
                          <div class="form-group">
                          	<label for="field-1" class="col-sm-3 control-label"><?php echo $field_type->description;?></label>
                          	<div class="col-sm-5">
                          		<div class="fileinput fileinput-new" data-provides="fileinput">
                          			<input type="hidden">
                          			<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                          				<img src="<?php echo base_url('uploads/other_student_image').'/'.$documentvalue_;?>" alt="..."></div>
                          				<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;">
                          					
                          				</div>
                          				<div>
                          					<span class="btn btn-white btn-file">
                          					<span class="fileinput-new">Select Document</span>
                          					<span class="fileinput-exists">Change</span>
                          					<input name="<?php echo $field_type->name;?>" accept="image/*" type="file">
                          				</span>
                          				<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                          			</div>
                          		</div>
                          	</div>
                          </div>
                  <?php } $i++; }  */
                    ?>
                    <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Status</label>
                        
						<div class="col-sm-5">
							<select name="status" class="form-control select2" data-validate="required" onchange="if(this.value=='1'){$('#reason').hide()}else{$('#reason').show()}" data-message-required="<?php echo get_phrase('value_required');?>">
                              <option value=""><?php echo get_phrase('select');?></option>
                              
                                		<option value="1" <?= $stdentDetails->status==1?'selected':''?>>Active </option>
                                		<option value="0" <?= $stdentDetails->status == 0 ?'selected':''?>>Drop Out </option>
	                               
                          </select>
						</div> 
					</div>
					<div class="form-group" id="reason" style='<?= $stdentDetails->status==1?'display:none':''?>'  ><label class="col-sm-3 control-label">Reason</label>
                        	<div class="col-sm-5">
                        		<input type="text" class="form-control" name="reason" data-validate="required" value="<?php echo $stdentDetails->reason;?>" autofocus>
                        </div>
                        </div>
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('edit_student');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>

  <script>

	if("<?php echo $trans_id;?>" != ""){
        transportroute("<?php echo $trans_id;?>",'edit');
        $('#edit_stop_id').val("<?php echo $trans_stop;?>");
    }

	if("<?php echo $dorm_id;?>" != ""){
        get_room_by_hostel("<?php echo $dorm_id;?>",'edit');
        $('.edit_room_id').val("<?php echo $room_id;?>");
        
	}

	function get_room_by_hostel(hostel_id,type){       
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_room_by_hostel'); ?>",
            data   : { hostel_id : hostel_id },               
            async  : false,
            success: function(response){       
                                          
               if(response)
               {                  
                 
                   if(type == 'edit')
                  	$('.edit_room_id').html(response);
                  else
                  	$('.room_id').html(response);
               }
            }
        });         
    } 


    function transportroute(route_id,type){       
           
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_transportroute'); ?>",
            data   : { route_id : route_id },               
            async  : false,
            success: function(response){                                                   
               if(response)
               {                  
                  
                  if(type == 'edit')
                  	$('#edit_stop_id').html(response);
                  else
                  	$('#stop_id').html(response);
               }
            }
        });         
    }

    function get_edit_autogenrate_roll(value,edit_id,old_section){
     var class_id = $('#class_id').val();
     if(class_id != "" && value != ""){
   		$.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('ajax/get_edit_autogenrate_roll'); ?>",
          data   : {'section_id' : value,'class_id':class_id,'edit_id':edit_id,'old_section_id':old_section},               
          async  : false,
          success: function(data){ 
			var parse_json = JSON.parse(data);
            $('#perifix_code_value').html(parse_json['roll_no_perifix']);
            $('#roll_no').val(parse_json['roll_no']);
          }
      	});
    }
}
</script>