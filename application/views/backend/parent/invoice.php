<?php //print_r($_SESSION);
    $paypal_details = json_decode($this->db->get_where('settings' , array('type'=>'paypal'))->row()->description, true);
    $stripe_details = json_decode($this->db->get_where('settings' , array('type'=>'stripe_keys'))->row()->description, true);

    $paypal_activity = $paypal_details[0]['active'];
    $stripe_activity = $stripe_details[0]['active'];

    // $child_of_parent = $this->db->get_where('student' , array(
    //     'student_id' => $student_id
    // ))->result_array();
    // foreach ($child_of_parent as $row):
?>

<?php $activeTab = "payment"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Student Card</a></li>
        <li class="active">Payment List</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/parent/fees_mgmt_recharge_nav_tab.php'; ?>
<!-- Including Navigation Tab -->
</div>

<div class="student_select_filter">
    <div class="row">
        <div class="col-sm-4  ">
            <div class="form-group">
                <label>Select Student : </label>
                <select class="select2 student_select" onchange="window.location.href = '<?= base_url('parents/invoice/')?>'+this.value+'<?= (isset($_GET['title'])?'?title='.$_GET['title']:'')?>';">
                    <option value="">Select Student</option>
                     <?php
                    $class_id= $this->uri->segment(3);
                   //$children_of_parent = $this->db->get_where('student' , array('parent_id' => $this->session->userdata('parent_id')))->result_array();
                  $parent_id= $this->session->userdata('parent_id');
                   $children_of_parent= $this->db->query("SELECT * FROM student LEFT JOIN enroll ON student.student_id=enroll.student_id where student.parent_id=$parent_id AND year='$running_year'")->result_array();
                    ;
                      foreach ($children_of_parent as $row):
                   ?>
                              <option value="<?php echo $row['student_id'];?>"<?php if($row['student_id'] == $student_id){echo 'selected';} ?>><?php echo $row['name'];?></option>
                        <?php endforeach;?>  
                   
                   
                </select>
            </div>
        </div>
        
        <div class="col-sm-4 pull-right">
            <div class="label label-info pull-right" style="font-size: 14px;">
            <i class="entypo-user"></i> <?php echo $row['name'];?>
        </div>
        </div>
    </div>
    
</div>





<div class="row">
    <div class="col-md-12">
        <h3><?= ucwords((isset($_GET['title'])?$_GET['title']:'paid')) ?></h3>
    </div>
	<div class="col-md-12">

    	<!------CONTROL TABS END------>
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">

                <table  class="table table-bordered datatable" kl>
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('student');?></div></th>
                    		<th><div><?php echo get_phrase('month');?></div></th>
                    		<th><div><?php echo get_phrase('description');?></div></th>
                    		<th><div><?php echo get_phrase('amount');?></div></th>
                            <th><div><?php echo get_phrase('amount_paid');?></div></th>
                    		<th><div><?php echo get_phrase('status');?></div></th>
                    		<th><div><?php echo get_phrase('date');?></div></th>
                    		
						</tr>
					</thead>
                    <tbody>
                    	<?php
                    	
                    	
                    	
                    	$option = array();
                    	if(isset($student_id)){
                    	    $option['student_id'] = $student_id;
                    	}
                    	if(isset($_GET['title'])){
                    	    $option['paid_status'] = $_GET['title'];
                    	}
                    	if(!empty($student_id)){
                    	    $option['student_id'] = $student_id;
                    	}

                            $invoices = $this->db->get_where('invoices' ,$option)->result_array();
                            foreach($invoices as $row2):
                        ?>
                        <tr>
							<td><?php echo $this->crud_model->get_type_name_by_id('student',$row2['student_id']);?></td>
							<!--<td><?php echo $this->db->get_where('income_heads',array('id' => $row2['income_head_id']))->row()->title;?></td>-->
							<td><?php
							echo $month=date("F",$row2['date']);
							//$arr=explode('-',$row2['date']);?></td>
							<td><?php echo $row2['note'];?></td>
							<td><?php echo $row2['gross_amount'];?></td>
                            <td><?php echo $row2['net_amount'];?></td>

                            <?php if($row2['paid_status'] == 'paid'):?>
                                <td>
                                    <button class="btn btn-success btn-xs"><?php echo get_phrase('paid');?></button>
                                </td>
                            <?php endif;?>
                            <?php if($row2['paid_status'] == 'unpaid'):?>
                                <td>
                                    <button class="btn btn-danger btn-xs"><?php echo get_phrase('unpaid');?></button>
                                </td>
                            <?php endif;?>
							<td><?php echo $row2['date'];?></td>
							<td class="col-md-3">
                <div class="row">
                  <div class="col-md-4" style="text-align: center;">
                  <!--   <?php echo form_open(site_url('parents/paypal_checkout/'. $row['student_id']));?>
                    	<input type="hidden" name="invoice_id" value="<?php echo $row2['id'];?>" />
                    		<button type="submit" class="btn btn-info" <?php if($row2['paid_status'] == 'paid' || $paypal_activity == 0):?> disabled="disabled"<?php endif;?>>
                                <span data-toggle="tooltip" title="Paypal"><i class="fa fa-paypal" aria-hidden="true" style="color: #fff;"></i> Paypal</span>
                            </button>
                    </form> -->
                    <!-- <button type="submit" class="btn btn-info" <?php if($row2['paid_status'] == 'paid' || $paypal_activity == 0):?> disabled="disabled"<?php endif;?>>
                                <span data-toggle="tooltip" title="Paypal"><i class="fa fa-paypal" aria-hidden="true" style="color: #fff;"></i> Paypal</span>
                            </button>-->
                  </div>

                  <!-- <div class="col-md-4" style="text-align: center;">
                    <?php echo form_open(site_url('parents/stripe_checkout/'.$row['student_id']));?>
                    	<input type="hidden" name="invoice_id" value="<?php echo $row2['id'];?>" />
                    		<button type="submit" class="btn btn-default" <?php if($row2['paid_status'] == 'paid' || $stripe_activity == 0):?> disabled="disabled"<?php endif;?>>
                                <span data-toggle="tooltip" title="Stripe"><i class="fa fa-cc-stripe" aria-hidden="true" style="color: #fff;"></i> Stripe</span>
                            </button>
                    </form>
                  </div>
                  <div class="col-md-4" style="text-align: center;">
                    <a href="<?php echo site_url('parents/pay_with_payumoney/'.$row['student_id'].'/'.$row2['id']);?>" type="button" class="btn btn-success" <?php if($row2['paid_status'] == 'paid'):?> disabled="disabled"<?php endif;?>> <span data-toggle="tooltip" title="PayUMoney"> <i class="fa fa-dollar" aria-hidden="true" style="color: #fff;"></i> PayUMoney</span> </a>
                  </div>
                </div> -->
              </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS-->




		</div>
	</div>
</div>
<?php //endforeach;?>
