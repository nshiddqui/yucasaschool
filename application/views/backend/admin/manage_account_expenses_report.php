<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('manage_account_expenses_report');?>
            	</div>
            </div>

			<div class="panel-body">
				
                <?php echo form_open(site_url('admin/account_expenses_report_employee_selector') , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
        
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
								
					
             
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('submit');?></button>
						</div>
					</div>

                <?php echo form_close();?>

            </div>
        </div>
    </div>
</div>

