$(document).ready(function(){
  alert('working');
})

$(document).ready(function() {
  $('.datatable').DataTable( {
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
$("#add").validate();     
$("#edit").validate();     

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

function get_fee_amount(income_head_id, type){

   if(!income_head_id) {
       $('#'+type+'_amount').val('');
       return false;
   }
   
   var class_id = $('#'+type+'_class_id').val();
   var student_id = $('#'+type+'_student_id').val();

    $.ajax({       
        type   : "POST",
        url    : "<?php echo site_url('accounting/invoice/get_fee_amount'); ?>",
        data   : { class_id : class_id , student_id : student_id, income_head_id : income_head_id},               
        async  : false,
        success: function(response){                                                   
           if(response)
           {                    
                $('#'+type+'_amount').val(response);
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
   
    var class_id = $('#bulk_class_id').val();
    $.ajax({       
        type   : "POST",
        url    : "<?php echo site_url('accounting/invoice/get_student_and_fee_amount'); ?>",
        data   : { class_id : class_id , income_head_id : income_head_id},               
        async  : false,
        success: function(response){                                                   
           if(response)
           {                    
                $('#student_container').html(response);
                $('.fn_check_button').show();
           }
        }
    });
}

$('#check_all').on('click', function(){
    $('#student_container').children().find('input[type="checkbox"]').prop('checked', true);;
});
$('#uncheck_all').on('click', function(){
    $('#student_container').children().find('input[type="checkbox"]').prop('checked', false);;
});


 //----------md add-----------        
    function get_feetype_modal(feetype_id){
         
        $('.fn_feetype_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('accounting/feetype/get_single_feetype'); ?>",
          data   : {feetype_id : feetype_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_feetype_data').html(response);
             }
          }
       });
    }

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
    $("#add").validate();     
    $("#edit").validate();  

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
   
   function get_fee_amount(income_head_id, type){
   
       if(!income_head_id) {
           $('#'+type+'_amount').val('');
           return false;
       }
       
       var class_id = $('#'+type+'_class_id').val();
       var student_id = $('#'+type+'_student_id').val();
   
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('accounting/invoice/get_fee_amount'); ?>",
            data   : { class_id : class_id , student_id : student_id, income_head_id : income_head_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {                    
                    $('#'+type+'_amount').val(response);
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
       
        var class_id = $('#bulk_class_id').val();
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('accounting/invoice/get_student_and_fee_amount'); ?>",
            data   : { class_id : class_id , income_head_id : income_head_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {                    
                    $('#student_container').html(response);
                    $('.fn_check_button').show();
               }
            }
        });
   }
   
   $('#check_all').on('click', function(){
        $('#student_container').children().find('input[type="checkbox"]').prop('checked', true);;
   });
   $('#uncheck_all').on('click', function(){
        $('#student_container').children().find('input[type="checkbox"]').prop('checked', false);;
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
         
    function get_income_modal(income_id){
         
        $('.fn_income_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('accounting/income/get_single_income'); ?>",
          data   : {income_id : income_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_income_data').html(response);
             }
          }
       });
    }


  $('#add_date').datepicker();
  $('#edit_date').datepicker();
  
    function check_add_payment_method(payment_method) {

        if (payment_method == "cheque") {               
            $('.fn_add_cheque').show(); 
            $('#add_bank_name').prop('required', true);
            $('#add_cheque_no').prop('required', true);
        }else{
            $('.fn_add_cheque').hide();   
            $('#add_bank_name').prop('required', false);
            $('#add_cheque_no').prop('required', false);
        } 
    }
    function check_edit_payment_method(payment_method) {

        if (payment_method == "cheque") {               
            $('.fn_edit_cheque').show(); 
            $('#edit_bank_name').prop('required', true);
            $('#edit_cheque_no').prop('required', true);
        }else{
            $('.fn_edit_cheque').hide(); 
            $('#edit_bank_name').prop('required', false);
            $('#edit_cheque_no').prop('required', false);
        } 
    }
  
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
    $("#add").validate();     
    $("#edit").validate();  


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
    $("#add").validate();     
    $("#edit").validate();  


         
    function get_sms_modal(sms_id){
         
        $('.fn_sms_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('accounting/duefeesms/get_single_sms'); ?>",
          data   : {sms_id : sms_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_sms_data').html(response);
             }
          }
       });
    }

      
  <?php if(isset($message)){ ?>
        get_user_by_role('<?php echo $message->role_id; ?>', '<?php echo $message->receiver_id; ?>');        
    <?php } ?>
    
    function get_user_by_role(role_id, user_id){       
       
       if(role_id == <?php echo STUDENT; ?> || role_id == <?php echo GUARDIAN; ?>){
           $('.display').show();
           $('#class_id').prop('required', true);
           $("select#class_id").prop('selectedIndex', 0);
           $('#receiver_id').html('<option value="">--<?php echo $this->lang->line('select'); ?>--</option>'); 
       }else{
           get_user(role_id, '', user_id);
           $('#class_id').prop('required', false);
           $('.display').hide();
       }
       
       get_sms_template_by_role(role_id);
   }
   
   function get_user(role_id, class_id, user_id){
       
       if(role_id == ''){
           role_id = $('#role_id').val();
       }
       
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_user_by_role'); ?>",
            data   : { role_id : role_id , class_id: class_id, user_id:user_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   $('#receiver_id').html(response); 
               }
            }
        }); 
   }
   
      function get_sms_template_by_role(role_id){
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('/ajax/get_sms_template_by_role'); ?>",
            data   : { role_id : role_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   $('#fn_template').html(response); 
               }
            }
        }); 
   }
   
   function get_template(template){       
        $('#body').html(template);
   }
    
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
      
     $("#add").validate();  
     
     function limitText(text) {       
       $('.fn_countdown').text('<?php echo $this->lang->line('you_have_remain_character'); ?>:'+(160 - text.length));        
     }


         
    function get_email_modal(email_id){
         
        $('.fn_email_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('accounting/duefeeemail/get_single_email'); ?>",
          data   : {email_id : email_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_email_data').html(response);
             }
          }
       });
    }

  //$('#body').jqte();
   
  <?php if(isset($message)){ ?>
        get_user_by_role('<?php echo $message->role_id; ?>', '<?php echo $message->receiver_id; ?>');
        
    <?php } ?>
    
    function get_user_by_role(role_id, user_id){       
      
       if(role_id == <?php echo STUDENT; ?> || role_id == <?php echo GUARDIAN; ?>){
           $('.display').show();
           $('#class_id').prop('required', true);
           $("select#class_id").prop('selectedIndex', 0);
           $('#receiver_id').html('<option value="">--<?php echo $this->lang->line('select'); ?>--</option>'); 
       }else{
           get_user(role_id, '', user_id);
           $('#class_id').prop('required', false);
           $('.display').hide();
       }
       
       get_tag_by_role(role_id);
       get_email_template_by_role(role_id);
   }
   
   function get_user(role_id, class_id, user_id){
       
       if(role_id == ''){
           role_id = $('#role_id').val();
       }
       
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('/ajax/get_user_by_role'); ?>",
            data   : { role_id : role_id , class_id: class_id, user_id:user_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   $('#receiver_id').html(response); 
               }
            }
        }); 
   }
   
   function get_tag_by_role(role_id){
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('/ajax/get_tag_by_role'); ?>",
            data   : { role_id : role_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   $('#fn_tag').html(response+'[due_amount]'); 
               }
            }
        }); 
   }
   
   function get_email_template_by_role(role_id){
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('/ajax/get_email_template_by_role'); ?>",
            data   : { role_id : role_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   $('#fn_template').html(response); 
               }
            }
        }); 
   }
   
   function get_template(template){       
        //$('.jqte_editor').html(template);
        $('#body').html(template);
   }
   
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
    $("#add").validate();   

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
    $("#add").validate();     
    $("#edit").validate();

         
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
     
  $('#add_date').datepicker();
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
    $("#add").validate();     
    $("#edit").validate();  

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
    $("#add").validate();     
    $("#edit").validate();  


$(document).ready(function(){
          
        $('.fn_add_to_hostel').click(function(){
           
          var obj = $(this);  
          var user_id  = $(this).attr('id');         
          var hostel_id  = $('#hostel_id_'+user_id).val();         
          var room_id  = $('#room_id_'+user_id).val();
          
          if(hostel_id == ''){
               toastr.error('<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('hostel'); ?>'); 
               return false;
          }
          if(room_id == ''){
               toastr.error('<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('room_no'); ?>'); 
               return false;
          }
          
          $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('hostel/member/add_to_hostel'); ?>",
            data   : { user_id : user_id, hostel_id : hostel_id, room_id : room_id},               
            async  : false,
            success: function(response){ 
                if(response){
                    toastr.success('<?php echo $this->lang->line('update_success'); ?>');
                    obj.parents('tr').remove();
                }else{
                    toastr.error('<?php echo $this->lang->line('update_failed'); ?>'); 
                }
            }
        }); 
                      
       });       
   });
   
    
    function get_room_by_hostel(hostel_id, user_id){       
           
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_room_by_hostel'); ?>",
            data   : { hostel_id : hostel_id },               
            async  : false,
            success: function(response){                                                   
               if(response)
               {                  
                  $('#room_id_'+user_id).html(response);
               }
            }
        });         
    } 

        $(document).ready(function() {
          $('#datatable-responsive, .datatable-responsive').DataTable( {
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
    $("#add").validate();     
    $("#edit").validate();

         
    function get_employee_modal(employee_id){
         
        $('.fn_employee_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('hrm/employee/get_single_employee'); ?>",
          data   : {employee_id : employee_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_employee_data').html(response);
             }
          }
       });
    }
     
    $('#add_dob').datepicker();
    $('#add_joining_date').datepicker();
    $('#edit_dob').datepicker();
    $('#edit_joining_date').datepicker();
  
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
        
    $("#add").validate();     
    $("#edit").validate(); 


         
    function get_visitor_modal(visitor_id){
         
        $('.fn_visitor_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('visitor/get_single_visitor'); ?>",
          data   : {visitor_id : visitor_id},  
          success: function(response){                                                   
            if(response)
            {
               $('.fn_visitor_data').html(response);
            }
          }
       });
    }

     
  <?php if(isset($edit)){ ?>
        get_user_by_role('<?php echo $visitor->role_id; ?>', "<?php echo $visitor->user_id; ?>");
    <?php } ?>
    
    function get_user_by_role(role_id, user_id){       
           
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_user_by_role'); ?>",
            data   : { role_id : role_id , user_id: user_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   if(user_id != ''){
                       $('#edit_user_id').html(response); 
                   }else{
                        $('#add_user_id').html(response);                       
                   }
               }
            }
        });  
   }
    function check_out(visitor_id){       
           
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('visitor/visitor_check_out'); ?>",
            data   : { visitor_id : visitor_id},               
            async  : false,
            success: function(response){  
                if(response){
                     toastr.success('<?php echo $this->lang->line('update_success'); ?>');  
                      location.reload();
                }else{
                     toastr.error('<?php echo $this->lang->line('update_failed'); ?>');  
                }
                toastr.options = {
                "closeButton": true,               
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "showDuration": "400",
                "hideDuration": "400",
                "timeOut": "5000",              
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
              }               
            }
        });  
   }

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
    $("#add").validate();     
    $("#edit").validate(); 

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
        
     $("#generate").validate();


     
  get_tag_by_role(<?php echo STUDENT; ?>);
  function get_tag_by_role(role_id){
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('/ajax/get_tag_by_role'); ?>",
            data   : { role_id : role_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   $('.fn_add_tag').html(response); 
               }
            }
        }); 
   }


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
    $("#add").validate();     
    $("#edit").validate();     


     
      $(document).ready(function(){
          
        $('.fn_add_to_transport').click(function(){
           
          var obj = $(this);  
          var user_id  = $(this).attr('id');         
          var route_id  = $('#route_id_'+user_id).val();         
          var stop_id  = $('#stop_id_'+user_id).val();         
          if(route_id == ''){
               toastr.error('<?php echo $this->lang->line('please_select_a_route'); ?>'); 
               return false;
          }
          if(stop_id == ''){
               toastr.error('<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('bus_stop'); ?>'); 
               return false;
          }
          $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('transport/member/add_to_transport'); ?>",
            data   : { user_id : user_id, route_id : route_id, stop_id:stop_id},               
            async  : false,
            success: function(response){ 
                if(response){
                    toastr.success('<?php echo $this->lang->line('update_success'); ?>');
                    obj.parents('tr').remove();
                }else{
                    toastr.error('<?php echo $this->lang->line('update_failed'); ?>'); 
                }
            }
        }); 
                      
       });       
   });
   
    function get_bus_stop_by_route(route_id, user_id){       
           
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_bus_stop_by_route'); ?>",
            data   : { route_id : route_id },               
            async  : false,
            success: function(response){                                                   
               if(response)
               {                  
                  $('#stop_id_'+user_id).html(response);
               }
            }
        });         
    } 
   
        $(document).ready(function() {
          $('#datatable-responsive, .datatable-responsive').DataTable( {
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

     function add_more(fn_stop_container){
         var data = '<tr>'                
                    +'<td style="width:50%;">'                   
                    +'<input  class="form-control col-md-12 col-xs-12" style="width:auto;" type="text" name="stop_name[]" class="answer" placeholder="<?php echo $this->lang->line('stop_name'); ?>" />' 
                    +'</td>'
                    +'<td>'  
                    +'<input  class="form-control col-md-12 col-xs-12" style="width:auto;" type="text" name="stop_km[]" value="" placeholder="<?php echo $this->lang->line('stop_km'); ?>"/>'
                    +'</td>'
                    +'<td>'  
                    +'<input  class="form-control col-md-12 col-xs-12" style="width:auto;" type="text" name="stop_fare[]" value="" placeholder="<?php echo $this->lang->line('stop_fare'); ?>"/>'
                    +'</td>'
                    +'<td>'  
                    +'<a  class="btn btn-danger btn-md " onclick="remove(this);" style="margin-bottom: -0px;" > - </a>'
                    +'</td>'
                    +'</tr>';
            $('.'+fn_stop_container).append(data);
     }
     
     
     function remove(obj, stop_id){ 
        
        // remove stop from database
        if(stop_id)
        {
            if(confirm('<?php echo $this->lang->line('confirm_alert'); ?>')){
                $.ajax({       
                    type   : "POST",
                    url    : "<?php echo site_url('transport/route/remove_stop'); ?>",
                    data   : { stop_id : stop_id},               
                    async  : false,
                    success: function(response){                                                   
                       if(response)
                       {
                          $(obj).parent().parent('tr').remove();   
                       }
                    }
                });   
            }            
        }else{
            
            $(obj).parent().parent('tr').remove(); 
        }
     }
     
         
    function get_route_modal(route_id){
         
        $('.fn_route_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('transport/route/get_single_route'); ?>",
          data   : {route_id : route_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_route_data').html(response);
             }
          }
       });
    }

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
    $("#add").validate();     
    $("#edit").validate();

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
    $("#add").validate();     
    $("#edit").validate();

     
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
     
     
    function getPaymentModal(payment_id, payment_to){
         
         $('.modal-body').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
          $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('payroll/payment/get_single_payment'); ?>",
            data   : {payment_id : payment_id, payment_to :payment_to},  
            success: function(response){                                                   
               if(response)
               {
                  $('.modal-body').html(response);
               }
            }
         });
    }
    
       
    $("#add_salary_month").datepicker( {
        format: "mm-yyyy",
        startView: "months", 
        minViewMode: "months"
    });
    $("#edit_salary_month").datepicker( {
        format: "mm-yyyy",
        startView: "months", 
        minViewMode: "months"
    });
     
       
    
    $("#add").validate();     
    $("#edit").validate();   
    $('#payment').validate();
    
    
    $('.fn_add_claculate').on('keyup', function(){
        
        var type = $('#add_hidden_salary_type').val();
       
        if(type === 'monthly'){
           
            var basic_salary = $('#add_basic_salary').val() ? parseFloat($('#add_basic_salary').val()) : 0;
            var house_rent = $('#add_house_rent').val() ? parseFloat($('#add_house_rent').val()) : 0;
            var transport = $('#add_transport').val() ? parseFloat($('#add_transport').val()): 0;
            var medical = $('#add_medical').val() ? parseFloat($('#add_medical').val()) : 0;
            var bonus = $('#add_bonus').val() ? parseFloat($('#add_bonus').val()) : 0;
            
            var ot_hourly_rate = $('#add_over_time_hourly_rate').val() ? parseFloat($('#add_over_time_hourly_rate').val()) : 0;
            var ot_total_hour = $('#add_over_time_total_hour').val() ? parseFloat($('#add_over_time_total_hour').val()) : 0;
            $('#add_over_time_amount').val(ot_hourly_rate*ot_total_hour);       
            var ot_total_amount = $('#add_over_time_amount').val() ? parseFloat($('#add_over_time_amount').val()) : 0;
            
            
            var provident_fund = $('#add_provident_fund').val() ? parseFloat($('#add_provident_fund').val()) : 0;
            var penalty = $('#add_penalty').val() ? parseFloat($('#add_penalty').val()) : 0;

           $('#add_total_allowance').val(house_rent+transport+medical+bonus+ot_total_amount);       
            var total_allowance = $('#add_total_allowance').val() ? parseFloat($('#add_total_allowance').val()) : 0;

            $('#add_total_deduction').val(provident_fund+penalty);
            var total_deduction = $('#add_total_deduction').val() ? parseFloat($('#add_total_deduction').val()) : 0;

            $('#add_gross_salary').val(basic_salary+total_allowance);
            $('#add_net_salary').val((basic_salary+total_allowance)-total_deduction);
            
       }else{
           
            var hourly_rate = $('#add_hourly_rate').val() ? parseFloat($('#add_hourly_rate').val()) : 0;
            var total_hour = $('#add_total_hour').val() ? parseFloat($('#add_total_hour').val()) : 0;
          
            var bonus = $('#add_bonus').val() ? parseFloat($('#add_bonus').val()) : 0;
            var penalty = $('#add_penalty').val() ? parseFloat($('#add_penalty').val()) : 0;
            
            $('#add_total_allowance').val(bonus);       
            var total_allowance = $('#add_total_allowance').val() ? parseFloat($('#add_total_allowance').val()) : 0;

            $('#add_total_deduction').val(penalty);
            var total_deduction = $('#add_total_deduction').val() ? parseFloat($('#add_total_deduction').val()) : 0;

            $('#add_gross_salary').val((hourly_rate*total_hour)+total_allowance);
            $('#add_net_salary').val((hourly_rate*total_hour)+total_allowance-total_deduction);
       }
        
    });
    
    $('.fn_edit_claculate').on('keyup', function(){
        
        var type = $('#edit_hidden_salary_type').val();
       
        if(type === 'monthly'){
           
            var basic_salary = $('#edit_basic_salary').val() ? parseFloat($('#edit_basic_salary').val()) : 0;
            var house_rent = $('#edit_house_rent').val() ? parseFloat($('#edit_house_rent').val()) : 0;
            var transport = $('#edit_transport').val() ? parseFloat($('#edit_transport').val()): 0;
            var medical = $('#edit_medical').val() ? parseFloat($('#edit_medical').val()) : 0;
            var bonus = $('#edit_bonus').val() ? parseFloat($('#edit_bonus').val()) : 0;
            
            var ot_hourly_rate = $('#edit_over_time_hourly_rate').val() ? parseFloat($('#edit_over_time_hourly_rate').val()) : 0;
            var ot_total_hour = $('#edit_over_time_total_hour').val() ? parseFloat($('#edit_over_time_total_hour').val()) : 0;
            $('#edit_over_time_amount').val(ot_hourly_rate*ot_total_hour);       
            var ot_total_amount = $('#edit_over_time_amount').val() ? parseFloat($('#edit_over_time_amount').val()) : 0;
            
            
            var provident_fund = $('#edit_provident_fund').val() ? parseFloat($('#edit_provident_fund').val()) : 0;
            var penalty = $('#edit_penalty').val() ? parseFloat($('#edit_penalty').val()) : 0;

           $('#edit_total_allowance').val(house_rent+transport+medical+bonus+ot_total_amount);       
            var total_allowance = $('#edit_total_allowance').val() ? parseFloat($('#edit_total_allowance').val()) : 0;

            $('#edit_total_deduction').val(provident_fund+penalty);
            var total_deduction = $('#edit_total_deduction').val() ? parseFloat($('#edit_total_deduction').val()) : 0;

            $('#edit_gross_salary').val(basic_salary+total_allowance);
            $('#edit_net_salary').val((basic_salary+total_allowance)-total_deduction);
            
       }else{
           
            var hourly_rate = $('#edit_hourly_rate').val() ? parseFloat($('#edit_hourly_rate').val()) : 0;
            var total_hour = $('#edit_total_hour').val() ? parseFloat($('#edit_total_hour').val()) : 0;
          
            var bonus = $('#edit_bonus').val() ? parseFloat($('#edit_bonus').val()) : 0;
            var penalty = $('#edit_penalty').val() ? parseFloat($('#edit_penalty').val()) : 0;
            
            $('#edit_total_allowance').val(bonus);       
            var total_allowance = $('#edit_total_allowance').val() ? parseFloat($('#edit_total_allowance').val()) : 0;

            $('#edit_total_deduction').val(penalty);
            var total_deduction = $('#edit_total_deduction').val() ? parseFloat($('#edit_total_deduction').val()) : 0;

            $('#edit_gross_salary').val((hourly_rate*total_hour)+total_allowance);
            $('#edit_net_salary').val((hourly_rate*total_hour)+total_allowance-total_deduction);
       }
        
    });
    
    function check_payment_method(payment_method) {

         if (payment_method == "cheque") {
             
                $('.fn_cheque').show();                
                $('#bank_name').prop('required', true);
                $('#cheque_no').prop('required', true);                
                
            }else{         
                
                $('.fn_cheque').hide();  
                $('#bank_name').prop('required', false);
                $('#cheque_no').prop('required', false);                
            } 
        }
    
    <?php if(isset($payment_to) && isset($user_id)){ ?>
        get_user_list('<?php echo $payment_to; ?>', <?php echo $user_id; ?>)
    <?php } ?>
    function get_user_list(payment_to, user_id){
           
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_user_list_by_type'); ?>",
            data   : { payment_to : payment_to, user_id : user_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   $('#user_id').html(response); 
               }
            }
        }); 
   }   
         
    function get_grade_modal(grade_id){
         
        $('.fn_grade_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('payroll/grade/get_single_grade'); ?>",
          data   : {grade_id : grade_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_grade_data').html(response);
             }
          }
       });
    }

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
    $("#add").validate();     
    $("#edit").validate();   
    
    $('.fn_add_claculate').on('keyup', function(){
        
        var basic_salary = $('#add_basic_salary').val() ? parseFloat($('#add_basic_salary').val()) : 0;
        var house_rent = $('#add_house_rent').val() ? parseFloat($('#add_house_rent').val()) : 0;
        var transport = $('#add_transport').val() ? parseFloat($('#add_transport').val()): 0;
        var medical = $('#add_medical').val() ? parseFloat($('#add_medical').val()) : 0;
        var provident_fund = $('#add_provident_fund').val() ? parseFloat($('#add_provident_fund').val()) : 0;
        
       $('#add_total_allowance').val(house_rent+transport+medical);       
        var total_allowance = $('#add_total_allowance').val() ? parseFloat($('#add_total_allowance').val()) : 0;
        
        $('#add_total_deduction').val(provident_fund);
        var total_deduction = $('#add_total_deduction').val() ? parseFloat($('#add_total_deduction').val()) : 0;
        
        $('#add_gross_salary').val(basic_salary+total_allowance);
        $('#add_net_salary').val((basic_salary+total_allowance)-total_deduction);
        
    });
    
    $('.fn_edit_claculate').on('keyup', function(){
        
        var basic_salary = $('#edit_basic_salary').val() ? parseFloat($('#edit_basic_salary').val()) : 0;
        var house_rent = $('#edit_house_rent').val() ? parseFloat($('#edit_house_rent').val()) : 0;
        var transport = $('#edit_transport').val() ? parseFloat($('#edit_transport').val()): 0;
        var medical = $('#edit_medical').val() ? parseFloat($('#edit_medical').val()) : 0;
        var provident_fund = $('#edit_provident_fund').val() ? parseFloat($('#edit_provident_fund').val()) : 0;
        
       $('#edit_total_allowance').val(house_rent+transport+medical);       
        var total_allowance = $('#edit_total_allowance').val() ? parseFloat($('#edit_total_allowance').val()) : 0;
        
        $('#edit_total_deduction').val(provident_fund);
        var total_deduction = $('#edit_total_deduction').val() ? parseFloat($('#edit_total_deduction').val()) : 0;
        
        $('#edit_gross_salary').val(basic_salary+total_allowance);
        $('#edit_net_salary').val((basic_salary+total_allowance)-total_deduction);
        
    });

    function getPaymentModal(payment_id,payment_to){
         
         $('.modal-body').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
          $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('payroll/history/get_single_payment'); ?>",
            data   : {payment_id : payment_id, payment_to : payment_to},  
            success: function(response){                                                   
               if(response)
               {
                  $('.modal-body').html(response);
               }
            }
         });
    }

  
     
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

    <?php if(isset($payment_to) && isset($user_id)){ ?>
        get_user_list('<?php echo $payment_to; ?>', <?php echo $user_id; ?>)
    <?php } ?>
    function get_user_list(payment_to, user_id){
           
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_user_list_by_type'); ?>",
            data   : { payment_to : payment_to, user_id : user_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   $('#user_id').html(response); 
               }
            }
        }); 
   } 
   
   $('#payment').validate();

         
    function get_guardian_modal(guardian_id){
         
        $('.fn_guardian_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('guardian/get_single_guardian'); ?>",
          data   : {guardian_id : guardian_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_guardian_data').html(response);
             }
          }
       });
    }

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
   $("#add").validate();     
   $("#edit").validate();  


         
    function get_student_modal(student_id){
         
        $('.fn_student_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('student/get_single_student'); ?>",
          data   : {student_id : student_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_student_data').html(response);
             }
          }
       });
    }
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



         
    function get_event_modal(event_id){
         
        $('.fn_event_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('event/get_single_event'); ?>",
          data   : {event_id : event_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_event_data').html(response);
             }
          }
       });
    }

     
  $('#add_event_from').datepicker();
  $('#edit_event_from').datepicker();
  
  $('#add_event_to').datepicker();
  $('#edit_event_to').datepicker();
  
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
    $("#add").validate();     
    $("#edit").validate();  

function get_user_by_role(role_id, user_id){       
       
       if(role_id == <?php echo STUDENT; ?>){
           $('.display').show();
           $('#class_id').prop('required', true);
           $('#user_id').html('<option value="">--<?php echo $this->lang->line('select'); ?>--</option>'); 
       }else{
           get_user(role_id, '', user_id);
           $('#class_id').prop('required', false);
           $('.display').hide();
       }       
   }
   
   function get_user(role_id, class_id, user_id){
       
       if(role_id == ''){
           role_id = $('#role_id').val();
       }
       
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_user_by_role'); ?>",
            data   : { role_id : role_id , class_id: class_id, user_id:user_id, message:true},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   $('#user_id').html(response); 
               }
            }
        }); 
   }
   
    $("#add").validate({
        rules: {
        password: {
            required: true,
            minlength: 6
        },
        conf_password: {
            required: true,
            minlength: 6,
            equalTo: "#password"
        }
        }  
    }); 

// $('#add_template').jqte();
 // $('#edit_template').jqte();
  
  <?php if(isset($template) && !empty($template) ) { ?>
      get_tag_by_role('<?php echo $template->role_id ?>', 'edit');
  <?php } ?>
   
   function get_tag_by_role(role_id, type){
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_tag_by_role'); ?>",
            data   : { role_id : role_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   $('#fn_'+type+'_tag').html(response); 
               }
            }
        }); 
   }
   
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
    $("#add").validate();   
    $("#edit").validate(); 


    <?php if(isset($role_id)){ ?>
      get_user_by_role('<?php echo $role_id;  ?>', '<?php echo $class_id; ?>', '<?php echo $user_id; ?>');
    <?php } ?>
    function get_user_by_role(role_id, class_id, user_id){       
       
       if(role_id == <?php echo STUDENT; ?>){
           $('.display').show();
           $('#class_id').attr("required");
           $('#user_id').html('<option value="">--<?php echo $this->lang->line('select'); ?>--</option>'); 
           if(class_id !='' ){
                get_user(role_id, class_id, user_id);
           }
       }else{
           get_user(role_id, '', user_id);
           $('#class_id').removeAttr("required");
           $('.display').hide();
       }       
   }
   
   function get_user(role_id, class_id, user_id){
       
       if(role_id == ''){
           role_id = $('#role_id').val();
       }
       
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_user_by_role'); ?>",
            data   : { role_id : role_id , class_id: class_id, user_id:user_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   $('#user_id').html(response); 
               }
            }
        }); 
   }
   
   $('.fn_update_status').click(function(){
   
       var user_id = $(this).attr('id');    
       var status = $(this).attr('itemid');    
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/update_user_status'); ?>",
            data   : { user_id:user_id,  status : status },               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   toastr.success('Success'); 
                   location.reload();
               }
            }
        }); 
   });
    
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
        
     $("#activitylog").validate();  

function get_user_by_role(role_id, user_id){       
       
       if(role_id == <?php echo STUDENT; ?>){
           $('.display').show();
           $('#class_id').prop('required', true);
           $('#user_id').html('<option value="">--<?php echo $this->lang->line('select'); ?>--</option>'); 
       }else{
           get_user(role_id, '', user_id);
           $('#class_id').prop('required', false);
           $('.display').hide();
       }       
   }
   
   function get_user(role_id, class_id, user_id){
       
       if(role_id == ''){
           role_id = $('#role_id').val();
       }
       
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_user_by_role'); ?>",
            data   : { role_id : role_id , class_id: class_id, user_id:user_id, message:true},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   $('#user_id').html(response); 
               }
            }
        }); 
   }
   
    $("#add").validate({
        rules: {
        password: {
            required: true,
            minlength: 6
        },
        conf_password: {
            required: true,
            minlength: 6,
            equalTo: "#password"
        }
        }  
    }); 

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
    $("#add").validate();  
    $("#edit").validate();

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
          
          /* Permission */
        $('#fn_view').click(function(){
         if($(this).is(':checked')){           
             $(".fn_view").prop("checked", true);
         }else{
            $(".fn_view").prop("checked", false);
         }
        });
        $('#fn_add').click(function(){
           if($(this).is(':checked')){           
               $(".fn_add").prop("checked", true);
           }else{
              $(".fn_add").prop("checked", false);
           }
        });
        $('#fn_edit').click(function(){
           if($(this).is(':checked')){           
               $(".fn_edit").prop("checked", true);
           }else{
              $(".fn_edit").prop("checked", false);
           }
        });
        $('#fn_delete').click(function(){
           if($(this).is(':checked')){           
               $(".fn_delete").prop("checked", true);
           }else{
              $(".fn_delete").prop("checked", false);
           }
        });
          
        } );


<?php if(isset($template) && !empty($template) ) { ?>
      get_tag_by_role('<?php echo $template->role_id ?>', 'edit');
  <?php } ?>
   
   function get_tag_by_role(role_id, type){
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_tag_by_role'); ?>",
            data   : { role_id : role_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   $('#fn_'+type+'_tag').html(response); 
               }
            }
        }); 
   }
   
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
    $("#add").validate();   
    $("#edit").validate(); 

<?php if(isset($role_id)){ ?>
      get_user_by_role('<?php echo $role_id;  ?>', '<?php echo $class_id; ?>', '<?php echo $user_id; ?>');
    <?php } ?>
    function get_user_by_role(role_id, class_id, user_id){       
       
       if(role_id == <?php echo STUDENT; ?>){
           $('.display').show();
           $('#class_id').attr("required");
           $('#user_id').html('<option value="">--<?php echo $this->lang->line('select'); ?>--</option>'); 
           if(class_id !='' ){
                get_user(role_id, class_id, user_id);
           }
       }else{
           get_user(role_id, '', user_id);
           $('#class_id').removeAttr("required");
           $('.display').hide();
       }       
   }
   
   function get_user(role_id, class_id, user_id){
       
       if(role_id == ''){
           role_id = $('#role_id').val();
       }
       
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_user_by_role'); ?>",
            data   : { role_id : role_id , class_id: class_id, user_id:user_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   $('#user_id').html(response); 
               }
            }
        }); 
   }
   
   $('.fn_update_status').click(function(){
   
       var user_id = $(this).attr('id');    
       var status = $(this).attr('itemid');    
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/update_user_status'); ?>",
            data   : { user_id:user_id,  status : status },               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   toastr.success('Success'); 
                   location.reload();
               }
            }
        }); 
   });
    
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
        
     $("#user").validate(); 

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
        
       $("#add").validate();  
       $("#edit").validate();  




// //Function Added By Bhuvan
// $(document).ready(function(){

//   //Adding deleteNode button
//   $('.form-horizontal .form-group:not(:last)').append("<span class='removeNode col-md-2 pull-right' title='Delete Fields'><i class='fa fa-times'></i></span>");

//   $('.removeNode').click(function(){
//       var parentNode = $(this).parent().children('label').text();
//     if(confirm('Do you realy want to delete ' + parentNode + ' field')){
//       $(this).parent().remove();
//       alert(parentNode + ' filed deleted.')
//     }
//    });
// });


// $('.addField').click(function(){

//   $('.fieldBoxContainer').css('display','block');

  
// });

// $('#fieldType').change(function(){
//     let fieldType = $('#fieldType option:selected').val();
//     if(fieldType == 'textbox' || fieldType == 'textarea'){
//       $('.textBox').css('display','block');
//       $('.selectBox').css('display','none');
//       $('.saveField').css('display', 'block');
//     }

//     else if(fieldType == 'selectbox'){
//       $('.selectBox').css('display','block');
//       $('.textBox').css('display','none');
//       $('.saveField').css('display', 'block');
//     }

//     else if(fieldType == 'imageupload' || fieldType == 'documentupload' ){
//       $('.selectBox').css('display','none');
//       $('.textBox').css('display','none');
//       $('.saveField').css('display', 'block');

//     }
    
//   });


// var i = 2;
// $('.anotherOption').click(function(){
//   $('.optionList').append('<input type="text" class="form-control" name="option" data-validate="required"  value="" >');

// });

// $('#filedName').keyup(function(){
//   if(($(this).val()).length > 5){
//     $('#fieldType').removeAttr('disabled');
//     $('#fieldNameError').text('');

//   }

//   else {
//     $('#fieldType').attr('disabled','');
//     $('#fieldNameError').text('Minimum 6 words long');
//   }

  
// })


// $('.saveField').click(
//   function(){
//     //let fieldType = $('#fieldType option:selected').val();
//     addField();
// });


// function addField(filedType){
//   let fieldName = $('#filedName').val();
  
//   let fieldType = $('#fieldType option:selected').val();
    
//     var options;
  
//   $('.optionList input').each(function(){
//     options += '<option>'+$(this).val()+'</option>';
    
//   });

//   let textboxModule = '<div class="form-group"><label for="field-1" class="col-sm-3 control-label">'+fieldName+'</label><div class="col-sm-5"><input type="text" class="form-control" name="name" data-validate="required" value="" autofocus required><span class="removeNode col-md-2 pull-right" title="Delete Fields"><i class="fa fa-times"></i></span></div>';

//   let textareaModule = '<div class="form-group"><label for="field-1" class="col-sm-3 control-label">'+fieldName+'</label><div class="col-sm-5"><textarea ></textarea><span class="removeNode col-md-2 pull-right" title="Delete Fields"><i class="fa fa-times"></i></span></div>';

//   let imageuploadModule = '<div class="form-group"><label for="field-1" class="col-sm-3 control-label">'+fieldName+'</label><div class="col-sm-5"><div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden"><div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput"><img src="http://placehold.it/200x200" alt="..."></div><div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;"></div><div><span class="btn btn-white btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input name="userfile" accept="image/*" type="file"></span><a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a></div></div></div><span class="removeNode col-md-2 pull-right" title="Delete Fields"><i class="fa fa-times"></i></span></div>';

//   let documentuploadModule = '<div class="form-group"><label for="field-1" class="col-sm-3 control-label">'+fieldName+'</label><div class="col-sm-5"><div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden"><div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput"><img src="http://placehold.it/200x200" alt="..."></div><div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;"></div><div><span class="btn btn-white btn-file"><span class="fileinput-new">Select Document</span><span class="fileinput-exists">Change</span><input name="userfile" accept="image/*" type="file"></span><a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a></div></div></div><span class="removeNode col-md-2 pull-right" title="Delete Fields"><i class="fa fa-times"></i></span></div>';


//   let selectboxModule = '<div class="form-group fieldBox"><label for="field-2" class="col-sm-3 control-label">'+fieldName+'</label><div class="col-sm-5"><select name="" id="fieldType" class="form-control col-md-12" >'+options+'</select></div><span class="removeNode col-md-2 pull-right" title="Delete Fields"><i class="fa fa-times"></i></span></div>';


//   if(fieldType === 'textbox'){
//     $('.form-horizontal').append(textboxModule);
//   }

//   else if(fieldType == "textarea"){
//     $('.form-horizontal').append(textareaModule);
//   }

//   else if(fieldType == "selectbox"){
//     $('.form-horizontal').append(selectboxModule);
//   }


//   else if(fieldType == "imageupload"){
//     $('.form-horizontal').append(imageuploadModule);
//   }

//   else if(fieldType == "documentupload"){
//     $('.form-horizontal').append(documentuploadModule);
//   }

//   alert(fieldName + 'Field Addedd');
  
//   $('.fieldBoxContainer').css('display','none');

//   $('.removeNode').click(function(){
//       var parentNode = $(this).parent().children('label').text();
//     if(confirm('Do you realy want to delete ' + parentNode + ' field')){
//       $(this).parent().remove();
//       alert(parentNode + ' filed deleted.')
//     }
//    });

// } 