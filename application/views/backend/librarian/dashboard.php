<?php
$pending_book_requests = $this->db->get_where('book_request', array('status' => 0))->num_rows();

$this->db->select_sum('total_copies', 'total_copies');
$query = $this->db->get('book');
$result = $query->result();
$total_copies = $result[0]->total_copies;

$this->db->select_sum('issued_copies', 'issued_copies');
$query = $this->db->get('book');
$result = $query->result();
$issued_copies = $result[0]->issued_copies;
?>

<hr />

<div class="row">    
    <div class="col-md-3">    
        <div class="tile-stats tile-red">
            <div class="icon" style="margin-bottom: 20px;"><i class="entypo-book"></i></div>
            <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('book');?>" 
            		data-postfix="" data-duration="1500" data-delay="0">0</div>
            
            <h3><?php echo get_phrase('total_books');?></h3>
        </div>
        
    </div>

    <div class="col-md-3">
    
        <div class="tile-stats tile-green">
            <div class="icon" style="margin-bottom: 20px;"><i class="entypo-arrows-ccw"></i></div>
            <div class="num" data-start="0" data-end="<?php echo $pending_book_requests; ?>" 
            		data-postfix="" data-duration="800" data-delay="0">0</div>
            
            <h3><?php echo get_phrase('pending_book_requests');?></h3>
        </div>
        
    </div>

    <div class="col-md-3">
    
        <div class="tile-stats tile-aqua">
            <div class="icon" style="margin-bottom: 20px;"><i class="entypo-docs"></i></div>
            <div class="num" data-start="0" data-end="<?php echo $total_copies; ?>" 
            		data-postfix="" data-duration="500" data-delay="0">0</div>
            
            <h3><?php echo get_phrase('total_copies');?></h3>
        </div>
        
    </div>

    <div class="col-md-3">
    
        <div class="tile-stats tile-blue">
            <div class="icon" style="margin-bottom: 20px;"><i class="entypo-check"></i></div>
            <div class="num" data-start="0" data-end="<?php echo $issued_copies; ?>" 
        		data-postfix="" data-duration="500" data-delay="0">0</div>
            
            <h3><?php echo get_phrase('issued_copies');?></h3>
        </div>
    </div>
</div>


<div class="dashboard-data container-fluid p0">
    <div class="heading">
        <h2>Issue New Book</h2>
    </div>
    <div class="row">
        <div class="col-sm-6 issue-book">
      	
<?php echo form_open(site_url('librarian/book_request_by_lib/create') ,
			array('id'=>'data_form','enctype' => 'multipart/form-data'));?>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Book Rfid</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="book_rfid" name="book_rfid" data-validate="required" data-message-required="Value Required" maxlength="10" autocomplete="off" >
                      <div id="customer">
                      </div>
                        
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Student Rfid</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="name_rfid" maxlength="10" id="name_rfid" data-validate="required" data-message-required="Value Required" autocomplete="off">
                       <div id="result">
                      </div>

                    </div>

                    
                </div>


                <div class="form-group">
                    <label class="col-sm-3 control-label">Return Date</label>
                    <div class="col-sm-9">
                 <input type="date" class="form-control" style="line-height: 1" name="return_to_date">
                    </div>
                </div>

                 <div class="col-md-12 text-right " style="margin-top: 20px;">
                    <button type="submit"  class="btn btn-info"><?php echo get_phrase('isssu_book'); ?></button>
                </div>

           <?php echo form_close();?>
        </div>

        <div class="col-sm-6 issued-books">
            <table class="table datatable table-stripped">
                <thead>
                    <tr>
                        <th style="display:none">Sl</th>
                        <th>Book Name</th>
                        <th>Student Name</th>
                        <th>Due Date</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    <!--<tr>
                        <td>Dummy Book</td>
                        <td>Alok Tiwari</td>
                        <td>14-01-2019</td>
                        <td class='due'>Due</td>
                    </tr>-->
					 <?php
        $count = 1;
        $this->db->order_by('book_request_id', 'desc');
        $book_requests = $this->db->get_where('book_request')->result_array();
        foreach ($book_requests as $row) { ?>   
            <tr>
                 <td  style="display:none"><?php $row['book_id']; ?></td>
                <td><?php echo $this->db->get_where('book', array('book_id' => $row['book_id']))->row()->name; ?></td>
                <td><?php echo $this->db->get_where('student', array('student_id' => $row['user_id']))->row()->name; ?></td>
                <td><?php echo date('d/m/Y', $row['issue_end_date']); ?></td>
               
                <td>
                    <?php
                        if($row['status'] == 0)
                            $status = '<span class="label label-info" style="font-size: 10px;">' . get_phrase('pending') . '</span>';
                        else if($row['status'] == 1)
                            $status = '<span class="label label-success" style="font-size: 10px;">' . get_phrase('issued') . '</span>';
                        else
                            $status = '<span class="label label-danger" style="font-size: 10px;">' . get_phrase('rejected') . '</span>';
                        echo $status;
                    ?>
                </td>
            </tr>
        <?php } ?>
                </tbody>
            </table>


            <div class="issued-books-btn">
                <a href="" class="view-all btn btn-info">View All Issued Books</a>
            </div>
        </div>
    </div>
</div>

  
        <script>
         $(document).ready(function () {
          $("#name_rfid").keyup(function () {
            if($(this).val() <= 0){
                return false;
            }
            if(($(this).val()).length > 9){
         //alert(($(this).val()).length);
             $.ajax({
              type: "GET",
              url: "<?php echo site_url('librarian/student_rfid_search');?>",
              data: 'name_rfid=' + $(this).val(),
              beforeSend: function () {
                $("#name_rfid").css("background", "#FFF url(" +  + "<?php echo base_url();?>assets/load-ring.gif) no-repeat 165px");
              },
                success: function (data) {
                 $("#result").show();
                 $("#result").html(data);
                 $("#result").css("background", "none");
                 $('#result').removeClass('cbs-b-hidden');
                
                
                }
             });
           }

         
               
        });

        
      });


    </script>

        <script>
         $(document).ready(function () {
          $("#book_rfid").keyup(function () {
            if($(this).val() <= 0){
                return false;
            }
            if(($(this).val()).length > 9){
          // alert(($(this).val()).length);
             $.ajax({
              type: "GET",
              url: "<?php echo site_url('librarian/book_rfid_search');?>",
              data: 'book_rfid=' + $(this).val(),
              beforeSend: function () {
                $("#book_rfid").css("background", "#FFF url(" +  + "<?php echo base_url();?>assets/load-ring.gif) no-repeat 165px");
              },
                success: function (data) {
                 $("#customer").show();
                 $("#customer").html(data);
                 $("#customer").css("background", "none");
                 $('#customer').removeClass('cbs-b-hidden');              
              
                
                }
             });
           }
       
        });

        
      });


    </script>









