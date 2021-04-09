<?php   

 $studnet_list = $this->db->get_where('student', array('parent_id' => logged_in_user_id()))->result();

        $enroll = $this->db->get_where('enroll', array('student_id' => logged_in_user_id()))->row();
		  $card_code=$route_stops->card_code;
        $card_block = $this->db->get_where('block_rfid_card_request', array('card_user' => logged_in_user_id(),'card_no' =>$card_code))->result();
	
?>
<?php $activeTab = "card"; ?>                   
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Card</a></li>
        <li class="active">RFID Card Block</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/student/facilities_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

					
					<div class="tab-pane" id="1">

                <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
		
				<div class="row">
				<div class="col-sm-12">
				<table class="table table-bordered datatable dataTable no-footer" id="DataTables_Table_1" role="grid" aria-describedby="DataTables_Table_1_info">
                    <thead>
                        <tr role="row">
						<th width="80" class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id No: activate to sort column descending" style="width: 0px;">
						<div>Apply By</div>
						</th>
						<th width="80" class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Photo: activate to sort column ascending" style="width: 0px;">
						<div>Relation</div>
						</th>
						<th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 0px;">
						<div>Student Name</div>
						</th>
						<th class="span3 sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Address: activate to sort column ascending" style="width: 0px;">
						<div>Card No</div>
						</th>
						<th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" style="width: 0px;">
						<div>Staus</div>
						</th>
						<th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Options: activate to sort column ascending" style="width: 0px;">
						<div>Date/Time</div>
						</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Options: activate to sort column ascending" style="width: 0px;">
						<div>Block Card</div>
						</th>
						</tr>
                    </thead>
                    <tbody>
                                                
                         <?php foreach($studnet_list as $obj){ ?>                            
                            <tr role="row" class="odd">
							<?php $role_id=$obj->role_id; ?>
							<?php if($role_id='4'){ ?>
                            <td class="sorting_1"><?php echo $route->name;?> </td>
							<?php } else { ?>
                            <td class="sorting_1">Teacher </td>
							<?php } ?>
                            <td><?php if($role_id='4'){ echo 'self'; } elseif($role_id='8'){ echo'Parent';}elseif($role_id='5'){echo 'Teacher'; } ?>  </td>
                            <td><?php echo $route->name;?></td>
                            <td><?php echo $route_stops->card_code;?></td>
                            <td><?php if($route_stops->card_code_status='2'){?> <span style="text-align: center;color: white; background-color: red;padding: 10px;">Block</span> <?php } else { ?> <span style="text-align: center;color: white; background-color:green;padding: 10px;">Activate</span> <?php } ?></td>
                            <td class="sorting_1"><?php echo $obj->block_date; ?> </td>                           
						   <td>
							<form method="post" id="form_search"action="<?php echo site_url('student/block_rf_id_card')?>" name="myform">
							<input type="hidden" name="card_code" value="<?php echo $route_stops->card_code;?>">
							<select name="card_status" onchange="mySubmit(this.form)">
                               <option > Select</option>
                               <option value="1"> Active</option>
                               <option value="2"> Deactive</option>
                               </select> </form></td>
                        </tr>
						  <?php } ?>
						
			<script>
function mySubmit(theForm) {
    $.ajax({ // create an AJAX call...
        data: $(theForm).serialize(), // get the form data
        type: $(theForm).attr('method'), // GET or POST
        url: $(theForm).attr('action'), // the file to call
        success: function (response) { // on success..
            $('#here').html(response); // update the DIV
        }
    });
}
</script>	

					
				</tbody>
                </table>
				</div>
				</div>
		
		
	</div>

            </div>
            </div>
                    