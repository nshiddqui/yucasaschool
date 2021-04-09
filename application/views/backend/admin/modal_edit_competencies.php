<?php 
$edit_data		=	$this->db->get_where('subject_competencies' , array('id' => $param2) )->result_array();
$cls_id = "";
foreach ( $edit_data as $row):

    $cls_id = $row['class_id'];
    $clas_id = explode(',', $cls_id);
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
                <?php echo form_open(site_url('admin/subject/do_update/'.$row['subject_id']) , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                    <div class="col-sm-5 controls">
                        <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>" required/>
                    </div>
                </div>
                <!-- <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                    <div class="col-sm-5 controls">
                        <select name="class_id" class="form-control"> 
                            <?php 
                            $classes = $this->db->get('class')->result_array();
                            foreach($classes as $row2):
                                  ?>
                                <option value="<?php echo $row2['class_id'];?>"
                                    <?php if($row['class_id'] == $row2['class_id'])echo 'selected';?>>
                                        <?php echo $row2['name'];?>
                                            </option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div> -->

               <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('Section');?></label>
                    <div class="col-sm-5">
                        <select name="section_id" class="form-control " style="width:100%;">
                            <option value=""><?php echo get_phrase('select_section'); ?></option>
                        <?php  
                            $sections = $this->db->get_where('section' , array('class_id' => $row['class_id'],'sub_teacher_status'=>0))->result_array();
                                $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
                                foreach ($sections as $dt) { ?>
                                     <option value="<?php echo $dt['section_id'];?>" <?=$dt['section_id']==$row['section_id']?'selected':"";?> ><?php echo $dt['name'];?></option>
                              <?php  }
                        ?>               
                        </select>
                    </div>
                </div>

                <!-- <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('teacher');?></label>
                    <div class="col-sm-5 controls">
                        <select name="teacher_id" class="form-control ">
                            <?php 
                            $teachers = $this->db->get('teacher')->result_array();
                            foreach($teachers as $row2):
                            ?>
                                <option value="<?php echo $row2['teacher_id'];?>"
                                    <?php if($row['teacher_id'] == $row2['teacher_id'])echo 'selected';?>>
                                        <?php echo $row2['name'];?>
                                            </option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div> -->

                <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                                <div class="col-sm-5">
                                    <select name="class_id[]"  class="selectpicker" multiple="multiple" data-live-search="true" style="width:100%;hight:50px;" required onchange="return get_class_sections(this.value)">
                                     <option value="" disabled><?php echo get_phrase('select_class'); ?></option>
                                        <?php
                                        $classes = $this->db->get('class')->result_array();
                                        foreach($classes as $row):
                                        ?>
                                            <option value="<?php echo $row['class_id'];?>"
                                                <?php if(in_array($row['class_id'], $clas_id)) echo 'selected';?>>
                                                    <?php echo $row['name'];?>
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



