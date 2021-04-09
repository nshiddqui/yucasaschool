<?php 
	$class_name		= $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
	$section_name  		= $this->db->get_where('section' , array('section_id' => $section_id))->row()->name;
	$system_name        =	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
	$running_year       =	$this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
        if($month == 1) $m = 'January';
        else if($month == 2) $m='February';
        else if($month == 3) $m='March';
        else if($month == 4) $m='April';
        else if($month == 5) $m='May';
        else if($month == 6) $m='June';
        else if($month == 7) $m='July';
        else if($month == 8) $m='August';
        else if($month == 9) $m='Sepetember';
        else if($month == 10) $m='October';
        else if($month == 11) $m='November';
        else if($month == 12) $m='December';
?>
<div id="print">
	<script src="<?php echo base_url('assets/js/jquery-1.11.0.min.js');?>"></script>
	<style type="text/css">
		td {
			padding: 5px;
		}
	</style>
<?php 
$designations = $this->db->get_where('designations', array('id' => $class_id))->result_array();

                     $designations_name = $designations[0]['name'];
?>
	<center>
		<img src="<?php echo base_url('uploads/logo.png');?>" style="max-height : 60px;"><br>
		<h3 style="font-weight: 100;"><?php echo $system_name;?></h3>
		<?php echo get_phrase('attendance_sheet');?><br>
		<?php echo $designations_name;?><br>
        <?php echo $m . ', ' . $sessional_year; ?>
		
	</center>
        
          <table border="1" style="width:100%; border-collapse:collapse;border: 1px solid #ccc; margin-top: 10px;">
                 <thead>
                     <tr>
                        <td style="text-align: center;">
                          <?php echo get_phrase('Employees'); ?> <i class="entypo-down-thin"></i> | <?php echo get_phrase('date'); ?> <i class="entypo-right-thin"></i>
                        </td>
                        <?php
                        $year = explode('-', $running_year);
                        $days = cal_days_in_month(CAL_GREGORIAN, $month, $sessional_year);
                        for ($i = 1; $i <= $days; $i++) {
                          ?><td style="text-align: center;"><?php echo $i; ?></td>
                           <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $data = array();

                     

                     $designations_data = $this->db->get(lcfirst($designations_name))->result_array();

                    $primary_id = lcfirst($designations_name)."_id";

                   
                      foreach ($designations_data as $row):
                           if($row[$primary_id]==$employee){
                    ?>
                    <tr>
                        <td style="text-align: center;">
                        <?php echo $st_name = @$this->db->get_where(lcfirst($designations_name), array($primary_id => $row[$primary_id]))->row()->name; ?>
                        </td>
                        <?php
                            $status      = 0;
                            $bus_status  = 0;
                            $gate_status = 0;
                            $attendence_by_status=0;
                            for ($i = 1; $i <= $days; $i++) {
                                $date = $i . '-' . $month . '-' . $sessional_year;
                               
 
                                $timestamp = strtotime($date);

                                
                                //$this->db->group_by('timestamp');
                                $query = $this->db->get_where('attendance_employee', array( 'designation_id' => $class_id, 'timestamp' => $timestamp, 'employee_id' => $row[$primary_id]));

                               
                                $attendance= $query->result_array();
                                $numberrow = $query->num_rows();
                                $attendence_by_status = 0;
                                $status      = 0;
                                $bus_status  = 0;
                                $gate_status = 0;


                                foreach ($attendance as $row1):
                                    $month_dummy = date('d', $row1['timestamp']);
                                if ($i == $month_dummy)
                                    if($row1['status'] =="" || $row1['status'] == null){
                                        $status = 0;
                                    }
                                    else{
                                        $status = $row1['status'];
                                    }
                                    
                                    if($row1['bus_status'] == "" || $row1['bus_status'] == null){
                                        $bus_status = 0;
                                    }
                                    else{
                                        $bus_status = $row1['bus_status'];
                                    }

                                    if($row1['gate_status'] == "" || $row1['gate_status'] == null){
                                        $gate_status = 0;
                                    }
                                    else{
                                        $gate_status = $row1['gate_status'];
                                    }
                                    $attendence_by_status =  $row1['attendence_by']; 
                                    $attendence_idd=  $row1['attendance_id'];
                                    $employee_id=  $row1['employee_id'];
                                   
                            endforeach;
                        ?>
                        <td style="text-align: center;" attendanceid = "<?php echo $attendence_idd;?>" student_name = "<?php echo  $st_name; ?>" busAtt="<?php echo  $bus_status; ?>" gateAtt="<?php echo  $gate_status; ?>" classAtt="<?php echo  $status; ?>">
                             <?php if ($status == 1 && $bus_status==1 && $gate_status==1) { 

                                if($attendence_by_status == 1) {
                                  echo   ' <i class="entypo-record" style="color: #fad839;"></i>';
                                 
                                }elseif($attendence_by_status == 0){
                                    echo ' <i class="entypo-record" style="color: #00a651;"></i>';
                                }

                                ?>
                               
                               
                             <?php  }else if($status == 2 && $bus_status==2 && $gate_status==2)  { 
                                echo 1;?>
                                <i class="entypo-record" style="color: #ee4749;"></i>
							 <?php }else if($status == 1 && $bus_status!=1 && $gate_status != 1) {?>
							 <i class="entypo-record" style="color: #09B6BD;"></i>
							 <?php }elseif($status != 1 && $bus_status==1 && $gate_status != 1){ ?>
							 <i class="entypo-record" style="color: #e48306;"></i>
							 <?php } elseif($status != 1 && $bus_status==1 && $gate_status == 1){ ?>
							  <i class="entypo-record" style="color: #e48306;"></i>
							  <?php } elseif($status == 1 && $bus_status != 1 && $gate_status == 1){  ?>
							  <i class="entypo-record" style="color: #e48306;"></i>
							   <?php } elseif($status == 1 && $bus_status== 1 && $gate_status != 1){ ?>
							  <i class="entypo-record" style="color: #e48306;"></i>
                             <?php } $status = 0;?>
                        </td>
						
						
                    <?php } ?>
                  
                <?php }
                endforeach; ?>
            </tr>
        <?php ?>
        </tbody>
    </table>
   <center>
</div>



<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		var elem = $('#print');
		PrintElem(elem);
		Popup(data);

	});

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        mywindow.document.write('<html><head><title></title>');
        //mywindow.document.write('<link rel="stylesheet" href="assets/css/print.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        //mywindow.document.write('<style>.print{border : 1px;}</style>');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }
</script>