<hr />
<div class="row">
	<div class="col-md-12">

    	<!---CONTROL TABS START-->
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
					<?php echo get_phrase('certificate_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_certificate');?>
                    	</a></li>
		</ul>
    	<!---CONTROL TABS END-->


		<div class="tab-content">
        <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">

                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="books">
                	<thead>
                		<tr>
                        <th width="130px"><div><?php echo get_phrase('certificate_name');?></div></th>
                        <th><div><?php echo get_phrase('certificate_type');?></div></th>
                    	<th><div><?php echo get_phrase('description');?></div></th>
                        <th><div><?php echo get_phrase('download');?></div></th>
                    	<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->


			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(site_url('admin/book/create') , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top','enctype'=>'multipart/form-data'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('certificate_name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name"
                                        data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('certificate_type');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="author"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="description"/>
                                </div>
                            </div>
                             <div class="form-group"> <label class="col-sm-3 control-label">File</label> <div class="col-sm-5"> <input type="file" name="file_name" class="form-control"> </div> </div>

                        		<div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" id = "submit" class="btn btn-info"><?php echo get_phrase('add_book');?></button>
                              </div>
								</div>
                    </form>
                </div>
			</div>
		</div>
	</div>
</div>
