
<?php $id= $this->uri->segment(3); ?>
<?php

 $online_exam_details = $this->db->get_where('teacher_feedback', array('id' => $id))->row_array();
 $added_question_info = $this->db->get_where('teacher_feedback_question', array('feed_back_id' => $id))->result_array();
?>
<?php $activeTab = "teacher_feedback"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Teachers</a></li>
        <li class="active">All Teachers</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/teacher_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-menu"></i>
                    Question List                </div>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align: center;" width="5%"><div>#</div></th>
                            <th style="text-align: center;"><div>Type</div></th>
                            <th style="text-align: center;" width="80%"><div>Question</div></th>
                           
                        </tr>
                    </thead>
                    <!--<tbody>
                    <tr>
                        <td style="text-align: center;">1</td>
                        <td>Multiple Choice</td>
                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, saepe.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, saepe.</td>
                        <td style="text-align: center;">
                        
                            <a href="#" onclick="showAjaxModal('http://localhost/edurama_pos_full/index.php/modal/popup/update_online_exam_question/5')" class="btn btn-primary btn-xs" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <a href="#" onclick="confirm_modal('http://localhost/edurama_pos_full/index.php/admin/delete_question_from_online_exam/5');" class="btn btn-danger btn-xs" data-toggle="tooltip" title="" data-original-title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>                        
                    </tbody>-->
                    
                      <tbody>
                        <?php if (sizeof($added_question_info) == 0):?>
                            <tr>
                                <td colspan="4"><?php echo get_phrase('no_question_has_been_added_yet'); ?></td>
                            </tr>

                            <?php
                            elseif (sizeof($added_question_info) > 0):
                            $i = 0;
                            foreach ($added_question_info as $added_question): ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo ++$i; ?></td>
                                    <td><?php echo get_phrase($added_question['type']);?></td>
                                    <?php if ($added_question['type'] == 'fill_in_the_blanks'): ?>
                                        <td><?php echo str_replace('^', '____', $added_question['question_title']); ?></td>
                                    <?php else: ?>
                                        <td><?php echo $added_question['question_title']; ?></td>
                                    <?php endif; ?>
                                    
                                    <td style="text-align: center;">
                                        <!-- <a href="<?php echo site_url('admin/update_online_exam_question/'.$added_question['question_bank_id']); ?>" class = "btn btn-primary btn-xs" data-toggle="tooltip" title="<?php echo get_phrase('edit'); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a> -->
                                        <!--<a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/teacher_feedback_by_student/'.$added_question['question_id']);?>')" class="btn btn-primary btn-xs" data-toggle="tooltip" title="<?php echo get_phrase('edit'); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>-->
                                        <a href = "#" onclick="confirm_modal('<?php echo site_url('admin/feedback_delete_question_from_teacher/'.$added_question['question_id']);?>');" class = "btn btn-danger btn-xs"  data-toggle="tooltip" title="<?php echo get_phrase('delete'); ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                    
                    
                </table>
            </div>
        </div>
    </div>


    <div class="col-md-6">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-info-circled"></i>
                    Form Details                </div>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td><b>Form Title</b></td>
                            <td>Demo Online Form</td>
                            <td><b>Date</b></td>
                            <td>Dec 05, 2018</td>
                        </tr>
                        <tr>
                            <td><b>Class</b></td>
                            <td>Nursery</td>
                            <td><b>Time</b></td>
                            <td>10:50:00 - 15:30:00</td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Add Question                </div>
            </div>
            <div class="panel-body">   
                <div class="panel-body">   
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('question_type');?></label>
                        <div class="col-sm-8">
                            <select class="selectboxit" name="question_type" id="question_type">
                                <option value=""><?php echo get_phrase('select_question_type');?></option>
                                <option value="multiple_choice"><?php echo get_phrase('multiple_choice');?></option>
                                <option value="text_area"><?php echo get_phrase('text_area');?></option>
                            </select>
                        </div>
                    </div>
                    <br><br>
                    <div id="question_holder"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">


    $(document).ready(function() {
        $('#print_options').hide();
        $('#questions_print').on('click', function() {
            $('#print_options').fadeIn();
        });
        $('#question_type').on('change', function() {
            var question_type = $(this).val();
            if (question_type == '') {
                $('#question_holder').html('<div class="alert alert-danger">Please select a question type</div>');
                return;
            }
            var feedback_form_id = '<?php echo $id;?>';
            $.ajax({
                url: '<?php echo site_url('admin/load_feedback_question/');?>' + question_type + '/' + feedback_form_id
            }).done(function(response) {
                $('#question_holder').html(response);
            });
        });
    });
</script>