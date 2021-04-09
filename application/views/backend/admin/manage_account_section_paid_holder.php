<?php
$month = isset($_POST['month'])? $_POST['month']:'';
$designation_id = isset($_POST['designation_id'])?$_POST['designation_id']:'';
$session_year = isset($_POST['sessional_year']) ? $_POST['sessional_year'] : '';
if($month == 'all'){
    $datefrm = $session_year . '-01-01';
    $dateto = $session_year . '-12-31';
} else {
    $datefrm = $session_year . '-' . $month .'-01';
    $dateto = $session_year . '-' . $month .'-31';
}
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('accounts');?>
            	</div>
            </div>

                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <h4 style="font-size:20px;"><strong>STAFF PAID SALARY</strong></h4>
                   <h3 id="school_title" style="font-size:15px;">Total Salary Paid : <?php 
                     if(!empty($designation_id)){
                         $query_option = " AND designation_id = '$designation_id' ";
                     }
                     $sum = $this->db->query("SELECT SUM(total_salary) as sum FROM employee_total_salary WHERE `date`  BETWEEN '$datefrm' AND '$dateto' $query_option")->result_array();

                    if(empty($sum[0]['sum'])){
                      echo "0";
                    } else {
                      echo $sum[0]['sum'];
                    }
                    echo "INR" ?> </h3>
                  </div>
<div class="filter_form">
<?php echo form_open(); ?>
<div class="row">
	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('designation');?></label>
			<select name="designation_id" class="form-control selectboxit" id = "designation_id">
				<option value=""><?php echo get_phrase('All');?></option>
				<?php
				
					$designation = $this->db->get('designations')->result_array();
					foreach($designation as $row):
                                            
				?>
                                
				<option value="<?php echo $row['id'];?>" <?= $designation_id == $row['id']?'selected':'' ?>><?php echo $row['name'];?></option>
                                
				<?php endforeach;?>
			</select>
		</div>
	</div>
    <div class="col-md-2">
             <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('month'); ?></label>
                <select name="month" class="form-control selectboxit">
                    <option value="">
                              Month
                        </option>
                    <?php
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
                    $sessional_year_options = explode('-', $running_year); ?>
                    <option value="<?php echo $sessional_year_options[0]; ?>" <?= $session_year == $sessional_year_options[0] ?'selected' : '' ?>><?php echo $sessional_year_options[0]; ?></option>
                    <option value="<?php echo $sessional_year_options[1]; ?>" <?= $session_year == $sessional_year_options[1] ?'selected' : '' ?> ><?php echo $sessional_year_options[1]; ?></option>
                </select>
            </div>
        </div>
    <div class="col-md-2">
	    <div class="form-group">
	        <label class="control-label" style="margin-bottom: 5px;">&nbsp;</label>
		    <button type="submit" id = "submit" class="btn btn-info btn-block"><?php echo get_phrase('Get Report');?></button>
		</div>
	</div>

</div>
<?php echo form_close();?>
</div>    
   
                            <table id="table_export" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                                  <!--<span><p><h4><strong><a href="<?php echo site_url('admin/export_school_expenses_excel/?datefrm='.$datefrm.'&dateto='.$dateto); ?>">Export Data</a></strong></h4></p></span>-->
                               
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
                                      

                                    </tr>
                                </thead>
                                <?php if(!empty($month) && !empty($session_year)) { 
                                $i = 1;
                                ?>
                                <tbody>   
                                    <?php
                                     if(!empty($designation_id)){
                                         $this->db->where('id',$designation_id);
                                     }
                           $designations = $this->db->get_where('designations')->result_array();
                           foreach($designations as $desg){


                           $class_id = $desg['id'];
                           $designations_name = $desg['name'];
                           $primary_id = lcfirst($designations_name)."_id";

                            if (!$this->db->table_exists(lcfirst($designations_name))){
                                continue;
                            }
                           

                             $this->db->select('*');
                             $this->db->from(lcfirst($designations_name));
                             $query = $this->db->get()->result_array();
                             foreach ($query as $val){

                                     $total_salary_status = $this->db->query("SELECT * FROM employee_total_salary WHERE  status=0 AND `date`  BETWEEN '$datefrm' AND '$dateto' AND designation_id = '$class_id' AND employee_id = '$val[$primary_id]'")->result_array();

                                      if($total_salary_status[0]['status'] == '0') { 

                                      
                                                         ?>
                                                                         
                                        <tr>
                                            <td><?php echo $i; $i++; ?></td>
                                          
                                            <td><?php echo $val['name']; ?></td>                                           
                                            <td><?php echo $designations_name; ?></td>                                           
                                            <td><?php echo $val['doj']; ?> </td>
                                         <td><?php echo $val['phone']; ?> </td>
                                          
                                           <td><?php 
                                            $salary = $this->db->get_where('salary_grades', array('id' => $this->db->get_where('employees',['id'=>$val[$primary_id]])->row()->salary_grade_id))->result_array();
                                            echo $salary[0]['net_salary']; ?> </td>                                           
                                            <td><?php 
                                            $total_advance = $this->db->query("SELECT * ,SUM(amount) as total FROM advance_pay WHERE date BETWEEN '$datefrm' AND '$dateto' AND designation_id ='$class_id' AND employee_id = '$val[$primary_id]'")->result_array();

                                               

                                              
                                              $dateElements = explode('-', $total_salary_status[0]['date']);
                                              $year = $dateElements[0];
                                              $month=$dateElements[1];



                                        $number_of_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                                            


                                             echo $total_advance[0]['total']; ?> </td>                                           
                                            <td><?php $total_present = $this->db->query("SELECT Count(status) as present FROM attendance_employee WHERE `date`  BETWEEN '$datefrm' AND '$dateto' AND designation_id = '$class_id' AND employee_id = '$val[$primary_id]' AND status = '1'")->result_array();

                                            echo $total_present[0]['present']; ?> </td>
                                            <td><?php 
                                             
                                             $total_absent = $this->db->query("SELECT Count(status) as absent FROM attendance_employee WHERE `date`  BETWEEN '$datefrm' AND '$dateto' AND designation_id = '$class_id' AND employee_id = '$val[$primary_id]' AND status = '0'")->result_array();


                                            echo $total_absent[0]['absent']; ?> </td>
                                          
                                            <td><?php echo $number_of_days; ?> </td>

                                             <?php
                                            $time1=strtotime($datefrm);
                                            $month1=date("m",$time1);
                                            $year1=date("Y",$time1);
                                            ?>                                                                           
                                           <td id="total:<?php echo $val[$primary_id]; ?>" class_id = "<?= $class_id ?>" contenteditable="true"><?php 
                                             $total_salary = $this->db->query("SELECT * FROM employee_total_salary WHERE `date` = '$year1-$month1-1' AND '$dateto' AND designation_id = '$class_id' AND employee_id = '$val[$primary_id]'")->result_array();
                                           echo $total_salary[0]['total_salary']; ?> </td>


                                        </tr>
                                        <?php } ?>
                                   <?php } ?>
                                 <?php } ?>
                                </tbody>
                                <?php } ?>
                            </table>
                            <?php 
                            $time=strtotime($datefrm);
                            $month=date("m",$time);
                            $year=date("Y",$time);
                            ?>
                            <input type="hidden" id = "year" name="year" value="<?php echo $year; ?>">
                            <input type="hidden" id = "month" name="month" value="<?php echo $month; ?>">

                     <!--        <input type="hidden" id = "class_id" name="class_id" value="<?php echo $class_id; ?>">
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
                       </script> -->
                       <script>
                            $("td[contenteditable=true]").blur(function(){
                        var class_id = $(this).attr('class_id');
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
                       </script>
