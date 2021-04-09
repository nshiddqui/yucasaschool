<?php $activeTab = "rooms"; ?>
<div class="page-header-content container-fluid">
  <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Hostel Rooms</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a> </div>
  </div>
 <?php include base_path().'application/views/backend/navigation_tab/hostel_nav_tab.php'; ?> 

</div>


<div class="clearfix"></div>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_content">
      <div class="" data-example-id="togglable-tabs">
        <ul  class="nav nav-tabs bordered hidden">
          <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_room_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('room'); ?> <?php echo $this->lang->line('list'); ?></a> </li>
          <?php if(has_permission(ADD, 'hostel', 'room')){ ?>
          <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_room"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('room'); ?></a> </li>
          <?php } ?>
          <?php if(isset($edit)){ ?>
          <li  class="active"><a href="#tab_edit_room"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> <?php echo $this->lang->line('room'); ?></a> </li>
          <?php } ?>
          <?php if(isset($detail)){ ?>
          <li  class="active"><a href="#tab_view_room"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> <?php echo $this->lang->line('room'); ?></a> </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="tab-content">
      <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="room" >
          <div class="item form-group row">
            <div class="col-md-6 col-sm-6 col-xs-12" style="margin-left:30%">
              <select  class="form-control col-md-7 col-xs-12"  name="hostel_id"  id="hostel_id" onchange="if(this.value){ window.location.href='<?= base_url('room/index/')?>'+this.value}">
                <option value="">--Select Hostel--</option>
                <?php foreach($hostels as $obj ){ ?>
                <option value="<?php echo $obj->id; ?>" <?php echo isset($hostel_id) && $hostel_id == $obj->id ?  'selected="selected"' : ''; ?>><?php echo $obj->name; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <br>
        <div class="x_content">
          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th><?php echo $this->lang->line('sl_no'); ?></th>
                <th>Room ID</th>
                <th><?php echo $this->lang->line('room_no'); ?></th>
                <th><?php echo $this->lang->line('room'); ?> <?php echo $this->lang->line('type'); ?></th>
                <th><?php echo $this->lang->line('seat_total'); ?></th>
                <th><?php echo $this->lang->line('hostel'); ?> <?php echo $this->lang->line('name'); ?></th>
                <th><?php echo $this->lang->line('cost_per_seat(annually)'); ?></th>
                <th width="25%"><?php echo $this->lang->line('note'); ?></th>
                <th><?php echo "Number of Beds" ?></th>
                <th><?php echo $this->lang->line('action'); ?></th>
              </tr>
            </thead>
            <tbody>
              <?php $count = 1; if(isset($rooms) && !empty($rooms)){ ?>
              <?php foreach($rooms as $obj){ ?>
              <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $obj->id; ?></td>
                <td><?php echo $obj->room_no; ?></td>
                <td><?php echo $this->lang->line($obj->room_type); ?></td>
                <td><?php echo $obj->total_seat; ?></td>
                <td><?php echo $obj->hostel_name; ?></td>
                <td><?php echo $obj->cost; ?></td>
                <td><?php echo $obj->note; ?></td>
                <td><?php echo $obj->beds; ?></td>
                <td><div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> Action <span class="caret"></span> </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                      <li>
                        <?php if(has_permission(EDIT, 'hostel', 'room')){ ?>
                        <a href="<?php echo site_url('room/edit/'.$obj->id); ?>"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> </a>
                        <?php } ?>
                      </li>
                      <li class="divider"></li>
                      <li>
                        <?php if(has_permission(DELETE, 'hostel', 'room')){ ?>
                        <a href="<?php echo site_url('room/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class=""><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
                        <?php } ?>
                      </li>
                    </ul>
                  </div></td>
              </tr>
              <?php } ?>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="#tab_add_room">
        <div class="x_content"> <?php echo form_open(site_url('room/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="room_no"><?php echo $this->lang->line('room_no'); ?> <span class="required">*</span> </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input  class="form-control col-md-7 col-xs-12"  name="room_no"  id="room_no" value="<?php echo isset($post['room_no']) ?  $post['room_no'] : ''; ?>" placeholder="<?php echo $this->lang->line('room_no'); ?>" required="required" type="text">
              <div class="help-block"><?php echo form_error('room_no'); ?></div>
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note">Room For(Staff/Student)</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="radio" class=""  name="type" value='1'>Student
              <input type="radio" class=""  name="type" value='2'>Staff
              <div class="help-block"><?php echo form_error('type'); ?></div>
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="room_type"><?php echo $this->lang->line('room'); ?> <?php echo $this->lang->line('type'); ?> <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select  class="form-control col-md-7 col-xs-12" name="room_type" id="room_type" required>
                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                <?php $types = get_room_types(); ?>
                <?php foreach($types as $key=>$value){ ?>
                <option value="<?php echo $key; ?>" <?php echo isset($post['room_type']) && $post['room_type'] == $key ?  'selected="selected"' : ''; ?>><?php echo $value; ?></option>
                <?php } ?>
              </select>
              <div class="help-block"><?php echo form_error('room_type'); ?></div>
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostel_id"><?php echo $this->lang->line('hostel'); ?> <span class="required">*</span> </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select  class="form-control col-md-7 col-xs-12"  name="hostel_id"  id="hostel_id" required >
                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                <?php foreach($hostels as $obj ){ ?>
                <option value="<?php echo $obj->id; ?>" <?php echo isset($post['hostel_id']) && $post['hostel_id'] == $obj->id ?  'selected="selected"' : ''; ?>><?php echo $obj->name; ?></option>
                <?php } ?>
              </select>
              <div class="help-block"><?php echo form_error('hostel_id'); ?></div>
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cost"><?php echo get_phrase('cost_per_seat(annually)'); ?> </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input  class="form-control col-md-7 col-xs-12"  name="cost"  id="cost" value="<?php echo isset($post['cost']) ?  $post['cost'] : ''; ?>" placeholder="<?php echo get_phrase('cost_per_seat_(annually)'); ?>" type="number">
              <div class="help-block"><?php echo form_error('cost'); ?></div>
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
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note">Number of Beds  <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text "class="form-control col-md-7 col-xs-12"  name="beds"  id="beds" placeholder="<?php echo $this->lang->line('Beds'); ?>" required><?php echo isset($room->beds) ?  $room->beds : $post['beds']; ?>
              <div class="help-block"><?php echo form_error('beds'); ?></div>
            </div>
          </div>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-md-offset-3"> <a href="<?php echo site_url('room'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
              <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
            </div>
          </div>
          <?php echo form_close(); ?> </div>
      </div>
      <?php if(isset($edit)){ ?>
      <div class="tab-pane fade in active" id="tab_edit_room">
        <div class="x_content"> <?php echo form_open(site_url('room/edit/'.$room->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="room_no"><?php echo $this->lang->line('room_no'); ?> <span class="required">*</span> </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input  class="form-control col-md-7 col-xs-12"  name="room_no"  id="room_no" value="<?php echo isset($room->room_no) ?  $room->room_no : $post['room_no']; ?>" placeholder="<?php echo $this->lang->line('room_no'); ?>" required="required" type="text">
              <div class="help-block"><?php echo form_error('room_no'); ?></div>
            </div>
          </div>
          
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note">Room For(Staff/Student)</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="radio" class=""  name="type" value='1' <?php if($room->type==1){echo 'checked';}?>>Student
              <input type="radio" class=""  name="type" value='2' <?php if($room->type==2){echo 'checked';}?>>Staff
              <div class="help-block"><?php echo form_error('type'); ?></div>
            </div>
          </div>
          
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="room_type"><?php echo $this->lang->line('room'); ?> <?php echo $this->lang->line('type'); ?> <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select  class="form-control col-md-7 col-xs-12" name="room_type" id="room_type" required>
                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                <?php $types = get_room_types(); ?>
                <?php foreach($types as $key=>$value){ ?>
                <option value="<?php echo $key; ?>" <?php if($room->room_type == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                <?php } ?>
              </select>
              <div class="help-block"><?php echo form_error('room_type'); ?></div>
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostel_id"><?php echo $this->lang->line('hostel'); ?> <span class="required">*</span> </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select  class="form-control col-md-7 col-xs-12"  name="hostel_id"  id="hostel_id" required >
                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                <?php foreach($hostels as $obj ){ ?>
                <option value="<?php echo $obj->id; ?>" <?php if($room->hostel_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                <?php } ?>
              </select>
              <div class="help-block"><?php echo form_error('hostel_id'); ?></div>
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cost"><?php echo get_phrase('cost
                                    _(annually)'); ?> </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input  class="form-control col-md-7 col-xs-12"  name="cost"  id="cost" value="<?php echo isset($room->cost) ?  $room->cost : $post['cost']; ?>" placeholder="<?php echo get_phrase('cost_per_seat(annually)'); ?>" type="number">
              <div class="help-block"><?php echo form_error('cost'); ?></div>
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('note'); ?></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo $this->lang->line('note'); ?>"><?php echo isset($room->note) ?  $room->note : $post['note']; ?></textarea>
              <div class="help-block"><?php echo form_error('note'); ?></div>
            </div>
          </div>

            <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note">Number of Beds   <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text "class="form-control col-md-7 col-xs-12"  name="beds" value="<?php echo isset($room->beds) ?  $room->beds : $post['beds']; ?>"  id="beds" placeholder="<?php echo $this->lang->line('Beds'); ?>" required>
              <div class="help-block"><?php echo form_error('beds'); ?></div>
            </div>
          </div>

           


          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
              <input type="hidden" value="<?php echo isset($room) ? $room->id : $id; ?>" name="id" />
              <a  href="<?php echo site_url('room'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
              <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('update'); ?></button>
            </div>
          </div>
          <?php echo form_close(); ?> </div>
      </div>
      <?php } ?>
    </div>
  </div>
</div>