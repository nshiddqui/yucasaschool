<?php
$classpost= "";$monthpost = "";$sessional_year_post="";
 if($this->input->post() != ""){
    $classpost     = $this->input->post('class');
    $monthpost     = $this->input->post('month');
    $sessional_year_post= $this->input->post('sessional_year');
   
 }
?>
<?php $activeTab = "leave_management"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Student</a></li>
        <li class="active">Leave Record</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/teacher/student_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>



<form class="" action="<?php echo base_url() . 'index.php/teacher/student_leave_record/find'; ?>" method="post">
<div class="row">
     <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class'); ?></label>
            <select class="form-control" id="classSection" name="class" onchange="getstudent(this.value);">
               
                <?php
                if($teacherClass != ""){
                foreach($teacherClass as $dt){
                  $class_name   = $this->db->get_where('class', array('class_id'=>$dt->class_id))->row()->name;
                  $classdetails = $dt->class_id.'^'.$dt->section_id;
                 ?>
                <option value="<?php echo $classdetails;?>" <?php if($classpost == $classdetails){ echo "selected";} ?> >
                <?php echo $class_name .'('.$dt->name.')';?>
                </option>
            <?php } } ?>
            </select>
        </div>
    </div> <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('student'); ?></label>
            <select class="form-control" id="student_details" name="student">
              <option value="">-- <?php echo $this->lang->line('select'); ?>  --</option>
            </select>
        </div>
    </div>
    <div class="col-md-offset-2 col-md-2">
         <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('month'); ?></label>
            <select name="month" class="form-control selectboxit">
                    <?php
                for ($i = 1; $i <= 12; $i++):
                    if ($i == 1)
                        $m = 'january';
                    else if ($i == 2)
                        $m = 'february';
                    else if ($i == 3)
                        $m = 'march';
                    else if ($i == 4)
                        $m = 'april';
                    else if ($i == 5)
                        $m = 'may';
                    else if ($i == 6)
                        $m = 'june';
                    else if ($i == 7)
                        $m = 'july';
                    else if ($i == 8)
                        $m = 'august';
                    else if ($i == 9)
                        $m = 'september';
                    else if ($i == 10)
                        $m = 'october';
                    else if ($i == 11)
                        $m = 'november';
                    else if ($i == 12)
                        $m = 'december';
                    ?>
                    <option value="<?php echo $i; ?>"
                          <?php if($month == $i && $monthpost == ""){ 
                                 echo 'selected';
                                }
                                elseif($monthpost != "" && $i == $monthpost){
                                  echo 'selected';
                                }

                           ?>  >
                                <?php echo get_phrase($m); ?>
                    </option>
                    <?php
                endfor;
                ?>
            </select>
         </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('sessional_year'); ?></label>
            <select class="form-control selectboxit" name="sessional_year">
                <?php $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
                  $total_years  = $this->db->query("select * from academic_years where status = 1 order by session_year asc")->result();
                 ?>
                    <option value=""><?php echo get_phrase('select_running_session');?></option>
                    <?php foreach ($total_years as  $dt):?>
                        <option value="<?php echo $dt->start_year;?>-<?php echo $dt->end_year;?>"
                        <?php if($running_year == $dt->start_year.'-'.$dt->end_year && $sessional_year_post == "") { 
                               echo 'selected';
                               }elseif($sessional_year_post != "" && $sessional_year_post == $dt->start_year.'-'.$dt->end_year){
                                echo 'selected';
                              } 
                        ?> >
                            <?php echo $dt->start_year;?>-<?php echo $dt->end_year;?>
                        </option>
                  <?php endforeach;?>
            </select>
        </div>
    </div>

    <input type="hidden" name="operation" value="selection">
    <input type="hidden" name="year" value="<?php echo $running_year;?>">
     <input type="hidden" name="class_id" id="hidden_class" value="">
    <input type="hidden" name="section_id" id="hidden_section" value="">

	<div class="col-md-2" style="margin-top: 20px;">
		<button type="submit" class="btn btn-info"><?php echo get_phrase('show_report');?></button>
	</div>
</div>
</form>

<?php if($find_student_leave !=""){ ?>
<table class="table table-bordered datatable" >
    <thead>
        <tr>
            <th>S.No</th>
            <th><div><?php echo get_phrase('student_name');?></div></th>
            <th><div><?php echo get_phrase('Request_Id');?></div></th>
            <th><div><?php echo get_phrase('From');?></div></th>
            <th><div><?php echo get_phrase('to');?></div></th>
            <th><div><?php echo get_phrase('status');?></div></th>
            <th><div><?php echo get_phrase('action');?></div></th>
        </tr>
    </thead>
    <tbody>
       <?php 
       if($leave_data != ""){
        $i=1;
       foreach ($leave_data as  $dt) { ?>
        <tr>
            <td><?php echo $i++;?></td>
            <td><?php echo $dt->student_name;?></td>
            <td><?php echo $dt->uniqid;?></td>
            <td><?php echo $dt->from_date!=""?$dt->from_date:'1 day ( '.$dt->leave_date.' )';?></td>
            <td><?php echo $dt->to_date;?></td>
            <td><span class="<?php echo $dt->status;?>"><?php echo $dt->status;?></span></td>
            <td>
               <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/leave_request_view/'.$dt->leave_id);?>')">
                                            <i class="entypo-pencil"></i>
                                            <?php echo get_phrase('View');?>
                                        </a>
                                    </li>
                                </ul>
                            </div>
             </td>
         </tr>
      <?php }} ?>
    </tbody>
</table>
<?php } ?>

<script type="text/javascript">
    function getstudent(value){
        var res = value.split("^");
        var class_id   = res[0];
        var section_id = res[1];
        $('#hidden_class').val(class_id);
        $('#hidden_section').val(section_id);

         $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_section_by_student'); ?>",
            data   : { class_id : class_id,section_id : section_id },               
            async  : false,
            success: function(response){                                                   
               if(response)
               { 
                $('#student_details').html(response);
               }
            }
        });    
    }

    $(document).ready(function() {
      var classSection = $('#classSection').val();
      getstudent(classSection);
    });

</script>