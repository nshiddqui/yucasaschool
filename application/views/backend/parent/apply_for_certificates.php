<?php $activeTab = "certification"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Extra Curricular</a></li>
        <li class="active">Apply For Certificates</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/parent/extra_curricular_nav_tab.php'; ?>
<!-- Including Navigation Tab -->
</div>
<br/>
	<div class="col-md-12">
		<?php echo form_open(site_url('parents/apply_certificates/') , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('student name');?></label>

						<div class="col-sm-5">
						<select name="student_id" class="form-control select2" required>
                              <option value=""><?php echo get_phrase('select');?></option>
                                  <?php
                $children_of_parent = $this->db->get_where('student' , array(
                    'parent_id' => $this->session->userdata('parent_id')
                ))->result_array();

                foreach ($children_of_parent as $row):
            ?>
                            		<option value="<?php echo $row['student_id'];?>">
										<?php echo $row['name'];?>
                                    </option>
                                 <?php endforeach;?>
                          </select>
								
						
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('certificate_type');?></label>

						<div class="col-sm-5">
							<select name="certificate_type" class="form-control selectboxit">
                              <option value="">    <?php echo get_phrase('select');?></option>
                            <?php
                $children_of_parent = $this->db->get_where('certificates' , array(
                    'status' =>1
                ))->result_array();

                foreach ($children_of_parent as $row):
            ?>  <option value="<?php echo $row['id'];?>">
										<?php echo $row['name'];?>
                                    </option>
                                 <?php endforeach;?>
                          </select>
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>

						<div class="col-sm-5">
						<textarea  class="form-control" name="description"> </textarea>
						</div>
					</div>
					
					
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('apply_now');?></button>
						</div>
					</div>
                <?php echo form_close();?>
</div>