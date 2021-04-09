<hr />
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-body">

                <form action="<?php echo base_url();?>transport/travel/add_travel/<?= $id ?>" class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate">
				
				    <div class="form-group" id="type_name">
						<label for="field-2" class="col-sm-3 control-label">Choose Diesel/Mobil </label>

						<div class="col-sm-5">
							<select name="inventory_type" class="form-control col-md-7 col-xs-12" required>
                                            <option value="">--select--</option>
                                            <option value="1" <?= isset($obj->inventory_type) && $obj->inventory_type=='1' ? 'selected' : '' ?>>Diesel</option>
                                            <option value="2" <?= isset($obj->inventory_type) && $obj->inventory_type=='2' ? 'selected' : '' ?>>Mobil Oil</option>
                                        </select>
						</div>
					</div>
				
					<div class="form-group" id="type_name">
						<label for="field-2" class="col-sm-3 control-label">Quantity In Liter</label>

						<div class="col-sm-5">
							<input type="number" class="form-control" name="inventory_name" value="<?= isset($obj->name) ? $obj->name : '' ?>" id="">
						</div>
					</div>
					
					<div class="form-group" id="amount_name">
						<label for="field-2" class="col-sm-3 control-label">Amount</label>

						<div class="col-sm-5">
							<input type="number" class="form-control" name="amount" value="<?= isset($obj->cost) ? $obj->cost : '' ?>" id="" >
						</div>
					</div>


					
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?= isset($obj) ? 'Update' : 'Add'?></button>
						</div>
					</div>
                </form>            </div>
        </div>
    </div>
</div>



