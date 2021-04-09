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
    <!-- Including Navigation Tab -->
    <?php include base_path() . 'application/views/backend/navigation_tab/student_nav_tab.php'; ?> 
    <!-- Including Navigation Tab -->
</div>


<?php echo form_open(site_url('admin/attendance_employee_selector/')); ?>
<div class="row">

    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;">Designation</label>
            <select name="class_id" class="form-control selectboxit" onchange="select_section(this.value)"  id = "class_selection">
                <option value=""><?php echo get_phrase('select_designation'); ?></option>
                <?php
                $designation = '';
                $classes = $this->db->get('designations')->result_array();
                foreach ($classes as $row):
                    if($class_id == $row['id']){
                        $designation = $row['name'];
                    }
                    ?>

                    <option value="<?php echo $row['id']; ?>"
                            <?php if ($class_id == $row['id']) echo 'selected'; ?>><?php echo $row['name']; ?></option>
                        <?php endforeach; ?>
            </select>
        </div>
    </div>




    <input type="hidden" name="mode" value="<?php echo $mode ? $mode : 0; ?>">

    <div class="col-md-3 top-first-btn">
        <button type="submit" id = "submit" class="btn btn-info"><?php echo get_phrase('manage_hostel'); ?></button>
    </div>

</div>
<?php echo form_close(); ?>



<hr />
<div class="row" style="text-align: center;">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <div class="tile-stats tile-gray">
            <div class="icon"><i class="entypo-chart-area"></i></div>

            <h3 style="color: #696969;">Hostel Allocation status for <?php echo $this->db->get_where('designations', array('id' => $class_id))->row()->name; ?></h3>

            <h4 style="color: #696969;">
                <?php echo date("d M Y", $timestamp); ?>
            </h4>
        </div>
    </div>
    <div class="col-sm-4"></div>
</div>

<!--<center>-->
<!--    <a class="btn btn-default" onclick="mark_all_present()">-->
<!--        <i class="entypo-check"></i> <?php echo get_phrase('mark_all_present'); ?>-->
<!--    </a>-->
<!--    <a class="btn btn-default"  onclick="mark_all_absent()">-->
<!--        <i class="entypo-cancel"></i> <?php echo get_phrase('mark_all_absent'); ?>-->
<!--    </a>-->
<!--    <a class="btn btn-default"  onclick="mark_all_clear()">-->
<!--        <i class="entypo-cancel"></i> <?php echo get_phrase('clear'); ?>-->
<!--    </a>-->
<!--</center>-->
<br>

<div class="row">

    <div class="col-md-2"></div>

    <div class="col-md-8">

        <?php echo form_open(site_url('admin/attendance_employee_update/' . $class_id . '/' . $timestamp)); ?>
        <div id="attendance_update">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo get_phrase('name'); ?></th>
                        <th><?php echo get_phrase('status'); ?></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    $select_id = 0;
                    $var = 1;
                    if (!$mode) {
                        $var = 0;
                    }
                    if($this->db->table_exists(lcfirst($designation))){
                        $attendance_of_students = $this->db->get_where(lcfirst($designation), array(
                                        'status' => 1, 'is_hostel_member' => $var
                                    ))->result_array();
                        $id = lcfirst($designation).'_';
                        $table = lcfirst($designation);
                    } else {
                        $attendance_of_students = array();
                    }
                    // switch ($class_id) {
                    //     case 1:
                    //         $attendance_of_students = $this->db->get_where('driver', array(
                    //                     'status' => 1, 'is_hostel_member' => $var
                    //                 ))->result_array();
                    //         $id = 'driver_';
                    //         $table = 'driver';
                    //         break;
                    //     case 2:
                    //         $attendance_of_students = $this->db->get_where('warden', array(
                    //                     'status' => 1, 'is_hostel_member' => $var
                    //                 ))->result_array();
                    //         $id = 'warden_';
                    //         $table = 'warden';
                    //         break;
                    //     case 3:
                    //         $attendance_of_students = $this->db->get_where('inventory_manager', array(
                    //                     'status' => 1, 'is_hostel_member' => $var
                    //                 ))->result_array();
                    //         $id = 'inventory_manager_';
                    //         $table = 'inventory_manager';
                    //         break;
                    //     case 4:
                    //         $attendance_of_students = $this->db->get_where('transport_in', array(
                    //                     'status' => 1, 'is_hostel_member' => $var
                    //                 ))->result_array();

                    //         $id = 'transport_';
                    //         $table = 'transport_in';
                    //         break;
                    //     case 5:
                    //         $attendance_of_students = $this->db->get_where('accountant', array(
                    //                     'status' => 1, 'is_hostel_member' => $var
                    //                 ))->result_array();
                    //         $id = 'accountant_';
                    //         $table = 'accountant';
                    //         break;
                    //     case 6:
                    //         $attendance_of_students = $this->db->get_where('teacher', array(
                    //                     'status' => 1, 'is_hostel_member' => $var
                    //                 ))->result_array();
                    //         //echo $this->db->last_query();
                    //         $id = 'teacher_';
                    //         $table = 'teacher';
                    //         break;
                    //     default:
                    //         $attendance_of_students = array();
                    //         $id = 'none';
                    //         $table = 'none';
                    //         break;
                    // }
                    ?>
                <input type='hidden' id='table_name' value='<?php echo $table; ?>'>
                <input type='hidden' id='designation' value='<?php echo $class_id; ?>'>
                <?php
                foreach ($attendance_of_students as $row):
                    $ide = $row[$id . 'id'];
                    $name = $row['name'];
                    $hostel_room = $this->db->get_where('hostel_members_staff', array(
                                        'designation_id' => $class_id, 'user_id' => $ide
                                    ))->result_array();
                                    if(empty($hostel_room) && $mode){
                                        continue;
                                    }
                    ?>

                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td>
                            <?php
                            echo lcfirst($name);


//                                 echo $this->db->get_where(lcfirst($designations_name), array($primary_id => $row['employee_id']))->row()->name; 
                            ?>
                        </td>      
                        <td>
                            <?php
                            //echo $this->db->last_query();
                            if (!empty($hostel_room)) {
                                $hostel_name = $this->db->get_where('hostels', array('id' => $hostel_room[0]['hostel_id']))->row()->name;
                                $subjectname = $this->db->get_where('rooms', array('id' => $hostel_room[0]['room_id'], 'hostel_id' => $hostel_room[0]['hostel_id']))->row()->room_no;
                            }
                            ?>
                            <?php if ($mode) { ?>
                                Hostel name: <?php echo $hostel_name; ?><br/>
                                Romm number: <?php echo $subjectname; ?><br/>
                                Bed no: <?php echo $hostel_room[0]['beds']; ?><br/>
                                Joining date: <?php echo $hostel_room[0]['joining_date']; ?>
                            <?php } ?>

                            <?php if (!$mode) { ?>  
                                <select  class="form-control col-md-7 col-xs-12 alignleft" name="hostel_id" id="hostel_id_<?php echo $ide; ?>" onchange="get_room_by_hostel(this.value, '<?php echo $ide; ?>');" required>
                                    <option value="">--<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('hostel'); ?>--</option>
                                    <?php
                                    $hostels = $this->db->get_where('hostels', array('status' => 1))->result();
                                    foreach ($hostels as $hostel) {
                                        ?>
                                        <option value="<?php echo $hostel->id; ?>"><?php echo $hostel->name; ?> [<?php echo $this->lang->line($hostel->type); ?>]</option>
                                    <?php } ?>
                                </select>
                                <select  class="form-control col-md-7 col-xs-12" name="room_id" id="room_id_<?php echo $ide; ?>" onchange="get_bed_by_room('<?php echo $hostel->id; ?>', '<?php echo $ide; ?>', this.value);" required>
                                    <option value="">--<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('room_no'); ?>--</option>
                                </select>

                                <select  class="form-control col-md-7 col-xs-12" name="beds" id="bed_id_<?php echo $ide; ?>" required>
                                    <option value="">--<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('bed'); ?>--</option>
                                </select>
                                <div class="item form-group">
                                    <input  class="form-control col-md-7 col-xs-12 joining_date"  name="joining_date" id="joining_date_<?php echo $ide; ?>"  value="" placeholder="Joining Date" required="required" type="text" autocomplete="off">
                                    <div class="help-block"><?php echo form_error('joining_date'); ?></div>
                                </div>
                            </td>



                            <td> 
                            <a href="javascript:void(0);" id="<?php echo $ide; ?>" class="btn btn-success btn-xs fn_add_to_hostel"><i class="fa fa-reply"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('hostel'); ?> </a>
                            <?php } else { ?>
                            </td><td>
                            <a href="<?php echo base_url() . 'admin/add_roomswitch_request/' . $class_id . '/' . $ide ?>" id="<?php echo $id; ?>" class="btn btn-success btn-xs fn_add_to_hostel"><i class="fa fa-reply"></i> <?php echo $this->lang->line('hostel'); ?> Change </a>
                            <?php } ?></td>          
                    </tr>
                    <?php
                    $select_id++;
                endforeach;
                ?>
                </tbody>
            </table>
        </div>
        <br/>
        <center>

        </center>
        <?php echo form_close(); ?>

    </div>
</div>
</div>


<link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
<script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script> 

<script type="text/javascript">

                            var class_selection = "";
                            $('.joining_date').datepicker();

                            function select_section(class_id) {
                                if (class_id !== '') {
                                    $.ajax({
                                        url: '<?php echo site_url('admin/get_section/'); ?>' + class_id,
                                        success: function (response)
                                        {
                                            jQuery('#section_holder').html(response);
                                        }
                                    });
                                }
                            }
                            function mark_all_present() {
                                var count = <?php echo count($attendance_of_students); ?>;

                                for (var i = 0; i < count; i++) {
                                    $('.status_' + i + '[data-value="1"]').prop("checked", true);
                                    // radio.prop("checked", true);
                                }

                            }

                            function mark_all_absent() {
                                var count = <?php echo count($attendance_of_students); ?>;

                                for (var i = 0; i < count; i++) {
                                    $('.status_' + i + '[data-value="2"]').prop("checked", true);
                                    // radio.prop("checked", true);
                                }
                            }

                            function mark_all_clear() {
                                var count = <?php echo count($attendance_of_students); ?>;

                                for (var i = 0; i < count; i++) {
                                    $('.status_' + i + '[data-value="1"]').prop("checked", false);
                                    $('.status_' + i + '[data-value="2"]').prop("checked", false);
                                    // radio.prop("checked", true);
                                }
                            }

                            function check_validation() {
                                if (class_selection !== '') {
                                    $('#submit').removeAttr('disabled')
                                } else {
                                    $('#submit').attr('disabled', 'disabled');
                                }
                            }

                            $('#class_selection').change(function () {
                                class_selection = $('#class_selection').val();
                                check_validation();
                            });
</script>

<script type="text/javascript">

    $(document).ready(function () {
        $('.fn_add_to_hostel').click(function () {
            var obj = $(this);
            var user_id = $(this).attr('id');
            var hostel_id = $('#hostel_id_' + user_id).val();
            var room_id = $('#room_id_' + user_id).val();
            var beds = $('#bed_id_' + user_id).val();
            var table_name = $('#table_name').val();
            var designation = $('#designation').val();
            var joining_date = $('#joining_date_' + user_id).val();
            if (hostel_id == '') {
                toastr.error('<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('hostel'); ?>');
                                return false;
                            }
                            if (room_id == '') {
                                toastr.error('<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('room_no'); ?>');
                                                return false;
                                            }
                                            if (joining_date == '') {
                                                toastr.error('<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('joing_date'); ?>');
                                                                return false;
                                                            }

                                                            $.ajax({
                                                                type: "POST",
                                                                url: "<?php echo site_url('member/add_to_hostel_staff'); ?>",
                                                                data: {user_id: user_id, hostel_id: hostel_id, room_id: room_id, beds: beds, table_name: table_name, designation: designation, joining_date: joining_date},
                                                                async: false,
                                                                success: function (response) {
                                                                    if (response) {
                                                                        toastr.success('<?php echo get_phrase('data_update_success'); ?>');
                                                                        obj.parents('tr').remove();
                                                                    } else {
                                                                        toastr.error('<?php echo get_phrase('update_failed'); ?>');
                                                                    }
                                                                }
                                                            });

                                                        });
                                                    });


                                                    function get_room_by_hostel(hostel_id, user_id) {

                                                        $.ajax({
                                                            type: "POST",
                                                            url: "<?php echo site_url('ajax/get_room_by_hostel_staff'); ?>",
                                                            data: {hostel_id: hostel_id},
                                                            async: false,
                                                            success: function (response) {
                                                                if (response)
                                                                {
                                                                    $('#room_id_' + user_id).html(response);
                                                                }
                                                            }
                                                        });
                                                    }
</script> 

<script type="text/javascript">
    function get_bed_by_room(hostel_id, user_id, room_id) {

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('ajax/get_bed_by_room_hostel_staff'); ?>",
            data: {room_id: room_id, hostel_id: hostel_id},
            async: false,
            success: function (response) {
                if (response)
                {
                    $('#bed_id_' + user_id).html(response);
                }
            }
        });
    }
</script>
