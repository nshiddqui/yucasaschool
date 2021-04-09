<?php $activeTab = "classess"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Section</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>

  <!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/academic_nav_tab.php'; ?> 
  <!-- Including Navigation Tab -->
</div>

<!--<a href="javascript:;" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_add_substitute_section/');?>');" 
	class="btn btn-primary pull-right">
    	<i class="entypo-plus-circled"></i>
			<?php echo get_phrase('add_substitute_teacher');?>
</a> -->
<br>
<a href="javascript:;" onclick="showAjaxModal('<?php echo site_url('modal/popup/section_add/');?>');" 
	class="btn btn-primary pull-right" style="margin-right: 10px;">
    	<i class="entypo-plus-circled"></i>
			<?php echo get_phrase('add_new_section');?>
</a> 
<br><br>

<div class="row">
	<div class="col-md-12">
	
		<div class="tabs-vertical-env">
		
			<ul class="nav tabs-vertical">
			<?php 
				$classes = $this->db->get('class')->result_array();
				foreach ($classes as $row):
			?>
				<li class="<?php if ($row['class_id'] == $class_id) echo 'active';?>">
					<a href="<?php echo site_url('admin/section/'.$row['class_id']);?>">
						<i class="entypo-dot"></i>
						<?php echo get_phrase('class');?> <?php echo $row['name'];?>
					</a>
				</li>
			<?php endforeach;?>
			</ul>
			
			<div class="tab-content">

				<div class="tab-pane active">
					<h4 class="simpleHeading"> Section List</h4>
					<table class="table table-bordered responsive">
						<thead>
							<tr>
								<th>#</th>
								<th><?php echo get_phrase('section_name');?></th>
								<th><?php echo get_phrase('nick_name');?></th>
								<th><?php echo get_phrase('perifix_code');?></th>
								<th><?php echo get_phrase('teacher');?></th>
								<th><?php echo get_phrase('options');?></th>
							</tr>
						</thead>
						<tbody>

						<?php
							$count    = 1;
							$sections = $this->db->get_where('section' , array(
								'class_id' => $class_id,'sub_teacher_status' => 0
							))->result_array();
							foreach ($sections as $row):
						?>
							<tr>
								<td><?php echo $count++;?></td>
								<td><?php echo $row['name'];?></td>
								<td><?php echo $row['nick_name'];?></td>
								<td><?php echo $row['perifix_code'];?></td>
								<td>
									<?php if ($row['teacher_id'] != '' || $row['teacher_id'] != 0)
										echo $this->db->get_where('teacher' , array('teacher_id' => $row['teacher_id']))->row()->name;
									?>
								</td>
								<td>
									<div class="btn-group">
		                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
		                                    Action <span class="caret"></span>
		                                </button>
		                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
		                                    
		                                    <!-- EDITING LINK -->
		                                    <li>
		                                        <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/section_edit/'.$row['section_id']);?>');">
		                                            <i class="entypo-pencil"></i>
		                                                <?php echo get_phrase('edit');?>
		                                            </a>
		                                                    </li>
		                                    <li class="divider"></li>
		                                    <li>
		                                        <a href="#" onclick="autogenrate_rollno('<?php echo $class_id;?>','<?php echo $row['section_id'];?>');">
		                                            <i class="entypo-pencil"></i>
		                                                <?php echo get_phrase('auto_generate_roll');?>
		                                            </a>
		                                                    </li>
		                                    <li class="divider"></li>
		                                    
		                                    <!-- DELETION LINK -->
		                                    <li>
		                                        <a href="#" onclick="confirm_modal('<?php echo site_url('admin/sections/delete/'.$row['section_id']);?>');">
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
				<!--<h4 class="simpleHeading"> Substitue Teacher List</h4>
					<table class="table table-bordered responsive">
						<thead>
							<tr>
								<th>S. No</th>
								<th><?php echo get_phrase('section_name');?></th>
								<th><?php echo get_phrase('date');?></th>
								<th><?php echo get_phrase('substitute_teacher');?></th>
								<th><?php echo get_phrase('options');?></th>
							</tr>
						</thead>
						<tbody>

						<?php
							$count    = 1;
							$sections = $this->db->get_where('section' , array(
								'class_id' => $class_id,'sub_teacher_status' => 1
							))->result_array();
							foreach ($sections as $row):
						?>
							<tr>
								<td><?php echo $count++;?></td>
								<td><?php echo $row['name'];?></td>
								<td><?php echo $row['date'];?></td>

								<td>
									<?php if ($row['teacher_id'] != '' || $row['teacher_id'] != 0)
											echo $this->db->get_where('teacher' , array('teacher_id' => $row['teacher_id']))->row()->name;
										?>
								</td>
								<td>
									<div class="btn-group">
		                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
		                                    Action <span class="caret"></span>
		                                </button>
		                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
		                                    
		                                   
		                                    <li>
		                                        <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_add_substitute_section/'.$row['section_id']);?>');">
		                                            <i class="entypo-pencil"></i>
		                                                <?php echo get_phrase('edit');?>
		                                            </a>
		                                                    </li>
		                                    <li class="divider"></li>
		                                    
		                                   
		                                    <li>
		                                        <a href="#" onclick="confirm_modal('<?php echo site_url('admin/sections/delete/'.$row['section_id']);?>');">
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
					</table>-->


				</div>

			</div>
			
		</div>	
<script type="text/javascript">
	
	autogenrate_rollno

	function autogenrate_rollno(class_id,section_id){
  
   if(class_id != "" && section_id != ""){
   		$.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('ajax/classAndSectionAutogenrateRoll/'); ?>"+class_id+'/'+section_id,
          async  : false,
          success: function(data){ 
            alert(data);
		 }
      	});
    }
}
</script>