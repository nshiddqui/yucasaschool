<?php $activeTab = "exam"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Exam</a></li>
        <li class="active">Marks</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/examination_results_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<?php echo form_open(site_url('admin/marks_selector'));?>
<div class="row">

	<div class="col-md-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('exam');?></label>
			<select name="exam_id" class="form-control selectboxit" required>
				<option value=""><?php echo get_phrase('select_exam');?></option>
				<?php
					$exams = $this->db->get_where('exam' , array('year' => $running_year))->result_array();
					foreach($exams as $row):
				?>
				<option value="<?php echo $row['exam_id'];?>"><?php echo $row['name'];?></option>
				<?php endforeach;?>
			</select>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class');?></label>
			<select name="class_id" class="form-control selectboxit" onchange="get_class_subject(this.value)">
				<option value=""><?php echo get_phrase('select_class');?></option>
				<?php
					$classes = $this->db->get('class')->result_array();
					foreach($classes as $row):
				?>
				<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
				<?php endforeach;?>
			</select>
		</div>
	</div>

	<div id="subject_holder"></div>

</div>
</div>
<?php echo form_close();?>




<script type="text/javascript">
	function get_class_subject(class_id) {
		
		$.ajax({
            url: '<?php echo site_url('admin/marks_get_subject/');?>' + class_id ,
            success: function(response)
            {
                jQuery('#subject_holder').html(response);
            }
        });

	}
</script>