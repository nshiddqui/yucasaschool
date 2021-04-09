<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('manage_account_report');?>
            	</div>
            </div>

   <?php  
   $class_id = '1';
   $month = '1';
   $sessional_year = '2020';
   ?>
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <span><p><h4><strong>Accounting Report</strong></h4></p></span>
                                <span><p><h4><strong><a href="<?php echo site_url('admin/export_account_excel/?class_id='.$class_id. '&month='.$month.'&sessional_year='.$sessional_year); ?>">Export Data</a></strong></h4></p></span>
                                <thead>
                                    <tr>
                                        <th>Serial_no</th>
                                     
                                        <th>Name</th>
                                        <th>POST</th>
                                        <th>DOJ</th>
                                                                            
                                        <th>Contact No</th>
                                        <th>Monthly Salary</th>
                                        <th>Total Advance Payment</th>
                                         <th>No of Present</th>
                                     
                                        <th>No of Absent</th>
                                        <th>Total Number of days In Month</th>
                                        <th>Total Payable Monthly Salary</th>
                                        <th>Status</th>

                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php
                                     
                           $designations = $this->db->get_where('designations', array('id' => $class_id
             ))->result_array();
      $designations_name = $designations[0]['name'];
                            //   if (!$this->db->table_exists(lcfirst($designations_name))){
                            //     continue;
                            // }
      $primary_id = lcfirst($designations_name)."_id";
      $number_of_days = cal_days_in_month(CAL_GREGORIAN, $month, $sessional_year);

         $this->db->select('*');
         $this->db->from(lcfirst($designations_name));
         $query = $this->db->get()->result_array();
         foreach ($query as $val){
                                     ?>
                                                                         
                                        <tr>
                                            <td><?php echo '' ?></td>
                                          
                                            <td><?php echo $val['name']; ?></td>                                           
                                            <td><?php echo $designations_name; ?></td>                                           
                                            <td><?php echo $val['doj']; ?> </td>
                                         <td><?php echo $val['phone']; ?> </td>
                                          
                                           <td><?php 

                                           $salary = $this->db->get_where('salary_payments', array('user_id' => $val[$primary_id]))->result_array();
                                            echo $salary[0]['basic_salary']; ?> </td>                                           
                                            <td><?php 
                                            $total_advance = $this->db->query('SELECT SUM(amount) as total FROM advance_pay WHERE YEAR(date) = '. $sessional_year . ' AND MONTH(date) = '. $month . ' AND designation_id ='. $class_id . ' AND employee_id = '. $val[$primary_id])->result_array();


                                             echo $total_advance[0]['total']; ?> </td>                                           
                                            <td><?php $total_present = $this->db->query('SELECT Count(status) as present FROM attendance_employee WHERE YEAR(date) = '. $sessional_year . ' AND MONTH(date) = '. $month .' AND designation_id = '. $class_id . ' AND employee_id = '. $val[$primary_id]. ' AND status = 1')->result_array();

                                            echo $total_present[0]['present']; ?> </td>
                                            <td><?php 
                                             
                                             $total_absent = $this->db->query('SELECT Count(status) as absent FROM attendance_employee WHERE YEAR(date) = '. $sessional_year . ' AND MONTH(date) = '. $month.' AND designation_id = '. $class_id . ' AND employee_id = '. $val[$primary_id].' AND status = 0' )->result_array();


                                            echo $total_absent[0]['absent']; ?> </td>
                                          
                                            <td><?php echo $number_of_days; ?> </td>

                                                                                                                            
                                           <td id="total:<?php echo $val[$primary_id]; ?>" contenteditable="true"><?php 
                                             $total_salary = $this->db->query('SELECT * FROM employee_total_salary WHERE YEAR(date) = '. $sessional_year . ' AND MONTH(date) = '. $month.' AND designation_id = '. $class_id . ' AND employee_id = '. $val[$primary_id])->result_array();
                                           echo $total_salary[0]['total_salary']; ?> </td>

                                           <td>
                                            <label><input type="radio" id="radio:<?php echo $val[$primary_id]; ?>" name ="radio:<?php echo $val[$primary_id]; ?>" value="0" <?php
                                               $total_salary = $this->db->query('SELECT * FROM employee_total_salary WHERE YEAR(date) = '. $sessional_year . ' AND MONTH(date) = '. $month.' AND designation_id = '. $class_id . ' AND employee_id = '. $val[$primary_id])->result_array();

                                             if($total_salary[0]['status'] == '0') { echo 'checked'; }else{ }  ?>  onclick="changeStatus(<?php echo $val[$primary_id]; ?>);">Paid</label> 
                                            <label><input type="radio" id="radio:<?php echo $val[$primary_id]; ?>" name ="radio:<?php echo $val[$primary_id]; ?>" value="1" <?php 
                                             $total_salary = $this->db->query('SELECT * FROM employee_total_salary WHERE YEAR(date) = '. $sessional_year . ' AND MONTH(date) = '. $month.' AND designation_id = '. $class_id . ' AND employee_id = '. $val[$primary_id])->result_array();
                                            if($total_salary[0]['status'] == '1') { echo 'checked'; } else{ }  ?>   onclick="changedisableStatus(<?php echo $val[$primary_id]; ?>);">unpaid</label>


                                            </td>
                                                                                      
                                        </tr>
                                   <?php } ?>
                                </tbody>
                            </table>

                            <input type="hidden" id = "class_id" name="class_id" value="<?php echo $class_id; ?>">
                            <input type="hidden" id = "year" name="year" value="<?php echo $sessional_year; ?>">
                            <input type="hidden" id = "month" name="month" value="<?php echo $month; ?>">
                       <script type="text/javascript">

                        function export_excel(){

                        var class_id = $("#class_id").val();
                        var month = $("#month").val();
                        var year = $("#year").val();

                         $.post('<?php echo site_url('admin/export_account_excel/'); ?>' , {
                        class_id: class_id,
                        month: month,
                        sessional_year: year,
                        }, function(response){
                            DownloadExcel( response[0].filecontent, response[0].filename  );

                                                 
                        
                        });
                      }


                      function changeStatus(user_id){

                        var class_id = $("#class_id").val();
                        var month = $("#month").val();
                        var year = $("#year").val();

                       $.post('<?php echo site_url('admin/change_account_status/'); ?>' , {
                        
                        month: month,
                        sessional_year: year,
                        designation_id:class_id,
                        user_id:user_id,
                        status:'0'
                        }, function(response){
                            alert("Account status Changed Sucessfully");                  
                        
                        });
                     }

                      function changedisableStatus(user_id){

                        
                        var month = $("#month").val();
                        var year = $("#year").val();
                        var designation_id = $("#class_id").val();

                       $.post('<?php echo site_url('admin/change_account_status/'); ?>' , {
                        month: month,
                        sessional_year: year,
                        user_id:user_id,
                        designation_id:designation_id,
                        status:'1'
                        }, function(response){
                            alert("Account status Changed Sucessfully");                  
                        
                        });
                     }


                      //download excel func
function DownloadExcel( file, filename) {
    //debugger;
    var blob = base64toBlob(file, "data:application/vnd.ms-excel;")
    if (typeof navigator !== "undefined" && navigator.msSaveOrOpenBlob) {
        return navigator.msSaveOrOpenBlob(blob, filename);
    }
    else{
        console.log("inside else of downloadexcel");
      var objectUrl = URL.createObjectURL(blob);
        var downloadLink = $("#downloadlink");
        downloadLink.href = objectUrl; //uri;
        downloadLink.download = filename;
       // document.body.appendChild(downloadLink);
       $(document).append(downloadLink);
    }
  }
  
  function base64toBlob(b64Data, contentType, sliceSize) {
    contentType = contentType || '';
    sliceSize = sliceSize || 512;
  
    var byteCharacters = atob(b64Data);
    var byteArrays = [];
  
    for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
      var slice = byteCharacters.slice(offset, offset + sliceSize);
  
      var byteNumbers = new Array(slice.length);
      for (var i = 0; i < slice.length; i++) {
        byteNumbers[i] = slice.charCodeAt(i);
      }
  
      var byteArray = new Uint8Array(byteNumbers);
  
      byteArrays.push(byteArray);
    }
    var blob = new Blob(byteArrays, {
      type: "application/vnd.ms-excel"
    });
    return blob;
  }
  // /download excel func
                           
                    $(function(){
                    //acknowledgement message
                     $("td[contenteditable=true]").blur(function(){
                        var class_id = $("#class_id").val();
                        var month = $("#month").val();
                        var year = $("#year").val();
                        var field_userid = $(this).attr("id") ;
                        var res = field_userid.split(":");
                        var user_id = res[1];
                        var advance = $(this).text() ;

                        //  $.ajax({
                        //  url: '<?php echo site_url('admin/get_section/'); ?>' + class_id,
                        //  success:function (response)
                        //     {
                        //         jQuery('#section_holder').html(response);
                        //     }
                        // });
                                         
                        $.post('<?php echo site_url('admin/update_advance_pay/'); ?>' , {
                        designation_id: class_id,
                        month: month,
                        year: year,
                        user_id:user_id,
                        advance_salary:advance
                        }, function(data){

                         alert("Salary Updated");
                         window.reload();
                        
                        });
                    });
                });
                       </script>

