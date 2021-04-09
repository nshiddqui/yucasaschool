<?php $activeTab = "daily_employee_attendance"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Employee</a></li>
        <li class="active">Attendance Report</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/student_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>


<div class="filter_form">
    <?php echo form_open(site_url('admin/attendance_report_employee_selector/')); ?>
    <div class="row">
    
    <div class="col-md-3">
        <div class="form-group">
        <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('Designation');?></label>
            <select name="class_id" class="form-control selectboxit" id = "class_selection">
                <option value=""><?php echo get_phrase('Select Designation');?></option>
                <option value="all" <?= ('all'==$class_id?'selected':'') ?>>All</option>
                <?php
                    $designations = $this->db->get('designations')->result_array();
                    foreach($designations as $row):
                                            
                ?>
                                
                <option value="<?php echo $row['id'];?>"
                    ><?php echo $row['name'];?></option>
                                
                <?php endforeach;?>
            </select>
        </div>
    </div>
        <div class="col-md-3">
            <div class="form-group">
        		<label class="control-label" style="margin-bottom: 5px;">From</label>
        			<input type="text" class="form-control datepicker" name="from" data-format="dd-mm-yyyy" value="">
    		</div>
    	</div>
    	<div class="col-md-3">
    		<div class="form-group">
    		<label class="control-label" style="margin-bottom: 5px;">To</label>
    			<input type="text" class="form-control datepicker" name="to" data-format="dd-mm-yyyy" value="">
    		</div>
    	</div>
        <input type="hidden" name="operation" value="selection">
        <input type="hidden" name="sessional_year" value="<?php echo $running_year;?>">
    
    	<div class="col-md-2">
    	    <div class="form-group">
    	        <label class="control-label" style="margin-bottom: 5px;">Option</label>
    		    <button type="submit" class="btn btn-info btn-block"><?php echo get_phrase('show_report');?></button>
    		</div>
    	</div>
    </div>
    
    <?php echo form_close(); ?>
</div>


