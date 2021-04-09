<?php $activeTab = "student_information";
?>
<div class="page-header-content container-fluid">
    <div class="page-header">
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="#"><i class="entypo-home"></i>Home</a></li>
                <li><a href="#"><?= get_phrase($user_type) ?></a></li>
                <li class="active">Birthday List</li>
                <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
            </ul>
            <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
        </div>
    </div>
</div>

<style>
    .datahidden{
        display:none;
    }
</style>

<div class="row">
    <?= form_open('') ?>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class'); ?></label>
            <select name="class_id" class="form-control selectboxit"  id = "class_selection" required>
                <option value=""><?php echo get_phrase('select_class'); ?></option>
                <?php
                $classes = $this->db->get('class')->result_array();
                foreach ($classes as $row):
                    ?>

                    <option value="<?php echo $row['class_id']; ?>" <?php if ($row['class_id'] == $class_id) {
                    echo 'selected';
                } ?>><?php echo $row['name']; ?></option>
<?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('from'); ?></label>
            <input type="text" class="form-control datepicker" name="date_from" value="<?= $_POST['date_from']?>" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('to'); ?></label>
            <input type="text" class="form-control datepicker" name="date_to" value="<?= $_POST['date_to']?>" required>
        </div>
    </div>

    <div class="col-md-2 top-first-btn">
        <button type="submit" class="btn btn-info"><?php echo get_phrase('birthday_list'); ?></button>
    </div>
    <?= form_close('') ?>
</div>


<?php if (isset($_POST['class_id']) && !empty($_POST['class_id']) && !empty($_POST['date_from']) && !empty($_POST['date_to'])) {
$class_id = $_POST['class_id'];
?>



    <div class="row">
        <div class="col-md-12">

            <div class="">
                <div class="" id="home">

                    <table class="table table-bordered" id="student_datatable">
                        <thead>
                            <tr>
                                <th width="80"><div><?php echo get_phrase('id_no'); ?></div></th>
                                <th width="80"><div><?php echo get_phrase('photo'); ?></div></th>
                                <th><div><?php echo get_phrase('name'); ?></div></th>
                                <th><div><?php echo get_phrase('class'); ?></div></th>
                                <th><div><?php echo get_phrase('section'); ?></div></th>
                                <th><div><?php echo get_phrase('birthday'); ?></div></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $this->db->select('*,student.status');
                            $this->db->from('enroll');
                            $this->db->join('student', 'enroll.student_id = student.student_id');
                            $this->db->where('enroll.year', $running_year);
                            $this->db->where('student.status', '1');
                            $this->db->where('DATE_FORMAT(STR_TO_DATE(REPLACE(student.birthday,"/","-"),"%m-%d-%Y"),"%m-%d") BETWEEN "'. date('m-d', strtotime($_POST['date_from'])). '" and "'. date('m-d', strtotime($_POST['date_to'])).'"');
                            

                            $query = $this->db->get();

                            foreach ($query->result() as $row):
                                ?>
                                <?php $row = json_decode(json_encode($row), True); ?>

                                <tr>
                                    <td><?php
                                        $student_d = $this->db->get_where('student', array(
                                                    'student_id' => $row['student_id']
                                                ))->row();
                                        echo $student_d->student_code;
                                        ?>
                                    </td>
                                    <td><img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" class="img-circle" width="30" /></td>
                                    <td>
                                        <?php
                                            echo $student_d->name;
                                            ?>
                                    </td>
                                    <td>
        <?php echo $this->db->get_where('class', array('class_id' => $row['class_id']))->row()->name; ?>
                                    </td>
                                    <td>
        <?php echo $this->db->get_where('section', array('section_id' => $row['section_id']))->row()->name; ?>

                                    </td>
                                    <td> <?php echo  $student_d->birthday;; ?> </td>
                                </tr>
    <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>

            </div>


        </div>
    </div>
<?php } else { ?>
    <div class="tab-pane box active" id="list">
        <h1 class="text-center">Todays Birthday<img src="<?= site_url('/assets/images/icon/cake.png') ?>" height="30"></h1>
        <?php
        $this->db->select('*,student.status');
        $this->db->from('enroll');
        $this->db->join('student', 'enroll.student_id = student.student_id');
        $this->db->where('enroll.year', $running_year);
        $this->db->where('student.status', '1');
        $this->db->where('DATE_FORMAT(STR_TO_DATE(REPLACE(student.birthday,"/","-"),"%m-%d-%Y"),"%m-%d") = "'. date('m-d'). '"');
        $query = $this->db->get();
        if($query->num_rows() > 0){
        ?>
        <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="student_datatable">
            <thead>
                <tr>
                    <th width="40"><div><?php echo get_phrase('student_id'); ?></div></th>
                    <th><div><?php echo get_phrase('photo'); ?></div></th>
                    <th><div><?php echo get_phrase('name'); ?></div></th>
                    <th><div><?php echo get_phrase('class'); ?></div></th>
                    <th><div><?php echo get_phrase('section'); ?></div></th>
                    <th><div><?php echo get_phrase('birthday'); ?></div></th>
                </tr>
            </thead>
            <tbody>
                            <?php
                            foreach ($query->result() as $row):
                                ?>
                                <?php $row = json_decode(json_encode($row), True); ?>

                                <tr>
                                    <td><?php
                                        $student_d = $this->db->get_where('student', array(
                                                    'student_id' => $row['student_id']
                                                ))->row();
                                        echo $student_d->student_code;
                                        ?>
                                    </td>
                                    <td><img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" class="img-circle" width="30" /></td>
                                    <td>
                                        <a href="<?php echo site_url('admin/student_profile/' . $row['student_id']); ?>">  <?php
                                            echo $student_d->name;
                                            ?></a>
                                    </td>
                                    <td>
        <?php echo $this->db->get_where('class', array('class_id' => $row['class_id']))->row()->name; ?>
                                    </td>
                                    <td>
        <?php echo $this->db->get_where('section', array('section_id' => $row['section_id']))->row()->name; ?>

                                    </td>
                                    <td> <?php echo  $student_d->birthday;; ?> </td>
                                </tr>
    <?php endforeach; ?>
                        </tbody>
        </table>
        <?php } else { ?>
        <h2 class="text-center text-danger">No Birthday Today</h2>
        <?php
        } ?>
    </div>
<?php } ?>
<script type="text/javascript">

    $(document).ready(function () {
        $('#student_datatable').DataTable({
            dom: 'Bfrtip',
            iDisplayLength: 10,
            buttons: [
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                },
            ],

            search: true
        });
    });
</script>
