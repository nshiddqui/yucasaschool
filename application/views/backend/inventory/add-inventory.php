<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-body">

                <form action="<?php echo base_url();?>inventory/add_inventory" class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate">
					<div class="form-group" id="type_name">
						<label for="field-2" class="col-sm-3 control-label">Inventory Type </label>

						<div class="col-sm-5">
							<select name="inven_id" class="form-control" required>
                                            <option value="">--select--</option>
                                            <?php  
                                            foreach ($inventory_type as $field)
                                            {
                                                    echo "<option value='{$field->id}'>{$field->name}</option>";
                                            }
                                            ?>
                                        </select>
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Quantity</label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="quantity" required>
						</div>
					</div>
					
					
    <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>
            <div class="col-sm-5">
                <select name="class_id" class="form-control" onchange="select_section(this.value)"  id = "class_selection" required>
                    <option value=""><?php echo get_phrase('select_class'); ?></option>
                    <?php
                    $classes = $this->db->get('class')->result_array();
                    foreach ($classes as $row):
                        ?>
                      <option value="<?php echo $row['class_id']; ?>" <?php if($row['class_id'] == $class_id){echo 'selected';} ?>><?php echo $row['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3" style="margin-bottom: 5px;"><?php echo get_phrase('section'); ?></label>
            <div class="col-sm-5">
                <select name="section_ids" id="section_holder" class=" form-control" required>
                    <option value=""><?php echo get_phrase('select_section'); ?></option>
                    <?php
                    $sections = $this->db->get_where('section', array(
                                'class_id' => $class_id
                            ))->result_array();
                    foreach ($sections as $row):
                        ?>
                        <option <?php if($row['section_id'] == $section_id){echo 'selected';} ?> value="<?php echo $row['section_id']; ?>"
                              >
                                <?php echo $row['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

                <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('designation');?></label>
                        
					<div class="col-sm-5">
					<select  name="designation_id"  class="selectboxit" onchange="select_designation(this.value)" id = "designation_id">
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
                    <div class="form-group">
					    
						<label for="field-1" class="col-sm-3 control-label">Select Employee</label>
						<div class="col-sm-5">
					  <div id="employee_holder" style= "">
                            <select class="selectboxit" id="employee_id" name="section_id">
                                    <option value=""><?php echo get_phrase('select_designation_first') ?></option>
                                
                            </select>
                    </div>
                    </div>
                    </div>



  

                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info">Add</button>
						</div>
					</div>
                </form>            </div>
        </div>
    </div>
    <script>
    function select_section(class_id) {
    if (class_id !== '') {
    c_id = class_id;
    $.ajax({
        method:'POST',
        url: '<?php echo base_url();?>ajax/get_class_by_section/',
        data:{
            'class_id':class_id
        },
        success:function (response)
        {
            jQuery('#section_holder').html(response);
        }
    });
    }
}


function get_subjectid_by_teacher(value){
      $.ajax({       
      type   : "POST",
      url    : "<?php echo base_url();?>inventory/get_inventory",
      data   : {'subject_id' : value},               
      // async  : false,
      success: function(response){  
        console.log(response);                                                 
        $('#inv_name').append(response);
       }
     });
   }



function reload_url() {
    class_selection = $('#class_selection').val();
    section_id = $('#section_id').val();
    template_id = $('#template_id').val();
    if(class_selection != "" && section_id != ""){
      window.location.href = "<?php echo base_url();?>admin/class_timetable/"+class_selection+"/" + section_id+"/"+template_id;
    }
}
 function select_designation(class_id) {
    if(class_id !== ''){
        $.ajax({
            url: '<?php echo site_url('admin/get_employee/'); ?>' + class_id,
            success:function (response)
            {

            jQuery('#employee_holder').html(response);
            }
        });
    } else {
        $('#employee_holder').html('<option value="">Select Designation First</option>');
    }
}
    </script>