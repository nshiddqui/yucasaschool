<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_question_paper');?>
                </div>
            </div>

            <div class="panel-body">
                <?php echo form_open(site_url('admin/question_paper/create') , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('title');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="title" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
                        </div>
                    </div>
                   <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('deadline');?></label>
                        <div class="col-sm-6">
                            <input type="date" class="form-control" name="deadline" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">Password Protection</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="password" data-validate="required" data-message-required="Value Required" value="" autofocus="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>
                        <div class="col-sm-6">
                            <select name="class_id" id = 'class_id' class="form-control selectboxit" required onchange="get_subject_by_class(this.value, '', false);">
                                <option value=""><?php echo get_phrase('select_a_class'); ?></option>
                                <?php
                                $classes = $this->db->get('class')->result_array();
                                foreach ($classes as $row) { ?>
                                    <option value="<?php echo $row['class_id']; ?>">
                                        <?php echo $row['name'];?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('exam'); ?></label>
                        <div class="col-sm-6">
                            <select name="exam_id" class="form-control" required>
                                <option value=""><?php echo get_phrase('select_an_exam'); ?></option>
                                <?php 
                                $exams = $this->db->get('exam')->result_array();
                                foreach ($exams as $row) { ?>
                                    <option value="<?php echo $row['exam_id']; ?>">
                                        <?php echo $row['name'];?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                     <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject_id"><?php echo $this->lang->line('subject'); ?> <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select  class="form-control col-md-7 col-xs-12 data_subject quick-field"  name="subject_id" id="add_subject_id" required="required" >
                                    <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                         
                                </select>
                                <a href="<?php echo site_url('academic/subject/add'); ?>" class="btn btn-success btn-md quick-add">+</a>
                                <div class="help-block"><?php echo form_error('subject_id'); ?></div>
                            </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('question_paper');?></label>
                        
                        <div class="col-sm-9">
                            <textarea class="form-control wysihtml5" data-stylesheet-url="assets/css/wysihtml5-color.css" name="question_paper" required></textarea>
                        </div> 
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" id = "submit" class="btn btn-info"><?php echo get_phrase('submit');?></button>
                        </div>
                    </div>

                <?php echo form_close();?>

            </div>
        </div>
    </div>
</div>
<script type = 'text/javascript'>
                var class_id = '';
                jQuery(document).ready(function($) {
                    $("#submit").attr('disabled', 'disabled');
                });

                function check_validation(){
                    if(class_id !== ''){
                        $('#submit').removeAttr('disabled');
                    }
                    else{
                        $("#submit").attr('disabled', 'disabled');
                    }
                }
                $('#class_id').change(function(){
                    class_id = $('#class_id').val();
                    check_validation();
                });


                function get_subject_by_class(class_id, subject_id, is_edit){       
                    $.ajax({       
                        type   : "POST",
                        url    : "<?php echo site_url('ajax/get_subject_by_class'); ?>",
                        data   : { class_id : class_id,  subject_id : subject_id},               
                        async  : false,
                        success: function(response){                                                   
                           if(response)
                           {
                              if(is_edit){
                                $('#edit_subject_id').html(response);
                               }else{
                                $('#add_subject_id').html(response); 
                               }
                           }
                        }
                    });                  
        
                }
            </script>
















