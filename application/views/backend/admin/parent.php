<?php $activeTab = "parent_and_gaurdians"; ?>
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
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Student</a></li>
        <li class="active">Parent & Gaurdians</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
</div>
<?= form_open('') ?>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-3">
                                            <div class="item form-group">
                                                <label class="control-label" for="class_id"><?php echo $this->lang->line('class'); ?> <span class="required">*</span>
                                                </label>
                                                
                                                <?php $classes = $this->db->get('class')->result(); 
                                                     $class_id = isset($_POST['class_id'])?$_POST['class_id']:'';                         
                                                ?>
            
            
                                                    <select  class="form-control col-md-7 col-xs-12"  name="class_id"  id="search_class_id" required="required" onchange="return get_class_sections(this.value,'search')" >
                                                        <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                                        <?php foreach($classes as $obj ){ ?>
                                                        <option value="<?php echo $obj->class_id; ?>" <?= $class_id == $obj->class_id ? 'selected':''?>><?php echo $obj->name; ?></option>
                                                        <?php } ?>                                            
                                                    </select>
                                                    <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="item form-group">
                                                <label class="control-label" for="section_selector_holder"><?php echo $this->lang->line('section'); ?>
                                                </label>
                                                    <select  class="form-control col-md-7 col-xs-12"  name="section_id"  id="searchsection_selector_holder" onchange="return get_student_by_class_sections(this.value,'search')" >
                                                        <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                                        <?php
                                                        $section_id = isset($_POST['section_id'])?$_POST['section_id']:'';
                                                        if(!empty($class_id)){
                                                            $sections = $this->db->get_where('section',['class_id'=>$class_id])->result();
                                                            foreach($sections as $section){ 
                                                                ?>
                                                                <option value="<?= $section->section_id ?>" <?= $section->section_id == $section_id ? 'selected':'' ?>> <?= $section->name ?></option>
                                                            <?php }
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="help-block"><?php echo form_error('student_id'); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="item form-group">
                                                <label class="control-label" for="add_student_id"><?php echo $this->lang->line('student'); ?>
                                                </label>
                                                    <select  class="form-control col-md-7 col-xs-12"  name="student_id"  id="search_student_id"  >
                                                        <option value="">--<?php echo $this->lang->line('select'); ?>--</option>  
                                                        <?php
                                                        $student_id = isset($_POST['student_id'])?$_POST['student_id']:'';
                                                        if(!empty($class_id) && !empty($section_id)){
                                                            $this->db->join('enroll','enroll.student_id = student.student_id');
                                                            $students = $this->db->get_where('student',['enroll.class_id'=>$class_id,'enroll.section_id' => $section_id])->result();
                                                            foreach($students as $student){ 
                                                                ?>
                                                                <option value="<?= $student->student_id ?>" <?= $student->student_id == $student_id ? 'selected':'' ?>> <?= $student->name ?></option>
                                                            <?php }
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="help-block"><?php echo form_error('student_id'); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary" style="margin-top:30px">Get Data</button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <?= form_close();?>

               <table class="table table-bordered datatable" id="parents-">
                    <thead>
                        <tr>
                            <th><div><?php echo get_phrase('parent_id');?></div></th>
                         
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th><div><?php echo get_phrase('email');?></div></th>
                            <th><div><?php echo get_phrase('phone');?></div></th>
                            <th><div><?php echo get_phrase('student_name');?></div></th>
                            <th><div><?php echo get_phrase('profession');?></div></th>
                            <?php if(($this->session->userdata('admin_login') == 1)){ ?>
                            <th><div><?php echo get_phrase('options');?></div></th>
                            <?php } ?>

                        </tr>
                    </thead>
					
					<tbody>
					<?php  foreach($parent_list as $row){?>
					
						<tr>
							<td><?php echo $row['parent_id'] ;?></td>
							
							<td><?php echo $row['name'] ;?></td>
							<td><?php echo $row['email'] ;?></td>
							<td><?php echo $row['phone'] ;?></td>
							<td><?= $row['student_name']?></td>
							<td><?php echo $row['profession'] ;?></td>
							<?php if(($this->session->userdata('admin_login') == 1)){ ?>
							<td>
							<div class="btn-group">
							<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> Action <span class="caret"></span></button>
							<ul class="dropdown-menu dropdown-default pull-right" role="menu">
							<li><a href="#" onclick="parent_edit_modal(<?php echo $row['parent_id'] ;?>)"><i class="entypo-pencil"></i><?php echo get_phrase('edit');?></a></li>
							<li class="divider"></li>
							<li><a href="#" onclick="parent_delete_confirm(<?php echo $row['parent_id'] ;?>)"><i class="entypo-trash"></i><?php echo get_phrase('delete');?></a></li>
							</ul>
							</div>
							</td>
							<?php } ?>
						</tr>
						
						<?php } ?>
					</tbody>
                </table>
</div>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->
<script type="text/javascript">

    jQuery(document).ready(function($) {
        $.fn.dataTable.ext.errMode = 'throw';
        $('#parents').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                "url": "<?php echo site_url('admin/get_parents') ?>",
                "dataType": "json",
                "type": "POST",
            },
            "columns": [
                { "data": "parent_id" },
                { "data": "name" },
                { "data": "email" },
                { "data": "phone" },
                { "data": "profession" },
                { "data": "options" },
            ],
            "columnDefs": [
                {
                    "targets": [5],
                    "orderable": false
                },
            ],
			dom: 'Bfrtip',
              iDisplayLength: 10,
              buttons: [
              {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':not(:last-child)',
                }
 },
      {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':not(:last-child)',
                }
 },
  
              ],
        
              search: true
        });
    });

    function parent_edit_modal(parent_id) {
        showAjaxModal('<?php echo site_url('modal/popup/modal_parent_edit/');?>' + parent_id);
    }

    function parent_delete_confirm(parent_id) {
        confirm_modal('<?php echo site_url('admin/parent/delete/');?>' + parent_id);
    }

</script>
<script>
    function get_class_sections(class_id,type = '') {
        
    	$.ajax({
            url: '<?php echo site_url('admin/get_class_section/');?>' + class_id ,
            success: function(response)
            {
                jQuery('#'+type+'section_selector_holder').html(response);
            }
        });

    }
    
    function get_student_by_class_sections(section_id,type='') {
        var class_id = $('#'+type+'_class_id').val();
        if(class_id=='' || section_id==''){
            jQuery('#'+type+'_student_id').html('<option value="">Select</option>');
        }
    	$.ajax({
            url: '<?php echo site_url('admin/get_students_for_ssph/');?>' + class_id+'/'+section_id ,
            success: function(response)
            {
                jQuery('#'+type+'_student_id').html(response);
            }
        });

    }
</script>