<?php $activeTab = "student"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Admission</a></li>
        <li class="active">Admit Bulk Student</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/admission_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>
<div class="col-md-6">
<?php echo form_open(site_url('admin/bulk_student_add_using_csv/import') ,
			array('class' => 'form-inline validate', 'style' => 'text-align:center;',  'enctype' => 'multipart/form-data'));?>
<div class="row">
	<div class="col-md-6">
		<div class="form_group text-left">
			<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class');?></label>
			<select name="class_id" id="class_id" class="form-control selectboxit" required
				onchange="get_sections(this.value)"  data-validate="required"  data-message-required="<?php echo get_phrase('value_required');?>">
				<option value="" class="text-left"><?php echo get_phrase('select_class');?></option>
				<?php
					$classes = $this->db->get('class')->result_array();
					foreach($classes as $row):
				?>
				<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
				<?php endforeach;?>
			</select>
		</div>
	</div>
	<div id="section_holder" class="col-md-6 text-left">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section');?></label>
		<select name="section_id" id="section_id" class="form-control selectboxit">
			<option value="" class="text-left"><?php echo get_phrase('select_class_first');?></option>
		</select>
	</div>
</div>

<div class="row">
	<ul class="list-btn">
	<li >
		<button type="button" class="btn btn-primary" name="generate_csv" id="generate_csv"><?php echo get_phrase('generate_').'CSV '.get_phrase('file'); ?></button>
	</li>
	
	<!--<div class="col-md-offset-4 col-md-4" style="padding: 15px;">
		<button type="button" class="btn btn-primary" name="downlaod_csv" id="downlaod_csv" style="background-color: #455f5c !important;"><?php echo get_phrase('download_Student_Record_').'CSV '.get_phrase('file'); ?></button>
	</div>-->
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

<?php echo form_close();?>
</div>
<div class="col-md-6">
<div class="row">
	<div class="col-md-12">
	<blockquote class="blockquote-blue">
		<p style="font-weight: 700; font-size:0.8vw;">
			<?php echo get_phrase('please_follow_the_instructions_for_adding_bulk_student:'); ?> CSV file
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
<a href="" download="bulk_student.csv" style="display: none;" id = "bulk">Download</a>

<script>

</script>
<script type="text/javascript">
var class_selection = '';
jQuery(document).ready(function($) {
$('#submit_button').attr('disabled', 'disabled');

});
	// function get_sections(class_id) {

	// 	if (class_id != "") {
	// 		$.ajax({

	//             url: '<?php echo site_url('admin/get_sections/');?>' + class_id ,
	//             success: function(response)
	//             {
	//             	console.log(response);
	//                 jQuery('#section_holder').html(response);
	//                 jQuery('#bulk_add_form').show();
	//             },
	//             error : function(request,error){
	//             	console.log(arguments);
 //        			alert(" Can't do because: " + error);
	//             }
	//         });
	// 	}

	// }

	var c_id, s_id;

	function get_sections(class_id) {
	    if (class_id !== '') {
	    c_id = class_id;
	    $.ajax({
	        url: '<?php echo site_url('admin/get_section/'); ?>' + class_id,
	        success:function (response)
	        {	
	        	console.log(response);
	            jQuery('#section_holder').html(response);
	        },
	        error: function(request, error){
	        	console.log("Error is" + error);
	        	console.log("Request" + request);
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
			  	url: '<?php echo site_url('admin/generate_bulk_student_csv/');?>' + class_id + '/' + section_id,
			  	success: function(response) {
			    	toastr.success("<?php echo get_phrase('file_generated'); ?>");
						$("#bulk").attr('href', response);
						jQuery('#bulk')[0].click();
			    	//document.location = response;
			  	}
			});
		}
	});
		$("#download_csv").click(function(){
		var class_id 	= $('#class_id').val();
		var section_id 	= $('#section_id').val();

		if(class_id == '' || section_id == '')
			toastr.error("<?php echo get_phrase('please_make_sure_class_and_section_is_selected'); ?>");
		else {
			$.ajax({
			  	url: '<?php echo site_url('admin/generate_bulk_student_csv/');?>' + class_id + '/' + section_id,
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
