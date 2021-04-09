
<?php   $this->db->select('*');
   $feetype = $this->db->get_where('income_heads', array('id' => $param2))->row();
   
?>
<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo $this->lang->line('fee_type'); ?> <?php echo $this->lang->line('title'); ?></th>
            <td><?php echo $feetype->title; ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('class'); ?></th>
            <th><?php echo $this->lang->line('fee'); ?> <?php echo $this->lang->line('amount'); ?></th>
        </tr>
        <?php 
           
        $this->db->select('*');
        $classes = $this->db->get_where('fees_amount', array('income_head_id' => $feetype->id))->result();
        

        foreach($classes as $obj){ ?>
        <?php 
       
        $fee_amount = $this->db->get_where('fees_amount', array('class_id'=>$obj->class_id, 'income_head_id'=>$feetype->id))->row();?>
            <tr>
                <th><?php echo $this->lang->line('class'); ?> <?php echo @$this->db->get_where('class', array('class_id'=>$obj->class_id))->row()->name; ?></th>
                <td><?php echo @$fee_amount->fee_amount; ?></td>
            </tr>
        <?php } ?>       
        <tr>
            <th><?php echo $this->lang->line('note'); ?></th>
            <td><?php echo $feetype->note; ?>   </td>
        </tr>
    </tbody>
</table>
