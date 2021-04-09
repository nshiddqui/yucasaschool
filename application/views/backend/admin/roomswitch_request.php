<?php $activeTab = "switch_request"; ?>
<div class="page-header-content container-fluid">
  <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Hostel Management</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a> </div>
  </div>
 <?php include base_path().'application/views/backend/navigation_tab/hostel_nav_tab.php'; ?> 

</div>
<div class="clearfix"></div>

<div class="row">
  <div class="col-md-12"> 
    <!--
    <ul class="nav nav-tabs bordered">
      <li class="active"> <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> <?php echo get_phrase('request_list');?> </a></li>
      <li><a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
			<?php echo get_phrase('switch_assign_room');?></a>
	  </li>
    </ul> -->
    <div class="tab-content"> <br>
      <div class="tab-pane box <?php if(!isset($edit_data))echo 'active';?>" id="roomswitch_request">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered no-shad datatable">
          <thead>
            <tr>
              <th><div><?php echo get_phrase('request_id');?></div></th>
              <th><div>Current Hostel</div></th>
              <th><div>Applied Hostel</div></th>
              <th><div><?php echo get_phrase('designation');?></div></th>
              <th><div>Applicant Name</div></th>
              <th><div>Reason</div></th>
              <th><div>Status</div></th>
              <th><div>Applied Date</div></th>
              <th><div><?php echo get_phrase('options');?></div></th>
            </tr>
          </thead>
          <tbody>
            <?php $count = 1;
            if(isset($roomswitch_list) && !empty($roomswitch_list)){
			foreach($roomswitch_list as $row):?>
	
            <tr>
              <td><?php echo $row->rId;?></td>
              <td><?php echo 'Hostel Name:-'.$row->current_hostel_name.'<br>Room Type:- '.$row->current_room_type.'<br>Room No:- '.$row->current_room_no;?></td>
              <td><?php echo 'Hostel Name:-'.$row->new_hostel_name.'<br>Room Type:- '.$row->new_room_type.'<br>Room No '.$row->new_room_no.'<br>Bed No:- '.$row->new_bed_id; ?></td>
              <td><?= $row->designation_name ?></td>
              <td><?= $row->student_name.($row->type == 2 ? '( Staff )': '( Student )') ?></td>
              <td><?= $row->reason ?></td>
              <td><?= ucfirst($row->room_status) ?></td>
              <td><?= date('M d Y',strtotime($row->create_at)) ?></td>
              <td><div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> Action <span class="caret"></span> </button>
                  <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                    
                    <li class="divider"></li>
                    <?php if($row->room_status != 'approve' && $row->room_status != 'reject'){ ?>
                    <li> <a href="#" onclick='approve_status("<?php echo $row->rId;?>","<?php echo $row->student_id;?>","<?php echo $row->new_room_id;?>","<?php echo $row->new_hostel_id;?>")'> <i class="entypo-check"></i> Approve </a> </li>
                    <li> <a href="#" onclick='reject_status("<?php echo $row->rId;?>","<?php echo $row->student_id;?>","<?php echo $row->new_room_id;?>","<?php echo $row->new_hostel_id;?>")'> <i class="entypo-check"></i> Reject </a> </li>
                    <li class="divider"></li>
                    <?php } ?>
                    <li> <a href="#" onclick="confirm_modal('<?php echo site_url('admin/deleteHostelRequest/'.$row->rId);?>');"> <i class="entypo-trash"></i> <?php echo get_phrase('delete');?> </a> </li>
                  </ul>
                </div></td>
            </tr>
            <?php endforeach; } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
   function approve_status(switch_id,student_id,room_id,hostel_id){
    var r = confirm("Are you sure, you want to approve this request?");
        if (r == false) {
           return false;
        }
      $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('admin/room_switch_status');?>",
            data   : {switch_id : switch_id,student_id : student_id,room_id : room_id,hostel_id : hostel_id,status:'approved' },               
            async  : false,
            success: function(response){  
			
            if(response)
            {
             location.reload();
            }
          }
        });   
    }
    function reject_status(switch_id,student_id,room_id,hostel_id){
        var r = confirm("Are you sure, you want to reject this request?");
        if (r == false) {
           return false;
        }

        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('admin/room_switch_status');?>",
            data   : { switch_id : switch_id,student_id : student_id,room_id : room_id,hostel_id : hostel_id,status:'reject' },               
            async  : false,
            success: function(response){                                                   
               if(response)
               { 
                location.reload();
               }
            }
        });
    }
</script>