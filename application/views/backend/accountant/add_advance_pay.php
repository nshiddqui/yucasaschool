<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_advance_pay');?>
            	</div>
            </div>

			<div class="panel-body">
				
                <?php echo form_open(site_url('admin/advance_add_pay') , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('designation');?></label>
                        
					<div class="col-sm-5">
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

					  <div id="section_holder" style= "display:none;">
 <!--        <select class="selectboxit" id="section_id" name="section_id" style= "display:none;">
         <option value=""><?php echo get_phrase('select_class_first') ?></option>
                
            </select> -->
       </div>
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('employee_name');?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="email" value="" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
						</div>
					</div>

					<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('date');?></label>
			<input type="text" class="form-control datepicker" name="timestamp" data-format="dd-mm-yyyy"
				value="<?php echo date("d-m-Y");?>"/>
		</div>
					
				
								
					
             
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="submit" class="btn btn-info"><?php echo get_phrase('submit');?></button>
						</div>
					</div>

                <?php echo form_close();?>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

// $('.submit').click(function() {
//   $.ajax({
//    alert( "Advance Payment Added Successfully" );
// });
	

 function select_section(class_id) {
    if(class_id !== ''){
        $.ajax({
            url: '<?php echo site_url('admin/get_employee/'); ?>' + class_id,
            success:function (response)
            {

            jQuery('#section_holder').html(response);
            $('#section_holder').attr("style", "display:block;");
            $('#section_id').attr("style", "display:block;");


            $('#section_idSelectBoxItContainer').attr("style","width:204px;");
           $('.control-label').attr("style", "display:none;");
            
            }
        });
    }
}

</script>