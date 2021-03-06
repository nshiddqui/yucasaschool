<?php
	$paypal_details = json_decode($this->db->get_where('settings' , array('type'=>'paypal'))->row()->description, true);
	$stripe_details = json_decode($this->db->get_where('settings' , array('type'=>'stripe_keys'))->row()->description, true);

	$paypal_activity = $paypal_details[0]['active'];
	$stripe_activity = $stripe_details[0]['active'];

 ?>
<div class="row">
	<div class="col-md-12">

    	<!---CONTROL TABS START-->
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
					<?php echo get_phrase('invoice/payment_list');?>
                    	</a></li>
		</ul>
    	<!---CONTROL TABS END-->
		<div class="tab-content">
            <!---TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">

                <table  class="table table-bordered datatable" >
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('student');?></div></th>
                    		<th><div><?php echo get_phrase('title');?></div></th>
                    		<th><div><?php echo get_phrase('description');?></div></th>
                    		<th><div><?php echo get_phrase('amount');?></div></th>
                            <th><div><?php echo get_phrase('amount_paid');?></div></th>
                    		<th><div><?php echo get_phrase('status');?></div></th>
                    		<th><div><?php echo get_phrase('date');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php
							/*$student_id = $this->session->userdata('student_id');
							$invoices   = $this->db->get_where('invoice', array( 'student_id' => $student_id ))->result_array();*/
						 foreach($invoices as $row):?>
                        <tr>
							<td><?php echo $this->crud_model->get_type_name_by_id('student',$row['student_id']);?></td>
							<td><?php echo $this->db->get_where('income_heads',array('id' => $row['income_head_id']))->row()->title;?>
                                </td>
							<td><?php echo $row['note'];?></td>
							<td><?php echo $row['gross_amount'];?></td>
                            <td><?php echo $row['net_amount'];?></td>
                            <?php if($row['paid_status'] == 'paid'):?>
                                <td>
                                    <button class="btn btn-success btn-xs"><?php echo get_phrase('paid');?></button>
                                </td>
                            <?php endif;?>
                            <?php if($row['paid_status'] == 'unpaid'):?>
                                <td>
                                    <button class="btn btn-danger btn-xs"><?php echo get_phrase('unpaid');?></button>
                                </td>
                            <?php endif;?>
							<td><?php
                            if($row['date'] != ""){
                                $datedata = strtotime($row['date']);
                                echo date('d M Y', $datedata);
                            } ?></td>
							<!--<td class="col-md-3">-->
							<!--	<div class="row">-->
       <!--                           <div class="col-md-4" style="text-align: center;">-->
       <!--                             <?php echo form_open(site_url('student/paypal_checkout/'.$row['student_id']));?>-->
       <!--                             	<input type="hidden" name="invoice_id" value="<?php echo $row['id'];?>" />-->
       <!--                             		<button type="submit" class="btn btn-info" <?php if($row['paid_status'] == 'paid' || $paypal_activity == 0):?> disabled="disabled"<?php endif;?>>-->
       <!--                                   <span data-toggle="tooltip" title="Paypal"><i class="fa fa-paypal" aria-hidden="true" style="color: #fff;"></i> Paypal</span>-->
       <!--                                 </button>-->
       <!--                             </form>-->
       <!--                           </div>-->
       <!--                           <div class="col-md-4" style="text-align: center;">-->
       <!--                             <?php echo form_open(site_url('student/stripe_checkout/'.$row['student_id']));?>-->
       <!--                             	<input type="hidden" name="invoice_id" value="<?php echo $row['id'];?>" />-->
       <!--                             		<button type="submit" class="btn btn-default" <?php if($row['paid_status'] == 'paid' || $stripe_activity == 0):?> disabled="disabled"<?php endif;?>>-->
       <!--                                         <span data-toggle="tooltip" title="Stripe"><i class="fa fa-cc-stripe" aria-hidden="true" style="color: #fff;"></i> Stripe</span>-->
       <!--                                     </button>-->
       <!--                             </form>-->
       <!--                           </div>-->
       <!--                           <div class="col-md-4" style="text-align: center;">-->
       <!--                             <a href="<?php echo site_url('student/pay_with_payumoney/'.$row['student_id'].'/'.$row['id']);?>" type="button" class="btn btn-success" <?php if($row['paid_status'] == 'paid'):?> disabled="disabled"<?php endif;?>> <span data-toggle="tooltip" title="PayUMoney"><i class="fa fa-dollar" aria-hidden="true" style="color: #fff;"></i> PayUMoney</span> </a>-->
       <!--                           </div>-->
       <!--                 </div>-->
       <!-- 			</td>-->
              </tr>
              <?php endforeach;?>
          </tbody>
      </table>
			</div>
            <!---TABLE LISTING ENDS-->




		</div>
	</div>
</div>
