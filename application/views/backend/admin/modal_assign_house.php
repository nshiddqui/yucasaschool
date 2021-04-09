<?php 


$edit_data		=	$this->db->get_where('house_info' , array('house_id' => $param2))->result_array();
foreach ($edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_student');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(site_url('admin/house/do_update/'.$row['house_id'])  , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                
                	<div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('house_name');?></label>
                        <div class="col-sm-5">
                           <input type="text" class="form-control" value="<?=$row['name'];?>" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                        <div class="col-sm-5">
                           <textarea type="text" class="form-control"  name="description"><?=$row['description'];?></textarea>
                        </div>
                     </div>
                    <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-5">
                          <button type="submit" class="btn btn-info"><?php echo get_phrase('add_house');?></button>
                      </div>
					</div>

                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>

