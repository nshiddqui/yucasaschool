<?php $activeTab = "dormitory"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Facilities</a></li>
        <li class="active">Dormitory</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/parent/facilities_nav_tab.php'; ?>
<!-- Including Navigation Tab -->
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tab-content">
            <div class="tab-pane active" id="home">

                <table class="table table-bordered datatable">
                    <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th><?php echo $this->lang->line('name'); ?></th>
                                        <th><?php echo $this->lang->line('phone'); ?></th>
                                        <th><?php echo $this->lang->line('date'); ?></th>
                                        <th><?php echo $this->lang->line('to_meet'); ?></th>
                                        <th><?php echo $this->lang->line('reason_to_meet'); ?></th>
                                        <th><?php echo $this->lang->line('check_in'); ?></th>
                                        <th><?php echo $this->lang->line('check_out'); ?></th>
                                                                           
                                    </tr>
                                </thead>
                     <tbody>
					   <?php $count = 1; if(isset($visitors) && !empty($visitors)){ ?>
                      <?php  if($visitors != ""){
                        foreach($visitors as $obj){
                            ?>
                            <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td ><?php echo $obj->name; ?></td>
                                            <td><?php echo $obj->phone; ?></td>
                                            <td><?php echo date('d F Y', strtotime($obj->created_at)) ?></td>
                                            <td><?php $user = get_user_by_role($obj->role_id, $obj->user_id); echo $user->name; ?><br/>
                                            </td>
                                            <td><?php echo $this->lang->line($obj->reason); ?></td>                                           
                                            <td><?php echo date('h:i:s A', strtotime($obj->check_in)); ?></td>                                           
                                            <td><?php echo $obj->check_out ? date(' H:i:s A', strtotime($obj->check_out)) : '<a style="color:red;" href="javascript:void(0);" onclick="check_out('.$obj->id.');">'.$this->lang->line('check_out').'</a>'; ?></td>                                           
                                          
                                        </tr>
                      <?php  }} ?>
					     <?php } ?>
                     </tbody>
                </table>

            </div>
      
           


        </div>


    </div>
</div>
