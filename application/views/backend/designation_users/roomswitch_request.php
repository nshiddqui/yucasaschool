<hr />
<div class="row">
	<div class="col-md-12">
    	<!--CONTROL TABS START-->
		<ul class="nav nav-tabs bordered">
		    <li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('request_list');?>
                    	</a></li>
			<!-- <li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('switch_assign_room');?>
                </a>
			</li> -->
		</ul>
    	<!--CONTROL TABS END-->
        
	
		<div class="tab-content">
        <br>
			<!--TABLE LISTING STARTS-->
            <div class="tab-pane box <?php if(!isset($edit_data))echo 'active';?>" id="list">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered datatable">
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('request_id');?></div></th>
                    		<th><div><?php echo get_phrase('room_number');?></div></th>
                            <th><div><?php echo get_phrase('student');?></div></th>
							<th><div><?php echo get_phrase('request_by');?></div></th>
							<th><div><?php echo get_phrase('designation');?></div></th>
                            <th><div><?php echo get_phrase('room_switch_status');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;
                    	if(isset($roomswitch_list) && !empty($roomswitch_list)){
                            // echo "<pre>";
                            //   print_r($roomswitch_list);
                            // echo "</pre>";
                        foreach($roomswitch_list as $row):?>
                        <tr>
							<td><?php echo $row->rId;?></td>
							<td><?php echo $row->hostel_name.'[  '.$row->room_no.'-'.$row->room_name.'  ]';?></td>
                            <td><?php echo $row->student_name;?></td>
                            <td><?php if($row->srole == PARENTT){ echo @$this->db->get_where('parent',array('parent_id'=>$row->screate_by))->row()->name;}else{ echo $row->student_name; }?></td>
                            <td><?php if($row->srole == STUDENT)
                                {echo 'student';}
                            elseif($row->srole == PARENTT){ echo 'parent';} ?></td>
                            <td><?php echo $row->room_status;?></td>
							<td>
                           
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    <!-- STUDENTS IN THE DORM -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_dormitory_student/'.$row->new_room_id);?>');">
                                            <i class="entypo-users"></i>
                                                <?php echo get_phrase('student');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                            <?php if($row->room_status != 'approve' && $row->room_status != 'reject'){ ?>
                                    <li>
                                      <a href="#" onclick='approve_status("<?php echo $row->id;?>","<?php echo $row->student_id;?>","<?php echo $row->new_room_id;?>","<?php echo $row->new_hostel_id;?>")'>
                                        <i class="entypo-check"></i>
                                        Approve                                     
                                      </a>
                                    </li>
                                     
                                    <li>
                                     <a href="#" onclick='reject_status("<?php echo $row->id;?>","<?php echo $row->student_id;?>","<?php echo $row->new_room_id;?>","<?php echo $row->new_hostel_id;?>")'>
                                        <i class="entypo-check"></i>
                                        Reject                             
                                     </a>
                                    </li>
                                    <li class="divider"></li>
                            <?php } ?>
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo site_url('designation_users/dormitory/delete/'.$row->id);?>');">
                                            <i class="entypo-trash"></i>
                                                <?php echo get_phrase('delete');?>
                                            </a>
                                    </li> 
                                 </ul>
                              </div>
        					</td>
                         </tr>
                        <?php endforeach;
                         } ?>
                    </tbody>
                </table>
			</div>
         </div>
	</div>
</div>

<script type="text/javascript">
   function approve_status(switch_id,student_id,room_id,hostel_id){
     var r = confirm("Are you sure Appreved this request !");
        if (r == false) {
           return false;
        }
        
      $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('admin/room_switch_status');?>",
            data   : {switch_id : switch_id,student_id : student_id,room_id : room_id,hostel_id : hostel_id,status:'approved' },               
            async  : false,
            success: function(response){                                                   
            if(response)
            {
                location.reload();
            }
          }
        });   
    }
    
    function reject_status(switch_id,student_id,room_id,hostel_id){
        var r = confirm("Are you sure Reject this request !");
        if (r == false) {
           return false;
        }


        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('admin/room_switch_status');?>",
            data   : { switch_id : switch_id,student_id : student_id,room_id : room_id,hostel_id : hostel_id,status:'reject' },               
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