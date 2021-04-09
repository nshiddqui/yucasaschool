<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css"/ >
        <title>Payment Details</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/cosmo/bootstrap.min.css" integrity="sha384-uhut8PejFZO8994oEgm/ZfAv0mW1/b83nczZzSwElbeILxwkN491YQXsCFTE6+nx" crossorigin="anonymous">
    </head>

    <body class="col-12">
        
    <?php
            
        require_once '../dompdf/src/Autoloader.php';
        Dompdf\Autoloader::register();
        
        
        // reference the Dompdf namespace
        use Dompdf\Dompdf;
        
    include('../wp-load.php');
    require_once "config.php";

    $type = "";
    $message = "";

    if (!empty($_POST["pay_now"])) {

        //print_r($_POST);
        $payment_id = $_POST['payment_id'];
        $email_address = $_POST['email_address'];
        $full_name = $_POST['full_name'];
        
        //print_r($_POST);
        require_once 'AuthorizeNetPayment.php';
        $authorizeNetPayment = new AuthorizeNetPayment();

        
        


        require_once "DBController.php";
        $dbController = new DBController();
        
        $payment_details = $dbController->runBaseQuery("select * from wp_transaction_amount where id = $payment_id");
        $_POST['amount'] = $payment_details[0]['amount']; 
        $user_id = $payment_details[0]['user_id'];
       // echo $user_id; 
        $user_details = $dbController->runBaseQuery("select user_nicename from wp_users where ID = $user_id");
        
        // GETTING BILLING DETAILS
        $billing_details = $dbController->runBaseQuery("select billing_name,billing_email,billing_phone,billing_address from billing_details where user_id = $user_id");
        
        $billing_name = $billing_details[0]['billing_name'];
        $billing_email = $billing_details[0]['billing_email'];
        $billing_phone = $billing_details[0]['billing_phone'];
        $billing_address = $billing_details[0]['billing_address'];
        
        
        //  GETTING BILLER  DETAILS
        $biller_details = $dbController->runBaseQuery("select biller_name,biller_email,biller_phone,biller_address from biller_details where id = 1");
        // print_r($biller_details);die;
        $biller_name = $biller_details[0]['biller_name'];
        $biller_email = $biller_details[0]['biller_email'];
        $biller_phone = $biller_details[0]['biller_phone'];
        $biller_address = $biller_details[0]['biller_address'];
        
        // GETTING INSTA HANDLE OF ATTENDEE
        if($payment_details[0]['payment_type'] == "attendees"){
        	$attendees_id = $payment_details[0]['attendees_id'];
            $attendees_id = explode('_',$attendees_id);
            
            $insta_handels = array();
            foreach($attendees_id as $attendee_id){
                $insta_handle_detail = $dbController->runBaseQuery("select insta_handle from wp_event_attendees where ID = $attendee_id" );
                array_push($insta_handels , $insta_handle_detail[0]['insta_handle']);
            }
            $insta_handels = implode(',',$insta_handels);
            // print_r($insta_handels);
            // die;
        }
                                                                
        // Get New User Status
        $new_user_data = $dbController->runBaseQuery("SELECT new_user FROM  wp_users WHERE id = $user_id");
       
        $new_user = $new_user_data[0]['new_user'];
         
        $user_details = $user_details[0]['user_nicename'];
        $_POST['user_name'] = $user_details;  
        
        // print_r($payment_details);
        $response = $authorizeNetPayment->chargeCreditCard($_POST);
        
        if ($response != null)
        {
            $tresponse = $response->getTransactionResponse();
        //   echo "<pre>"
        //print_r($response->getTransactionResponse());
        //     echo "</pre>";
        
        // IF PAYMENT IS SUCCESSFUL
            if (($tresponse != null) && ($tresponse->getResponseCode()=="1"))
            {   
                
                
                $transactionId = $tresponse->getTransId();

                
                $dbController->runBaseQuery("UPDATE wp_transaction_amount SET transaction_id = $transactionId WHERE id = $payment_id" );
                
                $payment_details = $dbController->runBaseQuery("select * from wp_transaction_amount where id = $payment_id");
               
                $authCode = $tresponse->getAuthCode();
                $paymentResponse = $tresponse->getMessages()[0]->getDescription();
                $reponseType = "success";
                $message = "This transaction has been approved. <br/> Charge Credit Card AUTH CODE : " . $tresponse->getAuthCode() .  " <br/>Charge Credit Card TRANS ID  : " . $tresponse->getTransId() . "\n";
                $event_id = $payment_details[0]['event_id'];
                $attendees_id = $payment_details[0]['attendees_id'];
                $attendees_id = explode('_',$attendees_id);
                $attendee_count = count($attendees_id);
                $date_defult = $payment_details[0]['date_defult'];
                $transaction_id = $payment_details[0]['transaction_id'];
                
                $event_details = $dbController->runBaseQuery("SELECT creater_name, 	event_hashtag, start_date,end_date FROM  wp_hashtag_events WHERE id = $event_id" );
                $creator_name = $event_details[0]['creater_name'];
                $event_hashtag = $event_details[0]['event_hashtag'];
                
               
                $start_date = $event_details[0]['start_date'];
                $end_date = $event_details[0]['end_date'];
                
                $amount_det = $payment_details[0]['amount'];
                
                $file_name = "inv_$payment_id";
                // $dbController->runBaseQuery("UPDATE  wp_transaction_amount SET invoice_id =  $file_name where id =  $payment_id");
                $dbController->runBaseQuery("UPDATE wp_transaction_amount SET invoice_id = '$file_name' WHERE  id = $payment_id" );
                
                
                if($payment_details[0]['payment_type'] == "event_add"){
                      $reg_type =  "Event Registration";
                    $item_count = '1';
                    $item_price = $amount_det;
                }
                     
                else{
                     $reg_type =  "Attendees Registration";
                    $item_count = $attendee_count;
                    $item_price = "24";
                   $insta_handle_text = " Insta Handles Added :";
                }
                 
                // GENERATE INVOICE AND AADING ATTACHMENT
                $html =
                    "<html>
                    <head>
    <style>
      .invoice-title h2,
      .invoice-title h3 {
        display: inline-block;
      }

      .table > tbody > tr > .no-line {
        border-top: none;
      }

      .table > thead > tr > .no-line {
        border-bottom: none;
      }
      .text-right {
        text-align: right;
      }
      .table > tbody > tr > .thick-line {
        border-top: 1px solid;
      }

      .container {
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
      }
      @media (min-width: 768px) {
        .container {
          width: 750px;
        }
      }
      @media (min-width: 992px) {
        .container {
          width: 970px;
        }
      }
      @media (min-width: 1200px) {
        .container {
          width: 1170px;
        }
      }

      .panel {
        margin-bottom: 20px;
        background-color: #fff;
        border: 1px solid transparent;
        border-radius: 4px;
        -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
      }
      .panel-body {
        padding: 15px;
      }
      .panel-heading {
        padding: 10px 15px;
        border-bottom: 1px solid transparent;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
      }
      .panel-heading > .dropdown .dropdown-toggle {
        color: inherit;
      }
      .panel-title {
        margin-top: 0;
        margin-bottom: 0;
        font-size: 16px;
        color: inherit;
      }
      .panel-title > a,
      .panel-title > small,
      .panel-title > .small,
      .panel-title > small > a,
      .panel-title > .small > a {
        color: inherit;
      }
      .panel-footer {
        padding: 10px 15px;
        background-color: #f5f5f5;
        border-top: 1px solid #ddd;
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px;
      }
      .panel > .list-group,
      .panel > .panel-collapse > .list-group {
        margin-bottom: 0;
      }
      .panel > .list-group .list-group-item,
      .panel > .panel-collapse > .list-group .list-group-item {
        border-width: 1px 0;
        border-radius: 0;
      }
      .panel > .list-group:first-child .list-group-item:first-child,
      .panel
        > .panel-collapse
        > .list-group:first-child
        .list-group-item:first-child {
        border-top: 0;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
      }
      .panel > .list-group:last-child .list-group-item:last-child,
      .panel
        > .panel-collapse
        > .list-group:last-child
        .list-group-item:last-child {
        border-bottom: 0;
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px;
      }
      .panel
        > .panel-heading
        + .panel-collapse
        > .list-group
        .list-group-item:first-child {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
      }
      .panel-heading + .list-group .list-group-item:first-child {
        border-top-width: 0;
      }
      .list-group + .panel-footer {
        border-top-width: 0;
      }
      .panel > .table,
      .panel > .table-responsive > .table,
      .panel > .panel-collapse > .table {
        margin-bottom: 0;
      }
      .panel > .table caption,
      .panel > .table-responsive > .table caption,
      .panel > .panel-collapse > .table caption {
        padding-right: 15px;
        padding-left: 15px;
      }
      .panel > .table:first-child,
      .panel > .table-responsive:first-child > .table:first-child {
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
      }
      .panel > .table:first-child > thead:first-child > tr:first-child,
      .panel
        > .table-responsive:first-child
        > .table:first-child
        > thead:first-child
        > tr:first-child,
      .panel > .table:first-child > tbody:first-child > tr:first-child,
      .panel
        > .table-responsive:first-child
        > .table:first-child
        > tbody:first-child
        > tr:first-child {
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
      }
      .panel
        > .table:first-child
        > thead:first-child
        > tr:first-child
        td:first-child,
      .panel
        > .table-responsive:first-child
        > .table:first-child
        > thead:first-child
        > tr:first-child
        td:first-child,
      .panel
        > .table:first-child
        > tbody:first-child
        > tr:first-child
        td:first-child,
      .panel
        > .table-responsive:first-child
        > .table:first-child
        > tbody:first-child
        > tr:first-child
        td:first-child,
      .panel
        > .table:first-child
        > thead:first-child
        > tr:first-child
        th:first-child,
      .panel
        > .table-responsive:first-child
        > .table:first-child
        > thead:first-child
        > tr:first-child
        th:first-child,
      .panel
        > .table:first-child
        > tbody:first-child
        > tr:first-child
        th:first-child,
      .panel
        > .table-responsive:first-child
        > .table:first-child
        > tbody:first-child
        > tr:first-child
        th:first-child {
        border-top-left-radius: 3px;
      }
      .panel
        > .table:first-child
        > thead:first-child
        > tr:first-child
        td:last-child,
      .panel
        > .table-responsive:first-child
        > .table:first-child
        > thead:first-child
        > tr:first-child
        td:last-child,
      .panel
        > .table:first-child
        > tbody:first-child
        > tr:first-child
        td:last-child,
      .panel
        > .table-responsive:first-child
        > .table:first-child
        > tbody:first-child
        > tr:first-child
        td:last-child,
      .panel
        > .table:first-child
        > thead:first-child
        > tr:first-child
        th:last-child,
      .panel
        > .table-responsive:first-child
        > .table:first-child
        > thead:first-child
        > tr:first-child
        th:last-child,
      .panel
        > .table:first-child
        > tbody:first-child
        > tr:first-child
        th:last-child,
      .panel
        > .table-responsive:first-child
        > .table:first-child
        > tbody:first-child
        > tr:first-child
        th:last-child {
        border-top-right-radius: 3px;
      }
      .panel > .table:last-child,
      .panel > .table-responsive:last-child > .table:last-child {
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px;
      }
      .panel > .table:last-child > tbody:last-child > tr:last-child,
      .panel
        > .table-responsive:last-child
        > .table:last-child
        > tbody:last-child
        > tr:last-child,
      .panel > .table:last-child > tfoot:last-child > tr:last-child,
      .panel
        > .table-responsive:last-child
        > .table:last-child
        > tfoot:last-child
        > tr:last-child {
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px;
      }
      .panel
        > .table:last-child
        > tbody:last-child
        > tr:last-child
        td:first-child,
      .panel
        > .table-responsive:last-child
        > .table:last-child
        > tbody:last-child
        > tr:last-child
        td:first-child,
      .panel
        > .table:last-child
        > tfoot:last-child
        > tr:last-child
        td:first-child,
      .panel
        > .table-responsive:last-child
        > .table:last-child
        > tfoot:last-child
        > tr:last-child
        td:first-child,
      .panel
        > .table:last-child
        > tbody:last-child
        > tr:last-child
        th:first-child,
      .panel
        > .table-responsive:last-child
        > .table:last-child
        > tbody:last-child
        > tr:last-child
        th:first-child,
      .panel
        > .table:last-child
        > tfoot:last-child
        > tr:last-child
        th:first-child,
      .panel
        > .table-responsive:last-child
        > .table:last-child
        > tfoot:last-child
        > tr:last-child
        th:first-child {
        border-bottom-left-radius: 3px;
      }
      .panel
        > .table:last-child
        > tbody:last-child
        > tr:last-child
        td:last-child,
      .panel
        > .table-responsive:last-child
        > .table:last-child
        > tbody:last-child
        > tr:last-child
        td:last-child,
      .panel
        > .table:last-child
        > tfoot:last-child
        > tr:last-child
        td:last-child,
      .panel
        > .table-responsive:last-child
        > .table:last-child
        > tfoot:last-child
        > tr:last-child
        td:last-child,
      .panel
        > .table:last-child
        > tbody:last-child
        > tr:last-child
        th:last-child,
      .panel
        > .table-responsive:last-child
        > .table:last-child
        > tbody:last-child
        > tr:last-child
        th:last-child,
      .panel
        > .table:last-child
        > tfoot:last-child
        > tr:last-child
        th:last-child,
      .panel
        > .table-responsive:last-child
        > .table:last-child
        > tfoot:last-child
        > tr:last-child
        th:last-child {
        border-bottom-right-radius: 3px;
      }
      .panel > .panel-body + .table,
      .panel > .panel-body + .table-responsive,
      .panel > .table + .panel-body,
      .panel > .table-responsive + .panel-body {
        border-top: 1px solid #ddd;
      }
      .panel > .table > tbody:first-child > tr:first-child th,
      .panel > .table > tbody:first-child > tr:first-child td {
        border-top: 0;
      }
      .panel > .table-bordered,
      .panel > .table-responsive > .table-bordered {
        border: 0;
      }
      .panel > .table-bordered > thead > tr > th:first-child,
      .panel
        > .table-responsive
        > .table-bordered
        > thead
        > tr
        > th:first-child,
      .panel > .table-bordered > tbody > tr > th:first-child,
      .panel
        > .table-responsive
        > .table-bordered
        > tbody
        > tr
        > th:first-child,
      .panel > .table-bordered > tfoot > tr > th:first-child,
      .panel
        > .table-responsive
        > .table-bordered
        > tfoot
        > tr
        > th:first-child,
      .panel > .table-bordered > thead > tr > td:first-child,
      .panel
        > .table-responsive
        > .table-bordered
        > thead
        > tr
        > td:first-child,
      .panel > .table-bordered > tbody > tr > td:first-child,
      .panel
        > .table-responsive
        > .table-bordered
        > tbody
        > tr
        > td:first-child,
      .panel > .table-bordered > tfoot > tr > td:first-child,
      .panel
        > .table-responsive
        > .table-bordered
        > tfoot
        > tr
        > td:first-child {
        border-left: 0;
      }
      .panel > .table-bordered > thead > tr > th:last-child,
      .panel > .table-responsive > .table-bordered > thead > tr > th:last-child,
      .panel > .table-bordered > tbody > tr > th:last-child,
      .panel > .table-responsive > .table-bordered > tbody > tr > th:last-child,
      .panel > .table-bordered > tfoot > tr > th:last-child,
      .panel > .table-responsive > .table-bordered > tfoot > tr > th:last-child,
      .panel > .table-bordered > thead > tr > td:last-child,
      .panel > .table-responsive > .table-bordered > thead > tr > td:last-child,
      .panel > .table-bordered > tbody > tr > td:last-child,
      .panel > .table-responsive > .table-bordered > tbody > tr > td:last-child,
      .panel > .table-bordered > tfoot > tr > td:last-child,
      .panel
        > .table-responsive
        > .table-bordered
        > tfoot
        > tr
        > td:last-child {
        border-right: 0;
      }
      .panel > .table-bordered > thead > tr:first-child > td,
      .panel
        > .table-responsive
        > .table-bordered
        > thead
        > tr:first-child
        > td,
      .panel > .table-bordered > tbody > tr:first-child > td,
      .panel
        > .table-responsive
        > .table-bordered
        > tbody
        > tr:first-child
        > td,
      .panel > .table-bordered > thead > tr:first-child > th,
      .panel
        > .table-responsive
        > .table-bordered
        > thead
        > tr:first-child
        > th,
      .panel > .table-bordered > tbody > tr:first-child > th,
      .panel
        > .table-responsive
        > .table-bordered
        > tbody
        > tr:first-child
        > th {
        border-bottom: 0;
      }
      .panel > .table-bordered > tbody > tr:last-child > td,
      .panel > .table-responsive > .table-bordered > tbody > tr:last-child > td,
      .panel > .table-bordered > tfoot > tr:last-child > td,
      .panel > .table-responsive > .table-bordered > tfoot > tr:last-child > td,
      .panel > .table-bordered > tbody > tr:last-child > th,
      .panel > .table-responsive > .table-bordered > tbody > tr:last-child > th,
      .panel > .table-bordered > tfoot > tr:last-child > th,
      .panel
        > .table-responsive
        > .table-bordered
        > tfoot
        > tr:last-child
        > th {
        border-bottom: 0;
      }
      .panel > .table-responsive {
        margin-bottom: 0;
        border: 0;
      }
      .panel-group {
        margin-bottom: 20px;
      }
      .panel-group .panel {
        margin-bottom: 0;
        border-radius: 4px;
      }
      .panel-group .panel + .panel {
        margin-top: 5px;
      }
      .panel-group .panel-heading {
        border-bottom: 0;
      }
      .panel-group .panel-heading + .panel-collapse > .panel-body,
      .panel-group .panel-heading + .panel-collapse > .list-group {
        border-top: 1px solid #ddd;
      }
      .panel-group .panel-footer {
        border-top: 0;
      }
      .panel-group .panel-footer + .panel-collapse .panel-body {
        border-bottom: 1px solid #ddd;
      }
      .panel-default {
        border-color: #ddd;
      }
      .panel-default > .panel-heading {
        color: #333;
        background-color: #f5f5f5;
        border-color: #ddd;
      }
      .panel-default > .panel-heading + .panel-collapse > .panel-body {
        border-top-color: #ddd;
      }
      .panel-default > .panel-heading .badge {
        color: #f5f5f5;
        background-color: #333;
      }
      .panel-default > .panel-footer + .panel-collapse > .panel-body {
        border-bottom-color: #ddd;
      }
      .panel-primary {
        border-color: #337ab7;
      }
      .panel-primary > .panel-heading {
        color: #fff;
        background-color: #337ab7;
        border-color: #337ab7;
      }
      .panel-primary > .panel-heading + .panel-collapse > .panel-body {
        border-top-color: #337ab7;
      }
      .panel-primary > .panel-heading .badge {
        color: #337ab7;
        background-color: #fff;
      }
      .panel-primary > .panel-footer + .panel-collapse > .panel-body {
        border-bottom-color: #337ab7;
      }
      .panel-success {
        border-color: #d6e9c6;
      }
      .panel-success > .panel-heading {
        color: #3c763d;
        background-color: #dff0d8;
        border-color: #d6e9c6;
      }
      .panel-success > .panel-heading + .panel-collapse > .panel-body {
        border-top-color: #d6e9c6;
      }
      .panel-success > .panel-heading .badge {
        color: #dff0d8;
        background-color: #3c763d;
      }
      .panel-success > .panel-footer + .panel-collapse > .panel-body {
        border-bottom-color: #d6e9c6;
      }
      .panel-info {
        border-color: #bce8f1;
      }
      .panel-info > .panel-heading {
        color: #31708f;
        background-color: #d9edf7;
        border-color: #bce8f1;
      }
      .panel-info > .panel-heading + .panel-collapse > .panel-body {
        border-top-color: #bce8f1;
      }
      .panel-info > .panel-heading .badge {
        color: #d9edf7;
        background-color: #31708f;
      }
      .panel-info > .panel-footer + .panel-collapse > .panel-body {
        border-bottom-color: #bce8f1;
      }
      .panel-warning {
        border-color: #faebcc;
      }
      .panel-warning > .panel-heading {
        color: #8a6d3b;
        background-color: #fcf8e3;
        border-color: #faebcc;
      }
      .panel-warning > .panel-heading + .panel-collapse > .panel-body {
        border-top-color: #faebcc;
      }
      .panel-warning > .panel-heading .badge {
        color: #fcf8e3;
        background-color: #8a6d3b;
      }
      .panel-warning > .panel-footer + .panel-collapse > .panel-body {
        border-bottom-color: #faebcc;
      }
      .panel-danger {
        border-color: #ebccd1;
      }
      .panel-danger > .panel-heading {
        color: #a94442;
        background-color: #f2dede;
        border-color: #ebccd1;
      }
      .panel-danger > .panel-heading + .panel-collapse > .panel-body {
        border-top-color: #ebccd1;
      }
      .panel-danger > .panel-heading .badge {
        color: #f2dede;
        background-color: #a94442;
      }
      .panel-danger > .panel-footer + .panel-collapse > .panel-body {
        border-bottom-color: #ebccd1;
      }
      table {
        background-color: transparent;
      }
      caption {
        padding-top: 8px;
        padding-bottom: 8px;
        color: #777;
        text-align: left;
      }
      th {
        text-align: left;
      }
      .table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
      }
      .table > thead > tr > th,
      .table > tbody > tr > th,
      .table > tfoot > tr > th,
      .table > thead > tr > td,
      .table > tbody > tr > td,
      .table > tfoot > tr > td {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
      }
      .table > thead > tr > th {
        vertical-align: bottom;
        border-bottom: 2px solid #ddd;
      }
      .table > caption + thead > tr:first-child > th,
      .table > colgroup + thead > tr:first-child > th,
      .table > thead:first-child > tr:first-child > th,
      .table > caption + thead > tr:first-child > td,
      .table > colgroup + thead > tr:first-child > td,
      .table > thead:first-child > tr:first-child > td {
        border-top: 0;
      }
      .table > tbody + tbody {
        border-top: 2px solid #ddd;
      }
      .table .table {
        background-color: #fff;
      }
      .table-condensed > thead > tr > th,
      .table-condensed > tbody > tr > th,
      .table-condensed > tfoot > tr > th,
      .table-condensed > thead > tr > td,
      .table-condensed > tbody > tr > td,
      .table-condensed > tfoot > tr > td {
        padding: 5px;
      }
      .table-bordered {
        border: 1px solid #ddd;
      }
      .table-bordered > thead > tr > th,
      .table-bordered > tbody > tr > th,
      .table-bordered > tfoot > tr > th,
      .table-bordered > thead > tr > td,
      .table-bordered > tbody > tr > td,
      .table-bordered > tfoot > tr > td {
        border: 1px solid #ddd;
      }
      .table-bordered > thead > tr > th,
      .table-bordered > thead > tr > td {
        border-bottom-width: 2px;
      }
      .table-striped > tbody > tr:nth-of-type(odd) {
        background-color: #f9f9f9;
      }
      .table-hover > tbody > tr:hover {
        background-color: #f5f5f5;
      }
      table col[class*='col-'] {
        position: static;
        display: table-column;
        float: none;
      }
      table td[class*='col-'],
      table th[class*='col-'] {
        position: static;
        display: table-cell;
        float: none;
      }
      .table > thead > tr > td.active,
      .table > tbody > tr > td.active,
      .table > tfoot > tr > td.active,
      .table > thead > tr > th.active,
      .table > tbody > tr > th.active,
      .table > tfoot > tr > th.active,
      .table > thead > tr.active > td,
      .table > tbody > tr.active > td,
      .table > tfoot > tr.active > td,
      .table > thead > tr.active > th,
      .table > tbody > tr.active > th,
      .table > tfoot > tr.active > th {
        background-color: #f5f5f5;
      }
      .table-hover > tbody > tr > td.active:hover,
      .table-hover > tbody > tr > th.active:hover,
      .table-hover > tbody > tr.active:hover > td,
      .table-hover > tbody > tr:hover > .active,
      .table-hover > tbody > tr.active:hover > th {
        background-color: #e8e8e8;
      }
      .table > thead > tr > td.success,
      .table > tbody > tr > td.success,
      .table > tfoot > tr > td.success,
      .table > thead > tr > th.success,
      .table > tbody > tr > th.success,
      .table > tfoot > tr > th.success,
      .table > thead > tr.success > td,
      .table > tbody > tr.success > td,
      .table > tfoot > tr.success > td,
      .table > thead > tr.success > th,
      .table > tbody > tr.success > th,
      .table > tfoot > tr.success > th {
        background-color: #dff0d8;
      }
      .table-hover > tbody > tr > td.success:hover,
      .table-hover > tbody > tr > th.success:hover,
      .table-hover > tbody > tr.success:hover > td,
      .table-hover > tbody > tr:hover > .success,
      .table-hover > tbody > tr.success:hover > th {
        background-color: #d0e9c6;
      }
      .table > thead > tr > td.info,
      .table > tbody > tr > td.info,
      .table > tfoot > tr > td.info,
      .table > thead > tr > th.info,
      .table > tbody > tr > th.info,
      .table > tfoot > tr > th.info,
      .table > thead > tr.info > td,
      .table > tbody > tr.info > td,
      .table > tfoot > tr.info > td,
      .table > thead > tr.info > th,
      .table > tbody > tr.info > th,
      .table > tfoot > tr.info > th {
        background-color: #d9edf7;
      }
      .table-hover > tbody > tr > td.info:hover,
      .table-hover > tbody > tr > th.info:hover,
      .table-hover > tbody > tr.info:hover > td,
      .table-hover > tbody > tr:hover > .info,
      .table-hover > tbody > tr.info:hover > th {
        background-color: #c4e3f3;
      }
      .table > thead > tr > td.warning,
      .table > tbody > tr > td.warning,
      .table > tfoot > tr > td.warning,
      .table > thead > tr > th.warning,
      .table > tbody > tr > th.warning,
      .table > tfoot > tr > th.warning,
      .table > thead > tr.warning > td,
      .table > tbody > tr.warning > td,
      .table > tfoot > tr.warning > td,
      .table > thead > tr.warning > th,
      .table > tbody > tr.warning > th,
      .table > tfoot > tr.warning > th {
        background-color: #fcf8e3;
      }
      .table-hover > tbody > tr > td.warning:hover,
      .table-hover > tbody > tr > th.warning:hover,
      .table-hover > tbody > tr.warning:hover > td,
      .table-hover > tbody > tr:hover > .warning,
      .table-hover > tbody > tr.warning:hover > th {
        background-color: #faf2cc;
      }
      .table > thead > tr > td.danger,
      .table > tbody > tr > td.danger,
      .table > tfoot > tr > td.danger,
      .table > thead > tr > th.danger,
      .table > tbody > tr > th.danger,
      .table > tfoot > tr > th.danger,
      .table > thead > tr.danger > td,
      .table > tbody > tr.danger > td,
      .table > tfoot > tr.danger > td,
      .table > thead > tr.danger > th,
      .table > tbody > tr.danger > th,
      .table > tfoot > tr.danger > th {
        background-color: #f2dede;
      }
      .table-hover > tbody > tr > td.danger:hover,
      .table-hover > tbody > tr > th.danger:hover,
      .table-hover > tbody > tr.danger:hover > td,
      .table-hover > tbody > tr:hover > .danger,
      .table-hover > tbody > tr.danger:hover > th {
        background-color: #ebcccc;
      }
      .table-responsive {
        min-height: 0.01%;
        overflow-x: auto;
      }
      @media screen and (max-width: 767px) {
        .table-responsive {
          width: 100%;
          margin-bottom: 15px;
          overflow-y: hidden;
          -ms-overflow-style: -ms-autohiding-scrollbar;
          border: 1px solid #ddd;
        }
        .table-responsive > .table {
          margin-bottom: 0;
        }
        .table-responsive > .table > thead > tr > th,
        .table-responsive > .table > tbody > tr > th,
        .table-responsive > .table > tfoot > tr > th,
        .table-responsive > .table > thead > tr > td,
        .table-responsive > .table > tbody > tr > td,
        .table-responsive > .table > tfoot > tr > td {
          white-space: nowrap;
        }
        .table-responsive > .table-bordered {
          border: 0;
        }
        .table-responsive > .table-bordered > thead > tr > th:first-child,
        .table-responsive > .table-bordered > tbody > tr > th:first-child,
        .table-responsive > .table-bordered > tfoot > tr > th:first-child,
        .table-responsive > .table-bordered > thead > tr > td:first-child,
        .table-responsive > .table-bordered > tbody > tr > td:first-child,
        .table-responsive > .table-bordered > tfoot > tr > td:first-child {
          border-left: 0;
        }
        .table-responsive > .table-bordered > thead > tr > th:last-child,
        .table-responsive > .table-bordered > tbody > tr > th:last-child,
        .table-responsive > .table-bordered > tfoot > tr > th:last-child,
        .table-responsive > .table-bordered > thead > tr > td:last-child,
        .table-responsive > .table-bordered > tbody > tr > td:last-child,
        .table-responsive > .table-bordered > tfoot > tr > td:last-child {
          border-right: 0;
        }
        .table-responsive > .table-bordered > tbody > tr:last-child > th,
        .table-responsive > .table-bordered > tfoot > tr:last-child > th,
        .table-responsive > .table-bordered > tbody > tr:last-child > td,
        .table-responsive > .table-bordered > tfoot > tr:last-child > td {
          border-bottom: 0;
        }
      }
    </style>
    </head>
                    <body>

                    
                    <div class='container'>
                        <div class=''>
                        <div class='table-responsive'>
                                <table class='table table-condensed'>
                                    <tbody>
 
                                    <tr>
                                            <td>
                                                    
                                                    <div class=' text-left'>
                                                         
                                                       <img src='/home/ngr7kjzd5vhq/public_html/hashtagbooks/wp-content/uploads/2019/01/hashtag-book-solutions-logo.png' height='100px'/>
                                                    </div>
        
                                                </td>
        
                                              <td>  
                                                
                                                    
                                                    <div class=' text-right' style='font-size:13px'>
                                                        <h2>Invoice</h2>
                                                        <address>
                                                          <strong>Biller Details:</strong><br />
                                                          
                                                          $biller_name<br>
                                                          $biller_address<br>
                                                          Email: $biller_email<br>
                                                          Phone no.: $biller_phone<br>
                                                          
                                                        </address>
                                                      </div>
                                                </td>
                                        </tr>
                                        
                                        
                                        <tr>
                                            <td>
                                                    
        
                                                <div class=''>
                                                    <address>
                                                      <strong>Billed To:</strong><br />
                                                      
                                                      $billing_name<br>
                                                      $billing_address<br>
                                                      Phone no.: $billing_phone<br>
                                                      Email: $billing_email<br>
                                                     
                                                    </address>
                                                  </div></td>
        
                                                  <td>
                                                      
                                                        <div class=' text-right'>
                                                                <h3 class=''>Order # $file_name</h3>
                                                        <div>
                                                            <strong>Order Date:</strong><br />
                                                            $date_defult<br /><br />
                                                        </div>
                                            
                                                     
                                                        </div>
                                                    </td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>  
                        
                        <div class='row'>
                        	<div class=''>
                        		<div class='panel panel-default'>
                        			<div class='panel-heading'>
                        				<h3 class='panel-title'><strong>Order summary</strong></h3>
                        			</div>
                        			<div class='panel-body'>
                        				<div class='table-responsive'>
                        					<table class='table table-condensed'>
                        						<thead>
                                                    <tr>
                            							<td><strong>Payment Type</strong></td>
                            							<td class='text-center'><strong>Price</strong></td>
                            							<td class='text-center'><strong>Number</strong></td>
                            							<td class='text-right'><strong>Total</strong></td>
                                                    </tr>
                        						</thead>
                        						<tbody>
                        						
                        							<tr>
                        								<td>$reg_type <br><br>
                            								<strong>Event Details</strong><br>
                            								<span>Hashtag : $event_hashtag</span><br>
                            								<span>Start Date : $start_date</span><br>
                            								<span>End Date : $end_date</span><br>
                            								
                            								<strong>$insta_handle_text</strong><br>
                            	                            <span> $insta_handels </span>
                        								</td>
                        								<td class='text-center'>USD $item_price</td>
                        								<td class='text-center'>$item_count</td>
                        								<td class='text-right'>USD $amount_det</td>
                        							</tr>
                                                    
                        							
                        						
                        							<tr>
                        								<td class='thick-line'></td>
                        								<td class='thick-line'></td>
                        								<td class='thick-line text-center'><strong>Total</strong></td>
                        								<td class='thick-line text-right'>USD $amount_det</td>
                        							</tr>
                        						</tbody>
                        					</table>
                        				</div>
                        			</div>
                        		</div>
                        	</div>
                        </div>
                        <br><br><br>
                        <div class='text-right'>
                            <p>Note : This is a system generated invoice and doesn’t require any signature</p>
                        </div>
                    </div>
                    </body></html>";
                
                
                // instantiate and use the dompdf class
                $dompdf = new Dompdf();
                $dompdf->loadHtml($html);
                
                // (Optional) Setup the paper size and orientation
                $dompdf->setPaper('A4', 'portrait');
                
                // Render the HTML as PDF
                $dompdf->render();
                $dompdf->output();
                // Output the generated PDF to Browser
                //$dompdf->stream();
                
                
               // print_r($dompdf->output());
                file_put_contents("../invoices/$file_name.pdf", $dompdf->output());
                $attachments = array("../invoices/$file_name.pdf");
        
                if($payment_details[0]['payment_type'] == "attendees"){
                    
                    $admin_email = get_option('admin_email');
                
                    $to = $email_address;
                    $billing_to = $billing_email;
                    $subject = "Payment Success - Hashtag Books";
                    $message = "<div>
                        Hi, <br/><br/>
                        <div>This mail is to convey the successful payment for $attendee_count attendees added by you on HashTag Books event. Details are as follows:</div><br/>
                        <div><strong>Event Hashtag</strong> : $event_hashtag</div>
                        <div><strong>Creator Name</strong> : $creator_name</div>
                        <div><strong>Event Start Date</strong> : $start_date</div>
                        <div><strong>Event End Date</strong> : $end_date</div><br>
                        <div><strong>Log in to your account by <a href='http://cyberworxgroup.com/hashtagbooks/login'> clicking here  </a>to view details..</strong></div>
                        <br/><br/>
                        <div>Regards</div>
                        <div>Hashtag Books Team</div>
                
                </div>";
                $headers = array('Content-Type: text/html; charset=UTF-8; From: ".$admin_email." ');
                        
                wp_mail( $billing_to, $subject, $message, $headers,$attachments );
                
                
                foreach($attendees_id as $attendee_id){
                    
                        $dbController->runBaseQuery("UPDATE wp_event_attendees SET t_id = 1 WHERE  id = $attendee_id");
                        
                        $attendees_detail = $dbController->runBaseQuery("SELECT email, name FROM  wp_event_attendees WHERE id = $attendee_id" );
                        
                        $attendees_name = $attendees_detail[0]['name'];
                        $attendees_email = $attendees_detail[0]['email'];
                        
                        $admin_email = get_option('admin_email');
                
                        $to = $attendees_email;
                        $subject = "Attendee Registration - Hashtag Books";
                        $message = "<div>
                            Hi $attendees_name,  <br/> <br/>
                            <div>You have been added as an attendee for an event at HashTag Books. Details of the event are as follows:</div><br/>
                            <div><strong>Event Hashtag</strong> : $event_hashtag</div>
                            <div><strong>Creator Name</strong> : $creator_name</div>
                            <div><strong>Event Start Date</strong> : $start_date</div>
                            <div><strong>Event End Date</strong> : $end_date</div><br>
                            
                            <br/>
                            <div>Regards</div>
                            <div>Hashtag Books Team</div>
                        
                        </div>";
        
                        $headers = array('Content-Type: text/html; charset=UTF-8; From: ".$admin_email." ');
                    
                        wp_mail( $to, $subject, $message, $headers );
                    }
                }
                    
                    
                if($payment_details[0]['payment_type'] == "event_add"){
                    
                    $dbController->runBaseQuery("UPDATE wp_hashtag_events SET payment_status = 1 WHERE  id = $event_id");
                    
                        // MAIL PARAMETERS
                    $admin_email = get_option('admin_email');
                    
                    $to = $email_address;
                    $billing_to = $billing_email;
                    $subject = "Payment Success - Hashtag Books";
                    $message = "<div>
                        Hi, <br/><br/>
                        <div>This mail is to convey the successful payment for event created by you on hashtag books. Details are as follows:</div><br/>
                        <div><strong>Event Hashtag</strong> : $event_hashtag</div>
                        <div><strong>Creator Name</strong> : $creator_name</div>
                        <div><strong>Event Start Date</strong> : $start_date</div>
                        <div><strong>Event End Date</strong> : $end_date</div><br>
                        <div><strong>log in to your account by clicking  <a href='http://cyberworxgroup.com/hashtagbooks/login'>here</a> to add attendees to your event.</strong></div>
                        <br/><br/>
                        <div>Regards</div>
                        <div>Hashtag Books Team</div>
                    
                    </div>";
    
                    $headers = array('Content-Type: text/html; charset=UTF-8; From: ".$admin_email." ');
                
                    wp_mail( $billing_to, $subject, $message, $headers,$attachments );
                    
                    if($new_user == 0){
                        // USER REGISTRATION MAIL

                        $registered__mail__subject = "Registration Successful - Hashtag Books";
                        $registered__mail__body = "Hi $user_name, <br><br>
                        Thank you for registering with Hashtag Books. Please log into your account to view event details, add attendees & much more. 
                        <br/><br/>
                            <div>Regards</div>
                            <div>Hashtag Books Team</div>
                        ";
            
                        // Send Register Mail
                        wp_mail($to, $registered__mail__subject , $registered__mail__body, $headers);
                        
                        // update new user status
                        $dbController->runBaseQuery("UPDATE wp_users SET new_user = 1 WHERE  id = $user_id" );
                    }
                    
                    
                    
                }

                $status = 1;
            }
            
            // If PAYMENT FAILS
            else
            {
                $authCode = "";
                $paymentResponse = $tresponse->getErrors()[0]->getErrorText();
                $reponseType = "error";
                $message = "Charge Credit Card ERROR :  Invalid response\n";
                $status = 0;
                
                
                if($payment_details[0]['payment_type'] == "attendees"){            
                    
                    // DELETE ADDED ATTENDEE
                    $attendees_id = $payment_details[0]['attendees_id'];
                    $attendees_id = explode('_',$attendees_id);
                        
                    foreach($attendees_id as $attendee_id){
                        $attendees_detail = $dbController->runBaseQuery("DELETE  FROM  wp_event_attendees WHERE id = $attendee_id" );
                    }
                
                    $admin_email = get_option('admin_email');
                    $to = $email_address;
                    $subject = "Payment Failure - Hashtag Books";
                    $message = "Hi $user_name, \n
                        This email is to inform you about payment failure for adding attendees. Please try again.
                        <br>
                        <br>
                        Regards,<br>
                        Hashtag Books Team";
                    $headers = array(
                            'From: '.$admin_email.' ', 
                            'Content-Type : text/html'
            
                        );
                    wp_mail($to, $subject, strip_tags($message), $headers);
                }
                
                
                if($payment_details[0]['payment_type'] == "event_add"){
                    
                    //  DELETE USER ACCOUNT IF NEW USER
                    if($new_user == 0){
                        $dbController->runBaseQuery("DELETE FROM wp_users WHERE  id = $user_id" );
                    }
                    
                    // DELETE EVENT IF PAMENT FAILED
                    $dbController->runBaseQuery("DELETE FROM  wp_hashtag_events WHERE id = $event_id" );
                    
                    $admin_email = get_option('admin_email');
                    $to = $email_address;
                    $subject = "Payment Failure - Hashtag Books";
                    $message = "Hi $user_name, <br>
                        This mail is to convey the Failure payment for event created by you on hashtag books. You can try creating your event again by visiting this <a href='<?php echo site_url(); ?>/event-registration'>link</a>.
                        <br><br/><br/>
                        <div><strong>Regards</strong></div>
                        <div><strong>Hashtag Books Team</strong></div>
                        ";
                    $headers = array(
                            'From: '.$admin_email.' ', 
                            'Content-Type : text/html'
            
                        );
                    wp_mail($to, $subject, $message, $headers);
                }
                
                
            }
            
            $transactionId = $tresponse->getTransId();
            $responseCode  = $tresponse->getResponseCode();
            $paymentStatus = $authorizeNetPayment->responseText[$tresponse->getResponseCode()];
            
            
            $param_type = 'sssdss';
            
            $param_value_array = array(
                $transactionId,
                $authCode,
                $responseCode,
                $_POST["amount"],
                $paymentStatus,
                $paymentResponse
            );
        
        
            
            $query = "INSERT INTO tbl_authorizenet_payment (transaction_id, auth_code, response_code, amount, payment_status, payment_response) values (?, ?, ?, ?, ?, ?)";
            $id    = $dbController->insert($query, $param_type, $param_value_array);
            
            $param_type = 'dd';
            
            $transactionId = $tresponse->getTransId();
            $param_value_array_update = array(
                $transactionId,
                $payment_id
            );
            
            $query = "UPDATE wp_transaction_amount SET transaction_id = ? WHERE id = ?";
            $dbController->update($query,$param_type,$param_value_array_update);
            
            $dbController->update("UPDATE wp_transaction_amount SET payment_status = 1 WHERE id = $payment_id");
            
        }


        else
        {
            $reponseType = "error";
            $message= "Charge Credit Card Null response returned";
        }
    }
    ?>  
        <!-- IF PAYMENT IS SUCCESSFUL -->
        <?php if( $status == 1){
            
            
            
             if($payment_details[0]['payment_type'] == "event_add"){ ?>
    
                <div class="col-8 mx-auto text-center" style='margin-top:10%;'>
                    <h1 class="display-3 mt-5" style="color:#3FB618;font-weight:700;">Thank you!</h1>
                    <p class="lead"><strong>Your payment was successful.</strong>  Please check your email for further instructions on how to add attendees.</p>
                    <hr>
                   
                    <p>
                        You will now be redirected to your Event History Page. 
                    </p>
                </div>
            <?php }
            
            else{ ?>
             <div class="col-8 mx-auto text-center" style='margin-top:10%;'>
                    <h1 class="display-3 mt-5" style="color:#3FB618;font-weight:700;">Thank You!</h1>
                    <p class="lead"><strong> Your payment was successful.</strong> Please check your email for further information.</p>
                    <hr>
                  
                    <p>
                       You will now be redirected to your Event History Page.
                    </p>
                </div>
                <?php
            }
            
            
            header( "refresh:5; url=event-list" ); 
        }

        // IF PAYMENT IS Failure
        if( $status == 0){ ?>
            <div class="col-8 mx-auto text-center" style='margin-top:10%;'>
                <h1 class="display-3 mt-5 " style="color:#FF0039;font-weight:700;">Payment Failed!</h1>
                <p class="lead"><strong>Your payment failed.</strong> Please try again.</p>
                <hr>
  
                <p>
                    You will be redirected in 5 seconds..
                </p>
            </div>
        <?php  if($new_user == 1) {header( "refresh:5;url=event-list" );} else {header( "refresh:5;url= http://cyberworxgroup.com/hashtagbooks/" );};
        } ?>
        <!--<?php if(!empty($message)) { ?>-->
        <!--<div id="response-message" class="<?php echo $reponseType; ?>">-->
            
        <!--    <?php echo $message; ?>-->
        
        
        <!--</div>-->
        <!--<?php  } ?>-->
        <script src="vendor/jquery/jquery-3.2.1.min.js"
            type="text/javascript"></script>
        <script>
history.pushState(null, null, location.href);
    var disableBackButtonInThisPage = true;
    window.onpopstate = function () {
        if (disableBackButtonInThisPage) {
            history.go(1);
        }else{
            history.go(-1);
        }
    };
    function toggleDisable() {
        disableBackButtonInThisPage = !disableBackButtonInThisPage;
        alert("Disable back button is: " + disableBackButtonInThisPage);
    }
        </script>
    </body>
</html>