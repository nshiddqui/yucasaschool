<hr />

   <a href="javascript:;" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_add_substitute_subject/');?>');" 
    class="btn btn-primary pull-right" style="margin-left: 10px;">
        <i class="entypo-plus-circled"></i>
            <?php echo get_phrase('add_substitute_teacher');?>
</a>


<a href="<?php echo site_url('admin/class_routine_add');?>"
    class="btn btn-primary pull-right">
        <i class="entypo-plus-circled"></i>
        <?php echo get_phrase('add_class_routine');?>
    </a> 

 

<br><br><br>

<ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#routine" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('Class_Routine');?>
                        </a></li>
            <li>
                <a href="#substitute" data-toggle="tab"><i class="entypo-menu"></i>
                    <?php echo get_phrase('substitute_teacher_list');?>
                        </a></li>
        </ul>
        <!------CONTROL TABS END------>
        <br><br>

        <div class="tab-content">
        
        <div class="tab-pane box active" id="routine">

<?php
	$query = $this->db->get_where('section' , array('class_id' => $class_id));
	if($query->num_rows() > 0):
		$sections = $query->result_array();
	foreach($sections as $row):
?>
<div class="row">
	
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        
            <div class="panel panel-default" data-collapsed="0">
                <div class="panel-heading" >
                    <div class="panel-title" style="font-size: 16px; color: white; text-align: center;">
                        <?php echo get_phrase('class');?> - <?php echo $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;?> : 
                        <?php echo get_phrase('section');?> - <?php echo $this->db->get_where('section' , array('section_id' => $row['section_id']))->row()->name;?>
                        <a href="<?php echo site_url('admin/class_routine_print_view/'.$class_id.'/'.$row['section_id']);?>"
                            class="btn btn-primary btn-xs pull-right" target="_blank">
                                <i class="entypo-print"></i> <?php echo get_phrase('print');?>
                        </a>
                    </div>
                </div>
                <div class="panel-body">
                    
                    <table cellpadding="0" cellspacing="0" border="0"  class="table table-bordered">
                        <tbody>
                            <?php 
                            for($d=1;$d<=7;$d++):
                            
                            if($d==1)$day='sunday';
                            else if($d==2)$day='monday';
                            else if($d==3)$day='tuesday';
                            else if($d==4)$day='wednesday';
                            else if($d==5)$day='thursday';
                            else if($d==6)$day='friday';
                            else if($d==7)$day='saturday';
                            ?>
                            <tr class="gradeA">
                                <td width="100"><?php echo strtoupper($day);?></td>
                                <td>
                                    <?php
                                    $this->db->order_by("time_start", "asc");
                                    $this->db->where('day' , $day);
                                    $this->db->where('class_id' , $class_id);
                                    $this->db->where('section_id' , $row['section_id']);
                                    $this->db->where('year' , $running_year);
                                    $routines   =   $this->db->get('class_routine')->result_array();
                                    foreach($routines as $row2):
                                    ?>
                                    <div class="btn-group">
                                        <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            <?php echo $this->crud_model->get_subject_name_by_id($row2['subject_id']);?>
                                            <?php
                                                if ($row2['time_start_min'] == 0 && $row2['time_end_min'] == 0) 
                                                    echo '('.$row2['time_start'].'-'.$row2['time_end'].')';
                                                if ($row2['time_start_min'] != 0 || $row2['time_end_min'] != 0)
                                                    echo '('.$row2['time_start'].':'.$row2['time_start_min'].'-'.$row2['time_end'].':'.$row2['time_end_min'].')';
                                            ?>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                            <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_edit_class_routine/'.$row2['class_routine_id']);?>');">
                                                <i class="entypo-pencil"></i>
                                                    <?php echo get_phrase('edit');?>
                                                            </a>
                                     </li>
                                     
                                     <li>
                                        <a href="#" onclick="confirm_modal('<?php echo site_url('admin/class_routine/delete/'.$row2['class_routine_id']);?>');">
                                            <i class="entypo-trash"></i>
                                                <?php echo get_phrase('delete');?>
                                            </a>
                                        </li>
                                        </ul>
                                    </div>
                                    <?php endforeach;?>

                                </td>
                            </tr>
                            <?php endfor;?>
                            
                        </tbody>
                    </table>
                    
                </div>
           

    </div>

    </div>

</div>

 
        


<?php endforeach;?>
<?php endif;?>
</div>


 <div class="tab-pane box " id="substitute">

       <table class="table table-bordered datatable" >
            <thead>
                <tr>
                    <th><div><?php echo get_phrase('class');?></div></th>
                    <th><div><?php echo get_phrase('subject_name');?></div></th>
                    <th><div><?php echo get_phrase('section');?></div></th>
                    <th><div><?php echo get_phrase('teacher');?></div></th>
                    <th><?php echo get_phrase('date');?></th>
                    <th><div><?php echo get_phrase('options');?></div></th>
                </tr>
            </thead>
            <tbody>
            <?php if($substitute_list != ""){
                foreach ($substitute_list as  $dt) { ?>
                <tr>
                 <th><?php echo $dt->class_name;?></th>
                 <th><?php echo $dt->subject_name;?></th>
                 <th><?php echo $dt->section_name;?></th>
                 <th><?php echo $dt->teacher_name;?></th>
                 <th><?php echo $dt->date;?></th>
                 <th>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Action <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                            <!-- EDITING LINK -->
                            <li>
                                <a href="#" onclick="showAjaxModal(<?php echo site_url('modal/popup/modal_edit_substitute_teacher/'.$dt->id);?>)">
                                    <i class="entypo-pencil"></i>
                                        Edit                                                    
                                </a>
                            </li>
                            <li class="divider"></li>
                            <!-- DELETION LINK -->
                            <li>
                                <a href="#" onclick="confirm_modal(<?php echo site_url('admin/substitute/delete/'.$dt->id);?>)">
                                    <i class="entypo-trash"></i>
                                    Delete         
                                </a>
                            </li>
                        </ul>
                    </div>
                  </th>
                </tr>
            <?php } } ?>
            </tbody>
       </table>


 </div>
</div>