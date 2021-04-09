<?php 
   
        $this->db->select('I.*, IH.title AS head, I.year, T.payment_method, T.bank_name, T.cheque_no');
        $this->db->from('invoices AS I');        
        $this->db->join('income_heads AS IH', 'IH.id = I.income_head_id', 'left');
        $this->db->join('transactions AS T', 'T.invoice_id = I.id', 'left'); 
        //$this->db->join('academic_years AS AY', 'AY.id = I.academic_year_id', 'left');
        $this->db->where('I.invoice_type', 'income');
        $this->db->where('I.id', $param2);
        $income =  $this->db->get()->row();   
 
?>


<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo $this->lang->line('academic_year'); ?></th>
            <td><?php echo $income->academic_year_id; ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('income_head'); ?></th>
            <td>

                <?php echo $this->db->get_where('income_heads', array('status'=> 1,'id'=>$income->income_head_id))->row()->title;?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('income'); ?> <?php echo $this->lang->line('method'); ?></th>
            <td><?php echo $this->lang->line($income->payment_method); ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('amount'); ?></th>
            <td><?php echo $income->net_amount; ?></td>
        </tr>
        <?php if($income->payment_method == 'cheque'){ ?>
         <tr>
            <th><?php echo get_phrase('bank_name'); ?></th>
            <td><?php echo $income->bank_name; ?></td>
        </tr> 
        <tr>
            <th><?php echo get_phrase('cheque_no'); ?></th>
            <td><?php echo $income->cheque_no; ?></td>
        </tr> 
        <?php } ?>
        <tr>
            <th><?php echo $this->lang->line('income'); ?> <?php echo $this->lang->line('date'); ?></th>
            <td><?php echo $income->date; ?></td>
        </tr> 
       
        <tr>
            <th><?php echo $this->lang->line('note'); ?></th>
            <td><?php echo $income->note; ?></td>
        </tr> 
    </tbody>
</table>
