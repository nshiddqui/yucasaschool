<?php
if($formurl != "" && $formurl != "scholarship_manage_online_exam_question")
  $formurl = 'feedback_manage_question'; 


 echo form_open(site_url('admin/'.$formurl.'/'.$form_id.'/add/multiple_choice') , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>

<input type="hidden" name="type" value="<?php echo $question_type;?>">


<div class="form-group">
    <label class="col-sm-3 control-label"><?php echo get_phrase('question_title');?></label>
    <div class="col-sm-8">
        <textarea onkeyup="changeTheBlankColor()" name="question_title" class="form-control" id="question_title" rows="8" cols="80" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"></textarea>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label"><?php echo get_phrase('placeholder');?></label>
    <div class="col-sm-8">
        <input onkeyup="changeTheBlankColor()" name="placeholder_value" class="form-control" id="question_title" rows="8" cols="80" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
    </div>
</div>

<div class="form-group">
    <div class="col-sm-12">
        <button type="submit" class="btn btn-info btn-block"><?php echo get_phrase('add_question');?></button>
    </div>
</div>
<?php echo form_close();?>

<script type="text/javascript">
    function showOptions(number_of_options){
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/manage_multiple_choices_options'); ?>",
            data: {number_of_options : number_of_options},
            success: function(response){
                console.log(response);
                jQuery('.options').remove();
                jQuery('#multiple_choice_question').after(response);
            }
        });
    }
</script>
