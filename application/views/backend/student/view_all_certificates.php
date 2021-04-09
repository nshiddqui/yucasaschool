<?php $activeTab = "certification"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">View All Certification</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/student/extra_curricular_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>


<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered hidden" >
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('certificates_list');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>
		<div class="tab-content">            
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
				
                <table class="table table-bordered datatable" >
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
                            <?php if ($role==8)	{?>			
							<td><?php echo $dt->parentname;?> [Parent]</td>	
                             <?php } elseif($role==4){ ?>		
                            <td><?php echo $dt->name;?> [Student]</td>
                             <?php } ?>					
							<td><?php echo $dt->description;?> </td>
							<?php $status= $dt->status;?> 
							<?php if ($status==0){
							echo'<td><span class="pending">Pending</span></td>';
							}elseif ($status==1){
								echo'<td><span class="approved">Approve</span></td>';
							}elseif ($status==2){
								
									echo'<td><span class="rejected">Reject</span></td>';
							} ?>
							<!--<td><a class="btn btn-blue btn-icon icon-left"><i class="entypo-download"></i>Download</a></td>-->
							<td>
							<?php if ($status==1){ ?>
								<div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                      <li>
									   <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/certificate_request_view/'.$dt->id);?>')">
		                               
		                                    <i class="entypo-pencil"></i>
		                                    <?php echo get_phrase('View');?>
		                                </a>
		                            </li>
                                    
                                    </ul>
                                </div>
							<?php }else{ ?>
							<div class="btn-group">
							 <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        Action <span class="caret"></span>
                                    </button>
							 <ul class="dropdown-menu dropdown-default pull-right" role="menu">
							 <li class="divider"></li>
		                            <li>
		                      
										 <a href="#" onclick="confirm_modal('<?php echo site_url('parents/certificate_detail/delete/'.$dt->id);?>');">
		                                    <i class="entypo-trash"></i>
		                                    <?php echo get_phrase('delete');?>
		                                </a>
		                            </li>
									       
                                    </ul>
                                </div>
							<?php } ?>
							</td>
                        </tr>
                        <?php   }  } ?>
                    </tbody>
                </table>
			</div>
		</div>
	</div>
</div>
</div>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable();
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script>