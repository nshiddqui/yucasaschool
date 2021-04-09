<?php 
  $link = $_SERVER['PHP_SELF'];
    $link_array = explode('/',$link);
  $page = end($link_array);

  $result = $this->db->get_where('salary_payments',array('id'=>$page))->row();
  
  //print_r($result);
  $leave_details = $this->db->get_where('student',array('student_id'=>$result->student_id))->row();
  $leave_detailss = $this->db->get_where('parent',array('parent_id'=>$result->apply_by))->row();
  $teacher_details = $this->db->get_where('teacher',array('teacher_id'=>$result->user_id))->row();


?>

<hr />

<div id="payslip">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<div class="container" style="font-size: 12px;line-height: 1.5;letter-spacing: 0.8px">

    <style>
        .signature::after{
            content: "";
            position: absolute;
            width: 40%;
            height: 100%;
            left: 35%;
            border-bottom: 1px solid #444;

        }
    </style>
    <div class="row " style="margin-top: 20px;">
        <div class="col-xs-10 col-sm-10 col-md-12 col-xs-offset-1 col-sm-offset-1 col-md-offset-0" style="color: #000;">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 company-info">
                    
                    <address>
					<?php echo $settings->type ?>
                        <strong><?php echo $this->db->get_where('settings', array('status'=>1,'type' => 'system_name'))->row()->description; ?></strong>
                        <br>
                     <?php echo $this->db->get_where('settings', array('status'=>1,'type' => 'address'))->row()->description; ?>
                        <br>
                       <?php echo $this->db->get_where('settings', array('status'=>1,'type' => 'system_email'))->row()->description; ?>
                        <br>
                        <abbr title="Phone">P:</abbr> <?php echo $this->db->get_where('settings', array('status'=>1,'type' => 'phone'))->row()->description; ?>
                    </address>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-right date-info">
                    <div class="logo" style="margin-bottom: 15px;">
                        <img src="http://desktop-22kuple/edurama_full/uploads/logo.png" style="max-height:60px;">
                    </div>
                    <p>
                        Date: <?php echo $date = date('d M ,Y '); ?>
                    </p>
                    <p>
                        Payslip Number #:<?php echo $result->id ?>
                    </p>
                </div>
            </div>
            <hr>
			<?php $payment_to= $result->payment_to ?>
			<?php if ($payment_to=='teacher'){?>
            <div class="row ">
                <div class="text-left employee-info col-md-12">
                    <div><strong>Employee Name :</strong>  <span><?php echo $teacher_details->name ?></span> </div>
                    <div><strong>Employee ID : </strong><span><?php echo sprintf("%'.05d\n", $teacher_details->teacher_id); ?></span></div>
                    <div><strong>Designation :</strong>  <span><?php echo $teacher_details->designation ?></span> </div>
                 
                </div>
               
            </div>
			<?php } ?>
            <hr>
            <div class="row">
                <div class="col-md-12 salary-details">
                <table class="table table-bordered ">
                    <thead class="thead-light">
                        <th><strong>Earnings</strong> </th>
                        <th></th>
                        <th><strong>Deductions</strong> </th>
                        <th></th>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Basic & DA</td>
                            <td><?php echo $result->basic_salary ?></td>
                            <td>Penalty </td>
                            <td><?php echo $result->penalty ?></td>
                            
                        </tr>

                        <tr>
                            <td>HRA</td>
                            <td><?php echo $result->medical ?></td>
                            <td>PF</td>
                            <td><?php echo $result->provident_fund ?></td>
                        </tr>

                        <tr>
                            <td>Conveyance</td>
                            <td><?php echo $result->transport ?></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Bonus</td>
                            <td><?php echo $result->bonus ?></td>
                            <td></td>
                            <td></td>
                        </tr>
						    <tr>
                            <td><span>Over Time</span></td>
                            <td><?php echo $result->over_time_amount ?></td>
                            <td></td>
                            <td></td>
                        </tr>
						    <tr>
                            <td><span>Medical</span></td>
                            <td><?php echo $result->medical ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><span>&nbsp;</span></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Total Addition</td>
                            <td><?php echo $result->gross_salary ?></td>
                            <td>Total Deduction</td>
                            <td><?php echo $result->total_deduction ?></td>    
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><strong>Total Salary</strong></td>
                            <td><?php echo $net_salary=$result->net_salary ?></td>
                        </tr>

                    </tbody>
                </table>
                </div>



               
            </div>
            <div class="row">
 <?php
  /**
   * Created by PhpStorm.
   * User: sakthikarthi
   * Date: 9/22/14
   * Time: 11:26 AM
   * Converting Currency Numbers to words currency format
   */
$number = $net_salary;
   $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $resultss = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
  
 ?> 
                    <div class="col-md-12" style="margin-bottom: 5px;"><strong style="text-transform: capitalize;"><?php echo $resultss . "Rupees  " . $points ; ?></strong></div>
                    <div class="col-md-6"><strong>Date</strong> : <?php echo $result->salary_month;?></div>
                    <div class="col-md-6"><strong>Transfer Type</strong> :<?php echo $result->payment_method ?> </div>
                    <div class="col-md-6 col-md-offset-6 signature" style="margin-top: 20px;"><strong>Authorised Signatures</strong></div>

            </div>

        
        </div>
    </div>
</div>
</div>

    <div class="row">
                <div class="col-md-12">
                    <input type='button' id='btn' value='Print' onclick='printDiv();'>
                </div>
            </div>


<script>
    function printDiv() 
{

  var divToPrint=document.getElementById('payslip');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}
</script>