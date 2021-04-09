<?php
$field_arr  = $this->crud_model->registration_form_fiels_teacher();
$create_dianamic_field  = $this->crud_model->get_registration_fields_teacher();

$edit_data		=	$this->db->get_where('teacher' , array('teacher_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
	$links_json = $row['social_links'];
	$links = json_decode($links_json);
  // echo  $row['otherfields'];
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_teacher');?>
            	</div>
            </div>
			<div class="panel-body">
                    <?php echo form_open(site_url('admin/teacher/do_update/'.$row['teacher_id']) , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>

                                <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>

                                <div class="col-sm-5">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                            <img src="<?php echo $this->crud_model->get_image_url('teacher' , $row['teacher_id']);?>" alt="...">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                        <div>
                                            <span class="btn btn-white btn-file">
                                                <span class="fileinput-new">Select image</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" name="userfile" accept="image/*">
                                            </span>
                                            <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>
                                </div>
                             </div>
                             <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">RFID</label>
                                <div class="col-sm-5">
                                    <input class="form-control" name="rfid" value = "<?php echo $row['rfid_code'];?>" data-validate="required" data-message-required="Value Required" type="text">
                                </div>
                             </div>
                             <div class="form-group">
                                <label class="col-sm-3 control-label">Class teacher?</label>
                                <div class="col-sm-5">
                                    <input type="radio" class="form-control" name="is_class_teacher" value="1" <?php if($row['is_class_teacher']==1){echo "checked";}?> data-validate="required"/>Yes<br>
                                     <input type="radio" class="form-control" name="is_class_teacher" value="0" <?php if($row['is_class_teacher']==0){echo "checked";}?> data-validate="required"/>No<br>
                                </div>
                            </div>
                            <div class="form-group">
        						<label for="field-2" class="col-sm-3 control-label">Class</label>

        						<div class="col-sm-5">
        							<select name="salary_grade_id" class="form-control">
                                     
                                     <?php
                                        $children_of_parent = $this->db->get_where('class' , array(
                                            'status' =>1
                                        ))->result_array();

                                        foreach ($children_of_parent as $row1):
                        				$id=$row1['class_id'];
                                    ?>
                                      <option value="<?php echo $row1['class_id'];?>" <?php if($row['class_id'] == $id)echo 'selected';?>><?php echo $row1['name'];?></option>
        							    <?php endforeach;?>  
                                  </select>
        						</div>
        					</div>
        					<div class="form-group">
        						<label for="field-2" class="col-sm-3 control-label">Section</label>

        						<div class="col-sm-5">
        							<select name="section_id" class="form-control">
                                     <option>--SELECT--</option>
                                     
                                  </select>
        						</div>
        					</div>
        					
        					
        					
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>" data-validate="required"/>
                                </div>
                            </div>
                            
                            <?php if(!in_array("designation", $field_arr)){ ?>
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('designation');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="designation"
										value="<?php echo $row['designation'] == null ? '' : $row['designation'];?>" >
								</div>
							</div>
                        <?php } if(!in_array("birthday", $field_arr)){  ?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('birthday');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="datepicker form-control" name="birthday" value="<?php echo $row['birthday'];?>"/>
                                </div>
                            </div>
                        <?php } if(!in_array("gender", $field_arr)){ ?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('sex');?></label>
                                <div class="col-sm-5">
                                    <select name="sex" class="form-control ">
                                    	<option value="male" <?php if($row['sex'] == 'male')echo 'selected';?>><?php echo get_phrase('male');?></option>
                                    	<option value="female" <?php if($row['sex'] == 'female')echo 'selected';?>><?php echo get_phrase('female');?></option>
                                    </select>
                                </div>
                            </div>
                        <?php  }if(!in_array("address", $field_arr)){  ?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="address" value="<?php echo $row['address'];?>"/>
                                </div>
                            </div>
                        <?php } ?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="phone" value="<?php echo $row['phone'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="email" value="<?php echo $row['email'];?>" data-validate="required"/>
                                </div>
                            </div>
							
				
					    <div class="form-group">
                                <label class="col-sm-3 control-label">Salary Type </label>
                                <div class="col-sm-5">
                                    <select name="salary_type" class="form-control ">
                                    	<option value="monthly" <?php if($row['salary_type'] == 'monthly')echo 'selected';?>>Monthly</option>
                                    	<option value="hourly" <?php if($row['salary_type'] == 'hourly')echo 'selected';?>>Hourly</option>
                                    </select>
                                </div>
                            </div>
					
        					<div class="form-group">
        						<label for="field-2" class="col-sm-3 control-label">Salary Grade </label>

        						<div class="col-sm-5">
        							<select name="salary_grade_id" class="form-control">
                                     
                                     <?php
                                        $children_of_parent = $this->db->get_where('salary_grades' , array(
                                            'status' =>1
                                        ))->result_array();

                                        foreach ($children_of_parent as $row1):
                        				$id=$row1['id'];
                                    ?>
                                      <option value="<?php echo $row1['id'];?>" <?php if($row['salary_grade_id'] == $id)echo 'selected';?>><?php echo $row1['grade_name'];?></option>
        							    <?php endforeach;?>  
                                  </select>
        						</div>
        					</div>
							
                            <?php 
                                   if(!in_array("social_links", $field_arr)){
                            ?>
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('social_links');?></label>
								<div class="col-sm-8">
									<div class="input-group">
										<input type="text" class="form-control" name="facebook" placeholder="" value="<?php echo $links[0]->facebook;?>">
										<div class="input-group-addon">
											<a href="#"><i class="entypo-facebook"></i></a>
										</div>
									</div>
									<br>
									<div class="input-group">
										<input type="text" class="form-control" name="twitter" placeholder="" value="<?php echo $links[0]->twitter;?>">
										<div class="input-group-addon">
											<a href="#"><i class="entypo-twitter"></i></a>
										</div>
									</div>
									<br>
									<div class="input-group">
									<input type="text" class="form-control" name="linkedin" placeholder="" value="<?php echo $links[0]->linkedin;?>">
										<div class="input-group-addon">
											<a href="#"><i class="entypo-linkedin"></i></a>
										</div>
									</div>
								</div>
							</div>
                            <?php  } if(!in_array("social_links", $field_arr)){ ?>
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('show_on_website');?></label>
								<div class="col-sm-5">
								    <select name="show_on_website" class="form-control ">
                	                  <option value="1" <?php if ($row['show_on_website'] == 1) echo 'selected';?>><?php echo get_phrase('yes');?></option>
                	                  <option value="0" <?php if ($row['show_on_website'] == 0) echo 'selected';?>><?php echo get_phrase('no');?></option>
                	                </select>
								</div>
							</div>
                           <?php } ?>
                           <?php //} 
                     $i=0;
                     foreach ($create_dianamic_field as $htmlcode) { 
                        //if(){ textbox  textarea selectbox  imageupload documentupload
                       // print_r($htmlcode);
                        $othervalue   = "";
                        $otherfieldss = @$row['otherfields'];
                        if($otherfieldss != ""){
                          $otherjosn   = json_decode($otherfieldss);
                          $othervalue = @$otherjosn[$i]->value;
                        }
                        $field_type   = json_decode($htmlcode->json_field_elements);
                        if($field_type->type == 'textbox'){
                        ?>
                        <div class="form-group"><label for="field-1" class="col-sm-3 control-label"><?php echo $field_type->description;?></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="<?php echo $field_type->name;?>" data-validate="required" value="<?php echo $othervalue;?>" autofocus required>
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
                   <?php } $i++; }
                    ?>


                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_teacher');?></button>
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
