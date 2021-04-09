<hr />
<div class="row">
    <div class="col-md-12">

        <!---CONTROL TABS START-->
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
                    <?php echo get_phrase('salary_payslips_list');?>
                        </a></li>
            <li>
                <a href="#request" data-toggle="tab"><i class="entypo-plus-squared"></i>
                    <?php echo get_phrase('salary_payslips_request');?>
                        </a>
            </li>
        </ul>
        <!---CONTROL TABS END-->


        <div class="tab-content">
        <br>
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">

                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="books">
                    <thead>
                        <tr>
                            <th width="40"><div><?php echo get_phrase('month');?></div></th>
                            <th><div><?php echo get_phrase('year');?></div></th>
                            <th><div><?php echo get_phrase('paid_date');?></div></th>
                            <th><div><?php echo get_phrase('description');?></div></th>
                            <th><div><?php echo get_phrase('download');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>January</td>
                            <td>2018</td>
                            <td>02/01/2018</td>
                            <td>full paid</td>
                            <td><a class="btn btn-blue btn-icon icon-left"><i class="entypo-download"></i>Download</a></td>
                        </tr>
                        <tr>
                            <td>February</td>
                            <td>2018</td>
                            <td>02/02/2018</td>
                            <td>2000 Rs. deduction</td>
                            <td><a class="btn btn-blue btn-icon icon-left"><i class="entypo-download"></i>Download</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!--TABLE LISTING ENDS-->
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box" id="request">
                <div class="box-content">
                    <?php echo form_open(site_url('admin/dormitory/create'), array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('month');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="month"
                                        data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('year');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="year" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="description"/>
                                </div>
                            </div>
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('send_request');?></button>
                              </div>
                            </div>
                    </form>                
                </div> 
            </div>
        </div>
    </div>
</div>
