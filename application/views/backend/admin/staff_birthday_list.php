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
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('select_designation'); ?></label>
            <select name="designation_id" class="form-control selectboxit">
                <option value=""><?php echo get_phrase('all'); ?></option>
                <?php
                $classes = $this->db->get('designations')->result_array();
                $designation_id = $_POST['designation_id'];
                foreach ($classes as $row):
                    ?>

                    <option value="<?php echo $row['id']; ?>" <?php if ($row['id'] == $designation_id) {
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


    <div class="row">
        <div class="col-md-12">

            <div class="">
                <div class="" id="home">
                    <?php if(!empty($data)){ ?> <h2 class="text-center text-danger">No Birthday Today</h2>
                    <table class="table table-bordered" id="student_datatable">
                        <thead>
                            <tr>
                                <th width="80"><div><?php echo get_phrase('id_no'); ?></div></th>
                                <th width="80"><div><?php echo get_phrase('photo'); ?></div></th>
                                <th><div><?php echo get_phrase('name'); ?></div></th>
                                <th><div><?php echo get_phrase('designation'); ?></div></th>
                                <th><div><?php echo get_phrase('email'); ?></div></th>
                                <th><div><?php echo get_phrase('phone'); ?></div></th>
                                <th><div><?php echo get_phrase('join_date'); ?></div></th>
                                <th><div><?php echo get_phrase('birthday'); ?></div></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $key => $row):
                                ?>
                                <?php $row = json_decode(json_encode($row), True); ?>

                                <tr>
                                    <td>
                                        <?= $key  ?>
                                    </td>
                                    <td><img src="<?= $row['photo']?>" class="img-circle" width="30" /></td>
                                    <td>
                                        <?= $row['name'] ?>
                                    </td>
                                    <td>
                                        <?= $row['designation'] ?>
                                    </td>
                                    <td>
                                        <?= $row['email'] ?>
                                    </td>
                                    <td>
                                        <?= $row['phone'] ?>
                                    </td>
                                    <td>
                                        <?= $row['join_date'] ?>
                                    </td>
                                    <td>
                                        <?= $row['dob'] ?>
                                    </td>
                                </tr>
    <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php } else { ?>
                    
                     <h2 class="text-center text-danger">No Birthday Today</h2>
                    <?php } ?>

                </div>
            </div>


        </div>
    </div>

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
