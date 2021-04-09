<?php $activeTab = "card_settings"; ?>
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
                   Select fields to be shown on id card 
                </div>
               
            </div>


            <div class="panel-body form-horizontal form-groups-bordered">
                
                <?php 
                  $fieldsetting = $this->db->get_where('registration_form_setting',array('created_html'=> 0, 'status'=>1))->result();  
                  foreach ($fieldsetting as $key => $dt) {
                ?>    
                  <div class="form-group">
                        <label class="col-sm-5 control-label"><?php echo $dt->description; ?></label>
                          <div class="col-sm-3">
                            <div class="container">
                            <label class="control control--checkbox">
                              <input type="checkbox" name="disable_frontend" <?php if ($dt->genrate_id == 1) echo 'checked'; ?>  onclick = 'field_status("<?php echo $dt->id;?>")'/>
                              <div class="control__indicator">
                                
                              </div>
                            </label>


                          </div>
                          
                        </div>
                        <div class="col-sm-4">
                          <span style="color:red" id="msg<?=$dt->id;?>" class="msg"></span>
                        </div>
                    </div>
                  <?php } ?>
                  
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