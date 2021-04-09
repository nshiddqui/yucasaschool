<style>
    .fn_check_button{
        display: none;
    }
    .fn_bulk_cheque{
        display: none;
    }
</style>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          
                 <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_invoice_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="entypo-menu"></i>  <?php echo $this->lang->line('invoice'); ?> <?php echo $this->lang->line('list'); ?></a> </li>

                        <li class=""> </li>
                       </ul>
                    <br/>

                    <a href="<?php echo site_url('admin/export_school_income/'); ?>" target="_blank"><?php echo "Export School Income Report" ?></a>

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                   <h3 id="school_title">Total Net Income : <?php echo $sum_amount; echo "INR" ?> </h3>
                  </div>
                   
                       <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_invoice_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap datatable" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th><?php echo $this->lang->line('invoice'); ?> <?php echo $this->lang->line('number'); ?></th>
                                        <th><?php echo $this->lang->line('student'); ?></th>
                                        <th><?php echo $this->lang->line('class'); ?></th>
                                        <th><?php echo $this->lang->line('fee'); ?> <?php echo $this->lang->line('type'); ?></th>
                                        <th><?php echo $this->lang->line('gross_amount'); ?></th>
                                        <th><?php echo $this->lang->line('discount'); ?></th>
                                        <th><?php echo $this->lang->line('net_amount'); ?></th>
                                        <th><?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('status'); ?></th>
                                                                                    
                                    </tr>
                                </thead>
                                <tbody>   
                                  <?php 
                                      $count = 1; if(isset($invoices) && !empty($invoices)){ ?>
                                        <?php foreach($invoices as $obj){
                                        if(!$unpaid && $obj->paid_status=='paid'){
                                        ?> 
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $obj->custom_invoice_id; ?></td>
                                            <td><?php echo $obj->student_name; ?></td>
                                            <td><?php echo $obj->class_name; ?></td>
                                            <td><?php echo $obj->head; ?></td>
                                            <td><?php echo $obj->gross_amount; ?></td>
                                            <td><?php echo $obj->discount; ?></td>
                                            <td><?php echo $obj->net_amount; ?></td>
                                            <td><?php echo get_paid_status($obj->paid_status); ?></td>
                                            
                                       <?php } 
                                      }
                                    }?>     
                                </tbody>
                            </table>
                            </div>
                        </div>

                      