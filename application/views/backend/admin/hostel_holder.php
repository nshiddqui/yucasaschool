<style>
    #table-data::parent {
        overflow:scroll;
    }
</style>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('hostel_student_report');?>
            	</div>
            </div>
            <div class="filter_form">
<?php echo form_open(''); ?>
<div class="row">
	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class');?></label>
			<select name="class_id" class="form-control selectboxit" onchange="select_section(this.value)" id = "class_selection">
				<option value=""><?php echo get_phrase('select_class');?></option>
				<?php
					$classes = $this->db->get('class')->result_array();
					$class_id = isset($_POST['class_id'])?$_POST['class_id']:'';
					foreach($classes as $row):
                                            
				?>
                                
				<option value="<?php echo $row['class_id'];?>" <?= $class_id == $row['class_id']?'selected':'' ?>><?php echo $row['name'];?></option>
                                
				<?php endforeach;?>
			</select>
		</div>
	</div>

	
    <div id="section_holder">
	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section');?></label>
			<select class="form-control selectboxit" name="section_id">
                            <option value=""><?php echo get_phrase('select_class_first') ?></option>
                            <?php
                            if(!empty($classes)){
                              	$sections = $this->db->get_where('section' , array('class_id' => $class_id))->result_array();
                              	$section_id = isset($_POST['section_id'])?$_POST['section_id']:'';
                              	foreach($sections as $row2): ?>
                                 <option value="<?php echo $row2['section_id'];?>" <?= $section_id == $row2['section_id']?'selected':'' ?>><?php echo $row2['name'];?></option>
                              <?php endforeach;
                            }  
                            ?>
				
			</select>
		</div>
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
<?php if(isset($hostel_data)) { ?>
            <div class="panel-body table-responsive">
                <table id="table-data" class="table datatable table-bordered">
                            
                            <thead>
                                <tr>
                                    <th style="width:20px">Serial_no</th>
                                 
                                    <th>Student Name</th>
                                    <th>class</th>
                                    <th  style="width:20px">Section</th>
                                                                        
                                    <th>Class Teacher</th>
                                    <th>Room Number</th>
                                    <th>Bed Number</th>
                                    <th>Type</th>
                                     <th>Total Seat</th>
                                 
                                    <th>Room Typee</th>
                                    <th>Hostel Number</th>
                                    <th>Guardian Number</th>
                                    <th>Contact</th>
        
                                </tr>
                            </thead>
                            <tbody>   
                                <?php
                                 
                      foreach ($hostel_data as $val){
                                 ?>
                                                                     
                                    <tr>
                                        <td  style="width:20px"><?php echo $val['id']; ?></td>
                                      
                                        <td><?php echo $val['name']; ?></td>
        
        
                                        <td><?php
                                        
                                                $class_name = $this->db->get_where('class', array('class_id' => $val['class_id']))->result_array();
        //if(isset($class_name) && )
        $section = $this->db->get_where('section', array('class_id' => $val['class_id']))->result_array();
        $teacher = $this->db->get_where('teacher', array('teacher_id' => $section[0]['teacher_id']))->result_array();
        
                                         echo $class_name[0]['name']; ?></td>                                           
                                        <td  style="width:20px"><?php echo  $section[0]['name']; ?> </td>
                                     <td><?php echo $teacher[0]['name']; ?> </td>
                                      
                                       <td><?php 
                                        echo $val['room_no']; ?> </td>  
                                        <td><?= $val['beds']?></td>
                                        <td><?php 
                                                   echo $val['type']; ?> </td>                                           
                                        <td><?php echo $val['total_seat']; ?> </td>
                                        <td><?php 
                                         
                                                                       echo $val['room_type']; ?> </td>
                                      
                                        <td><?php echo $val['hostel_name']; ?> </td>
        
                                                                        
        
                                       <td><?php  echo $val['phone']; ?> </td>
        
                                       <td><?php  echo $val['email']; ?> </td>
                                                                                  
                                    </tr>
                               <?php } ?>
                            </tbody>
                        </table>
                </div>
<?php } ?>
            </div>
    </div>
</div>

<script>
    function select_section(class_id) {
    	if(class_id !== ''){
    		$.ajax({
    			url: '<?php echo site_url('admin/get_section/'); ?>' + class_id,
    			success:function (response)
    			{
    
    			jQuery('#section_holder').html(response);
    			}
    		});
    	}
    }
</script>
