<?php 

    $assignment = $this->db->get_where('assignments',array('id'=>$param2))->row(); 
    
    //$filter_assignments = $this->Crud_model->get_assignmenstt_filter($assignment->class_id,$assignment->section_id,$assignment->subject_id,$assignment->id); 
   $this->db->select('ST.student_id,ST.name as student_name,ST.email,C.name as class_name,S.name as subject_name,A.id,A.title,A.deadline,S.name as subject_name,A.assignment');
    $this->db->from('enroll AS E');
    $this->db->join('assignments AS A', 'A.class_id = E.class_id');
    $this->db->join('class AS C', 'C.class_id = A.class_id', 'left');
    $this->db->join('subject AS S', 'S.class_id = A.class_id', 'left');
    $this->db->join('student AS ST', 'ST.student_id = E.student_id');
     if($assignment->id != "")
       $this->db->where('A.id', $assignment->id); 

    $this->db->where('S.subject_id = A.subject_id');
    // $this->db->where('ST.student_id= A.student_id');
    $this->db->where('E.class_id   = S.class_id');
    $this->db->where('S.section_id = E.section_id');
    $this->db->where('A.section_id = E.section_id');
    if($assignment->class_id != "")
       $this->db->where('E.class_id', $assignment->class_id);
   
    if($assignment->section_id !="")
      $this->db->where('E.section_id', $assignment->section_id);
    
    if($assignment->subject_id !="")
     $this->db->where('S.subject_id', $assignment->subject_id);
   

    $this->db->order_by("ST.student_id", "desc");
    $filter_assignments = $this->db->get()->result();

     echo "<pre>";
     print_r($filter_assignments);
    echo "</pre>"; 

?>


 <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo $this->lang->line('assignment'); ?> <?php echo $this->lang->line('title'); ?></th>
            <td><?php echo $assignment->title; ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('class'); ?></th>
            <td><?php echo @$this->db->get_where('class',array('class_id'=>$assignment->class_id))->row()->name;
             echo " - ";
             echo $this->db->get_where('section',array('section_id'=>$assignment->section_id))->row()->name; ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('subject'); ?></th>
            <td><?php echo @$this->db->get_where('subject',array('subject_id'=>$assignment->subject_id))->row()->name; ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('deadline'); ?></th>
            <td><?php echo $assignment->deadline; ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('assignment'); ?></th>
            <td>
                <?php if($assignment->assignment){ ?>
                <a href="<?php echo UPLOAD_PATH; ?>/assignment/<?php echo $assignment->assignment; ?>"  class="btn btn-success g"><i class="fa fa-download"></i> <?php echo $this->lang->line('download'); ?></a> <br/><br/>
                <?php } ?>
            </td>
        </tr>        
        <tr>
            <th><?php echo $this->lang->line('note'); ?></th>
            <td><?php echo $assignment->note; ?>   </td>
        </tr>
    </tbody>
</table> 


<!--<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>

        <tr>
            <th><?php echo $this->lang->line('sl_no'); ?></th>
            <th><?php echo $this->lang->line('email'); ?></th>
            <th><?php echo $this->lang->line('student'); ?></th>
            <th>Submitted Assignment</th>
            
        </tr>
       <?php if(sizeof($filter_assignments) > 0){
        $i=1;
       foreach ($filter_assignments as $key => $dt) { ?>
       <?php print_r($filter_assignments) ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $dt->email; ?></td>
            <th><?php echo $dt->student_name; ?></th>
            <td> <?php 
                $assignment = @$this->db->get_where('submit_assignment',array('assignment_id'=>$dt->id,'student_id'=>$dt->student_id))->row()->assignment_file;
                if($assignment != ""){ ?>
                <a target="_blank" href="<?php echo base_url();?>assets/uploads/assignment_upload/<?php echo $assignment; ?>" class="btn btn-success btn-xs"><i class="fa fa-download"></i> <?php echo $this->lang->line('download'); ?> </a>
                <?php  } ?></td>
        </tr>
      <?php }} ?>
       
    </tbody>
</table>-->

  <form action="<?php echo site_url('admin/update_assignment_marks');?>" method="post">                    
                        <div class="x_content ">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap datatable" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th>Student Name</th>
                                        <th><?php echo $this->lang->line('subject'); ?></th>
                                        <th><?php echo $this->lang->line('class'); ?></th>
                                        <th><?php echo $this->lang->line('section'); ?></th>
                                        <th><?php echo $this->lang->line('deadline'); ?></th>
                                        
                                        <th style="width:10%">Assignment Marks</th>
                                        <th>Status</th>
                                        <th><?php echo $this->lang->line('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   

                                    <?php $count = 1; if(isset($filter_assignments) && !empty($filter_assignments)){ ?>
                                        <?php
                                        $assignments_value = $this->db->get_where('assignments',array('id'=>$assigment_id))->row(); 
                                        $titleval = $assignments_value->title;
                                        $deadline = $assignments_value->deadline;
                                        $subject_id= $assignments_value->subject_id;
                                        $assignment = $assignments_value->assignment;
                                       if ($assignments_value != "") {
                                          
                                         foreach($filter_assignments as $obj){ 
                                              $status = @$this->db->get_where('submit_assignment',array('assignment_id'=>$assigment_id,'student_id'=>$obj->student_id))->row(); 
                                               
                                            ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $obj->student_name;?></td>
                                            <td><?php echo $this->db->get_where('subject',array('subject_id'=>$subject_id))->row()->name; ?></td>
                                            <td><?php echo $this->db->get_where('class',array('class_id'=>$obj->class_id))->row()->name; ?></td>
                                            <td><?php echo $this->db->get_where('section',array('section_id'=>$obj->section_id))->row()->name; ?></td>
                                            <td><?php echo $deadline; ?></td>
                                            <td class="text-center"><input type="number" name="marks[]" value ="<?php echo  $status->mark;?>" style="width:30%; height:30px;" > <span>/</span>
                                            <span style="font-weight:700"><?php echo $assignments_value->assignment_marks; ?></span>
                                                <input type="hidden" name="student_id[]" value ="<?php echo $obj->student_id;?>" >
                                                <input type="hidden" name="class_id" value ="<?php echo $obj->class_id;?>" >
                                                <input type="hidden" name="assignment_id[]" value ="<?php echo $assigment_id;?>" ></td>
                                            <td><?php 
                                                 // echo $obj->id;
                                                 // echo "<br>";
                                                 // echo $obj->student_id;
                                            
                                                if($status->status == 1){
                                                    echo '<span style="color:green;">Submitted</span>';
                                                }else{
                                                    echo 'pending';
                                                } ?></td>
                                            <td>

                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                                        Action <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                                        

                                                        
                                                        <!-- DELETION LINK -->
                                                        <li>
                                                            <?php if(has_permission(VIEW, 'assignment', 'assignment')){ ?>
                                                           <!--  <a  onclick="get_assignment_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-assignment-modal-lg"  class=""><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> </a> -->
                                                            <?php 

                                                             $assignment_submit = @$this->db->get_where('submit_assignment',array('assignment_id'=>$assigment_id,'student_id'=>$obj->student_id))->row()->assignment_file;

                                                            if($assignment_submit != ""){ ?>
                                                            <a target="_blank" href="<?php echo base_url();?>assets/uploads/assignment_upload/<?php echo $assignment_submit; ?>" class=""><i class="fa fa-download"></i> <?php echo $this->lang->line('download'); ?> </a>
                                                            <?php  } ?>
                                                        <?php  } ?>
                                                        </li>

                                                        <li>
                                                            <?php if(has_permission(DELETE, 'assignment', 'assignment')){ ?>
                                                                <a href="<?php echo site_url('assignment/delete/'.$assigment_id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class=""><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
                                                            <?php  } ?>
                                                        </li>
                                                    </ul>
                                                </div>

                                                
                                                
                                                
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                             <div class="form-group" style="margin-top:10px;">
                                    <div class="col-md-12 text-right p0">
                                       <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                  <?php } ?>
                            </div>
                      </form> 
