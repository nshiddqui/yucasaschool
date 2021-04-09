<?php
$url_count=$this->uri->total_segments();
  $username=$this->uri->segment($url_count-1);
  $userid=$this->uri->segment($url_count-0);
 
  $test_userid = $_GET['test'];
  $str_arr = explode(",", $test_userid); 

  $current_user = $username . '-' . $userid;
  $sender_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
//$messages = $this->db->get_where('message', array('message_thread_code' => $current_message_thread_code,'reciever'=>$current_user))->result_array();
 // $query="SELECT  * FROM    message  a WHERE   (a.reciever = $sender_user AND a.sender = $current_user) OR
      //  (a.reciever = $current_user AND a.sender = $sender_user) ORDER   BY message_id  DESC ";
		
		
        $this->db->select('E.*');
        $this->db->from('message AS E');
        $this->db->where('E.message_thread_code', $current_message_thread_code);
        // $this->db->where("(E.reciever ='". $sender_user."' AND E.sender = '".$current_user."') or (E.reciever = '".$current_user."' AND E.sender = '".$sender_user."')");
       // $this->db->where('E.sender', $current_user);
        //$this->db->or_where('E.reciever', $current_user);
       // $this->db->or_where('E.sender', $sender_user);
        $messages    = $this->db->get()->result_array();
// 		print_r($messages);
		


		
		?>
		
	
     <script type="text/javascript" src="<?php echo base_url('assets/js/ckeditor.js')?>"></script>
    <div class="mail-info">

      <style type="text/css">
        
        .dataTables_wrapper {
    border: 1px solid #ebebeb;
    -webkit-border-radius: 3px;
    -webkit-background-clip: padding-box;
    -moz-border-radius: 3px;
    -moz-background-clip: padding;
    border-radius: 3px;
    background-clip: padding-box;
}
      </style>


     <span style="
    font-size: 22px;
"> <?php 
if(ucfirst($username) == "Parent"){
$name = $this->db->get_where('parent', array('parent_id' => $userid))->row()->name;
} else if(ucfirst($username) == "Student"){
$name = $this->db->get_where('student', array('student_id' => $userid))->row()->name;
} else if(ucfirst($username) == "teacher") {
  $name = $this->db->get_where('teacher', array('teacher_id' => $userid))->row()->name;
} else {
   $name = '';
   $telephone = '';

   for ($i=0; $i < sizeof($str_arr); $i++) { 
     $name .= $this->db->get_where('student', array('student_id' => $str_arr[$i]))->row()->name;
     $name .= ",";
     $telephone .= $this->db->get_where('student', array('student_id' => $str_arr[$i]))->row()->phone;
     $telephone .= ",";
     //$phone .= $this->db->get_where('student', array('student_id' => $str_arr[$i]))->row()->phone;
    }
 
}

echo $name; 
$telephone = substr($telephone, 0, -1);


?></span>

<div id="table-4_wrapper" class="dataTables_wrapper">
    <table class="table table-bordered datatable dataTable" id="table-4" role="grid" aria-describedby="table-4_info">
        <thead>
            <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="table-4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Sender Name</th>
                <th class="sorting" tabindex="0" aria-controls="table-4" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 218px;">Message</th>
                <th class="sorting" tabindex="0" aria-controls="table-4" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 200px;">Date</th>
       
            </tr>
        </thead>
        <tbody>
            <?php
foreach ($messages as $row):

    $sender = explode('-', $row['sender']);
    $sender_account_type = $sender[0];
    $sender_id = $sender[1];
    ?>
            <tr class="gradeA odd" role="row">
                <td class="sorting_1"><?php echo $this->db->get_where($sender_account_type, array($sender_account_type . '_id' => $sender_id))->row()->name; ?></td>
                <td> <p> <?php echo $row['message']; ?></p>
        <?php if ($row['attached_file_name'] != ''):?>
          <p style="text-align: right;">
            <a href="<?php echo base_url('uploads/private_messaging_attached_file/'.$row['attached_file_name']);?>" target="_blank" style="color: #2196F3;">
            <i class="entypo-download" style="color: #757575"></i> <?php echo $row['attached_file_name']; ?>
          </a>
          </p>
        <?php endif; ?>
          </a>
          </p></td>
                <td><?php echo date("d M, Y H:s", $row['timestamp']); ?></td>
              
            </tr>
            <?php endforeach; ?>
           
        </tbody>

    </table>
</div>



<?php echo form_open(site_url('admin/message/send_reply/'.$current_message_thread_code)  , array('enctype' => 'multipart/form-data')); ?>
<div class="mail-reply">
    <div class="compose-message-editor">
	<input type="hidden" name="reciever" value="<?php echo $current_user ?>">
  <input type="hidden" name="multiuser_phone" value="<?php echo $telephone ?>">
   

                   <textarea name="message" id="editor1" value="" rows="10" cols="80" placeholder="<?php echo get_phrase('reply_message'); ?>" required>

                     <?php $sms_template = $this->db->get_where('sms_template')->result_array();

                      echo $sms_template[0]['description'];
                      ?>

                
            </textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>
    </div>
    <br>
    <!-- File adding module -->
    <div class="">
      <input type="file" class="form-control file2 inline btn btn-info" name="attached_file_on_messaging" accept=".pdf, .doc, .jpg, .jpeg, .png" data-label="<i class='entypo-upload'></i> Browse" />
    </div>
  <!-- end -->
    <button type="submit" name="submit" class="btn btn-success pull-right" style="
    width: 117px;
" value="sendnotification">
        <?php echo get_phrase('send notification'); ?>
    </button>
     <button type="submit" name="submit" class="btn btn-success pull-right" style="
    width: 117px;
    margin-right: 10px;
    padding: 10x 2px 2px 3px;
" value="sendsms">
        <?php echo get_phrase('send sms'); ?>
    </button>
    <br><br>
</div>
</form>


