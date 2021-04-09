
<?php 
 $result = $this->db->get_where('enroll',array('card_code' => $card_code,'card_code_status'=>1))->row();

 $result_student = $this->db->get_where('student',array('student_id' =>$result->student_id))->row();
 $result_class   = $this->db->get_where('class',array('class_id' =>$result->class_id))->row()->name;
 $result_section = $this->db->get_where('section',array('section_id' =>$result->section_id))->row()->name;

 $result_parent = $this->db->get_where('parent',array('parent_id' =>$result_student->parent_id))->row();

 //$result_parent = $this->db->get_where('parent',array('parent_id' =>$result_student->parent_id))->row();
 

?>
<div class="quickinfo_close"><i class="fas fa-times"></i></div>
<div class="content-wrapper">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">×</a>

            <div class="message"></div>
        </div>

        <div class="content-body">
            <section>
                <div class="row wrapper white-bg page-heading">
                    <div class="col-md-3">
                        <div class="card card-block">
                            <!-- <h4 class="text-xs-center">student one</h4> -->
                            <div class="ibox-content mt-2">
                                <img alt="image" id="dpic" class="img-responsive" src="../../uploads/student_image/1.jpg">
                            </div>
                            <div >
                                <h3>Enrollment : <span>a354ef</span></h3>
                            </div>
                            <hr>

                            <ul class="list-group list-group-flush student-info-list" style="list-style: none">
                                        <li class="">
                                            <strong>Due Fee Amount</strong> : <span class=" "> 17,900</span>
                                        </li>

                                        <li class="">
                                            <strong>Total Card Balance</strong> : <span class=" "> 690</span>
                                        </li>

                                        <li class="">
                                            <strong>Pending Library Books</strong> : <span class=" "> 1</span>
                                        </li>

                                    </ul>

                                                                <div class="user-button">
                                <div class="row mt-3">
                                    <div class="col-md-6">

                                        <a href="#sendMail" data-toggle="modal" data-remote="false" class="btn btn-primary btn-md  " data-type="reminder"><i class="icon-envelope"></i> Send Message                                        </a>

                                    </div>

                                </div>
                            </div>
 
                            
                        </div>

                    </div>
                    <div class="col-md-9">
                        <div class="card card-block">
                            <h3>Student Details</h3>
                            <hr>

                            <table class="table table-bordered no-shadow">
                                <thead>
                                <!-- <tr>
                                    <th>Amount</th>
                                    <th>Note</th>

                                </tr> -->
                                </thead>
                                <tbody id="activity">
                                <tr>
                                    <td class="info-title">Name</td>
                                    <td class="info-value"><?php echo $result_student->name;?></td>
                                </tr>

                                <tr>
                                    <td class="info-title">Class</td>
                                    <td class="info-value"><?php echo $result_class;?></td>
                                </tr>

                                <tr>
                                    <td class="info-title">Email</td>
                                    <td class="info-value"><?php echo $result_student->email;?></td>
                                </tr>

                                <tr>
                                    <td class="info-title">DOB</td>
                                    <td class="info-value"><?php echo $result_student->birthday;?></td>
                                </tr>


                                <tr>
                                    <td class="info-title">Phone</td>
                                    <td class="info-value"><?php echo $result_student->phone;?></td>
                                </tr>

                                <tr>
                                    <td class="info-title">Parent Name</td>
                                    <td class="info-value"><?php echo $result_parent->name; ?></td>
                                </tr>

                                <tr>
                                    <td class="info-title">Parent Mobile</td>
                                    <td class="info-value"><?php echo $result_parent->phone; ?></td>
                                </tr>

                                <tr>
                                    <td class="info-title">Address</td>
                                    <td class="info-value"><?php echo $result_student->address;?></td>
                                </tr>

                                <tr>
                                    <td class="info-title">Transport</td>
                                    <td class="info-value">Rithala, Bhagawan Mahavir Marg, Varun Kunj, Rithala, Rohini, New Delhi, Delhi 110085, India - Inderlok, महाराजा नाहर सिंह मार्ग, Shastri Nagar, New Delhi, Delhi 110035, India[ ]</td>
                                </tr>

                                <tr>
                                    <td class="info-title">Hostel</td>
                                    <td class="info-value">KP Hostel</td>
                                </tr>

                                </tbody>
                            </table>
                          
                            <hr>
                            <div class="row mt-3">
                               
                                    <div class="col-sm-12">
                                    <a href="http://desktop-22kuple/edurama_pos_full/edurama_pos/customers/invoices?id=1" class="btn btn-primary btn-lg"><i class="icon-file-text2"></i> View Profile</a>


                                    <a href="http://desktop-22kuple/edurama_pos_full/edurama_pos/customers/transactions?id=1" class="btn btn-success btn-lg"><i class="icon-money3"></i> Parent Information                                    </a>
      
                                    <a href="http://desktop-22kuple/edurama_pos_full/edurama_pos/customers/balance?id=1" class="btn btn-primary btn-lg"><i class="icon-wallet"></i> Attendance Report                                    </a>

                                    <a href="http://desktop-22kuple/edurama_pos_full/edurama_pos/customers/balance?id=1" class="btn btn-success btn-lg"><i class="icon-wallet"></i> Recharge Summary                                    </a>

                                    </div>

                            </div>
                     


                        </div>
                    </div>
                </div>

            </section>
        </div>
    </div>


