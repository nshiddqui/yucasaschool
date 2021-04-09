<?php $activeTab = "online_exam"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Exam</li>
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
      <a href="http://desktop-22kuple/edurama_full/index.php/student/exam" class="btn btn-primary">
      Active Exams        </a>
      <a href="http://desktop-22kuple/edurama_full/index.php/student/exam_result" class="btn btn-white">
      View Results        </a>
   </div>
</div>

<div class="row">
   <div class="col-md-12">
      <div id="table_export_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
         <div class="dt-buttons btn-group">
            <button class="btn btn-default buttons-copy buttons-html5" tabindex="0" aria-controls="table_export"><span>Copy</span></button>
            <button class="btn btn-default buttons-csv buttons-html5" tabindex="0" aria-controls="table_export"><span>CSV</span></button>
            <button class="btn btn-default buttons-excel buttons-html5" tabindex="0" aria-controls="table_export"><span>Excel</span></button>
            <button class="btn btn-default buttons-pdf buttons-html5" tabindex="0" aria-controls="table_export"><span>PDF</span></button>
            <button class="btn btn-default buttons-print" tabindex="0" aria-controls="table_export"><span>Print</span></button>
        </div>
         <div id="table_export_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="table_export"></label></div>
         <table class="table table-bordered dataTable no-footer" id="table_export" role="grid" aria-describedby="table_export_info">
            <thead>
               <tr role="row">
                  <th class="sorting_asc" tabindex="0" aria-controls="table_export" rowspan="1" colspan="1" style="width: 190px;" aria-sort="ascending" aria-label="Exam Name: activate to sort column descending">
                     <div>Exam Name</div>
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="table_export" rowspan="1" colspan="1" style="width: 134px;" aria-label="Subject: activate to sort column ascending">
                     <div>Subject</div>
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="table_export" rowspan="1" colspan="1" style="width: 177px;" aria-label="Exam Date: activate to sort column ascending">
                     <div>Exam Date</div>
                  </th>
                  <th width="40%" class="sorting" tabindex="0" aria-controls="table_export" rowspan="1" colspan="1" style="width: 373px;" aria-label="Options: activate to sort column ascending">
                     <div>Options</div>
                  </th>
               </tr>
            </thead>
            <tbody>
               <tr class="odd">
                  <td valign="top" colspan="4" class="dataTables_empty">No data available in table</td>
               </tr>
            </tbody>
         </table>
         <div class="dataTables_info" id="table_export_info" role="status" aria-live="polite">Showing 0 to 0 of 0 entries</div>
         <div class="dataTables_paginate paging_simple_numbers" id="table_export_paginate">
            <ul class="pagination">
               <li class="paginate_button previous disabled" id="table_export_previous"><a href="#" aria-controls="table_export" data-dt-idx="0" tabindex="0">Previous</a></li>
               <li class="paginate_button next disabled" id="table_export_next"><a href="#" aria-controls="table_export" data-dt-idx="1" tabindex="0">Next</a></li>
            </ul>
         </div>
      </div>
   </div>
</div>
</div>