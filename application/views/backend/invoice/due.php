<?php $activeTab = "accounting"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Accounting</a></li>
        <li class="active">Invoice Due</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/accounts_payroll_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-calculator"></i><small> <?php echo $this->lang->line('manage_due_invoice'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">               
                    
                 <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered hidden">                 
                        <li  class="active"><a href="#due_invoice" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-calculator"></i> <?php echo $this->lang->line('due_invoice'); ?> </a></li>                          
                    </ul>
                    <br/>
                     <div class="tab-content">
                        <div  class="tab-pane fade in active" id="due_invoice" >
                            <div class="x_content">   
                               <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                   <thead>
                                       <tr>
                                           <th><?php echo $this->lang->line('sl_no'); ?></th>
                                           <th><?php echo $this->lang->line('invoice'); ?> <?php echo $this->lang->line('number'); ?></th>
                                           <th><?php echo $this->lang->line('student'); ?></th>
                                           <th><?php echo $this->lang->line('class'); ?></th>
                                           <th><?php echo $this->lang->line('fee'); ?> <?php echo $this->lang->line('type'); ?></th>
                                           <th><?php echo $this->lang->line('gross_amount'); ?></th>
                                           <th><?php echo $this->lang->line('discount'); ?></th>
                                           <th><?php echo $this->lang->line('net_amount'); ?></th>
                                           <th><?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('status'); ?></th>
                                           <th><?php echo $this->lang->line('action'); ?></th>                                            
                                       </tr>
                                   </thead>
                                   <tbody>   
                                       <?php $count = 1; if(isset($invoices) && !empty($invoices)){ ?>
                                           <?php foreach($invoices as $obj){ ?>
                                           <tr>
                                               <td><?php echo $count++; ?></td>
                                               <td><?php echo $obj->custom_invoice_id; ?></td>
                                               <td><?php echo $obj->student_name; ?></td>
                                               <td><?php echo $obj->class_name; ?></td>
                                               <td><?php echo $obj->head; ?></td>
                                               <td><?php echo $obj->gross_amount; ?></td>
                                               <td><?php echo $obj->discount; ?></td>
                                               <td><?php echo $obj->net_amount; ?></td>
                                               <td><?php echo get_paid_status($obj->paid_status); ?></td>
                                               <td>
                                                   <!-- <a href="<?php echo site_url('accounting/invoice/view/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> </a>
                                                   <a href="<?php echo site_url('accounting/payment/index/'.$obj->id); ?>"  class="btn btn-success btn-xs"><i class="fa fa-credit-card"></i> <?php echo $this->lang->line('payment'); ?> </a> -->

                                                    <div class="btn-group">
                                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                                        Action <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                                        <li>
                                                         <a href="<?php echo site_url('invoice/view/'.$obj->id); ?>" class=""><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> </a>
                                                        </li>

                                                        <li> <a href="<?php echo site_url('payment/index/'.$obj->id); ?>"  class=""><i class="fa fa-credit-card"></i> <?php echo $this->lang->line('payment'); ?> </a></li>                                            
                                                      
                                                    </ul>
                                                </div>
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
