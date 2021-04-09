<?php 
        $this->db->select('E.*, U.email, U.role_id, R.name AS role, D.name AS designation, SG.grade_name');
        $this->db->from('employees AS E');
        $this->db->join('designation_users AS U', 'U.designation_users_id = E.user_id', 'left');
        $this->db->join('roles AS R', 'R.id = U.role_id', 'left');
        $this->db->join('designations AS D', 'D.id = E.designation_id', 'left');
        $this->db->join('salary_grades AS SG', 'SG.id = E.salary_grade_id', 'left');
        $this->db->where('E.id', $param2);
        $employee    = $this->db->get()->row();

?>

<div class="" data-example-id="togglable-tabs">
    <ul  class="nav nav-tabs bordered">
        <li class="active"><a href="#tab_basic_info"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-info-circle"></i> <?php echo $this->lang->line('basic'); ?> <?php echo $this->lang->line('information'); ?></a> </li>
    </ul>
    <br/>
    
     <div class="tab-content">
        <div  class="tab-pane fade in active" id="tab_basic_info" > 
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <th><?php echo $this->lang->line('name'); ?></th>
                        <td><?php echo $employee->name; ?></td>        
                        <th><?php echo $this->lang->line('national_id'); ?></th>
                        <td><?php echo $employee->national_id; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $this->lang->line('designation'); ?></th>
                        <td><?php echo $employee->designation; ?></td>        
                        <th><?php echo $this->lang->line('phone'); ?></th>
                        <td><?php echo $employee->phone; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $this->lang->line('present'); ?> <?php echo $this->lang->line('address'); ?></th>
                        <td><?php echo $employee->present_address; ?></td>        
                        <th><?php echo $this->lang->line('permanent'); ?> <?php echo $this->lang->line('address'); ?></th>
                        <td><?php echo $employee->permanent_address; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $this->lang->line('gender'); ?></th>
                        <td><?php echo $this->lang->line($employee->gender); ?></td>       
                        <th><?php echo $this->lang->line('blood_group'); ?></th>
                        <td><?php echo $this->lang->line($employee->blood_group); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $this->lang->line('religion'); ?></th>
                        <td><?php echo $employee->religion; ?></td>       
                        <th><?php echo $this->lang->line('birth_date'); ?></th>
                       <!--  <td><?php echo date($this->gsms_setting->sms_date_format, strtotime($employee->dob)); ?></td> -->
                        <td><?php echo $employee->dob; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $this->lang->line('join_date'); ?></th>
                       <!--  <td><?php echo date($this->gsms_setting->sms_date_format, strtotime($employee->joining_date)); ?></td>  -->  <td><?php echo $employee->joining_date; ?></td>       
                        <th><?php echo $this->lang->line('role'); ?></th>
                        <td><?php echo $employee->role; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $this->lang->line('salary_grade'); ?></th>
                        <td><?php echo $employee->grade_name; ?></td>        
                        <th><?php echo $this->lang->line('salary_type'); ?></th>
                        <td><?php echo $this->lang->line($employee->salary_type); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $this->lang->line('email'); ?></th>
                        <td><?php echo $employee->email; ?></td>        
                        <th><?php echo $this->lang->line('other_info'); ?></th>
                        <td><?php echo $employee->other_info; ?></td>
                    </tr>

                    <tr>
                        <th><?php echo $this->lang->line('photo'); ?></th>
                        <td>
                            <?php if($employee->photo){ ?>
                                <img src="<?php echo UPLOAD_PATH; ?>/employee-photo/<?php echo $employee->photo; ?>" alt="" width="70" />
                            <?php } ?>        
                        </td>
                    </tr>                    

                </tbody>
            </table>
        </div>
    </div>
</div>
