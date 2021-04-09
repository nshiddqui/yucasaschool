<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin text-right">
            <a href="<?php echo base_url();?>home/add_school" class="btn btn-success btn-fw">
                <i class="mdi mdi-plus"></i>Add School
            </a>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
               
                <div class="table-responsive">
                <table class="table table-hover table-striped datatable">
                    <thead>
                    <tr>
                       
                        <th>School Name</th>
                        <th>URL</th>
                       
                        <th>Number</th>
                        <th>Email</th>
                        <th>Package</th>
                         <th>Package Install Status</th>
                          <th>DB Install Status</th>
                        <th>Option</th>
                    </tr>
                    </thead>
                    <tbody>
                     
                        <?php foreach($school_list as $row) { ?>   
                    <tr>
                        
                        <td><?php echo $row['school_name'];?></td>
                        <td><a href="https://www.<?php echo $row['school_slug'];?>.digitalflares.com/" target="_blank">Click Here</a></td>
                       
                        <td><?php echo $row['school_phone'];?></td>
                        <td><?php echo $row['school_email'];?></td>
                        <td class="pack-intermediate"><?php echo lcfirst($row['school_package']);?></td>
                        <?php $install_status= $row['install_status'];?>
                        <?php if($install_status==0){ ?>
                        <?php $school_slug= $row['school_slug'];?>
                    <td><a  href="https://www.digitalflares.com/zipfile.php?filename=<?php echo $row['school_slug'];?>" onclick="submitForm();" class="btn btn-danger mt-2 mb-2">Install Packge</a></td>
                      
                       
                        <?php } else {?>
                        
                          <td class="pack-intermediate"><span class="btn btn-success mr-2 add__School__btn5">Packge Installed</span> </td>  
                       
                        <?php  }   $db_status=$row['db_status'];?>
                        <?php if($db_status==0){?>
                        <td class="pack-intermediate"> <a href="" class="btn btn-danger mt-2 mb-2">Install Database</a></td>
                        <?php }else {?>
                         <td class="pack-intermediate"> <span class="btn btn-success mr-2 add__School__btn6">Database Installed</span></td>
                         <?php } ?>
                        <td class="blog__options">
                            <a class="post_edit" href="<?php echo base_url();?>home/edit_school/<?php echo $row['school_slug'];?>">
                                <i class="mdi mdi-pencil"></i>
                            </a>
                            <a class="post_delete" href="<?php echo base_url();?>home/delete_school_subdomain/<?php echo $row['school_slug'];?>">
                                <i class="mdi mdi-delete"></i>
                            </a>
                        </td>
                    </tr>
 
                  <?php } ?>
                    
                  
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>

    </div>
</div>


   <script>
      $(function () {

        $('form').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'https://www.digitalflares.com/zipfile.php',
            data: $('form').serialize(),
            success: function () {
              alert('form was submitted');
            }
          });

        });

      });
    </script>
