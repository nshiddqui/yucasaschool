<div class="content-wrapper">
    <form  id="home_video_form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6>Home Page Video</h6>
                        <hr>

                        <div class="video__placeholer">
                            <video class="visible-desktop video__holder" poster="assets/home/<?php echo $home_video_data->backdrop_image;?>" autoplay="" loop="" muted="true">
                                <source type="video/mp4" src="<?php echo base_url();?>assets/home/<?php echo $home_video_data->home_video;?>">
                            </video>
                        </div>
                        
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="home__video">Choose Home Page Video</label>
                                <input type="file" class="form-control" id="home__video" name="home__video" class="">
                            </div>

                            <div class="form-group">
                                <label for="home__video__backdrop">Choose Home Page Video Backdrop Image</label>
                                <input type="file" class="form-control" id="home__video__backdrop"  name="home__video__backdrop" class="">
                            </div>   

                            <a href="" class="btn btn-success mr-2 save_home_video">Save</a>                 
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


