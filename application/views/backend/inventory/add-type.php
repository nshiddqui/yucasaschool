<hr />
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
		    <div class="panel-body">

                <form action="<?php echo base_url();?>inventory/add_inventery_type" class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate">
				
				    
				
					<div class="form-group" id="type_name">
						<label for="field-2" class="col-sm-3 control-label">Add Inventory Type</label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" value="" id="">
						</div>
					</div>


					
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info">Add</button>
						</div>
					</div>
                </form>           
                </div>
                <br>
                <hr>
                <br>
			<div class="panel-body">

                <form action="<?php echo base_url();?>inventory/add" class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate">
				
				    <div class="form-group" id="type_name">
						<label for="field-2" class="col-sm-3 control-label">Inventory Type </label>
						<div class="col-sm-5">
							<select name="inventory_type" class="form-control col-md-7 col-xs-12" required>
                                            <option value="">--select--</option>
                                            <?php  
                                            foreach ($inventory_type as $field)
                                            {
                                                    echo "<option value='{$field->id}'>{$field->name}</option>";
                                            }
                                            ?>
                                        </select>
						</div>
					</div>
				
					<div class="form-group" id="type_name">
						<label for="field-2" class="col-sm-3 control-label">Inventory Type Quantity</label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="inventory_name" value="" id="">
						</div>
					</div>


					
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info">Add</button>
						</div>
					</div>
                </form>            </div>
        </div>
    </div>
</div>



