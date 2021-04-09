
<?php 
	$class_routine_data = $this->db->get_where('class_routine',array('class_routine_id'=> $param2))->row();
	$class_id   = $class_routine_data->class_id;
	$section_id = $class_routine_data->section_id;
?>
    <?php echo form_open(site_url('admin/edit_class_routine_data/') , array('class' => 'form-horizontal form-groups validate tt_table_form','target'=>'_top','id'=>'formTimeTable'));?>
        <div class="form-group">
                <label class="col-sm-3 control-label">Is Temporary?</label>
                <div class="col-sm-5">
                   <select name="is_temporary" id="is_temporary" class="form-control" style="width:100%;" required>
                      <option value="yes">Yes</option>
                    </select>
                    <input type="hidden" name="editId" value="<?php echo  $class_routine_data->class_routine_id;?>">
                </div>
            </div>

            <div class="form-group ">
                <label class="col-sm-3 control-label">Date</label>
                <div class="col-sm-5">
                 <input type="text" id="tt_datepicker" class="form-control datepicker" value="<?php echo $class_routine_data->tem_date;?>" name="tem_date" placeholder="Select Holder" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('Type');?></label>
                <div class="col-sm-5">
                    <select name="type" id="type" class="form-control" style="width:100%;" required>
                     <?php if($class_routine_data->e_type == 'event'){ ?>	
                      <option value="event">Event</option>
                     <?php }else{ ?>
  					  <option value="timetable">Timetable</option>
                    <?php  } ?>
                    </select>
                </div>
            </div>
        <?php   if($class_routine_data->subject_id != 0){ echo $class_routine_data->subject_id;?>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('Subject');?></label>
                <div class="col-sm-5">
                    <select name="subject_id" class="form-control" style="width:100%;" id="subject_val_edit" onchange="get_subjectid_by_teacher_(this.value)" required>
                    <?php $subjectdata =  $this->db->get_where('subject',array('class_id' => $class_id,'section_id' => $section_id))->result();
                    	foreach ($subjectdata as $dt) { ?>
                    		<option value="<?php echo $dt->subject_id;?>" <?php if($dt->subject_id == $class_routine_data->subject_id){ echo 'selected';} ?> ><?php echo $dt->name;?></option>
                    <?php 	} ?>
                    </select>
                </div>
            </div>

            <div class="form-group ">
                <label class="col-sm-3 control-label"><?php echo get_phrase('Teacher');?></label>
                <div class="col-sm-5">
                    <select name="teacher" class="form-control" style="width:100%;" id="teacher_details_" required> 
                        <!-- <option value="timetable">Mr. Alok Tiwari</option>
                        <option value="event">Mrs. Prerna Arora</option> -->
                    </select>
                </div>
            </div>
         <?php  } ?>

            <div class="form-group type-e">
                <label class="col-sm-3 control-label"><?php echo get_phrase('event_type');?></label>
                <div class="col-sm-5">
                    <input type="text" id="event_type" class="form-control" name="event_type" value="<?php echo $class_routine_data->event_type;?>" required>
                </div>
            </div>


            <div id="section_subject_selection_holder"></div>

            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('day');?></label>
                <div class="col-sm-5">
                    <select id="tt_day" name="day" class="form-control selectboxit" style="width:100%;" required>
                        <option value="sunday" <?php if($class_routine_data->day == 'sunday'){echo 'selected';} ?>   >sunday</option>
                        <option value="monday" <?php if($class_routine_data->day == 'monday'){echo 'selected';} ?>   >monday</option>
                        <option value="tuesday" <?php if($class_routine_data->day == 'tuesday'){echo 'selected';} ?> >tuesday</option>
                        <option value="wednesday"<?php if($class_routine_data->day == 'wednesday'){echo 'selected';}?> >wednesday</option>
                        <option value="thursday" <?php if($class_routine_data->day == 'thursday'){echo 'selected';} ?> >thursday</option>
                        <option value="friday" <?php if($class_routine_data->day == 'friday'){echo 'selected';} ?> >friday</option>
                        <option value="saturday" <?php if($class_routine_data->day == 'saturday'){echo 'selected';} ?> >saturday</option>
                    </select>
                </div>
            </div>



            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('starting_time');?></label>
                <div class="col-sm-9">
                    <div class="col-md-3 p0">
                        <select name="time_start" id= "starting_hour" class="form-control selectboxit" required>
                            <option value=""><?php echo get_phrase('hour');?></option>
                            <?php for($i = 0; $i <= 12 ; $i++):?>
                                <option value="<?php echo $i;?>"  <?php if($class_routine_data->time_start == $i){ echo 'selected';}?>><?php echo $i;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="time_start_min" id= "starting_minute" class="form-control selectboxit" required>
                            <option value=""><?php echo get_phrase('minutes');?></option>
                            <?php for($i = 0; $i <= 11 ; $i++):?>
                                <option value="<?php echo $i * 5;?>" <?php if($class_routine_data->time_start_min == $i * 5){ echo 'selected';}?> ><?php echo $i * 5;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="starting_ampm" class="form-control selectboxit" required>
                            <option value="1">am</option>
                            <option value="2">pm</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('ending_time');?></label>
                <div class="col-sm-9">
                    <div class="col-md-3 p0">
                        <select name="time_end" id= "ending_hour" class="form-control selectboxit" required>
                            <option value=""><?php echo get_phrase('hour');?></option>
                            <?php for($i = 0; $i <= 12 ; $i++):?>
                                <option value="<?php echo $i;?>" <?php if($class_routine_data->time_end == $i){ echo 'selected';}?> ><?php echo $i;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="time_end_min" id= "ending_minute" class="form-control selectboxit" required>
                            <option value=""><?php echo get_phrase('minutes');?></option>  
                            <?php for($i = 0; $i <= 11 ; $i++):?>
                                <option value="<?php echo $i * 5;?>" <?php if($class_routine_data->time_end_min == $i * 5){ echo 'selected';}?> ><?php echo $i * 5;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="ending_ampm" class="form-control selectboxit" required>
                            <option value="1">am</option>
                            <option value="2">pm</option>
                        </select>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('note');?></label>
                <div class="col-sm-5">
                   <textarea type="text" class="form-control" name="note"><?php echo $class_routine_data->event_note;?></textarea>
                </div>
            </div>


            <div class="hidden">
                <input type="text" class="" id="period" name="period" value="<?php echo $class_routine_data->period;?>">
            </div>
            

        <div class="form-group">
              <div class="col-sm-offset-3 col-sm-5">
                <input type="hidden" name="class_id" value="<?php echo $class_id;?>" id="classid_edit">
                <input type="hidden" name="section_id" value="<?php echo $section_id;?>" id="sectionid_edit">
                <button type="submit" id= "add_class_routine" class="btn btn-info"><?php echo get_phrase('save_class_routine');?></button>
              </div>
            </div>
    <?php echo form_close();?>

    <script type="text/javascript">
    	$(document).ready(function(){
    	 	var class_id   = $('#classid_edit').val();
            var section_id = $('#sectionid_edit').val();
            subject_id = "<?php echo $class_routine_data->subject_id;?>";    
            if(subject_id != 0){
        	 get_subjectid_by_teacher_(subject_id);

            }
        });

    	function get_subjectid_by_teacher_(value){
		      $.ajax({       
		      type   : "POST",
		      url    : "<?php echo site_url('ajax/get_subjectid_by_teacher'); ?>",
		      data   : {'subject_id' : value},               
		      success: function(response){  
		        console.log(response);                                                 
		        $('#teacher_details_').html(response);
		       		if(subject_id != 0){
		       		  $('#teacher_details_').val(subject_id);	
		        	}
		       }
    	    });
          }
    </script>