<?php $activeTab = "teacher"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Teachers</a></li>
        <li class="active">Add Teacher</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/teacher_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<?php
     $field_arr = array();
     $create_status = $this->db->get_where('registration_form_setting_teacher',array('status'=>'0','created_html' => '1'))->result();
     foreach ($create_status as $key => $field_dt) {
        $field_arr[] = $field_dt->name;
     }
     
    //print_r($field_arr);
?>

<div class="row">
	<div class="col-md-8">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('teacher_admission_form');?>
            	</div>
            </div>
			<div class="panel-body">


                <?php echo form_open(site_url('admin/teacher/create/') , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

    					
                    <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Name</label>

						<div class="col-sm-5">
							<input class="form-control" name="name" data-validate="required" data-message-required="Value Required" value="" autofocus="" type="text">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">RFID</label>

						<div class="col-sm-5">
							<input class="form-control" name="rfid" data-validate="required" data-message-required="Value Required" value="" type="text">
						</div>
					</div>
                <?php if(!in_array("designation", $field_arr)){ ?>
					<div class="form-group hidden">
						<label for="field-2" class="col-sm-3 control-label">Designation</label>
						<div class="col-sm-5">
							<input class="form-control" name="designation" value="6" type="hidden">
						</div>
					</div>
                <?php }
                 if(!in_array("birthday", $field_arr)){ ?>
               
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Birthday</label>

						<div class="col-sm-5">
							<input class="form-control datepicker" name="birthday" value="" data-start-view="2" type="text">
						</div>
					</div>
				<?php }
				 if(!in_array("gender", $field_arr)){
				  ?>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Gender</label>

						<div class="col-sm-5">
							<select name="sex" class="form-control selectboxit">
                              <option value="">Select</option>
                              <option value="male">Male</option>
                              <option value="female">Female</option>
                          </select>
						</div>
					</div>
                 <?php }?>
                  <?php
                $query = $this->db->get('class');
                if ($query->num_rows() > 0){
                    $class = $query->result_array();
                }
    
            ?>
                 <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('assign_class'); ?></label>
                        <div class="col-sm-5">
                        <select class="form-control selectboxit" name="class_id" onchange="select_section(this.value)">
                            <option value=""><?php echo get_phrase('select_class'); ?></option>
                            <?php foreach ($class as $row): ?>
                            <option value="<?php echo $row['class_id']; ?>" ><?php echo $row['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        </div>
                    </div>
                        <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('assign_section'); ?></label>
                                <div class="col-sm-5">
                                    <div id="section_holder">
                                    <select class="form-control selectboxit" name="section_id">
                                        <option value=""><?php echo get_phrase('select_class_first') ?></option>
                    
                                    </select>
                                </div>
                            </div>
                        </div>
                 
                 <?php
                 if(!in_array("address", $field_arr)){
                  ?>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Address</label>

						<div class="col-sm-5">
							<input class="form-control" name="address" value="" type="text">
						</div>
					</div>
				<?php } ?>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label" data-validate="required" data-message-required="Value Required">Phone</label>
						<div class="col-sm-5">
							<input class="form-control" name="phone" value="" type="text">
						</div>
					</div>
						
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Email</label>
						<div class="col-sm-5">
							<input class="form-control" name="email" value="" data-validate="required" type="text">
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Password</label>

						<div class="col-sm-5">
							<input class="form-control" name="password" value="" data-validate="required" type="password">
						</div>
					</div>
			          <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Salary Type </label>

						<div class="col-sm-5">
							<select name="salary_type" class="form-control selectboxit">
                              <option value="">Select</option>
                              <option value="monthly">Monthly</option>
                              <option value="hourly">Hourly</option>							
                          </select>
						</div>
					</div>

					    <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Date Of Joining </label>

						<div class="col-sm-5">
						<input type="text" class="form-control datepicker" name="timestamp" data-format="dd-mm-yyyy"
			          	value="<?php echo date("d-m-Y");?>"/>
						</div>
					</div>
					
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Salary Grade </label>

						<div class="col-sm-5">
							<select name="salary_grade_id" class="form-control selectboxit">
                              <option value="">Select</option>
					            <?php
					                $children_of_parent = $this->db->get_where('salary_grades' , array(
					                    'status' =>1
					                ))->result_array();
									foreach ($children_of_parent as $row):
					            ?>
                              <option value="<?php echo $row['id'];?>"><?php echo $row['grade_name'];?></option>
							    <?php endforeach;?>  
                            </select>
						</div>
					</div>

				<?php 
				if(!in_array("social_links", $field_arr)){
				?>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Social Links</label>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="form-control" name="facebook" placeholder="" value="" type="text">
								<div class="input-group-addon">
									<a href="#"><i class="entypo-facebook"></i></a>
								</div>
							</div>
							<br>
							<div class="input-group">
								<input class="form-control" name="twitter" placeholder="" value="" type="text">
								<div class="input-group-addon">
									<a href="#"><i class="entypo-twitter"></i></a>
								</div>
							</div>
							<br>
							<div class="input-group">
								<input class="form-control" name="linkedin" placeholder="" value="" type="text">
								<div class="input-group-addon">
									<a href="#"><i class="entypo-linkedin"></i></a>
								</div>
							</div>

						</div>
					</div>
				<?php } 
				if(!in_array("social_links", $field_arr)){ ?>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Show On Website</label>
						<div class="col-sm-5">
							<select name="show_on_website" class="form-control selectboxit">
			                  <option value="1">Yes</option>
			                  <option value="0">No</option>
			             	</select>
						</div>
					</div>
				<?php } ?>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Photo</label>

						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="http://placehold.it/200x200" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input name="userfile" accept="image/*" type="file">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>
				<?php 
                   foreach ($create_dianamic_field as $htmlcode) { 
                    	echo  json_decode($htmlcode->html_code);
                    }
                    ?>
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info">Add Teacher</button>
						</div>
					</div>
                
                <?php echo form_close();?>
            </div>
        </div>
    </div>
    <div class="col-md-4 studentSidebar">
		<blockquote class="blockquote-blue">
			<p>
				<strong>Teacher Registration Notes</strong>
			</p>
			<p>
				Admitting new students will automatically create an enrollment to the selected class in the running session.
				Please check and recheck the informations you have inserted because once you admit new student, you won't be able
				to edit his/her class,roll,section without promoting to the next session.
			</p>
		</blockquote>

		<div class="addFieldBox">
			<h4>
				<strong>Field Management</strong>
			</h4>
			<div class="addField">
				<i class="fa fa-plus"></i> Add New Field
			</div>

			<div class="fieldBoxContainer">

			<div class="form-group fieldBox">
				<label for="field-2" class="col-sm-4 control-label text-left">Field Name</label>
				
				<div class="col-sm-8">
					<input type="text" class="form-control" id="filedName" name="filedName" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" onblur="checkfieldsname(this.value);" required>

					<span class="errorMsg" id="fieldNameError"></span>
				</div>

			</div>


			<div class="form-group fieldBox">
				<label for="field-2" class="col-sm-4 control-label">Field Type</label>

				<div class="col-sm-8">
					<select name="" id="fieldType" class="form-control col-md-12" disabled>
						<option value="">--select--</option>
						<option value="textbox">Text Box</option>
						<option value="textarea">Text Area</option>
						<option value="selectbox">Select Box</option>
						<option value="imageupload">Image Upload</option>
						<option value="documentupload">Document Upload</option>
					</select>
				</div>
			</div>
			

			<div class="form-group fieldBox textBox">
				<label for="field-2" class="col-sm-4 control-label text-left"> Placeholder</label>

				<div class="col-sm-8">
					<input type="text" class="form-control" name="placeHolder" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" >
				</div>
			</div>

			<div class="form-group fieldBox selectBox">
				<label for="field-2" class="col-sm-4 control-label text-left">Enter Options</label>

				<div class="col-sm-8 optionList">
					<input type="text" class="form-control" name="option1" data-validate="required"  value="" >
				</div>

				<div class="form-group pull-right" style="padding-right: 20px;"><span class="anotherOption">Add Another Option <i class="fa fa-plus"></i></span></div>	
			</div>


			<div class="col-md-12 saveField text-right form-group" ><span class="" style="">Add Field</span></div>	



			</div>


		</div>

		<div>
			<div>
				To change registration form fields click <a href="<?php echo base_url(); ?>index.php/admin/system_settings"> here</a>
			</div>
			
		</div>

	</div>

</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript">

	function get_class_sections(class_id) {

    	$.ajax({
            url: '<?php echo site_url('admin/get_class_section/');?>' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });

    }





//Function Added By Bhuvan
$(document).ready(function(){

	//Adding deleteNode button
	//$('.form-horizontal .form-group:not(:last)').append("<span class='removeNode col-md-2 pull-right' title='Delete Fields'><i class='fa fa-times'></i></span>");
	$('.removeNode').click(function(){
	  	var parentNode = $(this).parent().children('label').text();
	 	if(confirm('Do you realy want to delete ' + parentNode + ' field')){
	 		$(this).parent().remove();
	 		alert(parentNode + ' filed deleted.')
	 	}
	 });
});


$('.addField').click(function(){
   $('.fieldBoxContainer').css('display','block');
});

$('#fieldType').change(function(){
		let fieldType = $('#fieldType option:selected').val();
		if(fieldType == 'textbox' || fieldType == 'textarea'){
			$('.textBox').css('display','block');
			$('.selectBox').css('display','none');
			$('.saveField').css('display', 'block');
		}

		else if(fieldType == 'selectbox'){
			$('.selectBox').css('display','block');
			$('.textBox').css('display','none');
			$('.saveField').css('display', 'block');
		}

		else if(fieldType == 'imageupload' || fieldType == 'documentupload' ){
			$('.selectBox').css('display','none');
			$('.textBox').css('display','none');
			$('.saveField').css('display', 'block');

		}
		
	});


var i = 2;
$('.anotherOption').click(function(){
	$('.optionList').append('<input type="text" class="form-control" name="option" data-validate="required"  value="" >');

});

$('#filedName').keyup(function(){
	if(($(this).val()).length > 5){
		$('#fieldType').removeAttr('disabled');
		$('#fieldNameError').text('');

	}

	else {
		$('#fieldType').attr('disabled','');
		$('#fieldNameError').text('Minimum 6 words long');
	}

	
})

$('.saveField').click(function(){
		//let fieldType = $('#fieldType option:selected').val();
		addField();
 });


function addField(filedType){
	let fieldName = $('#filedName').val();
	if(fieldName == "")
		return false;
	
	let fieldType = $('#fieldType option:selected').val();
    var data_in = new Object();
    var options;
	data_in['value'] = "";
	$('.optionList input').each(function(){
		options += '<option>'+$(this).val()+'</option>';
	});

	if(options != ""){
       data_in['value'] = options;
	}
   
    
        fieldName_lower        = fieldName.toLowerCase().replace(/\s+/g,"_");
	    data_in['name']        = fieldName_lower;
	    data_in['type']        = fieldType;
	    data_in['description'] = fieldName;

	    if(fieldType == "")
	 	 return false;     
	
	    //var data1[]  = data_in;
	    //console.log(data_in);
    
	let textboxModule = '<div class="form-group"><label for="field-1" class="col-sm-3 control-label">'+fieldName+'</label><div class="col-sm-5"><input type="text" class="form-control" name='+fieldName_lower+' data-validate="required" value="" autofocus required></div></div>';

	let textareaModule = '<div class="form-group"><label for="field-1" class="col-sm-3 control-label">'+fieldName+'</label><div class="col-sm-5"><textarea class="form-control" name = '+fieldName_lower+'></textarea></div></div>';

	let imageuploadModule = '<div class="form-group"><label for="field-1" class="col-sm-3 control-label">'+fieldName+'</label><div class="col-sm-5"><div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden" ><div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput"><img src="http://placehold.it/200x200" alt="..."></div><div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;"></div><div><span class="btn btn-white btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input name = '+fieldName_lower+'  accept="image/*" type="file"></span><a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a></div></div></div></div>';

	let documentuploadModule = '<div class="form-group"><label for="field-1" class="col-sm-3 control-label">'+fieldName+'</label><div class="col-sm-5"><div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden"><div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput"><img src="http://placehold.it/200x200" alt="..."></div><div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;"></div><div><span class="btn btn-white btn-file"><span class="fileinput-new">Select Document</span><span class="fileinput-exists">Change</span><input name='+fieldName_lower+' accept="image/*" type="file"></span><a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a></div></div></div></div>';


	let selectboxModule = '<div class="form-group "><label for="field-2" class="col-sm-3 control-label">'+fieldName+'</label><div class="col-sm-5"><select name='+fieldName_lower+' id="fieldTypeselect" class="form-control col-md-12" >'+options+'</select></div></div>';

    var html_data = "";
	if(fieldType === 'textbox'){
		html_data = textboxModule;
		//$('.form-horizontal').append(textboxModule);
	}

	else if(fieldType == "textarea"){
		html_data = textareaModule;
		//$('.form-horizontal').append(textareaModule);
	}

	else if(fieldType == "selectbox"){
		html_data = selectboxModule;
		//$('.form-horizontal').append(selectboxModule);
	}


	else if(fieldType == "imageupload"){
		html_data = imageuploadModule;
		//$('.form-horizontal').append(imageuploadModule);
	}

	else if(fieldType == "documentupload"){
		html_data = documentuploadModule;
		//$('.form-horizontal').append(documentuploadModule);
	}

    var json_field_elements = JSON.stringify(data_in);
    var json_html = JSON.stringify(html_data);
    //alert(json_html);

   //'type':fieldType,
    $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('ajax/insert_registration_fields_teacher'); ?>",
          data   : {'json_field_elements' : json_field_elements,'name':fieldName_lower,'html_code':json_html,'description':fieldName },               
          async  : false,
          success: function(data){                                                   
           
              location.reload();
           
          }
      });
   
    alert(fieldName + 'Field Addedd');
	

	$('.fieldBoxContainer').css('display','none');

	$('.removeNode').click(function(){
	  	var parentNode = $(this).parent().children('label').text();
	 	if(confirm('Do you realy want to delete ' + parentNode + ' field')){
	 		$(this).parent().remove();
	 		alert(parentNode + ' filed deleted.')
	 	}
	 });



} 

function checkfieldsname(val){
 //alert(val);
 var lowerval = val.toLowerCase();
 var valrep =  lowerval.replace(/\s+/g,"_");
 
 $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('ajax/check_registration_fields'); ?>",
          data   : {'val' : valrep},               
          async  : false,
          success: function(data){                                                   
             if(data == "1")
             {
              alert('Field Name already exist, Please enter different value !');
              $('#filedName').val("");
              
             }
          }
      });
}


/*function create_form(){
	alert('refsdf');
 
   console.log($('.form-horizontal').html());
 
}*/


</script>

<script type="text/javascript">
    function select_section(class_id) {

        $.ajax({
            url: '<?php echo site_url('admin/get_section/'); ?>' + class_id,
            success: function (response)
            {
                response = response.replace('col-md-3', '');
                //response = response.replace('onchange="sectio_id()"', '');
                response = response.replace('<label class="control-label" style="margin-bottom: 5px;">Section</label>', '');
                $('#section_holder').html(response);
                // var content = $.parseHTML(response);
                // console.log(response);
                // var contentSelect = $(content).find('select').html();
                // console.log(contentSelect);
                // $('#section_holder').find('select').html(contentSelect);
            }
        });
    }
</script>