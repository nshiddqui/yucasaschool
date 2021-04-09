<?php $activeTab = "student"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Admission</a></li>
        <li class="active">Admit Student</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>

<?php
     $field_arr = array();
     $create_status = $this->db->get_where('registration_form_setting',array('status'=>'0','created_html' => '1'))->result();
     foreach ($create_status as $key => $field_dt) {
        $field_arr[] = $field_dt->name;
     }
     
    //print_r($field_arr);
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('addmission_form');?>
            	</div>
            </div>
			<div class="panel-body">

                <?php echo form_open(site_url('admin/student/create/') , array('class' => 'form-horizontal form-groups-bordered validate', 'onsubmit'=>"return confirm('Please confirm this email ID, before submitting this form.'+$('#email').val());" ,  'enctype' => 'multipart/form-data'));?>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus required>

						</div>
						
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>

						<div class="col-sm-5">
							<select name="class_id" class="form-control select2" required id="class_id"
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
		                        <select name="section_id" class="form-control select2" id="section_selector_holder" onchange="get_autogenrate_roll(this.value);">
		                            <option value=""><?php echo get_phrase('select_class_first');?></option>

			                    </select>
			                </div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('id_no');?></label>

						<div class="col-sm-5">
							<?php $perfix_code =  @$this->db->get_where('settings' , array('type' =>'perifix_code'))->row()->description;?>
							<input type="text" class="form-control" name="student_code" value="<?php echo $perfix_code.'_'.substr(md5(uniqid(rand(), true)), 0, 5); ?>" data-validate="required" 
								data-message-required="<?php echo get_phrase('value_required');?>" readonly>
						</div>
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('roll_no');?></label>
                        <div class="col-sm-5">
							<div class="input-group">
							  <div class="input-group-addon" id="perifix_code_value"></div>
							  <input type="text" class="form-control" name="roll" value="" readonly data-validate = "required" id = "roll_no"
								data-message-required = "<?php echo get_phrase('value_required');?>" >
							</div>
						</div> 
					</div>

				

						<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"> <span class="btn btn-primary pull-right" onclick="myFunction()">RFID</span></label>

						<div class="col-sm-5">
							
							<input type="text" class="form-control" name="rf_id" value=""  placeholder="tap RFID card here" style="display:none" id="rf_id" >
						</div>
					   </div>
					<script>
function myFunction() {
  var x = document.getElementById("rf_id");
  if (x.style.display === "none") {
    x.style.display = "block ";
	
  } else {
    x.style.display = "none";
	//$("#rf_id").reset(true);
	 document.getElementById("rf_id").value = "";
  }
}
</script>
                    <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="email" name="email" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="">
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('password');?></label>

						<div class="col-sm-5">
							<input type="password" class="form-control" name="password" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" >
						</div>
					</div>
                    <?php if(!in_array("birthday", $field_arr)){ ?>
					<div class="form-group" >
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('birthday');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control datepicker" name="birthday" value="" data-start-view="2">
						</div>
					</div>
 				   <?php } 
 				    if(!in_array("gender", $field_arr)){ ?>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('gender');?></label>

						<div class="col-sm-5">
							<select name="sex" class="form-control select2">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="male"><?php echo get_phrase('male');?></option>
                              <option value="female"><?php echo get_phrase('female');?></option>
                          </select>
						</div>
					</div>
					<?php } 
 				    if(!in_array("address", $field_arr)){ ?>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="address" value="" >
						</div>
					</div>
					<?php } 
 				    //if(!in_array("phone", $field_arr)){ ?>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="phone" value="" >
						</div>
					</div>
					<?php // } 
 				    if(!in_array("dormitory", $field_arr)){ ?>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('hostel');?></label>

						<div class="col-sm-5">
							<select name="hostel_id" class="form-control select2" onchange="get_room_by_hostel(this.value,'add');">
                              <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                              <option value="NA">Not Applicable</option>
                                <?php  
                                  $hostels = $this->db->get_where('hostels',array('status'=>1))->result();
                                  foreach($hostels as $hostel){ ?>
                                    <option value="<?php echo $hostel->id; ?>"><?php echo $hostel->name; ?> [<?php echo $this->lang->line($hostel->type); ?>]</option>
                                <?php } ?>
                          </select>
						</div>
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('room');?></label>
                        <div class="col-sm-5">
							<select name="dormitory_id" class = "room_id  form-control select2" onchange="get_bed_by_room(this.value);" >
                              <option value=""><?php echo get_phrase('room_no');?></option>
	                       </select>
						</div>
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('bed');?></label>
                        <div class="col-sm-5">
							<select  class="form-control col-md-7 col-xs-12" name="beds" id="bed_id">
                                <option value="">--<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('bed'); ?>--</option>
                              </select>
						</div>
					</div>
					<?php } 
					
 				    if(!in_array("transport", $field_arr)){ ?>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('transport_route');?></label>

						<div class="col-sm-5">
							<select name="transport_id" class="form-control select2" onchange = "transportroute(this.value,'add');">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="0">Not Applicable</option>
                              <option value="0">Own Transport</option>
                              
	                              <?php
	                              	$transports = $this->db->get('routes')->result_array();
	                              	foreach($transports as $row):
	                              ?>
                              		<option value="<?php echo $row['id'];?>"><?php echo $row['route_start'];?>-<?php echo $row['route_end'];?></option>
                          		<?php endforeach;?>
                          </select>
						</div>
					</div>
					
					

					<?php }  ?>
                    
					<div class="form-group"><label for="field-1" class="col-sm-3 control-label">Blood Group</label>
                        	<div class="col-sm-5">
                        	    <select  class="form-control col-md-7 col-xs-12" name="blood_group" id="blood_group">
                                    <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                    <?php $bloods = get_blood_group(); ?>
                                    <?php foreach($bloods as $key=>$value){ ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php } ?>
                                </select>
                        </div>
                   </div>

					<?php //} 
 				    if(!in_array("photo", $field_arr)){ ?>

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
										<input type="file" name="photo" accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>

                    <?php } ?>
					<div class="extrafield" style=" border-top: 2px solid #ccc;padding: 5px;">
					<h5 style="text-align: center;font-size:0.8vw;font-weight: 700;">Parent Details</h5>
						<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Father Name</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="parent_name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"  autofocus
                            	value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('mother_name');?></label>

						<div class="col-sm-5">
						
							<input type="text" class="form-control" name="mother_name" value="" data-validate="required" 
								data-message-required="<?php echo get_phrase('value_required');?>" >
						</div>
					</div>
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Parent Email</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="parent_email" value="" data-validate="required">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Parent Password</label>
                        
						<div class="col-sm-5">
							<input type="password" class="form-control" name="parent_password" value="" data-validate="required">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Parent Phone</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="parent_phone" value="" data-validate="required">
						</div>
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Parent Profession</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="parent_proffession" value="" data-validate="required">
						</div>
					</div>
					<?php 
   
                    //print_r($create_dianamic_field);

                    // foreach ($create_dianamic_field as $htmlcode) { 
                    // 	echo  json_decode($htmlcode->html_code);
                    // }
                    ?>
						</div>

                 
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button onclick="create_form();" type="submit" class="btn btn-info"><?php echo get_phrase('add_student');?></button>
						</div>
					</div>
				
					
					
                <?php echo form_close();?>
            </div>
        </div>
    </div>

</div>
<!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> -->
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
});

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
    alert(json_html);

   //'type':fieldType,
    $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('ajax/insert_registration_fields'); ?>",
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

function get_autogenrate_roll(value){
   var class_id = $('#class_id').val();
   if(class_id != "" && value != ""){
   		$.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('ajax/get_autogenrate_roll'); ?>",
          data   : {'section_id' : value,'class_id':class_id,'edit_id':""},               
          async  : false,
          success: function(data){ 

          	var parse_json = JSON.parse(data);
            
            $('#perifix_code_value').html(parse_json['roll_no_perifix']);
            $('#roll_no').val(parse_json['roll_no']);
          }
      	});
    }
}

</script>
 <script>
  $( function() {
    $( ".datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  } );
  </script>
<script type="text/javascript">
    function get_bed_by_room(room_id) {
        var hostel_id = $('select[name="hostel_id"]').val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('ajax/get_bed_by_room_hostel_staff'); ?>",
            data: {room_id: room_id, hostel_id: hostel_id},
            async: false,
            success: function (response) {
                if (response)
                {
                    $('#bed_id').html(response);
                }
            }
        });
    }
</script>
