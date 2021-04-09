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
            <select name="class_id" class="form-control selectboxit" onchange="select_section(this.value)" id = "class_selection">
                <option value=""><?php echo get_phrase('Select Designation');?></option>
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
    
  
        <div class="col-md-2">
             <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('month'); ?></label>
                <select name="month" class="form-control selectboxit">
                    <?php
                    for ($i = 1; $i <= 12; $i++):
                        if ($i == 1)
                            $m = 'january';
                        else if ($i == 2)
                            $m = 'february';
                        else if ($i == 3)
                            $m = 'march';
                        else if ($i == 4)
                            $m = 'april';
                        else if ($i == 5)
                            $m = 'may';
                        else if ($i == 6)
                            $m = 'june';
                        else if ($i == 7)
                            $m = 'july';
                        else if ($i == 8)
                            $m = 'august';
                        else if ($i == 9)
                            $m = 'september';
                        else if ($i == 10)
                            $m = 'october';
                        else if ($i == 11)
                            $m = 'november';
                        else if ($i == 12)
                            $m = 'december';
                        ?>
                        <option value="<?php echo $i; ?>"
                              <?php if($month == $i) echo 'selected'; ?>  >
                                    <?php echo get_phrase($m); ?>
                        </option>
                        <?php
                    endfor;
                    ?>
                </select>
             </div>
        </div>
    
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('sessional_year'); ?></label>
                <select class="form-control selectboxit" name="sessional_year">
                    <?php
                    $sessional_year_options = explode('-', $running_year); ?>
                    <option value="<?php echo $sessional_year_options[0]; ?>"><?php echo $sessional_year_options[0]; ?></option>
                    <option value="<?php echo $sessional_year_options[1]; ?>"><?php echo $sessional_year_options[1]; ?></option>
                </select>
            </div>
        </div>
    
        <input type="hidden" name="operation" value="selection">
        <input type="hidden" name="year" value="<?php echo $running_year;?>">
    
    	<div class="col-md-2">
    	    <div class="form-group">
    	        <label class="control-label" style="margin-bottom: 5px;">Option</label>
    		    <button type="submit" class="btn btn-info btn-block"><?php echo get_phrase('show_report');?></button>
    		</div>
    	</div>
    </div>
    
    <?php echo form_close(); ?>
</div>


