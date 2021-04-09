<style>
.exam_chart {
    width           : 100%;
    height      : 265px;
    font-size   : 11px;
}
  
</style>


<?php $activeTab = "exam_marks"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Exam</a></li>
        <li class="active">Student Marsheet</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/student/exam_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>
   <?php 
    $student_info  = $this->crud_model->get_student_info($student_id);
    $exams         = $this->crud_model->get_exams();
    $marks_type    = marks_type();
    foreach ($student_info as $row1):
      foreach ($exams as $row2):
   ?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary panel-shadow" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title"><?php echo $row2['name'];?></div>
            </div>
            <div class="panel-body">
               <div class="col-md-6">
                   <table class="table table-bordered">
                       <thead>
                        <tr>
                            <td style="text-align: center;"><?php echo get_phrase('subject');?></td>
                            <?php if($marks_type =='marks_and_grade' || $marks_type =='only_marks'){ ?>
                            <td style="text-align: center;"><?php echo get_phrase('obtained_marks');?></td>
                            <td style="text-align: center;"><?php echo get_phrase('highest_mark');?></td>
                            <?php } ?>
                            <?php if($marks_type =='marks_and_grade' || $marks_type =='only_grade'){ ?>
                            <td style="text-align: center;"><?php echo get_phrase('grade');?></td>
                            <?php } ?>
                            <td style="text-align: center;"><?php echo get_phrase('comment');?></td>
                        </tr>
                       </thead>
                    <tbody>
                        <?php 
                            $total_marks = 0;
                            $total_grade_point = 0;
                            $subjects = $this->db->get_where('subject' , array(
                                'class_id' => $class_id , 'year' => $running_year
                            ))->result_array();
                            foreach ($subjects as $row3):

                                $obtained_mark_query = $this->db->get_where('mark' , array(
                                                    'subject_id' => $row3['subject_id'],
                                                        'exam_id' => $row2['exam_id'],
                                                            'class_id' => $class_id,
                                                                'student_id' => $student_id , 
                                                                    'year' => $running_year));
                        ?>
                            <tr>
                                <td style="text-align: center;"><?php echo $row3['name'];?></td>
                                 <?php if($marks_type =='marks_and_grade' || $marks_type =='only_marks'){ ?>
                                <td style="text-align: center;">
                                    <?php
                                        
                                        if ( $obtained_mark_query->num_rows() > 0) {
                                            $marks = $obtained_mark_query->result_array();
                                            foreach ($marks as $row4) {
                                                echo $row4['mark_obtained'];
                                                $total_marks += $row4['mark_obtained'];
                                            }
                                        }
                                    ?>
                                </td>
                               
                                <td style="text-align: center;">
                                    <?php

                                    $highest_mark = $this->crud_model->get_highest_marks( $row2['exam_id'] , $class_id , $row3['subject_id'] );
                                    echo $highest_mark;


        
                                    ?>
                                </td>
                                <?php } ?>
                                 <?php if($marks_type =='marks_and_grade' || $marks_type =='only_grade'){ ?>

                                <td style="text-align: center;">
                                    <?php
                                        if($obtained_mark_query->num_rows() > 0) {
                                            $marks = $obtained_mark_query->result_array();
                                            foreach ($marks as $row4) {
                                                $row4['mark_obtained'];
                                                $total_marks += $row4['mark_obtained'];
                                            }

                                            if ($row4['mark_obtained'] >= 0 || $row4['mark_obtained'] != '') {
                                                $grade = $this->crud_model->get_grade($row4['mark_obtained']);
                                                echo $grade['name'];
                                                $total_grade_point += $grade['grade_point'];
                                            }
                                        }
                                    ?>
                                </td>
                               <?php } ?>
                                <td style="text-align: center;">
                                    <?php if($obtained_mark_query->num_rows() > 0) 
                                            echo $row4['comment'];
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach;?>
                     </tbody>
                   </table>
                <hr />
                <?php if($marks_type =='marks_and_grade' || $marks_type =='only_marks' ){ ?>
                    <?php //echo get_phrase('total_marks');?>  <?php //echo $total_marks;?>
                <?php } ?>
                <br>
                 <?php if($marks_type =='marks_and_grade' || $marks_type =='only_grade'){ ?>
                <?php// echo get_phrase('average_grade_point');?> : 
                    <?php 
                        $this->db->where('class_id' , $class_id);
                        $this->db->where('year' , $running_year);
                        $this->db->from('subject');
                        $number_of_subjects = $this->db->count_all_results();
                        if($total_grade_point !="")
                       // echo ($total_grade_point / $number_of_subjects);
                    ?>
                <?php } ?>
                    <br> <br>
                    <a href="<?php echo site_url('student/student_marksheet_print_view/'.$student_id.'/'.$row2['exam_id']);?>"
                        class="btn btn-primary" target="_blank">
                        <?php echo get_phrase('print_marksheet');?>
                    </a>
               </div>

               <div class="col-md-6">
                   <div id="chartdiv<?php echo $row2['exam_id'];?>" class="exam_chart"></div>
                       <script type="text/javascript">
                            var chart<?php echo $row2['exam_id'];?> = AmCharts.makeChart("chartdiv<?php echo $row2['exam_id'];?>", {
                                "theme": "none",
                                "type": "serial",
                                "dataProvider": [
                                        <?php 
                                            foreach ($subjects as $subject) :
                                        ?>
                                        {
                                            "subject": "<?php echo $subject['name'];?>",
                                             "mark_lowest": 
                                            <?php
                                                $obtained_mark = $this->crud_model->get_lowest_marks( $row2['exam_id'] , $class_id , $subject['subject_id'] , $row1['student_id']);
                                                echo $obtained_mark;
                                            ?>,
                                            "mark_obtained": 
                                            <?php
                                                $obtained_mark = $this->crud_model->get_obtained_marks( $row2['exam_id'] , $class_id , $subject['subject_id'] , $row1['student_id']);
                                                echo $obtained_mark;
                                            ?>,
                                            "mark_highest": 
                                            <?php
                                                $highest_mark = $this->crud_model->get_highest_marks( $row2['exam_id'] , $class_id , $subject['subject_id'] );
                                                echo $highest_mark;
                                            ?>
                                        },
                                        <?php 
                                            endforeach;

                                        ?>
                                    
                                ],
                                "valueAxes": [{
                                    "stackType": "3d",
                                    "unit": "%",
                                    "position": "left",
                                    "title": "Obtained Mark vs Highest Mark"
                                }],
                                "startDuration": 1,
                                "graphs": [{
                                    "balloonText": "Lowest Mark in [[category]]: <b>[[value]]</b>",
                                    "fillAlphas": 0.9,
                                    "lineAlpha": 0.2,
                                    "title": "2005",
                                    "type": "column",
                                    "fillColors":"#C77E7E",
                                    "valueField": "mark_lowest"
                                },{
                                    "balloonText": "Obtained Mark in [[category]]: <b>[[value]]</b>",
                                    "fillAlphas": 0.9,
                                    "lineAlpha": 0.2,
                                    "title": "2004",
                                    "type": "column",
                                    "fillColors":"#7f8c8d",
                                    "valueField": "mark_obtained"
                                }, {
                                    "balloonText": "Highest Mark in [[category]]: <b>[[value]]</b>",
                                    "fillAlphas": 0.9,
                                    "lineAlpha": 0.2,
                                    "title": "2005",
                                    "type": "column",
                                    "fillColors":"#34495e",
                                    "valueField": "mark_highest"
                                }],
                                "plotAreaFillAlphas": 0.1,
                                "depth3D": 20,
                                "angle": 45,
                                "categoryField": "subject",
                                "categoryAxis": {
                                    "gridPosition": "start"
                                },
                                "exportConfig":{
                                    "menuTop":"20px",
                                    "menuRight":"20px",
                                    "menuItems": [{
                                        "format": 'png'   
                                    }]  
                                }
                            });
                    </script>
               </div>
               
            </div>
        </div>  
    </div>
</div>
</div>
<?php
    endforeach;
        endforeach;
?>