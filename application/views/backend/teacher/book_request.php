<?php $activeTab = "library"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Library</a></li>
        <li class="active">My Book Requests</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/teacher/facilities_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<table class="table table-bordered" id="table_export">
    <thead>
        <tr>
            <th style="width: 60px;">#</th>
            <th><?php echo get_phrase('requested_book');?></th>
            <th><?php echo get_phrase('requested_by');?></th>
            <th><?php echo get_phrase('issue_starting_date');?></th>
            <th><?php echo get_phrase('issue_ending_date');?></th>
            <th><?php echo get_phrase('request_status');?></th>
        </tr>
    </thead>

    <tbody>
        <?php
        $count = 1;
        $this->db->order_by('book_request_id', 'desc');
        $book_requests = $this->db->get_where('book_request', array('user_id' => $this->session->userdata('login_user_id'),'role_id'=>TEACHER))->result_array();
        foreach ($book_requests as $row) { ?>   
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $this->db->get_where('book', array('book_id' => $row['book_id']))->row()->name; ?></td>
                <td><?php echo $this->db->get_where('teacher', array('teacher_id' => $row['user_id']))->row()->name; ?></td>
                <td><?php echo date('d/m/Y', $row['issue_start_date']); ?></td>
                <td><?php echo date('d/m/Y', $row['issue_end_date']); ?></td>
                <td>
                    <?php
                        if($row['status'] == 0)
                            $status = '<span class="label label-info" style="font-size: 10px;">' . get_phrase('pending') . '</span>';
                        else if($row['status'] == 1)
                            $status = '<span class="label label-success" style="font-size: 10px;">' . get_phrase('issued') . '</span>';
                        else
                            $status = '<span class="label label-danger" style="font-size: 10px;">' . get_phrase('rejected') . '</span>';
                        echo $status;
                    ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
