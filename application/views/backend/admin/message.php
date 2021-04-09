<style type="text/css">
    
.nav>li>a {
    position: relative;
    display: block;
    text-decoration: none;
}

.nav {
    font-size: .875rem;
}

table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td{

    border-bottom-width:3px;}


.bottom-block{
    display: none;


}

  .dataTables_wrapper {
    border: 1px solid #ebebeb;
    -webkit-border-radius: 3px;
    -webkit-background-clip: padding-box;
    -moz-border-radius: 3px;
    -moz-background-clip: padding;
    border-radius: 3px;
    background-clip: padding-box;
}
     
     .footer_bg_block{

        height: 30px;
     }
.dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter{
  padding: 1px 1px 3px 8px;
}

     
</style>

<div id="page-container" class="page-header-fixed page-sidebar-fixed in">
<ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo site_url('admin/message'); ?>" style="background: white;padding: -6px 22px 1px 5px;color: #f5f5f6;text-decoration: solid;text-decoration-style: inheri;/* text-underline-position: unset; */t;background-color: #060101;font-size: 16px;"><?php echo get_phrase('private_message'); ?></a>
            </li>
    <!--         <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('admin/group_message'); ?>" style="background: white;padding: -6px 22px 1px 5px;color: #f5f5f6;text-decoration: solid;text-decoration-style: inheri;/* text-underline-position: unset; */t;background-color: #30364173;font-size: 16px;"><?php echo get_phrase('group_message'); ?></a>
            </li> -->
        </ul>

<div class="mail-env">

    <!-- Sidebar -->
    <div class="mail-sidebar">

        <!-- compose new email button -->
        <div class="mail-sidebar-row">
            <a href="<?php echo site_url('admin/message/message_new'); ?>" class="btn btn-success btn-block">
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
                    <a href="<?php echo site_url('admin/message/message_read/'.$row['message_thread_code']); ?>" style="padding:12px;">
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
        

     <?php
   
   

   $student = 'student';

   $student1 = '';
   $student1 .= '<select name="mysdesignation" id = "mysdesignation" onchange="select_designation();">';
   $student1 .= '<option value="" selected>Select Designation</option>';

$brands_array = array("student","teacher");
    foreach ($brands_array as $key => $value) {
        if($key == $selected_brand){
            // For selected option.
            $student1 .= '<option value="'.$value.'">'.$value.'</option>';
        } else {
            $student1 .= '<option value="'.$value.'">'.$value.'</option>';
        }
    }

$student1 .= '</select>';

echo $student1;

    ?>
    <br/>

            <select name="class_id" id="class_id" onchange="select_section(this.value)" style= "display:none;">
                <option value=""><?php echo get_phrase('select_class');?></option>
                <?php
                    $classes = $this->db->get('class')->result_array();
                    foreach($classes as $row):
                                            
                ?>
                <option value="<?php echo $row['class_id'];?>"
                    ><?php echo $row['name'];?></option>
                                
                <?php endforeach;?>
            </select>

        </br>
       
       <div id="section_holder" style= "display:none;">
        <select class="selectboxit" id="section_id" name="section_id" style= "display:none;">
         <option value=""><?php echo get_phrase('select_class_first') ?></option>
                
            </select>
       </div>

<link rel=”stylesheet” href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <div class="col-md-12" style="margin-top: 10px;" id ="table_data" >


  </div>


<br>
<br>


  <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_template_list" >
                            <div class="x_content">

                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <span><p><h4><strong>SMS Templates</strong></h4></p></span>
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                     
                                        <th><?php echo $this->lang->line('title'); ?></th>
                                        <th><?php echo $this->lang->line('template'); ?></th>
                                        <th><?php echo $this->lang->line('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php
                                     $template_list  = $this->crud_model->get_sms_templates();

                                     $count = 1; if(isset($template_list) && !empty($template_list)){ ?>
                                        <?php foreach($template_list as $obj){ ?>                                       
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                          
                                            <td><?php echo $obj->title; ?></td>                                           
                                            <td><?php echo $obj->description; ?></td>                                           
                                            <td>

                                            <input type="checkbox" name="email" onClick="sendValue('<?php echo $obj->title; ?>')">

                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>

    </div>



    <!-- Mail Body -->
    <div class="mail-body">
        <!-- message page body -->
        <?php include $message_inner_page_name . '.php'; ?>
    </div>








</div>
</div>

<script type="text/javascript">
function sendValue(test)
{
      
var editor = CKEDITOR.instances['editor1'];
editor.setData(test);

}

function select_designation() {
    var designation = $("#mysdesignation").val();

    var postdata = '';

    if(designation == "student")
    {

        $('#class_id').attr("style", "display:block;margin-left: 159px;margin-top: -19px;padding: 2px 5px 3px 8px;");
        $('#section_holder').attr("style", "display:none;");
        

    // postdata = "designation=" + designation;
    } else {
     
      $('#class_id').attr("style", "display:none;");
      $('#section_id').attr("style", "display:none;");
      $('#example_length').attr("style", "padding: 8px 32px 3px 1px;");
      $('#section_holder').attr("style", "display:none;");


      
      //$('.control-label').attr("style", "display:none;");
     postdata = "designation=" + designation;
   

    $.ajax({
        type: "POST",
        url: "<?php echo site_url('admin/designation_private_message'); ?>",
        data: postdata,
        success:function (response)
      {

      jQuery('#table_data').html(response);
      }
    });
     }
  }

  function select_section(class_id) {
    if(class_id !== ''){
        $.ajax({
            url: '<?php echo site_url('admin/get_section/'); ?>' + class_id,
            success:function (response)
            {

            jQuery('#section_holder').html(response);
            $('#section_holder').attr("style", "display:block;");
            $('#section_id').attr("style", "display:block;");


            $('#section_idSelectBoxItContainer').attr("style","width:204px;");
           // $('.control-label').attr("style", "display:none;");
            
            }
        });
    }
}


function sectio_id() {
   var designation = $("#mysdesignation").val();
   var class_id = $("#class_id").val();
   var section_id = $("#section_id").val();

   var postdata = "designation=" + designation + "&class=" +class_id + "&section_id=" +section_id;
    
    $.ajax({
        type: "POST",
        url: "<?php echo site_url('admin/designation_private_message'); ?>",
        data: postdata,
        success:function (response)
      {

      jQuery('#table_data').html(response);
      }
    });
}


</script>
    