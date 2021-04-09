<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('hostel_staff_report');?>
            	</div>
            </div>
<div class="filter_form">
<?php echo form_open(''); ?>
<div class="row">
	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('select_designation');?></label>
			<select name="designation_id" class="form-control selectboxit">
				<option value=""><?php echo get_phrase('All');?></option>
				<?php
				$designationArray =array();
					$classes = $this->db->get('designations')->result_array();
					$designation_id = isset($_POST['designation_id'])?$_POST['designation_id']:'';
				
					foreach($classes as $row):
					    $designationArray[$row['id']] = $row['name'];   
				?>
                                
				<option value="<?php echo $row['id'];?>" <?= $designation_id == $row['id']?'selected':'' ?>><?php echo $row['name'];?></option>
                                
				<?php endforeach;?>
			</select>
		</div>
	</div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('start_date');?></label>
            <input type="text" class="form-control datepicker" name="datefrm" value="<?= isset($_POST['datefrm']) ? $_POST['datefrm']: ''?>" placeholder="Start Date" data-format="yyyy-mm-dd" autocomplete="off">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('end_date');?></label>
            <input type="text" class="form-control datepicker" name="dateto" value="<?= isset($_POST['dateto']) ? $_POST['dateto']: ''?>" placeholder="End Date"  data-format="yyyy-mm-dd" autocomplete="off">
        </div>
    </div>
    <div class="col-md-2">
	    <div class="form-group">
	        <label class="control-label" style="margin-bottom: 5px;">&nbsp;</label>
		    <button type="submit" id = "submit" class="btn btn-info btn-block"><?php echo get_phrase('get_data');?></button>
		</div>
	</div>

</div>
<?php echo form_close();?>
</div>   
<?php if(isset($hostel_data)) {
?>
            <div class="panel-body table-responsive">

                            <table id="datatable-responsive" class="table datatable table-bordered dt-responsive">
                                <thead>
                                    <tr>
                                        <th>Serial no</th>
                                     
                                        <th>Staff name</th>
                                        <th>Designation</th>
                                        <th>Room no</th>
                                        <th>Bed no</th>
                                        <th>Total Seat</th>
                                        <th>Room Type</th>
                                        <th>Hostel name</th>
                                     
                                        <th>Contact</th>

                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php
                                     
                          foreach ($hostel_data as $val){
                              $desingation_name = $designationArray[$val['designation_id']];
                              if($this->db->table_exists(lcfirst($desingation_name))){
                                  $id=lcfirst($desingation_name).'_';
                                        $attendance_of_students = $this->db->get_where(lcfirst($desingation_name), array(
                                                    'status'  => 1,'is_hostel_member'  => 1,$id.'id'  => $val['user_id']
                                                ))->result_array();
                            
                            $table=$desingation_name;
                              } else {
                                  $attendance_of_students = array();
                              }
                              
                                     ?>
                                           <?php if(!empty($attendance_of_students)){
                                           
                            //echo $this->db->last_query();
                           
                                 $hostel_name = $this->db->get_where('hostels',array('id'=>$val['hostel_id']))->row()->name;
                                 $subjectname = $this->db->get_where('rooms',array('id'=>$val['room_id'],'hostel_id'=>$val['hostel_id']))->row()->room_no;
                                 $total_seat = $this->db->get_where('rooms',array('id'=>$val['room_id'],'hostel_id'=>$val['hostel_id']))->row()->total_seat;
                                 $room_type = $this->db->get_where('rooms',array('id'=>$val['room_id'],'hostel_id'=>$val['hostel_id']))->row()->room_type;
                            
                                           ?>                              
                                        <tr>
                                            <td><?php echo $val['id']; ?></td>
                                            <td><?php echo $attendance_of_students[0]['name']; ?></td>  
                                            <td><?php echo $table; ?></td>
                                            <td><?php echo $subjectname; ?> </td>
                                         <td><?php echo $val['beds']; ?> </td>
                                          <td><?php echo $total_seat; ?> </td>  
                                           <td><?php echo $room_type; ?> </td>                                           
                                                                                     
                                           

                                           <td><?php  echo $hostel_name; ?> </td>

                                           <td><?php  echo $attendance_of_students[0]['phone']; ?> </td>
                                                                                      
                                        </tr>
                                        <?php } ?>
                                   <?php } ?>
                                </tbody>
                            </table>
            </div>
<?php } ?>
