<hr />
<div class="row">
	<div class="col-md-12">
    	<!--CONTROL TABS START-->	
		<div class="tab-content">
        <br>      
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box <?php if(!isset($edit_data))echo 'active';?>" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(site_url('admin/dormitory/create'), array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
					<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('teacher_id');?></label>
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
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('apply');?></button>
                              </div>
							</div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->
            
		</div>
	</div>
</div>