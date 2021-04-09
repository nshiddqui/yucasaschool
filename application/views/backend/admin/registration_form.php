
<?php
     $field_arr = array();
     $create_status = $this->db->get_where('registration_form_setting_pre_student',array('status'=>'0','created_html' => '1'))->result();

     foreach ($create_status as $key => $field_dt) {
        $field_arr[] = $field_dt->name;
     }
     
  
?>


<div class="row">
	<div class="col-sm-4 registration-headline" >
	
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
		
		
			<blockquote class="blockquote-blue">
			<p>
				<strong>Registration Instructions</strong>
			</p>
			<p>
			<?php echo $this->db->get_where('settings' , array('type' =>'registration_instructions'))->row()->description;?>
			</p>
		</blockquote>
		
		</div>
	<div class="col-sm-8 mx-auto">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('admission_form');?>
            	</div>
            </div>
			<div class="panel-body">
                <?php echo form_open(site_url('admission/student_pre/create/') , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

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
	        
					
				   <?php } ?>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Category');?></label>

						<div class="col-sm-5">
							<select name="Category" class="form-control selectboxit">
                              <option value="General"><?php echo get_phrase('General');?></option>
                              <option value="EWC"><?php echo get_phrase('EWC');?></option>
                              <option value="Sports"><?php echo get_phrase('Sports Quota');?></option>
                          </select>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
				<div class="col-sm-5">
							<input type="email" class="form-control" name="email" id="email" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" />
								<div class="verify_email col-sm-12 p0 mt-2" >
								<a href="">OTP Send Your Email Please check Your Email</a>
							</div>
						</div>

						
					</div>
						<div class="form-group verify_email">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('OTP');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="otp" value="" >
						</div>
				     	</div>
                     <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="phone" value="" id="phone">
							<!--<div class="verify_mobile col-sm-12 p0 mt-2" >
								<a href="">Verify Your Mobile Number</a>
							</div>-->
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
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('registration_fee');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" disabled  name="registration_fees" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $system_name=$this->db->get_where('settings' , array('type'=>'registration_fees'))->row()->description; ?>" >
						</div>
					</div>
					
					
                        <div class="extrafield" style=" border-top: 1px solid #eee;padding: 5px;">
						<br>
					<!-- <h5 style="text-align: center;font-size: 13px;font-weight: 700;">User-Added Fields</h5> -->
					<?php 
   
                    //print_r($create_dianamic_field);

                    foreach ($create_dianamic_field as $htmlcode) { 
                    	echo  json_decode($htmlcode->html_code);
                    }
                    ?>
						</div>
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-4">
				<button type="submit" class="btn btn-info"><?php echo get_phrase('Pay_later');?></button>
			   <button type="submit" name="pay_later"class="btn btn-info" style="
    float: right;
"><?php echo get_phrase('Pay_online');?></button>			
						
						</div>
					</div>
					 
                <?php echo form_close();?>
            </div>
        </div>
    </div>


</div>
</div>

<div class="verification_box_email text-left">
	<div class="verification_title text-left">
		Verify Email Address
	</div>
	<hr>
	<div class="verification_text text-left">
		Please enter 6 digit verification code sent to pramod@cyberworx.in
	</div>

	<div class="verification_code mt-4">
		<input type="text" class="form-control" pattern="[0-9]{6}">
	</div>
	<div class="mt-2 verification_code_button">
		<a href="" class="btn btn-primary form-control">Verify Email</a>
	</div>
	
	<div class="verification_code_message mt-4">
		<div class="alert alert-warning">
			The OTP is valid for 20 minutes only.
		</div>
	</div>
	
	<div class="mt-4 verification_text  verification_code_resend">
		Not recieved code yet? <a href="">Resend Verification Code</a>
	</div>

</div>

<div class="verification_box_mobile text-left">
	<div class="verification_title text-left">
		Verify Mobile Number
	</div>
	<hr>
	<div class="verification_text text-left">
		Please enter 6 digit verification code sent to 9856985696
	</div>

	<div class="verification_code mt-4">
		<input type="text" class="form-control" pattern="[0-9]{6}">
	</div>
	<div class="mt-2 verification_code_button">
		<a href="" class="btn btn-primary form-control">Verify Mobile Number</a>
	</div>
	
	<div class="verification_code_message mt-4">
		<div class="alert alert-warning">
			The OTP is valid for 20 minutes only.
		</div>
	</div>
	
	<div class="mt-4 verification_text  verification_code_resend">
		Not recieved code yet? <a href="">Resend Verification Code</a>
	</div>

</div>


<div class="verification_overlay">
	
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

//Regular Expression for email 
var mobilePattern = /[0-9]\d{9}/;

	
$('#email').focusout(function(){
	let email = $(this).val();

		$('.verify_email').show();
		
    $.ajax({
        url: '<?php echo site_url('admission/otp_verification/'); ?>',
        type: "POST",
           data: 'email=' + $("#email").val(),
           success: function (response)
        {
            $('#attendance_data').html(response);
        }
    });	
		
});

//$('.verify_email a').click((e)=>{
//	e.preventDefault();
//	$('.verification_box_email').show();
///	$('.verification_overlay').show();
//});


//$('.verify_mobile a').click((e)=>{
//	e.preventDefault();
//	$('.verification_box_mobile').show();
//	$('.verification_overlay').show();
//});

//$('#phone').focusout(function(){
//	let number = $(this).val();
//	if(!isNaN(number) && number.length == 10){
//		$('.verify_mobile').show();
//	}
//});


//otp_verification = ($type) => {

	

//}

$('.verification_code_resend a').click(function(e){
	e.preventDefault();
	$('.verification_box_email .verification_code_message  .alert').html('New OTP has been sent to email@email.com. The OTP is valid for 20 minutes only.');
});

</script>



<!-- NOTE :: Removed Section, Id No, Dormitory, Transport Fields -->
<!-- NOTE :: Removed Section, Id No, Dormitory, Transport Fields -->