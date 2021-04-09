<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_librarian');?>
            	</div>
            </div>

			<div class="panel-body">
				
                <?php echo form_open(site_url('admin/librarian/create') , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"  autofocus
                            	value="">
						</div>
					</div>
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="email" value="" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('password');?></label>
                        
						<div class="col-sm-5">
							<input type="password" class="form-control" name="password" value="" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
						</div>
					</div>
					
					     <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Salary Type </label>

						<div class="col-sm-5">
							<select name="salary_type" class="form-control selectboxit">
                              <option value="">Select</option>
                              <option value="monthly">Monthly</option>
                              <option value="hourly">Hourly</option>							
                          </select>
						</div>
					</div>
					
					
                    	<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Salary Grade </label>

						<div class="col-sm-5">
							<select name="salary_grade_id" class="form-control selectboxit">
                              <option value="">Select</option>
                             <?php
                $children_of_parent = $this->db->get_where('salary_grades' , array(
                    'status' =>1
                ))->result_array();

                foreach ($children_of_parent as $row):
            ?>
                              <option value="<?php echo $row['id'];?>"><?php echo $row['grade_name'];?></option>
							    <?php endforeach;?>  
                          </select>
						</div>
					</div>
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('submit');?></button>
						</div>
					</div>

                <?php echo form_close();?>

            </div>
        </div>
    </div>
</div>