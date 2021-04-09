<?php $activeTab = "accounting"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Accounting</a></li>
        <li class="active">Expenditure</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-calculator"></i><small> <?php echo $this->lang->line('manage_expenditure'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">
                        <li class="<?php if($list){ echo 'active'; }?>"><a href="#tab_expenditure_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('expenditure'); ?> <?php echo $this->lang->line('list'); ?></a> </li>
                        
                            <li  class="<?php if(!$list  && !isset($edit)){ echo 'active'; }?>"><a href="#tab_add_expenditure"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('expenditure'); ?></a> </li>                          
                        
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_expenditure"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> <?php echo $this->lang->line('expenditure'); ?></a> </li>                          
                        <?php } ?>  
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if($list){ echo 'active'; }?>" id="tab_expenditure_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th><?php echo $this->lang->line('academic_year'); ?></th>
                                        <th><?php echo $this->lang->line('expenditure_head'); ?></th>
                                        <th><?php echo $this->lang->line('expenditure'); ?> <?php echo $this->lang->line('method'); ?></th>
                                        <th><?php echo $this->lang->line('amount'); ?></th>
                                        <th><?php echo $this->lang->line('date'); ?></th>
                                        <th><?php echo $this->lang->line('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($expenditures) && !empty($expenditures)){ ?>
                                        <?php foreach($expenditures as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $obj->academic_year_id; ?></td>
                                            <td><?php echo $obj->head; ?></td>
                                            <td><?php echo $this->lang->line($obj->expenditure_via); ?></td>
                                            <td><?php echo $obj->amount; ?></td>
                                            <td><?php echo $obj->date; ?></td>
                                            <td>
                                                <?php if(has_permission(VIEW, 'accounting', 'expenditure')){ ?>
                                                    <a onclick="showAjaxModal('<?php echo site_url('modal/popup/get-single-expenditure/'.$obj->id);?>');"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> 
                                                    </a>

                                                <?php } ?>
                                                    
                                                <?php  if($obj->expenditure_type != 'salary'){ ?>
                                                    <?php if(has_permission(EDIT, 'accounting', 'expenditure')){ ?>
                                                        <a href="<?php echo site_url('expenditure/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> </a>
                                                    <?php } ?>
                                                    <?php if(has_permission(DELETE, 'accounting', 'expenditure')){ ?>
                                                        <a href="<?php echo site_url('expenditure/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>

                        <div  class="tab-pane fade in <?php if(!$list && !isset($edit)){ echo 'active'; }?>" id="tab_add_expenditure">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('expenditure/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                 
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="expenditure_head_id"><?php echo $this->lang->line('expenditure_head'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="expenditure_head_id"  id="expenditure_head_id" required="required" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <?php foreach($expenditure_heads as $obj ){ ?>
                                            <option value="<?php echo $obj->id; ?>"  <?php echo isset($post['expenditure_head_id']) && $post['expenditure_head_id'] == $obj->id ?  'selected="selected"' : ''; ?>><?php echo $obj->title; ?></option>
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('expenditure_head_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="expenditure_via"><?php echo $this->lang->line('expenditure'); ?> <?php echo $this->lang->line('method'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="expenditure_via"  id="expenditure_via" required="required" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <?php $payments = get_payment_methods(); ?>
                                            <?php foreach($payments as $key=>$value ){ ?>
                                                <?php if(!in_array($key, array('paypal', 'payumoney', 'ccavenue', 'paytm'))){ ?>
                                                    <option value="<?php echo $key; ?>"  <?php echo isset($post['expenditure_via']) && $post['expenditure_via'] == $key ?  'selected="selected"' : ''; ?>><?php echo $value; ?></option>
                                                <?php } ?>                                            
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('expenditure_via'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount"><?php echo $this->lang->line('amount'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="amount"  id="amount" value="<?php echo isset($post['amount']) ?  $post['amount'] : ''; ?>" placeholder="<?php echo $this->lang->line('amount'); ?>" required="required" type="number" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('amount'); ?></div>
                                    </div>
                                </div>  
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date"><?php echo $this->lang->line('date'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="date"  id="add_date" value="<?php echo isset($post['date']) ?  $post['date'] : ''; ?>" placeholder="<?php echo $this->lang->line('date'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('date'); ?></div>
                                    </div>
                                </div>


                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo $this->lang->line('note'); ?>"><?php echo isset($post['note']) ?  $post['note'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="item_name">Item Name </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="item_name"  id="item_name" value="<?php echo isset($post['item_name']) ?  $post['item_name'] : ''; ?>" placeholder="Item Name"  type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('item_name'); ?></div>
                                    </div>
                                </div>  
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rate">Rate</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="rate"  id="rate" value="<?php echo isset($post['rate']) ?  $post['rate'] : ''; ?>" placeholder="Rate"  type="number" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('rate'); ?></div>
                                    </div>
                                </div>  
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="qty">QTY</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="qty"  id="qty" value="<?php echo isset($post['qty']) ?  $post['qty'] : ''; ?>" placeholder="QTY"  type="number" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('qty'); ?></div>
                                    </div>
                                </div>  
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Tax</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="tax"  id="tax" value="<?php echo isset($post['tax']) ?  $post['tax'] : ''; ?>" placeholder="Tax"  type="number" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('tax'); ?></div>
                                    </div>
                                </div>  
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="discount">Discount</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="discount"  id="discount" value="<?php echo isset($post['discount']) ?  $post['discount'] : ''; ?>" placeholder="Discount"  type="number" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('discount'); ?></div>
                                    </div>
                                </div>  

                                <!--<div class="item form-group">-->
                                <!--    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note">Items List</label>-->
                                <!--    <div class="col-sm-12">-->
                                <!--        <div class="table-responsive col-sm-12">-->
                                <!--            <table class="table table-striped item-list">-->
                                <!--                <thead>-->
                                <!--                    <tr>-->
                                                        <!-- <th>S.no</th> -->
                                <!--                        <th style="width: 30%;">Item Name</th>-->
                                <!--                        <th class="text-xs-left">Rate (Rs)</th>-->
                                <!--                        <th class="text-xs-left">Qty</th>-->
                                <!--                        <th class="text-xs-left">Tax (%)</th>-->
                                <!--                        <th class="text-xs-left"> Discount (%)</th>-->
                                <!--                        <th class="text-xs-left">Amount (Rs)</th>-->
                                <!--                        <th class="text-xs-left"></th>-->
                                <!--                    </tr>-->
                                <!--                </thead>-->
                                <!--                <tbody>-->
                                <!--                    <tr class="item">-->
                                                        <!-- <th scope="row" class="item_count">1</th> -->
                                <!--                        <td class="item-name" ><input class="form-control" type="text" name="item_name"></td>                           -->
                                <!--                        <td class="item-rate "><input class="form-control" type="number" min="0" name="item_rate"></td>-->
                                <!--                        <td class="item-qty"><input class="form-control" type="number"  name="item_qty" value="1" min="1"></td>-->
                                <!--                        <td class="item-tax"><input class="form-control" type="number" min="0" name="item_tax" max="100"></td>-->
                                <!--                        <td class="item-disc"><input class="form-control" type="number" min="0" name="item_disc" max="100" ></td>-->
                                <!--                        <td class="item-amount">Rs <span></span></td>-->
                                <!--                         <td class="item"></td>-->
                                <!--                    </tr>-->


                                <!--                    <tr class="item item-clone item-hidden">-->
                                                        <!-- <th scope="row" class="item_count">2</th> -->
                                <!--                        <td class="item-name" ><input class="form-control" type="text" name="item_name"></td>                           -->
                                <!--                        <td class="item-rate "><input class="form-control" type="number" min="0" name="item_rate"></td>-->
                                <!--                        <td class="item-qty"><input class="form-control" type="number" min="0" name="item_qty" value="1" min="1"></td>-->
                                <!--                        <td class="item-tax"><input class="form-control" type="number" min="0" name="item_tax" max="100"></td>-->
                                <!--                        <td class="item-disc"><input class="form-control" type="number" min="0" max="100" name="item_disc"></td>-->
                                <!--                        <td class="item-amount">Rs <span></span></td>-->
                                <!--                        <td class="item-delete">Remove</td>-->
                                <!--                    </tr>-->
                                <!--                </tbody>-->
                                <!--            </table>-->

                                <!--            <div class="col-sm-12 text-right p0">-->
                                <!--                <a onclick="addItem(); return false;" class="btn add-item btn-blue">Add More Item</a>-->
                                <!--            </div>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                    
                                <!--</div>-->
                               
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('expenditure'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  

                        
                        <?php if(isset($edit)){ ?>
                        <div class="tab-pane fade in active" id="tab_edit_expenditure">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('expenditure/edit/'.$expenditure->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                                             
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="expenditure_head_id"><?php echo $this->lang->line('expenditure_head'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="expenditure_head_id"  id="expenditure_head_id" required="required">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <?php foreach($expenditure_heads as $obj ){ ?>
                                            <option value="<?php echo $obj->id; ?>" <?php if($expenditure->expenditure_head_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->title; ?></option>
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('expenditure_head_id'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="expenditure_via"><?php echo $this->lang->line('expenditure'); ?> <?php echo $this->lang->line('method'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="expenditure_via"  id="expenditure_via" required="required" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <?php $payments = get_payment_methods(); ?>
                                            <?php foreach($payments as $key=>$value ){ ?>
                                                <?php if(!in_array($key, array('paypal', 'payumoney', 'ccavenue', 'paytm'))){ ?>
                                                    <option value="<?php echo $key; ?>" <?php if($expenditure->expenditure_via == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                                <?php } ?>                                            
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('expenditure_via'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount"><?php echo $this->lang->line('amount'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="amount"  id="amount" value="<?php echo isset($expenditure->amount) ?  $expenditure->amount : $post['amount']; ?>" placeholder="<?php echo $this->lang->line('amount'); ?>" required="required" type="number" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('amount'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date"><?php echo $this->lang->line('date'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="date"  id="edit_date" value="<?php echo isset($expenditure->date) ?  date('d-m-Y', strtotime($expenditure->date)) : $post['date']; ?>" placeholder="<?php echo $this->lang->line('date'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('date'); ?></div>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('billing'); ?><?php echo $this->lang->line('address'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="billing_add" placeholder="<?php echo $this->lang->line('billing'); ?><?php echo $this->lang->line('address'); ?>"><?php echo isset($expenditure->note) ?  $expenditure->note : $post['note']; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                             
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo $this->lang->line('note'); ?>"><?php echo isset($expenditure->note) ?  $expenditure->note : $post['note']; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="item_name">Item Name </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="item_name"  id="item_name" value="<?php echo isset($expenditure->item_name) ?  $expenditure->item_name : $post['item_name']; ?>" placeholder="Item Name" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('item_name'); ?></div>
                                    </div>
                                </div>  
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rate">Rate</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="rate"  id="rate" value="<?php echo isset($expenditure->rate) ?  $expenditure->rate : $post['rate']; ?>" placeholder="Rate" type="number" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('rate'); ?></div>
                                    </div>
                                </div>  
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="qty">QTY</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="qty"  id="qty" value="<?php echo isset($expenditure->qty) ?  $expenditure->qty : $post['qty']; ?>" placeholder="QTY" type="number" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('qty'); ?></div>
                                    </div>
                                </div>  
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Tax</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="tax"  id="tax" value="<?php echo isset($expenditure->tax) ?  $expenditure->tax : $post['tax']; ?>" placeholder="Tax" type="number" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('tax'); ?></div>
                                    </div>
                                </div>  
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="discount">Discount</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="discount"  id="discount" value="<?php echo isset($expenditure->discount) ?  $expenditure->discount : $post['discount']; ?>" placeholder="Discount" type="number" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('discount'); ?></div>
                                    </div>
                                </div>                        
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="<?php echo isset($expenditure) ? $expenditure->id : $id; ?>" name="id" />
                                        <a  href="<?php echo site_url('expenditure'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('update'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  
                        <?php } ?>
                       
                    </div>
                </div>
                <br><br><br>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bs-expenditure-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo $this->lang->line('expenditure'); ?> <?php echo $this->lang->line('information'); ?></h4>
        </div>
        <div class="modal-body fn_expenditure_data">
            
        </div>       
      </div>
    </div>
</div>
<link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
<script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>

<script type="text/javascript">
         
    function get_expenditure_modal(expenditure_id){
         
        $('.fn_expenditure_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('accounting/expenditure/get_single_expenditure'); ?>",
          data   : {expenditure_id : expenditure_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_expenditure_data').html(response);
             }
          }
       });
    }
</script>

 <script type="text/javascript">
     
    $('#add_date').datepicker();
    $('#due_date').datepicker();
    $('#edit_date').datepicker();
  
        $(document).ready(function() {
          $('#datatable-responsive').DataTable( {
              dom: 'Bfrtip',
              iDisplayLength: 15,
              buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'csvHtml5',
                  'pdfHtml5',
                  'pageLength'
              ],
              search: true
          });
        });
    // $("#add").validate();     
    // $("#edit").validate();  
</script>


<!-- script for item list -->

<script>
    var itemCount = 2;
    function addItem(){
        ++itemCount;
        var item = $('.item-clone').clone(true);
        item.removeClass('item-clone item-hidden');
        item.insertBefore('.item-list tbody>tr:last');
        amountCal();
        // $('.item-list tbody>tr:last .item_count').text(itemCount);
        return false;
    }

    $('.item-delete').click(function(){
        $(this).parent('tr').remove();
        return false;
    });

    function amountCal(){
        $('.item-list .item td').keyup(function(){
            var rate = $(this).parent('tr').find('.item-rate input').val();
            var qty = $(this).parent('tr').find('.item-qty input').val();
            var tax = $(this).parent('tr').find('.item-tax input').val();
            var disc = $(this).parent('tr').find('.item-disc input').val();
            var total = $(this).parent('tr').find('.item-amount input');
            var amt = rate * qty;
            total = amt + (tax * amt)/100 -(disc * amt)/100;

            $(this).parent('tr').find('.item-amount span').html(Math.round(total));





        });
    }

    amountCal();

    
</script>