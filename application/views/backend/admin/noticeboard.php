<?php $activeTab = "noticeboard"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Noticeboard</a></li>
        <li class="active">Noticeboard List</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
</div>

<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered hidden">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
                    <?php echo get_phrase('noticeboard_list'); ?>
                </a></li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_noticeboard'); ?>
                </a></li>
        </ul>
        <!------CONTROL TABS END------>


        <div class="tab-content">
            <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box <?= isset($list)?'active':''?>" id="list">
                <div class="row">

                    <div class="col-md-12">

                        <ul class="nav nav-tabs bordered"><!-- available classes "bordered", "right-aligned" -->
                            <li class="active">
                                <a href="#running" data-toggle="tab">
                                    <span><i class="entypo-home"></i>
                                        <?php echo get_phrase('running'); ?></span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#archived" data-toggle="tab">
                                    <span><i class="entypo-archive"></i>
                                        <?php echo get_phrase('archived'); ?></span>
                                </a>
                            </li>
							<li class="">
                                <a href="#add_notice" data-toggle="tab">
                                    <span><i class="entypo-archive"></i>
                                        <?php echo get_phrase('add_notice'); ?></span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <br>
                            <div class="tab-pane active" id="running">

                                <?php include 'running_noticeboard.php'; ?>

                            </div>
                            <div class="tab-pane" id="archived">

                                <?php include 'archived_noticeboard.php'; ?>

                            </div>
							<div class="tab-pane" id="add_notice">
 <div class="box-content">
                    <?php echo form_open(site_url('admin/noticeboard/create') , array(
                      'class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data',
                        'target' => '_top')); ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('title'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="notice_title" required />
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label"><?php echo get_phrase('notice'); ?></label>
                  		<div class="col-sm-5">
                  		  <textarea class="form-control" rows="5" name="notice"></textarea>
                  		</div>
                  	</div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('date'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="datepicker form-control" name="create_timestamp"
                              value="<?php echo date('m/d/Y');?>" required />
                        </div>
                    </div>

                    <!--<div class="form-group">-->
                    <!--  <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('image');?></label>-->
                    <!--  <div class="col-sm-7">-->
                    <!--    <div class="fileinput fileinput-new" data-provides="fileinput">-->
                    <!--      <div class="fileinput-new thumbnail" style="width: 300px; height: 150px;" data-trigger="fileinput">-->
                    <!--        <img src="<?php echo base_url(); ?>uploads/placeholder.png" alt="...">-->
                    <!--      </div>-->
                    <!--      <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>-->
                    <!--      <div>-->
                    <!--        <span class="btn btn-white btn-file">-->
                    <!--          <span class="fileinput-new"><?php echo get_phrase('select_image'); ?></span>-->
                    <!--          <span class="fileinput-exists"><?php echo get_phrase('change'); ?></span>-->
                    <!--          <input type="file" name="image" accept="image/*">-->
                    <!--        </span>-->
                    <!--        <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('remove'); ?></a>-->
                    <!--      </div>-->
                    <!--    </div>-->
                    <!--  </div>-->
                    <!--</div>-->

                    <input type="hidden" name="show_on_website" value="0">

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('send_sms_to_all'); ?></label>
                        <div class="col-sm-4">
                            <select class="form-control selectboxit" name="check_sms">
                                <option value="1"><?php echo get_phrase('yes'); ?></option>
                                <option value="2"><?php echo get_phrase('no'); ?></option>
                            </select>
                            <br>
                            <!--<span class="badge badge-primary">
                                <?php
                                if ($active_sms_service == 'clickatell')
                                    echo 'Clickatell ' . get_phrase('activated');
                                if ($active_sms_service == 'twilio')
                                    echo 'Twilio ' . get_phrase('activated');
                                if ($active_sms_service == '' || $active_sms_service == 'disabled')
                                    echo get_phrase('sms_service_not_activated');
                                ?> -->
                            </span>
                        </div>
                    </div>
                       <!--<div class="form-group">-->
                       <!--             <label class="control-label col-md-3 col-sm-3 col-xs-12" for="event_to"> Alert Notification-->
                       <!--             </label>-->
                       <!--             <div class="col-md-6 col-sm-6 col-xs-12">-->
                       <!--                 <input  class="form-control col-md-7 col-xs-12"  name="send_to_all"  id="send_to_all" value="1" type="checkbox" autocomplete="off">-->
                       <!--                 <div class="help-block"><?php echo form_error('send_to_all'); ?></div>-->
                       <!--             </div>-->
                       <!--         </div>-->
                                
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" id="submit_button" class="btn btn-info"><?php echo get_phrase('add_notice'); ?></button>
                        </div>
                    </div>
                    </form>
                </div>
                             

                            </div>
                        </div>


                    </div>

                </div>
            </div>
            <!----TABLE LISTING ENDS--->


            <!----CREATION FORM STARTS---->
            <div class="tab-pane box <?= isset($add)?'active':''?>" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open(site_url('admin/noticeboard/create') , array(
                      'class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data',
                        'target' => '_top')); ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('title'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="notice_title" required />
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label"><?php echo get_phrase('notice'); ?></label>
                  		<div class="col-sm-5">
                  		  <textarea class="form-control" rows="5" name="notice"></textarea>
                  		</div>
                  	</div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('date'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="datepicker form-control" name="create_timestamp"
                              value="<?php echo date('m/d/Y');?>" required />
                        </div>
                    </div>

                    <!--<div class="form-group">-->
                    <!--  <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('image');?></label>-->
                    <!--  <div class="col-sm-7">-->
                    <!--    <div class="fileinput fileinput-new" data-provides="fileinput">-->
                    <!--      <div class="fileinput-new thumbnail" style="width: 300px; height: 150px;" data-trigger="fileinput">-->
                    <!--        <img src="<?php echo base_url(); ?>uploads/placeholder.png" alt="...">-->
                    <!--      </div>-->
                    <!--      <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>-->
                    <!--      <div>-->
                    <!--        <span class="btn btn-white btn-file">-->
                    <!--          <span class="fileinput-new"><?php echo get_phrase('select_image'); ?></span>-->
                    <!--          <span class="fileinput-exists"><?php echo get_phrase('change'); ?></span>-->
                    <!--          <input type="file" name="image" accept="image/*">-->
                    <!--        </span>-->
                    <!--        <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('remove'); ?></a>-->
                    <!--      </div>-->
                    <!--    </div>-->
                    <!--  </div>-->
                    <!--</div>-->

                    <input type="hidden" name="show_on_website" value="0">

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('send_sms_to_all'); ?></label>
                        <div class="col-sm-4">
                            <select class="form-control selectboxit" name="check_sms">
                                <option value="1"><?php echo get_phrase('yes'); ?></option>
                                <option value="2"><?php echo get_phrase('no'); ?></option>
                            </select>
                            <br>
                            <!--<span class="badge badge-primary">
                                <?php
                                if ($active_sms_service == 'clickatell')
                                    echo 'Clickatell ' . get_phrase('activated');
                                if ($active_sms_service == 'twilio')
                                    echo 'Twilio ' . get_phrase('activated');
                                if ($active_sms_service == '' || $active_sms_service == 'disabled')
                                    echo get_phrase('sms_service_not_activated');
                                ?>
                            </span> -->
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" id="submit_button" class="btn btn-info"><?php echo get_phrase('add_notice'); ?></button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <!----CREATION FORM ENDS-->

        </div>
    </div>
</div>