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
                                    <th>Inventory type</th>
                                    <!--<th>Type</th>-->
                                    <th>Quantity</th>
                                    <th>Amount</th>
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
                           <td><?php if($obj->inventory_type==1){echo 'Diesel';}if($obj->inventory_type==2){ echo 'Mobil Oil';} ?></td>
                           <td><?php echo $obj->name; ?></td>
                           <td><?php echo $obj->cost; ?></td>
                           <!--<td>25</td>
                           <td>In Stock</td>-->
                           <td><a href="<?php echo site_url('transport/travel/add_travel/'.$obj->id.'/'); ?>" class="btn btn-info">Edit</a><a href="<?php echo site_url('transport/travel/delete_travel/'.$obj->id.'/'); ?>" class="btn btn-danger">Delete</a></td>
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
