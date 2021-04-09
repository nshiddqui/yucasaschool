<div class="content-wrapper">
<form action="" id="save_product_data" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <div class="row">
        <div class="col-md-7 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6>Package Information</h6>
                    <hr>
                
                    
                        <div class="form-group">
                            <label for="package_name">Package Name</label>
                            <input type="text" class="form-control" id="package_name" placeholder="Package Name" value="<?php echo $package_data->package_name;?>">
                        </div>

                        <div class="form-group">
                            <label for="package_tagline">Package Tagline</label>
                            <input type="text" class="form-control" id="package_tagline" placeholder="Package Tagline" value="<?php echo $package_data->package_title;?>">
                        </div>

                        <div class="form-group">
                            <label for="package_price">Package Price</label>
                            <input type="text" class="form-control" id="package_price" placeholder="Client Name" value="<?php echo $package_data->package_price;?>">
                        </div>
                        <hr class="mt-5">
                        <h6>Package Features</h6>
                         <hr>
                        <div class="form-group">
                            <div class="feature__list__wrapper mt-2">
                                <ul class="feature__list feature__list__in__package">
                                <?php foreach($package_feature as $feature){?>
                                    <li>
                                        <img class="feature__icon" src="<?php echo base_url();?>uploads/features/<?php echo $feature->feature_icon?>" alt=""><?php echo $feature->feature_title?> 
                                        <a href="" class="remove__feature__from__package btn btn-danger float-right" feature_id="<?php echo $feature->id?>" package_id="<?php echo $package_data->id;?>">Remove</a>
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
                        <div class="post__options">
                            <h6>Save Option</h6>
                            <hr>
                            <a href="" class="btn btn-success mr-2 save__package__data" package_id="<?php echo $package_id;?>">Save Information</a>
                    
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                       
                        <div class="full__feature__list__wrapper ">
                           
                            <h6>Unity ERP features</h6>
                            <hr>
                            <ul class="feature__list feature__list__not__in__package">

                                <?php foreach($feature_list_not_in_package as $feature) {?>
                                    <li>
                                        <p><img class="feature__icon" src="<?php echo base_url();?>uploads/features/<?php echo $feature['feature_icon']?>" alt=""><?php echo $feature['feature_title']?></p>
                                      

                                        <p class="text-left">
                                            <a href="" class="add__to__package btn btn-success " feature_id="<?php echo $feature['id']?>" package_id="<?php echo $package_data->id;?>">Add To This Package</a>
                                        </p>

                                    </li>
                                <?php } ?>
                                
                            </ul>

                            <div class="add__new__feature__wrapper  mt-4">
                                <div class="add__new__feature " style="display:none;">
                                    <form action="">
                                        <div class="form-group">
                                            <label for="package_tagline">Icon</label>
                                            <input type="file" class="form-control" id="feature__icon" placeholder="Package Tagline">
                                        </div>
                                        <div class="form-group">
                                            <label for="package_tagline">Title</label>
                                            <input type="text" class="form-control" id="feature__title" placeholder="Package Tagline">
                                        </div>
                                        <a href="" class="btn btn-success add__new__feature__save">Add</a>
                                        <a href="" class="btn btn-danger add__new__feature__cancel">Cancel</a>
                                    </form>
                                </div>
                                <div class="text-right">
                                    <a href="" class="btn btn-warning add__new__feature__btn">Add New Feature</a>
                                </div>  
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
