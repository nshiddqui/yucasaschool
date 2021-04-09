
<hr />

<?php 
  $card_amount = 0;
  $student_account = $this->db->get_where('student' , array(
        'student_id' => $student_id
    ))->row();
  $card_amount = $student_account->balance;
  /*if(sizeof($student_account) > 0){
   foreach ($student_account as $rows):
   $card_amount = $card_amount+$rows['card_amount'] ;  
  endforeach;
 }*/
?>
<?php
 $child_of_parent = $this->db->get_where('student' , array(
        'student_id' => $student_id
    ))->result_array();
 if(sizeof($child_of_parent) > 0){
    foreach ($child_of_parent as $row):

?>

<div class="row">
<div class="col-md-8 recharge_block ">
  <div class="current_balance row" style="padding:0 15px;">
    <table class="col-md-12">
      <tbody>
        <tr>
          <td class="balance_text" style="width: 70%;"> <span style="font-weight: 700;"><?php echo $row['name'];?> </span> Account Current Balance</td>
          <td class="balance_amount text-right" style="width: 30%">₹ <span> <?php echo $card_amount; ?></span></td>
        </tr>
        <tr>
          <td class="balance_text" style="width: 70%;">Added Balance</td>
          <td class="balance_amount text-right" style="width: 30%">₹ <span> <?php echo $amount; ?></span></td>
        </tr>
        
      </tbody>
    </table>
  </div>
  <hr>
  <form action="<?php echo site_url('admin/canteen_card_recharge_process/create');?>"  method="post"class="recharge_form">
    
   <div class="add_amount">
    <h4 class="pull-left" style="margin:0;"> Payment Type : </h4> &nbsp;
    
     <select name="payment_type" class="form-control"  id="recharge_method" required>
      <option value="">--select--</option>
      <option value = "1">method one</option>
     </select>
     <input type="hidden" name="student_id"  value="<?php echo $student_id;?>">
     <input type="hidden" name="amount" value="<?php echo $post_data['amount'];?>">
     <input type="hidden" name="class_id" value="<?php echo $post_data['class_id'];?>">
     <input type="hidden" name="section_id" value="<?php echo $post_data['section_id'];?>">
     <input type="hidden" name="student_id" value="<?php echo $post_data['student_id'];?>">
     <input type="hidden" name="description" value="<?php echo $post_data['description'];?>">
   </div>
   
  <div class="clearfix"></div>
     
  <button type="submit" name="submit" vlaue="submit_amount" class="recharge_button">Recharge Now</button>

  </form>



</div>

</div>
<?php endforeach;}?>

<script>

  $('.recharge_list li').click(function(){

    $('.recharge_list li').each(function(){
            
      $(this).removeClass('rechargeActive');
    
    });

    if($(this).hasClass('rechargeActive')){
      $(this).removeClass('rechargeActive');
    }

    else{
      $(this).addClass('rechargeActive');
      
    }

  });

  $('.amount_input').click(function(){
    $('.recharge_list li').each(function(){
            
      $(this).removeClass('rechargeActive');
    
    });
  });


</script>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->     
<script type="text/javascript">

 jQuery(document).ready(function($)
  {
   $('#table_export').dataTable();
  });



    function get_class_sections(class_id) {
          $.ajax({
            url: '<?php echo site_url('ajax/get_class_by_section/');?>',
            data: {'class_id':class_id},
            type   : "POST",
            success: function(response)
            {   
              jQuery('#section_id').html(response);
              get_student();
            }
         });
       
      }

    function get_student(){
      var class_id  = $('#class_id').val(); 
      var section_id  = $('#section_id').val(); 
        $.ajax({
          url: '<?php echo site_url('ajax/get_section_by_student/');?>',
          data: {'class_id':class_id,'section_id':section_id},
          type   : "POST",
          success: function(response)
          {   
           jQuery('#student_id').html(response);
          }
        });
      }


</script>


