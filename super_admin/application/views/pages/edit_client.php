<div class="content-wrapper">
    <form  id="update_client_form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        <div class="col-12 text-right p0">
            <a href="" class="btn btn-danger mt-2 mb-2">Cancel</a>
        </div>
        <div class="row">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6>Update Client</h6>
                        <hr>
                    
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputName1">School Name</label>
                                <input type="text" class="form-control" id="school_name" name="school_name" placeholder="School Name" value="<?php echo $client_data->school_name;?>">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail3">Client Name</label>
                                <input type="text" class="form-control" id="client_name" name="client_name" placeholder="Client Name" value="<?php echo $client_data->client_name;?>">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputName1">Blog Content</label>
                                <textarea name="client_testimonial" id="editor">
                                    <?php echo $client_data->client_testimonial;?>
                                </textarea>
                            </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="post__options">
                            <h6>Save Options</h6>
                            <hr>
                            <a href="" class="btn btn-success mr-2 update_client" client_id="<?php echo $client_data->id;?>">Update Client</a>
                            <!-- <a href="" class="btn btn-warning mr-2">Save Draft</a> -->
                        </div>

                        <div class="featured__image__wrapper mt-5">
                            <h6>School Logo</h6>
                            <hr>
                            <div class="featured__image">
                                <!-- <img src="<?php echo base_url();?>assets/images/dummy_post_img.png"" alt=""> -->

                                <img src='<?php if($client_data->img_url){echo base_url()."uploads/clients/$client_data->img_url";}?>'  alt="">
                            </div>
                            <input type="file" name="client_img" class="file-upload-default">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


