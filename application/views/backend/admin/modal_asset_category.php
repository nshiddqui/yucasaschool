<?php
$edit_data		=	$this->db->get_where('asset_category' , array('asset_category_id' => $param2) )->result_array();

?>

<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open(site_url('admin/add_asset_category/do_update/'.$row['asset_category_id']) , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            <div class="padded">
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('dormitory_name');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="asset_category" value="<?php echo $row['category'];?>"
                            data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" required/>
                    </div>
                </div>
               
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="description" value="<?php echo $row['description'];?>"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-5">
                  <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_asset_category');?></button>
              </div>
            </div>
        </form>
        <?php endforeach;?>
    </div>
</div>
