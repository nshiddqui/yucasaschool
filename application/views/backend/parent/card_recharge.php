<?php $activeTab = "student_card"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Student Card</a></li>
        <li class="active">Card Recharge</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/parent/fees_mgmt_recharge_nav_tab.php'; ?>
<!-- Including Navigation Tab -->
</div>
<div class="row">
<?php 

$now = time(); // or your date as well
$your_date = strtotime("2018-12-01");
$datediff = $now - $your_date;

// echo round($datediff / (60 * 60 * 24));

$card_amount ="0";


 $student_account = $this->db->get_where('student_account' , array(
        'student_id' => $student_idd
    ))->result_array();
  if(sizeof($student_account) > 0){
	 foreach ($student_account as $rows):
	 $card_amount= $card_amount+$rows['card_amount'] ;	 
	endforeach;
 }
?>

<?php
 $child_of_parent = $this->db->get_where('student' , array(
        'student_id' => $student_idd
    ))->result_array();
 if(sizeof($child_of_parent) > 0){
    foreach ($child_of_parent as $row):

?>

<div class="col-md-8 recharge_block ">
	<div class="current_balance row" style="padding:0 15px;">
		<table class="col-md-12">
			<tbody>
				<tr>
					<td class="balance_text" style="width: 70%;"> <span style="font-weight: 700;"><?php echo $row['name'];?> </span> Account Current Balance</td>
					<td class="balance_amount text-right" style="width: 30%">₹ <span> <?php echo $card_amount; ?></span></td>
				</tr>
			</tbody>
		</table>
	</div>
	<hr>
	<form action="<?php echo base_url('index.php/parents/card_recharge_process');?>"  method="post"class="recharge_form">

	<div class="quick_recharge">
		<h4>Quick Recharge</h4>
		<div class="row">
			<ul class="recharge_list">
				<li>₹ 100</li>
				<li>₹ 200</li>
				<li>₹ 300</li>
				<li>₹ 500</li>
			</ul>
		</div>
	</div>
	<p class="class_or">or</p>
	<div class="add_amount">
		<h4 class="pull-left" style="margin:0;">Add Amount : </h4> &nbsp;
		 <input type="text" name="amount" id="amount_input" class="amount_input" >
		 <input type="hidden" name="student_id" value="<?php echo $row['student_id'];?>">
	</div>
	<div class="clearfix"></div>
     
	<button type="submit" class="recharge_button">Recharge Now</button>

	</form>
<script>
$('li').click(function(){
    $('#amount_input').val($(this).text());
	
});
</script>


</div>
<?php endforeach;}?>

<div class="col-sm-12">
    <div class="student_select_filter">
        <div class="row">
            <div class="col-sm-4  ">
                <div class="form-group">
                    <label>Select Student : </label>
                    <select class="select2 student_select">
                        <option value="">Select Student</option>
                         <?php
                        $class_id= $this->uri->segment(3);
                       //$children_of_parent = $this->db->get_where('student' , array('parent_id' => $this->session->userdata('parent_id')))->result_array();
                      $parent_id= $this->session->userdata('parent_id');
                       $children_of_parent= $this->db->query("SELECT * FROM student LEFT JOIN enroll ON student.student_id=enroll.student_id where student.parent_id=$parent_id AND year='$running_year'")->result_array();
                        ;
                          foreach ($children_of_parent as $row):
                       ?>
                                  <option value="<?php echo $row['class_id'];?>"<?php if($row['class_id'] == $class_id){echo 'selected';} ?>><?php echo $row['name'];?></option>
                            <?php endforeach;?>  
                       
                       
                    </select>
                </div>
            </div>
        </div>
        
    </div>
</div>
<div class="col-md-12 recharge_block ">
<div class="tab-pane box active" id="list">
				
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
				
				<div class="row">
				<div class="col-sm-12">
				<!--<h2 style="text-align: center;font-size: 18px;">Account Transaction Report</h2>-->
				<table class="table table-bordered datatable dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                	<thead>
                		<tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="S No: activate to sort column descending" style="width: 39px;">
						<div>S No</div></th>
						<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Examination Date &amp;amp; Day: activate to sort column ascending" style="width: 163px;"><div>Date &amp; Day</div></th>
						<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Examination Time: activate to sort column ascending" style="width: 126px;"><div>Credit Amount</div></th>
						<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Exam Name: activate to sort column ascending" style="width: 111px;"><div>Account Payer</div></th>
						<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Room No: activate to sort column ascending" style="width: 68px;"><div>Method</div></th>
						<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Subject: activate to sort column ascending" style="width: 57px;"><div>Available Amount</div></th>
						</thead>
                    <tbody>
                                            
                                            
                                            
                            <?php
                            $i=1;
							foreach($trans as $obj){ ?>
							<tr role="row" class="odd">
							<td class="sorting_1"><?php echo $i; ?></td>
							<td><?php echo $obj->date; ?></td>
                            <td><?php echo $obj->credit; ?></td>
							<td><?php echo $obj->account; ?> </td>
							<td><?php echo $obj->method; ?></td>
							<td><?php echo $obj->balance; ?></td>
                            </tr>
							 <?php $i++; } ?>
						</tbody>
                </table>
				</div>
				</div>
				
				</div>
			</div>


</div>




</div>




<script>

	$('.recharge_list li').click(function(){

		$('.recharge_list li').each(function(){
						
			$(this).removeClass('rechargeActive');
		
		});

		if($(this).hasClass('rechargeActive')){
			$(this).removeClass('rechargeActive');
		}

		else{
			$(this).addClass('rechargeActive');

		}

	});

	$('.amount_input').click(function(){
		$('.recharge_list li').each(function(){
						
			$(this).removeClass('rechargeActive');
		
		});
	});


</script>