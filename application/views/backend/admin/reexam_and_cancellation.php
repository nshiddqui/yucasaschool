<?php $activeTab = "re_exam_cancellation"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Examination & Results</a></li>
        <li class="active">Re-Exam & Cancellation</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/examination_results_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">

            <li class="active">
                <a href="#reschedule_list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('rescheduled_exam_list');?>
                        </a></li>
             <li class="">
                <a href="#cancel_list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('canceled_exam_list');?>
                        </a></li>


			<li class="">
            	<a href="#reschedule" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('reschedule_exam');?>
                    	</a></li>
			<li>
            	<a href="#cancel" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('cancel_exam');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>
		<div class="tab-content">
        <br>


            <div class="tab-pane box active" id="reschedule_list">
                <div class="box-content">

                    <table  class="table table-bordered datatable" >
                        <thead>
                            <tr>
                                <th><div><?php echo get_phrase('s_no');?></div></th>
                                <th><div><?php echo get_phrase('reschedule_for');?></div></th>
                                <th><div><?php echo get_phrase('exam_name');?></div></th>
                                <th><div><?php echo get_phrase('class');?></div></th>
                                <th><div><?php echo get_phrase('subject');?></div></th>
                                <th><div><?php echo get_phrase('section');?></div></th>
                                <th><div><?php echo get_phrase('student');?></div></th>
                                <th><div><?php echo get_phrase('original_date');?></div></th>
                                <th><div><?php echo get_phrase('reschedule_date');?></div></th>
                                <th><div><?php echo get_phrase('reason');?></div></th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php 
                           if(isset($re_exam_list) && !empty($re_exam_list)){
                              $i=1;
                             foreach($re_exam_list as $dt){
                             ?>
                             <tr>
                              <td><?=$i++;?></td>
                              <td><?=$dt->reschedule_exam_for; ?></td>
                              <td><?php echo @$dt->exam_name; ?></td>
                              <td><?php echo  $dt->class_name;?></td>
                              <td><?php $dt->subject_name;?> </td>
                              <td><?php echo $dt->section_name;?></td>
                              <td><?php echo $dt->student_name;?></td>
                              <td><?php echo $dt->examdate;?></td>
                              <td><?php echo $dt->reschedule_date;?></td>
                              <td><?php echo $dt->comment;?></td>

                            </tr>
                           <?php }} ?>
                        </tbody>
                    </table>
                </div>
            </div>

             <div class="tab-pane box " id="cancel_list">
                <div class="box-content">
                     <table  class="table table-bordered datatable" >
                        <thead>
                            <tr>
                                <th><div><?php echo get_phrase('s_no');?></div></th>
                                <th><div><?php echo get_phrase('cancel_for');?></div></th>
                                <th><div><?php echo get_phrase('exam_name');?></div></th>
                                <th><div><?php echo get_phrase('class');?></div></th>
                                <th><div><?php echo get_phrase('section');?></div></th>
                                <th><div><?php echo get_phrase('student');?></div></th>
                                <th><div><?php echo get_phrase('reason');?></div></th>
                               
                            </tr>
                        </thead>
                        <tbody>
                          
                          <?php 
                            if(isset($cancel_exam_list) && !empty($cancel_exam_list)){
                              $i=1;
                             foreach($cancel_exam_list as $dt){
                             ?>
                             <tr>
                              <td><?=$i++;?></td>
                              <td><?php echo $dt->cancel_for;?></td>
                              <td><?php echo $dt->exam_name;?></td>
                              <td><?php echo $dt->class_name;?></td>
                              <td><?php echo $dt->section_name;?></td>
                              <td><?php echo $dt->student_name;?></td>
                              <td><?php echo $dt->comment;?></td>
                            </tr>
                           <?php }} ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box " id="reschedule">
                <div class="box-content">
                    <?php echo form_open(site_url('admin/re_exam/create') , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('reschedule_exam_for');?></label>
                                <div class="col-sm-5" >
                                    <select name="reschedule_for" id="reschedule_for" class="form-control" onchange="reschedule_exam_for();">
                                        <option value="">Select</option>
                                        <option value="class">Class</option>
                                        <option value="section">Section</option>
                                        <option value="student">Student</option>
                                    </select>
                                </div>
                            </div>

                        
                              <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('select_class');?></label>
                                <div class="col-sm-5">
                                    <select name="class_id" id="class_id" class="form-control" required onchange="get_class_sections(this.value),get_student();">
                                      <option value=""><?php echo get_phrase('select');?></option>
                                      <!-- <option value="">Class 6</option>
                                      <option value="">Class 5</option>
                                      <option value="">Class 4</option> -->
                                      <option value=""><?php echo get_phrase('select');?></option>
                                      <?php
                                        $classes = $this->db->get('class')->result_array();
                                        foreach($classes as $row):
                                          ?>
                                          <option value="<?php echo $row['class_id'];?>">
                                            <?php echo $row['name'];?>
                                          </option>
                                      <?php
                                        endforeach;
                                      ?>
                                  </select>
                                </div> 
                              </div>

                            <div class="form-group" id="sectionSelect" style="display: none">
                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('select_section');?></label>
                                <div class="col-sm-5">
                                  <select name="section_id" id="section_id" class="form-control" required onchange="get_student();">
                                      <option value=""><?php echo get_phrase('select');?></option>
                                      <option value="">Section A</option>
                                      <option value="">Section B</option>
                                      <option value="">Section C</option>
                                  </select>
                                </div> 
                            </div>  

                            <div class="form-group" id="studentSelect" style="display: none">
                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('select_student');?></label>
                                
                                <div class="col-sm-5">
                                  <select name="student_id" class="form-control" id="student_id" required>
                                    <option value=""><?php echo get_phrase('select');?></option>
                                  </select>
                                </div> 
                            </div>


                              <div class="form-group">
                                    <label for="field-2" class="col-sm-3 control-label">
                                      <?php echo get_phrase('select_exam');?></label>
                                    
                                    <div class="col-sm-5">
                                        <select name="exam" id="exam_val" class="form-control" required  >
                                          <option value=""><?php echo get_phrase('select');?></option>
                                       <!--  <?php  
                                        $exam_details =  $this->db->get_where('exam')->result();  
                                        if (!empty($exam_details)) {
                                         foreach ($exam_details as $obj) {
                                           echo '<option value="' . $obj->exam_id . '">' . $obj->name .'</option>';
                                         }} ?> -->
                                         <!--  <?php  
                                           $exam_details =  $this->db->get_where('exam')->result();  
                                              if (!empty($exam_details)) {
                                               foreach ($exam_details as $obj) {
                                                echo '<option value="' . $obj->exam_id . '">' . $obj->title .'('.$obj->code.')</option>';
                                           }} ?> -->
                                      </select>
                                    </div> 
                                </div>


                                 
                             <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('reschedule_date');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="datepicker form-control" name="exam_date" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" required />
                                </div>
                              </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="start_time"><?php echo $this->lang->line('start_time'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="start_time"  id="add_start_time" value="<?php //echo isset($post['start_time']) ?  $post['start_time'] : ''; ?>" placeholder="<?php echo $this->lang->line('start_time'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('start_time'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="end_time"><?php echo $this->lang->line('end_time'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="end_time"  id="add_end_time" value="<?php //echo isset($post['end_time']) ?  $post['end_time'] : ''; ?>" placeholder="<?php echo $this->lang->line('end_time'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('end_time'); ?></div>
                                    </div>
                                </div>
                                 <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="room_no"><?php echo $this->lang->line('room_no'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="room_no"  id="room_no" value="" placeholder="<?php echo $this->lang->line('room_no'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('room_no'); ?></div>
                                    </div>
                                </div>

                              <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('comment');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="comment"/>
                                </div>
                              </div>

                            


                                <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-warning"><?php echo get_phrase('reschedule_exam');?></button>
                                </div>
                                </div>
                    </form>                
                </div>  
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="cancel" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(site_url('admin/re_exam/cancel') , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        
                         <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('reschedule_exam_for');?></label>
                                <div class="col-sm-5" >
                                    <select name="cancel_for" id="cancel_for" class="form-control">
                                        <option value="">Select</option>
                                        <option value="class">Class</option>
                                        <option value="section">Section</option>
                                        <option value="student">Student</option>
                                    </select>
                                </div>
                            </div>

                        
                              <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('select_class');?></label>
                                
                                <div class="col-sm-5">
                                    <select name="class_id" class="form-control" id="class_id_cancel"  onchange="get_class_sections_cancel(this.value),get_student_cancel();" required>
                                      <option value=""><?php echo get_phrase('select');?></option>
                                      <!-- <option value="">Class 6</option>
                                      <option value="">Class 5</option>
                                      <option value="">Class 4</option> -->
                                      <option value=""><?php echo get_phrase('select');?></option>
                                      <?php
                                        $classes = $this->db->get('class')->result_array();
                                        foreach($classes as $row):
                                          ?>
                                          <option value="<?php echo $row['class_id'];?>">
                                          <?php echo $row['name'];?>
                                          </option>
                                      <?php
                                        endforeach;
                                      ?>
                                    
                                  </select>
                                </div> 
                            </div>

                             <div class="form-group" id="sectionSelectCancel" style="display: none">
                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('select_section');?></label>
                                
                                <div class="col-sm-5">
                                  <select name="section_id" id="section_id_cancel" class="form-control" onchange="get_student_cancel();" required>
                                    <option value=""><?php echo get_phrase('select');?></option>
                                    <option value="">Section A</option>
                                    <option value="">Section B</option>
                                    <option value="">Section C</option>
                                  </select>
                                </div> 
                            </div>     
                            
                              <div class="form-group" id="studentSelectCancel" style="display: none">
                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('select_student');?></label>
                                
                                <div class="col-sm-5">
                                    <select name="student_id" id="student_id_cancel" class="form-control" required>
                                      <option value=""><?php echo get_phrase('select');?></option>
                                      <!--  <option value="">Raman</option>
                                      <option value="">Vineet</option>
                                      <option value="">Komal</option> -->                                    
                                  </select>
                                </div> 
                            </div>  


                              <div class="form-group">
                                    <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('select_exam');?></label>
                                    
                                    <div class="col-sm-5">
                                        <select name="exam" id="exam_val_cancel" class="form-control" required>
                                          <option value=""><?php echo get_phrase('select');?></option>
                                        </select>
                                    </div> 
                                </div>


                                                


                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('comment');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="comment"/>
                                </div>
                            </div>
                        		<div class="form-group">
                            	<div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-danger"><?php echo get_phrase('cancel_exam');?></button>
                            	</div>
								</div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->
            
		</div>
	</div>
</div>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->     
 <link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
 <script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>
 <link href="<?php echo VENDOR_URL; ?>timepicker/timepicker.css" rel="stylesheet">
 <script src="<?php echo VENDOR_URL; ?>timepicker/timepicker.js"></script>
 <script type="text/javascript">
     
  $('#add_exam_date').datepicker();  
  $('#add_start_time').timepicker();
  $('#add_end_time').timepicker();
  
  $('#edit_exam_date').datepicker();
  $('#edit_start_time').timepicker();
  $('#edit_end_time').timepicker();

        </script>         
<script type="text/javascript">


    $('#reschedule_for').change(function(){
       let rescheduleFor = $('#reschedule_for option:selected').val();
       

       if(rescheduleFor == "class" || rescheduleFor == "" ){
        $('#sectionSelect').css('display','none');
        $('#studentSelect').css('display','none');
       }


       else if(rescheduleFor == "section" ){
        $('#sectionSelect').css('display','block');
        $('#studentSelect').css('display','none');
       }

       else if(rescheduleFor == "student"){
        $('#sectionSelect').css('display','block');
        $('#studentSelect').css('display','block');
       }

    });

    $('#cancel_for').change(function(){
       let cancelFor = $('#cancel_for option:selected').val();
       

       if(cancelFor == "class" || cancelFor == "" ){
        $('#sectionSelectCancel').css('display','none');
        $('#studentSelectCancel').css('display','none');
       }


       else if(cancelFor == "section" ){
        $('#sectionSelectCancel').css('display','block');
        $('#studentSelectCancel').css('display','none');
       }

       else if(cancelFor == "student"){
        $('#sectionSelectCancel').css('display','block');
        $('#studentSelectCancel').css('display','block');
       }

    });






	 jQuery(document).ready(function($)
    {
        $('#table_export').dataTable();
    });


    function reschedule_exam_for(){
     $("#exam_val").val(" ");
     $("#section_id").val(" ");
     $("#student_id").val(" ");
    }

    function get_exam(){
     var reschedule_for = $('#reschedule_for').val();
     var class_id       = $('#class_id').val();
     var section_id     = "";
  
     $.ajax({
        url: '<?php echo site_url('ajax/get_class_section_wise_exam/');?>',
        data: {'class_id':class_id,'section_id':section_id},
        type   : "POST",
        success: function(response)
         {
          //alert(response);
          jQuery('#exam_val').html(response);
         }
        });

    }

    function get_class_sections(class_id) {
          $.ajax({
            url: '<?php echo site_url('ajax/get_class_by_section/');?>',
            data: {'class_id':class_id},
            type   : "POST",
            success: function(response)
            {   
              //alert(response);
              jQuery('#section_id').html(response);
              get_student();
            }
         });
        get_exam();
      }

    function get_student(){
      var class_id  = $('#class_id').val(); 
      var section_id  = $('#section_id').val(); 
        $.ajax({
          url: '<?php echo site_url('ajax/get_section_by_student/');?>',
          data: {'class_id':class_id,'section_id':section_id},
          type   : "POST",
          success: function(response)
          {   
            //alert(response);
            jQuery('#student_id').html(response);
          }
        });
      }

       function get_class_sections_cancel(class_id) {
          $.ajax({
            url: '<?php echo site_url('ajax/get_class_by_section/');?>',
            data: {'class_id':class_id},
            type   : "POST",
            success: function(response)
            {   
              //alert(response);
              jQuery('#section_id_cancel').html(response);
              get_student_cancel();
            }
           });

        get_exam_cancel(class_id);
      }

    function get_exam_cancel(class_id){
      var section_id     = "";
    
     $.ajax({
        url: '<?php echo site_url('ajax/get_class_section_wise_exam/');?>',
        data: {'class_id':class_id,'section_id':section_id},
        type   : "POST",
        success: function(response)
         {
          //alert(response);
          jQuery('#exam_val_cancel').html(response);
         }
        });

    }

    function get_student_cancel(){
      var class_id  = $('#class_id_cancel').val(); 
      var section_id  = $('#section_id_cancel').val(); 
        $.ajax({
          url: '<?php echo site_url('ajax/get_section_by_student/');?>',
          data: {'class_id':class_id,'section_id':section_id},
          type   : "POST",
          success: function(response)
          {   
            //alert(response);
            jQuery('#student_id_cancel').html(response);
          }
        });
        
      }
</script>


