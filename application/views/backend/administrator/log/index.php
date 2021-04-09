<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-users"></i><small> <?php echo $this->lang->line('manage'); ?> <?php echo $this->lang->line('activity_log'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content"> 
                <?php echo form_open_multipart(site_url('administrator/activitylog'), array('name' => 'activitylog', 'id' => 'activitylog', 'class' => 'form-horizontal form-label-left'), ''); ?>
                <div class="row">
                  
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo $this->lang->line('user'); ?> <?php echo $this->lang->line('type'); ?> </div>
                            <select  class="form-control col-md-7 col-xs-12"  name="role_id"  id="role_id" onchange="get_user_by_role(this.value,'');">
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                <?php foreach($roles as $obj ){ ?>
                                <option value="<?php echo $obj->id; ?>" <?php if(isset($role_id) && $role_id == $obj->id){ echo 'selected="selected"'; } ?>><?php echo $obj->name; ?></option>
                                <?php } ?>                                            
                            </select>
                            <div class="help-block"><?php echo form_error('role_id'); ?></div>
                        </div>
                    </div>
                  
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo $this->lang->line('user'); ?></div>
                            <select  class="form-control col-md-12 col-xs-12"  name="user_id"  id="user_id" >
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                         
                            </select>
                            <div class="help-block"><?php echo form_error('user_id'); ?></div>
                        </div>
                    </div>                    
                   
                
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group"><br/>
                            <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('find'); ?></button>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            
             <div class="x_content">
                <div class="" data-example-id="togglable-tabs">                    
                    <ul  class="nav nav-tabs bordered">                 
                        <li  class="active"><a href="#tab_activitylog_list" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-users"></i> <?php echo $this->lang->line('activity_log'); ?> <?php echo $this->lang->line('list'); ?></a></li>                          
                    </ul>
                    <br/>
                     <div class="tab-content">
                        <div  class="tab-pane fade in active" id="tab_user_list" >
                           
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th><?php echo $this->lang->line('name'); ?></th>
                                        <th><?php echo $this->lang->line('phone'); ?></th>
                                        <th><?php echo $this->lang->line('role'); ?></th>
                                        <th><?php echo $this->lang->line('activity_log'); ?></th> 
                                        <th><?php echo $this->lang->line('action'); ?> </th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php
                                    $count = 1;
                                    if (isset($activity_logs) && !empty($activity_logs)) {
                                        ?>
                                        <?php foreach ($activity_logs as $obj) { ?>
                                            
                                            <tr>
                                                <td><?php echo $count++;  ?></td>
                                                <td><?php echo ucfirst($obj->name); ?></td>
                                                <td><?php echo $obj->phone; ?></td>
                                                <td><?php echo @$this->db->get_where('roles',array('id'=>$obj->role_id))->row()->name; ?></td>
                                                <td><?php echo $obj->activity; ?> at
                                                  <?php echo date('d, Y l H:i:s a', strtotime($obj->created_at)); ?></td>   
                                                <td>                                                 
                                                    <?php if(has_permission(DELETE, 'administrator', 'activitylog')){ ?>    
                                                        <a href="<?php echo site_url('administrator/activitylog/delete/'.$obj->id); ?>"  onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
                                                    <?php } ?> 
                                                </td>   
                                            </tr>
                                        <?php } ?>
                                    <?php } ?> 

                                </tbody>
                            </table>
                        </div> 
                        </div>
                 </div>
            </div>

            
        </div>
    </div>
</div>
</div>

<script>
            function get_user_by_role(payment_to, user_id){
        
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_user_list_by_type'); ?>",
            data   : { payment_to : payment_to, user_id : user_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                //alert(response);
                   $('#user_id').html(response); 
               }
            }
        }); 
   } 


    function get_user_by_role(role_id, user_id){       
           
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_user_by_role'); ?>",
            data   : { role_id : role_id , user_id: user_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {   //alert(response);
                   
                        $('#user_id').html(response);                       
                   
               }
            }
        });  
   }  
</script>