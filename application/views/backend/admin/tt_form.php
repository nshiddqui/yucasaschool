        <h5 id="msg" style="text-align: center;color:red;"></h5>
<?php echo form_open(site_url('') , array('class' => 'form-horizontal form-groups validate tt_table_form','target'=>'_top','id'=>'formTimeTable'));?>
            <!-- <div class="form-group">
                <label class="col-sm-3 control-label">Is Temporary ?</label>
                <div class="col-sm-5">
                   <label for="" id="selectDay"></label>
                </div>
            </div> -->

        <div class="form-group hidden">
                <label class="col-sm-3 control-label">Is Temporary ?</label>
                <div class="col-sm-5">
                   <select name="is_temporary" id="is_temporary" class="form-control" style="width:100%;" required>
                        <option value="no">No</option>
                        <option value="yes">Yes</option>
                    </select>
                </div>
            </div>

            <div class="form-group tt_date_wrapper hidden">
                <label class="col-sm-3 control-label">Date </label>
                <div class="col-sm-5">
                   <!-- <select name="day" class="form-control selectboxit" style="width:100%;">
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select> -->

                    <!-- <input type="date" id="tt_datepicker" name="" class="form-control" style="width:100%;"> -->

                    <input type="text" id="tt_datepicker" class="form-control datepicker " name="tem_date" placeholder="Select Holder" >
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('Type');?></label>
                <div class="col-sm-5">
                    <select name="type" id="type" class="form-control" style="width:100%;" >
                        <option value="" data-preventclose="true">Select Type</option>
                        <option value="timetable">Time Table</option>
                        <option value="event">Event</option>
                    </select>
                </div>
            </div>

            <div class="form-group type-tt">
                <label class="col-sm-3 control-label"><?php echo get_phrase('Subject');?></label>
                <div class="col-sm-5">
                    <select name="subject_id" class="form-control" style="width:100%;" id="subject_val" onchange="get_subjectid_by_teacher(this.value)">

                    </select>
                </div>
            </div>

            <div class="form-group type-tt">
                <label class="col-sm-3 control-label"><?php echo get_phrase('Teacher');?></label>
                <div class="col-sm-5">
                    <select name="teacher" class="form-control" style="width:100%;" id="teacher_details"> 
                        <?php 
                            $this->db->get_where('section')->row();
                        ?>
                        <option value="">-- select --</option>
                        
                    </select>
                </div>
            </div>


            <div class="form-group type-e">
                <label class="col-sm-3 control-label"><?php echo get_phrase('event_type');?></label>
                <div class="col-sm-5">
                    <input type="text" id="event_type" class="form-control" name="event_type">
                </div>
            </div>


            <div id="section_subject_selection_holder"></div>

            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('day');?></label>
                <div class="col-sm-5">
                    <select id="tt_day" name="day" class="form-control selectboxit" style="width:100%;">
                        <option value="sunday">sunday</option>
                        <option value="monday">monday</option>
                        <option value="tuesday">tuesday</option>
                        <option value="wednesday">wednesday</option>
                        <option value="thursday">thursday</option>
                        <option value="friday">friday</option>
                        <option value="saturday">saturday</option>
                    </select>
                </div>
            </div>



            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('starting_time');?></label>
                <div class="col-sm-9">
                    <div class="col-md-3 p0">
                        <select name="time_start" id= "starting_hour" class="form-control selectboxit">
                            <option value=""><?php echo get_phrase('hour');?></option>
                            <?php for($i = 1; $i <= 12 ; $i++):?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="time_start_min" id= "starting_minute" class="form-control selectboxit">
                            <option value=""><?php echo get_phrase('minutes');?></option>
                            <?php for($i = 0; $i <= 11 ; $i++):?>
                                <option value="<?php echo $i * 5;?>"><?php echo $i * 5;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="starting_ampm" class="form-control selectboxit">
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
                        <select name="time_end" id= "ending_hour" class="form-control selectboxit">
                            <option value=""><?php echo get_phrase('hour');?></option>
                            <?php for($i = 1; $i <= 12 ; $i++):?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="time_end_min" id= "ending_minute" class="form-control selectboxit">
                            <option value=""><?php echo get_phrase('minutes');?></option>  
                            <?php for($i = 0; $i <= 11 ; $i++):?>
                                <option value="<?php echo $i * 5;?>"><?php echo $i * 5;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="ending_ampm" class="form-control selectboxit">
                            <option value="1">am</option>
                            <option value="2">pm</option>
                        </select>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('note');?></label>
                <div class="col-sm-5">
                   <textarea type="text" class="form-control" id="tt_note" name="note"></textarea>
                </div>
            </div>


            <div class="hidden">
                <input type="text" class="" id="period" name="period" value="">
            </div>
            

        <div class="form-group">
              <div class="col-sm-offset-3 col-sm-5">
                <input type="hidden" name="class_id" id="classid_" value="<?php echo $class_id;?>">
                <input type="hidden" name="section_id" id="sectionid_" value="<?php echo $section_id;?>">
                <input type="hidden" name="template_id" id="template_" value="<?php echo $template_id;?>">
                <button type="submit" id= "add_class_routine" class="btn btn-info"><?php echo get_phrase('save_class_routine');?></button>
              </div>
            </div>
    <?php echo form_close();?>

<script>
    $(document).ready(function(){
    var class_id   = $('#classid_').val();
    var section_id = $('#sectionid_').val();
     $.ajax({       
       type   : "POST",
       url    : "<?php echo site_url('ajax/get_subject_by_class'); ?>",
       data   : {'class_id' : class_id,'section_id':section_id},               
       // async  : false,
        success: function(response){  
           console.log(response);                                                 
           $('#subject_val').html(response);
        }
     });
   });
</script>