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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url('assets/js/jquery-1.11.0.min.js');?>"></script>
	<style type="text/css">
		td {
			padding: 5px;
		}
	</style>

	<center>
		<img src="<?php echo base_url('uploads/logo.png');?>" style="max-height : 60px;"><br>
		<h3 style="font-weight: 100;"><?php echo $system_name;?></h3>
		<?php echo get_phrase('attendance_sheet');?><br>
		<?php echo get_phrase('class') . ' ' . $class_name;?><br>
		<?php echo get_phrase('section').' '.$section_name;?><br>
        <?php echo $m . ', ' . $sessional_year; ?>
		
	</center>
        <?php
        $date1 = strtotime($from);
$date2 = strtotime($to);
        $start    = new DateTime($from);
                            $end      = (new DateTime($to))->modify('+1 month');
                            $interval = new DateInterval('P1D');
                            $period   = new DatePeriod($start, $interval, $end);
                            while ($date1 <= $date2) {
                                $date= date('d-m-Y', $date1); 
                                $date_last=date("t-m-Y", strtotime($date));
                                
                                 $date_first=(new DateTime($date))
      ->modify('first day of this month')
      ->format('d-m-Y');
        ?>
          <table border="1" style="width:100%; border-collapse:collapse;border: 1px solid #ccc; margin-top: 10px;">
                <thead>
                    <tr>
                        <td style="text-align: center;">
    <?php echo get_phrase('students'); ?> <i class="entypo-down-thin"></i> | <?php echo get_phrase('date'); ?> <i class="entypo-right-thin"></i>
                        </td>
    <?php
    $status = 0;
                            $start    = new DateTime($date_first);
                            $end      = (new DateTime($date_last))->modify('+1 day');
                            $interval = new DateInterval('P1D');
                            $period   = new DatePeriod($start, $interval, $end);
                            foreach ($period as $dt) {
        ?>
                            <td style="text-align: center;"><?php echo $dt->format("d-m"); ?></td>
                    <?php } ?>

                    </tr>
                </thead>

                <tbody>
                            <?php
                            $data = array();

                            $students = $this->db->get_where('enroll', array('class_id' => $class_id, 'year' => $running_year, 'section_id' => $section_id))->result_array();

                            foreach ($students as $row):
                                ?>
                        <tr>
                            <td style="text-align: center;">
                            <?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name; ?>
                            </td>
                            <?php
                            $status = 0;
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
                                <td style="text-align: center;" data-class="">
            <?php if ($status == 1) { ?>
                                    <div style="color: #00a651">P</div>
                            <?php } else if ($status == 2 || $status == null) { ?>
                                    <div style="color: #ff3030">A</div>
            <?php }$status=0; ?>
                                </td>

        <?php } ?>
    <?php endforeach; ?>

                    </tr>

    <?php ?>

                </tbody>
            </table>
            <?php $date1 = strtotime('+1 month', $date1); } ?>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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