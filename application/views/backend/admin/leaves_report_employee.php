<?php $activeTab = "leave_management"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Human Resource</a></li>
        <li class="active">Leaves Report</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/human_resource_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<?php


 $employee_type_list = get_employee_type_list();


 ?>

<?php echo form_open(site_url('admin/leaves_report_employee/find')); ?>
<div class="row mt-2">

    <?php
    
    $query = $this->db->get('class');
    if ($query->num_rows() > 0):
        $class = $query->result_array();
    ?>
    <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('employee_type'); ?></label>
                <select class="form-control selectboxit" name="emp_type" id="payment_to" onchange="get_user_list(this.value)">
                                                                                                                                                                                                                                                                  
                    <option value=""><?php echo get_phrase('select_employee_type'); ?></option>
				
					 	<?php foreach ($employee_type_list as $report){  ?>
                    <option value="<?php echo $report->slug ?>"><?php echo $report->name ?></option>
						<?php } ?>
                </select>
            </div>
        </div>
    <?php endif; ?>

         <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo get_phrase('user_list'); ?> <span class="required"> *</span></div>
                            <select  class="form-control col-md-12 col-xs-12"  name="user_id"  id="user_id" >
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                         
                            </select>
                            <div class="help-block"><?php echo form_error('user_id'); ?></div>
                        </div>
                    </div> 
   <!-- <div class="col-md-2">
         <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('month'); ?></label>
            
            <select name="month" class="form-control selectboxit">
                <?php

                for ($i = 1; $i <= 12; $i++):
                    if ($i == 1)
                        $m = 'january';
                    else if ($i == 2)
                        $m = 'february';
                    else if ($i == 3)
                        $m = 'march';
                    else if ($i == 4)
                        $m = 'april';
                    else if ($i == 5)
                        $m = 'may';
                    else if ($i == 6)
                        $m = 'june';
                    else if ($i == 7)
                        $m = 'july';
                    else if ($i == 8)
                        $m = 'august';
                    else if ($i == 9)
                        $m = 'september';
                    else if ($i == 10)
                        $m = 'October';
                    else if ($i == 11)
                        $m = 'november';
                    else if ($i == 12)
                        $m = 'december';
                    ?>
                    <option value="<?php echo $i; ?>"
                          <?php if($month == $i && $monthpost == ""){ 
                                 echo 'selected';
                                }
                                elseif($monthpost != "" && $i == $monthpost){
                                  echo 'selected';
                                }

                           ?>  >
                                <?php echo get_phrase($m); ?>
                    </option>
                    <?php
                endfor;
                ?>
            </select>
         </div>
    </div>-->

    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('sessional_year'); ?></label>
            <select class="form-control selectboxit" name="sessional_year">
                 <?php $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
                  $total_years  = $this->db->query("select * from academic_years where status = 1 order by session_year asc")->result();
                 ?>
                    <option value=""><?php echo get_phrase('select_running_session');?></option>
                    <?php foreach ($total_years as  $dt):?>
                        <option value="<?php echo $dt->start_year;?>-<?php echo $dt->end_year;?>"
                        <?php if($running_year == $dt->start_year.'-'.$dt->end_year && $sessional_year_post == "") { 
                               echo 'selected';
                               }elseif($sessional_year_post != "" && $sessional_year_post == $dt->start_year.'-'.$dt->end_year){
                                echo 'selected';
                              } 
                        ?> >
                            <?php echo $dt->start_year;?>-<?php echo $dt->end_year;?>
                        </option>
                  <?php endforeach;?>
            </select>
        </div>
    </div>

    <input type="hidden" name="operation" value="selection">
    <input type="hidden" name="year" value="<?php echo $running_year;?>">

    <div class="col-md-2 top-first-btn">
        <button type="submit" class="btn btn-info"><?php echo get_phrase('show_report');?></button>
    </div>
</div>

<?php echo form_close(); ?>
<?php if($find_emp_leave !=""){ ?>
<table class="table table-bordered datatable" >
    <thead>
        <tr>
            <th>S.No</th>
            <th><div><?php echo get_phrase('employee_name');?></div></th>
            <th><div><?php echo get_phrase('Request_Id');?></div></th>
            <th><div><?php echo get_phrase('From');?></div></th>
            <th><div><?php echo get_phrase('to');?></div></th>
            <th><div><?php echo get_phrase('status');?></div></th>
            <th><div><?php echo get_phrase('action');?></div></th>
        </tr>
    </thead>
    <tbody>
       <?php 
       if($leave_data != ""){
        $i=1;
       foreach ($leave_data as  $dt) { ?>
        <tr>
            <td><?php echo $i++;?></td>
            <td><?php echo $dt->name;?></td>
            <td><?php echo $dt->uniqid;?></td>
            <td><?php echo $dt->from_date!=""?$dt->from_date:'1 day ( '.$dt->leave_date.' )';?></td>
            <td><?php echo $dt->to_date;?></td>
            <td><span class="<?php echo $dt->status;?>"><?php echo $dt->status;?></span></td>
            <td>
               <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/leave_request_view/'.$dt->leave_id);?>')">
                                            <i class="entypo-pencil"></i>
                                            <?php echo get_phrase('View');?>
                                        </a>
                                    </li>
                                </ul>
                            </div>
             </td>
         </tr>
      <?php }} ?>
    </tbody>
</table>
<?php } ?>


<script type="text/javascript">

	   function get_user_list(payment_to, user_id){
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_user_list_by_type'); ?>",
            data   : { payment_to : payment_to, user_id : user_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   $('#user_id').html(response); 
               }
             }
          }); 
        }
</script>
