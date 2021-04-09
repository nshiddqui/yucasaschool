<div class="row">
    <div class="panel panel-primary" data-collapsed="0">
        <div class="container">
            <?php echo form_open('' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                        <label class=" control-label"><?php echo "Date From";?></label>
                       <input type="text" class="form-control datepicker" name="datefrm" id="datefrm" data-format="yyyy-mm-dd" required>
                       
                    </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label class=" control-label"><?php echo "Date To";?></label>
                      
                           <input type="text" class="form-control datepicker" id="dateto"  name="dateto" data-format="yyyy-mm-dd" required>
                     
                    </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class=" control-label" style="display:block;">&nbsp;</label>
						<div class="col-sm-offset-3 col-sm-5 pull-left">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('submit');?></button>
						</div>
					</div>
					</div>
				</div>

                <?php echo form_close();?>
			    <table class="table table-bordered datatable" cellspacing="0" width="90%" id="tableExport">
                                <thead>
                                    <tr>
                                        <td style="width:10px">SL No,</td>
                                        <td style="width:40px">Asset Name</td>
                                        <td style="width:60px">Asset Location</td>
                                        <td style="width:40px">Quantity</td>
                                        <td style="width:40px">Class/Section</td>
                                        <td style="width:120px">Hostel/Room</td>
                                        <td>Description</td>
                                        <td>Date </td> 
                                    </tr>
                                </thead>
                            <tbody>   
                                     
                                    <?php $count = 1; if(isset($sections) && !empty($sections)){ ?>
                                        <?php
                                        $total_km=0;
                                        $total_diesel=0;
                                        $total_cash=0;
                                        $total_damage=0;
                                           foreach($sections as $obj){ 
                                               if($obj->asset_loc == '1'){
                                                   $assetLocation = 'Class';
                                               } else if ($obj->asset_loc == '2') {
                                                   $assetLocation = 'Hostel';
                                               } else {
                                                   $assetLocation = 'Other Room';
                                               }
                                            $class_name = $this->db->get_where('class', array('class_id' => $obj->class_id))->row()->name;
                                            $section_name = $this->db->get_where('section', array('class_id' => $obj->class_id,'section_id' => $obj->section_id))->row()->name;
                                            $hostel_name = $this->db->get_where('hostels', array('id' => $obj->hostel_id))->row()->name;
                                            $room_name = $this->db->get_where('rooms', array('id' => $obj->room_id,'hostel_id' => $obj->hostel_id))->row()->room_no;
                                            
                                            ?>
                                        <tr>

                    
                                            <td style="width:10px"><?php echo $count++; ?></td>
                                            <td style="width:40px"><?php echo $obj->asset_name;?></td>
                                            <td style="width:60px"><?= $assetLocation ?></td>
                                            <td style="width:40px"><?php echo $obj->quantity; ?></td>
                                            <?php if(empty($class_name) && empty($section_name)) {?>
                                            <td style="width:40px"></td>
                                            <?php } else { ?>
                                            <td style="width:40px"><?php echo $class_name;?> / <?php echo $section_name;?></td>
                                            <?php } ?>
                                            <?php if(empty($hostel_name) && empty($room_name)) {?>
                                            <td style="width:120px"></td>
                                            <?php } else { ?>
                                            <td style="width:120px"><?php echo $hostel_name;?> / <?php echo $room_name;?></td>
                                            <?php } ?>
                                            <td><?php echo $obj->description; ?></td>
                                          <td><?php echo $obj->created_at;?></td>
                                            
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                              
                                </tbody>
                            </table>
         </div>       
                          
	</div>
</div>
        <script>
         $(document).ready(function() {
		$.fn.dataTable.ext.errMode = 'throw';
        if ( ! $.fn.DataTable.isDataTable( '#tableExport' ) ) {
              $('#tableExport').dataTable();
            }
       
    });

        </script>