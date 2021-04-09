<hr />
<div class="row">
	<div class="col-md-12">
    	<!--CONTROL TABS START-->
		<ul class="nav nav-tabs bordered">
			<li  class="active">
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('assign_room');?>
                </a>
			</li>
		</ul>
    	<!--CONTROL TABS END-->
        
	
		<div class="tab-content">
        <br>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box <?php if(!isset($edit_data))echo 'active';?>" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(site_url('admin/dormitory/create'), array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('dormitory_name');?></label>

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
							</div>
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('room_number');?></label>

								<div class="col-sm-5">
									<select name="parent_id" class="form-control select2" required>
									  <option value=""><?php echo get_phrase('select');?></option>
									  <option value=""><?php echo get_phrase('A01');?></option>
									  <option value=""><?php echo get_phrase('A02');?></option>
									  <option value=""><?php echo get_phrase('A03');?></option>
									  <option value=""><?php echo get_phrase('A04');?></option>
								  </select>
								</div>
							</div>
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
								<div class="col-sm-5">
									<select name="class_id" class="form-control" data-validate="required" id="class_id"
										data-message-required="<?php echo get_phrase('value_required');?>"
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
		                        <select name="section_id" class="form-control" id="section_selector_holder">
		                            <option value=""><?php echo get_phrase('select_class_first');?></option>

			                    </select>
			                </div>
					</div>
					<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('student_id');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="number_of_room" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="description"/>
                                </div>
                            </div>
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('assign_rooms');?></button>
                              </div>
							</div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->
            
		</div>
	</div>
</div>