<hr />
<div class="row">
	<div class="col-md-12">
    	<!--CONTROL TABS START-->	
		<div class="tab-content">
        <br>    
        	<?php	if($hostel_data->hm_id != ""){   ?> 
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box <?php if(!isset($edit_data))echo 'active';?>" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(site_url('admin/dormitory/create'), array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
				<!-- 	<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('teacher_id');?></label>
                                <div class="col-sm-5">
                                    <input readonly type="text" class="form-control" name="number_of_room" data-validate="required" data-message-required="<?php //echo get_phrase('value_required');?>" value="AE3650"/>
                                </div>
                            </div> -->
                             <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-5">
                                    <input type="text"  class="form-control" value="<?php echo $hostel_data->teacher_name;?>" disabled/>
                                </div>
                            </div>
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
						<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('New_dormitory_name');?></label>

								<div class="col-sm-5">
									<select name="hostel_id" id="hostel_id" class="form-control select2" onchange="get_room_by_hostel(this.value);" required>
									 <option value="">--<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('hostel'); ?>--</option>
                                            <?php  
                                              $hostels = $this->db->get_where('hostels',array('status'=>1))->result();
                                              foreach($hostels as $hostel){ ?>
                                                <option value="<?php echo $hostel->id; ?>"><?php echo $hostel->name; ?> [<?php echo $this->lang->line($hostel->type); ?>]</option>
                                            <?php } ?>
								  </select>
								</div>
							</div>
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('new_room_number');?></label>

								<div class="col-sm-5">
									<select name="room_id" id = "room_id" class="form-control select2" required>
									 <option value="">--<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('room_no'); ?>--</option>
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
		<?php } ?>
            <b>Not Found !</b>
		</div>
	</div>
</div>