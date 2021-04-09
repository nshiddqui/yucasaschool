  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'accounts_payroll_dashboard'){echo "active";}?>"><a href="#accounts_payroll_dashboard" class="" role="tab" data-toggle="tab" aria-expanded="true" >Accounts & Payroll</a></li>
        <li class="<?php if ($activeTab == 'accounting'){echo "active";}?>"><a href="#accounting" class="" role="tab" data-toggle="tab" aria-expanded="true" >Accounting</a></li>
        <li class="<?php if ($activeTab == 'payroll'){echo "active";}?>"><a href="#payroll" class="" role="tab" data-toggle="tab" aria-expanded="true" >Payroll</a></li>
      </ul>
    </div>
  </div>
  <div class="tab-content payroll_tab">
    <div  class="tab-pane fade <?php if ($activeTab == 'accounts_payroll_dashboard'){echo " active in";}?>" id="accounts_payroll_dashboard">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/accounts_payroll_dashboard" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/accounts_payroll_dashboard"><i class="entypo-chart-area"></i> Dashboard</a></li>
      </ul>
    </div>
    <div  class="tab-pane fade <?php if ($activeTab == 'accounting'){echo " active in";}?>" id="accounting">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/feetype" class="url-link" data-url="<?php echo base_url(); ?>index.php/feetype">Fee Type</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/discount" class="url-link" data-url="<?php echo base_url(); ?>index.php/discount">Discount</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/invoice" class="url-link" data-url="<?php echo base_url(); ?>index.php/invoice">Manage Invoice</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/invoice/due" class="url-link" data-url="<?php echo base_url(); ?>index.php/invoice/due">Due Fee</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/duefeeemail/" class="url-link" data-url="<?php echo base_url(); ?>index.php/duefeeemail/">Due Fee Email</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/duefeesms/" class="url-link" data-url="<?php echo base_url(); ?>index.php/duefeesms/">Due Fee Sms</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/incomehead/" class="url-link" data-url="<?php echo base_url(); ?>index.php/incomehead/">Income Head</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/income" class="url-link" data-url="<?php echo base_url(); ?>index.php/income">Income</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/exphead/" class="url-link" data-url="<?php echo base_url(); ?>index.php/exphead/">Expenditure Head</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/expenditure/" class="url-link" data-url="<?php echo base_url(); ?>index.php/expenditure/">Expenditure</a></li>
      </ul>
    </div>
	 <div  class="tab-pane fade <?php if ($activeTab == 'payroll'){echo " active in";}?>" id="payroll">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/payroll/payment" class="url-link" data-url="<?php echo base_url(); ?>index.php/payroll/payment"><i class="fa fa-list-ol"></i>Payment</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/payroll/grade" class="url-link" data-url="<?php echo base_url(); ?>index.php/payroll/grade"><i class="fa fa-list-ol"></i>Grade</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/payroll/history" class="url-link" data-url="<?php echo base_url(); ?>index.php/payroll/history"><i class="fa fa-list-ol"></i>History</a></li>
      </ul>
    </div>
  </div>