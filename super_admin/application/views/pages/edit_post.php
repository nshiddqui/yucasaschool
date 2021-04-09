<div class="content-wrapper">
    <form  id="update_post_form" enctype="multipart/form-data" method="post" accept-charset="utf-8">    
        <div class="col-12 text-right p0">
            <a href="" class="btn btn-danger mt-2 mb-2">Cancel</a>
        </div>
        
        <div class="row grid-margin">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6>Add New Post</h6>
                        <hr>
                    
                            <input hidden value="<?php echo $post_id ;?>" name="post_id">
                            <div class="form-group">
                                <label for="exampleInputName1">Blog Title</label>
                                <input type="text" class="form-control" id="post_title" placeholder="Post Title" name="post_title" value="<?php echo $post_data->title;?>">
                            </div>


                            <div class="form-group">
                                <label for="exampleInputName1">Blog Content</label>
                                <textarea name="post_content" id="editor">
                                <?php echo $post_data->content;?>
                                </textarea>
                            </div>                        
                        
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="post__options">
                            <h6>Post Options</h6>
                            <hr>
                            <a href="" class="btn btn-success mr-2 update__post" id='publish'>Save Changes</a>
                        </div>

                        <div class="publish__details mt-5">
                            <h6>Publish Details</h6>
                            <hr>
                            <div class="author_Detail">
                                <p><strong>Author </strong>: <?php echo $post_data->author;?></p> 
                            </div>

                            <div class="">
                                <?php 
                                    $timestamp = strtotime($post_data->publish_date);
                                    $date = date('d-m-Y', $timestamp);
                                    $time = date('h.i.s', $timestamp);
                                ?>
                                <span>Date : <?php echo $date;?></span> 
                                <span>|</span>
                                <span>Time : <?php echo $time;?></span>
                            </div>
                        </div>

                        <div class="featured__image__wrapper mt-5">
                            <h6>Fetaured Image</h6>
                            <hr>
                            <div class="featured__image">
                                <img src='<?php if($post_data->img_url){echo base_url()."uploads/blog/$post_data->img_url";}?>'  alt="">
                            </div>
                            <input type="file" name="post_img" class="file-upload-default">
                        </div>

                        
                    </div>
                </div>
            </div>
            
        </div>
    </form>
</div>

