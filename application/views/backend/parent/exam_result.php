<?php $activeTab = "exam_marks"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Exam</a></li>
        <li class="active">Exam Result</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/parent/exam_nav_tab.php'; ?>
<!-- Including Navigation Tab -->
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
                     <div>Result</div>
                  </th>
                  <th>
                     <div>Answer Script</div>
                  </th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>hindi</td>
                  <td>Hindi</td>
                  <td>
                     <b>Date:</b> Sep 13, 2018<br><b>Time:</b> 16:10:00 - 16:30:00                       
                  </td>
                  <td>
                     0                       
                  </td>
                  <td>
                     0                        
                  </td>
                  <td>
                     Fail( Absent )                        
                  </td>
                  <td>
                     <a href="#" type="button" class="btn btn-success">
                     Answer Script
                    </a>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>
</div>