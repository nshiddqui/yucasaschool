<?php 
        $this->db->select('TM.*, R.name AS receiver_type, TM.year ');
        $this->db->from('text_messages AS TM');
        $this->db->join('roles AS R', 'R.id = TM.role_id', 'left');
        $this->db->where('TM.id', $param2);
        $sms = $this->db->get()->row();
        if($sms->role_id == 8){
        $table = 'parent';
        $reciverid = 'parent_id';
        }elseif($sms->role_id == 4){
            $table = 'student';
            $reciverid = 'student_id';
        }

?>

<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo $this->lang->line('session_year'); ?></th>
            <td><?php echo $sms->year; ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('receiver_type'); ?></th>
            <td><?php echo $sms->receiver_type; ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('receiver'); ?> <?php echo $this->lang->line('name'); ?></th>
            <td><?php echo  @$this->db->get_where($table,array($reciverid => $sms->receivers))->row()->name;; ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('gateway'); ?></th>
            <td><?php echo $this->lang->line($sms->sms_gateway); ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('sms'); ?></th>
            <td><?php echo $sms->body; ?></td>
        </tr>        
        <tr>
            <th><?php echo $this->lang->line('send'); ?> <?php echo $this->lang->line('time'); ?></th>
            <td><?php echo get_nice_time($sms->created_at); ?></td>
        </tr> 
    </tbody>
</table>
