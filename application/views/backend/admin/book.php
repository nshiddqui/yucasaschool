<?php $activeTab = "library"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Facilities</a></li>
        <li class="active">Library</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/facilities_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<div class="row">
<div class="col-md-12">

<!---CONTROL TABS START-->
<ul class="nav nav-tabs bordered">
<li class="active">
<a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
    <?php echo get_phrase('book_list');?>
        </a></li>
<li>
<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
    <?php echo get_phrase('add_book');?>
        </a></li>
<li>
<a href="#issue_list" data-toggle="tab"><i class="entypo-menu"></i>
    <?php echo get_phrase('issue_list');?>
        </a></li>

</ul>
<!---CONTROL TABS END-->


<div class="tab-content">
<br>
<!----TABLE LISTING STARTS-->
<div class="tab-pane box active" id="list">

<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="books">
    <thead>
        <tr>
            <th width="40"><div><?php echo get_phrase('book_id');?></div></th>
            <th><div><?php echo get_phrase('name');?></div></th>
            <th><div><?php echo get_phrase('author');?></div></th>
            <th><div><?php echo get_phrase('description');?></div></th>
            <th><div><?php echo get_phrase('price');?></div></th>
            <th><div><?php echo get_phrase('class');?></div></th>
            <th><div><?php echo get_phrase('Total_book');?></div></th>
            <th><div><?php echo get_phrase('download');?></div></th>
            <th><div><?php echo get_phrase('options');?></div></th>
        </tr>
    </thead>
</table>
</div>
<!----TABLE LISTING ENDS--->


<!----CREATION FORM STARTS---->
<div class="tab-pane box" id="add" style="padding: 5px">
<div class="box-content">
    <?php echo form_open(site_url('admin/book/create') , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top','enctype'=>'multipart/form-data'));?>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="name"
                        data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('author');?></label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="author"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="description"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('price');?></label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="price"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                <div class="col-sm-5">
                    <select name="class_id" id = "class_id" class="form-control selectboxit" style="width:100%;">
                    <option value=""><?php echo get_phrase('select_class'); ?></option>
                        <?php
                        $classes = $this->db->get('class')->result_array();
                        foreach($classes as $row):
                        ?>
                            <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
             <div class="form-group"> <label class="col-sm-3 control-label">File</label> <div class="col-sm-5"> <input type="file" name="file_name" class="form-control"> </div> </div>

                <div class="form-group">
              <div class="col-sm-offset-3 col-sm-5">
                  <button type="submit" id = "submit" class="btn btn-info"><?php echo get_phrase('add_book');?></button>
              </div>
                </div>
    </form>
</div>
</div>
<div class="tab-pane box" id="issue_list">

<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="issue_list">
    <thead>
       <tr>
            <th style="width: 60px;">#</th>
            <th><?php echo get_phrase('requested_book');?></th>
            <th><?php echo get_phrase('requested_by');?></th>
            <th><?php echo get_phrase('issue_starting_date');?></th>
            <th><?php echo get_phrase('issue_ending_date');?></th>
            <th><?php echo get_phrase('request_status');?></th>
            <th><?php echo get_phrase('options');?></th>
        </tr>
    </thead>
     <tbody>
        <?php
        $count = 1;
        $this->db->order_by('book_request_id', 'desc');
        $book_requests = $this->db->get('book_request')->result_array();
        foreach ($book_requests as $row) { ?>   
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $this->db->get_where('book', array('book_id' => $row['book_id']))->row()->name; ?></td>
                <td>
                <?php 
                  if($row['role_id'] == STUDENT)
                   echo $this->db->get_where('student', array('student_id' => $row['user_id']))->row()->name;
                  elseif($row['role_id'] == TEACHER)
                   echo $this->db->get_where('teacher', array('teacher_id' => $row['user_id']))->row()->name; 
                ?>
                </td>
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
                <td>
                    <?php if($row['status'] == 0) { ?>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                <li>
                                    <a href="<?php echo site_url('admin/book_request/accept/'.$row['book_request_id']);?>">
                                        <i class="entypo-check"></i>
                                        <?php echo get_phrase('accept');?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('admin/book_request/reject/'.$row['book_request_id']);?>">
                                        <i class="entypo-cancel"></i>
                                        <?php echo get_phrase('reject');?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <?php } else echo get_phrase('no_actions_available'); ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>
<!--<div class="tab-pane box" id="new_issue">

<form action="http://desktop-22kuple/edurama_pos_full/library/issue/add" name="add" id="add" class="form-horizontal form-label-left" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate">
                
                
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="book_id">Select Book <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control col-md-7 col-xs-12 fn_get_book" name="book_id" id="book_id" required="required">
                            <option value="">--Select--</option>
                                                                            <option value="1">Challenges of Telecom Tower Operators [BK00001]</option>
                                                                    </select>
                        <div class="help-block"></div>
                    </div>
                </div>               
                
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="isbn_no">ISBN No                                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input class="form-control col-md-7 col-xs-12" name="isbn_no" id="isbn_no" value="" readonly="readonly" placeholder="ISBN No" type="text">
                        <div class="help-block"></div>
                    </div>
                </div>
                
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="edition">Edition 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input class="form-control col-md-7 col-xs-12" name="edition" id="edition" value="" readonly="readonly" placeholder="Edition" type="text">
                        <div class="help-block"></div>
                    </div>
                </div>
                
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="author">Author 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input class="form-control col-md-7 col-xs-12" name="author" id="author" value="" readonly="readonly" placeholder="Author" type="text">
                        <div class="help-block"></div>
                    </div>
                </div>
                
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="language">Language 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input class="form-control col-md-7 col-xs-12" name="language" id="language" value="" readonly="readonly" placeholder="Language" type="text">
                        <div class="help-block"></div>
                    </div>
                </div>
                
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Price 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input class="form-control col-md-7 col-xs-12" name="price" id="price" value="" readonly="readonly" placeholder="Price" type="text">
                        <div class="help-block"></div>
                    </div>
                </div>
                
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="qty">Quantity 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input class="form-control col-md-7 col-xs-12" name="qty" id="qty" value="" readonly="readonly" placeholder="Quantity" type="text">
                        <div class="help-block"></div>
                    </div>
                </div>
                
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rack_no">Almira No 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input class="form-control col-md-7 col-xs-12" name="rack_no" id="rack_no" value="" readonly="readonly" placeholder="Almira No" type="text">
                        <div class="help-block"></div>
                    </div>
                </div>
                
               <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Book Cover</label>
                    <div class="col-md-6 col-sm-6 col-xs-12" id="cover">
                        <img src="" alt="" width="70">
                    </div>
               </div>
               
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="due_date">Due Date <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input class="form-control col-md-7 col-xs-12" name="due_date" id="due_date" value="" required="required" placeholder="Due Date" type="text" autocomplete="off">
                        <div class="help-block"></div>
                    </div>
                </div>
                
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="member_id">Library Member <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control col-md-7 col-xs-12" name="library_member_id" id="library_member_id" required="required">
                            <option value="">--Select--</option>
                                                                            <option value="1">rahul [LM00001]</option>
                                                                    </select>
                        <div class="help-block"></div>
                    </div>
                </div> 
                
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <a href="http://desktop-22kuple/edurama_pos_full/library/issue/index" class="btn btn-primary">Cancel</a>
                        <button id="fn_send" type="submit" class="btn btn-success">Issue</button>
                    </div>
                </div>
                </form>
</div>-->
</div>
</div>
</div>


<script type = 'text/javascript'>

$('input[type=file]').change(function () {
alert(this.files[0].mozFullPath);
});


var class_id = '';
jQuery(document).ready(function($) {
$.fn.dataTable.ext.errMode = 'throw';
$('#books').DataTable({
"processing": true,
"serverSide": true,
"ajax":{
"url": "<?php echo site_url('admin/get_books') ?>",
"dataType": "json",
"type": "POST",
},
"columns": [
{ "data": "book_id" },
{ "data": "name" },
{ "data": "author" },
{ "data": "description" },
{ "data": "price" },
{ "data": "class" },
{ "data": "total_copies" },
{ "data": "download" },
{ "data": "options" },
],
"columnDefs": [
{
    "targets": [1,2,3,5,6,7],
    "orderable": false
},
]
});

$("#submit").attr('disabled', 'disabled');
});

function book_edit_modal(book_id) {
showAjaxModal('<?php echo site_url('modal/popup/modal_edit_book/');?>' + book_id);
}

function book_delete_confirm(book_id) {
confirm_modal('<?php echo site_url('admin/book/delete/');?>' + book_id);
}

function check_validation(){
if(class_id !== ''){
$('#submit').removeAttr('disabled');
}
else{
$("#submit").attr('disabled', 'disabled');
}
}
$('#class_id').change(function(){
class_id = $('#class_id').val();
check_validation();
});
</script>
<script type="text/javascript">

    jQuery(document).ready(function($)
    {
        $("#table_export").dataTable();
    });
        
</script>