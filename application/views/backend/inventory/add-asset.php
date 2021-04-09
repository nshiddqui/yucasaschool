<hr />
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
		    
		    <div class="tab-pane box active" id="list">
		        	<div class="panel-body">

                <form action="<?php echo base_url();?>inventory/add_asset" class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate">
				
				    
				
					<div class="form-group" id="type_name">
						<label for="field-2" class="col-sm-3 control-label">Asset type name</label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="asset_name" value="" id="">
						</div>
					</div>


					
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info">Add</button>
						</div>
					</div>
                </form>            </div>
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
                                    //print_r($inventories_list);
                                    if (isset($inventories_list) && !empty($inventories_list)) {
                                        ?>
                                         <?php foreach ($inventories_list as $obj) { ?>
                           <tr>
                               <td><?php echo $count++; ?></td>
                           <td><?php echo $obj->asset_name; ?></td>
                           <td><?php if($obj->status==1){ echo "Active";}else{ echo "Inactive";
                           } ?></td>
                           <!--<td>25</td>
                           <td>In Stock</td>-->
                           <td><a href="<?= base_url('inventory/delete_asset/'.$obj->id)?>" class="btn btn-danger">Delete</a></td>
                           </tr>
                           <?php } ?>
                           <?php } ?>
                        </tbody>
</table>

                    </div>

                </div>
            </div>
		
        </div>
    </div>
</div>



