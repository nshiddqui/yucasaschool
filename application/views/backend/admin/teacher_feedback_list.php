<?php $activeTab = "teacher_feedback"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Teachers</a></li>
        <li class="active">All Teachers</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/teacher_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>
<div class="row">
 <div class="col-md-12">
    <div class="panel panel-primary" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="entypo-plus-circled"></i>
                Feedback Form List                    
            </div>
        </div>
        <div class="panel-body">
           <table class="table datatable table-stripped">
              <thead>
                  <tr>
                      <th>Id</th>
                      <th>Feedback Form Name</th>
                      <th>Responses</th>
                      <th>Status</th>
                      <th>Options</th>
                      <th>Edit</th>

                  </tr>
              </thead>

              <tbody>
                    <?php
          $i=1;
            $classes = $this->db->get('teacher_feedback')->result_array();
            foreach ($classes as $row):
			$id= $row['id'];
                ?>
                  <tr>
			
                      <td><?php echo $i;?></td>
                      <td><?php echo $row['title']; ?></td>
                      <td><a href="<?php echo base_url();?>index.php/admin/teacher_feedback_response/<?php echo $row['id']; ?>">  <i class="entypo-eye"></i>  
<?php 
echo $number_of_student_in_current_session = $this->db->get_where('student_online_feedback_result', array('feedback_id' => $id))->num_rows();
?>

 </a></td>
                      
                       <?php $status= $row['status']; 
                              if($status==1){?>
                              <td> <span class='active'>Active </span></td>
                              <?php } else { ?>
                               <td><span class='deactive'>Deactive </span></td>
                               <?php } ?>
                      <td><a href="<?php echo base_url();?>index.php/admin/teacher_feedback_manage/<?php echo $row['id']; ?>">  <i class="entypo-pencil"></i> Manage Questions</a></td>
            
            <td> <a href="<?php echo site_url('admin/update_teacher_feedback/').$row['id']; ?>" >
                                    <i class="entypo-pencil"></i>
                                    <?php echo get_phrase('edit_feedback_info');?>
                                </a></td>
                  </tr>
                  <?php $i++; endforeach ?>
              </tbody>
          </table>

        </div>
    </div>
</div>
</div>