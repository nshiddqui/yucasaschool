<style>
    .main-content{
      padding-bottom: 10% !important;
    }
</style>

<?php $activeTab = "daily_attendance"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Employee</a></li>
        <li class="active">Daily Attendance</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
</div>


<?php echo form_open(site_url('admin/attendance_employee_selector/')); ?>
<div class="row">

    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class'); ?></label>
            <select name="class_id" class="form-control selectboxit" onchange="select_section(this.value)"  id = "class_selection">
                <option value=""><?php echo get_phrase('select_designation'); ?></option>
                <option value="all" <?php if ($class_id == 'all') echo 'selected'; ?>><?php echo get_phrase('all'); ?></option>
                <?php
                $classes = $this->db->get('designations')->result_array();
                foreach ($classes as $row):
                    ?>

                    <option value="<?php echo $row['id']; ?>"
                            <?php if ($class_id == $row['id']) echo 'selected'; ?>><?php echo $row['name']; ?></option>
                        <?php endforeach; ?>
            </select>
        </div>
    </div>


    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('date'); ?></label>
            <input type="text" class="form-control datepicker" name="timestamp" data-format="dd-mm-yyyy"
                   value="<?php echo date("d-m-Y", $timestamp); ?>"/>
        </div>
    </div>

    <input type="hidden" name="year" value="<?php echo $running_year; ?>">

    <div class="col-md-3 top-first-btn">
        <button type="submit" id = "submit" class="btn btn-info"><?php echo get_phrase('manage_attendance'); ?></button>
    </div>

</div>
<?php echo form_close(); ?>



<hr />
<div class="row" style="text-align: center;">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <div class="tile-stats tile-gray" style="background:var(--main-bg-color);">
            <div class="icon"></div>

            <h3 style="color: #fff;"><?php echo get_phrase('attendance_for_employee'); ?> <?php echo $this->db->get_where('designations', array('id' => $class_id))->row()->name; ?></h3>
         
            <h4 style="color: #fff;">
                <?php echo date("d M Y", $timestamp); ?>
            </h4>
        </div>
    </div>
    <div class="col-sm-4"></div>
</div>

<center>
    <a class="btn btn-default" onclick="mark_all_present()">
        <i class="entypo-check"></i> <?php echo get_phrase('mark_all_present'); ?>
    </a>
    <a class="btn btn-default"  onclick="mark_all_absent()">
        <i class="entypo-cancel"></i> <?php echo get_phrase('mark_all_absent'); ?>
    </a>
    <a class="btn btn-default"  onclick="mark_all_clear()">
        <i class="entypo-cancel"></i> <?php echo get_phrase('clear'); ?>
    </a>
</center>
<br>

<div class="row">

    <div class="col-md-2"></div>

    <div class="col-md-8">

        <?php echo form_open(site_url('admin/attendance_employee_update/'. $class_id . '/' . $timestamp)); ?>
        <div id="attendance_update">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo get_phrase('name'); ?></th>
                        <th><?php echo get_phrase('status'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    $select_id = 0;
                    if($class_id=='all'){
                         $attendance_of_students = $this->db->get_where('attendance_employee', array('timestamp' => $timestamp
                            ))->result_array();
                    }else{
                    $attendance_of_students = $this->db->get_where('attendance_employee', array(
                                'designation_id'  => $class_id,'timestamp' => $timestamp
                            ))->result_array();
                    }

                    foreach ($attendance_of_students as $row):
                        //print_r($row);
                        ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td>
                                <?php
                                 echo $this->db->get_where('employees', array('id' => $row['employee_id']))->row()->name; 
                                  ?>
                            </td>      
                            <td>
                              <input type="radio" class="status_<?php echo $select_id; ?>" name="status_<?php echo $row['attendance_id']; ?>" data-value="1" value="1" <?php if ($row['status'] == 1) echo 'checked'; ?>> Present<br>

                                <input type="radio" class="status_<?php echo $select_id; ?>" name="status_<?php echo $row['attendance_id']; ?>" data-value="2" value="2" <?php if ($row['status'] == 2) echo 'checked'; ?>> Absent<br>
                            
                            
                            </td>
                        </tr>
                    <?php
                    $select_id++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>
        <br/>
        <center>
            <button type="submit" class="btn btn-success" id="submit_button">
                <i class="entypo-thumbs-up"></i> <?php echo get_phrase('save_changes'); ?>
            </button>
        </center>
        <?php echo form_close(); ?>
<div style="height:220px;"></div>
    </div>
</div>
</div>




<script type="text/javascript">

var class_selection = "";
jQuery(document).ready(function($) {
    // $('#submit').attr('disabled', 'disabled');
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
