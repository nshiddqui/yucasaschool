<?php
$url_count=$this->uri->total_segments();
  $username=$this->uri->segment($url_count-1);
  $userid=$this->uri->segment($url_count-0);
  $current_user = $username . '-' . $userid;
  
  $sender_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
    $this->db->select('E.*');
        $this->db->from('message AS E');
        $this->db->where('E.message_thread_code', $current_message_thread_code);
        $this->db->where('E.reciever', $sender_user);
        $this->db->where('E.sender', $current_user);
        $this->db->or_where('E.reciever', $current_user);
        $this->db->or_where('E.sender', $sender_user);
        $messages    = $this->db->get()->result_array();
//$messages = $this->db->get_where('messages', array('message_thread_code' => $current_message_thread_code,'reciever'=>$sender_user,'sender'=>$current_user))->result_array();
//echo $query= "select * from message where message_thread_code =$current_message_thread_code AND reciever=$current_user OR reciever=$sender_user AND sender=$sender_user OR sender=$current_user ";
foreach ($messages as $row):

    $sender = explode('-', $row['sender']);
    $sender_account_type = $sender[0];
    $sender_id = $sender[1];
    ?>
    <div class="mail-info">

        <div class="mail-sender " style="padding:7px;">

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo $this->crud_model->get_image_url($sender_account_type, $sender_id); ?>" class="img-circle" width="30">
                <span><?php echo $this->db->get_where($sender_account_type, array($sender_account_type . '_id' => $sender_id))->row()->name; ?></span>
            </a>
        </div>

        <div class="mail-date" style="padding:7px;">
            <?php echo date("d M, Y H:s", $row['timestamp']); ?>
        </div>

    </div>

    <div class="mail-text">
        <p> <?php echo $row['message']; ?></p>
        <?php if ($row['attached_file_name'] != ''):?>
          <p style="text-align: right;">
            <a href="<?php echo base_url('uploads/private_messaging_attached_file/'.$row['attached_file_name']);?>" target="_blank" style="color: #2196F3;">
            <i class="entypo-download" style="color: #757575"></i> <?php echo $row['attached_file_name']; ?>
          </a>
          </p>
        <?php endif; ?>
    </div>

<?php endforeach; ?>

<?php echo form_open(site_url('student/message/send_reply/'.$current_message_thread_code)  , array('enctype' => 'multipart/form-data')); ?>
<div class="mail-reply">
    <div class="compose-message-editor">
	<input type="hidden" name="reciever" value="<?php echo $current_user ?>">
        <textarea row="5" class="form-control wysihtml5" data-stylesheet-url="assets/css/wysihtml5-color.css" name="message"
                  placeholder="<?php echo get_phrase('reply_message'); ?>" id="sample_wysiwyg" required></textarea>
    </div>
    <br>
    <!-- File adding module -->
    <div class="">
      <input type="file" class="form-control file2 inline btn btn-info" name="attached_file_on_messaging" accept=".pdf, .doc, .jpg, .jpeg, .png" data-label="<i class='entypo-upload'></i> Browse" />
    </div>
  <!-- end -->
    <button type="submit" class="btn btn-success pull-right">
        <?php echo get_phrase('send'); ?>
    </button>
    <br><br>
</div>
</form>
