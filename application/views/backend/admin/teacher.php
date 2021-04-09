<?php $activeTab = "teacher"; ?>
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
<style>
.datahidden{
	display:none;
}
</style>
               <table class="table table-striped table-hover no-footer" id="teachers">
                    <thead>
                        <tr>
                            <th width="60"><div><?php echo get_phrase('teacher_id');?></div></th>
                            <th width="80"><div><?php echo get_phrase('photo');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th><div><?php echo get_phrase('email');?></div></th>
                            <th><div><?php echo get_phrase('phone');?></div></th>
                            <th><div><?php echo get_phrase('RFID');?></div></th>
			                <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                </table>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->
<script type="text/javascript">

    jQuery(document).ready(function($) {
        $.fn.dataTable.ext.errMode = 'throw';
        $('#teachers').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                "url": "<?php echo site_url('admin/get_teachers') ?>",
                "dataType": "json",
                "type": "POST",
            },
            "columns": [
                { "data": "teacher_id" },
                { "data": "photo" },
                { "data": "name" },
                { "data": "email" },
                { "data": "phone" },
                { "data": "rfid_code" },
                { "data": "options" },
            ],
            "columnDefs": [
                {
                    "targets": [1,5],
                    "orderable": false
                },
            ],
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
  
                  //'excelHtml5',
                  //'csvHtml5',
               
             //'pageLength'
              ],
        
              search: true
        });
    });

    function teacher_edit_modal(teacher_id) {
        showAjaxModal('<?php echo site_url('modal/popup/modal_teacher_edit/');?>' + teacher_id);
    }

    function teacher_delete_confirm(teacher_id) {
        confirm_modal('<?php echo site_url('admin/teacher/delete/');?>' + teacher_id);
    }

</script>


<!-- <script type="text/javascript">
        $(document).ready(function() {
          $('#teachers').DataTable( {
              dom: 'Bfrtip',
              iDisplayLength: 10,
              buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'csvHtml5',
                  'pdfHtml5',
                  'pageLength'
              ],
               exportOptions: {
            columns: ':not(.action)'
            },
              search: true
          });
        });
    // $("#add").validate();     
    // $("#edit").validate();
</script> -->