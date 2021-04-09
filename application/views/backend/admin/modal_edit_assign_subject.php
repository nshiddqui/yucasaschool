<?php 
$edit_data		=	$this->db->get_where('assign_subject' , array('assign_id' => $param2) )->result_array();
$cls_id = "";
foreach ( $edit_data as $row):
    $subject_id_arr = array();
    $subjectdata = $this->db->get_where('assign_subject' , array('teacher_id' => $row['teacher_id']))->result_array();
     foreach ($subjectdata as $sub_dt):
        $subject_id_arr[] = $sub_dt['subject_id'];
     endforeach;
   
    //$subject_id_array = explode(',', $subject_id_arr);
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_subject');?>
            	</div>
            </div>
			<div class="panel-body">
                <?php echo form_open(site_url('admin/subject/do_update_assign/'.$row['teacher_id']) , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                     <div class="col-sm-5">
                        <select name="subject_id[]"  class="selectpicker" multiple="multiple" data-live-search="true" style="width:100%;hight:50px;" required>
                            <option value="" disabled><?php echo get_phrase('select_subject'); ?></option>
                            <?php
                                $classes = $this->db->get('subject')->result_array();
                            foreach($classes as $rowc):
                            ?>
                            <option value="<?php echo $rowc['subject_id'];?>" <?php if(in_array($rowc['subject_id'], $subject_id_arr)) echo 'selected';?>>
                                    <?php echo $rowc['name'];?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('teacher');?></label>
                    <div class="col-sm-5 controls">
                        <select name="teacher_id" class="form-control ">
                            <?php 
                            $teachers = $this->db->get('teacher')->result_array();
                            foreach($teachers as $row2):
                            ?>
                                <option value="<?php echo $row2['teacher_id'];?>"
                                 <?php if($row['teacher_id'] == $row2['teacher_id']){ echo 'selected';}?>>
                                 <?php echo $row2['name'];?>
                                </option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div> 
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_subject');?></button>
                    </div>
                 </div>
        		</form>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>



