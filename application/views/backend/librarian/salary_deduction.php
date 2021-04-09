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
							<th><div><?php echo get_phrase('status');?></div></th>
							<th><div><?php echo get_phrase('Payslip');?></div></th>
							
						</tr>
					</thead>
                    <tbody>
                    	<tr>
                    		<td>1</td>
                    		<td>26-09-2018</td>
                    		<td>36,000.</td>
                    		<td>3000</td>
                    		<td>Employee Advance</td>
                    		<td>Credited</td>
                    		<td><button class="btn btn-success">Request Payslip</button></td>

                    	</tr>
                    	
                    </tbody>
                </table>
                
			</div>
            <!----TABLE LISTING ENDS--->

            
		</div>
	</div>
</div>


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