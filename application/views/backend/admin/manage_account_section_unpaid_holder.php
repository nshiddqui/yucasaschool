<?php
$month = isset($_POST['month'])? $_POST['month']:'';
$designation_id = isset($_POST['designation_id'])?$_POST['designation_id']:'';
$session_year = isset($_POST['sessional_year']) ? $_POST['sessional_year'] : '';
if($month == 'all'){
    $datefrm = $session_year . '-01-01';
    $dateto = $session_year . '-12-31';
} else {
    $datefrm = $session_year . '-' . $month .'-01';
    $dateto = $session_year . '-' . $month .'-31';
}
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('accounts');?>
            	</div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <h4 style="font-size:20px;"><strong>STAFF UNPAID SALARY</strong></h4>
                      </div>
            
            <div class="filter_form">
            <?php echo form_open(); ?>
            <div class="row">
            	<div class="col-md-3">
            		<div class="form-group">
            		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('designation');?></label>
            			<select name="designation_id" class="form-control selectboxit" id = "designation_id">
            				<option value=""><?php echo get_phrase('All');?></option>
            				<?php
            				
            					$designation = $this->db->get('designations')->result_array();
            					foreach($designation as $row):
                                                        
            				?>
                                            
            				<option value="<?php echo $row['id'];?>" <?= $designation_id == $row['id']?'selected':'' ?>><?php echo $row['name'];?></option>
                                            
            				<?php endforeach;?>
            			</select>
            		</div>
            	</div>
                <div class="col-md-2">
                         <div class="form-group">
                            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('month'); ?></label>
                            <select name="month" class="form-control selectboxit">
                                <option value="">
                                          Month
                                    </option>
                                <?php
                                for ($i = 1; $i <= 12; $i++):
                                    if ($i == 1)
                                        $m = 'january';
                                    else if ($i == 2)
                                        $m = 'february';
                                    else if ($i == 3)
                                        $m = 'march';
                                    else if ($i == 4)
                                        $m = 'april';
                                    else if ($i == 5)
                                        $m = 'may';
                                    else if ($i == 6)
                                        $m = 'june';
                                    else if ($i == 7)
                                        $m = 'july';
                                    else if ($i == 8)
                                        $m = 'august';
                                    else if ($i == 9)
                                        $m = 'september';
                                    else if ($i == 10)
                                        $m = 'october';
                                    else if ($i == 11)
                                        $m = 'november';
                                    else if ($i == 12)
                                        $m = 'december';
                                    ?>
                                    <option value="<?php echo $i; ?>"
                                          <?php if($month == $i) echo 'selected'; ?>  >
                                                <?php echo get_phrase($m); ?>
                                    </option>
                                    <?php
                                endfor;
                                ?>
                            </select>
                         </div>
                    </div>
                
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('sessional_year'); ?></label>
                            <select class="form-control selectboxit" name="sessional_year">
                                <?php
                                $sessional_year_options = explode('-', $running_year); ?>
                                <option value="<?php echo $sessional_year_options[0]; ?>" <?= $session_year == $sessional_year_options[0] ?'selected' : '' ?>><?php echo $sessional_year_options[0]; ?></option>
                                <option value="<?php echo $sessional_year_options[1]; ?>" <?= $session_year == $sessional_year_options[1] ?'selected' : '' ?> ><?php echo $sessional_year_options[1]; ?></option>
                            </select>
                        </div>
                    </div>
                <div class="col-md-2">
            	    <div class="form-group">
            	        <label class="control-label" style="margin-bottom: 5px;">&nbsp;</label>
            		    <button type="submit" id = "submit" class="btn btn-info btn-block"><?php echo get_phrase('Get Report');?></button>
            		</div>
            	</div>
            
            </div>
            <?php echo form_close();?>
            </div>   

	                        <table id="table_export" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                               
                                <thead>
                                    <tr>
                                        <th>Serial_no</th>
                                     
                                        <th>Name</th>
                                        <th>POST</th>
                                        <th>DOJ</th>
                                                                            
                                        <th>Contact No</th>
                                        <th>Monthly Salary</th>
                                        <th>Total Advance Payment</th>
                                         <th>No of Present</th>
                                     
                                        <th>No of Absent</th>
                                        <th>Total Number of days In Month</th>
                                        <th>Total Payable Monthly Salary</th>
                                        <th>Action</th>
                                      

                                    </tr>
                                </thead>
                                 <?php if(!empty($month) && !empty($session_year)) { 
                                ?>
                                <tbody>   
                                    <?php
                                     if(!empty($designation_id)){
                                         $this->db->where('id',$designation_id);
                                     }
                           $designations = $this->db->get_where('designations')->result_array();
                           $key = 1;
                           foreach($designations as $desg){


                           $class_id = $desg['id'];
                           $designations_name = $desg['name'];
                           $primary_id = lcfirst($designations_name)."_id";
                            if (!$this->db->table_exists(lcfirst($designations_name))){
                                continue;
                            }
                             $this->db->select('*');
                             $this->db->from(lcfirst($designations_name));
                             $query = $this->db->get()->result_array();
                             foreach ($query as $val){

                                     $total_salary_status = $this->db->query("SELECT * FROM employee_total_salary WHERE  `date`  BETWEEN '$datefrm' AND '$dateto' AND designation_id = '$class_id' AND employee_id = '$val[$primary_id]'")->result_array();

                                      if(empty($total_salary_status) || $total_salary_status[0]['status'] == '1') { 
                                            
                                                         ?>
                                                                         
                                        <tr>
                                            <td><?php echo $key;$key++; ?></td>
                                          
                                            <td><?php echo $val['name']; ?></td>                                           
                                            <td><?php echo $designations_name; ?></td>                                           
                                            <td><?php echo $val['doj']; ?> </td>
                                         <td><?php echo $val['phone']; ?> </td>
                                          
                                           <td><?php 

                                           $salary = $this->db->get_where('salary_grades', array('id' => $this->db->get_where('employees',['id'=>$val[$primary_id]])->row()->salary_grade_id))->result_array();
                                             echo $salary[0]['net_salary']; ?> </td>                                           
                                            <td><?php 
                                            $total_advance = $this->db->query("SELECT * ,SUM(amount) as total FROM advance_pay WHERE `date` BETWEEN '$datefrm' AND '$dateto' AND designation_id ='$class_id' AND employee_id = '$val[$primary_id]'")->result_array();


                                             echo $total_advance[0]['total']; ?> </td>                                           
                                            <td><?php $total_present = $this->db->query("SELECT Count(status) as present FROM attendance_employee WHERE `date` BETWEEN '$datefrm' AND '$dateto'  AND designation_id = '$class_id' AND employee_id = '$val[$primary_id]' AND status = '1'")->result_array();

                                            echo $total_present[0]['present']; ?> </td>
                                            <td><?php 
                                             
                                             $total_absent = $this->db->query("SELECT Count(status) as absent FROM attendance_employee WHERE `date` BETWEEN '$datefrm' AND '$dateto'   AND designation_id = '$class_id' AND employee_id = '$val[$primary_id]' AND status = '0'")->result_array();


                                            echo $total_absent[0]['absent']; ?> </td>


                                          
                                            <td><?php 
                                                if(empty($total_salary_status)){
                                                    $dateElements=strtotime($datefrm);
                                            $month=date("m",$dateElements);
                                            $year=date("Y",$dateElements);
                                                }else{
                                               $dateElements = explode('-', $total_salary_status[0]['date']);
                                              $year = $dateElements[0];
                                              $month=$dateElements[1];
                                                }



                                        $number_of_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                                            
                                            echo $number_of_days; ?> </td>
                                            <?php
                                            $time1=strtotime($datefrm);
                                            $month1=date("m",$time1);
                                            $year1=date("Y",$time1);
                                            ?>
                                                                                                                            
                                           <td id="total:<?php echo $val[$primary_id]; ?>" class_id = "<?= $class_id ?>" data-attach = <?= $key ?> contenteditable="true"><?php 
                                             echo (int)$salary[0]['net_salary'] - (int)$total_advance[0]['total'] ?> </td>
                                           <td>
                                               <button type="button" class="markPaid btn btn-primary" data-id = "<?= $key ?>">Mark Paid</button>
                                           </td>


                                        </tr>
                                        <?php } ?>
                                   <?php } ?>
                                 <?php } ?>
                                </tbody>
                                <?php } ?>
                            </table>
                            <?php 
                            $time=strtotime($datefrm);
                            $month=date("m",$time);
                            $year=date("Y",$time);
                            ?>
                            <input type="hidden" id = "year" name="year" value="<?php echo $year; ?>">
                            <input type="hidden" id = "month" name="month" value="<?php echo $month; ?>">

                    
<script>
                            $(".markPaid").click(function(){
                                $(this).attr('disabled',true);
                                 $(this).html('Processing');
                                $this = $('td[data-attach="'+$(this).attr('data-id')+'"]');
                        var class_id = $this.attr('class_id');
                        var month = $("#month").val();
                        var year = $("#year").val();
                        var field_userid = $this.attr("id") ;
                        var res = field_userid.split(":");
                        var user_id = res[1];
                        var advance = $this.text() ;
                                         
                        $.post('<?php echo site_url('admin/update_advance_pay/'); ?>' , {
                        designation_id: class_id,
                        month: month,
                        year: year,
                        user_id:user_id,
                        advance_salary:advance
                        }, function(data){
                            $this.parent('tr').remove();
                        });
                    });
                       </script>
