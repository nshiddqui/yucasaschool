<?php $activeTab = "payroll"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Payroll</a></li>
        <li class="active">History</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php //include base_path().'application/views/backend/navigation_tab/accounts_payroll_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-dollar"></i><small> <?php echo $this->lang->line('manage'); ?> <?php echo $this->lang->line('payroll'); ?> <?php echo $this->lang->line('history'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content"> 
                <?php echo form_open_multipart(site_url('payroll/history/index'), array('name' => 'payment', 'id' => 'payment', 'class' => 'form-horizontal form-label-left'), ''); ?>
                <div class="row">
                  
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo $this->lang->line('role'); ?> <?php echo $this->lang->line('type'); ?> <span class="required"> *</span></div>
                            <select  class="form-control col-md-7 col-xs-12"  name="payment_to"  id="payment_to" onchange="get_user_list(this.value);" required="required">
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                              <option value="driver" <?php if(isset($payment_to) && $payment_to == 'driver'){ echo 'selected="selected"'; } ?>><?php echo $this->lang->line('driver'); ?></option>
                                <option value="teacher" <?php if(isset($payment_to) && $payment_to == 'teacher'){ echo 'selected="selected"'; } ?>><?php echo $this->lang->line('teacher'); ?></option>
                                <option value="librarian" <?php if(isset($payment_to) && $payment_to == 'librarian'){ echo 'selected="selected"'; } ?>><?php echo $this->lang->line('librarian'); ?></option>
                                <option value="accountant" <?php if(isset($payment_to) && $payment_to == 'accountant'){ echo 'selected="selected"'; } ?>><?php echo $this->lang->line('accountant'); ?></option>
                                <option value="warden" <?php if(isset($payment_to) && $payment_to == 'warden'){ echo 'selected="selected"'; } ?>><?php echo $this->lang->line('warden'); ?></option>
                                <option value="security-gaurd" <?php if(isset($payment_to) && $payment_to == 'security-gaurd'){ echo 'selected="selected"'; } ?>><?php echo $this->lang->line('security-gaurd'); ?></option>
                            </select>
                            <div class="help-block"><?php echo form_error('type'); ?></div>
                        </div>
                    </div>  
                    
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo $this->lang->line('payment_to'); ?></div>
                            <select  class="form-control col-md-12 col-xs-12"  name="user_id"  id="user_id" >
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                         
                            </select>
                            <div class="help-block"><?php echo form_error('user_id'); ?></div>
                        </div>
                    </div> 
                
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group"><br/>
                            <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('find'); ?></button>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            			
			<script>
			function get_user_list(payment_to, user_id){
        
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_user_list_by_type'); ?>",
            data   : { payment_to : payment_to, user_id : user_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                //alert(response);
                   $('#user_id').html(response); 
               }
            }
        }); 
   }   
</script> 
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_grade_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('list'); ?></a> </li>
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_grade_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                       <!-- <th><?php echo $this->lang->line('photo'); ?></th>       -->                                                             
                                        <th><?php echo $this->lang->line('name'); ?></th>
                                        <th><?php echo $this->lang->line('month'); ?></th>
                                        <th><?php echo $this->lang->line('grade_name'); ?></th>
                                        <th><?php echo $this->lang->line('salary_type'); ?></th>
                                        <th><?php echo $this->lang->line('total'); ?> <?php echo $this->lang->line('allowance'); ?></th>
                                        <th><?php echo $this->lang->line('total'); ?> <?php echo $this->lang->line('deduction'); ?></th>
                                        <th><?php echo $this->lang->line('gross_salary'); ?></th>
                                        <th><?php echo $this->lang->line('net_salary'); ?></th>
                                        <th><?php echo $this->lang->line('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($payments) && !empty($payments)){ ?>
                                        <?php foreach($payments as $obj){ ?>
                                        <?php
                                        $path = '';
                                        if($payment_to == 'teacher'){ $path = 'teacher'; }                                           
                                        else{ $path = 'employee'; }
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <!--<td>
                                                  <?php if ($obj->photo != '') { ?>                                        
                                                      <img src="<?php echo UPLOAD_PATH; ?>/<?php echo $obj->payment_to; ?>-photo/<?php echo $obj->photo; ?>" alt="" width="60" /> 
                                                  <?php } else { ?>
                                                      <img src="<?php echo IMG_URL; ?>/default-user.png" alt="" width="60" /> 
                                                  <?php } ?>
                                            </td>-->
                                            <td><?php echo ucfirst($obj->name); ?></td>
                                            <td><?php echo date('M, Y', strtotime('1-'.$obj->salary_month)); ?></td>
                                            <td><?php echo $obj->grade_name; ?></td>
                                            <td><?php echo $obj->salary_type; ?></td>
                                            <td><?php echo $obj->total_allowance; ?></td>
                                            <td><?php echo $obj->total_deduction; ?></td>
                                            <td><?php echo $obj->gross_salary; ?></td>
                                            <td><?php echo $obj->net_salary; ?></td>
                                            <td>
                                                <?php if(has_permission(VIEW, 'payroll', 'history')){ ?>
                                                    <!-- <a href="javascript:void(0);" class="btn btn-success btn-xs" onclick="getPaymentModal(<?php echo $obj->id; ?>, '<?php echo $obj->payment_to; ?>');"  data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> </a> -->

                                               <a href="javascript:void(0);" class="btn btn-success btn-xs" onclick='showAjaxModal("<?php echo site_url()?>/modal/popup/get-single-payment/<?php echo $obj->id; ?>/<?=$obj->payment_to; ?>");'><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> </a>
                                                    
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                        
                                </tbody>
                            </table>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function getPaymentModal(payment_id,payment_to){
         
         $('.modal-body').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo base_url();?>assets/images/loading.gif" /></p>');
          $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('payroll/history/get_single_payment'); ?>",
            data   : {payment_id : payment_id, payment_to : payment_to},  
            success: function(response){                                                   
               if(response)
               {
                  $('.modal-body').html(response);
               }
            }
         });
    }
</script>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">??</span></button>
          <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('view'); ?> <?php echo $this->lang->line('payment'); ?></h4>
        </div>
        <div class="modal-body"></div>       
      </div>
    </div>
</div>