<hr />
<div class="row">
	<div class="col-md-12">
    	<!--CONTROL TABS START-->	
		<div class="tab-content">
        <br>      
			<!----CREATION FORM STARTS---->
		<?php	if($hostel_data != ""){   ?>
			<div class="tab-pane box <?php if(!isset($edit_data))echo 'active';?>" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(site_url('student/student_roomchange_request/create'), array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
					<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('student_id');?></label>
                                <div class="col-sm-5">
                                    <input readonly type="text" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $hostel_data->student_code;?>" disabled/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-5">
                                    <input type="text"  class="form-control" value="<?php echo $hostel_data->student_name;?>" disabled/>
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
		<?php } ?>
			<!----CREATION FORM ENDS-->
            
		</div>
	</div>
</div>


<script type="text/javascript">
	
	    function get_room_by_hostel(hostel_id){       
           
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_room_by_hostel'); ?>",
            data   : { hostel_id : hostel_id },               
            async  : false,
            success: function(response){                                                   
               if(response)
               {                  
                  $('#room_id').html(response);
               }
            }
        });         
    } 
</script>