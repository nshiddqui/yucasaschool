<?php $activeTab = "exam_schedule"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Exam</a></li>
        <li class="active">Exam Schedule List</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
</div>

<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered hidden">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('exam_schedule_list');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>
		<div class="tab-content">            
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
				
                <table class="table table-bordered datatable" >
                	<thead>
                		<tr>
                			<th><div><?php echo get_phrase('s_no');?></div></th>
                    		<th><div><?php echo get_phrase('examination_date_&_day');?></div></th>
                    		<th><div><?php echo get_phrase('examination_time');?></div></th>
                    		<th><div><?php echo get_phrase('exam_name');?></div></th>
                    		<th><div><?php echo get_phrase('room_no');?></div></th>
                    		<th><div><?php echo get_phrase('subject');?></div></th>
                    		<th><div><?php echo get_phrase('class');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    <?php 	if($exam_data!= ""){
                    	$i = 1;
                      foreach ($exam_data as $key => $dt) {
                    	$exam_details = $this->db->get_where('exam',array('exam_id'=>$dt->exam_id))->row();
                    	$exam_subject= $this->db->get_where('subject',array('subject_id'=>$dt->subject_id))->row()->name;
                    	$exam_class= $this->db->get_where('class',array('class_id'=>$dt->class_id))->row()->name;
                     ?>
                        <tr>
							<td><?php echo $i++;?></td>
							<td><?php if($exam_details->date != ""){echo $exam_details->date; } ?></td>
                            <td><?php echo $dt->start_time;?> - <?php echo $dt->end_time;?></td>
							<td><?php echo $exam_details->name;?></td>
							<td><?php echo $dt->room_no;?></td>
							<td><?php echo $exam_subject;?></td>
							<td><?php echo $exam_class;?></td>
                        </tr>
                    <?php } } ?>
                   </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS-->
		</div>
	</div>
</div>
</div>

<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		// var datatable = $("#table_export").dataTable();
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script>