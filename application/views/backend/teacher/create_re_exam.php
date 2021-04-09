<?php $activeTab = "re_exam_cancelation"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Exam</a></li>
        <li class="active">Question Paper</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/teacher/exam_nav_tab.php'; ?> 
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
                                <th><div><?php echo get_phrase('section');?></div></th>
                                <th><div><?php echo get_phrase('student');?></div></th>
                                <th><div><?php echo get_phrase('original_date');?></div></th>
                                <th><div><?php echo get_phrase('reschedule_date');?></div></th>
                                 <th><div><?php echo get_phrase('reason');?></div></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
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
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box " id="reschedule">
                <div class="box-content">
                    <?php echo form_open(site_url('admin/exam/create') , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('reschedule_exam_for');?></label>
                                <div class="col-sm-5" >
                                    <select name="" id="reschedule_for" class="form-control">
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
                                    <select name="class_id" class="form-control" required>
                                      <option value=""><?php echo get_phrase('select');?></option>
                                      <option value="">Class 6</option>
                                      <option value="">Class 5</option>
                                      <option value="">Class 4</option>
                                    
                                  </select>
                                </div> 
                            </div>

                            


                              <div class="form-group">
                                    <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('select_exam');?></label>
                                    
                                    <div class="col-sm-5">
                                        <select name="class_id" class="form-control" required>
                                          <option value=""><?php echo get_phrase('select');?></option>
                                          <option value="">History</option>
                                          <option value="">Geography</option>
                                          <option value="">Maths</option>
                                        
                                      </select>
                                    </div> 
                                </div>


                                <div class="form-group" id="sectionSelect" style="display: none">
                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('select_section');?></label>
                                
                                <div class="col-sm-5">
                                    <select name="class_id" class="form-control" required>
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
                                    <select name="class_id" class="form-control select2" required>
                                      <option value=""><?php echo get_phrase('select');?></option>
                                      <option value="">Raman</option>
                                      <option value="">Vineet</option>
                                      <option value="">Komal</option>
                                    
                                  </select>
                                </div> 
                            </div>                   



                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('reschedule_date');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="datepicker form-control" name="date" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
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
                	<?php echo form_open(site_url('admin/exam/create') , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        
                         <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('reschedule_exam_for');?></label>
                                <div class="col-sm-5" >
                                    <select name="" id="cancel_for" class="form-control">
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
                                    <select name="class_id" class="form-control" required>
                                      <option value=""><?php echo get_phrase('select');?></option>
                                      <option value="">Class 6</option>
                                      <option value="">Class 5</option>
                                      <option value="">Class 4</option>
                                    
                                  </select>
                                </div> 
                            </div>

                            


                              <div class="form-group">
                                    <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('select_exam');?></label>
                                    
                                    <div class="col-sm-5">
                                        <select name="class_id" class="form-control" required>
                                          <option value=""><?php echo get_phrase('select');?></option>
                                          <option value="">History</option>
                                          <option value="">Geography</option>
                                          <option value="">Maths</option>
                                        
                                      </select>
                                    </div> 
                                </div>


                                <div class="form-group" id="sectionSelectCancel" style="display: none">
                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('select_section');?></label>
                                
                                <div class="col-sm-5">
                                    <select name="class_id" class="form-control" required>
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
                                    <select name="class_id" class="form-control select2" required>
                                      <option value=""><?php echo get_phrase('select');?></option>
                                       <option value="">Raman</option>
                                      <option value="">Vineet</option>
                                      <option value="">Komal</option>                                    
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


    
		
</script>


