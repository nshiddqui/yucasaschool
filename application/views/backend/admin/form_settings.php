<?php $activeTab = "form_settings"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Card Settings</a></li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/setting_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

  <div class="row">
    <div class="col-sm-6">
      <div class="panel panel-primary" data-collapsed="0">

    <div class="panel-heading">
        <div class="panel-title">
           Update Teacher Registration Form Fields 
        </div>
       
    </div>


    <div class="panel-body form-horizontal form-groups-bordered">
        
        <?php 
          $fieldsetting = $this->db->get('registration_form_setting_teacher')->result();  
          foreach ($fieldsetting as $key => $dt) {
        ?>    
          <div class="form-group">
                <label class="col-sm-5 control-label"><?php echo $dt->description; ?></label>
                  <div class="col-sm-3">
                    <div class="container">
                    <label class="control control--checkbox">
                      <input type="checkbox" name="disable_frontend" <?php if ($dt->status == 1) echo 'checked'; ?>  onclick = 'field_status_teacher("<?php echo $dt->id;?>")'/>
                      <div class="control__indicator">
                        
                      </div>
                    </label>


                  </div>
                  <?php if($dt->status == 1 && $dt->created_html == 0){ ?>
                   <button title="permanently delete this field !" class="btn" style="float: right;position: relative;top: -16px;" onclick='delete_field_teacher("<?php echo $dt->id;?>");'><i class="fa fa-close"></i></button>
                    <?php } ?>
                </div>
                <div class="col-sm-4">
                  <span style="color:red" id="msg_t<?=$dt->id;?>" class="msg"></span>
                </div>
            </div>
          <?php } ?>
        
    </div>

    </div>
    </div>




    <div class="col-sm-6">
             <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                   Update Student Registration Form Fields 
                </div>
               
            </div>


            <div class="panel-body form-horizontal form-groups-bordered">
                
                <?php 
                  $fieldsetting = $this->db->get('registration_form_setting')->result();  
                  foreach ($fieldsetting as $key => $dt) {
                ?>    
                  <div class="form-group">
                        <label class="col-sm-5 control-label"><?php echo $dt->description; ?></label>
                          <div class="col-sm-3">
                            <div class="container">
                            <label class="control control--checkbox">
                              <input type="checkbox" name="disable_frontend" <?php if ($dt->status == 1) echo 'checked'; ?>  onclick = 'field_status("<?php echo $dt->id;?>")'/>
                              <div class="control__indicator">
                                
                              </div>
                            </label>


                          </div>
                          <?php if($dt->status == 1 && $dt->created_html == 0){ ?>
                           <button title="permanently delete this field !" class="btn" style="float: right;position: relative;top: -16px;" onclick='delete_field("<?php echo $dt->id;?>");'><i class="fa fa-close"></i></button>
                            <?php } ?>
                        </div>
                        <div class="col-sm-4">
                          <span style="color:red" id="msg<?=$dt->id;?>" class="msg"></span>
                        </div>
                    </div>
                  <?php } ?>
                  
            </div>

        </div>
    </div>
	
	
	 <div class="col-sm-6">
             <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                   Update Pre Admin Student Registration Form Fields 
                </div>
               
            </div>


            <div class="panel-body form-horizontal form-groups-bordered">
                
                <?php 
                  $fieldsettings = $this->db->get('registration_form_setting_pre_student')->result();  
                  foreach ($fieldsettings as $keys => $dts) {
                ?>    
                  <div class="form-group">
                        <label class="col-sm-5 control-label"><?php echo $dts->description; ?></label>
                          <div class="col-sm-3">
                            <div class="container">
                            <label class="control control--checkbox">
                              <input type="checkbox" name="disable_frontend" <?php if ($dts->status == 1) echo 'checked'; ?>  onclick = 'field_status_pre_student("<?php echo $dts->id;?>")'/>
                              <div class="control__indicator">
                                
                              </div>
                            </label>


                          </div>
                          <?php if($dts->status == 1 && $dts->created_html == 0){ ?>
                           <button title="permanently delete this field !" class="btn" style="float: right;position: relative;top: -16px;" onclick='delete_field_pre_student("<?php echo $dts->id;?>");'><i class="fa fa-close"></i></button>
                            <?php } ?>
                        </div>
                        <div class="col-sm-4">
                          <span style="color:red" id="msgs<?=$dts->id;?>" class="msg"></span>
                        </div>
                    </div>
                  <?php } ?>
                  
            </div>

        </div>
    </div>
	
	
	
		 <div class="col-sm-6">
             <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                   Pre Student Registration Instruction
                </div>
               
            </div>


          
            <div class="panel-body form-horizontal form-groups-bordered">
     <?php echo form_open(site_url('admin/registration_instructions/do_update') ,
      array('class' => 'form-horizontal form-groups-bordered','target'=>'_top'));?>

                     <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('registration_instructions');?></label>
                      <div class="col-sm-9">
                         <!-- <input type="text" class="form-control" name="registration_instructions"
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'registration_instructions'))->row()->description;?>" required>-->
                              
            <textarea name="registration_instructions" class="form-control" rows="8" cols="80" data-validate="required" data-message-required="Value Required" required=""><?php echo $this->db->get_where('settings' , array('type' =>'registration_instructions'))->row()->description;?></textarea>
                      </div>
                      </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <input type="submit" class="btn btn-info" value="<?php echo get_phrase('update'); ?>" />
                        </div>
                    </div>

                <?php echo form_close(); ?>
            </div>

        </div>
    </div>
	
	
  </div>




<script>

    function field_status(field_id){
    //alert(field_id);
      $('.msg').text("")
      $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('ajax/update_field_status'); ?>",
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

   function delete_field(del_val){

    
    $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('ajax/detele_fields_'); ?>",
          data   : { 'del_val' : del_val},               
          async  : false,
          success: function(data){                                                   
             if(data)
             {
              alert('Field delete successfully !');
              location.reload();
             }
          }
      }); 
   }

   
  function field_status_teacher(field_id){
    //alert(field_id);
      $('.msg').text("")
      $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('ajax/update_field_status_teacher'); ?>",
          data   : { field_id : field_id},               
          async  : false,
          success: function(data){                                                   
             if(data)
             {
              //alert(data);
              $('#msg_t'+field_id).text(data);
              $("#msg_t"+field_id).show().delay(3000).fadeOut();
              //$('#msg'+field_id).text("");
             }
          }
      }); 
   }

  function delete_field_teacher(del_val){
      $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('ajax/detele_fields_teacher'); ?>",
          data   : { 'del_val' : del_val},               
          async  : false,
          success: function(data){                                                   
             if(data)
             {
              alert('Field delete successfully !');
              location.reload();
             }
          }
      }); 
   }
   
     function field_status_pre_student(field_id){
    //alert(field_id);
      $('.msgs').text("")
      $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('ajax/update_field_status_pre_student'); ?>",
          data   : { field_id : field_id},               
          async  : false,
          success: function(data){                                                   
             if(data)
             {
              //alert(data);
              $('#msgs'+field_id).text(data);
              $("#msgs"+field_id).show().delay(3000).fadeOut();
              //$('#msg'+field_id).text("");
             }
          }
      }); 
   }

  function delete_field_pre_student(del_val){
      $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('ajax/detele_fields_pre_student'); ?>",
          data   : { 'del_val' : del_val},               
          async  : false,
          success: function(data){                                                   
             if(data)
             {
              alert('Field delete successfully !');
              location.reload();
             }
          }
      }); 
   }
   
   
</script>