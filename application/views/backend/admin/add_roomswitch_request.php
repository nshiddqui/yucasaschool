<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
					Add Room change request
            	</div>
            </div>

			<div class="panel-body">
				
                <?php echo form_open(site_url('admin/add_roomswitch_request/'.$role.'/'.$user) , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                    <?php /*<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Select Designation</label>
						<div class="col-sm-5">
						     <?php
                              $array_all_members=array();
                              $table_name=array();
                              for($i=1;$i<7;$i++){
                              
                              switch($i){
                        case 1:
                            $attendance_of_students = $this->db->get_where('driver', array(
                                'status'  => 1,'is_hostel_member'  => 1
                            ))->result_array();
                            $id='driver_';
                            $table='driver';
                            $array_all_members[$table]=array();
                            array_push($array_all_members[$table],$attendance_of_students);
                            array_push($table_name,$table);
                            break;
                        case 2:
                            $attendance_of_students = $this->db->get_where('warden', array(
                                'status'  => 1,'is_hostel_member'  => 1
                            ))->result_array();
                            $id='warden_';
                            $table='warden';
                            $array_all_members[$table]=array();
                            array_push($array_all_members[$table],$attendance_of_students);
                            array_push($table_name,$table);
                            break;
                        case 3:
                            $attendance_of_students = $this->db->get_where('inventory_manager', array(
                                'status'  => 1,'is_hostel_member'  => 1
                            ))->result_array();
                            $id='inventory_manager_';
                            $table='inventory_manager';
                            $array_all_members[$table]=array();
                            array_push($array_all_members[$table],$attendance_of_students);
                            array_push($table_name,$table);
                            break;
                        case 4:
                            $attendance_of_students = $this->db->get_where('transport_in', array(
                                'status'  => 1,'is_hostel_member'  => 1
                            ))->result_array();
                            
                            $id='transport_';
                            $table='transport';
                            $array_all_members[$table]=array();
                            //print_r($attendance_of_students);
                            array_push($array_all_members[$table],$attendance_of_students);
                            array_push($table_name,$table);
                            break;
                        case 5:
                            $attendance_of_students = $this->db->get_where('accountant', array(
                                'status'  => 1,'is_hostel_member'  => 1
                            ))->result_array();
                            $id='accountant_';
                            $table='accountant';
                            $array_all_members[$table]=array();
                            array_push($array_all_members[$table],$attendance_of_students);
                            array_push($table_name,$table);
                            break;
                        case 6:
                            $attendance_of_students = $this->db->get_where('teacher', array(
                                'status'  => 1,'is_hostel_member'  => 1
                            ))->result_array();
                            //echo $this->db->last_query();
                            $id='teacher_';
                            $table='teacher';
                            $array_all_members[$table]=array();
                            array_push($array_all_members[$table],$attendance_of_students);
                            array_push($table_name,$table);
                            break;
                        default:
                            $attendance_of_students =array();
                            $id='none';
                            $table='none';
                            break;
                    }
                    
                    
                              }    
                              ?>
								<select name="student_id" class="form-control selectboxit" id="select_designation">
                              <option value="">Select</option>
                             <?php $key=1; foreach($table_name as $name){
                                 
                             $arr_particular=$array_all_members[$name][0];
                             foreach($arr_particular as $arr){
                             ?>
                              <option value="<?php echo $arr[$name.'_id'];?>" data-id="<?php echo $key;?>" <?php if($role==$key && $user==$arr[$name.'_id']){ echo "selected";}?>><?php echo $arr['name'];?></option>
                              <?php
                             }
                             $key++;
                              } ?>
                        
                          </select>
                          <?php json_encode($table_name,true);?>
                          </div></div> */ ?>
                    <?php 
                    $member = $this->db->get_where('hostel_members_staff', array(
                                'designation_id'  => $role,'user_id'  => $user
                            ))->result_array();
                    if(isset($member) && is_array($member[0])){
                    $rooms = $this->db->get_where('rooms', array(
                                'hostel_id'  => $member[0]['hostel_id'],'status'=>1
                            ))->result_array();        
                    $room_id = $this->db->get_where('rooms',array('id'=>$member[0]['room_id']))->row()->id;
                    ?>
                    <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Select hostel</label>
						<div class="col-sm-5">
                    <select  class="form-control col-md-7 col-xs-12 alignleft" name="hostel_id" id="hostel_id_<?php echo $ide; ?>" readonly>
                    <option value="">--<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('hostel'); ?>--</option>
                    <?php  
$hostels = $this->db->get_where('hostels',array('status'=>1))->result();                                     
foreach($hostels as $hostel){ ?>
                    <option value="<?php echo $hostel->id; ?>" <?php if($member[0]['hostel_id']==$hostel->id){ echo "selected";}?>><?php echo $hostel->name; ?> [<?php echo $this->lang->line($hostel->type); ?>]</option>
                    <?php } ?>
                  </select>
                  </div>
                  </div>
                  <input type='hidden' name='prev_hostel_id' value="<?php echo $member[0]['hostel_id'];?>">
                            <input type='hidden' name='prev_room_id' value="<?php echo $member[0]['room_id'];?>">
                   <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Select room</label>
						<div class="col-sm-5">
                  <select  class="form-control col-md-7 col-xs-12" name="room_id" id="room_id1_<?php echo $ide; ?>" readonly>
                    <option value="">--<?php echo $this->lang->line('select'); ?> <?php echo $this ->lang->line('room_no'); ?>--</option>
                    <?php
                    foreach($rooms as $hostel){ ?>
                    <option value="<?php echo $hostel['id']; ?>" <?php if($member[0]['room_id']==$hostel['id']){ echo "selected";}?>><?php echo $hostel['room_no']; ?> [<?php echo $this->lang->line($hostel['room_type']); ?>]</option>
                    <?php } ?>
                  </select>
                  </div></div>
                  <input type='hidden' name='prev_hostel_id' value="<?php echo $member[0]['hostel_id'];?>">
                            <input type='hidden' name='prev_room_id' value="<?php echo $member[0]['room_id'];?>">
 <!--<div class="form-group">-->
	<!--					<label for="field-1" class="col-sm-3 control-label">Select Bed</label>-->
	<!--					<div class="col-sm-5">-->
 <!--                  <select  class="form-control col-md-7 col-xs-12" name="beds" id="bed_id_<?php echo $ide; ?>" required>-->
 <!--                   <option value="">--<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('bed'); ?>--</option>-->
 <!--                 </select>-->
 <!--              </div></div>     -->
                    
          <?php } 
          if(!is_array($member[0])){
          ?>         
          
          <input type='hidden' name='prev_hostel_id' value="0">
                            <input type='hidden' name='prev_room_id' value="0">
                            <?php } ?>
				 <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Select new hostel</label>
						<div class="col-sm-5">
                    <select  class="form-control col-md-7 col-xs-12 alignleft" name="new_hostel_id" id="hostel_id_<?php echo $ide; ?>" onchange="get_room_by_hostel(this.value, '<?php echo $ide; ?>');" required>
                    <option value="">--<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('hostel'); ?>--</option>
                    <?php  
                        $hostels = $this->db->get_where('hostels',array('status'=>1))->result();                                     
                        foreach($hostels as $hostel){ ?>
                    <option value="<?php echo $hostel->id; ?>"><?php echo $hostel->name; ?> [<?php echo $this->lang->line($hostel->type); ?>]</option>
                    <?php } ?>
                  </select>
                  </div>
                  </div>
                   <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Select new room</label>
						<div class="col-sm-5">
                  <select  class="form-control col-md-7 col-xs-12" name="new_room_id" id="room_id_<?php echo $ide; ?>" onchange="get_bed_by_room('<?php echo $hostel->id; ?>','<?php echo $ide; ?>',this.value);" required>
                    <option value="">--<?php echo $this->lang->line('select'); ?> <?php echo $this ->lang->line('room_no'); ?>--</option>
                    <?php
                    foreach($rooms as $hostel){ ?>
                    <option value="<?php echo $hostel['id']; ?>"><?php echo $hostel['room_no']; ?> [<?php echo $this->lang->line($hostel['room_type']); ?>]</option>
                    <?php } ?>
                  </select>
                  </div></div>
                   <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">New Bed</label>
						<div class="col-sm-5">
                   <select  class="form-control col-md-7 col-xs-12" name="new_bed_id" id="bed_id_<?php echo $ide; ?>" required>
                    <option value="">--<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('bed'); ?>--</option>
                  </select>
               </div></div>    
               
               <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Reason</label>
						<div class="col-sm-5">
                  <textarea name="reason"></textarea>
               </div></div>    

					
					</div><input type="hidden" name="role_id" id="role_id" value="<?php echo $role;?>">
					<input type="hidden" name="student_id" id="student_id" value="<?php echo $user;?>">
					<input type="hidden" name="type" value="staff">

				<center> <button id="<?php echo $id; ?>" class="btn btn-success" type='submit'><i class="fa fa-reply"></i>Room Change Request</button></center>
                 

                <?php echo form_close();?>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$('#select_designation').on('change', function() {
  //alert( $(this).find(':selected').data('id') );
  $('#role_id').val($(this).find(':selected').data('id'));
});



var class_selection = "";
jQuery(document).ready(function($) {
    $('#submit').attr('disabled', 'disabled');
});

    function select_section(class_id) {
        if (class_id !== '') {
        $.ajax({
            url: '<?php echo site_url('admin/get_section/'); ?>' + class_id,
            success:function (response)
            {
                jQuery('#section_holder').html(response);
            }
        });
    }
}
    function mark_all_present() {
        var count = <?php echo count($attendance_of_students); ?>;

        for(var i = 0; i < count; i++){
            $('.status_' + i +'[data-value="1"]').prop("checked", true);
            // radio.prop("checked", true);
        }

    }

    function mark_all_absent() {
        var count = <?php echo count($attendance_of_students); ?>;

        for(var i = 0; i < count; i++){
            $('.status_' + i +'[data-value="2"]').prop("checked", true);
            // radio.prop("checked", true);
        }
    }

    function mark_all_clear() {
        var count = <?php echo count($attendance_of_students); ?>;

        for(var i = 0; i < count; i++){
            $('.status_' + i +'[data-value="1"]').prop("checked", false);
            $('.status_' + i +'[data-value="2"]').prop("checked", false);
            // radio.prop("checked", true);
        }
    }

function check_validation(){
    if(class_selection !== ''){
        $('#submit').removeAttr('disabled')
    }
    else{
        $('#submit').attr('disabled', 'disabled');
    }
}

$('#class_selection').change(function(){
    class_selection = $('#class_selection').val();
    check_validation();
});
</script>

<script type="text/javascript">

$(document).ready(function(){
$('.fn_add_to_hostel').click(function(){
var obj      = $(this);  
var user_id  = $(this).attr('id');         
var hostel_id= $('#hostel_id_'+user_id).val();         
var room_id  = $('#room_id_'+user_id).val();
var beds  = $('#bed_id_'+user_id).val();
var table_name  = $('#table_name').val();
var designation  = $('#designation').val();
if(hostel_id == ''){
toastr.error('<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('hostel'); ?>'); 
return false;
}
if(room_id == ''){
toastr.error('<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('room_no'); ?>'); 
return false;
}

$.ajax({       
type   : "POST",
url    : "<?php echo site_url('member/add_to_hostel_staff'); ?>",
data   : { user_id : user_id, hostel_id : hostel_id, room_id : room_id,beds:beds,table_name:table_name,designation:designation},               
async  : false,
success: function(response){ 
if(response){
toastr.success('<?php echo get_phrase('data_update_success'); ?>');
obj.parents('tr').remove();
}else{
toastr.error('<?php echo get_phrase('update_failed'); ?>'); 
}
}
}); 

});       
});


function get_room_by_hostel(hostel_id, user_id){       

$.ajax({       
type   : "POST",
url    : "<?php echo site_url('ajax/get_room_by_hostel_staff'); ?>",
data   : { hostel_id : hostel_id },               
async  : false,
success: function(response){                                                   
if(response)
{                  
$('#room_id_'+user_id).html(response);
}
}
});         
} 
</script> 

<script type="text/javascript">
function get_bed_by_room(hostel_id, user_id,room_id){       

$.ajax({       
type   : "POST",
url    : "<?php echo site_url('ajax/get_bed_by_room_hostel_staff'); ?>",
data   : { room_id : room_id,hostel_id:hostel_id },             
async  : false,
success: function(response){                                                   
if(response)
{                  
$('#bed_id_'+user_id).html(response);
}
}
});         
} 
</script>

