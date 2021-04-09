<?php $activeTab = "pre_exam"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Pre Exam</a></li>
        <li class="active">Student Registration</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/admission_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>
<?php
     $field_arr = array();
     $create_status = $this->db->get_where('registration_form_setting_pre_student',array('status'=>'0','created_html' => '1'))->result();

     foreach ($create_status as $key => $field_dt) {
        $field_arr[] = $field_dt->name;
     }
     
  
?>
<div class="row" style="margin-top:15px;">
	<div class="col-md-8">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('addmission_form');?>
            	</div>
            </div>
			<div class="panel-body">
                <?php echo form_open(site_url('admin/student_pre/create/') , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus required>
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('parent');?></label>

						<div class="col-sm-5">
						<input type="text" class="form-control" name="parent_id" value="">
							<!--<select name="parent_id" class="form-control select2" required>
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php
								$parents = $this->db->get('parent')->result_array();
								foreach($parents as $row):
									?>
                            		<option value="<?php echo $row['parent_id'];?>">
										<?php echo $row['name'];?>
                                    </option>
                                <?php
								endforeach;
							  ?>
                          </select>-->
						</div>
					</div>

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

					

                 <?php if(!in_array("birthday", $field_arr)){ ?>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('birthday');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control datepicker" name="birthday" value="" data-start-view="2">
						</div>
					</div>
                  <?php }  if(!in_array("gender", $field_arr)){ ?>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('gender');?></label>

						<div class="col-sm-5">
							<select name="sex" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="male"><?php echo get_phrase('male');?></option>
                              <option value="female"><?php echo get_phrase('female');?></option>
                          </select>
						</div>
					</div>
<?php }  if(!in_array("address", $field_arr)){ ?>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="address" value="" >
						</div>
					</div>
	               <?php } if(!in_array("phone", $field_arr)){ ?>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="phone" value="" >
						</div>
					</div>
				   <?php } ?>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Category');?></label>

						<div class="col-sm-5">
							<select name="Category" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('General');?></option>
                              <option value="male"><?php echo get_phrase('EWC');?></option>
                              <option value="female"><?php echo get_phrase('Sports Quota');?></option>
                          </select>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="email" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="">
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('password');?></label>

						<div class="col-sm-5">
							<input type="password" class="form-control" name="password" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" >
						</div>
					</div>

				

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>

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
										<input type="file" name="userfile" accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>
					
					     <?php  if(!in_array("upload_signature", $field_arr)){ ?>
						<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('upload_signature');?></label>

						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="http://placehold.it/200x200" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select Signature</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="upload_signature" accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>
				   <?php } ?>
					
					
					
                        <div class="extrafield" style=" border-top: 1px solid #ccc;padding: 5px;">
					<h5 class="user_add ">Custom Fields</h5>
					<?php 
                  // echo '<pre>';
                  // print_r($create_dianamic_field);
                  // echo '</pre>';
                    foreach ($create_dianamic_field as $htmlcode) { 
                    	echo  json_decode($htmlcode->html_code);
						?>
                    <?php if($htmlcode->status == 1 && $htmlcode->created_html == 0){ ?>
                           <!--<span title="permanently delete this field !" class="btn btn-delete" onclick='delete_field_pre_student("<?php echo $htmlcode->id;?>");'><i class="fa fa-close"></i></span>-->
                            <?php }					
                    }
                    ?>
					
			
						</div>
						 <div class="col-sm-4">
                          <span style="color:red" id="msgs<?=$htmlcode->id;?>" class="msg"></span>
                        </div>
                    <div class="form-group">
						<div class="col-sm-12 text-center">
						 <button type="submit" class="btn btn-info"><?php echo get_phrase('add_student');?></button>
						 <button class="btn btn-info bi-blue" onclick='field_status_pre_student("1")'>Form Publish</button> 
						 <div class="btn btn-info bi-pink" onclick="windowOpen()">Form Preview</div> 
						 	<!-- <button class="btn btn-info  bi-pink">
                            <a href="#" onclick="showAjaxModal('https://www.edurama.in/unityerp/index.php/modal/popup/registration_preview');">
                               
                                Print/Form Preview </a></button>-->
                     
						 
						</div>
					</div>
					
					
					
                <?php echo form_close();?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
		<blockquote class="blockquote-blue">
			<p>
				<strong>Student Admission Notes</strong>
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
	</div>

</div>


<script type="text/javascript" >
 

function get_room_by_hostel(hostel_id,type){       
     
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_room_by_hostel'); ?>",
            data   : { hostel_id : hostel_id },               
            async  : false,
            success: function(response){       
              if(response)
               {                  
                if(type == 'edit')
                  $('.edit_room_id').html(response);
                else
                  $('.room_id').html(response);
               }
            }
        });         
    } 

    function transportroute(route_id,type){       
           
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_transportroute'); ?>",
            data   : { route_id : route_id },               
            async  : false,
            success: function(response){                                                   
               if(response)
               {                  
                  
                  if(type == 'edit')
                  	$('#edit_stop_id').html(response);
                  else
                  	$('#stop_id').html(response);
               }
            }
        });         
    }



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
          url    : "<?php echo site_url('ajax/insert_registration_fields_pre_student'); ?>",
          data   : {'json_field_elements' : json_field_elements,'name':fieldName_lower,'html_code':json_html,'description':fieldName },               
          async  : false,
          success: function(data){                                                   
           
              location.reload();
           
          }
      });
   
    alert('Field Successfully added');
	

	$('.fieldBoxContainer').css('display','none');

	$('.removeNode').click(function(){
	  	var parentNode = $(this).parent().children('label').text();
	 	if(confirm('Do you realy want to delete ' + parentNode + ' field')){
	 		$(this).parent().remove();
	 		alert(parentNode +  ' filed deleted.')
	 	}
	 });



} 

function checkfieldsname(val){
 //alert(val);
 var lowerval = val.toLowerCase();
 var valrep =  lowerval.replace(/\s+/g,"_");
 
 $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('ajax/check_registration_fields_pre_student'); ?>",
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
<script>
function field_status_pre_student(field_id){
 //alert(field_id);
      $('.msg').text("")
      $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('ajax/update_field_pre_student_status'); ?>",
          data   : { field_id : field_id},               
          async  : false,
          success: function(data){  
		  
             if(data)
             {
              alert('Form Publish !');
              $('#msg_t'+field_id).text(data);
              $("#msg_t"+field_id).show().delay(3000).fadeOut();          
             }
          }
      }); 
   }

  function delete_field_pre_student(del_val){
      $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('ajax/detele_fields_pre_student'); ?>",
          data   : { 'del_val' : del_val},               
          async  : false,
          success: function(data){                                                   
             if(data)
             {
              alert('Field delete successfully !');
              location.reload();
             }
          }
      }); 
   }   
</script>
	<script> 
			var Window; 
			
			// Function that open the new Window 
			function windowOpen() { 
Window = window.open("<?php echo site_url();?>/admission/registration_preview","_blank","width=600, height=550" ); 
			} </script> 
<!-- NOTE :: Removed Section, Id No, Dormitory, Transport Fields -->
<!-- NOTE :: Removed Section, Id No, Dormitory, Transport Fields -->