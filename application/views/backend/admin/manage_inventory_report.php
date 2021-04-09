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

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                        <label class=" control-label"><?php echo "Date From";?></label>
                       <input type="text" class="form-control datepicker" name="datefrm" id="datefrm" data-format="yyyy-mm-dd">
                       
                    </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label class=" control-label"><?php echo "Date To";?></label>
                      
                           <input type="text" class="form-control datepicker" id="dateto"  name="dateto" data-format="yyyy-mm-dd">
                     
                    </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class=" control-label" style="display:block;">&nbsp;</label>
						<div class="col-sm-offset-3 col-sm-5 pull-left">
							<button type="button" onclick="select_section_report();" class="btn btn-info"><?php echo get_phrase('submit');?></button>
						</div>
					</div>
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
