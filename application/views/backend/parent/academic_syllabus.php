<?php $activeTab = "academic"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Academics</a></li>
        <li class="active">Academic Syllabus</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
</div>

<div class="container student_select_filter">
    <div class="row">
        <div class="col-sm-4 mt-2 ">
            <div class="form-group">
                <label>Select Student : </label>
                <select class="select2 student_select">
                    <option value="">Select Student</option>
                     <?php
                   //$children_of_parent = $this->db->get_where('student' , array('parent_id' => $this->session->userdata('parent_id')))->result_array();
                  $parent_id= $this->session->userdata('parent_id');
                   $children_of_parent= $this->db->query("SELECT * FROM student LEFT JOIN enroll ON student.student_id=enroll.student_id where student.parent_id=$parent_id AND year='$running_year'")->result_array();
                    ;
                  foreach ($children_of_parent as $row):
                   ?>
                              <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                        <?php endforeach;?>  
                   
                   
                </select>
            </div>
        </div>
    </div>
    
</div>


<div class="col-12">
    
  
    <table class="table table-bordered" id="table_export">
        <thead>
            <tr>
                <th>#</th>
                <th><?php echo get_phrase('title'); ?></th>
                <th><?php echo get_phrase('description'); ?></th>
                    <th><?php echo get_phrase('class');?></th>
                <th><?php echo get_phrase('subject');?></th>
                <th><?php echo get_phrase('uploader'); ?></th>
                <th><?php echo get_phrase('date'); ?></th>
                <th><?php echo get_phrase('file'); ?></th>
                <th><?php echo get_phrase('action'); ?></th>
            </tr>
        </thead>
        <tbody>

            <?php
            $count = 1;
            $class_id= $this->uri->segment(3);
           // $class_id = $this->db->get_where('enroll', array('student_id' => $student_id, 'year' => $running_year ))->row()->class_id;
            $syllabus = $this->db->get_where('academic_syllabus', array(
                        'class_id' => $class_id, 'year' => $running_year
                    ))->result_array();
               foreach ($syllabus as $row):
                ?>
                <tr>
                    <td><?php echo $count++; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                      <td>
                        <?php
                        echo $this->db->get_where('class', array(
                            'class_id' => $row['class_id']
                        ))->row()->name;
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $this->db->get_where('subject', array(
                            'subject_id' => $row['subject_id']
                        ))->row()->name;
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $this->db->get_where($row['uploader_type'], array(
                            $row['uploader_type'] . '_id' => $row['uploader_id']
                        ))->row()->name;
                        ?>
                    </td>
                    <td><?php echo date("d/m/Y", $row['timestamp']); ?></td>
                    <td>
                        <?php echo substr($row['file_name'], 0, 20); ?><?php if (strlen($row['file_name']) > 20) echo '...'; ?>
                    </td>
                    <td align="center">
                        <a class="btn btn-default btn-xs"
                           href="<?php echo site_url('parents/download_academic_syllabus/'.$row['academic_syllabus_code']); ?>">
                            <i class="entypo-download"></i> <?php echo get_phrase('download'); ?>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
    
    <script>
        $('.student_select').change(function(){
            var id = $(this).val();
            var url = `<?php echo site_url();?>/parents/academic_syllabus/${id}`;
            window.location.href = url;
        });
        
    </script>
