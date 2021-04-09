<?php 
$name = "";$class_id="";$teacher_id="";$date ="";
$submit_value = "create";
if($param2 !=""){
   $sections = $this->db->get_where('section' , array( 'section_id' => $param2))->row();
   $name     =  $sections->name;

   //$name     =  $sections->name;
   $class_id =  $sections->class_id;
   $teacher_id=  $sections->teacher_id;
   $date     =  $sections->date;
   $submit_value = "edit";
}

?>
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
                
                <?php echo form_open(site_url('admin/sections/'.$submit_value.'/') , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
    
                
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                        
                        <div class="col-sm-5">
                          <select name="class_id" class="form-control" required onchange = "get_class_sections(this.value);">
                            <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
                                $classes = $this->db->get('class')->result_array();
                                foreach($classes as $row):
                              ?>
                                <option value="<?php echo $row['class_id'];?>" <?=$class_id == $row['class_id']?'selected':"";?>>
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
                            <select name="name" class="form-control" required id ="section_id_sub">
                              <option value=""><?php echo get_phrase('select');?></option>
                                <?php if($param2 != ""){ 
                               
                                    $section = $this->db->get('section',array('class_id'=>$class_id))->result_array();
                                    foreach($section as $row):
                                        ?>
                                        <option value="<?php echo $row['name'];?>" <?=$name == $row['name']?'selected':"";?>>
                                        <?php echo $row['name'];?>
                                        </option>
                                    <?php
                                    endforeach;
                               
                                    } ?> 
                          </select>
                        </div> 
                    </div>


                    

                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('teacher');?></label>
                        
                        <div class="col-sm-5">
                            <select name="teacher_id" class="form-control selectboxit"  required>
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
                                    $teachers = $this->db->get('teacher')->result_array();
                                    foreach($teachers as $row):
                                      $teacherval = $this->db->get_where('section',array('teacher_id'=>$row['teacher_id']))->row()->teacher_id;
                                        ?>
                                        <option value="<?php echo $row['teacher_id'];?>" <?php if($teacherval != ""){ echo "disabled";} ?> <?=$teacher_id == $row['teacher_id']?'selected':"";?>>
                                                <?php echo $row['name'];?>
                                                </option>
                                    <?php
                                    endforeach;
                                ?>
                          </select>
                        </div> 
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Select Date</label>
                        <div class="col-sm-5">
                            <input class="datepicker form-control" name="date" data-validate="required" data-message-required="Value Required" type="text" value="<?=$date;?>">
                             <input class="datepicker form-control" name="sub_teacher" value= "sub_teacher" data-validate="required" data-message-required="Value Required" type="hidden">
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
            url: '<?php echo site_url('ajax/get_class_by_section_name/');?>',
            data: {'class_id':class_id},
            type   : "POST",
            success: function(response)
            {   
              //alert(response);
              jQuery('#section_id_sub').empty().append(response);
            //  get_student();
            }
         });
       // get_exam();
      }
</script>