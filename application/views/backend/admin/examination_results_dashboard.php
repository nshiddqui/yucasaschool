<?php $activeTab = "examination_results_dashboard"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Examination & Results</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/examination_results_nav_tab.php'; ?> 
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
  
       ?>
<input type="hidden" value='<?php echo $graph_data;?>' id="graph_data">
<div class="container-fluid">
<!-- WIDGET SECTION STARTS HERE -->
  <div class="row">
      <div class="">
      <div class="widget-indicators">
        <div class="indicator-item">

          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/list.png" style="max-height:40px;"></div>
          </div>

          <?php 
             $total_student = $this->db->get('enroll')->result();
           ?>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-end="1646"><?php echo count($total_student);?></span>
            
          </div>
          <div class="indicator-value-title">Total Students</div>
        </div>


        <div class="indicator-item">
          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/stopwatch.png" style="max-height:40px;"></div>
          </div>
          <?php 
             $total_student = $this->db->get_where('enroll',array('year'=>$this->year))->result();
          ?>
          
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-end="857"><?php echo count($total_student);?></span>
            
          </div>
          <div class="indicator-value-title">Total Student (<?php echo $this->year;?>)</div>
        </div>



        <div class="indicator-item">
          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/essay.png" style="max-height:40px;"></div>
          </div>
          <?php 
             $total_student = $this->db->get_where('pre_enroll',array('year'=>$this->year))->result();
          ?>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-decimals="1" data-end="17"><?php echo  count($total_student);?></span>
            
          </div>
          <div class="indicator-value-title">Total Pre Exam Registration</div>
        </div>


        
        <div class="indicator-item">
          <div class="indicator-item-icon">
             <div class="icon"><img src="<?php echo base_url();?>assets/images/checklist.png" style="max-height:40px;"></div>
          </div>
         <?php 
             $total_student = $this->db->get_where('pre_online_exam',array('running_year'=>$this->year))->result();
          ?>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-decimals="2" data-end="540" data-prefix="$"><?php echo  count($total_student);?></span>
            
          </div>

          <div class="indicator-value-title">Total Pre Exam</div>

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
              <h4 class="panel-title"> <a data-toggle="collapse" data-expanded="true" aria-expanded="true" href="#hostel_info_chart" >Examination And Results<span class="open-close pull-right in"><i class="fas fa-chevron-down"></i></span></a> </h4>
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
            <canvas id="bar-chart" style="width:80vw;height:65vh;"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- CHART SECTION BEGINS HERE -->
</div>
<!-- CHART JS FILES --> 
<script src="<?php echo base_url('assets/js/moment.js');?>"></script> 
<script src="<?php echo base_url('assets/js/Chart.bundle.min.js');?>"></script> 
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
              display: false,
              labels: {
              fontSize:16
            }
          },
          title: {
            display: true,
            text: 'Comparitive chart of highest and lowest marks per subject',
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
        window.location.href = "<?php echo site_url();?>/admin/examination_results_dashboard/"+val;
      }
 } 
</script>