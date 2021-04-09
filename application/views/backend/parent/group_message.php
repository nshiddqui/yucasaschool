
<style media="screen">
.mail-env .mail-sidebar .mail-menu > li:hover a.customize_group {
  background: none;
  color: #607D8B;
}
.mail-env .mail-sidebar .mail-menu > li.active a.customize_group {
    background: none;
    font-weight: bold;
}
</style>
<?php $activeTab = "message"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Message Dashboard</a></li>
        <li class="active">Message</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/parent/message_nav_tab.php'; ?>
<!-- Including Navigation Tab -->
</div>
<div class="mail-env">

    <!-- Mail Body -->
    <div class="mail-body">

        <!-- message page body -->
        <?php include $message_inner_page_name . '.php'; ?>
    </div>

    <!-- Sidebar -->
    <div class="mail-sidebar" style="min-height: 800px;">
        <!-- message user inbox list -->
        <div class="mail-sidebar-row hidden-xs" style="text-align: center;">
          <button type="button" name="button" class="btn btn-primary btn-block"><?php echo get_phrase('list_of_groups'); ?></button>
        </div>

        <ul class="mail-menu">

            <?php
              $flag = 0;
              $group_messages = $this->db->get('group_message_thread')->result_array();
              foreach ($group_messages as $row):
                $members = json_decode($row['members']);
                if (in_array($this->session->userdata('login_type').'_'.$this->session->userdata('login_user_id'), $members)):
                $flag++;
                ?>
                <li class="col-md-12 <?php if (isset($current_message_thread_code) && $current_message_thread_code == $row['group_message_thread_code']) echo 'active'; ?>">
                <div class="col-sm-10" style="text-align:left; margin: 0; padding: 0;">
                  <a href="<?php echo site_url('parents/group_message/group_message_read/'.$row['group_message_thread_code']); ?>" style="padding:12px;">
                      <i class="entypo-dot"></i>
                      <?php echo $row['group_name'] ?>
                  </a>
                </div>
                <div class="col-sm-2" style="text-align:right; margin: 0 0; padding: 12px 5px;">
                  <a href="#" class="customize_group" onclick="showAjaxModal('<?php echo site_url('modal/popup/group_info/'.$row['group_message_thread_code']);?>');" style="margin: 0; padding: 0;"><i class="fa fa-cog" aria-hidden="true"></i></a>
                </div>
              </li>
              <?php endif; ?>
            <?php endforeach;
            if ($flag == 0):?>
            <div class="col-sm-12" style="text-align: center; margin-top: 25px; color: #607D8B; font-size: 13px;">
              <?php echo '( '.get_phrase('no_group_was_created').' )'; ?>
            </div>
            <?php endif; ?>
        </ul>

    </div>

</div>
