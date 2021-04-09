<?php $activeTab = "daily_attendance"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Student</a></li>
        <li class="active">Attendance Report</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
</div>


<div class="filter_form">
    <?php echo form_open(site_url('admin/attendance_report_view/')); ?>
    <div class="row">
    
        <?php
        $query = $this->db->get('class');
        if ($query->num_rows() > 0):
            $class = $query->result_array();
    
            ?>
    
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class'); ?></label>
                    <select class="form-control selectboxit" name="class_id" onchange="select_section(this.value)">
                        <option value=""><?php echo get_phrase('select_class'); ?></option>
                        <?php foreach ($class as $row): ?>
                        <option value="<?php echo $row['class_id']; ?>" ><?php echo $row['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        <?php endif; ?>
    
        <div id="section_holder">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section'); ?></label>
                    <select class="form-control selectboxit" name="section_id">
                        <option value=""><?php echo get_phrase('select_class_first') ?></option>
    
                    </select>
                </div>
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
        <input type="hidden" name="year" value="<?php echo $running_year;?>">
    
    	<div class="col-md-2">
    	    <div class="form-group">
    	        <button type="submit" class="btn btn-info btn-block"><?php echo get_phrase('show_report');?></button>
    		</div>
    	</div>
    </div>
    
    <?php echo form_close(); ?>
</div>

<script type="text/javascript">
    function select_section(class_id) {

        $.ajax({
            url: '<?php echo site_url('admin/get_section/'); ?>' + class_id,
            success: function (response)
            {

                jQuery('#section_holder').html(response);
            }
        });
    }
    
    function sectio_id(){
        
    }
</script>
