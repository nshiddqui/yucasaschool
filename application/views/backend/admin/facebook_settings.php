<?php $activeTab = "facebook_setting"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Facebook Setting</a></li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/setting_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<section class="container-fluid p0">
  <div class="row  mt-2 mb-2 ">
    <div class="col-sm-6 mx-auto  ">
      <div class="panel panel-primary" >
        <div class="panel-heading">
            <div class="panel-title">
                <?php echo get_phrase('facebook_embedd_settings');?>
            </div>
        </div>

        <div class="panel-body bg-white">
          <form action="" class="" id="facebook_settings_form">
            <div class="form-group row">
                <label  class="col-sm-5 control-label"><strong>Facebook Page Name</strong></label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="page_name"
                        value="<?php echo $facebook_settings[0]['page_name'];?>" required placeholder="Facebook page name...">
                </div>
            </div>

            <div class="form-group row">
                <label  class="col-sm-5 control-label"><strong>Page Width</strong></label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="page_width"
                        value="<?php echo $facebook_settings[0]['page_width'];?>" required placeholder="The pixel width (Min. 180 to Max. 500) | Default is 400">
                </div>
            </div>

            <div class="form-group row">
                <label  class="col-sm-5 control-label"><strong>Page Height</strong></label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="page_height"
                        value="<?php echo $facebook_settings[0]['page_height'];?>" required placeholder="The pixel height | Default is 500"> 
                </div>
            </div>


            <div class="form-group row">
                <label  class="col-sm-5 control-label"><strong>Tabs Type</strong></label>
                <div class="col-sm-7">
                    <select name="tab_type" id="" class="form-control">
                      <option value="timeline" <?php if($facebook_settings[0]['tab_type'] == 'timeline'){echo 'selected';}?> >Timeline</option>
                      <option value="events" <?php if($facebook_settings[0]['tab_type'] == 'events'){echo 'selected';}?> >Events</option>
                      <option value="messages" <?php if($facebook_settings[0]['tab_type'] == 'messages'){echo 'selected';}?> >Messages</option>
                    </select>
                </div>
            </div>


            <div class="form-group row">
              <label  class="col-sm-5 control-label"><strong>Use Small Header</strong></label>
              <div class="col-sm-7">
                <input type="checkbox" name="small_header" value="" <?php if($facebook_settings[0]['small_header'] == 1){echo 'checked';}?>>
              </div>
            </div>

            <div class="form-group row">
              <label  class="col-sm-5 control-label"><strong>Hide Cover Photo</strong></label>
              <div class="col-sm-7">
                <input type="checkbox" name="cover_photo" value="" <?php if($facebook_settings[0]['cover_photo'] == 1){echo 'checked';}?>>
              </div>
            </div>

            <div class="form-group row">
              <label  class="col-sm-5 control-label"></label>
              <div class="col-sm-7">
                <button class="btn btn-default" type="submit">Save Details</button>
              </div>
            </div>


          </form>
        </div>
    </div>
    </div>


    <div class="col-sm-6 mx-auto  ">
      <div class="panel panel-primary" >
        <div class="panel-heading">
            <div class="panel-title">
                <?php echo get_phrase('facebook_API_settings');?>
            </div>
        </div>

        <div class="panel-body bg-white">
          <form action="" class="" id="facebook_api_settings_form">
            <div class="form-group row">
                <label  class="col-sm-5 control-label"><strong>Facebook User ID</strong></label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="user_id"
                        value="<?php echo $facebook_settings[0]['user_id'];?>" required placeholder="Your User ID">
                </div>
            </div>

            <div class="form-group row">
                <label  class="col-sm-5 control-label"><strong>Access Token</strong></label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="access_token"
                        value="<?php echo $facebook_settings[0]['access_token'];?>" required placeholder="Your Access token">
                </div>
            </div>

            <div class="form-group row">
              <label  class="col-sm-5 control-label"></label>
              <div class="col-sm-7">
                <button class="btn btn-default" type="submit">Save Details</button>
              </div>
            </div>

          </form>
        </div>
    </div>
    </div>

  </div>
</section>





<script>
$("#facebook_settings_form").submit(function(e) {
    e.preventDefault();

    var form = $(this);
    var data =  $("#facebook_settings_form").serialize();
    console.log(data);
    $.ajax({
           type: "POST",
           url: "<?php echo site_url('admin/update_facebook_settings/'); ?>",
           data: data,
           success: function(data)
           {
              if(parseInt(data) == 1){
                 toastr.success('Data Updated successfully.')
              }
           }
         });

     // avoid to execute the actual submit of the form.
});

$("#facebook_api_settings_form").submit(function(e) {
    e.preventDefault();

    var form = $(this);
    var data =  $("#facebook_api_settings_form").serialize();
    console.log(data);
    $.ajax({
           type: "POST",
           url: "<?php echo site_url('admin/update_facebook_api_settings/'); ?>",
           data: data,
           success: function(data)
           {
              if(parseInt(data) == 1){
                 toastr.success('Data Updated successfully.')
              }
           }
         });

     // avoid to execute the actual submit of the form.
});
</script>