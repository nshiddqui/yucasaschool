<?php $activeTab = "houses"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Student</a></li>
        <li class="active">Houses</li>
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
    
        <!--CONTROL TABS START-->
        <!--<ul class="nav nav-tabs bordered hidden main-tabs">-->
        <!--    <li class="active">-->
  <!--              <a href="<?php echo site_url('house_information/list');?>" data-toggle="tab"><i class="entypo-menu"></i> -->
        <!--            <?php echo get_phrase('house_list');?>-->
  <!--                      </a></li>-->

  <!--          <li >-->
  <!--              <a href="<?php echo site_url('house_information/studentlist');?>" data-toggle="tab"><i class="entypo-menu"></i> -->
  <!--                  <?php echo get_phrase('student_list');?>-->
  <!--                      </a>-->
  <!--          </li>-->
        <!--    <li>-->
  <!--              <a href="<?php echo site_url('house_information/add');?>" data-toggle="tab"><i class="entypo-plus-circled"></i>-->
        <!--            <?php echo get_phrase('add_house');?>-->
  <!--                      </a></li>-->
        <!--    <li>-->
  <!--              <a href="<?php echo site_url('house_information/assing');?>" data-toggle="tab"><i class="entypo-plus-circled"></i>-->
        <!--            <?php echo get_phrase('assign_house');?>-->
  <!--              </a>-->
        <!--    </li>-->
        <!--</ul>-->
        <!--CONTROL TABS END-->
        
    
        <div class="tab-content">
        <br>
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box <?php if($list == 'list'){echo 'active';}?>" id="list">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered datatable" >
                    <thead>
                        <tr>
                            <th><div><?php echo get_phrase('house_logo');?></div></th>
                            <th><div><?php echo get_phrase('house_name');?></div></th>
                            <th><div><?php echo get_phrase('number_of_students');?></div></th>
                            <th><div><?php echo get_phrase('house_moto');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
         
                    <tbody>
            <?php
                $query = $this->db->get_where('house_info');
                if ($query->num_rows() > 0):
                    $house_data = $query->result_array();
                    foreach ($house_data as $row):
                ?>
                        <tr>
                            <td><?php $photo=$row['photo'];
                                               if($photo !=''){
                                               ?> <img src="<?php echo base_url('assets/uploads/house_information').'/'.$photo;?>" alt="..." class="img-circle" width="50"> 

                                               <?php }?></td>
                            <td><?=$row['name'];?></td>
                            <td><?php  $countquery = $this->db->get_where('assign_house',array('house_id'=>$row['house_id']))->result();

                            echo count($countquery);?></td>
                            <td><?=$row['description'];?></td>
                            <td><div class="btn-group"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    Action <span class="caret"></span></button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                   
                                     <li>
                                    <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_house_view_members/'.$row['house_id']);?>');">
                                        <i class="entypo-pencil"></i>
                                        <?php echo get_phrase('view_members');?>
                                    </a>
                                    </li>
                                   <li>
                                    <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_house/'.$row['house_id']);?>');">
                                        <i class="entypo-pencil"></i>
                                        <?php echo get_phrase('edit');?>
                                    </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                    <a href="#" onclick="confirm_modal('<?php echo site_url('admin/delete_house/'.$row['house_id']);?>');">
                                            <i class="entypo-trash"></i>
                                              <?php echo get_phrase('delete');?>
                                    </a>
                                    </li>
                                    

                                    
                                    </ul></div>
                            </td>
                        </tr>
                <?php endforeach; ?>
                <?php endif;?>   
                    </tbody>
                  
                </table>
            </div>
            <!----TABLE LISTING ENDS--->


            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box <?php if($list == 'assign'){echo 'active';}?>"  id="assign">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered datatable" >
                    <thead>
                        <tr>
                            <th><div><?php echo get_phrase('student_photo');?></div></th>
                            <th><div><?php echo get_phrase('student_name');?></div></th>
                            <th><div><?php echo get_phrase('house_name');?></div></th>
                            <th><div><?php echo get_phrase('class');?></div></th>
                            <th><div><?php echo get_phrase('section');?></div></th>
                            <th><div><?php echo get_phrase('option');?></div></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            $query = $this->db->get_where('assign_house');
                            if ($query->num_rows() > 0):
                             $house_data = $query->result_array();
                               foreach ($house_data as $row):
                      ?>
                        <tr>
                         <td><img src="<?php echo $this->crud_model->get_image_url('student',$row['student_id']);?>" class="img-circle" width="30" /></td>
                            <td> <?php
                                    echo $this->db->get_where('student' , array(
                                        'student_id' => $row['student_id']
                                    ))->row()->name;
                                ?></td>
                            <td><?php
                                    echo $this->db->get_where('house_info' , array(
                                        'house_id' => $row['house_id']
                                    ))->row()->name;
                                ?></td>
                            <td><?php
                                    echo $this->db->get_where('class' , array(
                                        'class_id' => $row['class_id']
                                    ))->row()->name;
                                ?></td>
                            <td><?php
                                    echo $this->db->get_where('section' , array(
                                        'section_id' => $row['section_id']
                                    ))->row()->name;
                                ?></td>
                            <td><!--<div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    Action <span class="caret"></span></button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                        <li><a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_assign_house/'.$row['assign_id']);?>');">
                                            <i class="entypo-pencil"></i>
                                            <?php echo get_phrase('edit');?>
                                           </a>
                                         </li>
                                        <li class="divider"></li>
                                        <li><a href="#" onclick="confirm_modal('<?php echo site_url('admin/delete_assign_house/'.$row['assign_id']);?>');">
                                            <i class="entypo-trash"></i>
                                              <?php echo get_phrase('delete');?>
                                    </a></li>
                                    </ul>
                                </div>-->
                                <a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('<?php echo site_url('admin/delete_assign_house/'.$row['assign_id']);?>');">
                                            <i class="fa fa-trash-o"></i>
                                              <?php echo get_phrase('delete');?>
                                    </a>
                                
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif;?>
                    
                     </tbody>
                  
                </table>
            </div>
            <!----TABLE LISTING ENDS--->


            
            
            <!----CREATION FORM STARTS---->  <!-- site_url('admin/dormitory/create') -->
            <div class="tab-pane box <?php if($list == 'add'){ echo 'active';}?> " id="add"  style="padding: 5px">
                <div class="box-content">
               
                    <?php echo form_open_multipart(site_url('admin/house/create'), array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('house_name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="msg_id" name="name" onblur= "name_validation(this.value,this.id,null,'house_info','<?php echo get_phrase('house_name');?>');"
                                        data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                        
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                                <div class="col-sm-5">
                                    <textarea type="text" class="form-control" name="description"/></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                             <label class="col-sm-3 control-label"><?php echo get_phrase('house_logo');?></label>                                       
                                                <div class="btn btn-default btn-file col-sm-5">
                                                <i class="fa fa-paperclip"></i> Upload  
                                                <input class="form-control" name="photo" id="photo" value="" placeholder="email" type="file">
                                            </div>
                                            <div class="text-info">Image file format: .jpg, .jpeg, .png or .gif</div>
                                            <div class="help-block"></div>
                                        </div>
                                 
                            
                            
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_house');?></button>
                              </div>
                            </div>
                    </form>                
                </div>                
            </div>
            <!----CREATION FORM ENDS-->
          

    <div  class="tab-pane  <?php if($list == 'non_member_list'){ echo 'active';}?>" id="non_member_list" >
        <div class="x_content">
          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap datatable" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th><?php echo $this->lang->line('sl_no'); ?></th>
                <th><?php echo $this->lang->line('photo'); ?></th>
                <th><?php echo $this->lang->line('name'); ?></th>
                <th><?php echo $this->lang->line('class'); ?></th>
                <th><?php echo $this->lang->line('section'); ?></th>
                <th>Select House</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php $count = 1; if(isset($non_members) && !empty($non_members)){ ?>
              <?php foreach($non_members as $obj){ ?>
              <tr>
                <td><?php echo $count++; ?></td>
                <td><img src="<?php echo $this->crud_model->get_image_url('student',$obj->student_id);?>" class="img-circle" width="30" /></td>
                <td><?php echo $obj->name; ?></td>
                <?php  
                   $houses = $this->db->get_where('enroll',array('student_id'=>$obj->student_id))->result();  
             
                foreach($houses as $house){ 
                ?>

                <td><?php echo $this->db->get_where('class' , array( 'class_id' => $house->class_id))->row()->name;?></td>
                <td><?php echo $this->db->get_where('section' , array( 'section_id' => $house->section_id))->row()->name;?></td>
                <?php }
                 ?>
               
                
                 <td><select  class="form-control col-md-7 col-xs-12 alignleft" name="house_id" id="house_id<?php echo $obj->student_id; ?>" onchange="get_room_by_hostel(this.value, '<?php echo $obj->student_id; ?>');" required>
                    <option value="">--<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('house'); ?>--</option>
                    <?php  
                      $houses = $this->db->get_where('house_info',array('status'=>1))->result();                                     
                       foreach($houses as $house){ ?>
                       <option value="<?php echo $house->house_id; ?>"><?php echo $house->name; ?> </option>
                      <?php } ?>
                  </select>
                 </td>
                <td>
                
                  <a href="javascript:void(0);" id="<?php echo $obj->student_id; ?>" class="btn btn-default  fn_add_to_house"><i class="fa fa-reply"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('member'); ?> </a>
               </td>
              </tr>
              <?php } ?>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
            <!----CREATION FORM ENDS-->
        </div>
    </div>
</div>

<script type="text/javascript">

$(document).ready(function(){
        $('.fn_add_to_house').click(function(){
            var obj      = $(this);  
            var user_id  = $(this).attr('id');         
            var hostel_id= $('#house_id'+user_id).val();         
            
            
            if(hostel_id == ''){
                toastr.error('Please <?php echo $this->lang->line('select'); ?> house'); 
                return false;
            }
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('admin/assign_house/create'); ?>",
            data   : { 'user_id' : user_id, 'house_id' : hostel_id},               
            async  : false,
            success: function(response){ 
            if(response){
                toastr.success(response);
                obj.parents('tr').remove();
             }else{
                toastr.error('<?php echo get_phrase('update_failed'); ?>'); 
             }
            }
        }); 
        
  });       
});

        function get_class_by_section(class_id){       
         $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_class_by_section'); ?>",
            data   : { class_id : class_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                console.log(response);
                $('#edit_section_id').html(response);
                var section_id = document.getElementById('edit_section_id').value;
                if(section_id)
                  get_section_by_student(section_id,classid)
               }
            }
        });  
     }
   
    function get_section_by_student(section_id,classid=""){  
     var classid = document.getElementById('class_id').value;     
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_section_by_student'); ?>",
            data   : { class_id : classid,section_id:section_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                console.log(response);
                $('#edit_student_id1').html(response);
               }
            }
        });  
    }

    function get_student_name(classid){
        var studentname = $("#edit_student_id1 :selected").text();
        $('#student_name').val(studentname);
     }
  </script>
  <script type="text/javascript">

$(document).ready(function(){
$('.fn_add_to_hostel').click(function(){
var obj      = $(this);  
var user_id  = $(this).attr('id');         
var house_id= $('#house_id'+user_id).val();         


if(house_id == ''){
toastr.error('<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('hostel'); ?>'); 
return false;
}

$.ajax({       
type   : "POST",
url    : "<?php echo site_url('admin/add_to_house_list'); ?>",
data   : { user_id : user_id, house_id : house_id},               
async  : false,
success: function(response){ 
if(response){
toastr.success('<?php echo get_phrase('data_update_success'); ?>');
obj.parents('tr').remove();
}else{
toastr.error('<?php echo get_phrase('update_failed'); ?>'); 
}
}
}); 

});       
});


function get_room_by_hostel(hostel_id, user_id){       

$.ajax({       
type   : "POST",
url    : "<?php echo site_url('ajax/get_room_by_hostel'); ?>",
data   : { house_id : house_id },               
async  : false,
success: function(response){                                                   
if(response)
{                  
$('#room_id_'+user_id).html(response);
}
}
});         
} 


</script> 