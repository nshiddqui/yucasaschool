<?php $activeTab = "exam_schedule"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Exam</a></li>
        <li class="active">Exam Schedule</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/parent/exam_nav_tab.php'; ?>
<!-- Including Navigation Tab -->
</div>
<div class="row">
	<div class="col-md-12">
    
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
                            <th><div><?php echo get_phrase('answer_script');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    <?php 	if($exam_data!= ""){
                     $i = 1;
                     foreach ($exam_data as $key => $dt) {
                    	$reexam          = @$this->db->get_where('re_exam',array('exam'=>$dt->id))->row()->re_exam_id;
                        $re_exam_cancel  = @$this->db->get_where('re_exam_cancel',array('exam'=>$dt->id))->row()->cancel_exam_id;
                     ?>
                        <tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $dt->exam_date;  
                            $status_exam = "";
                                 if($reexam !="" && $re_exam_cancel == 0) 
                                    $status_exam = "rescheduled";
                                 elseif($re_exam_cancel != "") 
                                    $status_exam = "canceled";

                                 ?>
                                 <?php if($status_exam != ""){ ?> 
                                 <span class="<?php echo $status_exam;?>">
                                       <?php echo $status_exam;?>
                                 </span> 
                                 <?php } ?>                  
                            </td>
                            <td><?php echo $dt->start_time;?> - <?php echo $dt->end_time;?></td>
							<td><?php echo $dt->exam_name;?></td>
							<td><?php echo $dt->room_no;?></td>
							<td><?php echo $dt->subject_name;?></td>
							<td><?php echo $dt->class_name;?></td>
                            <td><a href="<?php echo base_url();?>uploads/exam_answer_sheet/<?php echo $dt->answer_sheet_file;?>" class="btn btn-blue btn-icon icon-left" download>
                                <i class="entypo-download"></i>
                                Download </a></td>
							
                        </tr>
                    <?php } } ?>
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
		

		// var datatable = $("#table_export").dataTable();
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script>