<?php
	$class_name		 	= 	$this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
	$exam_name  		= 	$this->db->get_where('exam' , array('exam_id' => $exam_id))->row()->name;
	$system_name        =	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
	$board_setting        =	$this->db->get_where('settings' , array('type'=>'board_setting'))->row()->description;
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
                   $mother_name= $row3['mother_name'];
                 $birthday= $row3['birthday'];
                 $student_code= $row3['student_code'];
                     $class_name= $row3['class_name'];
                         $section_name= $row3['section_name'];
                             $roll= $row3['roll'];
             }
          ?>
       <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report Card | <?php echo $system_name ?></title>
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
            background: #234f1e;
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
           
            padding: 22px 0;
            font-size: 10px;
            height: 44px;
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
            /* height: 125px; */
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
                            <img src="<?= base_url('/uploads/logo.png')?>" alt="">
                        </div>
                    </div>

                    <!-- School Informtaion Center Section -->
                    <div class="report__card__school__info__center">
                        <div class="school__name">
                            <h4><strong style="color:#fff"><?php echo $system_name ?></strong></h4>
                        </div>
                        <div class="school__location">
                            <h6 style="color:#fff"><?php echo $address ?></h6>
                        </div>

                        <div class="academic__session">
                            <strong style="color:#fff">Academic Session</strong> : <span class="academic__session__year" style="color:#fff"><?php echo $running_year ?></span>
                        </div>

                        <div class="report__card__title">
                            <h4 style="color:#fff">Report Card</h4>
                        </div>
                    </div>

                    <!-- School Informtaion Right Section -->
                    <div class="report__card__school__info__right">
                        <div class="school__logo report__logo">
                            
                        </div>
                    </div>
                </div>

<?php
$grades = $this->db->get_where('grade')->result();
function getGrade($percentage,$grades){
    foreach($grades as $grade){
        if($grade->mark_from <= $percentage && $grade->mark_upto >= $percentage){
            return $grade->name;
        }
    }
return $grade; 
}?>
                
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
                            <p><strong>Exam Name : </strong><?= $exam_name ?></p>
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
                                <p><strong>Mother's Name : </strong> <?php echo $mother_name ?> </p>
                            </div>
        
                            <div class="student__father__name">
                                    <p><strong>Father's Name : </strong> <?php echo $parent_name ?></p>
                            </div>
                        </div>
                    </div>
            </div>

            
            <!-- Rport Card Title Section -->

            <div class="report__card__main__title" style="background:#c1fcc1">
                <div class="text-center flex" >
                    <h5><strong>RESULT OF STUDENT</strong></h5>
                </div>
            </div>

            <!-- Exam Marks Section -->
            <div class="report__card__exam__marks ">
                <div class="flex">
                       <div class="report__card__exam__marks__left text__uppercase width__10">

                            <div class="subject__label bg__cream">
                                <p ><strong>Subject</strong></p>
                            </div>
                            <?php 
                            $cycles = $this->db->get_where('exam_cycle' , array('exam_id' => $exam_id))->result_array();
                            foreach($cycles as $rowscycle){
                            ?>
                            <div class="subject__competencies__label bg__light__blue">
                                <p><?php echo $rowscycle[name];?></p>
                            </div>
                            <?php } ?>
                           

                    </div>

                    
                    
                    
                    
                    <div class="report__card__exam__marks__header text__uppercase">
                        <div class="flex ">
                           <?php 
                           $exams = $this->db->get_where('subject' , array('class_id' => $class_id,'section_id' => $section_id))->result_array();
                           $count=1;
                           $total_obtained=array();
                                $total_from=array();
				        	foreach($exams as $row){
                           ?>                              
                            <div class="subject__information">
                                <div class="subject__name bg__cream">
                                    <p><strong><?php echo $row[name]; ?></strong></p>
                                </div>
                                
                                <?php 
                                
                                $int=0;
                                
                                    $subject_competencies = $this->db->get_where('mark',array('subject_id'=> $row[subject_id],'student_id'=>$student_id,'exam_id'=> $exam_id))->result_array();
                                
                                if(!empty($subject_competencies)){
				                	     foreach($subject_competencies as $row5mark){
                                ?>        
                                <div class="subject__competencies bg__light__blue">
                                    
                                        
                                            
                                        
                                    
                                    <div class="subject__total__score"><?php $marks= $row5mark['mark_obtained'] ? $row5mark['mark_obtained']:0; $total_obtained[$int]=$total_obtained[$int]+$marks; echo $marks?>/<?php  $row_mark=$row5mark['mark_total'] ? $row5mark['mark_total']:100; $total_from[$int]=$total_from[$int]+$row_mark; echo $row_mark;?>
</div>
                                </div>
                                <?php
				                	     }
                                }else{ ?>
                                
                                <div class="subject__competencies bg__light__blue">
                                
                                    <div class="subject__total__score">Not defined</div>
                                </div>
                                <?php } ?>

                            
                            <?php $int++;  ?>
</div>

<?php if($count==count($exams)){?>
<div class="subject__information">
                                <div class="subject__name bg__cream">
                                    <p><strong>Percentage|Grade</strong></p>
                                </div>
                                <?php if(!empty($total_obtained)){
                                    $inc=0;
                                foreach($total_obtained as $total)
                                ?>
                                <div class="subject__competencies bg__light__blue">
                                    
                                        
                                            
                                        
                                    
                                    <div class="subject__total__score"><?php echo $percentage=round(($total/$total_from[$inc])*100,2);?> % | <?php echo getGrade($percentage,$grades);?></div>
                                </div>
                                <?php $inc++;} ?>
                                </div>
                                <?php } ?>
                           <?php
                           $count++;
                           }  ?>                            
                            

                           

                                

                        </div>
                    </div>
                </div>



                

            </div>


            <!-- Extra Curricular Marks Section -->

            <div class="report__card__extracurricular__marks">
                <div class="flex" style="height:170px">
                    <!--<div class="co__scholatic__area">-->
                        <!--<div class="flex" >-->
            <!--                <div class="co__sholastic__title">-->
            <!--                    <h6><strong>Co-Scholastic Area: Term -1</strong> [on a 3-point  (A-C) grading scale]</h6>-->
            <!--                </div>-->
            <!--                <div class="co__sholastic__subtitle width__10">-->
            <!--                    <strong>Grade</strong>-->
            <!--                </div>-->
            <!--            </div>-->

            <!--            <div class="flex">-->
            <!--                <div class="co__sholastic__item">-->
            <!--                    <h6>Work Education</h6>-->
            <!--                </div>-->
            <!--                <div class="co__sholastic__grade width__10">-->
            <!--                    <strong>A+</strong>-->
            <!--                </div>-->
            <!--            </div>-->

            <!--            <div class="flex">-->
            <!--                <div class="co__sholastic__item">-->
            <!--                    <h6>Art Education</h6>-->
            <!--                </div>-->
            <!--                <div class="co__sholastic__grade width__10">-->
            <!--                    <strong>A</strong>-->
            <!--                </div>-->
            <!--            </div>-->

                        
            <!--            <div class="flex">-->
            <!--                <div class="co__sholastic__item">-->
            <!--                    <h6>Health & Physical Education </h6>-->
            <!--                </div>-->
            <!--                <div class="co__sholastic__grade width__10">-->
            <!--                    <strong>B+</strong>-->
            <!--                </div>-->
            <!--            </div>-->

            <!--            <div class="flex">-->
            <!--                <div class="co__sholastic__item">-->
            <!--                    <h6><strong>Discipline </strong> </h6>-->
            <!--                </div>-->
            <!--                <div class="co__sholastic__grade width__10">-->
            <!--                    <strong>B+</strong>-->
            <!--                </div>-->
            <!--            </div>-->



                    
                    <!--</div>-->


                </div>
            </div>
            <hr>



            <!-- Report Card Footer Section -->

            <div class="report__card__footer__info">
                <div class="teacher__remark">
                    <div class="flex" style="padding-bottom: 10px;">
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

                        <div>
                            <p>Place : <span> </span> </p>
                        </div>

                        <div style="text-align: right;">
                            <p>Date : <span> <?= date('m/d/Y')?></span> </p>
                        </div>


                    </div>
                </div>

                <div class="author__signatures">
                    <div class="flex">
                        

                        <div style="text-align: right;">
                            
                            
                        </div>


                    </div>
                </div>

                <div class="">
                    <div class="flex">
                        <div>
                            <p><strong>Class Teacher</strong></p>
                        </div>

                        <div >
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
