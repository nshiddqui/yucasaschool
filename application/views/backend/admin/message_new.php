<div class="mail-header" style="padding-bottom: 27px ;">
    <!-- title -->
    <h3 class="mail-title">
        <?php echo get_phrase('write_new_message'); ?>
    </h3>
</div>

     <script type="text/javascript" src="<?php echo base_url('assets/js/ckeditor.js')?>"></script>

<div class="mail-compose">

    <?php echo form_open(site_url('admin/message/send_new/'), array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>


    <div class="form-group">
        <label for="subject"><?php echo get_phrase('recipient'); ?>:</label>
        <br><br>
        <select name="user_type" class="form-control select2" onchange="getUserType(this.value)" required="required" >
            <option>Select User Type</option>
            <option value="student">Student</option>
            <option value="parent">Parent</option>
            <option value="teacher">Teacher</option>
        </select>
        <div id="student" style="display:none">
            <?php
            $classes = $this->db->get_where('class')->result();
            $classes = json_decode(json_encode( $classes),FALSE) ; 
                      
            ?>
            <select  class="form-control select2"  id="add_class_id" required="required" onchange="return get_class_sections(this.value)" >
                <option value="">--<?php echo $this->lang->line('select'); ?> Class--</option> 
                <?php foreach($classes as $obj ){ ?>
                    <option value="<?php echo $obj->class_id; ?>" ><?php echo $obj->name; ?></option>
                <?php } ?>                                            
            </select>
            <select  class="form-control select2"   id="section_selector_holder" onchange="return get_student_by_class_sections(this.value)" required="required" >
                <option value="">--<?php echo $this->lang->line('select'); ?> Section--</option>                                                                                      
            </select>
            <select  class="form-control select2"  name="reciever"  id="add_student_id" required="required" >
                <option value="">--<?php echo $this->lang->line('select'); ?> Student--</option>                                                                                      
            </select>
        </div>
        <div id="parent" style="display:none">
            <select  class="form-control select2" name="reciever" required="required">
                <option value=""> Select Parent</option>
                <?php
                $parents = $this->db->get('parent')->result_array();
                foreach ($parents as $row):
                    ?>

                    <option value="<?php echo $row['parent_id']; ?>">
                        <?php echo $row['name']; ?></option>

                <?php endforeach; ?>                                         
            </select>
        </div>
        <div id="teacher" style="display:none">
            <select  class="form-control select2" name="reciever" required="required">
                <option value=""> Select Teacher</option>
                <?php
                $teachers = $this->db->get('teacher')->result_array();
                foreach ($teachers as $row):
                    ?>

                    <option value="<?php echo $row['teacher_id']; ?>">
                         <?php echo $row['name']; ?></option>

                <?php endforeach; ?>                                                                                   
            </select>
        </div>
    </div>


    <div class="compose-message-editor">
                     <textarea name="message" id="editor1" rows="10" cols="80" placeholder="<?php echo get_phrase('write_your_message'); ?>" required>
                
            </textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>
    </div>
    <br>
    <!-- File adding module -->
    <div class="">
      <input type="file" class="form-control file2 inline btn btn-info" name="attached_file_on_messaging" accept=".pdf, .doc, .jpg, .jpeg, .png" data-label="<i class='entypo-upload'></i> Browse" />
      <button type="submit" class="btn btn-success pull-right" style="
    width: 117px;
">
        <?php echo get_phrase('send'); ?>
    </button>
    </div>
  <!-- end -->
 
</form>

</div>
<script>
    function getUserType(role_type){
        $('#student').hide();
        $('#student select').prop('required',false);
         $('#parent').hide();
        $('#parent select').prop('required',false);
         $('#teacher').hide();
        $('#teacher select').prop('required',false);
        $('#'+role_type).show();
        $('#'+role_type+' select').prop('required',true);
    }
    
    function get_class_sections(class_id) {
        
    	$.ajax({
            url: '<?php echo site_url('admin/get_class_section/');?>' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });

    }
    
    function get_student_by_class_sections(section_id) {
        var class_id = $('#add_class_id').val();
        if(class_id=='' || section_id==''){
            jQuery('#add_student_id').html('<option value="">Select Student</option>');
        }
    	$.ajax({
            url: '<?php echo site_url('admin/get_students_for_ssph/');?>' + class_id+'/'+section_id ,
            success: function(response)
            {
                jQuery('#add_student_id').html(response);
            }
        });

    }
   
</script>