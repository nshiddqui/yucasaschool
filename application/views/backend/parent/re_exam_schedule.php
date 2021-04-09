<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('re_exam_schedule_list');?>
                    	</a></li>
            <li>
            	<a href="#cancellist" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('cancel_exam_list');?>
                </a>
            </li>
		</ul>
    	<!------CONTROL TABS END------>
		<div class="tab-content">            
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
				
                <table class="table table-bordered datatable" >
                	<thead>
                		<tr>
                            <th><div><?php echo get_phrase('s_no');?></div></th>
                            <th><div><?php echo get_phrase('reschedule_for');?></div></th>
                            <th><div><?php echo get_phrase('exam_name');?></div></th>
                            <th><div><?php echo get_phrase('class');?></div></th>
                            <th><div><?php echo get_phrase('subject');?></div></th>
                            <th><div><?php echo get_phrase('section');?></div></th>
                            <th><div><?php echo get_phrase('student');?></div></th>
                            <th><div><?php echo get_phrase('original_date');?></div></th>
                            <th><div><?php echo get_phrase('reschedule_date');?></div></th>
                            <th><div><?php echo get_phrase('reason');?></div></th>
                        </tr>
					</thead>
                    <tbody>
                    	<?php if($schedule_data != ""){
                    	$i = 1; 
                    		    foreach($schedule_data as $dt) {
                    	?>
                       <tr>
                              <td><?=$i++;?></td>
                              <td><?=$dt->reschedule_exam_for; ?></td>
                              <td><?php echo @$dt->exam_name; ?></td>
                              <td><?php echo  $dt->class_name;?></td>
                              <td><?php echo $dt->subject_name;?> </td>
                              <td><?php echo $dt->section_name;?></td>
                              <td><?php echo $dt->student_name;?></td>
                              <td><?php echo $dt->examdate;?></td>
                              <td><?php echo $dt->reschedule_date;?></td>
                              <td><?php echo $dt->comment;?></td>

                            </tr>
                        <?php }  } ?>
                        
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS-->
            <div class="tab-pane box" id="cancellist">
				
                <table class="table table-bordered datatable">
                	<thead>
                		<tr>
                            <th><div><?php echo get_phrase('s_no');?></div></th>
                            
                            <th><div><?php echo get_phrase('exam_name');?></div></th>
                            <th><div><?php echo get_phrase('class');?></div></th>
                            <th><div><?php echo get_phrase('subject');?></div></th>
                            <th><div><?php echo get_phrase('section');?></div></th>
                            <th><div><?php echo get_phrase('student');?></div></th>
                            <th><div><?php echo get_phrase('original_date');?></div></th>
                            <th><div><?php echo get_phrase('cancel_date');?></div></th>
                            <th><div><?php echo get_phrase('reason');?></div></th>
                        </tr>
					</thead>
                    <tbody>
                        <?php if($exam_cancel_data != ""){
                    	   $i = 1; 
                    	  foreach($exam_cancel_data as $dt) {
                    	?>
                       <tr>
                              <td><?=$i++;?></td>
                             
                              <td><?php echo @$dt->exam_name; ?></td>
                              <td><?php echo  $dt->class_name;?></td>
                              <td><?php echo $dt->subject_name;?> </td>
                              <td><?php echo $dt->section_name;?></td>
                              <td><?php echo $dt->student_name;?></td>
                              <td><?php echo $dt->examdate;?></td>
                              <td><?php echo date('Y-m-d',strtotime($dt->defult_date));?></td>
                              <td><?php echo $dt->comment;?></td>

                            </tr>
                        <?php }  } ?>
                        
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