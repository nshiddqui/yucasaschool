<?php $activeTab = "subjects"; ?>
<style>
.btn-xs {
    width: 85px;
}
</style>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Syllabus</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
</div>


	<!--	<ul class="nav tabs-vertical">
			<?php
				$classes = $this->db->get('class')->result_array();
				foreach ($classes as $row):
			?>
				<li class="<?php if ($row['class_id'] == $class_id) echo 'active';?>">
					<a href="<?php echo site_url('admin/academic_syllabus/' . $row['class_id']);?>">
						<i class="entypo-dot"></i>
						<?php echo get_phrase('class');?> <?php echo $row['name'];?>
					</a>
				</li>
			<?php endforeach;?>
			</ul>-->
 
<div class="container student_select_filter">
    <div class="row">
        <div class="col-sm-4 mt-2 ">
            <div class="form-group">
                <label>Select class : </label>
                <select class="select2 student_select">
                    <option value="">Select class</option>
                   	<?php
				$classes = $this->db->get('class')->result_array();
				foreach ($classes as $row):
			?>
                  foreach ($children_of_parent as $row):
                   ?>
                              <option value="<?php echo $row['class_id'];?>" <?php if ($row['class_id'] == $class_id) echo 'selected';?>><?php echo $row['name'];?></option>
                        <?php endforeach;?>  
                   
                   
                </select>
            </div>
        </div>
    </div>
    
</div>

<a href="javascript:;" onclick="showAjaxModal('<?php echo site_url('modal/popup/academic_syllabus_add');?>');"
	class="btn btn-primary pull-right">
    	<i class="entypo-plus-circled"></i>
			<?php echo get_phrase('add_academic_syllabus');?>
</a>
<br><br><br>

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
                        <th><?php echo get_phrase('subject');?></th>
                        <th><?php echo get_phrase('uploader');?></th>
                        <th><?php echo get_phrase('date');?></th>
                        <th><?php echo get_phrase('file');?></th>
                        <th>Action</th>

                  </tr>
              </thead>

              <tbody>
                 
                   	<?php
                     $count    = 1;
                     $syllabus = $this->db->get_where('academic_syllabus' , array('class_id' => $class_id , 'year' => $running_year))->result_array();
                     foreach ($syllabus as $row):
                    ?>
                    <tr>
                      <td><?php echo $count++;?></td>
                      <td><?php echo $row['title'];?></td>
                      <td><?php echo $row['description'];?></td>
                                                                    <td>
                        <?php 
                          echo $this->db->get_where('subject' , array(
                            'subject_id' => $row['subject_id']
                          ))->row()->name;
                        ?>
                      </td>
                      <td>
                        <?php 
                          echo $this->db->get_where($row['uploader_type'] , array(
                            $row['uploader_type'].'_id' => $row['uploader_id']
                          ))->row()->name;
                        ?>
                      </td>
                      <td><?php echo date("d/m/Y" , $row['timestamp']);?></td>
                      <td>
                        <?php echo substr($row['file_name'], 0, 20);?><?php if(strlen($row['file_name']) > 20) echo '...';?>
                      </td>
                      <td align="center">
                        <a class="btn btn-default btn-xs"
                          href="<?php echo site_url('teacher/download_academic_syllabus/'.$row['academic_syllabus_code']);?>">
                          <i class="entypo-download"></i> <?php echo get_phrase('download');?>
                        </a>
                      </td>
                    </tr>
                    <?php endforeach;?>
                   
                 
              </tbody>
          </table>

        </div>
    </div>
</div>

   <script>
        $('.student_select').change(function(){
            var id = $(this).val();
            var url = `<?php echo site_url();?>/admin/academic_syllabus/${id}`;
            window.location.href = url;
        });
        
    </script>