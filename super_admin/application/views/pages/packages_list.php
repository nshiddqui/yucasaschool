<div class="content-wrapper">
    <div class="row">

    <?php foreach($package_list as $package){ ?>
        <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                <div class="float-left">
                    <i class="mdi mdi-cube text-danger icon-lg"></i>
                </div>
                <div class="float-right">
                    <p class="mb-0 text-right"><?php echo $package['package_title'];?></p>
                    <div class="fluid-container">
                    <h4 class="font-weight-medium text-right mb-0"><?php echo $package['package_name'];?></h4>
                    <p class="text-right mt-2">Rs. <?php echo $package['package_price'];?>/month</p>
                    </div>
                </div>
                </div>
                <hr>
                <div class="feature__list__wrapper mt-2">
                    <ul class="feature__list">
                        <li>Student and Admission Management</li>
                        <li>Fee Management</li>
                        <li>Payroll Management and many others</li>
                        <li>Fee Management</li>
                        <li>Payroll Management and many others</li>
                    </ul>
                </div>
                <div class="text-right">
                    <a href="<?php echo base_url();?>home/package_infomation/<?php echo $package['id'];?>" class="btn btn-danger">View Information</a>
                </div>
                
            </div>
            </div>
        </div>
    <?php } ?>
        

        
        
    </div>
</div>