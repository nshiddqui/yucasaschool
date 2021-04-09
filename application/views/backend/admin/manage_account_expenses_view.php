<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('manage_account_expense_report');?>
            	</div>
            </div>
            <div class="panel-body">
				
                <?php echo form_open(site_url('admin/account_expenses_report_employee_selector') , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
        
                <div class="row">
                    <div class="col-md-3">
                    <div class="form-group">
                        <label class=" control-label">Expenditure Head</label>
                      
                           <select  class="form-control col-md-7 col-xs-12"  name="expenditure_head_id"  id="expenditure_head_id">
                                <option value="">All</option> 
                                <?php foreach($expenditure_heads as $obj ){ ?>
                                <option value="<?php echo $obj->id; ?>"  <?php echo isset($expenditure_head_id) && $expenditure_head_id == $obj->id ?  'selected="selected"' : ''; ?>><?php echo $obj->title; ?></option>
                                <?php } ?>                                            
                            </select>
                     
                    </div>
                    </div>
                    <div class="col-md-3">
                    <div class="form-group">
                        <label class=" control-label"><?php echo "Date From";?></label>
                       

                            <input type="text" class="form-control datepicker" name="datefrm" data-format="yyyy-mm-dd" value="<?= isset($datefrm) ? $datefrm : ''?>">
                       
                    </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <label class=" control-label"><?php echo "Date To";?></label>
                      
                           <input type="text" class="form-control datepicker" id="dateto"  name="dateto" data-format="yyyy-mm-dd" value="<?= isset($dateto) ? $dateto : ''?>">
                     
                    </div>
                    </div>
                    <div class="col-md-3">
                    <div class="form-group">
						<div class="form-group">
						    <label class=" control-label">&nbsp;</label>
							<button type="submit" class="form-control btn btn-info"><?php echo get_phrase('submit');?></button>
						</div>
					</div>
					</div>
					</div>

                <?php echo form_close();?>

<br>
	                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <!--<span><p><h4><strong>Accounting Expenses Report</strong></h4></p></span>-->
                                <span><p><h4><strong><a href="<?php echo site_url('admin/export_account_expenses_excel/?class_id='.$class_id. '&datefrm='.$datefrm.'&dateto='.$dateto); ?>" class="btn btn-primary">Export Data</a></strong></h4></p></span>
                                <thead>
                                    <tr>
                                        <th>Serial_no</th>
                                     
                                        <th>Academic Year</th>
                                        <th>Expenditure Head</th>
                                                                            
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Item Name</th>
                                        <th>Rate</th>
                                        <th>QTY</th>
                                        <th>Tax</th>
                                        <th>Discount</th>
                                        <th>Note</th>
                                        <th>Send to LK Date</th>
                                     
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
                                            <td><?php echo $obj->academic_year_id; ?></td>   
                                            <td><?php echo $obj->head; ?></td>
                                            <td><?php echo $obj->date; ?></td>
                                            <td><?php echo $amount=$obj->amount?$obj->amount:''; $total=$total+$amount;?>  </td>
                                            <td><?php echo $obj->item_name; ?></td>
                                            <td><?php echo $obj->rate; ?></td>
                                            <td><?php echo $obj->qty; ?></td>
                                            <td><?php echo $obj->tax; ?></td>
                                            <td><?php echo $obj->discount; ?></td>
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


            </div>
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

                    //   alert("Data Updated");
                    //     location.reload(true);
                        
                        });
                    });
                });
                       </script>

