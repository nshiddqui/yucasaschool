<?php $activeTab = "assets_management_dashboard"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Assets Report</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/assets_management_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>
<br/>
<a href="javascript:;" class="btn btn-primary pull-right"><i class="entypo-print"></i>Print Report</a>

<div class="row">
	<div class="col-md-12">
    
    	<!--CONTROL TABS START-->
		<ul class="nav nav-tabs bordered hidden">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('asset_list');?>
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
                           <!--  <th><div><?php //echo get_phrase('asset_date');?></div></th> -->
                    		<th><div><?php echo get_phrase('description');?></div></th>
                    		<!-- <th><div><?php //echo get_phrase('options');?></div></th> -->
						</tr>
					</thead>
                    <tbody>
                    <?php if($asset_data != ""){
                        foreach ($asset_data as  $dt) { 
                            ?>
                        <tr>
							<td><?php echo $dt->name;?></td>
							<td><?php echo $dt->number_asset;?></td>
							<td><?php echo @$this->db->get_where('asset_category', array('asset_category_id' => $dt->category))->row()->category; ?></td>
                          <!--   <td><?php echo $dt->number_asset;?></td> -->
							<td><?php echo $dt->description;?></td>
						</tr>
                      <?php } } ?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS---> 
		</div>
	</div>
</div>