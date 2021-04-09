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


<?php $activeTab = "academic_dashboard"; ?>
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
<?php include base_path().'application/views/backend/navigation_tab/student/academic_nav_tab.php'; ?> 
  <!-- Including Navigation Tab -->
</div>
<!-- time-table -->
<div class="content">
   <div class="container-fluid">
<div class="row">
<?php
    $student_id= $this->session->userdata('student_id');
    $system_name   =   $this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
    $running_year  =   $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
      $class_id      =   $this->db->get_where('enroll' , array('student_id'=>$student_id))->row()->class_id;
      $section_id    =   $this->db->get_where('enroll' , array('student_id'=>$student_id))->row()->section_id;
?>


<div id="print">

    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <style type="text/css">
        td {
            padding: 5px;
        }
    </style>

    <center>
        
        <?php echo get_phrase('daily_class_routine');?><br>
      
    </center>
    <br>
    <table style="width:100%; border-collapse:collapse;border: 1px solid #eee; margin-top: 10px;" border="1">
        <tbody>
            <?php 
                for($d=1;$d<=7;$d++):
                
                if($d==1)$day='sunday';
                else if($d==2)$day='monday';
                else if($d==3)$day='tuesday';
                else if($d==4)$day='wednesday';
                else if($d==5)$day='thursday';
                else if($d==6)$day='friday';
                else if($d==7)$day='saturday';
                ?>
                <tr>
                    <td width="100"><?php echo strtoupper($day);?></td>
                    
                            <td align="left">
                        <?php
                        $this->db->order_by("time_start", "asc");
                        $this->db->where('day' , $day);
                        $this->db->where('class_id' ,$class_id);
                           $this->db->where('section_id' ,$section_id);
                        $this->db->where('year' , $running_year);
                        $this->db->where('template_id' , $template_data_result->id);
                        $routines =$this->db->get('class_routine')->result_array();
                     
                        foreach($routines as $row):
                        ?>
                            <div style="float:left; padding:8px; margin:5px; background-color:#ccc;">
                                <?php echo $this->crud_model->get_subject_name_by_id($row['subject_id']);?>
                                <?php
                                    if ($row['time_start_min'] == 0 && $row['time_end_min'] == 0) 
                                        echo '('.$row['time_start'].'-'.$row['time_end'].')';
                                    if ($row['time_start_min'] != 0 || $row['time_end_min'] != 0)
                                    echo '('.$row['time_start'].':'.$row['time_start_min'].'-'.$row['time_end'].':'.$row['time_end_min'].')';
                                ?>
                                <br>
                                <?php 
                                
                                 $teacher_id=$row['teacher_id'];
                                 
                                 $period=$row['period'];
                                 echo  $result = Period . ' ' . $period;
                                
                                 echo'<br>';
                                 echo $class_name    =   $this->db->get_where('teacher' , array('teacher_id' =>$teacher_id))->row()->name;
                                
                                     ?>
                               
                            </div>
                        <?php endforeach;?>
                            </td>

                    
                </tr>
                <?php endfor;?>
        </tbody>
   </table>

<br>

</div>


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
