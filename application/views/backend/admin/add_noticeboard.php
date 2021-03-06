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

                    <div class="form-group">
                      <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('image');?></label>
                      <div class="col-sm-7">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                          <div class="fileinput-new thumbnail" style="width: 300px; height: 150px;" data-trigger="fileinput">
                            <img src="<?php echo base_url(); ?>uploads/placeholder.png" alt="...">
                          </div>
                          <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                          <div>
                            <span class="btn btn-white btn-file">
                              <span class="fileinput-new"><?php echo get_phrase('select_image'); ?></span>
                              <span class="fileinput-exists"><?php echo get_phrase('change'); ?></span>
                              <input type="file" name="image" accept="image/*">
                            </span>
                            <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('remove'); ?></a>
                          </div>
                        </div>
                      </div>
                    </div>

                    <input type="hidden" name="show_on_website" value="0">

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('send_sms_to_all'); ?></label>
                        <div class="col-sm-4">
                            <select class="form-control selectboxit" name="check_sms">
                                <option value="1"><?php echo get_phrase('yes'); ?></option>
                                <option value="2"><?php echo get_phrase('no'); ?></option>
                            </select>
                            <br>
                            <span class="badge badge-primary">
                                <?php
                                if ($active_sms_service == 'clickatell')
                                    echo 'Clickatell ' . get_phrase('activated');
                                if ($active_sms_service == 'twilio')
                                    echo 'Twilio ' . get_phrase('activated');
                                if ($active_sms_service == '' || $active_sms_service == 'disabled')
                                    echo get_phrase('sms_service_not_activated');
                                ?>
                            </span>
                        </div>
                    </div>
                              
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" id="submit_button" class="btn btn-info"><?php echo get_phrase('add_notices'); ?></button>
                        </div>
                    </div>
                    </form>
                </div>
                </div>