<div class="content-wrapper">
<form action="" id="post_form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <div class="col-12 text-right p0">
        <a href="" class="btn btn-danger mt-2 mb-2">Cancel</a>
    </div>
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6>Add New Post</h6>
                    <hr>
                
                        <div class="form-group">
                            <label for="exampleInputName1">Blog Title</label>
                            <input type="text" class="form-control" id="post_title" placeholder="Post Title" name="post_title">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputName1">Blog Content</label>
                            <textarea name="post_content" id="editor">
                               
                            </textarea>
                        </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 grid-margin ">
            <div class="card">
                <div class="card-body">
                    <div class="post__options">
                        <h6>Post Options</h6>
                        <hr>
                        <a href="" class="btn btn-success mr-2 save__post" id='publish'>Publish Post</a>
                        <!-- <button type="submit" class="btn btn-success mr-2">Publish Post</button> -->
                        <a href="" class="btn btn-warning mr-2 save__post" id='draft'>Save Draft</a>
                    </div>

                    <div class="featured__image__wrapper mt-5">
                        <h6>Fetaured Image</h6>
                        <hr>
                        <div class="featured__image">
                            <img src="<?php echo base_url();?>assets/images/dummy_post_img.png" "="" alt="">
                        </div>
                        <input type="file" name="post_img" class="file-upload-default">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</div>

<script>

</script>

