<?php   $this->db->select('E.*, R.name AS receiver_type ');
        $this->db->from('emails AS E');
        $this->db->join('roles AS R', 'R.id = E.role_id', 'left');
       // $this->db->join('academic_years AS AY', 'AY.id = E.academic_year_id', 'left');
        $this->db->where('E.id', $param2);
        $email =   $this->db->get()->row();    
        ?>

<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo $this->lang->line('session_year'); ?></th>
            <td><?php echo $email->academic_year_id; ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('receiver_type'); ?></th>
            <td><?php echo $email->receiver_type; ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('receiver'); ?> <?php echo $this->lang->line('name'); ?></th>
            <td><?php echo $email->receivers; ?></td>
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
