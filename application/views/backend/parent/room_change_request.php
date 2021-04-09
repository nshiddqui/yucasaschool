<?php $activeTab = "dormitory"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Facilities</a></li>
        <li class="active">Dormitory</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/parent/facilities_nav_tab.php'; ?>
<!-- Including Navigation Tab -->
</div>
<div class="row">
	<div class="col-md-12">
    	<!--CONTROL TABS START-->	
		<div class="tab-content">
        <br>      
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box <?php if(!isset($edit_data))echo 'active';?>" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(site_url('parents/room_change_request/create'), array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
					<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('student_id');?></label>
                                <div class="col-sm-5">
                                <select name="class_id" class="form-control" data-validate="required" id="class_id"
								data-message-required="<?php echo get_phrase('value_required');?>"
									onchange="return get_hostel_details(this.value)">
                                  <option value=""><?php echo get_phrase('select');?></option>
                                <?php
							        $this->db->select("S.*");
							        $this->db->from('student AS S');
							        $this->db->join('enroll AS E', 'S.student_id = E.student_id', 'left');
							        $this->db->where('S.parent_id',$this->session->userdata('login_user_id'));
							        $resultStudent = $this->db->get()->result();
								   foreach($resultStudent as $row):?>
                            		    <option value="<?php echo $row->student_id;?>">
											<?php echo $row->name;?>
                                        </option>
                                   <?php
								   endforeach;
							       ?>
                            </select>
                                </div>
                            </div>
                         <!--    <div class="form-group">
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
							</div> -->

							<div id="addhostel_details"></div>
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
            
		</div>
	</div>
</div>

<script type="text/javascript">
	function get_hostel_details(val){

		 $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_student_hostel_details'); ?>",
            data   : { student_id : val },               
            async  : false,
            success: function(response){   
                if(response)
               {                  
                 $('#addhostel_details').html(response);
               }
            }
        });   
	}

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