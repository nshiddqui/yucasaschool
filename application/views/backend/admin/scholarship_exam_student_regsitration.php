<?php $activeTab = "scholarship"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Scholarship</a></li>
        <li class="active">Student Registration</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/scholarship_management_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<div class="row">
	<div class="col-md-8">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('addmission_form');?>
            	</div>
            </div>
			<div class="panel-body">

                <?php echo form_open(site_url('admin/scholarship_exam_student_regsitration/create/') , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

					

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>

						<div class="col-sm-5">
							<select name="class_id" class="form-control" data-validate="required" id="class_id"
								data-message-required="<?php echo get_phrase('value_required');?>"
									onchange="return get_class_sections(this.value)">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php
								$classes = $this->db->get('class')->result_array();
								foreach($classes as $row):
									?>
                            		<option value="<?php echo $row['class_id'];?>">
											<?php echo $row['name'];?>
                                            </option>
                                <?php
								endforeach;
							  ?>
                          </select>
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('section');?></label>
		                    <div class="col-sm-5">
		                        <select name="section_id" class="form-control" id="section_selector_holder" onchange="get_section_by_student(this.value);">
		                            <option value=""><?php echo get_phrase('select_class_first');?></option>

			                    </select>
			                </div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('select_student');?></label>
		                    <div class="col-sm-5">
		                        <select name="student_list" class="form-control" id="student_list" >
		                            <option value=""><?php echo get_phrase('select_section_first');?></option>

			                    </select>
			                </div>
					</div>


					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('id_no');?></label>

						<div class="col-sm-5">
							<input type="text" readonly class="form-control" id="student_name" name="student_code" value="<?php echo substr(md5(uniqid(rand(), true)), 0, 7); ?>" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('parent_name');?></label>

						<div class="col-sm-5">
							<input type="text" readonly class="form-control" id="parent_name" name="student_code" value="<?php echo substr(md5(uniqid(rand(), true)), 0, 7); ?>" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('email_id');?></label>

						<div class="col-sm-5">
							<input type="text" readonly class="form-control" id="email" name="student_code" value="<?php echo substr(md5(uniqid(rand(), true)), 0, 7); ?>" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('dob');?></label>

						<div class="col-sm-5">
							<input type="text" readonly class="form-control" id="dob" name="student_code" value="<?php echo substr(md5(uniqid(rand(), true)), 0, 7); ?>" >
						</div>
					</div>

					

                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('add_student');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
		<blockquote class="blockquote-blue">
			<p>
				<strong>Scholarship Registration Notes</strong>
			</p>
			<p>
				Admitting new students will automatically create an enrollment to the selected class in the running session.
				Please check and recheck the informations you have inserted because once you admit new student, you won't be able
				to edit his/her class,roll,section without promoting to the next session.
			</p>
		</blockquote>
	</div>
</div>

<script type="text/javascript">

	function get_class_sections(class_id) {

    	$.ajax({
            url: '<?php echo site_url('admin/get_class_section/');?>' + class_id ,
            success: function(response)
            {
            	console.log(response);
                jQuery('#section_selector_holder').html(response);
            }
        });

    }

    function get_section_by_student(section_id,classid=""){  


     var classid = document.getElementById('class_id').value;    
    
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_section_by_student'); ?>",
            data   : { class_id : classid,section_id:section_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                console.log(response);
                $('#student_list').html(response);
               }
            }
        });  
    }

    function get_student_name(classid){
        var studentname = $("#student_list :selected").text();
        $('#student_name').val(studentname);
    }
      
   $( "#student_list" ).change(function() {
     var student_id = $(this).val();
     $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_student_details'); ?>",
            data   : { student_id : student_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
               	if(response != ""){
               	var parsejson =   JSON.parse(response);
                if(parsejson.length > 0){
                    $('#parent_name').val(parsejson[0]['parent_name']);
                    $('#email').val(parsejson[0]['email']);
                    $('#dob').val(parsejson[0]['birthday']);
                    $('#student_name').val(parsejson[0]['student_code']);
                 }
                }
               
             }
            }
        });  
   });
</script>
