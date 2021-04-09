<?php $activeTab = "exam"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Exam</a></li>
        <li class="active">Exam List</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/examination_results_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<div id="printMe">
<div id="datatable-responsive_wrapper" class="datesheet-container container-fluid">
  <table   class="datesheet table table-bordered col-sm-12" >
    <thead>
      <?php $classes = $this->db->get('class')->result();   
            $count_class = count($classes);
      ?>
      <tr>
        <th>
          Class/Date
        </th>
       
        <?php foreach ($classes  as $key => $class_dt) { 
          echo '<th>';
             echo $class_dt->name;
         echo ' </th>';
        }
        ?>
      </tr>
    </thead>

    <tbody>
      <?php $exam_schedule = $this->db->get_where('exam_schedule',array('exam_id'=>$exam_id))->result();
           $this->db->select('*');
           $this->db->from('exam_schedule');
           $this->db->where('exam_id',$exam_id);
           $this->db->order_by('exam_date','ASC');
           $this->db->group_by('exam_date');
           $exam_schedule =  $this->db->get()->result();


           $subjectname = "";$datetime="";

      foreach ($exam_schedule as $key => $exam_dt) {  ?>
      <tr>
          <td>
            <?php echo $exam_dt->exam_date;?>
          </td>
          <?php 
            $subjectname = "";$datetime="";
          foreach ($classes  as $key => $class_dt) { ?>
            <td>
                <?php 
                  $exam_details   = array();
                  $cancel_exam='<span class="subject">  -- </span>';
                  $re_exam_cancel = $this->db->get_where('re_exam_cancel',array('exam'=>$exam_id,'cancel_for'=>'class','class_id'=>$class_dt->class_id))->row();
                  
                  if($re_exam_cancel == ""){
                    $exam_details   = $this->db->get_where('exam_schedule',array('exam_id'=>$exam_id,'exam_date'=>$exam_dt->exam_date,'class_id'=>$class_dt->class_id))->result();
                  }else{
                   $cancel_exam = '<span class="subject" style="color:red"> Cancel exam </span>'; 
                  }
                  if(sizeof($exam_details) > 0){
                    $i=0;$style="";
                    foreach($exam_details as $details){
                       $subjectname = $this->db->get_where('subject',array('subject_id'=>$details->subject_id))->row()->name;
                       $datetime = $details->start_time.' - '.$details->end_time;
                      
                       if($i > 0){
                         $style = 'style="border-top: 2px solid black;"' ;      /////////////////////////////////// create border ////////////////////
                       }
                    ?>

                        <span class="subject" <?php echo $style;?>>
                          <strong><?php echo $subjectname;?></strong>
                        </span></br>
                        <span class="time">
                          <?php echo $datetime; ?>
                        </span>
                      <br>
                   
                <?php   $i++;} }else{ 

                    echo $cancel_exam; 

                 } ?>
            </td>
           <?php } ?>
      </tr>
    <?php } ?>
  </tbody>
 </table>

 <div>
    <!--<button class="btn btn-default buttons-pdf buttons-html5" tabindex="0" aria-controls="datatable-responsive"><span>PDF</span></button>
    <a class="btn btn-info" tabindex="0" aria-controls="datatable-responsive">Print Datesheet</a>-->
	<button class="btn btn-info noprint" onclick="printDiv('printMe')">Print Datesheet</button>
  </div>
</div>
<style>@media print {
  /* style sheet for print goes here */
  .noprint {
    visibility: hidden;
  }
}</style>
</div>
<script>
		function printDiv(divName){
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
		}
	</script>

<script type="text/javascript">
  
   $(document).ready(function() {
      $('#datatable-responsive').DataTable( {
          dom: 'Bfrtip',
          iDisplayLength: 15,
          buttons: [
              'pdfHtml5'
          ],
          search: false
      });
    });

</script>
