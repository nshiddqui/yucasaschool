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
                    		<th><div><?php echo get_phrase('Amount Credit');?></div></th>
							<th><div><?php echo get_phrase('salary_deduction');?></div></th>
							<th>Reason</th>
							<th>Pay By</th>
							<th><div><?php echo get_phrase('Payslip');?></div></th>
							
						</tr>
					</thead>
                    <tbody>
				
					 <?php  if($salary != ""){
						 $i=1;
                        foreach($salary as $dt){
                            ?>
                    	<tr>
                    		<td><?php echo $i;?></td>
                    	 <td><?php echo date('d F Y',strtotime($dt->created_at));?></td>
                    		<td><?php echo $dt->net_salary; ?></td>
                    		<td><?php echo $dt->total_deduction; ?></td>
                    		<td><?php echo $dt->note; ?></td>
                    		<td><?php echo $dt->payment_method; ?></td>
							<?php $payslip_status=$dt->payslip_status; ?>
							<?php if($payslip_status=='0'){?>
                    		<td><button onclick="approve_status(<?php echo $dt->id;?>)" class="btn btn-warning">Request Payslip</button></td>
							<?php } elseif($payslip_status=='1') { ?>
							<td><button class="btn btn-success">Payslip Requested</button></td>
					 <?php }elseif($payslip_status=='2'){ ?>
							<td><button onclick="approve_status(<?php echo $dt->id;?>)" class="btn btn-danger">Request Rejected</button></td>
					 <?php } ?>
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
            url    : "<?php echo site_url('designation_users/salary_update_status'); ?>",
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

	
</script>

<!-----  DATA TABLE EXPORT CONFIGURATIONS ----->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable();
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script>