<?php

        $this->db->select('E.*, H.title AS head, E.academic_year_id');
        $this->db->from('expenditures AS E');        
        $this->db->join('expenditure_heads AS H', 'H.id = E.expenditure_head_id', 'left');
       // $this->db->join('academic_years AS AY', 'AY.id = E.academic_year_id', 'left');
        $this->db->where('E.id', $param2); 
        $expenditure =  $this->db->get()->row();  

?>


<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo $this->lang->line('academic_year'); ?></th>
            <td><?php echo $expenditure->academic_year_id; ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('expenditure_head'); ?></th>
            <td><?php echo $expenditure->head; ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('expenditure'); ?> <?php echo $this->lang->line('method'); ?></th>
            <td><?php echo $this->lang->line($expenditure->expenditure_via); ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('amount'); ?></th>
            <td><?php echo $expenditure->amount; ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('expenditure'); ?> <?php echo $this->lang->line('date'); ?></th>
            <td><?php echo $expenditure->date; ?></td>
        </tr> 
        <tr>
            <th><?php echo $this->lang->line('note'); ?></th>
            <td><?php echo $expenditure->note; ?></td>
        </tr> 
    </tbody>
</table>
