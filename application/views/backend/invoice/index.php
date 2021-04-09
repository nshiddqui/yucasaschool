<style>
    .fn_check_button{
        display: none;
    }
    .fn_bulk_cheque{
        display: none;
    }
</style>
<?php $activeTab = "accounting"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Accounting</a></li>
        <li class="active"><?php isset($_GET['title']) ? $_GET['title'] : 'Invoice' ?></li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
</div>

<div class="row" style="background:#f2f4f8">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <?php if(isset($list)){ ?>
            <div class="filter_form">
<?php echo form_open(site_url('invoice'.(isset($unpaid) && $unpaid?'/invoice_unpaid':'').(isset($_GET['title']) ? '?title='.$_GET['title'] : ''))); ?>
<div class="row">
	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class');?></label>
			<select name="class_id" class="form-control selectboxit" onchange="select_section(this.value)" id = "class_selection">
				<option value=""><?php echo get_phrase('select_class');?></option>
				<?php
					$classes = $this->db->get('class')->result_array();
					$class_id = isset($_POST['class_id'])?$_POST['class_id']:'';
					foreach($classes as $row):
                                            
				?>
                                
				<option value="<?php echo $row['class_id'];?>" <?= $class_id == $row['class_id']?'selected':'' ?>><?php echo $row['name'];?></option>
                                
				<?php endforeach;?>
			</select>
		</div>
	</div>

	
    <div id="section_holder">
	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section');?></label>
			<select class="form-control selectboxit" name="section_id">
                            <option value=""><?php echo get_phrase('select_class_first') ?></option>
                            <?php
                            if(!empty($classes)){
                              	$sections = $this->db->get_where('section' , array('class_id' => $class_id))->result_array();
                              	$section_id = isset($_POST['section_id'])?$_POST['section_id']:'';
                              	foreach($sections as $row2): ?>
                                 <option value="<?php echo $row2['section_id'];?>" <?= $section_id == $row2['section_id']?'selected':'' ?>><?php echo $row2['name'];?></option>
                              <?php endforeach;
                            }  
                            ?>
				
			</select>
		</div>
	</div>
    </div>
    <div class="col-md-2">
             <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('month'); ?></label>
                <select name="month" class="form-control selectboxit">
                    <option value="0">
                              All
                        </option>
                    <?php
                    // $month = isset($_POST['month'])? $_POST['month']:'';
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
        </div>
    
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('sessional_year'); ?></label>
                <select class="form-control selectboxit" name="sessional_year">
                    <?php
                    $session_year = isset($_POST['sessional_year']) ? $_POST['sessional_year'] : '';
                    $sessional_year_options = explode('-', $running_year); ?>
                    <option value="<?php echo $sessional_year_options[0]; ?>" <?= $session_year == $sessional_year_options[0] ?'selected' : '' ?>><?php echo $sessional_year_options[0]; ?></option>
                    <option value="<?php echo $sessional_year_options[1]; ?>" <?= $session_year == $sessional_year_options[1] ?'selected' : '' ?> ><?php echo $sessional_year_options[1]; ?></option>
                </select>
            </div>
        </div>
    <div class="col-md-2">
	    <div class="form-group">
	        <label class="control-label" style="margin-bottom: 5px;">&nbsp;</label>
		    <button type="submit" id = "submit" class="btn btn-info btn-block"><?php echo get_phrase('Filter  Data');?></button>
		</div>
	</div>

</div>
<?php echo form_close();?>
</div>    
<?php } ?>
<div class="x_content">
    
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">
                        <?php if(isset($list)){ ?>
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_invoice_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="entypo-menu"></i>  <?php echo isset($_GET['title']) ? $_GET['title'] : $this->lang->line('invoice'); ?> <?php echo $this->lang->line('list'); ?></a> </li>
                        <?php }
                        if(!isset($_GET['title'])) { ?>
                        <li  class="<?php if(isset($single)){ echo 'active'; }?>"><a href="#tab_single_invoice"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="entypo-plus-circled"></i> <?php echo $this->lang->line('create'); ?> <?php echo $this->lang->line('invoice'); ?></a> </li>                          
                        <?php } ?>
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_invoice"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> <?php echo $this->lang->line('invoice'); ?></a> </li>                          
                        <?php } ?>                
                    </ul>
                    <br/>
                    
                    
                    <div class="tab-content">
                        <?php if(isset($list)){ ?>
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_invoice_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap datatable" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th><?php echo $this->lang->line('invoice'); ?> <?php echo $this->lang->line('number'); ?></th>
                                        <th><?php echo $this->lang->line('student'); ?></th>
                                        <th><?php echo $this->lang->line('class'); ?></th>
                                        <th><?php echo $this->lang->line('fee'); ?> <?php echo $this->lang->line('month'); ?></th>
                                        <th><?php echo $this->lang->line('gross_amount'); ?></th>
                                        <th><?php echo $this->lang->line('discount'); ?></th>
                                        <th><?php echo $this->lang->line('net_amount'); ?></th>
                                        <th><?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('status'); ?></th>
                                        <?php if(!isset($_GET['title'])) { ?>
                                        <th><?php echo $this->lang->line('action'); ?></th>  
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($invoices) && !empty($invoices)){ ?>
                                        <?php foreach($invoices as $obj){
                                        if($unpaid && $obj->paid_status=='unpaid'){
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $obj->custom_invoice_id; ?></td>
                                            <td><?php echo $obj->student_name; ?></td>
                                            <td><?php echo $obj->class_name; ?></td>
                                            <td><?php echo date("M Y", strtotime("1-".$obj->month)); ?></td>
                                            <td><?php echo $obj->gross_amount; ?></td>
                                            <td><?php echo $obj->discount; ?></td>
                                            <td><?php echo $obj->net_amount; ?></td>
                                            <td><?php echo get_paid_status($obj->paid_status); ?></td>
                                            <?php if(!isset($_GET['title'])) { ?>
                                            <td><li>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                                        Action <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                                        <li>
                                                                    <a href="<?php echo site_url('invoice/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class=""><i class="fa fa-trash"></i> <?php echo $this->lang->line('delete'); ?> </a>
                                                        </li>
                                                        <li>
                                                            <a href="<?php echo site_url('invoice/paid_invoice/'.$obj->id); ?>" onclick="javascript: return confirm('Has student paid this amount?');" class=""><i class="fa fa-money"></i> <?php echo $this->lang->line('paid'); ?> </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                    </td>
                                            <?php } ?>
                                        </tr>
                                        <?php } ?>
                                        <?php
                                        if(!$unpaid && $obj->paid_status=='paid'){
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $obj->custom_invoice_id; ?></td>
                                            <td><?php echo $obj->student_name; ?></td>
                                            <td><?php echo $obj->class_name; ?></td>
                                            <td><?php echo date("M Y", strtotime("1-".$obj->month)); ?></td>
                                            <td><?php echo $obj->gross_amount; ?></td>
                                            <td><?php echo $obj->discount; ?></td>
                                            <td><?php echo $obj->net_amount; ?></td>
                                            <td><?php echo get_paid_status($obj->paid_status); ?></td>
                                            <?php if(!isset($_GET['title'])) { ?>
                                            <td>
                                                <!-- <?php if(has_permission(VIEW, 'accounting', 'invoice')){ ?>
                                                    <a href="<?php echo site_url('accounting/invoice/view/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> </a>
                                                <?php } ?> 
                                                <?php if(has_permission(DELETE, 'accounting', 'invoice')){ ?>
                                                    <?php if($obj->paid_status == 'unpaid'){ ?>
                                                        <a href="<?php echo site_url('accounting/invoice/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
                                                    <?php } ?>
                                                <?php } ?>   
 -->
                                                 <div class="btn-group">
                                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                                        Action <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                                        <li>
                                                          <?php if(has_permission(VIEW, 'accounting', 'invoice')){ ?>
                                                            <a href="<?php echo site_url('invoice/view/'.$obj->id); ?>" class=""><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> </a>
                                                        <?php } ?> 
                                                        </li>

                                                        

                                                
                                                        <li class="divider"></li>

                                                        <li>
                                                                    <a href="<?php echo site_url('invoice/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class=""><i class="fa fa-trash"></i> <?php echo $this->lang->line('delete'); ?> </a>
                                                        </li>
                                                    </ul>
                                                </div> 
                                            </td>
                                            <?php } ?>
                                        </tr>
                                        <?php } ?>
                                       <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <?php } ?>
                        <div  class="tab-pane fade in <?php if(isset($single)){ echo 'active'; }?>" id="tab_single_invoice">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('invoice/add'), array('name' => 'single', 'id' => 'single', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo $this->lang->line('class'); ?> <span class="required">*</span>
                                    </label>
                                    
                                    <?php $classes = json_decode(json_encode( $classes),FALSE) ; 
                                                                  
                                    ?>


                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="class_id"  id="add_class_id" required="required" onchange="return get_class_sections(this.value)" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <?php foreach($classes as $obj ){ ?>
                                            <option value="<?php echo $obj->class_id; ?>" ><?php echo $obj->name; ?></option>
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="section_selector_holder"><?php echo $this->lang->line('section'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="section_id"  id="section_selector_holder" onchange="return get_student_by_class_sections(this.value)" required="required" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                      
                                        </select>
                                        <div class="help-block"><?php echo form_error('student_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="add_student_id"><?php echo $this->lang->line('student'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="student_id"  id="add_student_id" required="required" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                      
                                        </select>
                                        <div class="help-block"><?php echo form_error('student_id'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="income_head_id?"><?php echo $this->lang->line('fee'); ?> <?php echo $this->lang->line('type'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12" name="income_head_id" id="income_head_id" onchange="get_fee_amount(this.value,'add');">
                                        <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <?php foreach($income_heads as $obj ){ ?>
                                            <option value="<?php echo $obj->id; ?>" ><?php echo $obj->title; ?></option>
                                            <?php } ?> 
                                        </select>
                                        <div class="help-block"><?php echo form_error('income_head_id'); ?></div>
                                    </div>
                                </div> 
                                    
                                <!--<div class="item form-group">-->
                                <!--    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="income_head_id?"><?php echo $this->lang->line('fee'); ?> <?php echo $this->lang->line('type'); ?> <span class="required">*</span></label>-->
                                <!--    <div class="col-md-6 col-sm-6 col-xs-12">-->
                                <!--        <select  class="form-control col-md-7 col-xs-12" name="income_head_id" id="income_head_id" required="required" onchange="//get_fee_amount(this.value, 'add');">-->
                                <!--        <option value="">--<?php echo $this->lang->line('select'); ?>--</option> -->
                                            
                                <!--            <option value="1" >Admission fee</option>-->
                                <!--            <option value="2" >Education fee</option>-->
                                <!--            <option value="3" >Dress fee</option>-->
                                <!--            <option value="4" >Book fee</option>-->
                                <!--            <option value="5" >Transport fee</option>-->
                                <!--            <option value="6" >Event fee</option>-->
                                <!--            <option value="7" >Tution fee</option>-->
                                             
                                <!--        </select>-->
                                <!--        <div class="help-block"><?php echo form_error('income_head_id'); ?></div>-->
                                <!--    </div>-->
                                <!--</div> -->
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount"><?php echo $this->lang->line('fee'); ?> <?php echo $this->lang->line('amount'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="panel-group">
                                    <div class="panel panel-default">
                                      <div class="panel-heading">
                                        <h4 class="panel-title">
                                          <a data-toggle="collapse" href="#collapse1">Click to see fee amount</a>
                                        </h4>
                                      </div>
                                      <div id="collapse1" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <input  class="form-control col-md-7 col-xs-12"  name="amount"  id="amount" value="<?php echo isset($invoice->amount) ?  $invoice->amount : $post['amount']; ?>" placeholder="<?php echo $this->lang->line('amount'); ?>" required="required" type="hidden">
                                            <?php get_html_fields('admission_fee','Admission fee','','Admission fees');?>
                                            <?php get_html_fields('tution_fee','Tution fee','','Tution fees');?>
                                            <?php get_html_fields('book_fee','Book fee','','Book fees');?>
                                            <?php get_html_fields('dress_fee','Dress fee','','Dress fees');?>
                                            <?php get_html_fields('education_fee','Education fee','','Education fees');?>
                                            <?php get_html_fields('event_fee','Event fee','','Event fees');?>
                                            <?php get_html_fields('hostel_fee','Hostel fee','','Hostel fees');?>
                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bank_name">Discount fee</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input class="form-control col-md-7 col-xs-12" name="discount" id="single_bank_name" value="" placeholder="Discount in amount" type="text" autocomplete="off">
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                             <?php get_html_fields('total_fee','Total fees','','Total fees');?>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                        <div class="help-block"><?php echo form_error('amount'); ?></div>
                                    </div>
                                </div>                                
                                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="payment_month"><?php echo $this->lang->line('month'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="month"  id="add_single_month" value="<?php echo isset($post['month']) ?  $post['month'] : ''; ?>" placeholder="<?php echo $this->lang->line('month'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('month'); ?></div>
                                    </div>
                                </div> 
                                
                                <!--<div class="item form-group">-->
                                <!--    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="is_applicable_discount"><?php echo $this->lang->line('is_applicable_discount'); ?> <span class="required">*</span></label>-->
                                <!--    <div class="col-md-6 col-sm-6 col-xs-12">-->
                                <!--        <select  class="form-control col-md-7 col-xs-12" name="is_applicable_discount" id="is_applicable_discount" required="required">-->
                                <!--            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                    -->
                                <!--            <option value="1"><?php echo $this->lang->line('yes'); ?></option>                                           -->
                                <!--            <option value="0"><?php echo $this->lang->line('no'); ?></option>                                           -->
                                <!--        </select>-->
                                <!--        <div class="help-block"><?php echo form_error('is_applicable_discount'); ?></div>-->
                                <!--    </div>-->
                                <!--</div>-->
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="paid_status"><?php echo $this->lang->line('status'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12" name="paid_status" id="paid_status" required="required"  onchange="check_paid_status(this.value,'single');">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                    
                                            <option value="paid"><?php echo $this->lang->line('paid'); ?></option>                                           
                                            <option value="unpaid"><?php echo $this->lang->line('unpaid'); ?></option>                                           
                                        </select>
                                        <div class="help-block"><?php echo form_error('paid_status'); ?></div>
                                    </div>
                                </div>
                                <div class="container">
  <?php
  function get_html_fields($name,$title,$value,$placeholder){
      echo '<div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bank_name">'.$title.'<span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="'.$name.'"  id="single_bank_name" value="'.$value.'" placeholder="'.$placeholder.'"  type="text" autocomplete="off">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>';
  }
  ?>
</div>

                                <!-- For cheque Start-->
                                <div class="display fn_single_paid_status" style="<?php if(isset($post) && $post['paid_status'] == 'paid'){ echo 'display:block;';}else{ echo 'display:none;';} ?>">
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="payment_method"><?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('method'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select  class="form-control col-md-7 col-xs-12"  name="payment_method"  id="single_payment_method" onchange="check_payment_method(this.value, 'single');">
                                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                                <?php $payments = get_payment_methods(); ?>
                                                <?php foreach($payments as $key=>$value ){ ?>                                              
                                                    <?php if(!in_array($key, array('paypal', 'payumoney', 'ccavenue', 'paytm'))){ ?>
                                                        <option value="<?php echo $key; ?>" <?php if(isset($post) && $post['payment_method'] == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                                    <?php } ?>  
                                                <?php } ?>                                            
                                            </select>
                                        <div class="help-block"><?php echo form_error('payment_method'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- For cheque Start-->
                                <div class="display fn_single_cheque" style="<?php if(isset($post) && $post['payment_method'] == 'cheque'){ echo 'display:block;';}else{ echo 'display:none;';} ?>">
                                    
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bank_name"><?php echo $this->lang->line('bank'); ?> <?php echo $this->lang->line('name'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="bank_name"  id="single_bank_name" value="" placeholder="<?php echo $this->lang->line('bank'); ?> <?php echo $this->lang->line('name'); ?>"  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('bank_name'); ?></div>
                                        </div>
                                    </div> 
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cheque_no"><?php echo $this->lang->line('cheque'); ?> <?php echo $this->lang->line('number'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="cheque_no"  id="single_cheque_no" value="" placeholder="<?php echo $this->lang->line('cheque'); ?> <?php echo $this->lang->line('number'); ?>"  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('cheque_no'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- For cheque End-->
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo $this->lang->line('note'); ?>"><?php echo isset($post['note']) ?  $post['note'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                               
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="single" name="type" />
                                        <a href="<?php echo site_url('accounting/invoice/index'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
                                        <button id="send" type="submit" name="print" value="1" class="btn btn-danger">Create And Print Invoice</button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  
                        
                        <div  class="tab-pane fade in <?php if(isset($bulk)){ echo 'active'; }?>" id="tab_bulk_invoice">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('invoice/bulk'), array('name' => 'bulk', 'id' => 'bulk', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                    
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo $this->lang->line('class'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="class_id"  id="bulk_class_id" required="required" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <?php foreach($classes as $obj ){ ?>
                                            <option value="<?php echo $obj->class_id; ?>" ><?php echo $obj->name; ?></option>
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="income_head_id?"><?php echo $this->lang->line('fee'); ?> <?php echo $this->lang->line('type'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12" name="income_head_id" id="income_head_id" required="required" onchange="get_student_and_fee_amount(this.value);">
                                        <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <?php foreach($income_heads as $obj ){ ?>
                                            <option value="<?php echo $obj->id; ?>" ><?php echo $obj->title; ?></option>
                                            <?php } ?> 
                                        </select>
                                        <div class="help-block"><?php echo form_error('income_head_id'); ?></div>
                                    </div>
                                </div> 
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="student_id"><?php echo $this->lang->line('student'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div id="student_container">
                                            
                                        </div>
                                        <div class="help-block fn_check_button display">
                                            <button id="check_all" type="button" class="btn btn-success"><?php echo $this->lang->line('check_all'); ?></button>
                                            <button id="uncheck_all" type="button" class="btn btn-success"><?php echo $this->lang->line('uncheck_all'); ?></button>
                                        </div>
                                    </div>
                                </div>
                                                                                         
                                 <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="is_applicable_discount?"><?php echo $this->lang->line('is_applicable_discount'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12" name="is_applicable_discount" id="is_applicable_discount" required="required">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                    
                                            <option value="1"><?php echo $this->lang->line('yes'); ?></option>                                           
                                            <option value="0"><?php echo $this->lang->line('no'); ?></option>                                           
                                        </select>
                                        <div class="help-block"><?php echo form_error('is_applicable_discount'); ?></div>
                                    </div>
                                </div>
                                                                                     
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="payment_month"><?php echo $this->lang->line('month'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="month"  id="add_bulk_month" value="<?php echo isset($post['month']) ?  $post['month'] : ''; ?>" placeholder="<?php echo $this->lang->line('month'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('month'); ?></div>
                                    </div>
                                </div> 
                                
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="paid_status"> <?php echo $this->lang->line('status'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12" name="paid_status" id="paid_status" required="required"  onchange="check_paid_status(this.value,'bulk');">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                    
                                            <option value="paid"><?php echo $this->lang->line('paid'); ?></option>                                           
                                            <option value="unpaid"><?php echo $this->lang->line('unpaid'); ?></option>                                           
                                        </select>
                                        <div class="help-block"><?php echo form_error('paid_status'); ?></div>
                                    </div>
                                </div>
                                
                                <!-- For cheque Start-->
                                <div class="display fn_bulk_paid_status" style="<?php if(isset($post) && $post['paid_status'] == 'paid'){ echo 'display:block;';} ?>">
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="payment_method"><?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('method'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select  class="form-control col-md-7 col-xs-12"  name="payment_method"  id="bulk_payment_method" onchange="check_payment_method(this.value, 'bulk');">
                                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                                <?php $payments = get_payment_methods(); ?>
                                                <?php foreach($payments as $key=>$value ){ ?>                                              
                                                    <?php if(!in_array($key, array('paypal', 'payumoney', 'ccavenue', 'paytm'))){ ?>
                                                        <option value="<?php echo $key; ?>" <?php if(isset($post) && $post['payment_method'] == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                                    <?php } ?>  
                                                <?php } ?>                                            
                                            </select>
                                        <div class="help-block"><?php echo form_error('payment_method'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- For cheque Start-->
                                <div class="display fn_bulk_cheque" style="<?php if(isset($post) && $post['payment_method'] == 'cheque'){ echo 'display:block;';} ?>">
                                    
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bank_name"><?php echo $this->lang->line('bank'); ?> <?php echo $this->lang->line('name'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12 bank_name_list">
                                            <input  class="form-control col-md-7 col-xs-12 bank_name_class hidden"  name="bank_name[]"  id="" disabled value="" placeholder="<?php echo $this->lang->line('bank'); ?> <?php echo $this->lang->line('name'); ?>"  type="text" autocomplete="off">

                                            <input class="form-control bank_name_clone col-md-7 col-xs-12 hidden " name="bank_name[]" id="bank_name_" value="" placeholder="Bank Name" type="text" autocomplete="off" required="">


                                            <div class="help-block"><?php echo form_error('bank_name'); ?>
                                                
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cheque_no"><?php echo $this->lang->line('cheque'); ?> <?php echo $this->lang->line('number'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12 cheque_number_list">
                                            <input  class="form-control col-md-7 col-xs-12 cheque_number_class hidden"  name="cheque_no[]" disabled id="first_cheque" value="" placeholder="<?php echo $this->lang->line('cheque'); ?> <?php echo $this->lang->line('number'); ?>"  type="text" autocomplete="off">

                                            <input class="form-control cheque_number_clone col-md-7 col-xs-12 hidden" name="cheque_no[]" id="cheque_number_" value="" placeholder="Bank Name" type="text" autocomplete="off" required="">


                                            <div class="help-block"><?php echo form_error('cheque_no'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- For cheque End-->
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo $this->lang->line('note'); ?>"><?php echo isset($post['note']) ?  $post['note'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                               
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="bulk" name="type" />
                                        <a href="<?php echo site_url('invoice/index'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  
                        
                        <?php if(isset($edit)){ ?>
                        <div class="tab-pane fade in active" id="tab_edit_tag">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('invoice/edit/'.$invoice->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                                              
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo $this->lang->line('class'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="class_id"  id="class_id" required="required" onchange="get_student_by_class(this.value, '','');">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <?php foreach($classes as $obj ){ ?>
                                            <option value="<?php echo $obj->id; ?>" <?php if($invoice->class_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="student_id"><?php echo $this->lang->line('student'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="student_id"  id="edit_student_id" required="required" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                      
                                        </select>
                                        <div class="help-block"><?php echo form_error('student_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="income_head_id"><?php echo $this->lang->line('income_head'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="income_head_id"  id="income_head_id" required="required">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <option value="1" <?php if($invoice->income_head_id == 1){ echo 'selected="selected"';} ?>>Admission fee</option>
                                            <option value="2" <?php if($invoice->income_head_id == 2){ echo 'selected="selected"';} ?>>Education fee</option>
                                            <option value="3" <?php if($invoice->income_head_id == 3){ echo 'selected="selected"';} ?>>Dress fee</option>
                                            <option value="4" <?php if($invoice->income_head_id == 4){ echo 'selected="selected"';} ?>>Book fee</option>
                                            <option value="5" <?php if($invoice->income_head_id == 5){ echo 'selected="selected"';} ?>>Transport fee</option>
                                            <option value="6" <?php if($invoice->income_head_id == 6){ echo 'selected="selected"';} ?>>Event fee</option>
                                            <option value="7" <?php if($invoice->income_head_id == 7){ echo 'selected="selected"';} ?>>Tution fee</option>
                                            <?php foreach($income_heads as $obj ){ ?>
                                            <option value="<?php echo $obj->id; ?>" <?php if($invoice->income_head_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->title; ?></option>
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('income_head_id'); ?></div>
                                    </div>
                                </div>
                                
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount"><?php echo $this->lang->line('amount'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="amount"  id="amount" value="<?php echo isset($invoice->amount) ?  $invoice->amount : $post['amount']; ?>" placeholder="<?php echo $this->lang->line('amount'); ?>" required="required" type="number">
                                        <div class="help-block"><?php echo form_error('amount'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="discount"><?php echo $this->lang->line('discount'); ?>(%)
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="discount"  id="discount" value="<?php echo isset($invoice->discount) ?  $invoice->discount : $post['discount']; ?>" placeholder="<?php echo $this->lang->line('discount'); ?>" type="number">
                                        <div class="help-block"><?php echo form_error('discount'); ?></div>
                                    </div>
                                </div>
                             
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo $this->lang->line('note'); ?>"><?php echo isset($invoice->note) ?  $invoice->note : $post['note']; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                                                             
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="<?php echo isset($invoice) ? $invoice->id : $id; ?>" name="id" />
                                        <a href="<?php echo site_url('accounting/invoice'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('update'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  
                        <?php } ?>
                        
                    </div>
                </div>
            </div>
            <br>
            <br>
            <div style="height:120px"></div>
        </div>
    </div>
  </div>
<!-- bootstrap-datetimepicker -->
 <link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
 <script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>
 
<script type="text/javascript"> 
    
    $(document).ready(function(){
        $('.datepicker-month').datepicker({
            format: "mm-yyyy",
            startView: "months", 
            minViewMode: "months"
        });
    });
    
    $("#add_single_month").datepicker( {
        format: "mm-yyyy",
        startView: "months", 
        minViewMode: "months"
    });
    
    $("#add_bulk_month").datepicker( {
        format: "mm-yyyy",
        startView: "months", 
        minViewMode: "months"
    });
    
    $("#edit_month").datepicker( {
        format: "mm-yyyy",
        startView: "months", 
        minViewMode: "months"
    });
    
        function check_paid_status(paid_status, type) {

            if (paid_status == "paid") {                
                $('.fn_'+type+'_paid_status').show(); 
                $('#'+type+'_payment_method').prop('required', true);                
                
            } else{               
                $('.fn_'+type+'_paid_status').hide();  
                $('#'+type+'_payment_method').prop('required', false);               
            } 
        }
        
        function check_payment_method(payment_method, type) {

            if (payment_method == "cheque") {
                
                $('.fn_'+type+'_cheque').show();                
                $('#'+type+'_bank_name').prop('required', true);
                $('#'+type+'_cheque_no').prop('required', true);                
                
            } else{
               
                $('.fn_'+type+'_cheque').hide();  
                $('#'+type+'_bank_name').prop('required', false);
                $('#'+type+'_cheque_no').prop('required', false);               
            } 
        }
        
    
    <?php if(isset($edit)){ ?>
        get_student_by_class('<?php echo $invoice->class_id; ?>', '<?php echo $invoice->student_id; ?>', 'bulk');

    <?php } ?>
    
    function get_student_by_class(class_id, student_id, type){       
        
        $("select#"+type+"_student_id").prop('selectedIndex', 0);
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_student_by_class'); ?>",
            data   : { class_id : class_id , student_id : student_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                    $('#'+type+'_student_id').html(response);
               }
            }
        });                  
        
   }
   function get_class_sections(class_id) {
        
    	$.ajax({
            url: '<?php echo site_url('admin/get_class_section/');?>' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });

    }
    
    function get_student_by_class_sections(section_id) {
        var class_id = $('#add_class_id').val();
        if(class_id=='' || section_id==''){
            jQuery('#add_student_id').html('<option value="">Select</option>');
        }
    	$.ajax({
            url: '<?php echo site_url('admin/get_students_for_ssph/');?>' + class_id+'/'+section_id ,
            success: function(response)
            {
                jQuery('#add_student_id').html(response);
            }
        });

    }
   
   function get_fee_amount(income_head_id, type){
   
       if(!income_head_id) {
           $('#'+type+'_amount').val('');
           return false;
       }
       
       var class_id = $('#'+type+'_class_id').val();
       var student_id = $('#'+type+'_student_id').val();
   
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('invoice/get_fee_amount'); ?>",
            data   : { class_id : class_id , student_id : student_id, income_head_id : income_head_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {                    
                    $('input[name="tution_fee"]').val(response);
                    doCalculate();
               }
            }
        });
   }
   
   
   function get_student_and_fee_amount(income_head_id){
   
        if(!income_head_id) {
           $('#student_container').html('');
           $('.fn_check_button').hide();
           return false;
        }
       
        var class_id = $('#add_class_id').val();
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('invoice/get_student_and_fee_amount'); ?>",
            data   : { class_id : class_id , income_head_id : income_head_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {                    
                    $('#student_container').html(response);
                    $('#tution_fee').val(response);
                    $('.fn_check_button').show();
               }
               chequeFunction();
               $('.fn_check_button').show();
            }
        });
   }
   
   $('#check_all').on('click', function(){
        $('#student_container').children().find('input[type="checkbox"]').prop('checked', true);;
   });
   $('#uncheck_all').on('click', function(){
        $('#student_container').children().find('input[type="checkbox"]').prop('checked', false);;
   });
   

 </script>
 <!-- datatable with buttons -->
 <script type="text/javascript">
        $(document).ready(function() {
      
        
    $("#single").validate();     
    $("#bulk").validate(); 
    $("#edit").validate(); 
    });



    
</script>


<script>

    function chequeFunction(){
        $('#student_container .multi-check input').click(function(){
            if(this.checked){
                let checkName = $(this).attr('name');
                let studentName = $(this).attr('data-sname');
                var count = 0;
                $('.bank_name_list .bank_name_class').each(function(){
                    if($(this).attr('id') == checkName){
                       count++;
                    }
                    
                });

                if(count == 0){
                    // console.log(checkName);
                    // console.log($(this).attr('id'));
                    let bankName = $('.bank_name_clone').clone(true);                    
                    bankName.removeClass('bank_name_clone hidden');
                    bankName.addClass('bank_name_class');
                    bankName.attr('id',checkName);
                    bankName.attr('placeholder','Bank Name ' + studentName);
                    bankName.insertAfter('.bank_name_list .bank_name_class:last');

                    let chequeNumber = $('.cheque_number_clone').clone(true);
                    chequeNumber.removeClass('cheque_number_clone hidden');
                    chequeNumber.addClass('cheque_number_class');
                    chequeNumber.attr('id',checkName);
                    chequeNumber.attr('placeholder','Cheque Number ' + studentName);
                    chequeNumber.insertAfter('.cheque_number_list .cheque_number_class:last');
                }
                
            }
            else{
                let checkName = $(this).attr('name');
                $('.bank_name_list .bank_name_class').each(function(){
                    if($(this).attr('id') == checkName){
                        $(this).remove();
                    }
                });

                $('.cheque_number_list .cheque_number_class').each(function(){
                    if($(this).attr('id') == checkName){
                        $(this).remove();
                    }
                });
            }
        });

        $('#check_all').click(function(){

            $('#student_container .multi-check input').each(function(){


                let checkName = $(this).attr('name');
                let studentName = $(this).attr('data-sname');

                $('.cheque_number_list .cheque_number_class').each(function(){
                  if($(this).attr('id') == checkName){
                    $(this).remove();
                }  
                });

                $('.bank_name_list .bank_name_class').each(function(){
                  if($(this).attr('id') == checkName){
                    $(this).remove();
                }  
                });


                // console.log(checkName);
                // console.log($(this).attr('id'));
                let bankName = $('.bank_name_clone').clone(true);                    
                bankName.removeClass('bank_name_clone hidden');
                bankName.addClass('bank_name_class');
                bankName.attr('id',checkName);
                bankName.attr('placeholder','Bank Name ' + studentName);
                bankName.insertAfter('.bank_name_list .bank_name_class:last');

                let chequeNumber = $('.cheque_number_clone').clone(true);
                chequeNumber.removeClass('cheque_number_clone hidden');
                chequeNumber.addClass('cheque_number_class');
                chequeNumber.attr('id',checkName);
                chequeNumber.attr('placeholder','Cheque Number ' + studentName);
                chequeNumber.insertAfter('.cheque_number_list .cheque_number_class:last');

            });
        });


        $('#uncheck_all').click(function(){

            $('#student_container .multi-check input').each(function(){


                let checkName = $(this).attr('name');
                let studentName = $(this).attr('data-sname');
                console.log(checkName);
                $('.cheque_number_list .cheque_number_class').each(function(){
                  if($(this).attr('id') == checkName){
                    $(this).remove();
                }  
                });

                $('.bank_name_list .bank_name_class').each(function(){
                  if($(this).attr('id') == checkName){
                    $(this).remove();
                }  
                });
                
                // if($('.bank_name_list .bank_name_class').attr('id') == checkName){
                //     $('.bank_name_list .bank_name_class').attr('id').remove();
                // }   
                
            
            });
        });

    };
</script>
<script type="text/javascript">
var class_selection = "";

function select_section(class_id) {
	if(class_id !== ''){
		$.ajax({
			url: '<?php echo site_url('admin/get_section/'); ?>' + class_id,
			success:function (response)
			{

			jQuery('#section_holder').html(response);
			}
		});
	}
}
$('#single_bank_name, input[name="discount"]').on('keyup',function(){
   doCalculate();
});
function doCalculate(){
     var admission_fee = parseFloat($('[name="admission_fee"]').val())?parseFloat($('[name="admission_fee"]').val()):0;
    var tution_fee = parseFloat($('[name="tution_fee"]').val())?parseFloat($('[name="tution_fee"]').val()):0;
    var book_fee = parseFloat($('[name="book_fee"]').val())?parseFloat($('[name="book_fee"]').val()):0;
    var dress_fee = parseFloat($('[name="dress_fee"]').val())?parseFloat($('[name="dress_fee"]').val()):0;
    var education_fee = parseFloat($('[name="education_fee"]').val())?parseFloat($('[name="education_fee"]').val()):0;
    var event_fee = parseFloat($('[name="event_fee"]').val())?parseFloat($('[name="event_fee"]').val()):0;
    var hostel_fee = parseFloat($('[name="hostel_fee"]').val())?parseFloat($('[name="hostel_fee"]').val()):0;
    var discountValue = parseFloat($('[name="discount"]').val())?parseFloat($('[name="discount"]').val()):0;
    var total = admission_fee + tution_fee + book_fee + dress_fee + education_fee + event_fee + hostel_fee;
     $('[name="total_fee"]').val(total-discountValue);
}
</script>