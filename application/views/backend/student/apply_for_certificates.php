<?php $activeTab = "certification"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Apply For Certification</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/student/extra_curricular_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<style>
    body.style-light form.form-horizontal{
        background: #fff !important;
        padding: 3%;
        margin-top: 15px;
    }
</style>
	<div class="col-md-12">
		<?php echo form_open(site_url('student/apply_for_certificates/create/') , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('certificate_type');?></label>

						<div class="col-sm-5">
							<select name="certificate_type" class="form-control selectboxit" required>
                              <option value=""><?php echo get_phrase('select');?></option>
                                <?php
						           $certificates = $this->db->get_where('certificates' , array('status' =>1))->result_array();
								   foreach ($certificates as $row): ?>  
								   	<option value="<?php echo $row['id'];?>">
										<?php echo $row['name'];?>
                                    </option>
                                <?php endforeach;?>
                          </select>
						</div>
					</div>
			        <div class="form-group">
                      <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="description" required />
                        </div>
                    </div>

                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('apply_now');?></button>
						</div>
					</div>
					</div>
					</div>
                <?php echo form_close();?>