<div class="content-wrapper">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">×</a>

            <div class="message"></div>
        </div>
        <div id="thermal_a" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">×</a>

            <div class="message"></div>
        </div>

        <div class="content-body">
            <section class="card">
                <div id="invoice-template" class="card-block">
                    <div class="row wrapper white-bg page-heading">


                    </div>

                    <!-- Invoice Company Details -->
                    <div id="invoice-company-details" class="row mt-2">
                         <div class="col-md-6 col-sm-12 text-xs-center text-left"><p></p>
                            <img src="http://desktop-22kuple/edurama_pos_full/edurama_pos/userfiles/company/logo.png" class="img-responsive p-1 m-b-2" style="max-height: 80px;">
<!-- <p class="ml-2">Edurama</p> -->
                        </div>
                        <div class="col-md-6 col-sm-12 text-xs-center text-right">
                            <h2>Sales Voucher</h2>
                            <p class="pb-1"> SRN #1018</p>
                            <p class="pb-1">Reference:</p>                            <ul class="px-0 list-unstyled">
                                <li>Gross Amount</li>
                                <li class="lead text-bold-800">Rs. 45</li>
                            </ul>
                        </div>
                    </div>
                    <!--/ Invoice Company Details -->

                    <!-- Invoice Customer Details -->
                    <div id="invoice-customer-details" class="row pt-2">
                        <div class="col-sm-12 text-xs-center text-left">
                            <p class="text-muted"> Bill To</p>
                        </div>
                        <div class="col-md-6 col-sm-12 text-xs-center text-left">
                            <ul class="px-0 list-unstyled">


                                <li class="text-bold-800"><a href="http://desktop-22kuple/edurama_pos_full/edurama_pos/customers/view?id=9"><strong class="invoice_a">Student No33</strong></a></li>
                                                <li>RFID No.: 54edf74</li><li> Phone: 561054390</li><li> Email: Student_No33@cyberworx.in                                </li>
                            </ul>

                        </div>
                        <div class="col-md-offset-3 col-md-3 col-sm-12 text-xs-center text-right">
                            <p><span class="text-muted">Invoice Date  :</span> 15-12-2018</p> <p><span class="text-muted">Due Date :</span> 15-12-2018</p>  <p><span class="text-muted">Terms :</span> Payment On Receipt</p>                        </div>
                    </div>
                    <!--/ Invoice Customer Details -->

                    <!-- Invoice Items Details -->
                    <div id="invoice-items-details" class="pt-2">
                        <div class="row">
                            <div class="table-responsive col-sm-12">
                                <table class="table table-striped">
                                                               <thead>
                                                                        <tr>
                                        <th>#</th>
                                        <th>Description</th>
                                        <th class="text-xs-left">Rate</th>
                                        <th class="text-xs-left">Qty</th>
                                        <th class="text-xs-left">Tax</th>
                                        <th class="text-xs-left"> Discount</th>
                                        <th class="text-xs-left">Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
<th scope="row">1</th>
                            <td>Banana Shakes -BNA001</td>                           
                            <td>Rs. 15</td>
                             <td>1</td>
                            <td>Rs. 2 (10%)</td>
                            <td>Rs. 2 (10%)</td>
                            <td>Rs. 15</td>
                        </tr><tr><td colspan="5"></td></tr><tr>
<th scope="row">2</th>
                            <td>Milk Shakes-MLK001</td>                           
                            <td>Rs. 15</td>
                             <td>1</td>
                            <td>Rs. 2 (10%)</td>
                            <td>Rs. 2 (10%)</td>
                            <td>Rs. 15</td>
                        </tr><tr><td colspan="5"></td></tr><tr>
<th scope="row">3</th>
                            <td>Pineapple Juice-PIN001</td>                           
                            <td>Rs. 15</td>
                             <td>1</td>
                            <td>Rs. 2 (10%)</td>
                            <td>Rs. 2 (10%)</td>
                            <td>Rs. 15</td>
                        </tr><tr><td colspan="5"></td></tr>
                                    </tbody>
                                                                    </table>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-md-7 col-sm-12 text-xs-center text-left">


                                <div class="row">
                                    <div class="col-md-8"><p class="lead">Payment Status:
                                            <u><strong id="pstatus"></strong></u>
                                        </p>
                                        <p class="lead">Payment Method: <u><strong id="pmethod">Cash</strong></u>
                                        </p>

                                        <p class="lead mt-1"><br>Note:</p>
                                        <code>
                                                                                    </code>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-12">
                                <p class="lead">Summary</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td>Sub Total</td>
                                            <td class="text-right"> Rs. 45</td>
                                        </tr>
                                        <tr>
                                            <td>Tax</td>
                                            <td class="text-right">Rs. 5</td>
                                        </tr>
                                        <tr>
                                            <td> Discount</td>
                                            <td class="text-right">Rs. 5</td>
                                        </tr>
                                        <tr>
                                            <td> Shipping</td>
                                            <td class="text-right">Rs. 0</td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold-800">Total</td>
                                            <td class="text-bold-800 text-right"> Rs. 45</td>
                                        </tr>
                                        <tr>
                                            <td>Payment Made</td>
                                            <td class="pink text-right">
                                                (-)  <span id="paymade">Rs. 45</span></td>
                                        </tr>
                                        <tr class="bg-grey bg-lighten-4">
                                            <td class="text-bold-800">Balance Due</td>
                                            <td class="text-bold-800 text-right">  <span id="paydue">Rs. 0</span></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center">
                                    <p>Authorized person</p>
                                    <img src="http://desktop-22kuple/edurama_pos_full/edurama_pos/userfiles/employee_sign/1544468374851211825.png" alt="signature" class="" style="max-width: 80px;">
                                    <h6>(BusinessOwner)</h6>
                                    <p class="text-muted">Business Owner</p>                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Invoice Footer -->

                </div>
            </section>
        </div>
    </div>