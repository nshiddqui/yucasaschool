<?php 
  // echo "<pre>";
  //   print_r($syllabus_data);
  // echo "</pre>";

    $class_name   = $this->db->get_where('class',array('class_id'=>$syllabus_data->class_id))->row()->name;
    $subject_name = $this->db->get_where('subject',array('subject_id'=>$syllabus_data->subject_id))->row()->name;
    $lastpersent_value="0";
    $current_topic_title =  $syllabus_data->current_topic_title;
    $current_topic_desc  = $syllabus_data->current_topic_desc;
    $complete_syllabus  = $syllabus_data->complete_syllabus;
    foreach ($syllabus_module_info_data as $key => $ddt) {
      $lastpersent_value =  $ddt->persent_value;
    }
?>

<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Academic Syllabus</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/teacher/academic_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<div class="col-12">
    <div class="subject_timeline_details">
        <div><strong>Class :</strong> <?php echo  $class_name;?>  </div>
        <div><strong>Subject :</strong><?php echo  $subject_name;?>  </div>
        <div><strong>Teacher :</strong> <?php echo $this->session->userdata('name');?> </div>
        <div><strong>Syllabus Title :</strong> <?php echo $syllabus_data->title;?></div>
    </div>
</div>

<div>

</div>


<div class="col-sm-11">

<div class="container-fluid syllabus-timeline">
   
<div class="progress-wrapper">
  <div class="progress">
    <div class="zero <?php echo $complete_syllabus > 0? 'success-color':'pending-color';?>">0%</div>
    <div class="one <?php echo $complete_syllabus >= 20? 'success-color':'pending-color';?>">20%</div>
    <div class="two <?php echo $complete_syllabus >= 40? 'success-color':'pending-color';?>">40%</div>
    <div class="three <?php echo $complete_syllabus >= 60? 'success-color':'pending-color';?>">60%</div>
    <div class="four <?php echo $complete_syllabus >= 80? 'success-color':'pending-color';?>">80%</div>
    <div class="five <?php echo $complete_syllabus >= 100? 'success-color':'pending-color';?>">100%</div>
    <div class="progress-bar progress-bar-success" style="width:<?php echo $complete_syllabus;?>%"></div>
    <div class="current-topic">
        <form action="<?php echo site_url('teacher/current_topic_syllabus_update');?>" method = "post">
            <input type="text" class="form-control" name="current_topic_title" value="<?php echo $current_topic_title;?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" placeholder="Enter Current Topic Title..."/><br>
            <input type="hidden" name="syllabus_id" value="<?php echo $syllabus_id;?>">
            <textarea name="current_topic_desc" class="form-control" id="" data-stylesheet-url="assets/css/wysihtml5-color.css" required placeholder="Enter Current Topic Description..."><?php echo $current_topic_desc;?></textarea>
            <button class="btn btn-info " type="submit" style="margin-top: 5px">Save</button>
        </form>
    </div>
</div>

 
</div>


<div class="slidecontainer">
  <input type="range" min="1" max="100" value="<?php echo $complete_syllabus;?>" class="slider" id="myRange">
</div> 

<form action="<?php echo site_url('teacher/add_syllabus_module_data');?>" method="post">
	<div class="row">
        <div class="text-center" style="color:#000; margin-bottom:15px;"><strong >Syllabus Milestone Details</strong></div>
        <div class="sub-timeline-centered">

    <?php 
     $first_value=0; $persentage_value = 0;
     $data = $syllabus_module_info_data;
     $numbervalue  = $syllabus_data->no_of_modules;
    for ($i=0;$i<$numbervalue;$i++){ 
             $id =""; $title= ""; $decription  ="";
            

        if(@$data[$i] !=""){
            $id             = $data[$i]->id;
            $title          = $data[$i]->title;
            $decription     = $data[$i]->decription;
            //$syllabus_id    = $data[$i]->syllabus_id;
            //$persent_value  = $data[$i]->persent_value;
        }

        if($persentage_value == 0){
          $first_value = 100/$numbervalue;
        }
        $persentage_value = 1;
        $lastvalue        = $lastvalue+$first_value;

        ?>
        <article class="timeline-entry">
            <div class="timeline-entry-inner">
                <div class="timeline-icon bg-success">
                <?php echo $i+1;?>
                </div>

                <div class="timeline-label">
                    <input type="text" class="form-control" name="module_title[]"  value="<?php echo $title;?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" placeholder="Enter Module Title Here"/><br>
                    <input type="hidden" name="persent_value[]" value="<?php echo $lastvalue;?>">
                    <input type="hidden" name="syllabus_id" value="<?php echo $syllabus_id;?>">
                    <input type="hidden" name="module_no[]" value="<?php echo  $i+1;?>">
                    <input type="hidden" name="editid[]" value="<?php echo $id;?>">
                    <textarea name="module_description[]"  class="form-control " id="" data-stylesheet-url="assets/css/wysihtml5-color.css"  placeholder="Enter Module Description..."><?php echo $decription;?></textarea>
                </div>
            </div>

        </article>
    <?php } ?>
     </div>
    
   </div>

    <div class="text-right">
       <button type="submit" name="submit" class="btn btn-info">Save Modules Info</button>
    </div>
 </form>
</div>
</div>

<input type="number" id="current_status" value="" class="hidden">


<script>

    $('.module_title').on('keyup', function(){
       $('.module_title_input').val($(this).html());
    });

    var slider = document.getElementById("myRange");

    // Update the current slider value (each time you drag the slider handle)
   slider.onmouseup = function() {
      saveStatus(this.value);
    } 

     function saveStatus(status){
      console.log(status);
      $.ajax({
            url: '<?php echo site_url('teacher/current_topic_syllabus_update/');?>' + status+'/'+'<?php echo $syllabus_id;?>',
            success: function(response)
            {
             window.location.href = "<?php echo site_url();?>/teacher/syllabus_timeline/"+response;
            }
     });
    }
   
</script>