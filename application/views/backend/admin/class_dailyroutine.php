<?php $activeTab = "class_routine"; 
 $timetable_name = "";
 $timetable_time = "";$interval_      = "";
 $numberofperiod = "";$template_idd   = "";

    if($template_data_result != ""){
     $timetable_name = $template_data_result->name;
     $timetable_time = $template_data_result->start_time;
     $interval_      = $template_data_result->time_interval;
     $numberofperiod = $template_data_result->numberofperiod;
     $template_idd   = $template_data_result->id;
    }
?>
<style>
    .timetable { }
/*body table tbody td.timetable-class { font-size: 12px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; font-family: 'Oswald', sans-serif; }*/
/*.timetable-class,.timetable.table>tbody>tr>td { color: #fff; }*/
/*.timetable,.table>tbody>tr>th { font-size: 14px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; font-family: 'Oswald', sans-serif; }*/
/*.timetable,.table>thead>tr>th { font-size: 14px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; font-family: 'Oswald', sans-serif; }*/
.table { width: 100%; max-width: 100%; margin-bottom: 1rem; }
.box-table { padding: 16px 30px; margin: 0 -15px 15px; border-color:; border: 1px solid #eee; }
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th { border-top: transparent; color: #26282c; border-bottom: 1px solid #eee; }
.table thead th { vertical-align: bottom; border-bottom: 2px solid #eee; }
.table-striped tbody tr:nth-of-type(odd) { background-color: hsl(224, 100%, 99%); }
caption { padding-top: .75rem; padding-bottom: .75rem; color: #26282c; text-align: left; caption-side: bottom; }
.mb30{margin-bottom:30px;}

.timetable.table thead tr th {
  background: #2e3e65;
  padding: 2%;
  margin: 2%;
  font-size: 12px;
  text-align: center;
  color: #fff;
  border-right: 1px solid #6f6f6f;
  width: 14.166%;
  font-weight: 900;
  text-transform:uppercase;
}

.timetable.table tbody tr:nth-child(2n+1) th,.timetable.table tbody tr:nth-child(2n+1) td {
  background:#bed1ff;
  padding: 2% 1%;
  margin: 2%;
  font-size: 12px;
  text-align: center;
  color: #333;
  border: 1px solid #333;
}



.timetable.table tbody tr:nth-child(2n) th,.timetable.table tbody tr:nth-child(2n) td {
  background:#8ec8f7;
  padding: 2% 1%;
  margin: 2%;
  font-size: 12px;
  text-align: center;
  color: #333;
  border: 1px solid #333;
}
.timetable.table tbody tr th{
    font-weight: 900;
    text-align: left !important;
    width: 12%;
    color: #e54c2d !important;
    vertical-align: middle;
    display: none;
}
.tt_subject{
  font-weight: 900;
  line-height: 1;
}
.tt_teacher{
  font-size: 10px;
  line-height: 1;
}
.tt_note{
  font-size: 10px;
  letter-spacing: 0;
}
.tt_time{
  font-size: 10px;
  letter-spacing: 0;
  margin-bottom: 5px;
  font-weight: 900;
  letter-spacing: 0.5px;
  color: #333;
}

.tt_date{
  font-size: 10px;
  letter-spacing: 0;
  margin-bottom: 5px;
  font-weight: 700;
  letter-spacing: 0.5px;
  color: #fff;
}
.timetable.table tbody tr.trmiddle td{
    vertical-align: middle;
}

.tt_period_hidden{
    display: none;
}
</style>


<?php $activeTab = "class_routine"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Time Table</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>

  <!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/academic_nav_tab.php'; ?> 
  <!-- Including Navigation Tab -->
</div>
<!-- time-table -->
<div class="content">
  <div class="container-fluid">
     <div  class="table-responsive col-sm-12 p0 time_table_view">
         <?php
          
            $daywise = array('monday','tuesday','wednesday','thursday','friday','saturday'); 
            $today_day  = strtolower(date('l',strtotime(date('Y-m-d'))));
          ?>
              <div class="heading">
                  <h2>Class Time Table  </h2>
              </div>

              <?php 
             // echo "select MAX(numberofperiod) as max_numberofperiod_val from class_routine_template T,class_routine R  where  T.id = R.template_id AND R.template_active = 1";
                $max_numberofperiod_ = @$this->db->query("select MAX(numberofperiod) as max_numberofperiod_val from class_routine_template T,class_routine R  where  T.id = R.template_id AND R.template_active = 1")->row()->max_numberofperiod_val;
               
                $numberofperiod_sum      = $max_numberofperiod_;
                    /////////////////////total Period ///////////
              ?>
                    
             <table class="timetable table table-striped col-sm-12">
                <thead>
                   <!--  <tr class="text-center">
                      <th scope="col" day="mon">Class / period </th>
                        <?php 
                          for($t = 1;$t<= $count_total_period;$t++){ ?>
                              <th scope="col" day="mon">period <?php echo $t;?>                       
                              </th>
                      <?php } ?>
                    </tr>  -->
                </thead>
                <tbody>

              <?php
               ////////////////create horizontal line ///////////////
               $class_data = $this->db->order_by('class_id','ASC')->get_where('class',array('status'=>1))->result();                      
               // for($k=0;$k<count($daywise); $k++) {
                foreach ($class_data as $key => $class_dt) {

 
                    $j         = $k+1; $day_ = ""; 
                    $date      = date("Y-m-d");
                    $temp_date = "";
                    $date_time = strtotime(date("H:i:s"));
                    $day_      = $today_day;
                    $universal_name_val = "Empty";

                    $class_data = $this->db->order_by('class_id','ASC')->get_where('class',array('status'=>1))->result();

                    $class_id = $class_dt->class_id;
                                        
              ?>
                        <tr period="1" class="period_tr">
                         <td scope="col" day="<?php echo $day_;?>"><?php echo $class_dt->name;?>                        
                            <div class="tt_date"></div>
                         </td>
                        <td scope="col" day="<?php echo $day_;?>">                       
                          
                            <div class="row">
                                <div class="form-group">
                                  <label class="control-label" style="margin-bottom: 5px;width:200px"><?php echo get_phrase('section'); ?></label> 
                                <select  attr_value="<?php echo $class_dt->name.'_'.$class_dt->class_id;?>" class="form-control selectboxit" onchange="change_section_wise_period(this.value,this);" >

                                    <?php
                                      $sections = $this->db->get_where('section', array('class_id' => $class_dt->class_id))->result_array();
                                      foreach ($sections as $row):
                                      ?>
                                          <option value="<?php echo $row['name'].'_'.$row['section_id'];?>" >
                                                  <?php echo $row['name']; ?>
                                          </option>
                                      <?php endforeach; ?>
                                  </select>
                              </div>
                            </div>
                        </td>
                       <?php
                          //echo date("H:i A",strtotime('+40 minutes',strtotime('13:30 PM')));
                          $count = 1;
                       
                         
                          $GLOBALS['minutes_'] = '+'.$interval_." minutes";
                          
                          for($i = 0;$i < $numberofperiod_sum;$i++){ 
                                 ?>
                            <td id = "id<?php echo $k; ?>"  data-day="<?=$j;?>">
                            <?php $sections_val = $this->db->order_by('class_id','asc')->get_where('section', array('class_id' => $class_dt->class_id))->result();
                              foreach ($sections_val as $dt => $sec_value) {

                                $var_section_id      = $sec_value->section_id;
                                $class_routine_value =  @$this->db->order_by('class_routine_id','asc')->get_where('class_routine',array('period'=>$i+1,'day'=>$day_,'class_id'=>$class_dt->class_id,'section_id'=>$var_section_id,'template_active'=>1))->row(); 

                                $var_class_routine_id = $class_routine_value->class_routine_id;

                            ?>
                            <div class= "<?php echo $sec_value->name.'_'.$sec_value->section_id;?>  <?php echo $class_dt->name.'_'.$class_dt->class_id;?>" style="display:<?php if($dt == 0){ echo 'block';}else{echo 'none';}?>" > 
                              <?php 
                                if($var_class_routine_id != ""){
                                  $var_class_routine_id = $class_routine_value->class_routine_id;
                                  $time_start = $class_routine_value->time_start;
                                  $time_end   = $class_routine_value->time_end;
                                  $teacher_id   = $class_routine_value->teacher_id;

                                    echo $subjectsdata = @$this->db->query("select * from subject S,class_routine R  where FIND_IN_SET($class_id,S.class_id) AND R.subject_id = S.subject_id AND R.section_id = $var_section_id AND R.class_routine_id=$var_class_routine_id")->row()->name;
                                      //$class_routine_value->subject_id 
                                      echo "<br/>";
                                      $this->db->select('T.*');
                                      $this->db->from('assign_subject AS S');
                                      $this->db->join('teacher AS T', 'T.teacher_id = S.teacher_id','left');
                                      $this->db->where('S.subject_id',$class_routine_value->subject_id );
                                      $this->db->where('S.teacher_id',$class_routine_value->teacher_id );
                                      $teacherdata = $this->db->get()->row()->name;
                                      $timenow = date('d-m-Y');
                                      $timestamp = strtotime($timenow);
                                        $template_val = $this->db->query("select *from emp_attendance where timestamp= $timestamp AND status='NULL' AND role_id=5 AND emp_id= $class_routine_value->teacher_id")->row()->emp_id;
                                          $template_val->emp_id ;
                                      if($template_val !=''){
                                         echo "<span>$teacherdata</span>";
                                      }else {
                                        echo "$teacherdata";
                                      }
                                ?>  
                                <div class="tt_time">[<?php echo $time_start.' - '.$time_end;?>]</div>
                                <span class="tt_subject">&nbsp;</span><br>
                           
                                <?php 
                                $timenow = date('d-m-Y');
                                $timestamp = strtotime($timenow);
                                   $status= $this->db->get_where('emp_attendance', array('emp_id' => $teacher_id,'role_id'=>5,'timestamp'=>$timestamp))->row()->status; ?>
                                <?php if($status==1){ ?>
                                <span class="tt_teacher"><?php echo $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row()->name; ?></span><br>
                                <?php } else { ?>
                                 <span class="tt_teacher"style="color: red;"><?php echo $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row()->name; ?></span><br>
                               
                                  <div class="tt_teacher">
                        <select name="teacher[<?php echo $i;?>][<?php echo $k;?>]" id="teacher_<?php echo $i;?><?php echo $k;?>" class="form-control">
                            <option value="" >Select Subject</option>
                             <?php if($class_routine_value != ""){ 
                                    $this->db->select('T.*');
                                    $this->db->from('assign_subject AS S');
                                    $this->db->join('teacher AS T', 'T.teacher_id = S.teacher_id','left');
                                    $this->db->where('S.subject_id',$class_routine_value->subject_id );
                                    $teacherdata = $this->db->get()->result();

                                    if (!empty($teacherdata)) {
                                        foreach ($teacherdata as $obj) {
                                        if($class_routine_value->teacher_id == $obj->teacher_id){ $selected = 'selected'; }else{ $selected = ''; }
                                           echo  $str = '<option value="' . $obj->teacher_id . '"'. $selected  .' >'. $obj->name . '</option>';
                                        }
                                    }
                                } 
                            ?>
                           
                        </select>
                    </div>
                               
                                <?php } ?>
                                <span class="tt_note">&nbsp;&nbsp;</span>
                        
                      <?php }else{
                        echo "Empty";
                      } ?>
                    </div>
                 <?php }  ?>
                </td>
                <?php  }  ?>  
              </tr>
  <?php    } ?>
  </tbody>
 </table>
 </div>
</div>




<style>
    .tt_timetable_details{
        /*display: none;*/
    }
    .tt_timetable_details.container-fluid{
        background: #fff;
        padding: 3%;
    }


.tt_detail_close{
    position: absolute;
      right: -7px;
      font-size: 20px;
      color: #000;
      top: -14px;
      background: #fff;
      width: 35px;
      height: 35px;
      text-align: center;
      border-radius: 50%;
      line-height: 35px;
      cursor: pointer;
    }
.error{
    color:red;
}


</style>


<script>



    
   function get_teachers_by_subject(value,rowcol){
       console.log('sdfasdfasdf');
    $.ajax({       
      type   : "POST",
      url    : "<?php echo site_url('ajax/get_subjectid_by_teacher'); ?>",
      data   : {'subject_id' : value},               
      // async  : false,
      success: function(response){  
        console.log('#teacher_'+rowcol);                                                 
        $('#teacher_'+rowcol).html(response);
       }
     });
   }

var c_id, s_id;

function select_section(class_id) {
    if (class_id !== '') {
    c_id = class_id;
    $.ajax({
        url: '<?php echo site_url('admin/get_section/'); ?>' + class_id,
        success:function (response)
        {
            jQuery('#section_holder').html(response);
        }
    });
    }
}

function reload_url() {
    class_selection = $('#class_selection').val();
    section_id = $('#section_id').val();
   // template_id = $('#template_id').val();
    if(class_selection != "" && section_id != ""){
      window.location.href = "<?php echo site_url();?>/admin/class_dailytimetable/"+class_selection+"/" + section_id;
    }
}


function addItem(){
    var period = $('.timetable tbody>tr.period_tr:last').attr('period');
    period = parseInt(period);
    var item = $('.tt_period_clone').clone(true);
    item.removeClass('tt_period_clone tt_period_hidden');
    item.addClass('period_tr');
    item.insertAfter('.timetable tbody>tr.period_tr:last');
    $('.timetable tbody>tr.period_tr:last').attr('period',period + 1);
    return false;
}

function addRecess(){
    var period = $('.timetable tbody>tr.period_tr:last').attr('period');
    period = parseInt(period);
    var item = $('.tt_recess_clone').clone(true);
    item.removeClass('tt_recess_clone tt_period_hidden');
    item.addClass('period_tr');
    item.insertBefore('.timetable tbody>tr:last');
    $('.timetable tbody>tr.period_tr:last').attr('period',period + 1);
    $('.add-recess').hide();
}

$('.item-delete').click(function(){
    $(this).parent('tr').remove();
    return false;

});

function save_time_routine(day_){
  //ssaturday_interval
 var  start_    = $('.'+day_+'_start').val();
 var  interval_ = $('.'+day_+'_interval').val();

   $.ajax({       
      type   : "POST",
      url    : "<?php echo site_url('admin/settime_for_classroutine'); ?>",
      data   : {'starttime' : start_,'intervaltime':interval_,'day':day_},               
      success: function(response){  
        alert(response);     
        console.log(response);                                        
      }
     });
}

function change_section_wise_period(value,ths){
  var attr_value = $(ths).attr("attr_value");
   $("."+attr_value).css("display", "none");

  $("."+value).css("display", "block");
}

</script>
