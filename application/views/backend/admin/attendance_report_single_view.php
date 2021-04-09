<?php 
	$class_name		= $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
	$section_name  		= $this->db->get_where('section' , array('section_id' => $section_id))->row()->name;
	$system_name        =	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
	$running_year       =	$this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
	$m=explode('-',$from);
       
?>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<div id="print" class="">
	<script src="<?php echo base_url('assets/js/jquery-1.11.0.min.js');?>"></script>
	<style type="text/css">
		td {
			padding: 5px;
		}
		.container table th,td{
    border: 2px solid grey;
    min-width: 55px;
    height:38px;
}
	</style>

	<center>
		<img src="<?php echo base_url('uploads/logo.png');?>" style="max-height : 60px;"><br>
		<h3 style="font-weight: 100;"><?php echo $system_name;?></h3>
		<?php echo get_phrase('attendance_sheet');?><br>
		<?php echo get_phrase('class') . ' ' . $class_name;?><br>
		<?php echo get_phrase('section').' '.$section_name;?><br>
        <?php echo $m[1] . ', ' . $sessional_year; ?>
		
	</center>
	
	
	<div class="container">
	    
  <?php
      
                            $data = array();

                            $students = $this->db->get_where('enroll', array('class_id' => $class_id, 'year' => $running_year, 'section_id' => $section_id))->result_array();

                            foreach ($students as $row):
                                if($row['student_id']==$student_id){
                                    
                                    ?>
                                    <h1><?php echo $st_name = @$this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name; ?></h1>
                                    <?php
                            $status = 0;
                            $start    = new DateTime($from);
                            $end      = (new DateTime($to))->modify('+1 day');
                            $interval = new DateInterval('P1D');
                            $period   = new DatePeriod($start, $interval, $end);
                            foreach ($period as $dt) {
                                 $month=explode('-',$dt->format("d-m-Y"));
                                 $date = $month[0] . '-' . $month[1] . '-' . $month[2];
                               
 
                                 $timestamp = strtotime($date);

                                
                                //$this->db->group_by('timestamp');
                                $attendance = $this->db->get_where('attendance', array('section_id' => $section_id, 'class_id' => $class_id,  'timestamp' => $timestamp, 'student_id' => $row['student_id']))->result_array();
                                //print_r($attendance);die;
                                foreach ($attendance as $row1):
                                    $month_dummy = date('m', $timestamp);
                                    if ($month[1] == $month_dummy)
                                     $status = $row1['status'];
                                endforeach;
                                ?>
                                
  <div class="row">
    <div class="col-sm-6" style="background-color:yellow;">
      <p><?php echo $dt->format("d-m"); ?></p>
    </div>
    <div class="col-sm-6" style="background-color:pink;">
      <p><?php if ($status == 1) { ?>Present<?php } else if ($status == 2 || $status == null) { ?>Absent<?php }$status=0; ?></p>
    </div>
  </div>
  

  
  <?php } ?>
    <?php
                                }
    endforeach; ?>
</div>
	
	
		
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