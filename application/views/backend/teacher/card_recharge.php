<div class="row">
<div class="col-md-6 recharge_block ">
	<div class="current_balance row" style="padding:0 15px;">
		<table class="col-md-12">
			<tbody>
				<tr>
					<td class="balance_text" style="width: 70%;">Your Current Balance</td>
					<td class="balance_amount text-right" style="width: 30%">₹ <span>370</span></td>
				</tr>
			</tbody>
		</table>
	</div>
	<hr>
	<form action="" class="recharge_form">

	<div class="quick_recharge">
		<h4>Quick Recharge</h4>
		<div class="row">
			<ul class="recharge_list">
				<li>
					₹ 99
				</li>
				<li>
					₹ 199
				</li>
				<li>
					₹ 299
				</li>
				<li>
					₹ 499
				</li>
			</ul>
		</div>
	</div>
	<p class="class_or">or</p>
	<div class="add_amount">
		<h4 class="pull-left" style="margin:0;">Add Amount : </h4> &nbsp;
		 <input type="text" class="amount_input" >
	</div>
	<div class="clearfix"></div>

	<button type="submit" class="recharge_button">Recharge Now</button>

	</form>



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