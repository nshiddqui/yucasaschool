<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo $this->lang->line('academic_year'); ?></th>
            <td><?php echo $income->session_year; ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('income_head'); ?></th>
            <td><?php echo $income->head; ?></td>
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
            <th><?php echo $this->lang->line('bank_name'); ?></th>
            <td><?php echo $income->bank_name; ?></td>
        </tr> 
        <tr>
            <th><?php echo $this->lang->line('cheque_no'); ?></th>
            <td><?php echo $income->cheque_no; ?></td>
        </tr> 
        <?php } ?>
        <tr>
            <th><?php echo $this->lang->line('income'); ?> <?php echo $this->lang->line('date'); ?></th>
            <td><?php echo date($this->gsms_setting->sms_date_format, strtotime($income->date)); ?></td>
        </tr> 
       
        <tr>
            <th><?php echo $this->lang->line('note'); ?></th>
            <td><?php echo $income->note; ?></td>
        </tr> 
    </tbody>
</table>
