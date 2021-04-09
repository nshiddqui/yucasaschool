<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin text-right">
            <a href="<?php echo base_url();?>home/add_admin/create" class="btn btn-success btn-fw">
                <i class="mdi mdi-plus"></i>Add New Admin
            </a>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">

            <!-- Post Types -->
            <div class="card-body">
                <div class="col-md-4 p0">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Admin Status</label>
                        <div class="col-sm-8">
                        <select class="form-control">
                            <option>All</option>
                            <option>Active</option>
                            <option>in Active</option>
                        </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                <table class="table table-hover table-striped blog__post__list datatable">
                    <thead>
                    <tr>
                        <!-- <th>ID</th> -->
                        <th>Name</th>
                        <th>Email Id</th>
                        <th>Phone Number</th>
                      
                        <th>Role</th>
                        <th>Status</th>
                        <th>Option</th>
                    </tr>
                    </thead>

                    <!-- BODY -->
                    <tbody>
                     <?php foreach($admin_data as $row) { ?>
                    <tr>
                        
                        <td><?php echo $row['user_name'];?></td>
                        <td><?php echo $row['user_email'];?></td>
                        <td><?php echo $row['user_phone'];?></td>
                        <td><?php $userrole= $row['user_role'];
						if ($userrole==1){ echo 'Super Admin';}else{
							echo 'Sub Admin';
						}
						?></td>
                       
                        <td>
                            <select class="form-control post__status__select " name="user_status"  >
							<?php $user_status=$row['user_status']; ?>
					           <option value="1" <?php if($user_status ==1){ echo 'Selected'; } ?> >Active</option>
                               <option value="2" <?php if($user_status ==2){ echo 'Selected'; } ?>>In Active</option>
                            </select>
                        </td>
                      
                        
                        <td class="blog__options">
                            <a class="post_edit" href="<?php echo base_url();?>home/edit_admin/<?php echo $row['user_id'];?>" >
                                <i class="mdi mdi-pencil"></i>
                            </a>
                            <a class="post_delete" href="#" post_id="<?php echo $row['user_id'];?>">
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