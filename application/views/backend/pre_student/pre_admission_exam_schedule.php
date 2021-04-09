<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('pre_exam_Schedule_list');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>
		<div class="tab-content">            
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
				
                <table class="table table-bordered datatable" >
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('examination_date_&_day');?></div></th>
                    		<th><div><?php echo get_phrase('time');?></div></th>
                    		<th><div><?php echo get_phrase('paper(s)');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    <?php if($pre_exam_info != ""){
                           foreach ($pre_exam_info as $key => $dt) {
                            	//'D, d M Y H:i:s'.
                             ?>
                        <tr>
							<td><?php echo date('F, d - Y ( l )',$dt->exam_date);?></td>
							<td><?php echo date('g:i a',strtotime($dt->time_start)) .' - '.date('g:i a',strtotime($dt->time_end));?></td>
							<td><?php echo $dt->title;?></td>
							
                        </tr>
                    <?php } } ?>
                       <!--  <tr>
							<td>10 February 2018 (Saturday)</td>
							<td>09:00 – 12:00 Hours (IST) (Forenoon Session)</td>
							<td>EC</td>
							
                        </tr> -->
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS-->
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