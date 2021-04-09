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

<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('exam_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_exam');?>
                    	</a></li>
                    		<li>
            	<a href="#cycle_list" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('cycle_list');?>
                    	</a></li>
                    		<li>
            	<a href="#add_cycle" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_cycle');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>
		<div class="tab-content">
        <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                <table  class="table table-bordered datatable" >
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('exam_name');?></div></th>
                    		<th><div><?php echo get_phrase('date');?></div></th>
                            <th><div><?php echo get_phrase('deadline');?></div></th>
                            <th><div><?php echo get_phrase('marks_submission');?></div></th>
                    		<th><div><?php echo get_phrase('comment');?></div></th>
                            <th><div><?php echo get_phrase('datesheet');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>

						</tr>
					</thead>
                    <tbody>
                    	<?php foreach($exams as $row):?>
                        <tr>
							<td><?php echo $row['name'];?></td>
							<td><?php echo $row['date'];?></td>
                            <td><?php echo $row['deadline'];?></td>
                            <td><?php echo $row['marks_submission'];?></td>
							<td><?php echo $row['comment'];?></td>


                            <td><a class="btn btn-info generate_datesheet" id="<?php echo $row['exam_id'];?>">Generate</a></td>
							<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    
                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_edit_exam/'.$row['exam_id']);?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    
                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo site_url('admin/exam/delete/'.$row['exam_id']);?>');">
                                            <i class="entypo-trash"></i>
                                                <?php echo get_phrase('delete');?>
                                            </a>
                                                    </li>
                                </ul>
                            </div>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(site_url('admin/exam/create') , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('date');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="datepicker form-control" name="date" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('deadline');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="datepicker form-control" name="deadline" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('marks_/_grade_submission');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="datepicker form-control" name="marks_submission"/>
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
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_exam');?></button>
                              	</div>
								</div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->
			
			
			
			      <div class="tab-pane box active" id="cycle_list">
                <table  class="table table-bordered datatable" >
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('cycle_name');?></div></th>
                    		<th><div><?php echo get_phrase('exam_name');?></div></th>
                        
                    		<th><div><?php echo get_phrase('options');?></div></th>

						</tr>
					</thead>
                    <tbody>
                    	<?php foreach($exam_cycle as $row):?>
                        <tr>
							<td><?php echo $row['cycle_name'];?></td>
							<td><?php echo $row['exam_name'];?></td>
                             
							<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    
                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_edit_exam/'.$row['exam_id']);?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    
                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo site_url('admin/exam/delete/'.$row['exam_id']);?>');">
                                            <i class="entypo-trash"></i>
                                                <?php echo get_phrase('delete');?>
                                            </a>
                                                    </li>
                                </ul>
                            </div>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add_cycle" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(site_url('admin/exam/cycle') , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('exam_type');?></label>
                                <div class="col-sm-5">
                                <select name="exam_type[]"  class="selectpicker" id="selectpickerClass" multiple="multiple" data-live-search="true" style="width:100%;hight:50px;" required >
                                     <option class=
                                        "non_selectable_option" value="" disabled><?php echo get_phrase('select_exam_list'); ?></option>
                                        <?php
                                        $exam = $this->db->get('exam')->result_array();
                                        foreach($exam as $row):
                                        ?>
                                            <option class="selectable_option" value="<?php echo $row['exam_id'];?>"
                                             >
                                                    <?php echo $row['name'];?>
                                            </option>
                                        <?php
                                        endforeach;
                                        ?>
                                        <option value="select_all" class=
                                        "non_selectable_option"><?php echo get_phrase('select_all'); ?></option>
                                    </select>   </div>
                            </div>
                          
                        		<div class="form-group">
                              	<div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_exam_cycle');?></button>
                              	</div>
								</div>
                    </form>                
                </div>                
			</div>
			
            
		</div>
	</div>
</div>



<script>
$('.generate_datesheet').click(function(){
    exam_id = $(this).attr('id');
    if(exam_id != ""){
      window.location.href = "<?php echo site_url();?>/admin/date_sheet_view/"+ exam_id;
    }
})

</script>

<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
    {
        $('#table_export').dataTable();
    });
		
</script>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->
<script type="text/javascript">

    function reload_url() {
        class_selection = $('#class_selection').val();
        section_id = $('#section_id').val();
        if(class_selection != "" && section_id != ""){
          window.location.href = "<?php echo site_url();?>/admin/subject/"+class_selection;
        }
    }


    $(document).ready(function() {
        setTimeout(() => $('.selectpicker').select2(), 1000);
    });

    $(".selectpicker").change(function(){
        var selectedValues = $(this).val();
       
        if(selectedValues.indexOf('select_all') >=0){
            
            if($(this).attr('id') == "selectpickerClass"){
                $("#selectpickerClass  option.selectable_option").prop("selected","selected");
                $("#selectpickerClass  option.not_selectable_option").prop("selected"," ");
            }
            
            if($(this).attr('id') == "selectpickerSubject"){
                $("#selectpickerSubject  option.selectable_option").prop("selected","selected");
                $("#selectpickerSubject  option.not_selectable_option").prop("selected"," ");
            }
            
            
        }
    });

</script>