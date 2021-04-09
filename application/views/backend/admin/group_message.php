
<style media="screen">
.mail-env .mail-sidebar .mail-menu > li:hover a.customize_group {
  background: none;
  color: #607D8B;
}
.mail-env .mail-sidebar .mail-menu > li.active a.customize_group {
    background: none;
    font-weight: bold;
}
    table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td{

    border-bottom-width:3px;
}
</style>
<ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo site_url('admin/message'); ?>" style="background: white;padding: -6px 22px 1px 5px;color: #f5f5f6;text-decoration: solid;text-decoration-style: inheri;/* text-underline-position: unset; */t;background-color: #30364173;font-size: 16px;"><?php echo get_phrase('private_message'); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('admin/group_message'); ?>" style="background: white;padding: -6px 22px 1px 5px;color: #f5f5f6;text-decoration: solid;text-decoration-style: inheri;/* text-underline-position: unset; */t;background-color: #060101;font-size: 16px;"><?php echo get_phrase('group_message'); ?></a>
            </li>
        </ul>
<hr />
<div class="mail-env" style="margin-top:0">

    <!-- Mail Body -->
    <div class="mail-body">

        <!-- message page body -->
        <?php include $message_inner_page_name . '.php'; ?>
    </div>

    <!-- Sidebar -->
    <div class="mail-sidebar" style="min-height: 800px;">
      <!-- compose new email button -->
      <div class="mail-sidebar-row hidden-xs">
          <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/create_group/');?>');" class="btn btn-success btn-block">
              <?php echo get_phrase('create_group'); ?>
          </a>
      </div>
        <!-- message user inbox list -->
        <ul class="mail-menu">

            <?php
              $group_messages = $this->db->get('group_message_thread')->result_array();
			 
              if (sizeof($group_messages) > 0):
              foreach ($group_messages as $row):?>
              <li class="col-md-12 <?php if (isset($current_message_thread_code) && $current_message_thread_code == $row['group_message_thread_code']) echo 'active'; ?>">
                <div class="col-sm-10" style="text-align:left; margin: 0; padding: 0;">
                  <a href="<?php echo site_url('admin/group_message/group_message_read/'.$row['group_message_thread_code']); ?>" style="padding:10px;">
                      <i class="entypo-dot"></i>
                      <?php echo $row['group_name'] ?>
                  </a>
                </div>
                <div class="col-sm-2" style="text-align:right; margin: 0 0; padding: 12px 5px;">
                  <a href="#" class="customize_group" onclick="showAjaxModal('<?php echo site_url('modal/popup/edit_group/'.$row['group_message_thread_code']);?>');" style="margin: 0; padding: 0;"><span class="s7-user" aria-hidden="true" style="
    font-stretch: normal;
    font-size: 22px;
"></span></a>
                </div>
              </li>
            <?php endforeach; ?>
          <?php endif;
            if (sizeof($group_messages) == 0):?>
            <div class="col-sm-12" style="text-align: center; margin-top: 25px; color: #607D8B; font-size: 13px;">
              <?php echo '( '.get_phrase('create_a_group_now').' )'; ?>
            </div>
            <?php endif ?>
        </ul>

        <span><p><h4><strong>SMS Templates</strong></h4></p></span>

  <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_template_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
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

</div>

<script type="text/javascript">
function sendValue(test)
{
      
var editor = CKEDITOR.instances['editor1'];
editor.setData(test);

}
</script>