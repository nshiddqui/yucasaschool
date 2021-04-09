<hr />
<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
   
        <!------CONTROL TABS END------>


        <div class="tab-content">
            <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                <div class="row">

                    <div class="col-md-12">

                        
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered datatable" id="table_export">
                            <thead>
                                <tr>
                                    <th><div>#</div></th>
                                    <th>Name</th>
                                    <!--<th>Type</th>
                                    <th>Quantity</th>-->
                                    <th>Status</th>
                                    <th>Option</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                    $count = 1;
                                    if (isset($inventories) && !empty($inventories)) {
                                        ?>
                                         <?php foreach ($inventories as $obj) { ?>
                           <tr>
                               <td><?php echo $count++; ?></td>
                           <td><?php echo $obj->asset_name; ?></td>
                           <td><?php if($obj->status==1){ echo "Active";}else{ echo "Inactive";
                           } ?></td>
                           <!--<td>25</td>
                           <td>In Stock</td>-->
                           <td><a href="<?php echo site_url('inventory/asset_edit/'.$obj->id.'/'); ?>" class="btn btn-info">Edit</a><a href="" class="btn btn-danger">Delete</a></td>
                           </tr>
                           <?php } ?>
                           <?php } ?>
                        </tbody>
</table>

                    </div>

                </div>
            </div>
            <!----TABLE LISTING ENDS--->

        </div>
    </div>
</div>
