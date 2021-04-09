<?php   
    $this->db->select('E.*, R.name AS receiver_type,E.year');
    $this->db->from('emails AS E');
    $this->db->join('roles AS R', 'R.id = E.role_id', 'left');
    //$this->db->join('settings AS AY', 'AY.settings_id = E.academic_year_id', 'left');
    $this->db->where('E.id', $param2);
    $email =   $this->db->get()->row();    

    if($email->role_id == 8){
        $table = 'parent';
        $reciverid = 'parent_id';
    }elseif($email->role_id == 4){
        $table = 'student';
        $reciverid = 'student_id';
    }
?>

<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo $this->lang->line('session_year'); ?></th>
            <td><?php echo $email->year; ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('receiver_type'); ?></th>
            <td><?php echo $email->receiver_type; ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('receiver'); ?> <?php echo $this->lang->line('name'); ?></th>
            <td><?php echo  @$this->db->get_where($table,array($reciverid => $email->receivers))->row()->name; ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('subject'); ?></th>
            <td><?php echo $email->subject; ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('email_body'); ?></th>
            <td><?php echo $email->body; ?></td>
        </tr>        
        <tr>
            <th><?php echo $this->lang->line('send'); ?> <?php echo $this->lang->line('time'); ?></th>
            <td><?php echo get_nice_time($email->created_at); ?></td>
        </tr> 
    </tbody>
</table>
