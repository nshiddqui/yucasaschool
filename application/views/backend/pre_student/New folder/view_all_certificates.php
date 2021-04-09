<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('certificates_list');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>
		<div class="tab-content">            
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
				
                <table class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                           <th width="120px"><div><?php echo get_phrase('certificates_id');?></div></th>
                           <th><div><?php echo get_phrase('student_name');?></div></th>
                           <th><div><?php echo get_phrase('certificates_type');?></div></th>
						   <th><div><?php echo get_phrase('date');?></div></th>
                    	   <th><div><?php echo get_phrase('class');?></div></th>
                    	   <th><div><?php echo get_phrase('description');?></div></th>
                           <th><div><?php echo get_phrase('download');?></div></th>
                    	   <th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                        <tr>
							<td>TC-001</td>
							<td>Sonu</td>
							<td>Transfer Certificate</td>
							<td>09/14/2018</td>
							<td>Tenth</td>
							<td>moving to delhi</td>
							<td><a class="btn btn-blue btn-icon icon-left"><i class="entypo-download"></i>Download</a></td>
							<td>
								<div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                        <li>
                                            <a href="#" class="btn btn-info btn-xs" style="width:50%;margin: 5px auto;">
                                                <i class="entypo-eye"></i>
                                                 View </a>
                                        </li>
                                        <li>
                                          <a href="#" class="btn btn-primary btn-xs");" style="width:50%;margin: 5px auto;">
                                            <i class="entypo-print"></i>
                                              Print</a>
                                        </li>
                                    </ul>
                                </div>

							</td>
                        </tr>
                    </tbody>
                </table>
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