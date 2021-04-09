<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('download_inventory_excel');?>
            	</div>
            </div>

			<div class="panel-body">
				
                <?php echo form_open(site_url('admin/download_inventory_excel') , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

                             <div class="form-group">
                        <label class=" control-label"><?php echo "Date From";?></label>
                       

                            <input type="text" class="form-control datepicker" name="datefrm" data-format="yyyy-mm-dd">
                       
                    </div>
                  </br>
                </br>
                        <div class="form-group">
                        <label class=" control-label"><?php echo "Date To";?></label>
                      
                           <input type="text" class="form-control datepicker" id="dateto"  name="dateto" data-format="yyyy-mm-dd">
                     
                    </div>
                    
                    
		<!-- 						       
             <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('month'); ?></label>
                <select name="month" class="form-control selectboxit" id="inv_month">
                    <?php
                    for ($i = 1; $i <= 12; $i++):
                        if ($i == 1)
                            $m = 'january';
                        else if ($i == 2)
                            $m = 'february';
                        else if ($i == 3)
                            $m = 'march';
                        else if ($i == 4)
                            $m = 'april';
                        else if ($i == 5)
                            $m = 'may';
                        else if ($i == 6)
                            $m = 'june';
                        else if ($i == 7)
                            $m = 'july';
                        else if ($i == 8)
                            $m = 'august';
                        else if ($i == 9)
                            $m = 'september';
                        else if ($i == 10)
                            $m = 'october';
                        else if ($i == 11)
                            $m = 'november';
                        else if ($i == 12)
                            $m = 'december';
                        ?>
                        <option value="<?php echo $i; ?>"
                              <?php if($month == $i) echo 'selected'; ?>  >
                                    <?php echo get_phrase($m); ?>
                        </option>
                        <?php
                    endfor;
                    ?>
                </select>
             </div>
     
        
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('sessional_year'); ?></label>
                <select class="form-control selectboxit" name="sessional_year" id='inv_year'>
                    <?php
                    $sessional_year_options = explode('-', $running_year); ?>
                    <option value="<?php echo $sessional_year_options[0]; ?>"><?php echo $sessional_year_options[0]; ?></option>
                    <option value="<?php echo $sessional_year_options[1]; ?>"><?php echo $sessional_year_options[1]; ?></option>
                </select>
            </div>
       		 -->
				
								
					
             
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="button" onclick="select_section_report();" class="btn btn-info"><?php echo get_phrase('submit');?></button>
						</div>
					</div>

                <?php echo form_close();?>
<div id="table_data">
    
    </div>
            </div>
        </div>
    </div>
</div>
<script>
        function select_section_report() {
            var datefrm=$('#datefrm').val();
            var dateto=$('#dateto').val();
            
    if (datefrm !== '' && dateto !== '') {
    //c_id = class_id;
    var myKeyVals = { 'datefrm' : datefrm, 'dateto' : dateto }

    $.ajax({
         type: 'POST',
         data: myKeyVals,
        url: '<?php echo base_url();?>inventory/get_per_class_section_data_show/',
        success:function (response)
        {
            jQuery('#table_data').html(response);
        }
    });
    }
}
</script>
