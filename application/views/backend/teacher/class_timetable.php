<?php $activeTab = "class_routine"; 

?>



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
<?php include base_path().'application/views/backend/navigation_tab/teacher/academic_nav_tab.php'; ?> 
  <!-- Including Navigation Tab -->
</div>
<br>
<!-- time-table -->
<div class="content">
    <div class="container-fluid">
<div class="row">
<?php
   
    $system_name   =   $this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
    $running_year  =   $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
?>


<div id="print">

    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <style type="text/css">
        td {
            padding: 5px;
        }
    </style>

    <center style="  font-size: 15px;color: #000;font-weight: 700;">
        
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
                        $this->db->where('teacher_id' , $teacher_id);
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
                                 $class_id=$row['class_id'];
                                 $section_id=$row['section_id'];
                                 echo $class_name    =   $this->db->get_where('class' , array('class_id' =>$class_id))->row()->name;
                                 echo '-';
                                 echo $section_name  =   $this->db->get_where('section' , array('section_id' =>$section_id))->row()->name;
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

<!-- <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script> -->
<script>

     

//jsondata='{"all_data":{"class_id":"1","section_id":"1","subject_id":"5","is_temporary":"no","event_type":"","tem_date":"","time_start":3,"time_end":4,"time_start_min":"30","time_end_min":"20","com_start_min":"3.30","com_end_min":"4.20","day":"tuesday","year":"2018-2019"},"msg":""}';

    $(document).ready(function(){
    //  $("#formTimeTable").validate({
    //     rules :{
    //     is_temporary : "required",
    //    ///type :"required",
    //    // teacher :"required",
    //    // subject :"required"
    //    }, submitHandler: function(form) {
    //      // do other things for a valid form
    //       var data;
    //       data =  $("#formTimeTable").serialize();
    //        // data.append( 'file', $( '#file' )[0].files[0] );
    //       console.log(data);
    //       //alert("Submitted! " + $('#is_temporary').val());
          
    //        $.ajax({
    //             url: "<?php echo site_url('admin/addclass_routine_data'); ?>",
    //             data: data,
    //             type: 'POST',
    //             success: function (data) {
    //                 //alert(data);
    //                 console.log(data);
    //                 $('#id1').attr('jsondata',data);
    //                 var obj = JSON.parse(data);
    //                 //alert(obj.msgval);
    //                 $('#msg').html(obj.msgval);
    //                 if(obj.msg == 'success'){
    //                   location.reload();
    //                 }
    //             }
    //         });
    //     //form.preventDefault();
    //    }
    // });

      
  
   // function get_period_class_routine(period){
   //      $('#mon_1').html(' ');
   // }

});
   
   function get_teachers_by_subject(value,rowcol,day_,period,timetable_time,endtime_){
       console.log('sdfasdfasdf');
       alert(period);
       alert(day_);
    $.ajax({       
      type   : "POST",
      url    : "<?php echo site_url('ajax/get_classroutine_subjectid_by_teacher'); ?>",
      data   : {'subject_id' : value,'day_' : day_,'period' : period,'timetable_time' : timetable_time,'endtime_' : endtime_},               
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
    template_id = $('#template_id').val();
    if(class_selection != "" && section_id != ""){
      window.location.href = "<?php echo site_url();?>/teacher/class_timetable/"+class_selection+"/" + section_id+"/"+template_id;
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

</script>
