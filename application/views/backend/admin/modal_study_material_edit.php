<?php
$class_info = $this->db->get('class')->result_array();
$single_study_material_info = $this->db->get_where('document', array('document_id' => $param2))->result_array();
foreach ($single_study_material_info as $row) {
    ?>
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        <?php echo get_phrase('edit_study_material'); ?>
                    </div>
                </div>

                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo site_url('admin/study_material/update/'.$row['document_id']); ?>" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('date'); ?></label>

                            <div class="col-sm-5">
                                <input type="text" name="timestamp" class="form-control datepicker" data-format="D, dd MM yyyy"
                                       placeholder="date here" value="<?php echo date("d M, Y", $row['timestamp']); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('title'); ?></label>

                            <div class="col-sm-5">
                                <input type="text" name="title" class="form-control" id="field-1" value="<?php echo $row['title']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                            <div class="col-sm-9">
                                <textarea name="description" class="form-control wysihtml5" data-stylesheet-url="<?php echo site_url(); ?>assets/css/wysihtml5-color.css"
                                          id="field-ta"><?php echo $row['description']; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>

                            <div class="col-sm-5">
                                <select name="class_id" class="form-control selectboxit" id="class_id" onchange="return get_class_subject(this.value),select_section(this.value)">
                                    <option value=""><?php echo get_phrase('select_class'); ?></option>
                                    <?php foreach ($class_info as $row2) { ?>
                                        <option value="<?php echo $row2['class_id']; ?>" <?php if ($row['class_id'] == $row2['class_id']) echo 'selected'; ?>>
                                            <?php echo $row2['name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('section'); ?></label>
                                <div class="col-sm-5">
                                        <select name="section_id[]" class="form-control" id="section_selector_holder" required="required" multiple>
                                            <option value=""><?php echo get_phrase('select_section'); ?></option>
                                            <?php 
                                             $sectiondata = $this->db->get_where('section',array('class_id'=>$row['class_id']))->result();
                                            foreach ($sectiondata as $row3) { 
                                                   $section_arr_ = explode(',',$row['section_id']);
                                                ?>
                                              <option value="<?php echo $row3->section_id; ?>" <?php if (in_array($row3->section_id,$section_arr_)) echo 'selected'; ?>>
                                                <?php echo $row3->name; ?>
                                              </option>
                                            <?php } ?>

                                     </select>
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('subject'); ?></label>
                            <div class="col-sm-5">
                                <select name="subject_id" class="form-control" id="subject_selector_holder">
                                   <?php
                                   $class_id_ = $row['class_id'];
                                   $subject = $this->db->query("select * from subject where FIND_IN_SET($class_id_,class_id)")->result_array();
                                   foreach ($subject as $row2){
                                   ?>
                                    <option value="<?php echo $row2['subject_id']; ?>" <?php if ($row['subject_id'] == $row2['subject_id']) echo 'selected'; ?>>
                                            <?php echo $row2['name']; ?>
                                        </option>
                                   <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-3 control-label col-sm-offset-1">
                            <button type="submit" class="btn btn-success"><?php echo get_phrase('update'); ?></button>
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
<?php } ?>

<script type="text/javascript">

    function get_class_subject(class_id) {

        $.ajax({
            url: '<?php echo site_url('admin/get_class_subject/'); ?>' + class_id,
            success: function (response)
            {
                jQuery('#subject_selector_holder').html(response);
            }
        });

    }

    function select_section(class_id) {
          
                $.ajax({
                    type   : "POST",
                    url: "<?php echo site_url('ajax/get_class_by_section/');?>",
                    data   : { class_id : class_id},               
                    async  : false,
                    success:function (response)
                    {
                        $('#section_selector_holder').html(response);

                     
                    }
                });
            }

</script>
