<?php $activeTab = "teacher_feedback"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Extra Curricular</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/student/extra_curricular_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>


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
					   <th>Teacher</th>
                      <th>Feedback Form Name</th>
                     
                      <th>Status</th>
                      <th>Options</th>
                  </tr>
              </thead>

              <tbody>
			
			<?php
            $i=1;
            $classes = $this->db->get('teacher_feedback')->result_array();

            foreach ($classes as $row){
              $teacher_id= $row['teacher_id'];
			 $teacher_data = $this->db->query("select * from teacher where teacher_id IN ($teacher_id)")->result(); 
	 
                 foreach ($teacher_data as $key => $dt){
				
				?>
                  <tr>
				  <?php $feedback_id= $row['id']; ?>
                      <td><?php echo $i;?></td>
					    
                      <td><?php echo $dt->name ?></td>
                      <td><?php echo $row['title']; ?></td>
		
              
				
                              
                      <td><a href="<?php echo base_url();?>index.php/student/teacher_feedback/<?php echo $row['id']; ?>/<?php echo $dt->teacher_id ?>" class="btn btn-info">  <i class="entypo-pencil"></i> Submit Feedback</a></td>
            
                  </tr>
			<?php $i++; } }  ?>
              </tbody>
          </table>

        </div>
    </div>
</div>