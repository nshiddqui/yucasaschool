<hr />

<div id="payslip">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<div class="container">
    <div class="row">
        <div class="col-xs-10 col-sm-10 col-md-12 col-xs-offset-1 col-sm-offset-1 col-md-offset-0" style="color: #000;">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 company-info">
                    <address>
                        <strong>KR Manglam</strong>
                        <br>
                        2135 Sunset Blvd
                        <br>
                        Los Angeles, CA 90026
                        <br>
                        <abbr title="Phone">P:</abbr> (213) 484-6829
                    </address>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-right date-info">
                    <p>
                        Date: 1st November, 2013
                    </p>
                    <p>
                        Payslip Number #: 34522677W
                    </p>
                </div>
            </div>
            <hr>
            <div class="row ">
                <div class="text-left employee-info col-md-12">
                    <div><strong>Employee Name :</strong>  <span>Alok</span> </div>
                    <div><strong>Employee ID : </strong><span>EF523655</span></div>
                    <div><strong>Designation :</strong>  <span>Alok</span> </div>
                   
                </div>
               
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12 salary-details">
                <table class="table table-bordered ">
                    <thead class="thead-light">
                        <th>Earnings</th>
                        <th></th>
                        <th>Deductions</th>
                        <th></th>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Basic & DA</td>
                            <td>5200</td>
                            <td>PF</td>
                            <td>1000</td>
                            
                        </tr>

                        <tr>
                            <td>HRA</td>
                            <td>3,000</td>
                            <td>ESI</td>
                            <td>300</td>
                        </tr>

                        <tr>
                            <td>Conveyance</td>
                            <td>500</td>
                            <td>Loan</td>
                            <td>-</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td>TSD/IT</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td><span>&nbsp;</span></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Total Addition</td>
                            <td>8,200</td>
                            <td>Total Deduction</td>
                            <td>1000</td>    
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><strong>Total Salary</strong></td>
                            <td>7200</td>
                        </tr>

                    </tbody>
                </table>
                </div>



               
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div><strong>Rupee Seven Thousand Two Hundred</strong></div>
                    <div class="col-md-6"><strong>Date</strong> : 26 November 2018</div>
                    <div class="col-md-6"><strong>Transfer Type</strong> : Bank Transfer</div>
                    <div class="col-md-6" style="margin-top: 20px;"><strong>Authorised Signatures</strong> </div>

                </div>
            </div>
        </div>
    </div>
</div>

<input type='button' id='btn' value='Print' onclick='printDiv();'>

<script>
    function printDiv() 
{

  var divToPrint=document.getElementById('payslip');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}
</script>