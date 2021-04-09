<?php 

    $assignment = $this->db->get_where('assignments',array('id'=>$param2))->row(); 
    // echo "<pre>";
    // print_r($assignment);
    // echo "</pre>";
    
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

    // echo "<pre>";
    // print_r($filter_assignments);
    // echo "</pre>"; 

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
                <a href="<?php echo UPLOAD_PATH; ?>/assignment/<?php echo $assignment->assignment; ?>"  class="btn btn-success btn-xs"><i class="fa fa-download"></i> <?php echo $this->lang->line('download'); ?></a> <br/><br/>
                <?php } ?>
            </td>
        </tr>        
        <tr>
            <th><?php echo $this->lang->line('note'); ?></th>
            <td><?php echo $assignment->note; ?>   </td>
        </tr>
    </tbody>
</table> 


<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
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
</table>
