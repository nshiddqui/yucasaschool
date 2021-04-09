<?php $activeTab = "scholarship_dashboard"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Scholarship</a></li>
        <li class="active">Exam Schedule</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/student/scholarship_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>


<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered hidden">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('scholarship_exam_list');?>
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