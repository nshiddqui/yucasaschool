<?php	if($hostel_data != ""){   ?>
			
						<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('dormitory_name');?></label>

								<div class="col-sm-5">
									<select   class="form-control" disabled>
									  <option value=""><?php echo $hostel_data->hostel_name;?></option>
								  </select>
								</div>
							</div>
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('room_number');?></label>

								<div class="col-sm-5">
									<select  class="form-control " disabled>
									  <option value=""><?php echo $hostel_data->room_type.'[ '.$hostel_data->room_no.' ]';?></option>
								  </select>
								</div>
							</div>
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('room_cost');?></label>
                                <div class="col-sm-5">
                                    <input type="text"  class="form-control" value="<?php echo $hostel_data->cost;?>"disabled/>
                                </div>
                            </div>
<?php } ?>		