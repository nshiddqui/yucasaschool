<?php $activeTab = "attendance"; ?>
<div class="page-header-content container-fluid">
  <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Hostel Attendance</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a> </div>
  </div>
 <?php include base_path().'application/views/backend/navigation_tab/hostel_nav_tab.php'; ?> 

</div>
<div class="clearfix"></div>

<?php echo form_open(site_url('admin/hostel_attendance_selector/'));?>
<div class="row">
  <div class="col-md-3">
    <div class="form-group">
      <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('Hostel');?></label>
      <select name="hostel_id" class="form-control selectboxit"  id = "class_selection">
        <option value=""><?php echo get_phrase('select_hostel');?></option>
        <?php $hostels = $this->db->get('hostels')->result_array();
          foreach($hostels as $row): ?>
        <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
        <?php endforeach;?>
      </select>
    </div>
  </div>
  
  <!--    <div id="section_holder">
    <div class="col-md-3">
        <div class="form-group">
        <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section');?></label>
        <select class="form-control selectboxit" name="section_id">
        	<option value=""><?php echo get_phrase('select_class_first') ?></option>
        </select>
        </div>
    </div>
</div> -->
  
  <div class="col-md-3">
    <div class="form-group">
      <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('date');?></label>
      <input type="text" class="form-control datepicker" name="timestamp" data-format="dd-mm-yyyy"
value="<?php echo date("d-m-Y");?>"/>
    </div>
  </div>
  <input type="hidden" name="year" value="<?php echo $running_year;?>">
  <div class="col-md-3 top-first-btn">
    <button type="submit" id = "submit" class="btn btn-info"><?php echo get_phrase('manage_attendance');?></button>
  </div>
</div>
<?php echo form_close();?> 
<script type="text/javascript">
var class_selection = "";
jQuery(document).ready(function($) {
$('#submit').attr('disabled', 'disabled');
});



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
<style>
.selectboxit {
  visibility: visible;
}
</style>