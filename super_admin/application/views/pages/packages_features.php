<div class="content-wrapper">
    <div class="row">
        <div class="col-md-7 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6>Package Fetaure List</h6>
                    <hr>
                    <div class="form-group">
                        <div class="feature__list__wrapper mt-2">
                            <ul class="feature__list">
                            <?php foreach($feature_list as $feature) {?>
                                <li>
                                    <img class="feature__icon" src="<?php echo base_url();?>uploads/features/<?php echo $feature['feature_icon']?>" alt=""><?php echo $feature['feature_title']?> 
                                    <a href="" class="remove__feature btn btn-danger float-right" feature_id="<?php echo $feature['id']?> ">Remove</a>
                                </li>
                            <?php } ?>
                                
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-5 ">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body"> 
                        <div class="full__feature__list__wrapper ">
                            <h6>Add New Features</h6>
                            <hr>
                            <div class="add__new__feature__wrapper  mt-4">
                                <div class="add__new__feature ">
                                    <form  id="package_feature_form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                                        <div class="form-group">
                                            <label for="package_tagline">Icon</label>
                                            <input type="file" class="form-control" id="feature__icon" name="feature__icon" placeholder="Package Tagline">
                                        </div>
                                        <div class="form-group">
                                            <label for="package_tagline">Title</label>
                                            <input type="text" class="form-control" id="feature__title"  name="feature__title" placeholder="Package Tagline">
                                        </div>
                                        <a href="" class="btn btn-success add__new__feature__save">Add</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

