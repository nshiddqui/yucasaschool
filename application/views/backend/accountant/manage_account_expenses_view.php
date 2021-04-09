<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('manage_account_expense_report');?>
            	</div>
            </div>

	<!-- 		<div class="panel-body">
				
                <?php echo form_open(site_url('admin/account_report_employee_selector') , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('designation');?></label>
                        
					<div class="col-sm-5">
					<select name="class_id" class="form-control selectboxit" onchange="select_section(this.value)" id = "class_selection">
				    <option value="" ><?php echo get_phrase('Select Designation');?></option>
				<?php
					$designations = $this->db->get('designations')->result_array();
					foreach($designations as $row):
                                            
				?>
                                
				<option value="<?php echo $row['id'];?>"
					 <?php if($class_id == $row['id']) echo 'selected'; ?> ><?php echo $row['name'];?></option>
                   <?php endforeach;?>
			</select>
						</div>
					</div>

					       
             <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('month'); ?></label>
                <select name="month" class="form-control selectboxit">
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
                <select class="form-control selectboxit" name="sessional_year">
                    <?php
                    $sessional_year_options = explode('-', $running_year); ?>
                    <option value="<?php echo $sessional_year_options[0]; ?>" <?php if($sessional_year == $sessional_year_options[0]) echo 'selected'; ?>  ><?php echo $sessional_year_options[0]; ?></option>
                    <option value="<?php echo $sessional_year_options[1]; ?>" <?php if($sessional_year == $sessional_year_options[1]) echo 'selected'; ?>><?php echo $sessional_year_options[1]; ?></option>
                </select>
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
<br>
<br> -->

   
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <span><p><h4><strong>Accounting Expenses Report</strong></h4></p></span>
                                <span><p><h4><strong><a href="<?php echo site_url('admin/export_account_expenses_excel/?class_id='.$class_id. '&datefrm='.$datefrm.'&dateto='.$dateto); ?>">Export Data</a></strong></h4></p></span>
                                <thead>
                                    <tr>
                                        <th>Serial_no</th>
                                     
                                        <th>Date</th>
                                        <th>Accountant Name</th>
                                        <th>Account Head</th>
                                                                            
                                        <th>Particulars</th>
                                        <th>Amount</th>
                                        <th>Descriptions</th>
                                         <th>Send to LKO date</th>
                                     
                                        <th>Vochers Recieved AT RO</th>
                                        <th>Remarks</th>
                                      </tr>
                                </thead>
                                <tbody>   
                                    <?php

                                    $count = 1;
                                    $total=0;
                                    if(isset($expenditures) && !empty($expenditures)){ ?>
                                        <?php foreach($expenditures as $obj){ ?>
                                   
                                                                         
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                          
                                            <td><?php echo $obj->date; ?></td>                                           
                                            <td><?php echo "Account Manager"?></td>                                           
                                            <td></td>
                                         <td><?php echo $obj->head; ?></td>
                                          
                                           <td><?php echo $amount=$obj->amount?$obj->amount:''; $total=$total+$amount;?>  </td>

                                                                                                                                                                    
                              

                                           <td><?php echo $obj->note; ?></td>
                                             <td id="lko_date:<?php echo $obj->id; ?>" contenteditable="true">
                                               <?php echo $obj->lko_date; ?> 
                                             </td>
                                           <td id="voc_rec_at_ro:<?php echo $obj->id; ?>" contenteditable="true">
                                             <?php echo $obj->voc_rec_at_ro; ?> 
                                           </td>
                                           <td id="lko_remarks:<?php echo $obj->id; ?>" contenteditable="true">
                                             <?php echo $obj->lko_remarks; ?> 
                                           </td>

                                                                                      
                                        </tr>
                                   <?php } } ?>
                                </tbody>
                            </table>
<center><h2>Total:<?php echo $total;?></h2></center>
                            <script src="//code.jquery.com/jquery.min.js"></script>
                       <script type="text/javascript">

                        
                   $(function(){
                    //acknowledgement message
                     $("td[contenteditable=true]").blur(function(){
                        var field_userid = $(this).attr("id") ;
                        var res = field_userid.split(":");
                        var update_field = res[0];
                        var user_id = res[1];
                        var advance = $(this).text();
                        

                     $.post('<?php echo site_url('admin/update_advance_expeses_pay/'); ?>' , {
                        update_field:update_field,
                        user_id:user_id,
                        advance_update:advance
                        }, function(data){

                       alert("Data Updated");
                        location.reload(true);
                        
                        });
                    });
                });
                       </script>

