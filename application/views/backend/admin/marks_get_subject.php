<div class="col-md-2">
	<div class="form-group">
	<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section');?></label>
		<select name="section_id" id="section_id" class="form-control selectboxit" onchange="get_class_subject(<?php echo $class_id;?>)">
			<option value=""><?php echo get_phrase('select_section');?></option>
		<?php 
		    $sections = $this->db->get_where('section' , array('class_id' => $class_id))->result_array();
			foreach($sections as $row):
			?>
			<option value="<?php echo $row['section_id'];?>" <?php if($section_id == $row['section_id']){echo 'selected';}?> ><?php echo $row['name'];?></option>
		<?php endforeach;?>
		</select>
	</div>
</div>

<div class="col-md-3">
	<div class="form-group">
	<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('subject');?></label>
		<select name="subject_id" id="subject_id" class="form-control selectboxit">
			<?php 
			  if($section_id != ""){
				//$subjects = $this->db->get_where('subject' , array('class_id' => $class_id ,'section_id'=>$section_id, 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description))->result_array();
				$runing_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
			  	$subjects = $this->db->query("select * from subject where FIND_IN_SET($class_id,class_id) AND year = '".$runing_year."'")->result_array();
				foreach($subjects as $row):
			?>
			<option value="<?php echo $row['subject_id'];?>" <?= $row['subject_id'] == $subject_id ?'selected' : '' ?>><?php echo $row['name'];?></option>
			<?php endforeach; }?>
		</select>
	</div>
</div>

<div class="col-md-2" style="margin-top: 20px;">
	<center>
		<button type="submit" class="btn btn-info"><?php echo get_phrase('manage_marks');?></button>
	</center>
</div>


<script type="text/javascript">
	$(document).ready(function() {
        if($.isFunction($.fn.selectBoxIt))
		{
			$("select.selectboxit").each(function(i, el)
			{
				var $this = $(el),
					opts = {
						showFirstOption: attrDefault($this, 'first-option', true),
						'native': attrDefault($this, 'native', false),
						defaultText: attrDefault($this, 'text', ''),
					};
					
				$this.addClass('visible');
				$this.selectBoxIt(opts);
			});
		}
    });
	
</script>