
 <div class="tab-pane box active " id="list">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered datatable" >
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('student_photo');?></div></th>
                    		<th><div><?php echo get_phrase('student_name');?></div></th>
                    		<th><div><?php echo get_phrase('class');?></div></th>
                    		<th><div><?php echo get_phrase('section');?></div></th>
                    		
						</tr>
					</thead>
         
                    <tbody>
                             <?php 
$edit_data=	$this->db->get_where('assign_house' , array('house_id' => $param2))->result_array();
foreach ($edit_data as $row):
?>  
                     <tr role="row" class="odd">
					 <td><img src="<?php echo $this->crud_model->get_image_url('student',$row['student_id']);?>" class="img-circle" width="30" /></td>                 
                      <td><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']  ))->row()->name;?></td>
                      <td><?php echo $this->db->get_where('class' , array('class_id' => $row['class_id']  ))->row()->name;?></td>
                      <td><?php echo $this->db->get_where('section' , array('section_id' => $row['section_id']  ))->row()->name;?></td>
                     </tr>
             <?php
endforeach;
?>	
                    </tbody>
                  
                </table>
			</div>

