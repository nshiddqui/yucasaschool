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

    <!-- Sidebar -->
    <div class="mail-sidebar">

        <!-- compose new email button -->
        <div class="mail-sidebar-row">
            <a href="<?php echo site_url('parents/message/message_new'); ?>" class="btn btn-success btn-block">
                <?php echo get_phrase('new_message'); ?>
            </a>
        </div>

        <!-- message user inbox list -->
        <ul class="mail-menu">

            <?php
            $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');

            $this->db->where('sender', $current_user);
            $this->db->or_where('reciever', $current_user);
            $message_threads = $this->db->get('message_thread')->result_array();
            foreach ($message_threads as $row):

                // defining the user to show
                if ($row['sender'] == $current_user)
                    $user_to_show = explode('-', $row['reciever']);
                if ($row['reciever'] == $current_user)
                    $user_to_show = explode('-', $row['sender']);

                $user_to_show_type = $user_to_show[0];
                $user_to_show_id = $user_to_show[1];
                $unread_message_number = $this->crud_model->count_unread_message_of_thread($row['message_thread_code']);
                ?>
                <li class="<?php if (isset($current_message_thread_code) && $current_message_thread_code == $row['message_thread_code']) echo 'active'; ?>">
                    <a href="<?php echo site_url('parents/message/message_read/'.$row['message_thread_code']); ?>" style="padding:12px;">
                        <i class="entypo-dot"></i>

                        <?php echo $this->db->get_where($user_to_show_type, array($user_to_show_type . '_id' => $user_to_show_id))->row()->name; ?>

                        <span class="badge badge-default pull-right" style="color:#aaa;"><?php echo $user_to_show_type; ?></span>

                        <?php if ($unread_message_number > 0): ?>
                            <span class="badge badge-secondary pull-right">
                                <?php echo $unread_message_number; ?>
                            </span>
                        <?php endif; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

    </div>

    <!-- Mail Body -->
    <div class="mail-body">
        <!-- message page body -->
        <?php include $message_inner_page_name . '.php'; ?>
    </div>

</div>
