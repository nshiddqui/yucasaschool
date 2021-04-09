<?php $activeTab = "leaves"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Librarian</a></li>
        <li class="active">Leaves Past Record</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/librarian/user_leave_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<table class="table table-bordered datatable" >
    <thead>
        <tr>
            <th>S.No</th>
            <th><div><?php echo get_phrase('Request_Id');?></div></th>
            <th><div><?php echo get_phrase('From');?></div></th>
            <th><div><?php echo get_phrase('to');?></div></th>
            <th><div><?php echo get_phrase('status');?></div></th>
        </tr>
    </thead>
    <tbody>
       <?php 
       if($leave_data != ""){
        $i=1;
       foreach ($leave_data as  $dt) { ?>
        <tr>
            <td><?php echo $i++;?></td>
            <td><?php echo $dt->uniqid;?></td>
            <td><?php echo $dt->from_date!=""?$dt->from_date:'1 day ( '.$dt->leave_date.' )';?></td>
            <td><?php echo $dt->to_date;?></td>
            <td><span class="<?php echo $dt->status;?>"><?php echo $dt->status;?></span></td>
        </tr>
    <?php }} ?>
    </tbody>
</table>
