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
</style>

<?php //echo $ids= $_GET['class_id'];?>
<?php $activeTab = "subjects"; ?>
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

</div>

<div class="row">
<div class="col-md-3">
    <div class="form-group">
        <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class'); ?></label>
        <select name="class_id" class="form-control"  id = "class_selection">
            <option value=""><?php echo get_phrase('select_class'); ?></option>
            <?php
            $classes = $this->db->get('class')->result_array();
            foreach ($classes as $row):
                ?>
                 <option value="<?php echo $row['class_id']; ?>" <?php if($row['class_id'] == $class_id){echo 'selected';} ?>><?php echo $row['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<div class="col-md-2 top-first-btn">
  <button onclick="reload_url(); return false;" class="btn btn-info"><?php echo get_phrase('subject_information'); ?></button>
    </div>
</div>



<div class="row">
	<div class="col-md-12">

    	<!---CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
					<?php echo get_phrase('subject_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_subject');?>
                    	</a></li>

            <li>
                <a href="#assign" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('assign_subject');?>
                        </a></li>
            <?php /*<li>
                <a href="#assignlist" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('assign_subject_list');?>
                        </a></li>
						
			<li>
            	<a href="#Competencieslist" data-toggle="tab"><i class="entypo-menu"></i>
					<?php echo get_phrase('competencies_list');?>
                    	</a></li>
			<li>
            	<a href="#Competenciesadd" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_competencies');?>
                    	</a></li>
                    	
                    		<li>
            	<a href="#practiallist" data-toggle="tab"><i class="entypo-menu"></i>
					<?php echo get_phrase('practial_list');?>
                    	</a></li>
			<li>
            	<a href="#addpractial" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_practial');?>
                    	</a></li>
                    	*/ ?>
		</ul>
    	<!---CONTROL TABS END------>
		<div class="tab-content">
        <br>
            <!---TABLE LISTING STARTS-->
			<?php if($class_id){ ?>
            <div class="tab-pane box active" id="list">

                <table class="table table-bordered datatable" >
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('class');?></div></th>
                    		<th><div><?php echo get_phrase('subject_name');?></div></th>
                 
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;$class_id_arr = "";
						foreach($subjects as $row):

                             $class_id_arr = explode(',',$row['class_id']);
                        if(in_array($class_id, $class_id_arr)){     
                            ?>
                        <tr>
						    <td> 
							<?php	  
                                //$class_id_arr =  $this->db->get_where('subject',array('teacher_id'=>$row['teacher_id']))->result();
                               
                                //$arr=json_decode($class_id)
                                echo '<ul class="" style="padding:0px;">';
                                foreach($class_id_arr as $array_values){

                                    //echo  "Class : -"." &nbsp". $this->crud_model->get_type_name_by_id('class',$array_values). "<br>";

                                   echo  '<li class="button_design" title="Nursery" style="list-style: none;">'.$this->crud_model->get_type_name_by_id('class',$array_values).'</li>
                                   ';
                                }
                                echo '</ul>';
                            ?>
                            <?php //echo $this->crud_model->get_type_name_by_id('class',$class_id);?></td>
							<td><?php echo $row['name'];?></td>
					
							<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_edit_subject/'.$row['subject_id']);?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit_subject');?>
                                            </a>
                                    </li>
                                    <li class="divider"></li>

                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo site_url('admin/subject/delete/'.$row['subject_id'].'/'.$class_id);?>');">
                                            <i class="entypo-trash"></i>
                                                <?php echo get_phrase('delete');?>
                                            </a>
                                   </li>
                                </ul>
                            </div>
        					</td>
                        </tr>
                        <?php } endforeach;  ?>
                    </tbody>
                </table>
			</div>
			<?php } else { ?>
			
			
			
			
			
			     <div class="tab-pane box active" id="list">

                <table class="table table-bordered" id="datatabless" >
                	<thead>
                		<tr>
                		    
                    		<th><div><?php echo get_phrase('class');?></div></th>
                    		<th><div><?php echo get_phrase('subject_name');?></div></th>
                    
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;$class_id_arr = "";
					
						foreach($class_subject as $row):
    
                            ?>
                        <tr>
						    <td> 
							<?php echo $row['name'];
							$class_id= $row['class_id'];
							?>
							</td>
                        
                            
                            
							<td>
							    <?php
							    $this->db->select('*');
							    $this->db->from('subject');
                               $this->db->where('class_id', $class_id);
                               $result = $this->db->get()->result_array(); ?>
                               <?php 	foreach($result as $row2) { ?>
							  <li class="button_design" title="<?php echo $row['name']; ?>" style="list-style: none;"><a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_edit_subject/'.$row2['subject_id']);?>');"><?php echo $row2['name'];?></a></li>
							    <?php } ?>
							    </td>
					
                        </tr>
                        <?php  endforeach;  ?>
                    </tbody>
                </table>
			</div>
			
			
			
			<?php } ?>
			

			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="assign" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(site_url('admin/subject/assign') , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('select_class');?></label>
                                <div class="col-sm-5">
                                    <select name="class_id" class="form-control" onchange="return get_class_sections(this.value)" required>
                        				<option value=""><?php echo get_phrase('select_class');?></option>
                        				<?php
                        					$classes = $this->db->get('class')->result_array();
                        					foreach($classes as $row):
                        				?>
                        				<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                        				<?php endforeach;?>
                    			    </select>
                                </div>
                            </div>
                        </div>
                        <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('select_section');?></label>
                                <div class="col-sm-5">
                                    <select name="section_id" id="section_selector_holder" class="form-control" onchange="return get_subject_by_section(this.value);" required>
                        				<option value=""><?php echo get_phrase('select_section');?></option>
                    			    </select>
                                </div>
                            </div>

                        </div>
                        <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('select_subject');?></label>
                                <div class="col-sm-5">
                                    <select name="subject_id" id="subject_by_section" class="form-control" required>
                        				<option value=""><?php echo get_phrase('select_subject');?></option>
                    			    </select>
                                </div>
                            </div>

                        </div>
                        
                        <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('teacher');?></label>
                                <div class="col-sm-5">
                                    <select name="teacher_id"  class="selectpicker " style="width:100%;hight:50px;" required>
                                     <option value="" disabled><?php echo get_phrase('select_class'); ?></option>
                                    <?php
                                        $teacher = $this->db->get('teacher')->result_array();
                                        foreach($teacher as $row):
                                        ?>
                                            <option value="<?php echo $row['teacher_id'];?>"
                                                <?php //if($row['subject_id'] == $subject_id) echo 'selected';?>>
                                                <?php echo $row['name'];?>
                                            </option>
                                    <?php
                                    endforeach;
                                    ?>
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('assign_subject');?></button>
                              </div>
						   </div>
                    </form>
                </div>
			</div>
			<!----CREATION FORM ENDS-->

            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open(site_url('admin/subject/create') , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        <div class="padded">
                            <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>

                        </div>
                            <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('select_class');?></label>
                                <div class="col-sm-5">
                                    <select name="class_id" class="form-control" onchange="return get_class_sections(this.value,'add_')">
                        				<option value=""><?php echo get_phrase('select_class');?></option>
                        				<?php
                        					$classes = $this->db->get('class')->result_array();
                        					foreach($classes as $row):
                        				?>
                        				<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                        				<?php endforeach;?>
                    			    </select>
                                </div>
                            </div>
                        </div>
                        <div class="padded">
                            <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('select_section');?></label>
                                <div class="col-sm-5">
                                    <select name="class_id" id="add_section_selector_holder" class="form-control">
                        				<option value=""><?php echo get_phrase('select_section');?></option>
                    			    </select>
                                </div>
                            </div>

                        </div>

                           <?php /* <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                                <div class="col-sm-5">
                                    <select name="class_id[]"  class="selectpicker" id="selectpickerClass" multiple="multiple" data-live-search="true" style="width:100%;hight:50px;" required >
                                     <option class=
                                        "non_selectable_option" value="" disabled><?php echo get_phrase('select_class'); ?></option>
                                        <?php
                                        $classes = $this->db->get('class')->result_array();
                                        foreach($classes as $row):
                                        ?>
                                            <option class="selectable_option" value="<?php echo $row['class_id'];?>"
                                                <?php if($row['class_id'] == $class_id) echo 'selected';?>>
                                                    <?php echo $row['name'];?>
                                            </option>
                                        <?php
                                        endforeach;
                                        ?>
                                        <option value="select_all" class=
                                        "non_selectable_option"><?php echo get_phrase('select_all'); ?></option>
                                    </select>
                                </div>
                            </div> */ ?>

                        </div>
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_subject');?></button>
                              </div>
                           </div>
                    </form>
                </div>
            </div>
            </div>
            <!----CREATION FORM ENDS-->
<?php /*
             <!---TABLE LISTING STARTS-->
            <div class="tab-pane box " id="assignlist">

                <table class="table table-bordered datatable" >
                    <thead>
                        <tr>
                           
                            <th><div><?php echo get_phrase('subject_name');?></div></th>
                            <th><div><?php echo get_phrase('teacher');?></div></th>
                            <!--<th><div><?php echo get_phrase('section');?></div></th>-->
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1;$class_id_arr = "";
                          //$subject=  $this->db->query("select * from subject where subject_id='$array_values->subject_id'")->result()->class_id;
                        foreach($teacher_val as $row):?>
                        <tr>
                            <td> 
                            <?php     
                                //$class_id_arr =  $this->db->get_where('assign_subject',array('teacher_id'=>$row['teacher_id']))->result();
                             
							   $this->db->select('*');
							   $this->db->from('assign_subject');
                               $this->db->where('assign_subject.teacher_id', $row['teacher_id']);
                               $this->db->join('subject','subject.subject_id=assign_subject.subject_id','left');
                               $class_id_arr = $this->db->get()->result();
                                
                               // print_r($class_id_arr);
                                //$class_id_arr = explode(',',$row['class_id']);
                                //$arr=json_decode($class_id)
                                echo '<ul class="" style="padding:0px;">';
                                foreach($class_id_arr as $array_values){
                                 $subject_id=$array_values->subject_id;
                                   $class_id=$array_values->class_id;
                                 
                                
                                   echo  '<li class="button_design"  style="list-style: none;">'.$this->crud_model->get_type_name_by_id('class',$class_id).'-'.$this->crud_model->get_type_name_by_id('subject',$array_values->subject_id).'</li>
                                   ';
                                }
                                echo '</ul>';
                            ?>
                           </td>
                            <td><?php
                                // $teacher_id_arr =  $this->db->get_where('assign_subject',array('subject_id'=>$row['subject_id']))->result();
                                // $teacher_values = "";
                                   echo '<ul class="" style="padding:0px;">';
                                  // foreach($teacher_id_arr as $teacher_values){
                                   echo  '<li class="button_design" style="list-style: none;">'. @$this->crud_model->get_type_name_by_id('teacher',$row['teacher_id']).'</li>
                                   ';
                                // } 
                                 echo '</ul>';
                                 ?>
                                </td>
                            <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                   <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_edit_assign_subject/'.$row['assign_id']);?>');">
                                          <i class="entypo-pencil"></i><?php echo get_phrase('edit_assign_subject');?>
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo site_url('admin/subject/delete_assign/'.$row['teacher_id'].'/'.$class_id);?>');">
                                            <i class="entypo-trash"></i><?php echo get_phrase('delete');?>
                                        </a>
                                   </li>
                                </ul>
                            </div>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>

			
			
			   <div class="tab-pane box" id="Competencieslist">

                <table class="table table-bordered datatable" >
                	<thead>
                		<tr>
                		     <th><div><?php echo get_phrase('competencies');?>/<?php echo get_phrase('Weightage');?> List</div></th>
                    	       	<th><div><?php echo get_phrase('subject_name');?></div></th>
                    	       	<th><div><?php echo get_phrase('marks');?></div></th>
                    		 	<th><div><?php echo get_phrase('class');?></div></th>
                 
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;$class_id_arr = "";
						foreach($subject_competencies as $row) { 

                            ?>
                        <tr>
						    <td><?php echo $row['name'];?></td>
							<td><?php echo $row['subject_name'];?></td>
							<td><?php echo $row['marks'];?></td>
					    	<td><?php echo $row['class_name'];?></td>
							<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_edit_competencies/'.$row['id']);?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit_competencies');?>
                                            </a>
                                    </li>
                                    <li class="divider"></li>

                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo site_url('admin/subject/delete/'.$row['subject_id'].'/'.$class_id);?>');">
                                            <i class="entypo-trash"></i>
                                                <?php echo get_phrase('delete');?>
                                            </a>
                                   </li>
                                </ul>
                            </div>
        					</td>
                        </tr>
                        <?php }   ?>
                    </tbody>
                </table>
			</div>
			
			
            <div class="tab-pane box" id="Competenciesadd" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open(site_url('admin/subject/competencie') , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        <div class="padded">
                            <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase(' Competencies');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>

                        </div>
                               <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase(' Competencies_marks');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="mark" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>

                        </div>
                        
                         <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('final_weightage');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="weightage" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>

                        </div>
                        
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('subject');?></label>
                                <div class="col-sm-5">
                                    
								    <select name="subject_id[]"  class="selectpicker" id="selectpickerSubject" multiple="multiple" data-live-search="true" style="width:100%;hight:50px;" required >
                                     <option class="not_selectable_option" value="" disabled=""><?php echo get_phrase('select_subject'); ?></option>

                                        <?php
                                        $subject_result = $this->db->get_where('subject')->result_array();
                                       // print_r($subject_result);
                                        if(sizeof($subject_result) > 0){
                                         foreach($subject_result as $row):
                                      
                                        ?>
                                            <option value="<?php echo $row['subject_id'];?>" class="selectable_option">
                                                <?php echo $row['name'];

                                                $class_array = $row['class_id'];
                                                ?>  
                                                <?php 
                                                  $multiple_class  = $this->db->query("select * from class where class_id IN ($class_array) order by class_id ASC")->result();
                                            if(sizeof($multiple_class) > 0){
                                                foreach ($multiple_class as $key => $dt) {
                                                    echo  '( '.$dt->name_numeric.' )';
                                                }
                                            }
                                        ?>
                                            </option>
                                            
                                        <?php
                                        endforeach;
                                        //echo '<option value="select_all" class="not_selectable_option">'. get_phrase('select_all').'</option>';
                                    }else{ ?>
                                            <option value="" ><?php echo get_phrase('Data_not_found !'); ?></option>
                                  <?php }  ?>
                                  
                                  <option value="select_all" class="not_selectable_option" value="select_all">Select All</option>

                                       
                                    </select>
									
									
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_subject');?></button>
                              </div>
                           </div>
                    </form>
                </div>
            </div>
			
			
			
			
			
				
			
			   <div class="tab-pane box" id="practiallist">

                <table class="table table-bordered datatable" >
                	<thead>
                		<tr>
                		     <th><div><?php echo get_phrase('practial_name');?></div></th>
                    	       	<th><div><?php echo get_phrase('subject_name');?></div></th>
                    	       		<th><div><?php echo get_phrase('marks');?></div></th>
                    		 	<th><div><?php echo get_phrase('class');?></div></th>
                 
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;$class_id_arr = "";
						foreach($subject_practiallist as $row) { 

                            ?>
                        <tr>
						    <td><?php echo $row['name'];?></td>
							<td><?php echo $row['subject_name'];?></td>
								<td><?php echo $row['marks'];?></td>
					    	<td><?php echo $row['class_name'];?></td>
							<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_edit_competencies/'.$row['id']);?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit_competencies');?>
                                            </a>
                                    </li>
                                    <li class="divider"></li>

                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo site_url('admin/subject/delete/'.$row['subject_id'].'/'.$class_id);?>');">
                                            <i class="entypo-trash"></i>
                                                <?php echo get_phrase('delete');?>
                                            </a>
                                   </li>
                                </ul>
                            </div>
        					</td>
                        </tr>
                        <?php }   ?>
                    </tbody>
                </table>
			</div>
			
			
            <div class="tab-pane box" id="addpractial" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open(site_url('admin/subject/addpractial') , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        <div class="padded">
                            <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('practial');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>

                        </div>
                               <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('practial_marks');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="mark" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>

                        </div>
                        
                         <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('final_weightage');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="weightage" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>

                        </div>
                        
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('subject');?></label>
                                <div class="col-sm-5">
                                    
								    <select name="subject_id[]"  class="selectpicker" id="selectpickerSubject" multiple="multiple" data-live-search="true" style="width:100%;hight:50px;" required >
                                     <option class="not_selectable_option" value="" disabled=""><?php echo get_phrase('select_subject'); ?></option>

                                        <?php
                                        $subject_result = $this->db->get_where('subject')->result_array();
                                       // print_r($subject_result);
                                        if(sizeof($subject_result) > 0){
                                         foreach($subject_result as $row):
                                      
                                        ?>
                                            <option value="<?php echo $row['subject_id'];?>" class="selectable_option">
                                                <?php echo $row['name'];

                                                $class_array = $row['class_id'];
                                                ?>  
                                                <?php 
                                                  $multiple_class  = $this->db->query("select * from class where class_id IN ($class_array) order by class_id ASC")->result();
                                            if(sizeof($multiple_class) > 0){
                                                foreach ($multiple_class as $key => $dt) {
                                                    echo  '( '.$dt->name_numeric.' )';
                                                }
                                            }
                                        ?>
                                            </option>
                                            
                                        <?php
                                        endforeach;
                                        //echo '<option value="select_all" class="not_selectable_option">'. get_phrase('select_all').'</option>';
                                    }else{ ?>
                                            <option value="" ><?php echo get_phrase('Data_not_found !'); ?></option>
                                  <?php }  ?>
                                  
                                  <option value="select_all" class="not_selectable_option" value="select_all">Select All</option>

                                       
                                    </select>
									
									
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_subject');?></button>
                              </div>
                           </div>
                    </form>
                </div>
            </div>
			
			*/ ?>
			
			
		</div>
	</div>
</div>
</div>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->
<script type="text/javascript">

    function reload_url() {
        class_selection = $('#class_selection').val();
        section_id = $('#section_id').val();
        if(class_selection != "" && section_id != ""){
          window.location.href = "<?php echo site_url();?>/admin/subject/"+class_selection;
        }
    }


    $(document).ready(function() {
        setTimeout(() => $('.selectpicker').select2(), 1000);
    });

    $(".selectpicker").change(function(){
        var selectedValues = $(this).val();
       
        if(selectedValues.indexOf('select_all') >=0){
            
            if($(this).attr('id') == "selectpickerClass"){
                $("#selectpickerClass  option.selectable_option").prop("selected","selected");
                $("#selectpickerClass  option.not_selectable_option").prop("selected"," ");
            }
            
            if($(this).attr('id') == "selectpickerSubject"){
                $("#selectpickerSubject  option.selectable_option").prop("selected","selected");
                $("#selectpickerSubject  option.not_selectable_option").prop("selected"," ");
            }
            
            
        }
    });
    

	jQuery(document).ready(function($)
	{
		var datatable = $("#table_export").dataTable();
	});


    function get_class_sections(class_id,type='') {

        $.ajax({
            url: '<?php echo site_url('admin/get_class_section/');?>' + class_id  ,
            success: function(response)
            {
              jQuery('#'+type+'section_selector_holder').html(response);
            }
        });

    }

    function get_class_by_subject(val){
        // $.ajax({       
        //    type   : "POST",
        //    url    : "<?php echo site_url('ajax/get_class_by_subject'); ?>",
        //    data   : {'subject_id' : val},               
        //    success: function(response){  
        //     alert(response);     
        //     console.log(response); 
        //     $('#subject_by_classes').html(val);                                       
        //    }
        // });

    }
    function get_subject_by_section(val){
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_subject_by_section'); ?>",
            data   : {'section_id' : val},               
            success: function(response){  
                    $('#subject_by_section').html(response);                                       
            }
        });

    }


  
$(document).ready(function() {
    $('#datatabless').dataTable({
        "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
        "iDisplayLength": 25
    });
} );

</script>
