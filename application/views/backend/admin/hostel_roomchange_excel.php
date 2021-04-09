<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
					Room change request report
            	</div>
            </div>
			<div class="panel-body">
				<div class="row">
                <?php echo form_open('' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                    <div class="col-md-3">
					    <div class="form-group">
        					<select name="type" class="form-control selectboxit">
        				            <option value="1">Student Report</option>
        				            <option value="2" <?= isset($_POST['type']) && $_POST['type']=='2' ? 'selected' :'' ?>>Staff Report</option>
            			    </select>
						</div>
					</div>
					<div class="col-md-3">
                        <div class="form-group">
                            <input type="text" class="form-control datepicker" name="datefrm" value="<?= isset($_POST['datefrm']) ? $_POST['datefrm']: ''?>" placeholder="Start Date" data-format="yyyy-mm-dd" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" class="form-control datepicker" name="dateto" value="<?= isset($_POST['dateto']) ? $_POST['dateto']: ''?>" placeholder="End Date" data-format="yyyy-mm-dd" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('get_report');?></button>
						</div>
					</div>

                <?php echo form_close();?>
                </div>
                <?php
                if(isset($data)){ ?>
                <br>
                <br>
                <br>
  <div class="tab-content">
      <?php if($type=='1') { ?>
    <div id="home" class="tab-pane fade in active">
  <table class="table table-bordered datatable ">
        <thead>
          <tr>
       
            <th><?php echo get_phrase('Serial Number'); ?></th>
            <th><?php echo get_phrase('Student name'); ?></th>
            <th><?php echo get_phrase('Class Name'); ?></th>
            <th><?php echo get_phrase('Previous hostel'); ?></th>
            <th><?php echo get_phrase('Previous room no'); ?></th>
            <th><?php echo get_phrase('Current hostel'); ?></th>
            <th><?php echo get_phrase('Current Room/Bed  No'); ?></th>
            <th><?php echo get_phrase('Year'); ?></th>
            <th><?php echo get_phrase('Date'); ?></th>
            <th><?php echo get_phrase('Reason'); ?></th>
          </tr>
        </thead>
        <tbody>
            <?php 
             foreach ($data as $key =>  $val){
                $class_id = $this->db->get_where('enroll', array('student_id' => $val->student_id))->row()->class_id;
                $class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
           ?>
        <tr>
            <td><?php echo $key+1; ?></td>
            <td><?php echo $val->student_name; ?></td>
            <td><?php echo $class_name; ?></td>
            <td><?php echo $val->current_hostel_name; ?></td>
            <td><?php echo $val->current_room_no; ?></td>
            <td><?php echo $val->new_hostel_name; ?></td>
            <td><?php echo $val->new_room_no.'[ '.$val->new_bed_id.' ]'; ?></td>
            <td><?php echo date('Y',strtotime($val->create_at)); ?></td>
            <td><?php echo date('M d y',strtotime($val->create_at)); ?></td>
            <td><?php echo $val->reason; ?></td>
        </tr>
      <?php } ?>
         
        </tbody>
      </table>
</div>
    <?php } ?>
 <?php if($type=='2') { ?>
        <table class="table table-bordered datatable ">
        <thead>
          <tr>
       
            <th><?php echo get_phrase('Serial Number'); ?></th>
            <th><?php echo get_phrase('Staff name'); ?></th>
            <th><?php echo get_phrase('Designation'); ?></th>
            <th><?php echo get_phrase('Previous hostel'); ?></th>
            <th><?php echo get_phrase('Previous room no'); ?></th>
            <th><?php echo get_phrase('Current hostel'); ?></th>
            <th><?php echo get_phrase('Current Room/Bed  No'); ?></th>
            <th><?php echo get_phrase('Year'); ?></th>
            <th><?php echo get_phrase('Date'); ?></th>
            <th><?php echo get_phrase('Reason'); ?></th>
          </tr>
        </thead>
        <tbody>

        <?php 
         foreach($data as $Key => $val){
        ?>
        <tr>
            <td><?php echo $key+1; ?></td>
            <td><?php echo $val->student_name; ?></td>
            <td><?php echo $val->designation_name;; ?></td>
            <td><?php echo $val->current_hostel_name; ?></td>
            <td><?php echo $val->current_room_no; ?></td>
            <td><?php echo $val->new_hostel_name; ?></td>
            <td><?php echo $val->new_room_no.'[ '.$val->new_bed_id.' ]'; ?></td>
            <td><?php echo date('Y',strtotime($val->create_at)); ?></td>
            <td><?php echo date('M d y',strtotime($val->create_at)); ?></td>
            <td><?php echo $val->reason; ?></td>
        </tr>
      <?php } ?>
         
        </tbody>
      </table>
      <?php } ?>
   


  </div>
  <?php   }  ?>
				
            </div>
        </div>
    </div>
</div>














