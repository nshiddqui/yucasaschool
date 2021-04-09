  <div class="container-fluid" style="display:none;">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'payment'){echo "active";}?>"><a href="#payment" class="" role="tab" data-toggle="tab" aria-expanded="true" >Payment</a></li>
        <li class="<?php if ($activeTab == 'student_card'){echo "active";}?>"><a href="#student_card" class="" role="tab" data-toggle="tab" aria-expanded="true" >Recharge</a></li>
      </ul>
    </div>
  </div>
  <div class="tab-content">
    <div  class="tab-pane fade <?php if ($activeTab == 'payment'){echo " active in";}?>" id="payment">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/parents/invoice/1" class="url-link" data-url="<?php echo base_url(); ?>index.php/parents/invoice/1"><i class="fa fa-desktop"></i> Fees List</a></li>
      </ul>
    </div>
    <div  class="tab-pane fade <?php if ($activeTab == 'student_card'){echo " active in";}?>" id="student_card">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo site_url('parents/card_recharge/'.$row['student_id']); ?>" class="url-link" data-url="<?php echo site_url('parents/card_recharge/'.$row['student_id']); ?>"><i class="fa fa-desktop"></i>Card Recharge</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/parents/card_block" class="url-link" data-url="<?php echo base_url(); ?>index.php/parents/card_block"><i class="fa fa-desktop"></i>Card Block</a></li>
      </ul>
    </div>
  </div>