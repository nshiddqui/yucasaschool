<?php $activeTab = "exam_marks"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Exam</a></li>
        <li class="active">Exam Schedule</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/student/exam_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<div class="row hidden">
   <div class="col-md-12">
      <a href="http://desktop-22kuple/edurama_full/index.php/student/exam" class="btn btn-white">
      Active Exams        </a>
      <a href="http://desktop-22kuple/edurama_full/index.php/student/exam_result" class="btn btn-primary">
      View Results        </a>
   </div>
</div>

<div class="row">
   <div class="col-md-12">
      <div id="table_export_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
        
         
         <table class="table table-bordered dataTable no-footer" id="table_export" role="grid" aria-describedby="table_export_info">
            <thead>
               <tr role="row">
                  <th>
                     <div>Exam Name</div>
                  </th>
                  <th>
                     <div>Subject</div>
                  </th>
                  <th>
                     <div>Exam Date</div>
                  </th>
                  <th>
                     <div>Total Marks</div>
                  </th>
                  <th>
                     <div>Obtained Marks</div>
                  </th>
                  <th>
                     <div>Answer Script</div>
                  </th>
               </tr>
            </thead>
            <tbody>
            <?php   
             if($result_data != ""){ 
               foreach($result_data as $dt){
                 $exam_details = @$this->db->get_where('exam',array('exam_id'=>$dt->exam_id))->row();
                 $exam_subject = @$this->db->get_where('subject',array('subject_id'=>$dt->subject_id))->row()->name;
               ?>
               <tr>
                  <td><?php echo $exam_details->name;?></td>
                  <td><?php echo $exam_subject;?></td>
                  <td>
                   <?php   if($exam_details->date != ""){echo date('d F Y  ( l ) ',strtotime($exam_details->date)); } ?>                 
                  </td>
                  <td>
                     <?php echo $dt->mark_obtained;?>                      
                  </td>
                  <td>
                     0                        
                  </td>
                
                  <td>
                     <a href="#" type="button" class="btn btn-success">
                     Answer Script
                    </a>
                  </td>
               </tr>
            <?php }}?>
            </tbody>
         </table>
      </div>
   </div>
</div>