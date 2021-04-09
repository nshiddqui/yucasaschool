<?php $activeTab = "academic_dashboard"; ?>

<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Hostel</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>

  <!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/academic_nav_tab.php'; ?> 
  <!-- Including Navigation Tab -->
</div>

<?php 
//echo $class_id;
      $this->db->select('*');
      $this->db->from('subject S');
      if($class_id != ""){
      	//$where = "FIND_IN_SET(".$class_id.",S.class_id) is NOT NULL";
      	//$this->db->where($where);
      	 $this->db->where('class_id', $class_id);
      }
      //$this->db->group_by('C.class_id','ASC');
      $subject_arr = $this->db->get()->result();
      //print_r($subject_arr);
      $arr_heightmark=array();$arr_minmark=array();$arr_subject=array();
      if(sizeof($subject_arr) > 0){
      foreach($subject_arr as $sub_dt){
         $subject_id   = $sub_dt->subject_id;
         $subject_name = $sub_dt->name;

         $max_mark = $this->db->query("select MAX(mark_obtained) as hightmark from mark where subject_id = $subject_id AND class_id = $class_id")->row();
         $min_mark = $this->db->query("select MIN(mark_obtained) as min_mark from mark where subject_id = $subject_id AND class_id = $class_id")->row();
         
             $submit_assignment = $this->db->get_where('submit_assignment',array('assignment_id'=> $assignment_id,'class_id' => $class_id))->result();
          $assign=0;
           foreach ($submit_assignment  as $key => $ass_mark) {
                if($ass_mark->mark != ""){
                    $assignment_persent = ($ass_mark->mark*100)/$dtt->assignment_marks;
                  if($assignment_persent > 50)
                    $assign++;
                }
                

           }
         $arr_subject[]    = $subject_name;
         if($max_mark->hightmark != "")
          $arr_heightmark[] = $max_mark->hightmark;
         else
          $arr_heightmark[] = 0;

	      if($min_mark->min_mark != "")
	         $arr_minmark[]    = $min_mark->min_mark;
	      else
      		 $arr_minmark[]    = 0;
         
      }
    }
      if(sizeof($arr_subject) > 0){
        $data_['labels']   = $arr_subject;
        $data_['datasets'] = array(array('label'=>'Highest Marks','backgroundColor'=>"#437D84",'data' => $arr_heightmark),array('label'=>'Lowest Marks','backgroundColor'=>"#7FC5AB",'data' => $arr_minmark));
        $graph_data = json_encode($data_);
       } 
        $count_student_result   = $this->db->get_where('enroll',array('year'=>$this->year))->result();
      $total_studentof_school = count($count_student_result);

      $count_student = $this->db->get_where('enroll',array('class_id'=>$class_id,'year'=>$this->year))->result();
      $total_student = count($count_student);
      $student_avrage= $total_studentof_school/$total_student;


      $assignment_issue = $this->db->get_where('submit_assignment',array('class_id'=>$class_id,'status'=>1))->result();

      $assignment_issue_value = count($assignment_issue);


     $assignment_persent_value = count($assignment_persent);
       ?>
<input type="hidden" value='<?php echo $graph_data;?>' id="graph_data">


<div class="container-fluid hidden" >
    <div class="row">
        <ul  class="nav nav-tabs ed">
            <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#hostel-info"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> Hostel Information</a> </li>
            <?php if(has_permission(ADD, 'hostel', 'hostel')){ ?>
            
            <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#hostel-attendance"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> Hostel Attendance</a> </li>                          
            <?php } ?>                
        </ul>
    </div>
</div>

<div class="container-fluid">

  <!-- WIDGET SECTION STARTS HERE -->
  <div class="row">
      <div class="">
      <div class="widget-indicators">
        <div class="indicator-item">

          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/list.png" style="max-height:40px;"></div>
          </div>

          <div class="indicator-item-value">
            <span class="indicator-value-counter" data-toggle="counter" data-end="<?php echo $student_avrage;?>"><?php echo round($student_avrage);?></span>
          </div>

           <div class="indicator-value-title">Average Class Strength</div>
        </div>


        <div class="indicator-item">
          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/stopwatch.png" style="max-height:40px;"></div>
          </div>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-end="157">15</span>
          </div>
           <div class="indicator-value-title">No. Of Syllabus Delayed</div>
        </div>



        <div class="indicator-item">
          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/essay.png" style="max-height:40px;"></div>
          </div>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-decimals="1" data-end="17.9"><?php echo $assignment_issue_value;?></span>
            
          </div>
          <div class="indicator-value-title">Assignment Issued Currently</div>
        </div>


        
        <div class="indicator-item">
          <div class="indicator-item-icon">
             <div class="icon"><img src="<?php echo base_url();?>assets/images/checklist.png" style="max-height:40px;"></div>
          </div>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-decimals="2" data-end="78,450" data-prefix="$"><?php echo  $assign;?></span>
           
          </div>
           <div class="indicator-value-title">Student With Less Than 50%</div>

        </div>



      </div>
    </div>
  </div>
  
  <!-- WIDGET SECTION ENDS HERE -->

  <!-- CHART SECTION BEGINS HERE -->
    <div class="row">
    <div class="col-sm-12 p0">
      <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?> " id="hostel-info" >
        <div class="panel-group ">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title"> <a data-toggle="collapse" data-expanded="true" aria-expanded="true" href="#hostel_info_chart" > <span class="open-close pull-right in"><i class="fa fa-chevron-down"></i></span>Academic Dashboard </a> </h4>
            </div>
            <div id="hostel_info_chart" class="panel-collapse collapse in" data-expanded="true">
              <div id="section_holder">
                <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('select_class'); ?></label>
                        <select name="section_id" id="section_id" class="form-control selectboxit" onchange ="change_select_url(this.value);">
                          <?php $sections = $this->db->get('class')->result_array();
                            foreach ($sections as $row):  ?>
                                <option <?php if($row['class_id'] == $class_id){echo 'selected';} ?> value="<?php echo $row['class_id']; ?>" >
                                    <?php echo $row['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>
            </div>
              <canvas id="bar-chart" style="width:80vw;height:60vh;"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>


<!-- <div>
    <a href="" onclick="loadpage(); return false;">Load Page</a>
</div> -->

<!-- CHART JS FILES --> 
<script src="<?php echo base_url('assets/js/moment.js');?>"></script> 
<script src="<?php echo base_url('assets/js/Chart.bundle.min.js');?>"></script> 
<!-- <script>
    var speed = 250;

  
    new Chart(document.getElementById("bar-chart"), {
      type: 'horizontalBar',
        data: {
          labels: ["Nursery", "1", "2", "3", "4","5","6","7","8","9","10","11","12"],
          datasets: [
            {
              label: "Present",
              backgroundColor: "#3e95cd",
              data: [25,29,34,16,34,25,32,19,26,24,32,26,25]
            }, {
              label: "Absent",
              backgroundColor: "#8e5ea2",
              data: [25,32,19,26,24,25,29,34,16,34,32,26,25]
            }
          ]
        },
        options: {
          legend: { display: false },
          title: {
            display: true,
            text: 'Pass Fail Comparison - Classwise'
          },
           animation: {
                duration: speed * 1.5,
                easing: 'linear'
              }


        }
    });
</script> -->
<script>
    var speed = 250;
     var speed = 250;
     var graph_data = $('#graph_data').val();
     graph_data = JSON.parse(graph_data);
     /*
     
     {
          labels: ["English", "Hindi", "Math", "Science"],
          datasets: [
            {
              label: "Highest Marks",
              backgroundColor: "#3e95cd",
              data: [98,73,81,36]
            }, {
              label: "Lowest Marks",
              backgroundColor: "#8e5ea2",
              data: [06,12,13,21]
            }
          ]
        }
     
     */
    new Chart(document.getElementById("bar-chart"), {
      type: 'bar',
        data: graph_data,
        options: {
          legend: { 
              display: true,
              labels: {
                fontSize:16
            }
          },
          title: {
            display: true,
            text: 'Comparitive chart of highest and lowest grade pre subject Assignments',
            fontSize:16
          },
           animation: {
                duration: speed * 1.5,
                easing: 'linear'
              },
             scales: {
                yAxes: [{
                    ticks: {
                        fontSize: 16
                    }
                }],
                
                xAxes: [{
                    ticks: {
                        fontSize: 16
                    }
                }]
            }


        }
    });


    function change_select_url(val){
      if(val != ""){
        window.location.href = "<?php echo site_url();?>admin/academic_dashboard/"+val;
      }
 } 

</script>