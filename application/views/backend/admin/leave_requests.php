<?php $activeTab = "leave_management"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Human Resource</a></li>
        <li class="active">Leave Requests</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/human_resource_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<div class="row">
	<div class="col-md-12">
    	<!--CONTROL TABS START-->
		<ul class="nav nav-tabs bordered hidden">
		    <li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('leave_request_list');?>
                    	</a></li>
		
		</ul>
    	<!--CONTROL TABS END-->
        
	
		<div class="tab-content">
        <br>
			<!--TABLE LISTING STARTS-->
            <div class="tab-pane box <?php if(!isset($edit_data))echo 'active';?>" id="list">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered datatable" >
                	<thead>
                		<tr>
                		   <th style="display:none;"><div><?php echo get_phrase('leave_request_id');?></div></th>
                    		<th><div><?php echo get_phrase('leave_request_id');?></div></th>
                    		<th><div><?php echo get_phrase('leave_dates');?></div></th>
							<th><div><?php echo get_phrase('request_by');?></div></th>
							<th><div><?php echo get_phrase('status');?></div></th>
                    		<th><div><?php echo get_phrase('Reason_for_leave');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    <?php 
				       if($leave_data != ""){
				        $i=1;
				       foreach ($leave_data as  $dt) { 
				       	$diff_date = "1 day";
				       	if($dt->from_date != "" && $dt->to_date != ""){
				       	 $fdate = date('Y-m-d',strtotime($dt->from_date));
				       	 $tdate = date('Y-m-d',strtotime($dt->to_date));
				       	 $date1 = new DateTime("$fdate");
                         $date2 = new DateTime("$tdate");
                         $diff  = date_diff($date1,$date2);
                         $diff_date = $diff->format('%a days');
				       	}
                       // echo 
				       

                        ?>
                        <tr>
                          <td style="display:none;"></td>
							<td><?php echo $dt->uniqid;?></td>
							<td><?php echo $fdate; ?> &nbsp;to&nbsp; <?php echo $tdate;?></td>
							<?php $role_id= $dt->role_id; ?>
							<?php if($role_id==4){?>
							<td><?php $student = $this->crud_model->get_student_info_by_id($dt->request_by);
							          echo  $student['name']; ?>[Apply Student]</td>
							      <?php } elseif($role_id==8){?>
							<td><?php $student = $this->crud_model->get_student_info_by_id($dt->request_by);
							          echo  $student['name']; ?>[Apply Parent]</td>  
							          <?php }  elseif($role_id==5 ){?>
							<td><?php $student = $this->crud_model->get_student_info_by_id($dt->request_by);
					      	echo 	$name = $this->db->get_where(teacher, array(teacher.'_id' => ($dt->request_by)))->row()->name;
							        ?>[Apply Teacher]</td>
							          <?php }elseif($role_id==9 || $role_id==13) { ?>
							          	<td>  <?php echo $name = $this->db->get_where('employees', array('user_id' =>($dt->request_by)))->row()->name; ?> [Apply Employees]</td>
							          	<?php }elseif($role_id==6){ ?>
							          	 	<td>  <?php echo $name = $this->db->get_where('accountant', array('accountant_id' =>($dt->request_by)))->row()->name; ?> [Accountant]</td>
							          	 	<?php } elseif($role_id==7){ ?>
							            	 <td>  <?php echo $name = $this->db->get_where('librarian', array('librarian_id' =>($dt->request_by)))->row()->name; ?> [Librarian]</td>
							          	 		<?php } ?>
							<td><span class="<?php echo $dt->status;?>"><?php echo $dt->status;?></span></td>
                            <td><!-- Reason No 2 --><?php echo $dt->reason;?></td>
                            <td>
                            <div class="btn-group">
		                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
		                            Action <span class="caret"></span>
		                        </button>
		                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">

		                            <li>
		                                <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/leave_request_view/'.$dt->leave_id);?>')">
		                                    <i class="entypo-pencil"></i>
		                                    <?php echo get_phrase('View');?>
		                                </a>
		                            </li>

		                            <li>
		                                <a href="#" onclick="approve_status(<?php echo $dt->leave_id;?>)">
		                                    <i class="entypo-check"></i>
		                                    <?php echo get_phrase('Approve');?>
		                                </a>
		                            </li>

		                            <li>
		                                <a href="#" onclick="reject_status(<?php echo $dt->leave_id;?>)">
		                                    <i class="entypo-cancel"></i>
		                                    <?php echo get_phrase('Reject');?>
		                                </a>
		                            </li>


		                            <li class="divider"></li>

		                            <li>
		                                <a href="#" onclick="confirm_modal('<?php echo site_url('admin/leave_requests/delete/'.$dt->leave_id);?>');">
		                                    <i class="entypo-trash"></i>
		                                    <?php echo get_phrase('delete');?>
		                                </a>
		                            </li>
		                        </ul>
		                    </div>
	                </td>
                        </tr>
                <?php } } ?>       
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->          
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(site_url('admin/dormitory/create'), array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('leave_request_id');?></label>

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
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('status');?></label>

								<div class="col-sm-5">
									<select name="parent_id" class="form-control select2" required>
									  <option value=""><?php echo get_phrase('select');?></option>
									  <option value=""><?php echo get_phrase('approved');?></option>
									  <option value=""><?php echo get_phrase('unapproved');?></option>
									  <option value=""><?php echo get_phrase('pending');?></option>
								  </select>
								</div>
							</div>
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('done');?></button>
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
	function approve_status(leave_id){
      $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('admin/leave_update_status'); ?>",
            data   : { leave_id : leave_id,status:'approved' },               
            async  : false,
            success: function(response){                                                   
               if(response)
               {

                location.reload();
               }
            }
        });   
	}
    
    function reject_status(leave_id){
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('admin/leave_update_status'); ?>",
            data   : { leave_id : leave_id,status:'reject' },               
            async  : false,
            success: function(response){                                                   
               if(response)
               { 
                location.reload();
               }
            }
        });
	}
	
</script>