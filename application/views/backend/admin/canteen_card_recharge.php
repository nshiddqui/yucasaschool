<?php $activeTab = "card_recharge"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Student</a></li>
        <li class="active">Card_Recharge</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/student_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>
		<div class="">
    
            <!----TABLE LISTING STARTS-->
            <div class=" row " >
                <div class="">
                    <?php echo form_open(site_url('admin/canteen_card_recharge_process') , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>

                             <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('select_class');?></label>
                                <div class="col-sm-5">
                                    <select name="class_id" id="class_id" class="form-control" required onchange="get_class_sections(this.value),get_student();">
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

                            <div class="form-group" id="sectionSelect">
                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('select_section');?></label>
                                <div class="col-sm-5">
                                  <select name="section_id" id="section_id" class="form-control" required onchange="get_student();">
                                      <option value=""><?php echo get_phrase('select');?></option>
                                      
                                  </select>
                                </div> 
                            </div>  

                            <div class="form-group" id="studentSelect" >
                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('select_student');?></label>
                                
                                <div class="col-sm-5">
                                  <select name="student_id" class="form-control" id="student_id" required>
                                    <option value=""><?php echo get_phrase('select');?></option>
                                  </select>
                                </div> 
                            </div>
                            <div class="form-group">
                              <label class="col-sm-3 control-label"><?php echo get_phrase('amount');?></label>
                              <div class="col-sm-5">
                               
                                <input type="text" name="amount" value="" class="form-control">
                               
                              </div>
                            </div>

                           <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="description"/>
                                </div>
                              </div>

                             <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" name="submit" class="btn btn-warning"><?php echo get_phrase('submit');?></button>
                                </div>
                                </div>
                    </form>                
                </div>  
              
			      </div>
            <!----TABLE LISTING ENDS--->
   </div>
	</div>

</div>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->     
<script type="text/javascript">

 jQuery(document).ready(function($)
  {
   $('#table_export').dataTable();
  });



    function get_class_sections(class_id) {
          $.ajax({
            url: '<?php echo site_url('ajax/get_class_by_section/');?>',
            data: {'class_id':class_id},
            type   : "POST",
            success: function(response)
            {   
              jQuery('#section_id').html(response);
              get_student();
            }
         });
       
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
           jQuery('#student_id').html(response);
          }
        });
      }


</script>


