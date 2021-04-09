
<?php 
//date_default_timezone_set('Asia/Kolkata');
$timenow = date('d-m-Y');
$timestamp = strtotime($timenow);


 $this->db->select('*');
 $this->db->from('attendance');
 $this->db->where('timestamp', $timestamp); //For current month
 $this->db->where("status = '1' ");
 $monthly_parsent = $this->db->get()->result();
 $daily_parsent_val = count($monthly_parsent);      

$timenowday = date('d-m-Y');
$days= date('l', strtotime($timenowday));
 $this->db->select('*');
 $this->db->from('emp_attendance');
 $this->db->where('timestamp', $timestamp); //For current month
 $this->db->where("status = '1' ");
 $monthly_parsent = $this->db->get()->result();
 $daily_parsent_teacher = count($monthly_parsent);      
 

 $today = strtolower(date("l"));
         
 ?>
<section class="footer_bg_block">

  <div class="bottom-block text-center">

    <div class="bottom-item bi-yellow">
    <a href="<?php echo base_url();?>index.php/admin/manage_attendance" class="text-white">
      <div class="bottom-item-value"><span class="bottom-value-counter" data-toggle="counter" data-end="<?php echo $daily_parsent_val;?>"><?php echo $daily_parsent_val;?></span>
        <div class="bottom-value-title">Students Present Today</div>
      </div>
    </a>
    </div>

    <div class="bottom-item bi-blue">
    <a href="<?php echo base_url();?>index.php/admin/teacher_manage_attendance" class="text-white">
      <div class="bottom-item-value"><span class="bottom-value-counter" data-toggle="counter" data-end="<?php echo $daily_parsent_teacher ?> "><?php echo $daily_parsent_teacher ?> </span>
        <div class="bottom-value-title">Teachers Present Today</div>
      </div>
    </a>
    </div>
   
    <div class="bottom-item bi-pink">
    <a href="<?php echo base_url();?>index.php/admin/class_dailytimetable" class="text-white">
      <div class="bottom-item-value"><span class="bottom-value-counter" data-toggle="counter" data-end="1646">
      <?php 
        $this->db->select('C.* ');
        $this->db->from('class_routine AS C');
        $this->db->join('emp_attendance AS E', 'E.emp_id = C.teacher_id', 'left');
        $this->db->where('E.role_id', 5);
        $this->db->where('E.timestamp', $timestamp);
        $this->db->where('E.status',NULL);
        $this->db->where('C.day',$days);
        $query = $this->db->get();
        echo  $query->num_rows();
      ?>
       </span>
        <div class="bottom-value-title">Substitution Required</div>
      </div>
     </a>
    </div>

    <div class="bottom-item bi-navblue">
      <div class="bottom-item-value"><span class="bottom-value-counter" data-toggle="counter" data-end="1646"><?php  
         $timenow1 = date('G:i');
        $timestamp1 = strtotime($timenow1);
        $template_val = $this->db->query("select * from class_routine_template where status=1 LIMIT 1"  )->result();
        foreach($template_val as $dtt){
           $template_id = $dtt->id;
           $total = $dtt->numberofperiod;
           $current_period = $this->db->query("select * from class_routine where template_id='$template_id'  AND day ='$today' AND time_start>='$timenow1' AND time_end <='$timenow1'")->row_array();
     print_r($current_period);
          
  
                 foreach ($current_period  as $key => $ass_mark) {
                 $time_start=$ass_mark->time_start;
                 $date = date('d-m-Y', $time_start);
                 $time = date('G:i:s', $time_start);
                     if( $timenow1 >=$time ){
                         if($ass_mark->time_start == ""){
                            $class_period = $ass_mark->period;
                         }
                 
                      } else{ ' <h4 style="color: white;text-transform: uppercase;font-size:1vw;font-weight: 600;">School Closed</h4>';
                }
                

           }

         } ?>  <?php if ($class_period ==''){  $total;} ?> 4 /<?php echo $total ?></span>
        <div class="bottom-value-title">Current Preiod</div>
      </div>
    </div>

  </div>

</section>