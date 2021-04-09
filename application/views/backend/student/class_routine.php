<hr />
<?php
    $section_id = $this->db->get_where('enroll' , array(
        'student_id' => $student_id,
            'class_id' => $class_id,
                'year' => $running_year
    ))->row()->section_id;
?>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default" data-collapsed="0">
            <div class="panel-heading" >
                <div class="panel-title" style="font-size: 16px; color: white; text-align: center;">
                    <?php echo get_phrase('class');?> - <?php echo $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;?> : 
                    <?php echo get_phrase('section');?> - <?php echo $this->db->get_where('section' , array('section_id' => $section_id))->row()->name;?>
                    <a href="<?php echo site_url('student/class_routine_print_view/'.$class_id.'/'.$section_id);?>"
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
                                $this->db->where('section_id' , $section_id);
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
                                </div>
                                <?php endforeach;?>

                            </td>
                        </tr>
                        <?php endfor;?>
                        
                    </tbody>
                </table>

                
          <h4 class="simpleHeading"> Substitue Teacher List</h4>
                    <table class="table table-bordered datatable" >
            <thead>
                <tr>
                    <th><div><?php echo get_phrase('class');?></div></th>
                    <th><div><?php echo get_phrase('subject_name');?></div></th>
                    <th><div><?php echo get_phrase('section');?></div></th>
                    <th><div><?php echo get_phrase('teacher');?></div></th>
                    <th><?php echo get_phrase('date');?></th>
                   
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
                </tr>
            <?php } } ?>
            </tbody>
       </table>
                
            </div>
        </div>

    </div>

</div>