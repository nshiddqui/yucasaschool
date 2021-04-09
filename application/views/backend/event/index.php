<?php $activeTab = "event"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Event</a></li>
        <li class="active">Event List</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/extra_curricular_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<!-- GETTING CLASS LIST -->
<?php $class_list = get_classes_list();?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa fa-calendar-check-o"></i><small> <?php echo $this->lang->line('manage_event'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered hidden">
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_event_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('event'); ?> <?php echo $this->lang->line('list'); ?></a> </li>
                        <?php if(has_permission(ADD, 'event', 'event')){ ?>
                            <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_event"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('event'); ?></a> </li>                          
                        <?php } ?>
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_event"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> <?php echo $this->lang->line('event'); ?></a> </li>                          
                        <?php } ?>                
                        <?php if(isset($detail)){ ?>
                            <li  class="active"><a href="#tab_view_event"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> <?php echo $this->lang->line('event'); ?></a> </li>                          
                        <?php } ?>                
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_event_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th><?php echo $this->lang->line('event'); ?> <?php echo $this->lang->line('title'); ?></th>
                                        <th><?php echo $this->lang->line('event_for'); ?></th>
                                        <th><?php echo $this->lang->line('event_place'); ?></th>
                                        <th><?php echo $this->lang->line('from_date'); ?></th>
                                        <th><?php echo $this->lang->line('to_date'); ?></th>
                                       <!--  <th><?php echo $this->lang->line('image'); ?></th> -->
                                       <?php  if ($this->session->userdata('admin_login') == 1 || $this->session->userdata('teacher_login') == 1) { ?>
                                        <th><?php echo $this->lang->line('action'); ?></th>   
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($events) && !empty($events)){ ?>
                                        <?php foreach($events as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $obj->title; ?></td>
                                            <td><?php echo $obj->name ? $obj->name : $this->lang->line('all');?></td>
                                            <td><?php echo $obj->event_place; ?></td>
                                            <td><?php echo $obj->event_from; ?></td>
                                            <td><?php echo $obj->event_to; ?></td>
                                           <?php  if ($this->session->userdata('admin_login') == 1 || $this->session->userdata('teacher_login') == 1) { ?>
                                            <td>
                                                <?php if(has_permission(EDIT, 'event', 'event')){ ?>
                                                    <a href="<?php echo site_url('event/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> </a>
                                                <?php } ?>
                                           
                                                <?php if(has_permission(DELETE, 'event', 'event')){ ?>
                                                    <a href="<?php echo site_url('event/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
                                                <?php } ?>
                                            </td>
                                            <?php } ?>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_event">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('event/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title"><?php echo $this->lang->line('event'); ?> <?php echo $this->lang->line('title'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="title"  id="title" value="<?php echo isset($post['title']) ?  $post['title'] : ''; ?>" placeholder="<?php echo $this->lang->line('event'); ?> <?php echo $this->lang->line('title'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('title'); ?></div>
                                    </div>
                                </div>

                                 <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="role_id"><?php echo $this->lang->line('event_for'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12 role_id_class"  name="role_id"  id="role_id" required="required">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <option value="0"><?php echo $this->lang->line('all'); ?></option> 
                                            <?php foreach($roles as $obj ){ ?>
                                            <option value="<?php echo $obj->id; ?>" <?php echo isset($post['role_id']) && $post['role_id'] == $obj->id ?  'selected="selected"' : ''; ?>><?php echo $obj->name; ?></option>
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('role_id'); ?></div>
                                    </div>
                                </div>

                                <div class="item form-group for_type_wrapper" style="display: none;">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="event_for_role">Event Details<span class="required">*</span>
                                    </label>

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="for_type" id="for_type" class="form-control" >
                                            <option value="select" disabled="">---Select---</option>
                                            <option value="all_classes">All</option>
                                            <option value="classes">Class</option>
                                            <option value="section">Section</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="item form-group class_wrapper " style="display: none;">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id">Select Class <span class="required">*</span>
                                    </label>

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="class_id" id="" class="form-control" onchange="select_section(this.value, '', true);">
                                            <?php foreach($class_list as $class){ ?>
                                                <option value="<?php echo $class->class_id;?>"><?php echo $class->name;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="item form-group section_wrapper " style="display: none;">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="section_id">Select Section <span class="required">*</span>
                                    </label>

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="section_id" id="section_id" class="form-control" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>  
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="event_place"><?php echo $this->lang->line('event_place'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="event_place"  id="event_place" value="<?php echo isset($post['event_place']) ?  $post['event_place'] : ''; ?>" placeholder="<?php echo $this->lang->line('event_place'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('event_place'); ?></div>
                                    </div>
                                </div>                                
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="event_from"><?php echo $this->lang->line('from_date'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="event_from"  id="add_event_from" value="<?php echo isset($post['event_from']) ?  $post['event_from'] : ''; ?>" placeholder="<?php echo $this->lang->line('from_date'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('event_from'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="event_to"><?php echo $this->lang->line('to_date'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="event_to"  id="add_event_to" value="<?php echo isset($post['event_to']) ?  $post['event_to'] : ''; ?>" placeholder="<?php echo $this->lang->line('to_date'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('event_to'); ?></div>
                                    </div>
                                </div>
                                
                               <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $this->lang->line('image'); ?>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 imagesWrapper">
                                        <div class=" uploadImage">
                                            <i class="fa fa-paperclip"></i> <?php echo $this->lang->line('upload'); ?>
                                            <input  class="form-control col-md-7 col-xs-12"  name="image[]"  id="image" type="file">
                                        </div>

                                        <div class=" uploadImage clone hidden">
                                            <i class="fa fa-paperclip"></i> <?php echo $this->lang->line('upload'); ?>
                                            <input  class="form-control col-md-7 col-xs-12"  name="image[]"  id="image" type="file">
                                            <span class="remove pull-right" style="color: red">remove</span>
                                        </div>

                                        <div class="text-info"><?php echo $this->lang->line('valid_file_format_img'); ?></div>
                                        <div class="help-block"><?php echo form_error('image'); ?></div>
                                        <div class="addMore"><div href="btn btn-success">+ Add More</div></div>
                                    </div>
                               </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo $this->lang->line('note'); ?>"><?php echo isset($post['note']) ?  $post['note'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                               
                               
                                  <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="event_to"> Alert Notofication
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="send_to_all"  id="send_to_all" value="1" type="checkbox" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('send_to_all'); ?></div>
                                    </div>
                                </div>
                               
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('event'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  

                        <?php if(isset($edit)){ ?>
                        <div class="tab-pane fade in active" id="tab_edit_event">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('event/edit/'.$event->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title"><?php echo $this->lang->line('event'); ?> <?php echo $this->lang->line('title'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="title"  id="title" value="<?php echo isset($event->title) ?  $event->title : $post['title']; ?>" placeholder="<?php echo $this->lang->line('event'); ?> <?php echo $this->lang->line('title'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('title'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="role_id"><?php echo $this->lang->line('event_for'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="role_id"  id="role_id" required="required" >
                                             <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                             <option value="0" <?php if($event->role_id == 0){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('all'); ?></option>
                                            <?php foreach($roles as $obj ){ ?>
                                            <option value="<?php echo $obj->id; ?>" <?php if($event->role_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('role_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="event_place"><?php echo $this->lang->line('event_place'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="event_place"  id="event_place" value="<?php echo isset($event->event_place) ?  $event->event_place : $post['event_place']; ?>" placeholder="<?php echo $this->lang->line('event_place'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('event_place'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="event_from"><?php echo $this->lang->line('from_date'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="event_from"  id="edit_event_from" value="<?php echo isset($event->event_from) ?  date('d-m-Y', strtotime($event->event_from)) : $post['event_from']; ?>" placeholder="<?php echo $this->lang->line('from_date'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('event_from'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="event_to"><?php echo $this->lang->line('to_date'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="event_to"  id="edit_event_to" value="<?php echo isset($event->event_to) ?  date('d-m-Y', strtotime($event->event_to)) : $post['event_to']; ?>" placeholder="<?php echo $this->lang->line('to_date'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('event_to'); ?></div>
                                    </div>
                                </div>
                                
                                                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $this->lang->line('image'); ?>
                                    </label>

                                    <div class="prevImagesWrapper col-md-6 col-sm-6 col-xs-12 ">
                                        <?php 
                                          //$image_data =   $this->db->get_where('event_images',array('event_id'=>$event->id))->order_by('Asc','id')->result();
                                          $this->db->select('*');
                                          $this->db->from('event_images');
                                          $this->db->where('event_id',$event->id);
                                          $this->db->order_by("id", "asc");
                                          $query = $this->db->get(); 
                                          $image_data = $query->result();

                                          foreach ($image_data as $key => $dtimages) {
                                           
                                          
                                        ?>

                                        <div class="prevImage">
                                            <input type="hidden" name="prev_image[]" id="prev_image" value="<?php echo $dtimages->image; ?>" />
                                            <?php if($dtimages->image){ ?>
                                            <img src="<?php echo UPLOAD_PATH; ?>/event/<?php echo $dtimages->image; ?>" alt="" width="70" /><br/><br/>
                                            <?php } ?>
                                            <div class="btn btn-default btn-file">
                                                <i class="fa fa-paperclip"></i> <?php echo $this->lang->line('upload'); ?>
                                                <input  class="form-control col-md-7 col-xs-12"  name="image[]"  id="image" type="file">
                                            </div>
                                           
                                        </div>
                                    <?php } ?>
                                        <div class="editImagesWrapper">
                                            <div style="margin-top:10px;"><strong>Add New Images</strong></div>
                                            <div class="editUploadImage">
                                                <i class="fa fa-paperclip"></i> <?php echo $this->lang->line('upload'); ?>
                                                <input  class="form-control col-md-7 col-xs-12"  name="image[]"  id="image" type="file">
                                            </div>

                                            <div class="editUploadImage clone hidden">
                                                <i class="fa fa-paperclip"></i> <?php echo $this->lang->line('upload'); ?>
                                                <input  class="form-control col-md-7 col-xs-12"  name="image[]"  id="image" type="file">
                                                <span class="remove pull-right" style="color: red">remove</span>
                                            </div>
                                            <div class="editAddMore"><div href="btn btn-success">+ Add More</div></div>
                                        </div>
                                    </div>

                                    


                                    <div>
                                         <div class="text-info"><?php echo $this->lang->line('valid_file_format_img'); ?></div>
                                        <div class="help-block"><?php echo form_error('image'); ?></div>
                                    </div>

                                </div>
                                                         
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo $this->lang->line('note'); ?>"><?php echo isset($event->note) ?  $event->note : $post['note']; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                                                             
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="<?php echo isset($event) ? $event->id : $id; ?>" name="id" />
                                        <a href="<?php echo site_url('event'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('update'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  
                        <?php } ?>                    
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bs-event-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo $this->lang->line('event'); ?> <?php echo $this->lang->line('information'); ?></h4>
        </div>
        <div class="modal-body fn_event_data">
            
        </div>       
      </div>
    </div>
</div>
<link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
<script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script> 

<script type="text/javascript">
         
    function get_event_modal(event_id){
         
        $('.fn_event_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('event/get_single_event'); ?>",
          data   : {event_id : event_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_event_data').html(response);
             }
          }
       });
    }
</script>
<script type="text/javascript">
     
  $('#add_event_from').datepicker();
  $('#edit_event_from').datepicker();
  
  $('#add_event_to').datepicker();
  $('#edit_event_to').datepicker();
  
  $(document).ready(function() {
      $('#datatable-responsive').DataTable( {
          dom: 'Bfrtip',
          iDisplayLength: 15,
          buttons: [
              'copyHtml5',
              'excelHtml5',
              'csvHtml5',
              'pdfHtml5',
              'pageLength'
          ],
          search: true
      });
    });
    // $("#add").validate();     
    // $("#edit").validate();  
  </script> 

  <script>
    $(window).ready(function(){
        $('.addMore').click(function(){
            let image = $('.uploadImage.clone').clone(true);
            image.removeClass('clone hidden');
            console.log(image);
            image.insertAfter('.imagesWrapper .uploadImage:last');
          });

        $('.remove ').click(function(){
            $(this).parent('.uploadImage').remove();
        });


        $('.editAddMore').click(function(){
            let image = $('.editUploadImage.clone').clone(true);
            image.removeClass('clone hidden');
            console.log(image);
            image.insertAfter('.editImagesWrapper .editUploadImage:last');
          });

        $('.editRemove ').click(function(){
            $(this).parent('.editUploadImage').remove();
        });

        $('.role_id_class').change(function(){

            if($(this).val() == '4' ){
            
                $('.for_type_wrapper').show();
            }
            else{
                $('.for_type_wrapper').hide();
            }
        });

        $('#for_type').change(function(){
           switch($(this).val()){
            case 'classes': 
                $('.class_wrapper').show();
                $('.section_wrapper').hide();
                break;
            case 'section': 
                $('.class_wrapper').show();
                $('.section_wrapper').show();
                break;
            case 'all_classes': 
                $('.class_wrapper').hide();
                $('.section_wrapper').hide();
                break;
            default:
                $('.class_wrapper').hide();
                $('.section_wrapper').hide();
           }
        });


    });

    function select_section(class_id) {
    if(class_id !== ''){
        $.ajax({
            type   : "POST",
            url: "<?php echo site_url('ajax/get_class_by_section/');?>",
            data   : { class_id : class_id},               
            async  : false,
            success:function (response)
            {
                $('#section_id').html(response);

            }
        });
    }

    
}
      
  </script>