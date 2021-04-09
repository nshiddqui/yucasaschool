<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_substitute_teacher');?>
                </div>
            </div>
            <div class="panel-body">
                
                <?php echo form_open(site_url('admin/substitute/create/') , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
    
                
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                        
                         <div class="col-sm-5">
                            <select name="class_id" class="form-control" required onchange = "get_class_sections(this.value);">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
                                    $classes = $this->db->get('class')->result_array();
                                    foreach($classes as $row):
                                        ?>
                                        <option value="<?php echo $row['class_id'];?>" >
                                                <?php echo $row['name'];?>
                                                </option>
                                    <?php
                                    endforeach;
                                ?>
                          </select>
                        </div>  
                    </div>



                    <div class="form-group">
                     <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Section');?></label>
                        <div class="col-sm-5">
                            <select name="sectionval" id ="section_id" class="form-control" required>
                              <option value=""><?php echo get_phrase('select');?></option>
                        </select>
                        </div> 
                    </div>

                    <div class="form-group">
                     <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Subject');?></label>
                     <div class="col-sm-5">
                       <select name="teacher_id" class="form-control" id="teacher_id" onchange="get_subject(this.value)"  required>
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
                                    $teachers = $this->db->get('teacher')->result_array();
                                    foreach($teachers as $row):
                                        ?>
                                        <option value="<?php echo $row['teacher_id'];?>">
                                            <?php echo $row['name'];?>
                                        </option>
                                    <?php
                                    endforeach;
                                ?>
                          </select>
                      </div>
                    </div>
                    <div class="form-group">
                     <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('subject');?></label>
                       <div class="col-sm-5">
                            <select name="subject_id" class="form-control" id="subject_id" required>
                              <option value=""><?php echo get_phrase('select');?></option>
                              
                          </select>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Select Date</label>
                        <div class="col-sm-5">
                            <input class="datepicker form-control" name="date" data-validate="required" data-message-required="Value Required" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('add_substitute_teacher');?></button>
                        </div>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
<script>
   function get_class_sections(class_id) {
          $.ajax({
            url: '<?php echo site_url('ajax/get_class_by_section/');?>',
            data: {'class_id':class_id},
            type   : "POST",
            success: function(response)
            {   
              //alert(response);
              jQuery('#section_id').empty().append(response);
              get_student();
            }
         });
      
      }

      function get_subject(val){
         $.ajax({
            url: '<?php echo site_url('ajax/get_subject_by_teacher/');?>',
            data: {'teacher_id':val},
            type   : "POST",
            success: function(response)
            {   
              //alert(response);
              jQuery('#subject_id').empty().append(response);
              get_student();
            }
         });
      }

</script>