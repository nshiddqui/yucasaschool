<style>
    #table-data::parent {
        overflow:scroll;
    }
</style>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('class_report');?>
            	</div>
            </div>
            <div class="filter_form">
<?php echo form_open(''); ?>
<div class="row">
	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class');?></label>
			<select name="class_id" class="form-control selectboxit" onchange="select_section(this.value)" id = "class_selection">
				<option value=""><?php echo get_phrase('all');?></option>
				<?php
					$classes = $this->db->get('class')->result_array();
					$class_id = isset($_POST['class_id'])?$_POST['class_id']:'';
					foreach($classes as $row):
                                            
				?>
                                
				<option value="<?php echo $row['class_id'];?>" <?= $class_id == $row['class_id']?'selected':'' ?>><?php echo $row['name'];?></option>
                                
				<?php endforeach;?>
			</select>
		</div>
	</div>

	
    <div id="section_holder">
	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section');?></label>
			<select class="form-control selectboxit" name="section_id">
                            <option value=""><?php echo get_phrase('select_class_first') ?></option>
                            <?php
                            if(!empty($classes)){
                              	$sections = $this->db->get_where('section' , array('class_id' => $class_id))->result_array();
                              	$section_id = isset($_POST['section_id'])?$_POST['section_id']:'';
                              	foreach($sections as $row2): ?>
                                 <option value="<?php echo $row2['section_id'];?>" <?= $section_id == $row2['section_id']?'selected':'' ?>><?php echo $row2['name'];?></option>
                              <?php endforeach;
                            }  
                            ?>
				
			</select>
		</div>
	</div>
    </div>
    <div class="col-md-2">
	    <div class="form-group">
	        <label class="control-label" style="margin-bottom: 5px;">&nbsp;</label>
		    <button type="submit" id = "submit" class="btn btn-info btn-block"><?php echo get_phrase('filter_data');?></button>
		</div>
	</div>

</div>
<?php echo form_close();?>
</div>   
<?php if(isset($report_data)) { ?>
            <div class="panel-body table-responsive">
                <table id="table-data" class="table datatable table-bordered">
                            
                            <thead>
                                <tr>
                                    <th>Class Name</th>
                                 
                                    <th>Section Name</th>
                                    <th>CLass Teacher</th>
                                    <th>Total Student</th>                       
                                    <th>Total Male</th>
                                    <th>Total Female</th>
                                    <th>Total Collection</th>
                                    <th>Overall Attendance</th>
                                </tr>
                            </thead>
                            <tbody>   
                                <?php
                                 
                      foreach ($report_data as $val){
                          if(isset($val['section']) && !empty($val['section'])){
                              foreach ($val['section'] as $sections){
                              ?>
                              <tr>
                                        <td><?= $val['name']?></td>
                                        <td><?= $sections['name'] ?></td>
                                        <td><?= $sections['class_teacher'] ?></td>
                                        <td><?= $sections['total_student'] ?></td>
                                        <td><?= $sections['total_male_student'] ?></td>
                                        <td><?= $sections['total_female_student'] ?></td>
                                        <td><?= $sections['total_collection_fee_amount'] ?></td>
                                        <td><?= $sections['attandance_percentage'] ?> %</td>
                                                                                  
                                    </tr>
                              <?php
                              }
                          } else {
                                 ?>
                                                                     
                                    <tr>
                                        <td><?= $val['name']?></td>
                                        <td>No Section Added</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                                                                  
                                    </tr>
                               <?php }
                               }
                               ?>
                            </tbody>
                        </table>
                </div>
<?php } ?>
            </div>
    </div>
</div>

<script>
    function select_section(class_id) {
    	if(class_id !== ''){
    		$.ajax({
    			url: '<?php echo site_url('admin/get_section/'); ?>' + class_id,
    			success:function (response)
    			{
    
    			jQuery('#section_holder').html(response);
    			}
    		});
    	}
    }
</script>
