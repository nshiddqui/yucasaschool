<hr />
<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('salary_list');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>
		<div class="tab-content">
        <br>            
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
				
                <table class="table table-bordered datatable" >
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('S.No');?></div></th>
                    		<th><div><?php echo get_phrase('Date');?></div></th>
                    		<th><div><?php echo get_phrase('Requested By');?></div></th>
							<th><div><?php echo get_phrase('Designation');?></div></th>
							<th><div><?php echo get_phrase('Status');?></div></th>
							<th><div><?php echo get_phrase('Print Option');?></div></th>
							
						</tr>
					</thead>
                    <tbody>
				
					<?php  if($salarys != ""){
						 $i=1;
                        foreach($salarys as $dt){
                            ?>
                    	<tr>
                    		<td><?php echo $i;?></td>
                    	 <td><?php echo date('d F Y',strtotime($dt->created_at));?></td>
						 <?php 
						  $payment_to= $dt->payment_to;
						  $user_id= $dt->user_id;
						  if($payment_to=='librarian'){
						   $result = $this->db->get_where('librarian',array('librarian_id'=>$user_id))->row();
						  }elseif($payment_to=='teacher'){
						   $result = $this->db->get_where('teacher',array('teacher_id'=>$user_id))->row();
						   }elseif($payment_to=='accountant'){
                           $result = $this->db->get_where('accountant',array('accountant_id'=>$user_id))->row();
						   } 

						   ?>
                    		<td><?php echo $result->name;?></td>
							
                    		<td><?php echo $dt->payment_to;?></td>
                    		<td><div class="btn-group">
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
		                                <a href="#" onclick="confirm_modal('<?php echo site_url('admin/leave_requests/delete/'.$dt->leave_id);?>');">
		                                    <i class="entypo-trash"></i>
		                                    <?php echo get_phrase('delete');?>
		                                </a>
		                            </li>
		                        </ul>
		                    </div></td>
                    		<td><a href="salary_payslips/<?php echo $dt->id; ?>" class="btn btn-blue btn-icon icon-left"  target="_blank">
                        	<i class="entypo-download"></i>
                        View Payslip                    </a></td>

                    	</tr>
                    	<?php $i++; }} ?>	
                    </tbody>
                </table>
                
			</div>
            <!----TABLE LISTING ENDS--->

            
		</div>
	</div>
</div>

<script type="text/javascript">
	function approve_status(id){
      $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('accountant/salary_update_status'); ?>",
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
    
    function reject_status(id){
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('accountant/salary_update_status'); ?>",
            data   : { id : id,status:'3' },               
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
<!-----  DATA TABLE EXPORT CONFIGURATIONS ----->                      
