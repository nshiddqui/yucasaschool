<?php $activeTab = "teacher_feedback"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Teachers</a></li>
        <li class="active">All Teachers</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/teacher_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>


<div class="teacher-feedback">
  
  <blockquote class="blockquote-blue">
    <p>
      <strong>Add Feedback Form For Teachers</strong>
    </p>
    <p>
      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit temporibus voluptatum ab quisquam ut consectetur ducimus. Aliquid aperiam veniam placeat excepturi possimus, quo dolores sapiente molestias, numquam magni voluptatibus enim animi commodi molestiae iste ipsum expedita odio minima distinctio voluptates. Eaque qui illum, sed perferendis! Velit temporibus laudantium nostrum labore molestiae, quisquam ad aliquam laborum molestias quia dolor perferendis necessitatibus eligendi fuga, minus quidem nesciunt mollitia fugit, sit tempore! Sunt facilis ex consectetur minus asperiores ut voluptatum est, hic natus.
    </p>
  </blockquote>

  <div class="row">
    <form action="<?php echo site_url()?>/admin/teacher_feedback_by_student/create" class="form-horizontal form-groups-bordered validate" target="_top" method="post" accept-charset="utf-8" novalidate="novalidate">
        <div class="col-md-6 ">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        <i class="entypo-plus-circled"></i>
                        <strong> Feedback Form Details </strong>                    
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-4 control-label p0">Feedback Form Title</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="exam_title" data-validate="required" data-message-required="Value Required">
                        </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-4 control-label p0">Select Teachers</label>
                      <div class="col-sm-8">
                          <select name="teacher_id[]"  class="selectpicker" multiple="multiple" data-live-search="true" style="width:100%;hight:50px;" required onchange="return get_class_sections(this.value)">
                            <?php
            $classes = $this->db->get('teacher')->result_array();
            foreach ($classes as $row):
                ?>
              <option value="<?php echo $row['teacher_id']; ?>"><?php echo $row['name']; ?></option>
            <?php endforeach; ?>
                          
                          

                          </select>
                      </div>
                    </div>

                     <div class="form-group">
                        <div class="col-sm-12" style="text-align: right;">
                            <button type="submit" class="btn btn-info">Add Form</button>
                        </div>
                    </div>
                   
                </div>
            </div>

           
        </div>
            </form>
        <div class="col-md-6">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        <i class="entypo-plus-circled"></i>
                        Feedback Form List                    
                    </div>
                </div>
                <div class="panel-body">
                   <table class="table datatable table-stripped">
                      <thead>
                          <tr>
                              <th>Id</th>
                              <th>Feedback Form Name</th>
                              <th>Responses</th>
                              <th>Status</th>
                          </tr>
                      </thead>

                      <tbody>
                           <?php
            $classes = $this->db->get('teacher_feedback')->result_array();
            foreach ($classes as $row):
                ?>
                          <tr>
                              <td>1</td>
                              <td><?php echo $row['title']; ?></td>
                              <td>142</td>
                              <?php $status= $row['status']; 
                              if($status==1){?>
                              <td class='due'>Active</td>
                              <?php } else { ?>
                               <td class='due'>Deactive</td>
                               <?php } ?>
                          </tr>
                             <?php endforeach; ?>
                      </tbody>
                  </table>
    
                </div>
            </div>
        </div>
        

</div>

</div>



<script>
  $(document).ready(function() {
        setTimeout(() => $('.selectpicker').select2(), 1000);
    });

</script>