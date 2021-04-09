<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_new_section');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(site_url('admin/sections/create/') , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('nick_name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="nick_name" value="" >
						</div> 
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                        
						<div class="col-sm-5">
							<select name="class_id" class="form-control" required>
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
									$classes = $this->db->get('class')->result_array();
									foreach($classes as $row):
										?>
                                		<option value="<?php echo $row['class_id'];?>">
												<?php echo $row['name'];?>
                                                </option>
                                    <?php
									endforeach;
								?>
                          </select>
						</div> 
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('teacher');?></label>
                        <div class="col-sm-5">
							<select name="teacher_id" class="form-control" required>
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
									$teachers = $this->db->get('teacher')->result_array();
									$teacherval = "";
									foreach($teachers as $row):
										$teacherval = $this->db->get_where('section',array('teacher_id'=>$row['teacher_id']))->row()->teacher_id;
								    ?>
                                		<option value="<?php echo $row['teacher_id'];?>" <?php if($teacherval != ""){ echo "disabled";} ?> >
										    <?php echo $row['name'];?>
                                        </option>
                                    <?php
									endforeach;
								?>
                          </select>
						</div> 
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('perifix_code');?></label>
                        <div class="col-sm-5">
							<div class="input-group">
							  <div class="input-group-addon"><?php echo $this->db->get_where('settings',array('type'=>'perifix_code'))->row()->description;?></div>
							  <input type="text" class="form-control" name="perifix_code" value="<?php echo $row['perifix_code'];?>">
							</div>
						</div> 
					</div>

					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('add_section');?></button>
						</div>
					</div>

                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>