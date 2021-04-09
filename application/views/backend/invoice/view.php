<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-calculator"></i><small> <?php echo $this->lang->line('manage_invoice'); ?></small></h3>
               
                <div class="clearfix"></div>
            </div>
            <div class="x_content" id="invoice-print">
                <section class="content invoice profile_img text-left">
                         <!-- title row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-header  invoice-col">
                                <h1><?php echo $this->lang->line('invoice'); ?></h1>
                            </div>
                            <div class="col-sm-4 invoice-header  invoice-col">&nbsp;</div>
                            <div class="col-sm-4 invoice-header  invoice-col">
                                <img src="<?php echo base_url('uploads/logo.png');?>" alt="" width="70" />
                                <!-- <img src="<?php echo base_url('uploads/logo.png');?>"  style="max-height:60px;"/> -->
                            </div>
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <strong><?php echo $this->lang->line('school'); ?>:</strong>
                                <address>
                                    School Name :- <?php echo $this->db->get_where('settings', array('status'=>1,'type' => 'system_name'))->row()->description; ?>
                                    <br>Address :- <?php echo $this->db->get_where('settings', array('status'=>1,'type' => 'address'))->row()->description; ?>
                                    <br>Email :- <?php echo $this->db->get_where('settings', array('status'=>1,'type' => 'system_email'))->row()->description; ?>
                                    <br>Mobile :- <?php echo $this->db->get_where('settings', array('status'=>1,'type' => 'phone'))->row()->description; ?>
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <strong><?php echo $this->lang->line('student'); ?>:</strong>
                                <address>
                                    <?php echo $invoice->name; ?>
                                    <br><?php echo $invoice->address; ?>
                                    <br><?php echo $this->lang->line('class'); ?>: <?php echo $invoice->class_name; ?>
                                    <br><?php echo $this->lang->line('phone'); ?>: <?php echo $invoice->phone; ?>
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b><?php echo $this->lang->line('invoice'); ?> #<?php echo $invoice->custom_invoice_id; ?></b>                                                     
                                <br>
                                <b><?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('status'); ?>:</b> <span class="btn-success"><?php echo get_paid_status($invoice->paid_status); ?></span>
                                <br>
                                <b><?php echo $this->lang->line('date'); ?>:</b> <?php echo $invoice->created_at; ?>
                            </div>
                            <!-- /.col -->
                        </div>                       
                </section>
                <section class="content invoice">
                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th><?php echo $this->lang->line('fee_type'); ?></th>
                                        <th><?php echo $this->lang->line('amount'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>                                  
                                    <tr>
                                        <td  style="width:15%"><?php echo 1; ?></td>
                                        <td  style="width:60%"> <?php echo $invoice->head; ?></td>
                                        <td><?php echo $invoice->net_amount; ?></td>
                                    </tr>                                         
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                                                    
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <?php if($invoice->gross_amount){ ?>
                                        <tr>
                                            <th style="width:50%"><?php echo $this->lang->line('subtotal'); ?>:</th>
                                            <td><?php //echo $this->gsms_setting->currency_symbol; ?><?php echo $invoice->gross_amount; ?></td>
                                        </tr>
                                        <?php } ?>
                                         <?php if($invoice->inv_discount){ ?>
                                        <tr>
                                            <th><?php echo $this->lang->line('discount'); ?></th>
                                            <td><?php //echo $this->gsms_setting->currency_symbol; ?><?php  echo $invoice->inv_discount; ?></td>
                                        </tr>
                                        <?php } ?>
                                         <?php if($invoice->net_amount){ ?>
                                        <!--tr>
                                            <th><?php echo $this->lang->line('total'); ?>:</th>
                                            <td><?php //echo $this->gsms_setting->currency_symbol; ?><?php echo $invoice->net_amount; ?></td>
                                        </tr-->
                                        <?php } ?>
                                         <?php if($invoice->admission_fee){ ?>
                                        <tr>
                                            <th>Admission fee:</th>
                                            <td><?php //echo $this->gsms_setting->currency_symbol; ?><?php echo $invoice->admission_fee; ?></td>
                                        </tr>
                                        <?php } ?>
                                         <?php if($invoice->tution_fee){ ?>
                                        <tr>
                                            <th>Tution fee:</th>
                                            <td><?php //echo $this->gsms_setting->currency_symbol; ?><?php echo $invoice->tution_fee; ?></td>
                                        </tr>
                                        <?php } ?>
                                         <?php if($invoice->book_fee){ ?>
                                        <tr>
                                            <th>Book fee:</th>
                                            <td><?php //echo $this->gsms_setting->currency_symbol; ?><?php echo $invoice->book_fee; ?></td>
                                        </tr>
                                        <?php } ?>
                                         <?php if($invoice->dress_fee){ ?>
                                        <tr>
                                            <th>Dress fee:</th>
                                            <td><?php //echo $this->gsms_setting->currency_symbol; ?><?php echo $invoice->dress_fee; ?></td>
                                        </tr>
                                        <?php } ?>
                                         <?php if($invoice->education_fee){ ?>
                                        <tr>
                                            <th>Education fee:</th>
                                            <td><?php //echo $this->gsms_setting->currency_symbol; ?><?php echo $invoice->education_fee; ?></td>
                                        </tr>
                                        <?php } ?>
                                         <?php if($invoice->event_fee){ ?>
                                        <tr>
                                            <th>Event fee:</th>
                                            <td><?php //echo $this->gsms_setting->currency_symbol; ?><?php echo $invoice->event_fee; ?></td>
                                        </tr>
                                        <?php } ?>
                                         <?php if($invoice->total_fee){ ?>
                                        <tr>
                                            <th>Total fee:</th>
                                            <td><?php //echo $this->gsms_setting->currency_symbol; ?><?php echo $invoice->total_fee; ?></td>
                                        </tr>
                                        <?php } ?>
                                        <?php if($paid_amount){ ?>
                                        <tr>
                                            <th><?php echo $this->lang->line('paid'); ?> <?php echo $this->lang->line('amount'); ?>:</th>
                                            <td><?php //echo $this->gsms_setting->currency_symbol; ?><?php echo $paid_amount ? $paid_amount : 0.00; ?></td>
                                        </tr>
                                        <?php } ?>
                                        <!-- <?php if($invoice->net_amount-$paid_amount){ ?>-->
                                        <!--<tr>-->
                                        <!--    <th><?php echo $this->lang->line('due_amount'); ?>:</th>
                                            <td><span class="btn-danger" style="padding: 5px;"><?php //echo $this->gsms_setting->currency_symbol; ?><?php echo $invoice->net_amount-$paid_amount; ?></span></td>
                                        <!--</tr>-->
                                        <?php } ?>
                                        <?php if($invoice->paid_status == 'paid'){ ?>
                                            <tr>
                                                <th><?php echo $this->lang->line('paid'); ?> <?php echo $this->lang->line('date'); ?>:</th>
                                                <td><?php echo $invoice->created_at; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <button class="btn btn-default" onclick="printId('invoice-print');"><i class="fa fa-print"></i> <?php echo $this->lang->line('print'); ?></button>
                            <?php if($invoice->paid_status != 'paid'){ ?>
                                <a href="<?php echo site_url('payment/index/'.$invoice->inv_id); ?>"><button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> <?php echo $this->lang->line('submit'); ?> <?php echo $this->lang->line('payment'); ?></button></a>
                                <!--<button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>-->
                            <?php } ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

function printId(id){
        $('.no-print').hide();
        $('.sidebar-menu').hide();
        $('.footer_bg_block').hide();
        $('.main').hide();
        $('.top_header_bar').hide();
        window.print();
        $('.no-print').show();
        $('.sidebar-menu').show();
        $('.footer_bg_block').show();
        $('.main').show();
        $('.top_header_bar').show();
}

</script>
