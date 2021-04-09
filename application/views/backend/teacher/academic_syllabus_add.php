
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('upload_academic_syllabus'); ?>
                </div>
            </div>
            <div class="panel-body">

                <?php
                echo form_open(site_url('teacher/upload_academic_syllabus'), array(
                    'class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top', 'enctype' => 'multipart/form-data'
                ));
                ?>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('title'); ?></label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="title"
                               data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>
                    <div class="col-sm-6">
                        <textarea class="form-control" name="description" required="required"></textarea>
                    </div>
                </div>
              <?php   $this->db->select('AE.*');
        $this->db->select('AE.*,C.name as class_name,C.class_id as class_id,S.name as subject_name, S.subject_id as subject_id');
        $this->db->from('assign_subject AS AE');
        $this->db->join('subject AS S', 'S.subject_id = AE.subject_id');
        $this->db->join('class AS C', 'C.class_id = S.class_id');
        $this->db->where('AE.year', '2018-2019');
        $this->db->where('AE.teacher_id', $this->session->userdata('login_user_id'));
        $this->db->group_by('C.class_id');
        $classess= $this->db->get()->result(); 
      
        ?>
           
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>
                    <div class="col-sm-6">
                        <select class="form-control selectboxit" name="class_id" id="class_id" onchange="return get_class_subject(this.value)">
                            <option value=""><?php echo get_phrase('select'); ?></option>
                              <?php //$classess = $this->db->get('class')->result_array();
                            foreach ($classess as $row): ?>
                               <option value="<?php echo $row->class_id; ?>"><?php echo $row->class_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!--<div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('section'); ?></label>
                    <div class="col-sm-6">
                        <select name="section_holder" class="form-control selectboxit" id="section_holder" required="required">
                            <option value=""><?php echo get_phrase('select_class_first'); ?></option>

                        </select>
                    </div>
                </div>-->

                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('subject'); ?></label>
                    <div class="col-sm-6">
                        <select name="subject_id" class="form-control selectboxit" id="subject_selector_holder" required="required">
                            <option value=""><?php echo get_phrase('select_class_first'); ?></option>

                        </select>
                    </div>
                </div>


                <!-- No Of Modules -->
                <div class="form-group hidden">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('no_of_modules'); ?></label>
                    <div class="col-sm-6">
                        <input type="number" name="no_of_modules" value="5">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('file'); ?></label>
                    <div class="col-sm-5">
                        <input type="file" name="file_name" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Browse" 
                               data-validate="required" data-message-required="<?php echo get_phrase('required'); ?>"/>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" id = 'submit' class="btn btn-info">
                            <i class="entypo-upload"></i> <?php echo get_phrase('add_syllabus'); ?>
                        </button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    function get_class_subject(class_id) {
        if(class_id !== ''){
        $.ajax({
            url: '<?php echo site_url('teacher/get_class_subject/'); ?>' + class_id,
            success: function (response)
            {
                 $("#subject_selector_holder").empty().selectBoxIt("refresh");
                 $("#subject_selector_holder").append(response);
                 $("#subject_selector_holder").selectBoxIt("refresh");
                // jQuery('#subject_selector_holder').html(response)
                console.log(response);
            }
        });
      }
    }

</script>
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
            </script>