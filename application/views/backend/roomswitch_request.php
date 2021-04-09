<hr />
<div class="row">
	<div class="col-md-12">
    	<!--CONTROL TABS START-->
		<ul class="nav nav-tabs bordered">
		    <li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('request_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('switch_assign_room');?>
                </a>
			</li>
		</ul>
    	<!--CONTROL TABS END-->
        
	
		<div class="tab-content">
        <br>
			<!--TABLE LISTING STARTS-->
            <div class="tab-pane box <?php if(!isset($edit_data))echo 'active';?>" id="list">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('request_id');?></div></th>
                    		<th><div><?php echo get_phrase('room_number');?></div></th>
							<th><div><?php echo get_phrase('request_by');?></div></th>
							<th><div><?php echo get_phrase('designation');?></div></th>
                    		<th><div><?php echo get_phrase('description');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	
                        <tr>
							<td><?php echo $row['name'];?></td>
							<td><?php echo $row['number_of_room'];?></td>
							<td><?php echo $row['description'];?></td>
							<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                    <!-- STUDENTS IN THE DORM -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_dormitory_student/'.$row['dormitory_id']);?>');">
                                            <i class="entypo-users"></i>
                                                <?php echo get_phrase('students');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    
                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_edit_dormitory/'.$row['dormitory_id']);?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    
                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo site_url('admin/dormitory/delete/'.$row['dormitory_id']);?>');">
                                            <i class="entypo-trash"></i>
                                                <?php echo get_phrase('delete');?>
                                            </a>
                                                    </li>
                                </ul>
                            </div>
        					</td>
                        </tr>
                        
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->          
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(site_url('admin/dormitory/create'), array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('request_id');?></label>

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
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('dormitory_name');?></label>

								<div class="col-sm-5">
									<select name="parent_id" class="form-control select2" required>
									  <option value=""><?php echo get_phrase('boys_hostels');?></option>
								  </select>
								</div>
							</div>
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('room_number');?></label>

								<div class="col-sm-5">
									<select name="parent_id" class="form-control select2" required>
									  <option value=""><?php echo get_phrase('A002');?></option>
								  </select>
								</div>
							</div>
						<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('New_dormitory_name');?></label>

								<div class="col-sm-5">
									<select name="parent_id" class="form-control select2" required>
									  <option value=""><?php echo get_phrase('select');?></option>
									  <option value=""><?php echo get_phrase('boys_hostels');?></option>
									  <option value=""><?php echo get_phrase('good_hostels	');?></option>
								  </select>
								</div>
							</div>
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('new_room_number');?></label>

								<div class="col-sm-5">
									<select name="parent_id" class="form-control select2" required>
									  <option value=""><?php echo get_phrase('A001');?></option>
									  <option value=""><?php echo get_phrase('A002');?></option>
									  <option value=""><?php echo get_phrase('A003');?></option>
									  <option value=""><?php echo get_phrase('A004');?></option>
									  <option value=""><?php echo get_phrase('A005');?></option>
									  <option value=""><?php echo get_phrase('A006');?></option>
								  </select>
								</div>
							</div>
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('switch_rooms');?></button>
                              </div>
							</div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->
            
		</div>
	</div>
</div>