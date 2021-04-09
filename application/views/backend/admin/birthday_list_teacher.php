<?php $activeTab = "teacher"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Teachers</a></li>
        <li class="active">Birthday List</li>
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
                            <th><div><?php echo get_phrase('birthday');?></div></th>
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
                "url": "<?php echo site_url('admin/get_birthday_list_teachers') ?>",
                "dataType": "json",
                "type": "POST",
            },
            "columns": [
                { "data": "teacher_id" },
                { "data": "photo" },
                { "data": "name" },
                { "data": "birthday" }
            ],
            "columnDefs": [
                {
                    "targets": [1],
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

</script>