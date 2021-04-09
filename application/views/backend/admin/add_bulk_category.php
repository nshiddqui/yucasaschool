<?php $activeTab = "asset_category"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Add Bulk Category</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/assets_management_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>
<?php echo form_open(site_url('admin/add_bulk_categories/import') ,
			array('class' => 'form-inline validate', 'style' => 'text-align:center;',  'enctype' => 'multipart/form-data'));?>

<div class="col-md-6">		
<div class="row">
<ul class="list-btn">
	<li>
		<button type="button" class="btn btn-primary" > <a href="<?php echo base_url()?>uploads/document/assest_categories_bulk.csv" download style="
    color: white;
"><?php echo get_phrase('generate_').'CSV '.get_phrase('file'); ?></a></button>
		
		
	</li>
	<li>
	<input type="file" name="userfile" class="form-control file2 inline btn btn-info" data-label="<i class='entypo-tag'></i> Select CSV File"
	                   	data-validate="required" data-message-required="<?php echo get_phrase('required'); ?>"
	               		accept="text/csv, .csv" />
	</li>
	<li>
		<button type="submit" class="btn btn-success" name="import_csv" id="import_csv"><?php echo get_phrase('import_CSV'); ?></button>
	</li>
</ul>
</div>
</div>
<?php echo form_close();?>
<div class="col-md-6">	
<div class="row">
	<div>
	<blockquote class="blockquote-blue">
		<p style="font-weight: 700; font-size: 1vw;">
			<?php echo get_phrase('please_follow_the_instructions_for_adding_bulk_parent:'); ?>
		</p>
			<ol>
				<li style="padding: 5px;"><?php echo get_phrase('at_first_select_the_class_and_section').'.'; ?></li>
				<li style="padding: 5px;"><?php echo get_phrase('after_selecting_class_and_section_click_').'"Generate CSV File".'; ?></li>
				<li style="padding: 5px;"><?php echo get_phrase('open_the_downloaded_').'"bulk_parent.csv" File. '.get_phrase('enter_student_details_as_written_in_there_and_remember_take_the_parent_ID_from_parent_table').'.';?></li>
				<li style="padding: 5px;"><?php echo get_phrase('save_the_edited_').'"bulk_parent.csv" File.';?></li>
				<li style="padding: 5px;"><?php echo get_phrase('click_the_').'"Select CSV File" '.get_phrase('and_choose_the_file_you_just_edited').'.';?></li>
				<li style="padding: 5px;"><?php echo get_phrase('import_that_file.');?></li>
				<li style="padding: 5px;"><?php echo get_phrase('hit_').'"Import CSV File".';?></li>
			</ol>
			<p style="color: #FF5722; font-weight: 500;">
				***<?php echo get_phrase('this_system_keeps_track_of_duplication_in_email_ID.').' '.get_phrase('so_please_enter_unique_email_ID_for_every_student').'.'; ?>
			</p>
	</blockquote>
	</div>
</div>
</div>
<a href="" download="bulk_parent.csv" style="display: none;" id = "bulk">Download</a>