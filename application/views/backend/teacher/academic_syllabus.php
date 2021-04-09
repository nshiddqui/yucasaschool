<?php $activeTab = "academic_dashboard"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Academic Syllabus</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/teacher/academic_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>
<br>
<a href="javascript:;" onclick="showAjaxModal('<?php echo site_url('modal/popup/academic_syllabus_add/');?>');" 
	class="btn btn-primary pull-right">
    	<i class="entypo-plus-circled"></i>
			<?php echo get_phrase('add_academic_syllabus');?>
</a>
<div style="clear:both;"></div>
<br>

<div class="col-md-12 p0">
    <div class="panel panel-primary" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="entypo-plus-circled"></i>
                Academic Syllabus List                   
            </div>
        </div>
        <div class="panel-body">
           <table class="table datatable table-stripped">
              <thead>
                  <tr>
                        <th><?php echo get_phrase('S_no.');?></th>
                  	    <th><?php echo get_phrase('title');?></th>
                        <th><?php echo get_phrase('description');?></th>
                           <th><?php echo get_phrase('class');?></th>
                        <th><?php echo get_phrase('subject');?></th>
                        <th><?php echo get_phrase('uploader');?></th>
                        <th><?php echo get_phrase('date');?></th>
                     
                        <th>Action</th>
                        <th>Modules</th>

                  </tr>
              </thead>

              <tbody>
                 
                   	<?php
                     $count    = 1;
                     $syllabus = $this->db->get_where('academic_syllabus' , array('uploader_type' =>'teacher' , 'uploader_id'=>$this->session->userdata('login_user_id'),'year' => $running_year))->result_array();
                     foreach ($syllabus as $row):
                    ?>
                    <tr>
                      <td><?php echo $count++;?></td>
                      <td><?php echo $row['title'];?></td>
                      <td><?php echo $row['description'];?></td>
                                             <td>
                        <?php echo $this->db->get_where('class', array('class_id' => $row['class_id']))->row()->name;  ?>
                      </td>
                       <td>
                        <?php echo $this->db->get_where('subject', array('subject_id' => $row['subject_id']))->row()->name;  ?>
                      </td>
                      
                      
                      <td>
                        <?php 
                          echo $this->db->get_where($row['uploader_type'] , array(
                            $row['uploader_type'].'_id' => $row['uploader_id']
                          ))->row()->name;
                        ?>
                      </td>
                      <td><?php echo date("d/m/Y" , $row['timestamp']);?></td>
                      <!--<td>
                        <?php echo substr($row['file_name'], 0, 20);?><?php if(strlen($row['file_name']) > 20) echo '...';?>
                      </td>-->
                      <td align="center">
                        <a class="btn btn-default btn-xs"
                          href="<?php echo site_url('teacher/download_academic_syllabus/'.$row['academic_syllabus_code']);?>">
                          <i class="entypo-download"></i> <?php echo get_phrase('download');?>
                        </a>
                      </td>
                      <td><a href="<?php echo site_url('teacher/syllabus_module_info/'.$row['academic_syllabus_id']);?>" class="btn btn-info">Edit Modules</a></td>
                    </tr>
                    <?php endforeach;?>
                   
                 
              </tbody>
          </table>

        </div>
    </div>
</div>
