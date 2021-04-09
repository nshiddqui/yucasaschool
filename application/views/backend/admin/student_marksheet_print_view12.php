<?php
	$class_name		 	= 	$this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
	$exam_name  		= 	$this->db->get_where('exam' , array('exam_id' => $exam_id))->row()->name;
	$system_name        =	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
    $address       =   $this->db->get_where('settings' , array('type'=>'address'))->row()->description;
    $running_year       =   $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
?>
       <?php 
            $this->db->select('S.*,P.name as parent_name, C.name as class_name, SE.name as section_name,E.roll,E.class_id');
            $this->db->from('student AS S');
            $this->db->join('enroll As E', 'E.student_id = S.student_id', 'left');
            $this->db->join('parent As P', 'P.parent_id = S.parent_id', 'left');
            $this->db->join('class As C', 'C.class_id = E.class_id', 'left');  
            $this->db->join('section As SE', 'SE.section_id = E.section_id', 'left');  
             $this->db->where('S.student_id', $student_id);
            $student = $this->db->get()->result_array();
      
              foreach ($student as $row3){
                 $name= $row3['name'];
                 $parent_name= $row3['parent_name'];
                 $birthday= $row3['birthday'];
                 $student_code= $row3['student_code'];
                     $class_name= $row3['class_name'];
                         $section_name= $row3['section_name'];
                             $roll= $row3['roll'];
             }
          ?>

<?php if ($class_id==1 ||$class_id==2 || $class_id==3){ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report Card Template</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        .report__card__wrapper{
            width: 90%;
            margin: 30px auto;
        }

        .report__card{
            width: 100%;
            border: 2px solid #000;
        }

        .board__logo.report__logo {
            text-align: left;
        }

        .school__logo.report__logo {
            text-align: right;
        }

        .school__name {
            margin: 10px 0px 5px 0;
        }

        .academic__session {
            margin-top: 5px;
        }

        .report__card__title h4 {
            margin-top: 5px;
            font-weight: 700;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 16px;
        }

        .report__card__school__info {
            background: #daeef3;
            border-bottom: 2px solid #000;
        }

        .report__card > div {
            width: 100%;
        }
        .flex{
            display: flex;
            flex: 1;
            flex-direction: row;
            align-items: stretch;
            justify-content: space-between;
            flex-wrap: wrap;
            flex-grow:1;
            width:100%;
            align-content: center;
        }
        .flex div {
            text-align: center;
            flex: 1;
        }
        .report__logo img{
            height: 100px;
            width: 150px;
            object-fit: contain;
        }
        .report__card__wrapper h1,h2,h3,h4,h5,h6,p,span,a,strong{
            margin: 0 auto ;
            color:#000;
        }

        .flex__25 > div{
            width:25%;
            text-align: left;
            border-collapse: collapse;
            border: 1px solid #DAEEF3;
            padding: 5px;
            text-transform: uppercase;
            font-size: 12px;
            max-width: 25%;
        }
        .bg__blue{
            background-color: #92CDDC;
        }
        .bg__light__blue{
            background-color: #DAEEF3;
        }
        .bg__cream{
            background-color: #EAF1DD;
        }
        .report__card__school__info{
            padding: 5px;
        }
        .report__card__main__title{
            border-width: 2px 0 2px 0;
            border-color: #000;
            border-style: solid;
            padding: 5px 0;
            letter-spacing: 0.5px;
        }
        .width__10{
            width: 10%;
            max-width: 10%;
        }
        .text__left{
            text-align: left !important;

        }
        .text__uppercase{
            text-transform: uppercase;
        }

        .subject__label{
           padding: 5px 0;
        }
        .subject__name {
            /* width: 22.5%; */
            border-width: 0 1px 1px 0;
            border-color: #000;
            border-style: solid;
            padding: 5px;
        }
        .subject__name:last-child{
            border-right: 0px;
        }

        .report__card__exam__marks {
            border-bottom: 2px solid #000;
        }


        .subject__competencies__label p{
           
            padding: 40px 0;
            font-size: 10px;
            height: 125px;;
        }

        .subject__competencies__label{
            border-width: 1px 0 1px 0;
            border-color: #000;
            border-style: solid;
        }

        .subject__information {
            border-bottom: 1px solid #000;
        }
        
        .subject__competencies {
            
            border-width: 0 0px 0px 0;
            border-color: #000;
            border-style: solid;
            height: 125px;
        }
        /* .subject__competencies:last-child{
            border-right: 0px;
        } */

        .subject__competencies__heading {
            
            text-align: left;
            padding-top: 10px;
            font-size: 12px;
            /* border-right:1px solid #000; */
            letter-spacing: 0.5px;
            margin: 0;
            padding: 5px;
        }

        .subject_grade {
            
            text-align: left;
            padding-top: 10px;
            font-size: 12px;
            
            letter-spacing: 0.5px;
            margin: 0;
            padding: 5px;
            border-bottom: 1px solid #000;
            height: 30px;
        }

        .subject_grade.subject_final__grade {
            height: 120px;
            line-height: 110px;
        }
        .subject__competencies__details{
            border-right:1px solid #000;
        }

        .subject__competencies__heading{
            writing-mode: tb-rl;
            height: 100%;
        }
        .subject__competencies{
            padding: 0px;
        }

        .subject__competencies__heading:last-child{
            border-right: 0;
        }

        .report__card__exam__marks__left{
            border-right: 2px solid #000;
        }

        .exam__term{
            writing-mode: tb-rl;
            font-weight: 700;
            color:#000;
        }
        .exam__term{
            padding: 5px;
            border-right: 1px solid #000;
        }

        .flex .exam__cycle__wrapper {
            flex: 3 ;
        }

        .exam__cycle {
            padding: 5px 0;
            border-bottom: 1px solid #000;
            font-size: 12px;
            font-weight: 700;
            height: 29.5px;
            line-height: 20px;
        }
        .exam__cycle:last-child{
            border-bottom: 0;
        }
        .subject__final__assessment{
            border-top: 2px solid #000;
            border-bottom: 0px solid #000;
            height: 45px;
            font-weight: 700;
            font-size: 12px;
            line-height: 1;
            padding-top: 10px;
        }
        
        .subject__marks_wrapper span{
            margin: 0;
            padding: 1px;
            text-align: center;
        }

        .subject__total__score {
            border-width:1px 2px 1px 1px;
            border-style: solid;
            border-color: #111;
            height: 45px;
            line-height: 45px;
            font-weight: 700;
            color: #000;
        }


        .co__scholatic__area{
            margin-top: 10px;
            border-width: 2px 1px 1px 0px;
            border-color: #000;
            border-style: solid;
            padding: 0;
            text-align: left !important;
            
        }

        .report__card__extracurricular__marks .flex div{
            text-align: left;
        }

        .co__sholastic__title {
            padding-top: 10px;
            padding-left: 5px;
            border-bottom:1px solid #000;
        }

        .co__sholastic__subtitle {
            padding-top: 10px;
            border-left:1px solid #000;
            text-align: center !important;
            border-bottom:1px solid #000;
        }


        .co__sholastic__item {
            padding: 5px;
            border-bottom: 1px solid #000;
        }

        .co__sholastic__grade {
            border-left: 1px solid #000;
            border-bottom: 1px solid #000;
            text-align: center !important;
            padding: 4px;
        }

        .report__card__footer__info .flex div{
            text-align: left;
        }

        .report__card__footer__info{
            padding: 5px;
        }
        
        .author__signatures{
            margin-top: 15px;
        }

        .report__footer__details {
            margin-top: 5px;
        }


        

    </style>
</head>
<body>
    <div class="report__card__wrapper">
        <div class="report__card">
            <!-- School Informtaion Section -->
            <div class="report__card__school__info">
                <div class="flex">
                    <!-- School Informtaion Left Section -->
                    <div class="report__card__school__info__left">
                        <div class="board__logo report__logo">
                            <img src="https://www.edurama.in/unityerp/uploads/logo.png" alt="">
                        </div>
                    </div>

                    <!-- School Informtaion Center Section -->
                    <div class="report__card__school__info__center">
                        <div class="school__name">
                            <h4><strong><?php echo $system_name ?></strong></h4>
                        </div>
                        <div class="school__location">
                            <h6><?php echo $address ?></h6>
                        </div>

                        <div class="academic__session">
                            <strong>Academic Session</strong> : <span class="academic__session__year"><?php echo $running_year ?></span>
                        </div>

                        <div class="report__card__title">
                            <h4>Report Card</h4>
                        </div>
                    </div>

                    <!-- School Informtaion Right Section -->
                    <div class="report__card__school__info__right">
                        <div class="school__logo report__logo">
                            <img src="https://kvsangathan.nic.in/sites/all/themes/kvs/logo.png" alt="">
                        </div>
                    </div>
                </div>


                
            </div>

            <!-- Student Informtaion Section -->
            <div class="report__card__student__info ">
                <div class="report__card__student__info__box">
                    <div class="flex flex__25">
                        <div class="roll__number">
                            <p><strong>Roll No</strong> : <?php echo $roll ;?></p>
                        </div>

                        <div class="admission_number">
                            <p><strong>Admission No: </strong> : <?php echo $student_code ?></p>
                        </div>

                        <div class="class__section">
                            <p><strong>Class & Section : </strong><?php echo $class_name; ?> <?php echo $section_name; ?></p>
                        </div>

                        <div class="cbse__reg__no">
                            <p><strong>CBSE Reg. No : </strong>56953</p>
                        </div>

                    </div>
                </div>

                <div class="report__card__student__info__box">
                        <div class="flex flex__25">

                            <div class="student__name">
                                <p><strong>Student Name : </strong> <?php echo $name ?></p>
                            </div>
                            
                            <div class="student__dob">
                                <p><strong>Date Of Birth : </strong> <?php echo $birthday ?></p>
                            </div>
        
                            <div class="student__mother__name">
                                <p><strong>Mother's Name : </strong> Priya Rathi</p>
                            </div>
        
                            <div class="student__father__name">
                                    <p><strong>Father's Name : </strong> <?php echo $parent_name ?></p>
                            </div>
                        </div>
                    </div>
            </div>

            
            <!-- Rport Card Title Section -->

            <div class="report__card__main__title bg__blue">
                <div class="text-center flex">
                    <h5><strong>ACADEMIC PERFORMANCE OF THE STUDENT - SCHOLASTIC AREAS</strong></h5>
                </div>
            </div>

            <!-- Exam Marks Section -->
            <div class="report__card__exam__marks ">
                <div class="flex">
                       <div class="report__card__exam__marks__left text__uppercase width__10">

                            <div class="subject__label bg__cream">
                                <p ><strong>Subject</strong></p>
                            </div>

                            <div class="subject__competencies__label bg__light__blue">
                                <p>COMPETENCIES</p>
                            </div>
                            
                            <div class="exam__term__wrapper">
                                
                                 <?php 
                            $exams = $this->db->get_where('exam')->result_array();
                            
				        	foreach($exams as $row){
                            ?>
                                <div class="flex">
                                    <div class="exam__term">
                                       <?php echo $row['name'];?>
                                    </div>

                                        <div class="exam__cycle__wrapper">
                                            
                                          
                                        <?php 
                                        $cycles = $this->db->get_where('exam_cycle' , array('exam_id' => $row['exam_id']))->result_array();
				                     	foreach($cycles as $rows){
                                        ?>   
                                        <div class="exam__cycle">
                                            <strong><?php echo $rows['name'];?></strong>
                                        </div>
                                      <?php } ?>

                                    </div>
                                </div>
                               <?php } ?>

                            </div>


                            <div class="subject__final__assessment ">
                                <p>FINAL ASSESSMENT</p>
                            </div>
                    </div>

                    
                    
                    
                    
                    <div class="report__card__exam__marks__header text__uppercase">
                        <div class="flex ">
                             <?php 
                            $exams = $this->db->get_where('subject' , array('class_id' => $class_id))->result_array();
				        	foreach($exams as $row){
                            ?>
                            
                            <div class="subject__information">
                                <div class="subject__name bg__cream">
                                    <p><strong><?php echo $row[name]; ?></strong></p>
                                </div>
                                        
                                <div class="subject__competencies bg__light__blue">
                                    
                                        <div class="flex">
                                         <?php
                                       
                                $subject_competencies = $this->db->get_where('subject_competencies' , array('subject_id' => $row[subject_id]))->result_array();
				               	foreach($subject_competencies as $row5){
                                       ?>   
                                        <div class="subject__competencies__details">
                                            <div class="subject__competencies__heading"><?php echo $row5[name];?></div>
                                              <?php
                                         $exams = $this->db->get_where('exam')->result_array();
				                       	foreach($exams as $rowexam){
                                    $cycles = $this->db->get_where('exam_cycle' , array('exam_id' => $rowexam['exam_id']))->result_array();
				                     	foreach($cycles as $rowscycle){
                                        $subject_competencies = $this->db->get_where('mark',array('subject_id'=> $row[subject_id],'student_id'=>$student_id,'exam_id'=> $rowexam['exam_id'],'cycle_id'=>$rowscycle[id]))->result_array();
				                	    
				                	     foreach($subject_competencies as $row5mark){
                                        ?>
                                                    <div class="subject_grade"><?php echo $this->db->get_where('cat_mark',array('competencies_name'=>$row5['name'],'mark_id'=>$row5mark['mark_id']))->row()->competencies_marks;?></div>
                                                    
                                            <!-- TERM 2 -->
                                          
                                            <?php } ?>  
                                            <?php } ?>  
                                           <?php } ?>  
                                        </div>

                                      <?php } ?>

                                      

                                            <div class="subject__competencies__details">
                                            <div class="subject__competencies__heading">CYCLE WISE GRADE</div>
                                            <?php 
                                            $subject_competencies = $this->db->get_where('mark',array('subject_id'=> $row[subject_id],'student_id'=>$student_id))->result_array();
				                	  //  print_r($subject_competencies);
				                	     foreach($subject_competencies as $row5mark){
				                	          
				                	          ?>
                                            <div class="subject_grade"><strong><?php echo $row5mark[mark_obtained];?></strong></div>
                                            <?php } ?>
                                            
                                        </div>

                                        <div class="subject__competencies__details">
                                            <div class="subject__competencies__heading">TERM WISE OVERALL</div>
                                              <?php 
                                                $examby_reslut = $this->db->query("select * from mark where student_id='$student_id' AND subject_id='$row[subject_id]' GROUP BY exam_id")->result_array();
				                	           foreach($examby_reslut as $row12){
				                	          ?>
                                            <div class="subject_grade subject_final__grade"><strong>A+</strong></div>  
                                             <?php } ?>                                  
                                        </div>

                                    </div>
                                    <div class="subject__total__score">A+</div>
                                </div>

                            </div>

                           <?php } ?>


                                

                        </div>
                    </div>
                </div>



                

            </div>


            <!-- Extra Curricular Marks Section -->

            <div class="report__card__extracurricular__marks">
                <div class="flex">
                    <div class="co__scholatic__area">
                        <div class="flex">
                            <div class="co__sholastic__title">
                                <h6><strong>Co-Scholastic Area: Term -1</strong> [on a 3-point  (A-C) grading scale]</h6>
                            </div>
                            <div class="co__sholastic__subtitle width__10">
                                <strong>Grade</strong>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="co__sholastic__item">
                                <h6>Work Education</h6>
                            </div>
                            <div class="co__sholastic__grade width__10">
                                <strong>A+</strong>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="co__sholastic__item">
                                <h6>Art Education</h6>
                            </div>
                            <div class="co__sholastic__grade width__10">
                                <strong>A</strong>
                            </div>
                        </div>

                        
                        <div class="flex">
                            <div class="co__sholastic__item">
                                <h6>Health & Physical Education </h6>
                            </div>
                            <div class="co__sholastic__grade width__10">
                                <strong>B+</strong>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="co__sholastic__item">
                                <h6><strong>Discipline </strong> </h6>
                            </div>
                            <div class="co__sholastic__grade width__10">
                                <strong>B+</strong>
                            </div>
                        </div>



                    </div>


                </div>
            </div>



            <!-- Report Card Footer Section -->

            <div class="report__card__footer__info">
                <div class="teacher__remark">
                    <div class="flex">
                        <div>
                            Class teacher's remark : 
                        </div>
                    </div>
                </div>

                <div class="report__footer__details">
                    <div class="flex">
                        <div>
                           <p>Promoted to class :  </p>
                        </div>

                        <div style="text-align: center;">
                            <p>Place : <span> Delhi</span> </p>
                        </div>

                        <div style="text-align: right;">
                            <p>Date : <span> <?php echo date("d/m/Y");?></span> </p>
                        </div>


                    </div>
                </div>

                <div class="author__signatures">
                    <div class="flex">
                        

                        <div style="text-align: right;">
                            
                            <p>Mr. Charandeep Singh </p>
                        </div>


                    </div>
                </div>

                <div class="">
                    <div class="flex">
                        <div>
                            <p><strong>Class Teacher</strong></p>
                        </div>

                        <div style="text-align: center;">
                            <p><strong>Head Master</strong> </p>
                        </div>

                        <div style="text-align: right;">
                            
                            <p><strong>Principal </strong></p>
                        </div>


                    </div>
                </div>


            </div>
        </div>          
    </div>
</body>
</html>
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		var elem = $('#print');
		PrintElem(elem);
		Popup(data);

	});

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        mywindow.document.write('<html><head><title></title>');
        //mywindow.document.write('<link rel="stylesheet" href="assets/css/print.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        //mywindow.document.write('<style>.print{border : 1px;}</style>');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }
</script>
<?php } elseif($class_id==4 || $class_id==5 || $class_id==6 || $class_id== 7 || $class_id==8 || $class_id==9){ ?>

<!-- start here class class 3 to class 8th marksheet code --->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report Card Template</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        .report__card__wrapper{
            width: 90%;
            margin: 30px auto;
        }

        .report__card{
            width: 100%;
            border: 2px solid #000;
        }

        .board__logo.report__logo {
            text-align: left;
        }

        .school__logo.report__logo {
            text-align: right;
        }

        .school__name {
            margin: 10px 0px 5px 0;
        }

        .academic__session {
            margin-top: 5px;
        }

        .report__card__title h4 {
            margin-top: 5px;
            font-weight: 700;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 16px;
        }

        .report__card__school__info {
            background: #daeef3;
            border-bottom: 2px solid #000;
        }

        .report__card > div {
            width: 100%;
        }
        .flex{
            display: flex;
            flex: 1;
            flex-direction: row;
            align-items: stretch;
            justify-content: space-between;
            flex-wrap: wrap;
            flex-grow:1;
            width:100%;
            align-content: center;
        }
        .flex div {
            text-align: center;
            flex: 1;
        }
        .report__logo img{
            height: 100px;
            width: 150px;
            object-fit: contain;
        }
        .report__card__wrapper h1,h2,h3,h4,h5,h6,p,span,a,strong{
            margin: 0 auto ;
            color:#000;
        }

        .flex__25 > div{
            width:25%;
            text-align: left;
            border-collapse: collapse;
            border: 1px solid #DAEEF3;
            padding: 5px;
            text-transform: uppercase;
            font-size: 12px;
            max-width: 25%;
        }
        .bg__blue{
            background-color: #92CDDC;
        }
        .bg__light__blue{
            background-color: #DAEEF3;
        }
        .bg__cream{
            background-color: #EAF1DD;
        }
        .report__card__school__info{
            padding: 5px;
        }
        .report__card__main__title{
            border-width: 2px 0 2px 0;
            border-color: #000;
            border-style: solid;
            padding: 5px 0;
            letter-spacing: 0.5px;
        }
        .width__10{
            width: 10%;
            max-width: 10%;
        }
        .text__left{
            text-align: left !important;

        }
        .text__uppercase{
            text-transform: uppercase;
        }

        .subject__label{
           padding: 5px;
        }
        .subject__name {
            /* width: 22.5%; */
            border-width: 0 1px 1px 0;
            border-color: #000;
            border-style: solid;
            padding: 5px;
            height: 51px;
            line-height:50px; 
        }
        .subject__name:last-child{
            border-right: 0px;
        }

        .report__card__exam__marks {
            border-bottom: 2px solid #000;
        }


        .subject__competencies__label p{
           
            padding: 40px 0;
            font-size: 14px;
            height: 100px;
            font-weight: 700;

        }

        .subject__competencies__label{
            border-width: 1px 0 1px 0;
            border-color: #000;
            border-style: solid;
        }

        .subject__information {
            border-bottom: 1px solid #000;
        }
        
        .subject__competencies {
            
            border-width: 0 0px 0px 0;
            border-color: #000;
            border-style: solid;
            height: 100px;
        }
        /* .subject__competencies:last-child{
            border-right: 0px;
        } */

        .subject__competencies__heading {
            
            text-align: left;
            padding-top: 10px;
            font-size: 12px;
            /* border-right:1px solid #000; */
            letter-spacing: 0.5px;
            margin: 0;
            padding: 5px;
        }

        .subject_grade {
            
            text-align: left;
            padding-top: 10px;
            font-size: 13px;
            
            letter-spacing: 0.5px;
            margin: 0;
            padding: 5px;
            border-bottom: 1px solid #000;
            height: 30px;
            font-weight: 700;
        }

        .subject_grade.subject_final__grade {
            height: 100px;
            line-height: 110px;
        }
        .subject__competencies__details{
            border-right:1px solid #000;
        }

        .subject__competencies__heading{
            /* writing-mode: tb-rl; */
            height: 100px;
            padding-top: 30px;
        }
        .subject__competencies{
            padding: 0px;
        }

        .subject__competencies__heading:last-child{
            border-right: 0;
        }

        .report__card__exam__marks__left{
            border-right: 2px solid #000;
        }

        .exam__term{
            writing-mode: tb-rl;
            font-weight: 700;
            color:#000;
        }
        .exam__term{
            padding: 5px;
            border-right: 1px solid #000;
        }

        .flex .exam__cycle__wrapper {
            flex: 3 ;
        }

        .exam__cycle {
            padding: 5px 0;
            border-bottom: 1px solid #000;
            font-size: 12px;
            font-weight: 700;
            height: 29.5px;
            line-height: 20px;
        }
        .exam__cycle:last-child{
            border-bottom: 0;
        }
        .subject__final__assessment{
            border-top: 2px solid #000;
            border-bottom: 0px solid #000;
            height: 45px;
            font-weight: 700;
            font-size: 12px;
            line-height: 1;
            padding-top: 10px;
        }
        
        .subject__marks_wrapper span{
            margin: 0;
            padding: 1px;
            text-align: center;
        }

        .subject__total__score {
            border-width:1px 2px 1px 1px;
            border-style: solid;
            border-color: #111;
            height: 45px;
            line-height: 45px;
            font-weight: 700;
            color: #000;
        }


        .co__scholatic__area{
            margin-top: 10px;
            border-width: 2px 1px 1px 0px;
            border-color: #000;
            border-style: solid;
            padding: 0;
            text-align: left !important;
            
        }

        .report__card__extracurricular__marks .flex div{
            text-align: left;
        }

        .co__sholastic__title {
            padding-top: 10px;
            padding-left: 5px;
            border-bottom:1px solid #000;
        }

        .co__sholastic__subtitle {
            padding-top: 10px;
            border-left:1px solid #000;
            text-align: center !important;
            border-bottom:1px solid #000;
        }


        .co__sholastic__item {
            padding: 5px;
            border-bottom: 1px solid #000;
        }

        .co__sholastic__grade {
            border-left: 1px solid #000;
            border-bottom: 1px solid #000;
            text-align: center !important;
            padding: 4px;
        }

        .report__card__footer__info .flex div{
            text-align: left;
        }

        .report__card__footer__info{
            padding: 5px;
        }
        
        .author__signatures{
            margin-top: 15px;
        }

        .report__footer__details {
            margin-top: 5px;
        }


        

    </style>
</head>
<body>
    <div class="report__card__wrapper">
        <div class="report__card">
            <!-- School Informtaion Section -->
            <div class="report__card__school__info">
                <div class="flex">
                    <!-- School Informtaion Left Section -->
                    <div class="report__card__school__info__left">
                        <div class="board__logo report__logo">
                            <img src="http://cbse.nic.in/html/images/logo.png" alt="">
                        </div>
                    </div>

                    <!-- School Informtaion Center Section -->
                    <div class="report__card__school__info__center">
                        <div class="school__name">
                            <h4><strong><?php echo $system_name ?></strong></h4>
                        </div>
                        <div class="school__location">
                            <h6><?php echo $address ?></h6>
                        </div>

                        <div class="academic__session">
                            <strong>Academic Session</strong> : <span class="academic__session__year"><?php echo $running_year ?></span>
                        </div>

                        <div class="report__card__title">
                            <h4>Report Card</h4>
                        </div>
                    </div>

                    <!-- School Informtaion Right Section -->
                    <div class="report__card__school__info__right">
                        <div class="school__logo report__logo">
                            <img src="https://kvsangathan.nic.in/sites/all/themes/kvs/logo.png" alt="">
                        </div>
                    </div>
                </div>


                
            </div>

            <!-- Student Informtaion Section -->
            <div class="report__card__student__info ">
                <div class="report__card__student__info__box">
                    <div class="flex flex__25">
                        <div class="roll__number">
                            <p><strong>Roll No</strong> : <?php echo $roll ;?></p>
                        </div>

                        <div class="admission_number">
                            <p><strong>Admission No: </strong> : <?php echo $student_code ?></p>
                        </div>

                        <div class="class__section">
                            <p><strong>Class & Section : </strong><?php echo $class_name; ?> <?php echo $section_name; ?></p>
                        </div>

                        <div class="cbse__reg__no">
                            <p><strong>CBSE Reg. No : </strong>56953</p>
                        </div>

                    </div>
                </div>

                <div class="report__card__student__info__box">
                        <div class="flex flex__25">

                            <div class="student__name">
                                <p><strong>Student Name : </strong> <?php echo $name ?></p>
                            </div>
                            
                            <div class="student__dob">
                                <p><strong>Date Of Birth : </strong> <?php echo $birthday ?></p>
                            </div>
        
                            <div class="student__mother__name">
                                <p><strong>Mother's Name : </strong> Priya Rathi</p>
                            </div>
        
                            <div class="student__father__name">
                                    <p><strong>Father's Name : </strong><?php echo $parent_name ?></p>
                            </div>
                        </div>
                    </div>
            </div>

            
            <!-- Rport Card Title Section -->

            <div class="report__card__main__title bg__blue">
                <div class="text-center flex">
                    <h5><strong>ACADEMIC PERFORMANCE OF THE STUDENT - SCHOLASTIC AREAS</strong></h5>
                </div>
            </div>

            <!-- Exam Marks Section -->
            <div class="report__card__exam__marks ">
                <div class="flex">
                    <div class="report__card__exam__marks__left text__uppercase width__10">

                            <div class="subject__label bg__cream">
                                <p style="text-align:left;"><strong>SCHOLASTIC AREAS</strong></p>
                            </div>

                            <div class="subject__competencies__label bg__light__blue">
                                <p>Subject Name</p>
                            </div>
                            
                            <div class="exam__term__wrapper">
                                <div class="flex">
                                   

                                    <div class="exam__cycle__wrapper">
                                         <?php 
                            $exams = $this->db->get_where('subject' , array('class_id' => $class_id))->result_array();
				        	foreach($exams as $row){
                            ?>
                                        <div class="exam__cycle">
                                            <strong><?php echo $row[name]; ?></strong>
                                        </div>
                                       <?php } ?>

                                    </div>
                                </div>

                            </div>

                    </div>


                    <div class="report__card__exam__marks__header text__uppercase">
                        <div class="flex ">
                            
                            
                               <?php 
                            $exams = $this->db->get_where('exam')->result_array();
                            
				        	foreach($exams as $row){
				        	    
				        	    $examss = $this->db->get_where('mark',array('exam_id'=> $row[exam_id],'class_id'=>$class_id,'year'=>$running_year))->row()->mark_id; 
				        	   
				        	    
                            ?>
                            <?php if($examss !='') { ?>
                            
                            <div class="subject__information">
                                <div class="subject__name bg__cream">
                                    <p><strong> <?php echo $row['name'];?>(100 marks)</strong></p>
                                </div>
                                        
                                <div class="subject__competencies bg__light__blue">
                                    <div class="flex">
                                  
                                          <?php 
                                $totlasub = $this->db->get_where('subject' , array('class_id' => $class_id))->result_array();
                               
				             	foreach($totlasub as $rowss){
                                $subject_comp = $this->db->get_where('subject_competencies' , array('subject_id' => $rowss[subject_id]))->result_array();
                                
				                   } 
				               	foreach($subject_comp as $row5){
				               	    
                                       ?>   
                                        <div class="subject__competencies__details">
                                            <div class="subject__competencies__heading">    <?php echo $row5[name];?> (10)</div>
                                            <?php 
                                               $subject_competencies = $this->db->get_where('mark',array('subject_id'=> $rowss[subject_id],'student_id'=>$student_id,'exam_id'=>$row[exam_id]))->result_array();
				                	 
				                	        //foreach($subject_competencies as $row5mark){
				                	         ?>
                                            <?php                     
                                            $totlasubss = $this->db->get_where('subject' , array('class_id' => $class_id))->result_array();
                                            
                                            foreach($totlasubss as $rowss44){
                                          
                                                    $subject_compet = $this->db->get_where('mark',array('subject_id'=> $rowss44[subject_id],'student_id'=>$student_id,'exam_id'=>$row[exam_id]))->result_array();
				                	                 foreach($subject_compet as $row5mark5){
                                            ?>
                <div class="subject_grade"><?php echo $this->db->get_where('cat_mark',array('competencies_name'=>$row5['name'],'mark_id'=>$row5mark5['mark_id']))->row()->competencies_marks;?></div>
                                            <?php } ?>
                                             
                                                <?php } ?>
                                        </div>
                                       <?php } ?>
                                                                           
                                    
                                        <div class="subject__competencies__details">
                                            <div class="subject__competencies__heading">Half yearly Exam  (80)</div>
                                             <?php                     
                                            $totlasubss = $this->db->get_where('subject' , array('class_id' => $class_id))->result_array();
                                            
                                            foreach($totlasubss as $rowss88){
                                          
                                                 
                                            ?>
                                            <div class="subject_grade"><?php echo $this->db->get_where('mark',array('subject_id'=>$rowss88[subject_id],'student_id'=>$student_id,'exam_id'=> $row[exam_id]))->row()->mark_obtained;?></div>
                                            
                                            <?php } ?>
                                        </div>

                                        <div class="subject__competencies__details">
                                            <div class="subject__competencies__heading">Marks Obtained  (100)</div>
                                             <?php                     
                                            $totlasubss45 = $this->db->get_where('subject' , array('class_id' => $class_id))->result_array();
                                            
                                            foreach($totlasubss45 as $rowss8844){
                                                
                                           $mark=$this->db->get_where('mark',array('subject_id'=>$rowss8844[subject_id],'student_id'=>$student_id,'exam_id'=>  $row[exam_id],))->row()->mark_obtained;
                                           $mark_id=$this->db->get_where('mark',array('subject_id'=>$rowss8844[subject_id],'student_id'=>$student_id,'exam_id'=>  $row[exam_id],))->row()->mark_id;
                                           $total=  $this->db->query("SELECT SUM(competencies_marks) as completetotal FROM cat_mark WHERE mark_id='$mark_id'")->row(); 
                                 
                                            ?>
                                            <div class="subject_grade"><?php echo ($total->completetotal)+$mark;?></div>
                                          <?php } ?>
                                            
                                        </div>

                                        <div class="subject__competencies__details">
                                            <div class="subject__competencies__heading"><strong>Grade</strong></div>
                                            <div class="subject_grade">A+</div>
                                            <div class="subject_grade">A+</div>
                                            <div class="subject_grade">A+</div>
                                            <div class="subject_grade">A+</div>
                                           
                                        </div>

                                       

                                    </div>

                                  
                                </div>

                            </div>
                            <?php } ?>
                       <?php } ?>
                            

                                

                        </div>
                    </div>
                </div>



                

            </div>





            <!-- Extra Curricular Marks Section -->

            <div class="report__card__extracurricular__marks">
                <div class="flex">
                          <?php 
                            $exams = $this->db->get_where('exam')->result_array();
				        	foreach($exams as $row){
				        	    $examss = $this->db->get_where('mark',array('exam_id'=> $row[exam_id],'class_id'=>$class_id,'year'=>$running_year))->row()->mark_id; 
                            ?>
                            <?php if($examss !='') { ?>
                    
                    <div class="co__scholatic__area">
                        <div class="flex">
                            <div class="co__sholastic__title">
                                <h6><strong>Co-Scholastic Area: Term -1</strong> [on a 3-point  (A-C) grading scale]</h6>
                            </div>
                            <div class="co__sholastic__subtitle width__10">
                                <strong>Grade</strong>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="co__sholastic__item">
                                <h6>Work Education</h6>
                            </div>
                            <div class="co__sholastic__grade width__10">
                                <strong>A+</strong>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="co__sholastic__item">
                                <h6>Art Education</h6>
                            </div>
                            <div class="co__sholastic__grade width__10">
                                <strong>A</strong>
                            </div>
                        </div>

                        
                        <div class="flex">
                            <div class="co__sholastic__item">
                                <h6>Health & Physical Education </h6>
                            </div>
                            <div class="co__sholastic__grade width__10">
                                <strong>B+</strong>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="co__sholastic__item">
                                <h6><strong>Discipline </strong> </h6>
                            </div>
                            <div class="co__sholastic__grade width__10">
                                <strong>B+</strong>
                            </div>
                        </div>



                    </div>
<?php } } ?>
                   <!-- <div class="co__scholatic__area">
                        <div class="flex">
                            <div class="co__sholastic__title">
                                <h6><strong>Co-Scholastic Area: Term -1</strong> [on a 3-point  (A-C) grading scale]</h6>
                            </div>
                            <div class="co__sholastic__subtitle width__10">
                                <strong>Grade</strong>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="co__sholastic__item">
                                <h6>Work Education</h6>
                            </div>
                            <div class="co__sholastic__grade width__10">
                                <strong>A+</strong>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="co__sholastic__item">
                                <h6>Art Education</h6>
                            </div>
                            <div class="co__sholastic__grade width__10">
                                <strong>A</strong>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="co__sholastic__item">
                                <h6>Health & Physical Education </h6>
                            </div>
                            <div class="co__sholastic__grade width__10">
                                <strong>B+</strong>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="co__sholastic__item">
                                <h6><strong>Discipline </strong> </h6>
                            </div>
                            <div class="co__sholastic__grade width__10">
                                <strong>A</strong>
                            </div>
                        </div>



                    </div>-->




                </div>
            </div>



            <!-- Report Card Footer Section -->

            <div class="report__card__footer__info">
                <div class="teacher__remark">
                    <div class="flex">
                        <div>
                            Class teacher's remark : 
                        </div>
                    </div>
                </div>

                <div class="report__footer__details">
                    <div class="flex">
                        <div>
                           <p>Promoted to class :  </p>
                        </div>

                        <div style="text-align: center;">
                            <p>Place : <span> Delhi</span> </p>
                        </div>

                        <div style="text-align: right;">
                            <p>Date : <span><?php echo date("d/m/Y");?></span> </p>
                        </div>


                    </div>
                </div>

                <div class="author__signatures">
                    <div class="flex">
                        

                        <div style="text-align: right;">
                            
                            <p>Mr. Charandeep Singh </p>
                        </div>


                    </div>
                </div>

                <div class="">
                    <div class="flex">
                        <div>
                            <p><strong>Class Teacher</strong></p>
                        </div>

                        <div style="text-align: center;">
                            <p><strong>Head Master</strong> </p>
                        </div>

                        <div style="text-align: right;">
                            
                            <p><strong>Principal </strong></p>
                        </div>


                    </div>
                </div>

            </div>
        </div>          
    </div>
</body>
</html>


<!-- end here class 3 to class 8th code here -->

  
    <?php } elseif($class_id==10 || $class_id==11){ ?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report Card Template</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        .report__card__wrapper{
            width: 70%;
            margin: 30px auto;
        }

        .report__card{
            width: 100%;
            border: 2px solid #DAEEF3;
        }

        .board__logo.report__logo {
            text-align: left;
        }

        .school__logo.report__logo {
            text-align: right;
        }

        .school__name {
            margin: 10px 0px 5px 0;
        }

        .academic__session {
            margin-top: 5px;
        }

        .report__card__title h4 {
            margin-top: 5px;
            font-weight: 700;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 16px;
        }

        .report__card__school__info {
            background: #daeef3;
            border-bottom: 2px solid #000;
        }

        .report__card > div {
            width: 100%;
        }
        .flex{
            display: flex;
            flex: 1;
            flex-direction: row;
            align-items: stretch;
            justify-content: space-between;
            flex-wrap: wrap;
            flex-grow:1;
            width:100%;
            align-content: center;
        }
        .flex div {
            text-align: center;
            flex: 1;
        }
        .report__logo img{
            height: 100px;
            width: 150px;
            object-fit: contain;
        }
        .report__card__wrapper h1,h2,h3,h4,h5,h6,p,span,a,strong{
            margin: 0 auto ;
            color:#000;
        }

        .flex__50 > div{
            flex-basis:100%;
            text-align: left;
            border-collapse: collapse;
            border: 1px solid #DAEEF3;
            padding: 5px;
            text-transform: uppercase;
            font-size: 12px;
            max-width: 100%;
        }
        .bg__blue{
            background-color: #92CDDC;
        }
        .bg__light__blue{
            background-color: #DAEEF3;
        }
        .bg__cream{
            background-color: #EAF1DD;
        }
        .report__card__school__info{
            padding: 5px;
        }
        .report__card__main__title{
            border-width: 2px 0 2px 0;
            border-color: #000;
            border-style: solid;
            padding: 5px 0;
            letter-spacing: 0.5px;
        }
        .width__20{
            width: 20%;
            max-width: 20%;
        }
        .text__left{
            text-align: left !important;

        }
        .text__uppercase{
            text-transform: uppercase;
        }

        .subject__label{
           padding: 5px;
        }
        .subject__name {
            /* width: 22.5%; */
            border-width: 0 1px 1px 0;
            border-color: #000;
            border-style: solid;
            padding: 5px;
            height: 31px;
            line-height: 20px;
        }
        .subject__name:last-child{
            border-right: 0px;
        }

        .report__card__exam__marks {
            border-bottom: 2px solid #000;
        }


        .subject__competencies__label p{
           
            padding: 40px 0;
            font-size: 14px;
            height: 100px;
            font-weight: 700;

        }

        .subject__competencies__label{
            border-width: 1px 0 1px 0;
            border-color: #000;
            border-style: solid;
        }

        .subject__information {
            border-bottom: 1px solid #000;
        }
        
        .subject__competencies {
            
            border-width: 0 0px 0px 0;
            border-color: #000;
            border-style: solid;
            height: 100px;
        }
        /* .subject__competencies:last-child{
            border-right: 0px;
        } */

        .subject__competencies__heading {
            
            text-align: left;
            padding-top: 10px;
            font-size: 12px;
            /* border-right:1px solid #000; */
            letter-spacing: 0.5px;
            margin: 0;
            padding: 5px;
        }

        .subject_grade {
            
            text-align: left;
            padding-top: 10px;
            font-size: 13px;
            
            letter-spacing: 0.5px;
            margin: 0;
            padding: 5px;
            border-bottom: 1px solid #000;
            height: 30px;
            font-weight: 700;
        }

        .subject_grade.subject_final__grade {
            height: 100px;
            line-height: 110px;
        }
        .subject__competencies__details{
            border-right:1px solid #000;
        }

        .subject__competencies__heading{
            /* writing-mode: tb-rl; */
            height: 100px;
            padding-top: 30px;
        }
        .subject__competencies{
            padding: 0px;
        }

        .subject__competencies__heading:last-child{
            border-right: 0;
        }

        .report__card__exam__marks__left{
            border-right: 2px solid #000;
        }

        .exam__term{
            writing-mode: tb-rl;
            font-weight: 700;
            color:#000;
        }
        .exam__term{
            padding: 5px;
            border-right: 1px solid #000;
        }

        .flex .exam__cycle__wrapper {
            flex: 3 ;
        }

        .exam__cycle {
            padding: 5px 0;
            border-bottom: 1px solid #000;
            font-size: 12px;
            font-weight: 700;
            height: 29.5px;
            line-height: 20px;
        }
        .exam__cycle:last-child{
            border-bottom: 0;
        }
        .subject__final__assessment{
            border-top: 2px solid #000;
            border-bottom: 0px solid #000;
            height: 45px;
            font-weight: 700;
            font-size: 12px;
            line-height: 1;
            padding-top: 10px;
        }
        
        .subject__marks_wrapper span{
            margin: 0;
            padding: 1px;
            text-align: center;
        }

        .subject__total__score {
            border-width:1px 2px 1px 1px;
            border-style: solid;
            border-color: #111;
            height: 45px;
            line-height: 45px;
            font-weight: 700;
            color: #000;
        }


        .co__scholatic__area{
            margin-top: 00px;
            border-width: 2px 1px 1px 0px;
            border-color: #000;
            border-style: solid;
            padding: 0;
            text-align: left !important;
            
        }

        .report__card__extracurricular__marks .flex div{
            text-align: left;
        }

        .co__sholastic__title {
            padding-top: 10px;
            padding-left: 5px;
            border-bottom:1px solid #000;
        }

        .co__sholastic__subtitle {
            padding-top: 10px;
            border-left:1px solid #000;
            text-align: center !important;
            border-bottom:1px solid #000;
        }


        .co__sholastic__item {
            padding: 5px;
            border-bottom: 1px solid #000;
        }

        .co__sholastic__grade {
            border-left: 1px solid #000;
            border-bottom: 1px solid #000;
            text-align: center !important;
            padding: 4px;
        }

        .report__card__footer__info .flex div{
            text-align: left;
        }

        .report__card__footer__info{
            padding: 5px;
        }
        
        .author__signatures{
            margin-top: 15px;
        }

        .report__footer__details {
            margin-top: 5px;
        }

        .report__card__student__info__box div p strong {
            display: block;
            width: 50%;
            float: left;
        }

        .subject__mark__box {
            height: 30px;
            border: 1px solid #666;
            border-right: 0;
            border-left: 0;
        }
        .subject__mark__box.bg__light__blue {
            background: #fdcf7c;
        }

        .mark__final__info__item {
            text-align: left !important;
            padding: 10px;
            color: #000;
            font-weight: 700;
        }
        .mt-2{
            margin-top: 2%;
        }

        

    </style>
</head>
<body>
    <div class="report__card__wrapper">
        <div class="report__card">
            <!-- School Informtaion Section -->
            <div class="report__card__school__info">
                <div class="flex">
                    <!-- School Informtaion Left Section -->
                    <div class="report__card__school__info__left">
                        <div class="board__logo report__logo">
                            <img src="http://cbse.nic.in/html/images/logo.png" alt="">
                        </div>
                    </div>

                    <!-- School Informtaion Center Section -->
                    <div class="report__card__school__info__center">
                        <div class="school__name">
                            <h4><strong>Kendriya Vidyalaya Rohini</strong></h4>
                        </div>
                        <div class="school__location">
                            <h6>Sai Baba Chowk, Rohini</h6>
                        </div>

                        <div class="academic__session">
                            <strong>Academic Session</strong> : <span class="academic__session__year">2018-2019</span>
                        </div>

                        <div class="academic__session">
                                <strong>Report Card For Class IX</strong></span>
                            </div>

                       
                    </div>

                    <!-- School Informtaion Right Section -->
                    <div class="report__card__school__info__right">
                        <div class="school__logo report__logo">
                            <img src="https://kvsangathan.nic.in/sites/all/themes/kvs/logo.png" alt="">
                        </div>
                    </div>
                </div>


                
            </div>

            <!-- Student Informtaion Section -->
            <div class="report__card__student__info ">
                <div class="flex">
                    <div class="report__card__student__info__box">
                        <div class="flex flex__50">
                            <div class="roll__number">
                                <p><strong>Roll No : </strong>23</p>
                            </div>
    
                            

                            <div class="student__name">
                                <p><strong>Student Name : </strong> Mridul Rathi</p>
                            </div>
                            
                            
        
                            <div class="student__mother__name">
                                <p><strong>Mother's Name : </strong> Priya Rathi</p>
                            </div>
        
                            <div class="student__father__name">
                                    <p><strong>Father's Name : </strong> Arjun Rathi</p>
                            </div>

                            <div class="student__father__name">
                                <p><strong>Address & Telephone Number </strong> Sector 7, Rohini <br> 7896541230</p>
                            </div>
                            <div class="student__dob">
                                <p><strong>Date Of Birth : </strong>  02/02/1998</p>
                            </div>
    
                            
    
                        </div>
                    </div>
    
                    <div class="report__card__student__info__box">
                        <div class="flex flex__50">
                                <div class="cbse__reg__no">
                                    <p><strong>School Affiliation : </strong>56953</p>
                                </div>

                                <div class="admission_number">
                                    <p><strong>Admission No : </strong>  2558</p>
                                </div>
                                <div class="class__section">
                                    <p><strong>Class & Section : </strong>5th C</p>
                                </div>

                                <div class="admission_number">
                                    <p><strong>Registration No : </strong> 1201</p>
                                </div>
        
                                

                                <div class="class__section mb-4">
                                        <p><strong>Total Attendance : </strong>335</p>
                                        <p><strong>Total Working Days : </strong>448</p>
                                        <p><strong>Percentage : </strong>74.78</p>
                                    </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            
            <!-- Rport Card Title Section -->

            <div class="report__card__main__title bg__blue">
                <div class="text-center flex">
                    <h5><strong>ACADEMIC PERFORMANCE OF THE STUDENT - SCHOLASTIC AREAS</strong></h5>
                </div>
            </div>

            <!-- Exam Marks Section -->
            <div class="report__card__exam__marks ">
                <div class="flex">
                    <div class="report__card__exam__marks__left text__uppercase width__20">

                            <div class="subject__label bg__cream">
                                <p style="text-align:left;"><strong>SCHOLASTIC AREAS</strong></p>
                            </div>

                            <div class="subject__competencies__label bg__light__blue">
                                <p>Subject Name</p>
                            </div>
                            <div class="subject__mark__box bg__light__blue">
                                    
                                </div>
                            
                            <div class="exam__term__wrapper">
                                <div class="flex">
                                   

                                    <div class="exam__cycle__wrapper">
                                        <div class="exam__cycle">
                                            <strong>English</strong>
                                        </div>
                                        <div class="exam__cycle">
                                            <strong>Hindi</strong>
                                        </div>
                                        <div class="exam__cycle">
                                            <strong>Mathematics</strong>
                                        </div>
                                        <div class="exam__cycle">
                                            <strong>EVS</strong>
                                        </div>

                                    </div>
                                </div>

                            </div>

                    </div>


                    <div class="report__card__exam__marks__header text__uppercase">
                        <div class="flex ">
                            <div class="subject__information">
                                <div class="subject__name bg__cream">
                                    <p><strong>Academic Year (100 marks)</strong></p>
                                </div>
                                        
                                <div class="subject__competencies bg__light__blue">
                                    <div class="flex">
                                        <div class="subject__competencies__details">
                                            <div class="subject__competencies__heading">Periodic Test</div>
                                            <div class="subject__mark__box bg__light__blue">
                                                <p>10</p>
                                            </div>
                                            <div class="subject_grade">8.8</div>
                                            <div class="subject_grade">7.2</div>
                                            <div class="subject_grade">3.8</div>
                                            <div class="subject_grade">2.6</div>
                                        </div>

                                        <div class="subject__competencies__details">
                                            <div class="subject__competencies__heading">Note Book</div>
                                            <div class="subject__mark__box bg__light__blue">
                                                <p>5</p>
                                            </div>
                                            <div class="subject_grade">8.8</div>
                                            <div class="subject_grade">7.2</div>
                                            <div class="subject_grade">3.8</div>
                                            <div class="subject_grade">2.6</div>
                                            
                                        </div>

                                        <div class="subject__competencies__details">
                                            <div class="subject__competencies__heading">Subject Enrichment</div>
                                            <div class="subject__mark__box bg__light__blue">
                                                <p>5</p>
                                            </div>
                                            <div class="subject_grade">8.8</div>
                                            <div class="subject_grade">7.2</div>
                                            <div class="subject_grade">3.8</div>
                                            <div class="subject_grade">2.6</div>
                                            
                                        </div>

                                        <div class="subject__competencies__details">
                                            <div class="subject__competencies__heading">Annual Examination</div>
                                            <div class="subject__mark__box bg__light__blue">
                                                <p>80</p>
                                            </div>
                                            <div class="subject_grade">8.8</div>
                                            <div class="subject_grade">7.2</div>
                                            <div class="subject_grade">3.8</div>
                                            <div class="subject_grade">2.6</div>
                                            
                                        </div>

                                        <div class="subject__competencies__details">
                                            <div class="subject__competencies__heading">Marks Obtained</div>
                                            <div class="subject__mark__box bg__light__blue">
                                                <p>100</p>
                                            </div>
                                            <div class="subject_grade">86.2</div>
                                            <div class="subject_grade">70.2</div>
                                            <div class="subject_grade">83.8</div>
                                            <div class="subject_grade">92.6</div>
                                            
                                        </div>

                                        <div class="subject__competencies__details">
                                            <div class="subject__competencies__heading"><strong>Grade</strong></div>
                                            <div class="subject__mark__box bg__light__blue">
                                                <p>50</p>
                                            </div>
                                            <div class="subject_grade">A+</div>
                                            <div class="subject_grade">A+</div>
                                            <div class="subject_grade">A+</div>
                                            <div class="subject_grade">A+</div>
                                           
                                        </div>

                                       

                                    </div>

                                  
                                </div>

                            </div>                              

                        </div>
                    </div>


                    <div class="report__card__exam__marks__left text__uppercase width__20">

                            <div class="subject__label bg__cream">
                                <p>
                                    &nbsp;
                                </p>
                            </div>

                            <div class="subject__competencies__label bg__light__blue">
                                <p>Remarks</p>
                            </div>
                            <div class="subject__mark__box bg__light__blue">
                                    
                            </div>
                            
                            <div class="exam__term__wrapper">
                                <div class="flex">
                                   

                                    <div class="exam__cycle__wrapper">
                                        <div class="exam__cycle">
                                            
                                        </div>
                                        <div class="exam__cycle">
                                            
                                        </div>
                                        <div class="exam__cycle">
                                            
                                        </div>
                                        <div class="exam__cycle">
                                            
                                        </div>

                                    </div>
                                </div>

                            </div>

                    </div>



                </div>



                

            </div>
            <div class="mark__final__info">
                <div class="flex" >

                    <div class="mark__final__info__item">
                        MAXIMUM MARKS = <span>600</span>
                    </div>

                    <div class="mark__final__info__item">
                        MARKS OBTAINED = <span>418</span>
                    </div>

                    <div class="mark__final__info__item">
                        PERCENTAGE = <span>69.7%</span>
                    </div>

                </div>
            </div>




             <!-- Extra Curricular Marks Section -->

             <div class="report__card__extracurricular__marks">
                    
                    <div class="flex">
                        
                        <div class="co__scholatic__area co__scholatic__area__left">
                            <div class="report__card__main__title bg__blue ">
                                    <div class="text-center flex">
                                        <h5><strong>Co-Scholastic Areas as per Class XII CBSE grading system.  </strong></h5>
                                    </div>
                                </div>
                            <div class="flex">
                                <div class="co__sholastic__item">
                                    <h6>Work Education</h6>
                                </div>
                                <div class="co__sholastic__grade width__15">
                                    <strong>A+</strong>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="co__sholastic__item">
                                    <h6>Art Education</h6>
                                </div>
                                <div class="co__sholastic__grade width__15">
                                    <strong>A</strong>
                                </div>
                            </div>

                            
                            <div class="flex">
                                <div class="co__sholastic__item">
                                    <h6>Health & Physical Education </h6>
                                </div>
                                <div class="co__sholastic__grade width__15">
                                    <strong>B+</strong>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="co__sholastic__item">
                                    <h6><strong>ART </strong> </h6>
                                </div>
                                <div class="co__sholastic__grade width__15">
                                    <strong>B+</strong>
                                </div>
                            </div>
                        </div>


                        <div class="co__scholatic__area co__scholatic__area__right">
                            <div class="flex">
                                <div class="co__sholastic__item">
                                    <h6>Supplementry Subject</h6>
                                </div>
                                <div class="co__sholastic__grade ">
                                    <strong>A+</strong>
                                </div>
                            </div>

                            
                            <div class="flex">
                                <div class="co__sholastic__item">
                                    <h6>(a) Passed/Detained/Supplementry </h6>
                                </div>
                                <div class="co__sholastic__grade ">
                                    <strong>Pass</strong>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="co__sholastic__item">
                                    <h6><strong>(b) Position in class </strong> </h6>
                                </div>
                                <div class="co__sholastic__grade ">
                                    <strong>B+</strong>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="co__sholastic__item">
                                    <h6><strong>Overall Grade </strong> </h6>
                                </div>
                                <div class="co__sholastic__grade ">
                                    <strong>B+</strong>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Report Card Footer Section -->

            <div class="report__card__footer__info">
                

                    <div class="mt-2">
                        <div class="flex">
                            <div>
                                <p><strong>Sign Of I/C Exam</strong></p>
                            </div>
    
                            <div style="text-align: center;">
                                <p><strong>Class Teacher</strong> </p>
                            </div>
    
                            <div style="text-align: center;">
                                
                                <p><strong>Checker </strong></p>
                            </div>
    
                            
                            <div style="text-align:center;">
                                
                                    <p><strong>Principal </strong></p>
                            </div>
    
                            <div style="text-align: right;">
                                    <p><strong>#FT = Fail In Theory </strong></p>
                            </div>
    
    
                        </div>
                    </div>
    
    
                </div>

            </div>

            

        </div>

        <!-- Report Card Footer Section -->

        </div>          
    </div>
</body>
</html>
 
 
      <?php }elseif($class_id==12){ ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report Card Template</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        .report__card__wrapper{
            width: 90%;
            margin: 30px auto;
        }

        .report__card{
            width: 100%;
            border: 2px solid #000;
        }

        .board__logo.report__logo {
            text-align: left;
        }

        .school__logo.report__logo {
            text-align: right;
        }

        .school__name {
            margin: 10px 0px 5px 0;
        }

        .academic__session {
            margin-top: 5px;
        }

        .report__card__title h4 {
            margin-top: 5px;
            font-weight: 700;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 16px;
        }

        .report__card__school__info {
            background: #daeef3;
            border-bottom: 2px solid #000;
        }

        .report__card > div {
            width: 100%;
        }
        .flex{
            display: flex;
            flex: 1;
            flex-direction: row;
            align-items: stretch;
            justify-content: space-between;
            flex-wrap: wrap;
            flex-grow:1;
            width:100%;
            align-content: center;
        }
        .flex div {
            text-align: center;
            flex: 1;
        }
        .report__logo img{
            height: 75px;
            width: 150px;
            object-fit: contain;
            object-position: left;
        }
        .report__card__wrapper h1,h2,h3,h4,h5,h6,p,span,a,strong{
            margin: 0 auto ;
            color:#000;
        }

        .flex__25 > div{
            flex-basis:25%;
            text-align: left;
            border-collapse: collapse;
            border: 1px solid #DAEEF3;
            padding: 5px;
            text-transform: uppercase;
            font-size: 12px;
            max-width: 25%;
        }

        .flex__100 > div{
            flex-basis:100%;
            text-align: left;
            border-collapse: collapse;
            border: 1px solid #DAEEF3;
            padding: 5px;
            text-transform: uppercase;
            font-size: 12px;
            max-width: 100%;
        }

        .flex__30{
            flex-basis:30%;
            max-width: 30%;
        }

        .bg__blue{
            background-color: #92CDDC;
        }
        .bg__light__blue{
            background-color: #DAEEF3;
        }
        .bg__cream{
            background-color: #EAF1DD;
        }
        .report__card__school__info{
            padding: 5px;
        }
        .report__card__main__title{
            border-width: 2px 0 2px 0;
            border-color: #000;
            border-style: solid;
            padding: 5px 0;
            letter-spacing: 0.5px;
        }
        .width__15{
            width: 15%;
            max-width: 15%;
        }

        
        .text__left{
            text-align: left !important;

        }
        .text__uppercase{
            text-transform: uppercase;
        }

        .subject__label{
           padding: 5px;
        }
        .subject__name {
            /* width: 22.5%; */
            border-width: 0 1px 1px 0;
            border-color: #000;
            border-style: solid;
            padding: 5px;
            height: 51px;
            line-height:50px; 
        }
        .subject__name:last-child{
            border-right: 0px;
        }

        .report__card__exam__marks {
            border-bottom: 2px solid #000;
        }


        .subject__competencies__label p{
           
            padding: 90px 0;
            font-size: 14px;
            height: 100px;
            font-weight: 700;

        }

        .subject__competencies__label{
            border-width: 1px 0 1px 0;
            border-color: #000;
            border-style: solid;
        }

        .subject__information {
            border-bottom: 1px solid #000;
        }
        
        .subject__competencies {
            
            border-width: 0 0px 0px 0;
            border-color: #000;
            border-style: solid;
            height: 100px;
        }
        /* .subject__competencies:last-child{
            border-right: 0px;
        } */

        .subject__competencies__heading {
            
            text-align: left;
            padding-top: 10px;
            font-size: 12px;
            /* border-right:1px solid #000; */
            letter-spacing: 0.5px;
            margin: 0;
            padding: 5px;
        }

        .subject_grade {
            
            text-align: left;
            padding-top: 10px;
            font-size: 13px;
            
            letter-spacing: 0.5px;
            margin: 0;
            padding: 5px;
            border-bottom: 1px solid #000;
            height: 30px;
            font-weight: 700;
        }

        .subject_grade.subject_final__grade {
            height: 100px;
            line-height: 110px;
        }
        .subject__competencies__details{
            border-right:1px solid #000;
        }

        .subject__competencies__heading{
            writing-mode: tb-rl;
            height: 100px;
            padding-top: 10px;
            text-align: left !important;
            width: 100%;
        }
        .subject__competencies{
            padding: 0px;
        }

        .subject__competencies__heading:last-child{
            border-right: 0;
        }

        .report__card__exam__marks__left{
            border-right: 2px solid #000;
        }

        .exam__term{
            writing-mode: tb-rl;
            font-weight: 700;
            color:#000;
        }
        .exam__term{
            padding: 5px;
            border-right: 1px solid #000;
        }

        .flex .exam__cycle__wrapper {
            flex: 3 ;
        }

        .exam__cycle {
            padding: 5px 0;
            border-bottom: 1px solid #000;
            font-size: 12px;
            font-weight: 700;
            height: 29.5px;
            line-height: 20px;
        }
        .exam__cycle:last-child{
            border-bottom: 0;
        }
        .subject__final__assessment{
            border-top: 2px solid #000;
            border-bottom: 0px solid #000;
            height: 45px;
            font-weight: 700;
            font-size: 12px;
            line-height: 1;
            padding-top: 10px;
        }
        
        .subject__marks_wrapper span{
            margin: 0;
            padding: 1px;
            text-align: center;
        }

        .subject__total__score {
            border-width:1px 2px 1px 1px;
            border-style: solid;
            border-color: #111;
            height: 45px;
            line-height: 45px;
            font-weight: 700;
            color: #000;
        }


        .co__scholatic__area{
            margin-top: 10px;
            border-width: 2px 1px 1px 0px;
            border-color: #000;
            border-style: solid;
            padding: 0;
            text-align: left !important;
            
        }

        .report__card__extracurricular__marks .flex div{
            text-align: left;
        }

        .co__sholastic__title {
            padding-top: 10px;
            padding-left: 5px;
            border-bottom:1px solid #000;
        }

        .co__sholastic__subtitle {
            padding-top: 10px;
            border-left:1px solid #000;
            text-align: center !important;
            border-bottom:1px solid #000;
        }


        .co__sholastic__item {
            padding: 5px;
            /* border-bottom: 1px solid #000; */
        }

        .co__sholastic__grade {
            border-left: 1px solid #000;
            /* border-bottom: 1px solid #000; */
            text-align: center !important;
            padding: 4px;
        }

        .report__card__footer__info .flex div{
            text-align: left;
        }

        .report__card__footer__info{
            padding: 5px;
        }
        
        .author__signatures{
            margin-top: 15px;
        }

        .report__footer__details {
            margin-top: 5px;
        }
        .flex__basis__100{
            flex-basis:100%;
            max-width: 100%;
        }
        .mt-2{
            margin-top: 2%;
        }

        .mb-4{
            margin-bottom: 4%;
        }


        .report__card__student__info__box div p strong {
            display: block;
            width: 50%;
            float: left;
        }

        .report__card__student__info__box > div > div {
            padding: 15px 10px;
            background: #f5f5f5;
            border-color: #eee;
        }

        .report__card__left__section {
            border-right: 1px solid #222;
        }
        .subject__competencies__label {
            height: 150px;
        }

        .subject__mark__box {
            height: 30px;
            border: 1px solid #666;
            border-right: 0;
            border-left: 0;
        }

        .subject__mark__box.bg__light__blue {
            background: #fdcf7c;
        }
        .subject__mark__box.bg__light__blue p{
            color: #000;
            font-weight: 700;
        }
        .bg__light__yellow{
            background: #fdcf7c;
        }

        .co__scholatic__area.co__scholatic__area__right .flex {
            height: 40px;
            border-bottom: 1px solid #000;
        }

        .co__scholatic__area.co__scholatic__area__left .flex {
            height: 30px;
            border-bottom: 1px solid #000;
        }

        .mark__final__info__item{
            text-align: left !important;
            padding: 10px;
            color: #000;
            font-weight: 700;
        }



        

    </style>
</head>
<body>
    <div class="report__card__wrapper">
        
        
        <div class="report__card">
            <!-- Report Card Flex -->
            <div class="flex">
                <!-- Report Card LEFT SECTION BEGINS HERE -->
                <div class="report__card__left__section flex__30">
                <!-- School Informtaion Section -->
                    <div class="report__card__school__info">
                        <div class="">
                            <div class="flex mt-2 mb-4">
                                <!-- School Informtaion Left Section -->
                                <div class="report__card__school__info__left">
                                    <div class="board__logo report__logo">
                                        <img src="http://cbse.nic.in/html/images/logo.png" alt="">
                                    </div>
                                </div>
                                <!-- School Informtaion Right Section -->
                                <div class="report__card__school__info__right">
                                    <div class="school__logo report__logo">
                                        <img src="https://kvsangathan.nic.in/sites/all/themes/kvs/logo.png" alt="" style=' object-position: right;'>
                                    </div>
                                </div>
                            </div>

                            <div class="flex__basis__100 mb-4">
                                <!-- School Informtaion Center Section -->
                                <div class="report__card__school__info__center">
                                    <div class="school__name">
                                        <h4><strong>Kendriya Vidyalaya Rohini</strong></h4>
                                    </div>
                                    <div class="school__location">
                                        <h6>Sai Baba Chowk, Rohini</h6>
                                    </div>
    
                                    <div class="academic__session">
                                        <strong>Academic Session</strong> : <span class="academic__session__year">2018-2019</span>
                                    </div>
    
                                    <div class="report__card__title">
                                        <h4>Report Card</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        
                    </div>

                    <!-- Student Informtaion Section -->
                    <div class="report__card__student__info ">
                        <div class="report__card__student__info__box">
                            <div class="flex flex__100">
                                <div class="cbse__reg__no">
                                    <p><strong>Affiliation No : </strong>56953</p>
                                </div>
                                
                                <div class="roll__number">
                                    <p><strong>Roll No :</strong>  23</p>
                                </div>

                                <div class="admission_number">
                                    <p><strong>Admission No : </strong> 2558</p>
                                </div>

                                <div class="admission_number">
                                    <p><strong>Registration No : </strong> 1201</p>
                                </div>

                                <div class="student__name">
                                    <p><strong>Student Name : </strong> Mridul Rathi</p>
                                </div>

                                <div class="class__section">
                                    <p><strong>Class & Section : </strong>5th C</p>
                                </div>

                                


                                
                            </div>
                        </div>

                        <div class="report__card__student__info__box">
                            <div class="flex flex__100">

                                
                                
                                <div class="student__dob">
                                    <p><strong>Date Of Birth : </strong>  02/02/1998</p>
                                </div>
            
                                <div class="student__mother__name">
                                    <p><strong>Mother's Name : </strong> Priya Rathi</p>
                                </div>
            
                                <div class="student__father__name">
                                        <p><strong>Father's Name : </strong> Arjun Rathi</p>
                                </div>

                                <div class="student__father__name">
                                    <p><strong>Address & Telephone Number </strong> Sector 7, Rohini <br> 7896541230</p>
                                </div>

                                <div class="class__section mb-4">
                                    <p><strong>Total Attendance : </strong>335</p>
                                    <p><strong>Total Working Days : </strong>448</p>
                                    <p><strong>Percentage : </strong>74.78</p>
                                </div>

                                <div class="student__father__name">
                                    <p class="mt-2">Specimen sign of Parents/ Guardian</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <!-- Report Card LEFT SECTION BEGINS HERE -->

            
                 <!-- Report Card Right SECTION BEGINS HERE -->
                <div class="report__card__right__section">
                    <!-- Rport Card Title Section -->

                    <div class="report__card__main__title bg__blue" style="border-top: 0;">
                        <div class="text-center flex">
                            <h5><strong>PART 1 NON PRACTICAL/ NON PROJECT SUBJECTS </strong></h5>
                        </div>
                    </div>

                    <!-- Exam Marks Section -->
                    <div class="report__card__exam__marks ">
                        <div class="flex">
                            <div class="report__card__exam__marks__left text__uppercase width__15 " >
                                <div class="subject__competencies__label bg__light__blue" style="border-top:0">
                                    <p>Subject Name</p>
                                </div>

                                <div class="subject__mark__box bg__light__blue">
                                   
                                </div>
                                
                                <div class="exam__term__wrapper">
                                    <div class="flex">
                                    
                                        <div class="exam__cycle__wrapper">
                                            <div class="exam__cycle">
                                                <strong>English</strong>
                                            </div>
                                            <div class="exam__cycle">
                                                <strong>Hindi</strong>
                                            </div>
                                            <div class="exam__cycle">
                                                <strong>Mathematics</strong>
                                            </div>
                                            <div class="exam__cycle">
                                                <strong>EVS</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="report__card__exam__marks__header text__uppercase" style="max-width:25%;"> 
                                <div class="flex ">
                                    <div class="subject__information">
                                        <div class="subject__name bg__light__blue">
                                            
                                        </div>
                                                
                                        <div class="subject__competencies bg__light__blue">
                                            <div class="flex">
                                                <div class="subject__competencies__details">
                                                    <div class="subject__competencies__heading">Periodic Test 1</div>
                                                    <div class="subject__mark__box bg__light__blue">
                                                        <p>50</p>
                                                    </div>
                                                    <div class="subject_grade">8.8</div>
                                                    <div class="subject_grade">7.2</div>
                                                    <div class="subject_grade">3.8</div>
                                                    <div class="subject_grade" style="border-bottom:0">2.6</div>
                                                </div>

                                                <div class="subject__competencies__details">
                                                    <div class="subject__competencies__heading">Periodic Test 2</div>
                                                    <div class="subject__mark__box bg__light__blue">
                                                        <p>50</p>
                                                    </div>
                                                    <div class="subject_grade">8.8</div>
                                                    <div class="subject_grade">7.2</div>
                                                    <div class="subject_grade">3.8</div>
                                                    <div class="subject_grade" style="border-bottom:0">2.6</div>
                                                </div>

                                                <div class="subject__competencies__details">
                                                    <div class="subject__competencies__heading">H.Y Exam</div>
                                                    <div class="subject__mark__box bg__light__blue">
                                                        <p>50</p>
                                                    </div>
                                                    <div class="subject_grade">8.8</div>
                                                    <div class="subject_grade">7.2</div>
                                                    <div class="subject_grade">3.8</div>
                                                    <div class="subject_grade" style="border-bottom:0">2.6</div>
                                                    
                                                </div>

                                                <div class="subject__competencies__details">
                                                    <div class="subject__competencies__heading">S.E Exams</div>
                                                    <div class="subject__mark__box bg__light__blue">
                                                        <p>50</p>
                                                    </div>
                                                    <div class="subject_grade">8.8</div>
                                                    <div class="subject_grade">7.2</div>
                                                    <div class="subject_grade">3.8</div>
                                                    <div class="subject_grade" style="border-bottom:0">2.6</div>
                                                    
                                                </div>

                                                
                                            </div>
                                        </div>
                                    </div>                              
                                </div>
                            </div>

                            <div class="report__card__exam__marks__header text__uppercase" style="max-width:60%;">
                                <div class="flex ">
                                    <div class="subject__information">
                                        <div class="subject__name bg__cream">
                                            <p><strong>Weightage</strong></p>
                                        </div>
                                                
                                        <div class="subject__competencies bg__light__blue">
                                            <div class="flex">
                                                <div class="subject__competencies__details">
                                                    <div class="subject__competencies__heading">Periodic Test 1</div>
                                                    <div class="subject__mark__box bg__light__blue">
                                                        <p>50</p>
                                                    </div>
                                                    <div class="subject_grade">8.8</div>
                                                    <div class="subject_grade">7.2</div>
                                                    <div class="subject_grade">3.8</div>
                                                    <div class="subject_grade" style="border-bottom:0">2.6</div>
                                                </div>

                                                <div class="subject__competencies__details">
                                                    <div class="subject__competencies__heading">Periodic Test 2</div>
                                                    <div class="subject__mark__box bg__light__blue">
                                                        <p>50</p>
                                                    </div>
                                                    <div class="subject_grade">8.8</div>
                                                    <div class="subject_grade">7.2</div>
                                                    <div class="subject_grade">3.8</div>
                                                    <div class="subject_grade" style="border-bottom:0">2.6</div>
                                                    
                                                </div>

                                                <div class="subject__competencies__details">
                                                    <div class="subject__competencies__heading">H.Y Exams</div>
                                                    <div class="subject__mark__box bg__light__blue">
                                                        <p>50</p>
                                                    </div>
                                                    <div class="subject_grade">8.8</div>
                                                    <div class="subject_grade">7.2</div>
                                                    <div class="subject_grade">3.8</div>
                                                    <div class="subject_grade" style="border-bottom:0">2.6</div>
                                                    
                                                </div>

                                                <div class="subject__competencies__details">
                                                    <div class="subject__competencies__heading">TOTAL</div>
                                                    <div class="subject__mark__box bg__light__blue">
                                                        <p>50</p>
                                                    </div>
                                                    <div class="subject_grade bg__light__yellow">8.8</div>
                                                    <div class="subject_grade bg__light__yellow">7.2</div>
                                                    <div class="subject_grade bg__light__yellow">3.8</div>
                                                    <div class="subject_grade bg__light__yellow" style="border-bottom:0">2.6</div>
                                                    
                                                </div>

                                                <div class="subject__competencies__details">
                                                    <div class="subject__competencies__heading">S.E Exams</div>
                                                    <div class="subject__mark__box bg__light__blue">
                                                        <p>50</p>
                                                    </div>
                                                    <div class="subject_grade">8.8</div>
                                                    <div class="subject_grade">7.2</div>
                                                    <div class="subject_grade">3.8</div>
                                                    <div class="subject_grade" style="border-bottom:0">2.6</div>
                                                    
                                                </div>

                                                <div class="subject__competencies__details grand__total">
                                                    <div class="subject__competencies__heading">GRAND TOTAL</div>
                                                    <div class="subject__mark__box bg__light__blue">
                                                        <p>50</p>
                                                    </div>
                                                    <div class="subject_grade bg__light__yellow">8.8</div>
                                                    <div class="subject_grade bg__light__yellow">7.2</div>
                                                    <div class="subject_grade bg__light__yellow">3.8</div>
                                                    <div class="subject_grade bg__light__yellow" >2.6</div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>                              
                                </div>
                            </div>

                            <div class="report__card__exam__marks__header  text__uppercase" style="max-width:10%;">
                                <div class="flex ">
                                    <div class="subject__information">
                                        <div class="subject__name bg__light__blue">
                                            <p></p>
                                        </div>
                                                
                                        <div class="subject__competencies bg__light__blue">
                                            <div class="flex">
                                                <div class="subject__competencies__details">
                                                    <div class="subject__competencies__heading">Remarks</div>
                                                    <div class="subject__mark__box bg__light__blue">
                                                        <p></p>
                                                    </div>
                                                    <div class="subject_grade"></div>
                                                    <div class="subject_grade"></div>
                                                    <div class="subject_grade"></div>
                                                    <div class="subject_grade" style="border-bottom:0"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                              
                                </div>
                            </div>
                        </div>
                        <!-- Report Card Right SECTION ENDS HERE -->


                    </div>
                    
                    <div class="report__card__main__title bg__blue mt-2">
                        <div class="text-center flex">
                            <h5><strong>PART 2 SUBJECT WITH PRACTICAL/PROJECTS </strong></h5>
                        </div>
                    </div>
                    <!-- Exam Marks Section -->
                    <div class="report__card__exam__marks ">
                            <div class="flex">
                                <div class="report__card__exam__marks__left text__uppercase width__15">
                                    <div class="subject__competencies__label bg__light__blue " style="border-top:0">
                                        <p>Subject Name</p>
                                    </div>
    
                                    <div class="subject__mark__box bg__light__blue">
                                       
                                    </div>
                                    
                                    <div class="exam__term__wrapper">
                                        <div class="flex">
                                        
                                            <div class="exam__cycle__wrapper">
                                                <div class="exam__cycle">
                                                    <strong>English</strong>
                                                </div>
                                                <div class="exam__cycle">
                                                    <strong>Hindi</strong>
                                                </div>
                                                <div class="exam__cycle">
                                                    <strong>Mathematics</strong>
                                                </div>
                                                <div class="exam__cycle">
                                                    <strong>EVS</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="report__card__exam__marks__header text__uppercase" style="max-width:25%;"> 
                                    <div class="flex ">
                                        <div class="subject__information">
                                            <div class="subject__name bg__light__blue">
                                                
                                            </div>
                                                    
                                            <div class="subject__competencies bg__light__blue">
                                                <div class="flex">
                                                    <div class="subject__competencies__details">
                                                        <div class="subject__competencies__heading">Periodic Test 1</div>
                                                        <div class="subject__mark__box bg__light__blue">
                                                            <p>50</p>
                                                        </div>
                                                        <div class="subject_grade">8.8</div>
                                                        <div class="subject_grade">7.2</div>
                                                        <div class="subject_grade">3.8</div>
                                                        <div class="subject_grade" style="border-bottom:0">2.6</div>
                                                    </div>
    
                                                    <div class="subject__competencies__details">
                                                        <div class="subject__competencies__heading">Periodic Test 2</div>
                                                        <div class="subject__mark__box bg__light__blue">
                                                            <p>50</p>
                                                        </div>
                                                        <div class="subject_grade">8.8</div>
                                                        <div class="subject_grade">7.2</div>
                                                        <div class="subject_grade">3.8</div>
                                                        <div class="subject_grade" style="border-bottom:0">2.6</div>
                                                    </div>
    
                                                    <div class="subject__competencies__details">
                                                        <div class="subject__competencies__heading">H.Y Exam</div>
                                                        <div class="subject__mark__box bg__light__blue">
                                                            <p>50</p>
                                                        </div>
                                                        <div class="subject_grade">8.8</div>
                                                        <div class="subject_grade">7.2</div>
                                                        <div class="subject_grade">3.8</div>
                                                        <div class="subject_grade" style="border-bottom:0">2.6</div>
                                                        
                                                    </div>
    
                                                    <div class="subject__competencies__details">
                                                        <div class="subject__competencies__heading">S.E Exams</div>
                                                        <div class="subject__mark__box bg__light__blue">
                                                            <p>50</p>
                                                        </div>
                                                        <div class="subject_grade">8.8</div>
                                                        <div class="subject_grade">7.2</div>
                                                        <div class="subject_grade">3.8</div>
                                                        <div class="subject_grade" style="border-bottom:0">2.6</div>
                                                        
                                                    </div>

                                                    <div class="subject__competencies__details">
                                                        <div class="subject__competencies__heading">PRACT/PROJ</div>
                                                        <div class="subject__mark__box bg__light__blue">
                                                            <p>50</p>
                                                        </div>
                                                        <div class="subject_grade">8.8</div>
                                                        <div class="subject_grade">7.2</div>
                                                        <div class="subject_grade">3.8</div>
                                                        <div class="subject_grade" style="border-bottom:0">2.6</div>
                                                        
                                                    </div>
    
                                                    
                                                </div>
                                            </div>
                                        </div>                              
                                    </div>
                                </div>
    
                                <div class="report__card__exam__marks__header text__uppercase" style="max-width:70%;">
                                    <div class="flex ">
                                        <div class="subject__information">
                                            <div class="subject__name bg__cream">
                                                <p><strong>Weightage</strong></p>
                                            </div>
                                                    
                                            <div class="subject__competencies bg__light__blue">
                                                <div class="flex">
                                                    <div class="subject__competencies__details">
                                                        <div class="subject__competencies__heading">Periodic Test 1</div>
                                                        <div class="subject__mark__box bg__light__blue">
                                                            <p>50</p>
                                                        </div>
                                                        <div class="subject_grade">8.8</div>
                                                        <div class="subject_grade">7.2</div>
                                                        <div class="subject_grade">3.8</div>
                                                        <div class="subject_grade" style="border-bottom:0">2.6</div>
                                                    </div>
    
                                                    <div class="subject__competencies__details">
                                                        <div class="subject__competencies__heading">Periodic Test 2</div>
                                                        <div class="subject__mark__box bg__light__blue">
                                                            <p>50</p>
                                                        </div>
                                                        <div class="subject_grade">8.8</div>
                                                        <div class="subject_grade">7.2</div>
                                                        <div class="subject_grade">3.8</div>
                                                        <div class="subject_grade" style="border-bottom:0">2.6</div>
                                                        
                                                    </div>
    
                                                    <div class="subject__competencies__details">
                                                        <div class="subject__competencies__heading">H.Y Exams</div>
                                                        <div class="subject__mark__box bg__light__blue">
                                                            <p>50</p>
                                                        </div>
                                                        <div class="subject_grade">8.8</div>
                                                        <div class="subject_grade">7.2</div>
                                                        <div class="subject_grade">3.8</div>
                                                        <div class="subject_grade" style="border-bottom:0">2.6</div>
                                                        
                                                    </div>
    
                                                    <div class="subject__competencies__details">
                                                        <div class="subject__competencies__heading">TOTAL</div>
                                                        <div class="subject__mark__box bg__light__blue">
                                                            <p>50</p>
                                                        </div>
                                                        <div class="subject_grade bg__light__yellow">8.8</div>
                                                        <div class="subject_grade bg__light__yellow">7.2</div>
                                                        <div class="subject_grade bg__light__yellow">3.8</div>
                                                        <div class="subject_grade bg__light__yellow" style="border-bottom:0">2.6</div>
                                                        
                                                    </div>
    
                                                    <div class="subject__competencies__details">
                                                        <div class="subject__competencies__heading">S.E THEORY</div>
                                                        <div class="subject__mark__box bg__light__blue">
                                                            <p>50</p>
                                                        </div>
                                                        <div class="subject_grade">8.8</div>
                                                        <div class="subject_grade">7.2</div>
                                                        <div class="subject_grade">3.8</div>
                                                        <div class="subject_grade" style="border-bottom:0">2.6</div>
                                                        
                                                    </div>

                                                    <div class="subject__competencies__details">
                                                        <div class="subject__competencies__heading">TOTAl PRACTICAL</div>
                                                        <div class="subject__mark__box bg__light__blue">
                                                            <p>50</p>
                                                        </div>
                                                        <div class="subject_grade">8.8</div>
                                                        <div class="subject_grade">7.2</div>
                                                        <div class="subject_grade">3.8</div>
                                                        <div class="subject_grade" style="border-bottom:0">2.6</div>
                                                        
                                                    </div>

                                                    <div class="subject__competencies__details">
                                                        <div class="subject__competencies__heading">THEORY PRACTICAL</div>
                                                        <div class="subject__mark__box bg__light__blue">
                                                            <p>50</p>
                                                        </div>
                                                        <div class="subject_grade">8.8</div>
                                                        <div class="subject_grade">7.2</div>
                                                        <div class="subject_grade">3.8</div>
                                                        <div class="subject_grade" style="border-bottom:0">2.6</div>
                                                        
                                                    </div>
    
                                                    <div class="subject__competencies__details grand__total">
                                                        <div class="subject__competencies__heading">GRAND TOTAL</div>
                                                        <div class="subject__mark__box bg__light__blue">
                                                            <p>50</p>
                                                        </div>
                                                        <div class="subject_grade bg__light__yellow">8.8</div>
                                                        <div class="subject_grade bg__light__yellow">7.2</div>
                                                        <div class="subject_grade bg__light__yellow">3.8</div>
                                                        <div class="subject_grade bg__light__yellow" style="border-bottom:0">2.6</div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                              
                                    </div>
                                </div>
    
                                <div class="report__card__exam__marks__header  text__uppercase" style="max-width:10%;">
                                    <div class="flex ">
                                        <div class="subject__information">
                                            <div class="subject__name bg__light__blue">
                                                <p></p>
                                            </div>
                                                    
                                            <div class="subject__competencies bg__light__blue">
                                                <div class="flex">
                                                    <div class="subject__competencies__details">
                                                        <div class="subject__competencies__heading">Remarks</div>
                                                        <div class="subject__mark__box bg__light__blue">
                                                            <p></p>
                                                        </div>
                                                        <div class="subject_grade"></div>
                                                        <div class="subject_grade"></div>
                                                        <div class="subject_grade"></div>
                                                        <div class="subject_grade" style="border-bottom:0"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                              
                                    </div>
                                </div>
                            </div>
                            <!-- Report Card Right SECTION ENDS HERE -->
    
    
                        </div>
                    
                    <div class="mark__final__info">
                        <div class="flex" >

                            <div class="mark__final__info__item">
                                MAXIMUM MARKS = <span>600</span>
                            </div>

                            <div class="mark__final__info__item">
                                MARKS OBTAINED = <span>418</span>
                            </div>

                            <div class="mark__final__info__item">
                                PERCENTAGE = <span>69.7%</span>
                            </div>

                        </div>
                    </div>

                    <!-- Extra Curricular Marks Section -->

                    <div class="report__card__extracurricular__marks">
                        <div class="report__card__main__title bg__blue ">
                            <div class="text-center flex">
                                <h5><strong>Co-Scholastic Areas as per Class XII CBSE grading system.  </strong></h5>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="co__scholatic__area co__scholatic__area__left">
                                <div class="flex">
                                    <div class="co__sholastic__item">
                                        <h6>Work Education</h6>
                                    </div>
                                    <div class="co__sholastic__grade width__15">
                                        <strong>A+</strong>
                                    </div>
                                </div>

                                <div class="flex">
                                    <div class="co__sholastic__item">
                                        <h6>Art Education</h6>
                                    </div>
                                    <div class="co__sholastic__grade width__15">
                                        <strong>A</strong>
                                    </div>
                                </div>

                                
                                <div class="flex">
                                    <div class="co__sholastic__item">
                                        <h6>Health & Physical Education </h6>
                                    </div>
                                    <div class="co__sholastic__grade width__15">
                                        <strong>B+</strong>
                                    </div>
                                </div>

                                <div class="flex">
                                    <div class="co__sholastic__item">
                                        <h6><strong>ART </strong> </h6>
                                    </div>
                                    <div class="co__sholastic__grade width__15">
                                        <strong>B+</strong>
                                    </div>
                                </div>
                            </div>


                            <div class="co__scholatic__area co__scholatic__area__right">
                                <div class="flex">
                                    <div class="co__sholastic__item">
                                        <h6>Supplementry Subject</h6>
                                    </div>
                                    <div class="co__sholastic__grade ">
                                        <strong>A+</strong>
                                    </div>
                                </div>

                                
                                <div class="flex">
                                    <div class="co__sholastic__item">
                                        <h6>(a) Passed/Detained/Supplementry </h6>
                                    </div>
                                    <div class="co__sholastic__grade ">
                                        <strong>Pass</strong>
                                    </div>
                                </div>

                                <div class="flex">
                                    <div class="co__sholastic__item">
                                        <h6><strong>(b) Position in class </strong> </h6>
                                    </div>
                                    <div class="co__sholastic__grade ">
                                        <strong>B+</strong>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <!-- Report Card Footer Section -->

            <div class="report__card__footer__info">
                

                <div class="mt-2">
                    <div class="flex">
                        <div>
                            <p><strong>Sign Of I/C Exam</strong></p>
                        </div>

                        <div style="text-align: center;">
                            <p><strong>Class Teacher</strong> </p>
                        </div>

                        <div style="text-align: center;">
                            
                            <p><strong>Checker </strong></p>
                        </div>

                        
                        <div style="text-align:center;">
                            
                                <p><strong>Principal </strong></p>
                        </div>

                        <div style="text-align: right;">
                                <p><strong>#FT = Fail In Theory </strong></p>
                        </div>


                    </div>
                </div>


            </div>
        </div>          
    </div>
</body>
</html>
      <?php } ?>
