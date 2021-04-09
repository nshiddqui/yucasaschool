<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin text-right">
            <a href="<?php echo base_url();?>home/add_client" class="btn btn-success btn-fw">
                <i class="mdi mdi-plus"></i>Add New Client
            </a>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">

            <!-- Post Types -->
            <div class="card-body">
                <div class="col-md-4">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Client Status</label>
                        <div class="col-sm-8">
                        <select class="form-control">
                            <option>Active</option>
                            <option>In Active</option>
                        </select>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                <table class="table table-hover table-striped client__list datatable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>School Name</th>
                        <th>Author</th>
                        <th>Logo</th>
                        <th>Status</th>
                        <th>Option</th>
                    </tr>
                    </thead>

                    <!-- BODY -->
                    <tbody>
                    <?php $i = 1; foreach($client_list as $client){?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $client['school_name'];?></td>
                        <td><?php echo $client['client_name'];?></td>
                        <td class="client__logo"><img src="<?php echo base_url();?>uploads/clients/<?php echo $client['img_url'];?>" alt=""></td>
                        <td>
                            <select class="form-control client__status__select" client_id="<?php echo $client['id'];?>" unid="unid<?php echo $client['id'];?>" >
                                <option <?php if($client['status'] == 1){echo "selected";}?> value="1">Active</option>
                                <option <?php if($client['status'] == 0){echo "selected";}?> value="0">In Active</option>
                            </select>
                        </td>
                        
                        <td class="blog__options">
                        
                            <a class="post_edit" href="<?php echo base_url();?>edit-client/<?php echo $client['id'];?>" >
                                <i class="mdi mdi-pencil"></i>
                            </a>

                            <a class="client_delete" href="#" client_id="<?php echo $client['id'];?>">
                                <i class="mdi mdi-delete"></i>
                            </a>
                        </td>
                    </tr>

                    <?php $i++;}?>

                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>

    </div>
</div>