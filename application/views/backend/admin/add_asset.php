<?php $activeTab = "assets_management_dashboard"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Assets List</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/assets_management_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<div class="row">
	<div class="col-md-12">
    
    	<!--CONTROL TABS START-->
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('asset_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_asset');?>
                    	</a></li>
		</ul>
    	<!--CONTROL TABS END-->
        
	
		<div class="tab-content">
        <br>
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box <?php if(!isset($edit_data))echo 'active';?>" id="list">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered datatable">
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('asset_name');?></div></th>
                    		<th><div><?php echo get_phrase('number_of_asset');?></div></th>
							<th><div><?php echo get_phrase('asset_category');?></div></th>
                    		<th><div><?php echo get_phrase('description');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    <?php if($asset_data != ""){

                    foreach ($asset_data as  $dt) {
                     
                     ?>
                        <tr>
							<td><?php echo $dt->name;?></td>
							<td><?php echo $dt->number_asset;?></td>
							<td><?php echo @$this->db->get_where('asset_category',array('asset_category_id'=>$dt->category))->row()->category;?></td>
							<td><?php echo $dt->description;?></td>
							<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                    <!-- STUDENTS IN THE DORM -->
                                    <!-- <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_dormitory_student/'.$dt->asset_id);?>');">
                                            <i class="entypo-users"></i>
                                                <?php echo get_phrase('students');?>
                                            </a>
                                                    </li> -->
                                    <li class="divider"></li>
                                    
                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_edit_assets/'.$dt->asset_id);?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    
                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo site_url('admin/add_asset/delete/'.$dt->asset_id);?>');">
                                            <i class="entypo-trash"></i>
                                                <?php echo get_phrase('delete');?>
                                            </a>
                                                    </li>
                                </ul>
                            </div>
        					</td>
                        </tr>
                    <?php  } } ?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(site_url('admin/add_asset/create'), array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('asset_name');?>*</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name"
                                        data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('number_of_asset');?>*</label>
                                <div class="col-sm-5">
                                    <input type="number" class="form-control" name="number_of_asset" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
							<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('asset_category');?>*</label>

						<div class="col-sm-5">
							<select name="asset_category" class="form-control select2" required>
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php
								$asset = $this->db->get('asset_category')->result_array();
								foreach($asset as $row):
									?>
                            		<option value="<?php echo $row['asset_category_id'];?>">
										<?php echo $row['category'];?>
                                    </option>
                                <?php
								endforeach;
							  ?>
                          </select>
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
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_asset');?></button>
                              </div>
							</div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->
            
		</div>
	</div>
</div>
