<?php $activeTab = "library"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Facilities</a></li>
        <li class="active">Library</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/facilities_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<?php echo form_open(site_url('librarian/bulk_book_add_using_csv/import') ,
			array('class' => 'form-inline validate', 'style' => 'text-align:center;',  'enctype' => 'multipart/form-data'));?>
<div class="col-md-6">
<div class="row">
<ul class="list-btn">
	<li>
		<button type="button" class="btn btn-primary" name="generate_csv" id="generate_csv"><?php echo get_phrase('generate_').'CSV '.get_phrase('file'); ?></button>
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
	<div class="col-md-12">
	<blockquote class="blockquote-blue">
		<p style="font-weight: 700; font-size: 15px;">
			<?php echo get_phrase('please_follow_the_instructions_for_adding_bulk_books:'); ?>
		</p>
			<ol>
				<li style="padding: 5px;"><?php echo get_phrase('at_first_select_the_class_and_section').'.'; ?></li>
				<li style="padding: 5px;"><?php echo get_phrase('after_selecting_class_and_section_click_').'"Generate CSV File".'; ?></li>
				<li style="padding: 5px;"><?php echo get_phrase('open_the_downloaded_').'"bulk_student.csv" File. '.get_phrase('enter_student_details_as_written_in_there_and_remember_take_the_parent_ID_from_parent_table').'.';?></li>
				<li style="padding: 5px;"><?php echo get_phrase('save_the_edited_').'"bulk_student.csv" File.';?></li>
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


<a href="" download="library_book_bulk.csv" style="display: none;" id = "bulk">Download</a>

<script type="text/javascript">
var class_selection = '';
jQuery(document).ready(function($) {
$('#submit_button').attr('disabled', 'disabled');

});
	function get_sections(class_id) {
		if (class_id != "") {
			$.ajax({
	            url: '<?php echo site_url('admin/get_sections/');?>' + class_id ,
	            success: function(response)
	            {
	                jQuery('#section_holder').html(response);
	                jQuery('#bulk_add_form').show();
	            }
	        });
		}
	}
	$("#generate_csv").click(function(){
		var class_id 	= $('#class_id').val();
		var section_id 	= $('#section_id').val();

		if(class_id == '' || section_id == '')
			toastr.error("<?php echo get_phrase('please_make_sure_class_and_section_is_selected'); ?>");
		else {
			$.ajax({
			  	url: '<?php echo site_url('temp_controller/generate_bulk_book_csvsss/');?>' + class_id + '/' + section_id,
			  	success: function(response) {
			    	toastr.success("<?php echo get_phrase('file_generated'); ?>");
						$("#bulk").attr('href', response);
						jQuery('#bulk')[0].click();
			    	//document.location = response;
			  	}
			});
		}
	});
</script>
