<?php $activeTab = "assignment_setting"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Assignment Settings</a></li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/setting_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<div class="container-fluid">
  <div class="row">
        <div class="col-sm-6">
             <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                 Assignment Setting
                </div>
               
            </div>


            <div class="panel-body form-horizontal form-groups-bordered">
                <?php echo form_open(site_url('admin/assignment_setting/do_update') ,
      array('class' => 'form-horizontal form-groups-bordered','target'=>'_top'));?>
                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('assignment_status');?></label>
                      <div class="col-sm-9">
                          <select name="assignment_status" class="form-control selectboxit" onchange="get_assignment_statusl(this.value,'add');">
                          	  <?php echo $assignment_status	=	$this->db->get_where('settings' , array('type'=>'assignment_status'))->row()->description;?>
                              <option value="1" <?php if ($assignment_status == '1')echo 'selected';?>> Assignment Activate</option>
                              <option value="0" <?php if ($assignment_status == '0')echo 'selected';?>> Assignment Deactive</option>
                          </select>
                      </div>
                  </div>
                      <div class="form-group" id="assignment_weightage">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('assignment_weightage');?></label>
                      <div class="col-sm-9">
                          <input type="text"  class="form-control" name="assignment_weightage"
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'assignment_weightage'))->row()->description;?>" >
                      </div>
                      </div>
				   <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <input type="submit" class="btn btn-info" value="<?php echo get_phrase('setting_update'); ?>" />
                        </div>
                    </div>
				    <?php echo form_close(); ?> 
            </div>

        </div>
    </div>
  </div>

</div>



<script>


function get_assignment_statusl(assignment_status,type){ 
        if(assignment_status == '0'){
            $('#assignment_weightage').hide();
        }
         else{
        $('#assignment_weightage').show();
		 }
    } 

    function field_status(field_id){
    //alert(field_id);
      $('.msg').text("")
      $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('ajax/update_card_field_status'); ?>",
          data   : { field_id : field_id},               
          async  : false,
          success: function(data){                                                   
             if(data)
             {
              //alert(data);
              $('#msg'+field_id).text(data);
              $("#msg"+field_id).show().delay(3000).fadeOut();
              //$('#msg'+field_id).text("");
             }
          }
      }); 
   }


</script>