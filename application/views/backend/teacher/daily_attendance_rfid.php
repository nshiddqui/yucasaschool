<div class="row">
	<div class="col-md-8">
		<div class="panel panel-primary" data-collapsed="0">

        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('addmission_form');?>
            	</div>
            </div>
            
			<div class="panel-body">

                <?php echo form_open(site_url('admin/student/create/') , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus required>

						</div>
						
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('parent');?></label>

						<div class="col-sm-5">
							<select name="parent_id" class="form-control select2" required>
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php
								$parents = $this->db->get('parent')->result_array();
								foreach($parents as $row):
									?>
                            		<option value="<?php echo $row['parent_id'];?>">
										<?php echo $row['name'];?>
                                    </option>
                                <?php
								endforeach;
							  ?>
                          </select>
						</div>

						<a href="javascript:;" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_parent_add_by_student/');?>');" class="btn btn-primary pull-right">
		                <i class="entypo-plus-circled"></i>
		                <?php echo get_phrase('add_new_parent');?>
		                </a>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>

						<div class="col-sm-5">
							<select name="class_id" class="form-control select2" required id="class_id"
								onchange="return get_class_sections(this.value)">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php
								$classes = $this->db->get('class')->result_array();
								foreach($classes as $row):
									?>
                            		<option value="<?php echo $row['class_id'];?>">
											<?php echo $row['name'];?>
                                            </option>
                                <?php
								endforeach;
							  ?>
                          </select>
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('section');?></label>
		                    <div class="col-sm-5">
		                        <select name="section_id" class="form-control select2" id="section_selector_holder">
		                            <option value=""><?php echo get_phrase('select_class_first');?></option>

			                    </select>
			                </div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('id_no');?></label>

						<div class="col-sm-5">
							<?php $perfix_code =  @$this->db->get_where('settings' , array('type' =>'perifix_code'))->row()->description;?>
							<input type="text" class="form-control" name="student_code" value="<?php echo $perfix_code.'_'.substr(md5(uniqid(rand(), true)), 0, 5); ?>" data-validate="required" id="class_id"
								data-message-required="<?php echo get_phrase('value_required');?>">
						</div>
					</div>

                    <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="email" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="">
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('password');?></label>

						<div class="col-sm-5">
							<input type="password" class="form-control" name="password" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" >
						</div>
					</div>
                    <?php if(!in_array("birthday", $field_arr)){ ?>
					<div class="form-group" >
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('birthday');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control datepicker" name="birthday" value="" data-start-view="2">
						</div>
					</div>
 				   <?php } 
 				    if(!in_array("gender", $field_arr)){ ?>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('gender');?></label>

						<div class="col-sm-5">
							<select name="sex" class="form-control select2">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="male"><?php echo get_phrase('male');?></option>
                              <option value="female"><?php echo get_phrase('female');?></option>
                          </select>
						</div>
					</div>
					<?php } 
 				    if(!in_array("address", $field_arr)){ ?>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="address" value="" >
						</div>
					</div>
					<?php } 
 				    if(!in_array("phone", $field_arr)){ ?>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="phone" value="" >
						</div>
					</div>
					<?php } 
 				    if(!in_array("dormitory", $field_arr)){ ?>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('hostel');?></label>

						<div class="col-sm-5">
							<select name="hostel_id" class="form-control select2" onchange="get_room_by_hostel(this.value,'add');">
                              <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                <?php  
                                  $hostels = $this->db->get_where('hostels',array('status'=>1))->result();
                                  foreach($hostels as $hostel){ ?>
                                    <option value="<?php echo $hostel->id; ?>"><?php echo $hostel->name; ?> [<?php echo $this->lang->line($hostel->type); ?>]</option>
                                <?php } ?>
                          </select>
						</div>
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('room');?></label>
                        <div class="col-sm-5">
							<select name="dormitory_id" class = "room_id  form-control select2" >
                              <option value=""><?php echo get_phrase('room_no');?></option>
	                       </select>
						</div>
					</div>
					<?php } 
					
				if(!in_array("discount_id", $field_arr)){ ?>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('discount');?></label>

						<div class="col-sm-5">
							<select name="discount_id" class="form-control select2">
                              <option value=""><?php echo get_phrase('select');?></option>
	                              <?php
	                              	$discounts = $this->db->get('discounts')->result_array();
	                              	foreach($discounts as $row):
	                              ?>
                              		<option value="<?php echo $row['id'];?>"><?php echo $row['title'];?></option>
                          		<?php endforeach;?>
                          </select>
						</div>
					</div>
					<?php } 
					
 				    if(!in_array("transport", $field_arr)){ ?>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('transport_route');?></label>

						<div class="col-sm-5">
							<select name="transport_id" class="form-control select2" onchange = "transportroute(this.value,'add');">
                              <option value=""><?php echo get_phrase('select');?></option>
	                              <?php
	                              	$transports = $this->db->get('routes')->result_array();
	                              	foreach($transports as $row):
	                              ?>
                              		<option value="<?php echo $row['id'];?>"><?php echo $row['route_start'];?>-<?php echo $row['route_end'];?></option>
                          		<?php endforeach;?>
                          </select>
						</div>
					</div>
                     
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('transport_stop');?></label>

						<div class="col-sm-5">
							<select name="stop_id" id="stop_id" class="form-control select2">
                              <option value=""><?php echo get_phrase('select');?></option>
                            </select>
						</div>
					</div>

					<?php } 
 				    //if(!in_array("transport_stop", $field_arr)){ ?>


					<?php //} 
 				    if(!in_array("photo", $field_arr)){ ?>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>

						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="http://placehold.it/200x200" alt="...">
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

                    <?php } 

                    //print_r($create_dianamic_field);

                    foreach ($create_dianamic_field as $htmlcode) { 
                    	echo  json_decode($htmlcode->html_code);
                    }
                    ?>



                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button onclick="create_form();" type="submit" class="btn btn-info"><?php echo get_phrase('add_student');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
    <div class="col-md-4 studentSidebar">
		<blockquote class="blockquote-blue">
			<p>
				<strong>Student Admission Notes</strong>
			</p>
			<p>
				Admitting new students will automatically create an enrollment to the selected class in the running session.
				Please check and recheck the informations you have inserted because once you admit new student, you won't be able
				to edit his/her class,roll,section without promoting to the next session.
			</p>
		</blockquote>

		<div class="addFieldBox">
			<h4>
				<strong>Field Management</strong>
			</h4>
			<div class="addField">
				<i class="fa fa-plus"></i> Add New Field
			</div>

			<div class="fieldBoxContainer">

			<div class="form-group fieldBox">
				<label for="field-2" class="col-sm-4 control-label text-left">Field Name</label>
				
				<div class="col-sm-8">
					<input type="text" class="form-control" id="filedName" name="filedName" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" onblur="checkfieldsname(this.value);" required>

					<span class="errorMsg" id="fieldNameError"></span>
				</div>

			</div>


			<div class="form-group fieldBox">
				<label for="field-2" class="col-sm-4 control-label">Field Type</label>

				<div class="col-sm-8">
					<select name="" id="fieldType" class="form-control col-md-12" disabled>
						<!-- <option value="">--select--</option> -->
						<option value="textbox">Text Box</option>
						<option value="textarea">Text Area</option>
						<option value="selectbox">Select Box</option>
						<option value="imageupload">Image Upload</option>
						<option value="documentupload">Document Upload</option>
					</select>
				</div>
			</div>
			

			<div class="form-group fieldBox textBox">
				<label for="field-2" class="col-sm-4 control-label text-left"> Placeholder</label>

				<div class="col-sm-8">
					<input type="text" class="form-control" name="placeHolder" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" >
				</div>
			</div>

			<div class="form-group fieldBox selectBox">
				<label for="field-2" class="col-sm-4 control-label text-left">Enter Options</label>

				<div class="col-sm-8 optionList">
					<input type="text" class="form-control" name="option1" data-validate="required"  value="" >
				</div>

				<div class="form-group pull-right" style="padding-right: 20px;"><span class="anotherOption">Add Another Option <i class="fa fa-plus"></i></span></div>	
			</div>


			<div class="col-md-12 saveField text-right form-group" ><span class="" style="">Add Field</span></div>	



			</div>


		</div>

		<div>
			<div>
				To change registration form fields click <a href="<?php echo base_url(); ?>index.php/admin/system_settings"> here</a>
			</div>
			
		</div>
	</div>

</div>

