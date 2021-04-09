<style type="text/css">
    .button_design{
      background-color:#e4e4e4;
      border:1px solid #aaa;
      border-radius:4px;
      cursor:default;
      float: left;

      margin-right: 5px;
      margin-top:5px;
      padding:0 5px; 
    }
</style>

<?php echo $ids= $_GET['class_id'];?>
<?php $activeTab = "subjects"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Subjects</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>

  <!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/academic_nav_tab.php'; ?> 
  <!-- Including Navigation Tab -->
</div>



<div class="row">
	<div class="col-md-12">

    	<!---CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
					<?php echo get_phrase('co_scholastic_subject');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_co_scholastic_subject');?>
                    	</a></li>

          
		</ul>
    	<!---CONTROL TABS END------>
		<div class="tab-content">
        <br>
            <!---TABLE LISTING STARTS-->
		
			
			
			
			
			
			     <div class="tab-pane box active" id="list">

                <table class="table table-bordered" id="datatabless" >
                	<thead>
                		<tr>
                		    
                    		<th><div><?php echo get_phrase('class');?></div></th>
                    		<th><div><?php echo get_phrase('co_scholastic_subject');?></div></th>
                    
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;$class_id_arr = "";
					
						foreach($class_subject as $row):
    
                            ?>
                        <tr>
						    <td> 
							<?php echo $row['name'];
							$class_id= $row['class_id'];
							?>
                        
                            
                            
							<td>
							    <?php
							    $this->db->select('*');
							    $this->db->from('co_scholastic_subject');
                               $this->db->where('class_id', $class_id);
                               $result = $this->db->get()->result_array(); ?>
                               <?php 	foreach($result as $row2) { ?>
							  <li class="button_design" title="<?php echo $row['sub_name']; ?>" style="list-style: none;"><a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_edit_subject_tow/'.$row2['id']);?>');"><?php echo $row2['sub_name'];?></a></li>
							    <?php } ?>
							    </td>
					
                        </tr>
                        <?php  endforeach;  ?>
                    </tbody>
                </table>
			</div>
			
		
		
			<!----CREATION FORM ENDS-->

            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open(site_url('admin/co_scholastic_areas/create') , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        <div class="padded">
                            <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>

                        </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                                <div class="col-sm-5">
                                    <select name="class_id[]"  class="selectpicker" id="selectpickerClass" multiple="multiple" data-live-search="true" style="width:100%;hight:50px;" required >
                                     <option class=
                                        "non_selectable_option" value="" disabled><?php echo get_phrase('select_class'); ?></option>
                                        <?php
                                        $classes = $this->db->get('class')->result_array();
                                        foreach($classes as $row):
                                        ?>
                                            <option class="selectable_option" value="<?php echo $row['class_id'];?>"
                                                <?php if($row['class_id'] == $class_id) echo 'selected';?>>
                                                    <?php echo $row['name'];?>
                                            </option>
                                        <?php
                                        endforeach;
                                        ?>
                                        <option value="select_all" class=
                                        "non_selectable_option"><?php echo get_phrase('select_all'); ?></option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_subject');?></button>
                              </div>
                           </div>
                    </form>
                </div>
            </div>
            <!----CREATION FORM ENDS-->
            <br>

             <!---TABLE LISTING STARTS-->
         
		
			
			
				
			
			
			
			
		</div>
	</div>
</div>


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
    

	jQuery(document).ready(function($)
	{
		var datatable = $("#table_export").dataTable();
	});


    function get_class_sections(class_id) {

        $.ajax({
            url: '<?php echo site_url('admin/get_class_section/');?>' + class_id  ,
            success: function(response)
            {
              jQuery('#section_selector_holder').html(response);
            }
        });

    }

    function get_class_by_subject(val){
        // $.ajax({       
        //    type   : "POST",
        //    url    : "<?php echo site_url('ajax/get_class_by_subject'); ?>",
        //    data   : {'subject_id' : val},               
        //    success: function(response){  
        //     alert(response);     
        //     console.log(response); 
        //     $('#subject_by_classes').html(val);                                       
        //    }
        // });

    }

  
$(document).ready(function() {
    $('#datatabless').dataTable({
        "aLengthMenu": [[10, 25, 75, -1], [10,25, 50, 75, "All"]],
        "iDisplayLength": 10
    });
} );

</script>
