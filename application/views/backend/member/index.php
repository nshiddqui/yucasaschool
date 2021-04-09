<?php $activeTab = "memebers"; ?>
<div class="page-header-content container-fluid">
  <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Hostel Memebers</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a> </div>
  </div>

</div>


<div class="filter_form">
<?php echo form_open();?>
<div class="row">

	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class');?></label>
			<select name="class_id" class="form-control selectboxit" onchange="select_section(this.value)" id = "class_selection">
				<option value=""><?php echo get_phrase('select_class');?></option>
				<?php
					$classes = $this->db->get('class')->result_array();
					foreach($classes as $row):
                                            
				?>
                                
				<option value="<?php echo $row['class_id'];?>"
					<?= isset($_POST['class_id']) && $_POST['class_id'] == $row['class_id']?'selected':'' ?>><?php echo $row['name'];?></option>
                                
				<?php endforeach;?>
			</select>
		</div>
	</div>
    <div id="section_holder">
	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section');?></label>
			<select class="form-control selectboxit" name="section_id">
                            <option value=""><?php echo get_phrase('select_class_first') ?></option>
				            <?php if(isset($_POST['class_id']) && !empty($_POST['class_id'])){
				            $sections = $this->db->get_where('section',['class_id'=>$_POST['class_id']])->result_array();
				            foreach($sections as $section){
				            ?>
                            <option value="<?= $section['section_id'] ?>" <?= isset($_POST['section_id']) && $_POST['section_id'] == $section['section_id']?'selected':'' ?>><?= $section['name'] ?></option>
                            <?php }
                            }?>
			</select>
		</div>
	</div>
    </div>
	<div class="col-md-2">
	    <div class="form-group">
	        <!--<label class="control-label" style="margin-bottom: 5px;">&nbsp;</label>-->
		    <button type="submit" style="margin-top: 20px;" id = "submit" class="btn btn-info"><?php echo get_phrase('filter_data');?></button>
		</div>
	</div>

</div>
<?php echo form_close();?>
</div>
<div class="container-fluid hidden">
  <div class="row">
    <div class="" data-example-id="togglable-tabs">
      <ul  class="nav nav-tabs bordered">
        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="<?php echo site_url('member/index/'); ?>"   aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('member'); ?> <?php echo $this->lang->line('list'); ?></a> </li>
        <?php if(has_permission(ADD, 'hostel', 'member')){ ?>
        <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="<?php echo site_url('member/add/'); ?>"  aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('non_member'); ?> <?php echo $this->lang->line('list'); ?></a> </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="tab-content">
      <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_member_list" >
        <div class="x_content table-responsive">
          <table id="datatable-keytable" class="datatable-responsive table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th><?php echo $this->lang->line('sl_no'); ?></th>
                <th><?php echo $this->lang->line('photo'); ?></th>
                <th><?php echo $this->lang->line('name'); ?></th>
                <th><?php echo $this->lang->line('class'); ?></th>
                <th><?php echo $this->lang->line('section'); ?></th>
                <th><?php echo $this->lang->line('roll_no'); ?></th>
                <th><?php echo $this->lang->line('hostel'); ?> <?php echo $this->lang->line('name'); ?></th>
                <th><?php echo $this->lang->line('room_no'); ?></th>
                <th><?php echo "Bed no"; ?></th>
                <th><?php echo $this->lang->line('cost_per_seat'); ?></th>
                <th><?php echo $this->lang->line('action'); ?></th>
              </tr>
            </thead>
            <tbody>
              <?php $count = 1; if(isset($members) && !empty($members)){ ?>
              <?php foreach($members as $obj){ ?>
              <tr>
                <td><?php echo $count++; ?></td>
                <td><img src="<?php echo $this->crud_model->get_image_url('student',$obj->student_id);?>" class="img-circle" width="30" /></td>
                <td><?php echo $obj->name; ?></td>
                <td><?php echo $obj->class_name; ?></td>
                <td><?php echo $obj->section; ?></td>
                <td><?php echo $obj->student_code; ?></td>
                <td><?php echo $obj->hostel_name; ?></td>
                <td><?php echo $obj->room_no; ?> [<?php echo $this->lang->line($obj->room_type); ?>]</td>
                 <td>
                  <?php echo $obj->beds; ?></td>
                <td><?php //echo $this->gsms_setting->currency_symbol; ?>
                  <?php echo $obj->cost; ?></td>
                <td><?php if(has_permission(DELETE, 'hostel', 'member')){ ?>
                    <a href="<?php echo site_url('/admin/student_roomchange_request/'.$obj->hm_id); ?>"  class="btn btn-success">Change Room</a>
                  <a href="<?php echo site_url('member/delete/'.$obj->hm_id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class="btn btn-danger"><i class="fa fa-trash"></i> <?php echo $this->lang->line('delete'); ?> </a>
                  <?php } ?></td>
              </tr>
              <?php } ?>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
	  
      <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_non_member_list" >
        <div class="x_content">
          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th><?php echo $this->lang->line('sl_no'); ?></th>
                <th><?php echo $this->lang->line('photo'); ?></th>
                <th><?php echo $this->lang->line('name'); ?></th>
                <th><?php echo $this->lang->line('class'); ?></th>
                <th><?php echo $this->lang->line('section'); ?></th>
                <th><?php echo $this->lang->line('roll_no'); ?></th>
                <th><?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('hostel'); ?> / <?php echo $this->lang->line('room_no'); ?> </th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php $count = 1; if(isset($non_members) && !empty($non_members)){ ?>
              <?php foreach($non_members as $obj){ ?>
              <tr>
                <td><?php echo $count++; ?></td>
                <td><img src="<?php echo $this->crud_model->get_image_url('student',$obj->student_id);?>" class="img-circle" width="30" /></td>
                <td><?php echo $obj->name; ?></td>
                <td><?php echo $obj->class_name; ?></td>
                <td><?php echo $obj->section; ?></td>
                <td><?php echo $obj->student_code; ?></td>
                <td><select  class="form-control col-md-7 col-xs-12 alignleft" name="hostel_id" id="hostel_id_<?php echo $obj->student_id; ?>" onchange="get_room_by_hostel(this.value, '<?php echo $obj->student_id; ?>');" required>
                    <option value="">--<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('hostel'); ?>--</option>
                    <?php  
$hostels = $this->db->get_where('hostels',array('status'=>1))->result();                                     
foreach($hostels as $hostel){ ?>
                    <option value="<?php echo $hostel->id; ?>"><?php echo $hostel->name; ?> [<?php echo $this->lang->line($hostel->type); ?>]</option>
                    <?php } ?>
                  </select>
                  <select  class="form-control col-md-7 col-xs-12" name="room_id" id="room_id_<?php echo $obj->student_id; ?>" onchange="get_bed_by_room('<?php echo $hostel->id; ?>','<?php echo $obj->student_id; ?>',this.value);" required>
                    <option value="">--<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('room_no'); ?>--</option>
                  </select>

                   <select  class="form-control col-md-7 col-xs-12" name="beds" id="bed_id_<?php echo $obj->student_id; ?>" required>
                    <option value="">--<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('bed'); ?>--</option>
                  </select>

                 </td>
                <td><?php if(has_permission(ADD, 'hostel', 'member')){ ?>
                  <a href="javascript:void(0);" id="<?php echo $obj->student_id; ?>" class="btn btn-success btn-xs fn_add_to_hostel"><i class="fa fa-reply"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('hostel'); ?> </a>
                  <?php } ?></td>
              </tr>
              <?php } ?>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
	  
	  
    </div>
  </div>
</div>
<script type="text/javascript">
function select_section(class_id) {
	if(class_id !== ''){
		$.ajax({
			url: '<?php echo site_url('admin/get_section/'); ?>' + class_id,
			success:function (response)
			{

			jQuery('#section_holder').html(response);
			}
		});
	}
}
$(document).ready(function(){
$('.fn_add_to_hostel').click(function(){
var obj      = $(this);  
var user_id  = $(this).attr('id');         
var hostel_id= $('#hostel_id_'+user_id).val();         
var room_id  = $('#room_id_'+user_id).val();
var beds  = $('#bed_id_'+user_id).val();
if(hostel_id == ''){
toastr.error('<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('hostel'); ?>'); 
return false;
}
if(room_id == ''){
toastr.error('<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('room_no'); ?>'); 
return false;
}
if(beds == ''){
toastr.error('<?php echo $this->lang->line('select'); ?> beds'); 
return false;
}


$.ajax({       
type   : "POST",
url    : "<?php echo site_url('member/add_to_hostel'); ?>",
data   : { user_id : user_id, hostel_id : hostel_id, room_id : room_id,beds:beds},               
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
url    : "<?php echo site_url('ajax/get_room_by_hostel'); ?>",
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
url    : "<?php echo site_url('ajax/get_bed_by_room_hostel'); ?>",
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



<script type="text/javascript">
$(document).ready(function() {
$('#datatable-responsive, .datatable-responsive').DataTable( {
dom: 'Bfrtip',
iDisplayLength: 15,
buttons: [
'copyHtml5',
'excelHtml5',
'csvHtml5',
'pdfHtml5',
'pageLength'
],
search: true
});
});
</script>