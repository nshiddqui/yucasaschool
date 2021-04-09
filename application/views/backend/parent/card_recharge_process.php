<?php 
 $card_amount = 0;
 $student_account = $this->db->get_where('student_account' , array(
        'student_id' => $student_id
    ))->result_array();
  if(sizeof($student_account) > 0){
	 foreach ($student_account as $rows):
	 $card_amount= $rows['card_amount'] ;	 
	endforeach;
 }
 $child_of_parent = $this->db->get_where('student' , array(
        'student_id' => $student_id
    ))->result_array();
 if(sizeof($child_of_parent) > 0){
    foreach ($child_of_parent as $row):
 $price = str_replace('₹','',$amount)
 ?>
<div class="row">
<div class="col-md-6 recharge_block ">
	<div class="current_balance row" style="padding:0 15px;">
		<table class="col-md-12">
			<tbody>
				<tr>
					<td class="balance_text" style="width: 70%;"> <span style="font-weight: 700;"><?php echo $row['name'];?> </span> Account Current Balance</td>
					<td class="balance_amount text-right" style="width: 30%">₹ <span> <?php echo $card_amount; ?></span></td>
				</tr>
				<tr>
					<td class="balance_text" style="width: 70%;">Added Balance</td>
					<td class="balance_amount text-right" style="width: 30%">₹ <span> <?php echo $price; ?></span></td>
				</tr>
				
			</tbody>
		</table>
	</div>
	<hr>
	<form method="post"class="recharge_form">
    
	 <div class="add_amount">
		<h4 class="pull-left" style="margin:0;"> Payment Type : </h4> &nbsp;
		
		<!-- <select name="recharge_method" id="recharge_method">
		 	<option value="" >--select--</option>
		 	<option value="1" onChange="if(this.checked){document.forms[0].action='<?php echo base_url('index.php/parents/card_recharge_process/create');?>'}">method one</option>
		 	<option value="1">method one</option>
		 </select>-->
		 <input type="radio" name="collection" value="Offline" onChange="if(this.checked){document.forms[0].action='<?php echo base_url('index.php/parents/card_recharge_process/create');?>'}">Offline Payment 
          <input type="radio" name="collection" value="Paytm" onChange="if(this.checked){document.forms[0].action='https://www.ccavenue.com/shopzone/cc_details.jsp'}">Paytm
          <input type="radio" name="collection" value="CCAvenue" onChange="if(this.checked){document.forms[0].action='https://www.ccavenue.com/shopzone/cc_details.jsp'}">CCAvenue
		 <input type="hidden" name="student_id"  value="<?php echo $student_id;?>">
		<input type="hidden" name="amount"class="amount_input " value="<?php echo $price; ?>">
	 </div>
	 
	<div class="clearfix"></div>
     
	<button type="submit" class="recharge_button">Recharge Now</button>

	</form>



</div>

</div>
<?php endforeach;}?>

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