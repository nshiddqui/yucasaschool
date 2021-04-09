<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin text-right">
            <a href="<?php echo base_url();?>home/add_post" class="btn btn-success btn-fw">
                <i class="mdi mdi-plus"></i>Add New Post
            </a>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">

            <!-- Post Types -->
            <div class="card-body">
                <div class="col-md-4 p0">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Post Status</label>
                        <div class="col-sm-8">
                        <select class="form-control">
                            <option>All</option>
                            <option>Published</option>
                            <option>Draft</option>
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
                        <th>Title</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Option</th>
                    </tr>
                    </thead>

                    <!-- BODY -->
                    <tbody>

                    <?php 
                    $index = 1;
                    foreach($posts_list as $post){?>

                    <tr>
                        <!-- <td><?php echo $index;?></td> -->
                        <td><?php echo $post['title'];?></td>
                        <td>
                            <select class="form-control post__status__select" post_id="<?php echo $post['id'];?>">
                                <option <?php if($post['status'] == "publish"){echo 'selected';}?> value="publish">Published</option>
                                <option <?php if($post['status'] == "draft"){echo 'selected';}?> value="draft">Draft</option>
                            </select>
                        </td>
                        <td><?php echo $post['publish_date'];?></td>
                        
                        <td class="blog__options">
                            <a class="post_edit" href="<?php echo base_url();?>edit-post/<?php echo $post['id'];?>" >
                                <i class="mdi mdi-pencil"></i>
                            </a>
                            <a class="post_delete" href="#" post_id="<?php echo $post['id'];?>">
                                <i class="mdi mdi-delete"></i>
                            </a>
                        </td>
                    </tr>  
                    
                    <?php $index++; }?>                  
            
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>

    </div>
</div>