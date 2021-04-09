<style type="text/css">
    .button_design{
      background-color:#e4e4e4;
      border:1px solid #aaa;
      border-radius:4px;
      cursor:default;
      float: left;

      margin-right: 5px;
      margin-top:5px;
      padding:0 5px; 
    }
</style><?php $activeTab = "subjects"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Subjects</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/parent/subjects_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<div class="student_select_filter">
    <div class="row">
        <div class="col-sm-4  ">
            <div class="form-group">
                <label>Select Student : </label>
                <select class="select2 student_select">
                    <option value="">Select Student</option>
                     <?php
                    $class_id= $this->uri->segment(3);
                   //$children_of_parent = $this->db->get_where('student' , array('parent_id' => $this->session->userdata('parent_id')))->result_array();
                  $parent_id= $this->session->userdata('parent_id');
                   $children_of_parent= $this->db->query("SELECT * FROM student LEFT JOIN enroll ON student.student_id=enroll.student_id where student.parent_id=$parent_id AND year='$running_year'")->result_array();
                    ;
                      foreach ($children_of_parent as $row):
                   ?>
                              <option value="<?php echo $row['class_id'];?>"<?php if($row['class_id'] == $class_id){echo 'selected';} ?>><?php echo $row['name'];?></option>
                        <?php endforeach;?>  
                   
                   
                </select>
            </div>
        </div>
    </div>
    
</div>

<div class="row">
	<div class="col-md-12">
    	<!---CONTROL TABS END-->
		<div class="tab-content">            
            <!---TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
				
                <table class="table table-bordered datatable">
                	<thead>
                		<tr>
                    	
                    		<th><div><?php echo get_phrase('subject_name');?></div></th>
                    		<th><div><?php echo get_phrase('teacher');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($subjects as $row):?>
                   
                        <tr>
						
							<td><?php echo $row['name'];?></td>
						 <td> 
                            <?php     
                                $class_id_arr =  $this->db->get_where('assign_subject',array('subject_id'=>$row['subject_id']))->result();
                             
                                echo '<ul class="" style="padding:0px;">';
                                foreach($class_id_arr as $array_values){
                                 $subject_id=$array_values->subject_id;
                                    echo  '<li class="button_design"  style="list-style: none;">'.$this->crud_model->get_type_name_by_id('teacher',$array_values->teacher_id).'</li>
                                   ';
                                }
                                echo '</ul>';
                            ?>
                           </td>
							
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!---TABLE LISTING ENDS-->
		</div>
	</div>
</div>
   <script>
        $('.student_select').change(function(){
            var id = $(this).val();
            var url = `<?php echo site_url();?>/parents/subject/${id}`;
            window.location.href = url;
        });
        
    </script>