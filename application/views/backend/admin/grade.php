<?php $activeTab = "exam"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Exam</a></li>
        <li class="active">Grade</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
</div>

<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="<?= isset($_GET['add']) ? '' : 'active' ?>">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('grade_list');?>
                    	</a></li>
			<li class="<?= isset($_GET['add']) ? 'active' : '' ?>">
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_grade');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>
		<div class="tab-content">
        <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box <?= isset($_GET['add']) ? '' : 'active' ?>" id="list">
				
                <table class="table table-bordered datatable" >
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('grade_name');?></div></th>
                    		<th><div><?php echo get_phrase('grade_point');?></div></th>
                    		<th><div><?php echo get_phrase('percentage_from');?></div></th>
                    		<th><div><?php echo get_phrase('percentage_to');?></div></th>
                    		<th><div><?php echo get_phrase('comment');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($grades as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['name'];?></td>
							<td><?php echo $row['grade_point'];?></td>
							<td><?php echo $row['mark_from'];?></td>
							<td><?php echo $row['mark_upto'];?></td>
							<td><?php echo $row['comment'];?></td>
							<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    
                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_edit_grade/'.$row['grade_id']);?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    
                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo site_url('admin/grade/delete/'.$row['grade_id']);?>');">
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
			<div class="tab-pane box <?= isset($_GET['add']) ? 'active' : '' ?>" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(site_url('admin/grade/create') , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-5 controls">
                                    <input type="text" class="form-control" name="name"
                                        data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('grade_point');?></label>
                                <div class="col-sm-5 controls">
                                    <input type="text" class="form-control" name="grade_point"
                                        data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('percentage_from');?></label>
                                <div class="col-sm-5 controls">
                                    <input type="text" class="form-control" name="mark_from"
                                        data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('percentage_to');?></label>
                                <div class="col-sm-5 controls">
                                    <input type="text" class="form-control" name="mark_upto"
                                        data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('comment');?></label>
                                <div class="col-sm-5 controls">
                                    <input type="text" class="form-control" name="comment"/>
                                </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_grade');?></button>
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

	jQuery(document).ready(function($)
    {
        $('#table_export').dataTable();
    });
		
</script>