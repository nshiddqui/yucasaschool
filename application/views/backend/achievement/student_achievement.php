<?php $activeTab = "academic"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Achievement</a></li>
        <li class="active">Achievement List</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php //include base_path().'application/views/backend/navigation_tab/parent/academic_nav_tab.php'; ?>
<!-- Including Navigation Tab -->
</div>
<?php if($this->session->userdata('parent_login') == 1){ ?>
<div class="container student_select_filter">
    <div class="row">
        <div class="col-sm-4 mt-2 ">
            <div class="form-group">
                <label>Select Student : </label>
                <select class="select2 student_select" onchange="window.location.href = '<?= base_url('achievement/student_achievement/')?>'+this.value;">
                    <option value="">Select Student</option>
                     <?php
                   //$children_of_parent = $this->db->get_where('student' , array('parent_id' => $this->session->userdata('parent_id')))->result_array();
                  $parent_id= $this->session->userdata('parent_id');
                   $children_of_parent= $this->db->query("SELECT * FROM student LEFT JOIN enroll ON student.student_id=enroll.student_id where student.parent_id=$parent_id")->result_array();
                    ;
                  foreach ($children_of_parent as $row):
                   ?>
                              <option value="<?php echo $row['student_id'];?>"><?php echo $row['name'];?></option>
                        <?php endforeach;?>  
                   
                   
                </select>
            </div>
        </div>
    </div>
    
</div>
<?php  } ?>


<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-file-word-o"></i><small> <?php echo $this->lang->line('manage_achievement'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
           
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in active" id="tab_assignment_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th><?php echo $this->lang->line('title'); ?></th>
                                        <th><?php echo $this->lang->line('description'); ?></th>
                                        <th><?php echo $this->lang->line('teacher'); ?></th>
                                        <th><?php echo $this->lang->line('date'); ?></th>   
                                                                                
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($achievements) && !empty($achievements)){ ?>
                                        <?php foreach($achievements as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $obj->title; ?></td>
                                            <td><?php echo $obj->description; ?></td>
                                            <td><?php echo $obj->teacher_name; ?></td>
                                            <td><?php echo $obj->date; ?></td>
                                         
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>