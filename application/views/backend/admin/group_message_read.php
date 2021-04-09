<div class="mail-header">
    <!-- title -->
    <h3 class="mail-title">
        <?php echo $this->db->get_where('group_message_thread', array('group_message_thread_code' => $current_message_thread_code))->row()->group_name; ?>
    </h3>
</div>
   <script type="text/javascript" src="<?php echo base_url('assets/js/ckeditor.js')?>"></script>

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
  $messages = $this->db->get_where('group_message', array('group_message_thread_code' => $current_message_thread_code))->result_array();
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
            <a href="<?php echo base_url('uploads/group_messaging_attached_file/'.$row['attached_file_name']);?>" target="_blank" style="color: #2196F3;">
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
<div>
<?php echo form_open(site_url('admin/group_message/send_reply/'. $current_message_thread_code) , array('enctype' => 'multipart/form-data')); ?>
<div class="mail-reply">
  <div class="compose-message-editor">
              <textarea name="message" id="editor1" rows="10" cols="80" placeholder="<?php echo get_phrase('reply_message'); ?>" required>
                
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
  <button type="submit" class="btn btn-success pull-right">
      <?php echo get_phrase('send'); ?>
  </button>
  <br><br>
</div>
</form>
</div>