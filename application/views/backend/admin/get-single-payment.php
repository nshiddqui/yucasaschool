
<?php 
     
        
        if ($param3 == 'driver') {
             
            $this->db->select('SP.*, SG.grade_name, E.name, E.photo, U.email, U.role_id, D.name AS designation, U.status AS login_status ');
            $this->db->from('salary_payments AS SP');
            $this->db->join('employees AS E', 'E.user_id = SP.user_id', 'left'); 
            $this->db->join('salary_grades AS SG', 'SG.id = E.salary_grade_id', 'left');            
            $this->db->join('designation_users AS U', 'U.designation_users_id = E.user_id', 'left');
            $this->db->join('designations AS D', 'D.id = E.designation_id', 'left');          
            $this->db->where('SP.id', $param2);
            $this->db->where('SP.payment_to', 'driver');           
            $payment = $this->db->get()->row();
         }elseif ($param3 =='security-gaurd') {            
            $this->db->select('SP.*, SG.grade_name, E.name, E.photo,  U.email, U.role_id, D.name AS designation, U.status AS login_status ');
            $this->db->from('salary_payments AS SP');
            $this->db->join('employees AS E', 'E.user_id = SP.user_id', 'left'); 
            $this->db->join('salary_grades AS SG', 'SG.id = E.salary_grade_id', 'left');            
            $this->db->join('designation_users AS U', 'U.designation_users_id = E.user_id', 'left');
            $this->db->join('designations AS D', 'D.id = E.designation_id', 'left');          
            $this->db->where('SP.id', $param2);
            $this->db->where('SP.payment_to', 'security-gaurd');           
            $payment = $this->db->get()->row();
            
         }elseif ($param3 == 'warden') {             
            $this->db->select('SP.*, SG.grade_name, E.name, E.photo,  U.email, U.role_id, D.name AS designation, U.status AS login_status ');
            $this->db->from('salary_payments AS SP');
            $this->db->join('employees AS E', 'E.user_id = SP.user_id', 'left'); 
            $this->db->join('salary_grades AS SG', 'SG.id = E.salary_grade_id', 'left');            
            $this->db->join('designation_users AS U', 'U.designation_users_id = E.user_id', 'left');
            $this->db->join('designations AS D', 'D.id = E.designation_id', 'left');          
            $this->db->where('SP.id', $param2);
            $this->db->where('SP.payment_to', 'warden');          
            $payment = $this->db->get()->row();
            
         }elseif ($param3 == 'librarian') {             
            $this->db->select('SP.*, SG.grade_name, E.name, E.email, E.role_id, E.name AS designation');
            $this->db->from('salary_payments AS SP');
            $this->db->join('librarian AS E', 'E.librarian_id = SP.user_id', 'left'); 
            $this->db->join('salary_grades AS SG', 'SG.id = E.salary_grade_id', 'left');            
            $this->db->where('SP.id', $param2);
            $this->db->where('SP.payment_to', 'librarian');
           
            $payment = $this->db->get()->row();
            
         }elseif ($param3 == 'teacher') {            
            $this->db->select('SP.*, SG.grade_name, E.name, E.email, E.role_id, E.name AS designation');
            $this->db->from('salary_payments AS SP');
            $this->db->join('teacher AS E', 'E.teacher_id = SP.user_id', 'left'); 
            $this->db->join('salary_grades AS SG', 'SG.id = E.salary_grade_id', 'left');                          
            $this->db->where('SP.id', $param2);
            $this->db->where('SP.payment_to', 'teacher');
           
            $payment = $this->db->get()->row();
      
         }elseif ($param3 == 'accountant') {             
            $this->db->select('SP.*, SG.grade_name, E.name, E.email, E.role_id, E.name AS designation');
            $this->db->from('salary_payments AS SP');
            $this->db->join('accountant AS E', 'E.accountant_id = SP.user_id', 'left'); 
            $this->db->join('salary_grades AS SG', 'SG.id = E.salary_grade_id', 'left');             
            $this->db->where('SP.id', $param2);
            $this->db->where('SP.payment_to', 'accountant');           
            $payment = $this->db->get()->row();          
         }
?>
<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
		
            <th><?php echo $this->lang->line('month'); ?> </th>
            <td><?php echo date('M ,Y', strtotime('01-'. $payment->salary_month)); ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('grade_name'); ?></th>
            <td><?php echo $payment->grade_name; ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('salary_type'); ?></th>
            <td><?php echo $this->lang->line(strtolower($payment->salary_type)); ?></td>
        </tr>
        
        
        <?php if(strtolower($payment->salary_type) == 'monthly'){ ?>
            <tr>
                <th><?php echo $this->lang->line('basic_salary'); ?> </th>
                <td><?php echo $payment->basic_salary; ?></td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('house_rent'); ?> </th>
                <td><?php echo $payment->house_rent; ?></td>
            </tr>        
            <tr>
                <th><?php echo $this->lang->line('transport'); ?> <?php echo $this->lang->line('allowance'); ?></th>
                <td><?php echo $payment->transport; ?></td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('medical'); ?> <?php echo $this->lang->line('allowance'); ?></th>
                <td><?php echo $payment->medical; ?></td>
            </tr>        
            <tr>
                <th><?php echo $this->lang->line('over_time_hourly_rate'); ?></th>
                <td><?php echo $payment->over_time_hourly_rate; ?></td>
            </tr>        
            <tr>
                <th><?php echo $this->lang->line('over_time_total_hour'); ?></th>
                <td><?php echo $payment->over_time_total_hour; ?></td>
            </tr>        
            <tr>
                <th><?php echo $this->lang->line('over_time_amount'); ?></th>
                <td><?php echo $payment->over_time_amount; ?></td>
            </tr>        
            <tr>
                <th><?php echo $this->lang->line('provident_fund'); ?></th>
                <td><?php echo $payment->provident_fund; ?></td>
            </tr>        
        <?php } ?>
        
        <?php if(strtolower($payment->salary_type) == 'hourly'){ ?>    
            <tr>
                <th><?php echo $this->lang->line('hourly_rate'); ?></th>
                <td><?php echo $payment->hourly_rate; ?></td>
            </tr>   
            <tr>
                <th><?php echo $this->lang->line('total_hour'); ?></th>
                <td><?php echo $payment->total_hour; ?></td>
            </tr>   
         <?php } ?>
            
        <tr>
            <th><?php echo $this->lang->line('bonus'); ?></th>
            <td><?php echo $payment->bonus; ?></td>
        </tr>   
        <tr>
            <th><?php echo $this->lang->line('penalty'); ?></th>
            <td><?php echo $payment->penalty; ?></td>
        </tr>   
             
        <tr>
            <th><?php echo $this->lang->line('total'); ?> <?php echo $this->lang->line('allowance'); ?></th>
            <td><?php echo $payment->total_allowance; ?></td>
        </tr>        
        <tr>
            <th><?php echo $this->lang->line('total'); ?> <?php echo $this->lang->line('deduction'); ?></th>
            <td><?php echo $payment->total_deduction; ?></td>
        </tr>        
        <tr>
            <th><?php echo $this->lang->line('gross_salary'); ?></th>
            <td><?php echo $payment->gross_salary; ?></td>
        </tr>               
        <tr>
            <th><?php echo $this->lang->line('net_salary'); ?></th>
            <td><?php echo $payment->net_salary; ?></td>
        </tr>               
        <tr>
            <th><?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('method'); ?></th>
            <td><?php echo $this->lang->line($payment->payment_method); ?></td>
        </tr>  
        
        <?php if ($payment->payment_method == 'cheque') { ?>
        
            <tr>
                <th><?php echo $this->lang->line('bank'); ?> <?php echo $this->lang->line('name'); ?></th>
                <td><?php echo $payment->bank_name; ?></td>
            </tr>               
            <tr>
                <th><?php echo $this->lang->line('cheque'); ?></th>
                <td><?php echo $payment->cheque_no; ?></td>
            </tr>               
        <?php } ?> 
        
        <tr>
            <th><?php echo $this->lang->line('note'); ?></th>
            <td><?php echo $payment->note; ?></td>
        </tr>               
    </tbody>
</table>
