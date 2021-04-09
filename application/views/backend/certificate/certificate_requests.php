<?php $activeTab = "certificate_management"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Human Resource</a></li>
        <li class="active">Certificate Requests</li>
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
        
	
		
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered datatable" >
                	<thead>
                		<tr>
                    	  <th width="120px"><div><?php echo get_phrase('student_id');?></div></th>
                          <th><div><?php echo get_phrase('student_name');?></div></th> 
                           <th><div><?php echo get_phrase('certificates_type');?></div></th>
						   <th><div><?php echo get_phrase('date');?></div></th>
						   <th><div><?php echo get_phrase('apply_by');?></div></th>                    	
                    	   <th><div><?php echo get_phrase('description');?></div></th>
                           <th><div><?php echo get_phrase('status ');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                     <?php if($all_certificates != ""){
                            foreach ($all_certificates as  $dt) { ?>
                               
                        <tr>
							<td><?php echo $dt->student_code;?></td>
							<td><?php echo $dt->name;?></td>
							<td><?php echo $dt->certificate_type;?> </td>
							<td><?php echo $dt->createdate;?> </td>	
							
					     	<?php  $role= $dt->role_id; ?>			
                            <?php if ($role==8)	{ ?>			
							<td><?php echo $dt->parentname;?> [Parent]</td>	
                             <?php } elseif($role==4){ ?>		
                            <td><?php echo $dt->name;?> [Student]</td>
                             <?php } ?>						
							<td><?php echo $dt->description;?> </td>
							<?php $status= $dt->status;?> 
						
                            <?php if ($status==0){
							echo'<td><span class="pending">Pending</span></td>';
							}elseif($status==1){
								echo'<td><span class="approved">Approve</span></td>';
							}elseif($status==2){
								echo'<td><span class="rejected">Reject</span></td>';
								
							} ?>
                            <td>
                            <div class="btn-group">
		                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
		                            Action <span class="caret"></span>
		                        </button>
		                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">

		                            <li>
									   <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/certificate_request_view/'.$dt->id);?>')">
		                               
		                                    <i class="entypo-pencil"></i>
		                                    <?php echo get_phrase('View');?>
		                                </a>
		                            </li>

		                             <li>
		                                <a href="" onclick="approve_status(<?php echo $dt->id;?>)">
		                                    <i class="entypo-check"></i>
		                                    <?php echo get_phrase('Approve');?>
		                                </a>
		                            </li>

		                           <li>
		                                <a href="" onclick="reject_status(<?php echo $dt->id;?>)">
		                                    <i class="entypo-cancel"></i>
		                                    <?php echo get_phrase('Reject');?>
		                                </a>
		                            </li>
 <li class="divider"></li>
		                            <li>
		                               <!-- <a href="#" onclick="confirm_modal('<?php echo site_url('certificate/certificate_detail/delete/');?>');">-->
										 <a href="#" onclick="confirm_modal('<?php echo site_url('certificate/certificate_detail/delete/'.$dt->id);?>');">
		                                    <i class="entypo-trash"></i>
		                                    <?php echo get_phrase('delete');?>
		                                </a>
		                            </li>
		                        </ul>
		                    </div>
	                </td>
                        </tr>
          
		    <?php   }  } ?>
		  
		  
                    </tbody>
                </table>

            <!----TABLE LISTING ENDS--->          
			
		</div>
	</div>

<script type="text/javascript">
	function approve_status(id){
      $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('certificate/certificate_update_status'); ?>",
            data   : { id : id,status:'1' },               
            async  : false,
            success: function(response){                                                   
               if(response)
               {

                location.reload();
               }
            }
        });   
	}
    
    function reject_status(id){
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('certificate/certificate_update_status'); ?>",
            data   : { id : id,status:'2' },               
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