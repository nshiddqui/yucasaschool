<?php $activeTab = "holidays"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Holiday</a></li>
        <li class="active">Holiday  List</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/extra_curricular_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>
<style>
    body .dataTables_wrapper{
        margin-top:0px;
    }
</style>
<div class="row">
    <div class="col-md-12">
    
    <div class="mt-2  row">
       <div class="col-sm-4">
            <form class="bg-white" id="add_holiday_form" style="padding:20px">
                <div class="form-group">
                    <label class="">
                        Holiday Name : 
                    </label>
                    <input name="holiday_name" type="text"  class="form-control"required/>
                </div>
                
                <div class="form-group">
                    <label class="">
                        Holiday Date : 
                    </label>
                    <input name="holiday_date" type="date"  class="form-control"required/>
                </div>
                
                <div class="form-group">
                  
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </form>
       </div>
       
       <div class="col-sm-8">
           <table class="table table-bordered datatable" style="margin-top:0px;">
               <thead>
                   <tr>
                       <th>
                           S.No
                       </th>
                       <th>
                           Holiday Name
                       </th>
                       <th>
                           Date
                       </th>
                       <th>
                           Options
                       </th>
                   </tr>
               </thead>
               
               <tbody>
                   <?php
        $count = 1;
        $this->db->order_by('date', 'desc');
        $question_papers = $this->db->get_where('holiday_leave', array('status' =>1))->result_array();
        foreach ($question_papers as $row) { ?>   
                   <tr>
                       <td><?php echo $count ?></td>
                       <td><?php echo $row['title']?></td>
                       <td><?php echo $row['date']?></td>
                       <td><!--<a class="btn btn-default edit-holiday">Edit</a>--> <a href="https://www.edurama.in/unityerp/index.php/admin/delete_holiday/<?php echo $row['id']?>" class="btn btn-default delete-holiday">Delete</a></td>
                   </tr>
                   
                   <?php $count++; } ?>
               </tbody>
           </table>
       </div>
    </div>
      
    </div>
</div>


<script>
    
    
    $("#add_holiday_form").submit(function(e) {
        e.preventDefault();
    
        var form = $(this);
        var data =  $("#add_holiday_form").serialize();
        console.log(data);
        $.ajax({
               type: "POST",
               url: "<?php echo site_url('admin/add_holiday/'); ?>",
               data: data,
               success: function(data)
               {
                  if(parseInt(data) == 1){
                     toastr.success('Data Updated successfully.')
                  }
                   $('#add_holiday_form')[0].reset();
               }
             });
    
         // avoid to execute the actual submit of the form.
    });
</script>