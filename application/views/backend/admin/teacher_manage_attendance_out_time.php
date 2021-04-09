<?php $activeTab = "teacher"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Teachers</a></li>
        <li class="active">Manage Teacher Attendance</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/teacher_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<?php echo form_open(site_url('admin/teacher_attendance_selector/')); ?>
<div class="row">


    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('date'); ?></label>
            <input type="text" class="form-control datepicker" name="timestamp" data-format="dd-mm-yyyy"
                   value="<?php echo date("d-m-Y", $timestamp); ?>"/>
        </div>
    </div>

    <input type="hidden" name="year" value="<?php echo $running_year; ?>">

    <div class="col-md-3" style="margin-top: 20px;">
        <button type="submit" id ="1submit" class="btn btn-info"><?php echo get_phrase('manage_attendance'); ?></button>
    </div>

</div>
<?php echo form_close(); ?>






<hr />
<div class="row" style="text-align: center;">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <div class="tile-stats tile-gray">
            <div class="icon"><i class="entypo-chart-area"></i></div>
           
            <h4 style="color: #696969;">
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
</center>
<br>

<div class="row">

    <div class="col-md-2"></div>

    <div class="col-md-8">

        <?php echo form_open(site_url('admin/teacher_attendance_update/' . $timestamp)); ?>
        <div id="attendance_update">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo get_phrase('RF ID'); ?></th>
                        <th><?php echo get_phrase('name'); ?></th>
                        <th><?php echo get_phrase('status'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    $select_id = 0;
                    $attendance_of_teacher = $this->db->get_where('emp_attendance', array(
                               
                                'timestamp' => $timestamp
                            ))->result_array();


                    foreach ($attendance_of_teacher as $row):
                        ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td>
                                <?php echo $this->db->get_where('teacher', array('teacher_id' => $row['emp_id']))->row()->rfid_code; ?>
                            </td>
                            <td>
                                <?php echo $this->db->get_where('teacher', array('teacher_id' => $row['emp_id']))->row()->name; ?>
                            </td>
                            <td>
                                <select class="form-control" name="status_<?php echo $row['attendance_id']; ?>" id="status_<?php echo $select_id; ?>">
                                    <option value="0" <?php if ($row['status'] == 0) echo 'selected'; ?>><?php echo get_phrase('undefined'); ?></option>
                                    <option value="1" <?php if ($row['status'] == 1) echo 'selected'; ?>><?php echo get_phrase('present'); ?></option>
                                    <option value="2" <?php if ($row['status'] == 2) echo 'selected'; ?>><?php echo get_phrase('absent'); ?></option>
                                </select>
                            </td>
                        </tr>
                    <?php
                    $select_id++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>

        <center>
            <button type="submit" class="btn btn-success" id="submit_button">
                <i class="entypo-thumbs-up"></i> <?php echo get_phrase('save_changes'); ?>
            </button>
        </center>
        <?php echo form_close(); ?>

    </div>



</div>
</div>


<script type="text/javascript">

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

        for(var i = 0; i < count; i++)
            $('#status_' + i).val("1");
    }

    function mark_all_absent() {
        var count = <?php echo count($attendance_of_students); ?>;

        for(var i = 0; i < count; i++)
            $('#status_' + i).val("2");
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
