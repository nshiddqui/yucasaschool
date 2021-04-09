<?php $activeTab = "library"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Library</a></li>
        <li class="active">Book List</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/student/facilities_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<button onclick="showAjaxModal('<?php echo site_url('modal/popup/book_request_add');?>');"
    class="btn btn-primary pull-right">
        <?php echo get_phrase('request_book'); ?>
</button>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12">

        <!---CONTROL TABS START-->
        <ul class="nav nav-tabs bordered hidden">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
                    <?php echo get_phrase('book_list');?>
                        </a></li>
        </ul>
        <!---CONTROL TABS END-->


        <div class="tab-content">
        <br>
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">

                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="books">
                    <thead>
                        <tr>
                            <th width="40"><div><?php echo get_phrase('book_id');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th><div><?php echo get_phrase('author');?></div></th>
                            <th><div><?php echo get_phrase('description');?></div></th>
                            <th><div><?php echo get_phrase('total_copies');?></div></th>
                            <th><div><?php echo get_phrase('class');?></div></th>
                            <!-- <th><div><?php echo get_phrase('download');?></div></th> -->
                        </tr>
                    </thead>
                </table>
            </div>
            <!--TABLE LISTING ENDS-->
        </div>
    </div>
</div>
</div>


<script type = 'text/javascript'>
    jQuery(document).ready(function($) {
        $.fn.dataTable.ext.errMode = 'throw';
        $('#books').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                "url": "<?php echo site_url('student/get_books') ?>",
                "dataType": "json",
                "type": "POST",
            },
            "columns": [
                { "data": "book_id" },
                { "data": "name" },
                { "data": "author" },
                { "data": "description" },
                { "data": "total_copies" },
                { "data": "class" },
            ],
            "columnDefs": [
                {
                    "targets": [1,2,4],
                    "orderable": false
                },
            ]
        });
    });
</script>